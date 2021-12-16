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
        $programkerja = DB::table('programkerja')
        ->where('nrp', $id)
        ->get();
        $nama = DB::table('programkerja')
        ->select('nama')
        ->where('nrp', $id)
        ->get();
        return view('programkerja.edit', ['programkerja' => $programkerja, 'nama' => $nama]);
    }

    public function delete($id) {
        DB::table('programkerja')->where('programkerjaID',$id)->delete();
        return redirect('/programkerja');
    }

    public function add() {
        $anggota = DB::table('anggota')
        ->leftJoin('programkerja', 'anggota.nrp', '=', 'programkerja.nrp')
        ->where('programkerja.programkerjaID', '=', null)
        ->get();
        $divisi = DB::table('divisi')
        ->get();
        return view('programkerja.add', ['anggota' => $anggota, 'divisi' => $divisi]);
    }

    public function store(Request $request) {
        DB::table('programkerja')->insert([
            'programkerjaID' => $request->programkerjaID,
            'nrp' => $request->nrp,
            'divisiID' => $request->divisiID,
            'jabatan' => $request->jabatan
        ]);
        return redirect('/programkerja');
    }

    public function update(Request $request) {
        DB::table('programkerja')->where('nrp',$request->nrp)->update([
            'programkerjaID' => $request->programkerjaID,
            'nrp' => $request->nrp,
            'divisiID' => $request->divisiID,
            'jabatan' => $request->jabatan
        ]);
        return redirect('/programkerja');
    }

}
