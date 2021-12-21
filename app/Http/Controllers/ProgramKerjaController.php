<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ProgramKerjaController extends Controller
{
    public function index() {
        $programkerja = DB::table('programkerja')
        ->join('pengurus', 'programkerja.pengurusID', '=', 'pengurus.pengurusID')
        ->join('anggota', 'anggota.nrp', '=', 'pengurus.nrp')
        ->join('divisi', 'programkerja.divisiID', '=', 'divisi.divisiID')
        ->paginate(10);

        $doneProgram = DB::table('programkerja')
        ->where('status', '=', 'Sudah')
        ->count();

        $totalProgram = DB::table('programkerja')
        ->count();

        $progress =  number_format(($doneProgram/$totalProgram)*100);

        $fund = DB::table('programkerja')
        ->leftJoin('dana', 'programkerja.danaID', '=', 'dana.danaID')
        ->where('tipeTransaksi', '=', 'DanaKeluar')
        ->sum('biaya');

        $danaMasuk = DB::table('dana')
        ->where('tipeTransaksi', '=', 'DanaMasuk')
        ->sum('biaya');
        $danaKeluar = DB::table('dana')
        ->where('tipeTransaksi', '=', 'DanaKeluar')
        ->sum('biaya');
        $totalKas = $danaMasuk - $danaKeluar;

        return view('programkerja.index',[
            'programkerja' => $programkerja,
            'doneProgram' => $doneProgram,
            'totalProgram' => $totalProgram,
            'progress' => $progress,
            'fund' => number_format($fund, 2, ',', '.'),
            'totalKas' => number_format($totalKas, 2, ',', '.')
        ]);
    }

    public function view($id) {
        $programkerja = DB::table('programkerja')
        ->join('pengurus', 'programkerja.pengurusID', '=', 'pengurus.pengurusID')
        ->join('anggota', 'anggota.nrp', '=', 'pengurus.nrp')
        ->join('divisi', 'programkerja.divisiID', '=', 'divisi.divisiID')
        ->leftJoin('dana', 'programkerja.danaID', '=', 'dana.danaID')
        ->where('prokerID', $id)
        ->get();

        $nama = DB::table('programkerja')
        ->select('namaProker')
        ->where('prokerID', $id)
        ->get();
        return view('programkerja.detail',['programkerja' => $programkerja, 'nama' => $nama]);
    }

    public function edit($id) {
        $pengurus = DB::table('pengurus')
        ->join('anggota', 'pengurus.nrp', '=', 'anggota.nrp')
        ->get();

        $divisi = DB::table('divisi')
        ->get();

        $pic = DB::table('pengurus')
        ->join('anggota', 'pengurus.nrp', '=', 'anggota.nrp')
        ->join('divisi', 'pengurus.divisiID', '=', 'divisi.divisiID')
        ->join('programkerja', 'pengurus.pengurusID', '=', 'programkerja.pengurusID')
        ->where('programkerja.prokerID', $id)
        ->first();

        $proker = DB::table('programkerja')
        ->join('dana', 'programkerja.danaID', '=', 'dana.danaID')
        ->where('prokerID', $id)
        ->get();

        $pengurusDivisi = DB::table('pengurus')
        ->join('divisi', 'pengurus.divisiID', '=', 'divisi.divisiID')
        ->join('programkerja', 'pengurus.pengurusID', '=', 'programkerja.pengurusID')
        ->where('programkerja.prokerID', $id)
        ->first();

        $nama = DB::table('programkerja')
        ->select('namaProker')
        ->where('prokerID', $id)
        ->first();
        return view('programkerja.edit', [
            'pengurus' => $pengurus,
            'nama' => $nama,
            'divisi' => $divisi,
            'pengurusDivisi' => $pengurusDivisi,
            'pic' => $pic,
            'proker' => $proker
        ]);
    }

    public function delete($id) {
        $danaID = DB::table('programkerja')->select('danaID')->where('prokerID',$id)->first();
        DB::table('dana')->where('danaID',$danaID->danaID)->delete();
        DB::table('programkerja')->where('prokerID',$id)->delete();
        return redirect('/proker');
    }

    public function add() {
        $pengurus = DB::table('pengurus')
        ->join('anggota', 'pengurus.nrp', '=', 'anggota.nrp')
        ->join('divisi', 'pengurus.divisiID', '=', 'divisi.divisiID')
        ->get();
        $divisi = DB::table('divisi')
        ->get();

        return view('programkerja.add', [
            'pengurus' => $pengurus,
            'divisi' => $divisi
        ]);
    }

    public function store(Request $request) {
        $last_prokerID = DB::table('programkerja')->select('prokerID')->orderBy('prokerID', 'desc')->first();
        $last_prokerID = (int)substr($last_prokerID->prokerID , -2);

        $last_danaID = DB::table('dana')->select('danaID')->orderBy('danaID', 'desc')->first();
        $last_danaID = (int)substr($last_danaID->danaID , -3);

        if($last_prokerID < 9) {
            $prokerID = "PK0".strval($last_prokerID+1);
        } else {
            $prokerID = "PK".strval($last_prokerID+1);
        }

        if($last_danaID < 9) {
            $danaID = "DN00".strval($last_danaID+1);
        } else if($last_danaID < 99){
            $danaID = "DN0".strval($last_danaID+1);
        } else {
            $danaID = "DN".strval($last_danaID+1);
        }

        if($request->biaya == '' or $request->biaya == null) {
            $biaya = 0;
        }
        DB::table('dana')->insert([
            'danaID' => $danaID,
            'tipeTransaksi' => 'DanaKeluar',
            'biaya' => $biaya,
            'tanggalTransaksi' => $request->tanggalKegiatan,
            'sumber' => null,
            'keperluan' => $request->namaProker
        ]);

        DB::table('programkerja')->insert([
            'prokerID' => $prokerID,
            'pengurusID' => $request->pengurusID,
            'divisiID' => $request->divisiID,
            'danaID' => $danaID,
            'namaProker' => $request->namaProker,
            'tanggalKegiatan' => $request->tanggalKegiatan,
            'status' => $request->status
        ]);


        return redirect('/proker');
    }

    public function update(Request $request) {
        DB::table('programkerja')->where('prokerID',$request->prokerID)->update([
            'prokerID' => $request->prokerID,
            'pengurusID' => $request->pengurusID,
            'divisiID' => $request->divisiID,
            'danaID' => $request->danaID,
            'namaProker' => $request->namaProker,
            'tanggalKegiatan' => $request->tanggalKegiatan,
            'status' => $request->status
        ]);

        DB::table('dana')->where('danaID', $request->danaID)->update([
            'danaID' => $request->danaID,
            'tipeTransaksi' => 'DanaKeluar',
            'biaya' => $request->biaya,
            'tanggalTransaksi' => $request->tanggalKegiatan,
            'sumber' => null,
            'keperluan' => $request->namaProker
        ]);

        return redirect('/proker');
    }

}
