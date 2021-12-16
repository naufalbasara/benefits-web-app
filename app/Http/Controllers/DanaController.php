<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class DanaController extends Controller
{
    public function index() {
        $dana = DB::table('dana')
        ->paginate(10);

        $danaMasuk = DB::table('dana')
        ->where('tipeTransaksi', '=', 'DanaMasuk')
        ->sum('biaya');
        $danaKeluar = DB::table('dana')
        ->where('tipeTransaksi', '=', 'DanaKeluar')
        ->sum('biaya');
        $totalKas = $danaMasuk - $danaKeluar;

        $thisMonthIncome = DB::table('dana')
        ->where('tanggalTransaksi', '=', date('m'))
        ->where('tipeTransaksi', '=', 'DanaMasuk')
        ->sum('biaya');

        return view('dana.index',[
            'dana' => $dana,
            'thisMonthIncome' => $thisMonthIncome,
            'totalKas' => number_format($totalKas, 2, ',', '.'),
            'danaMasuk' => number_format($danaMasuk, 2, ',', '.'),
            'danaKeluar' => number_format($danaKeluar, 2, ',', '.')
        ]);
    }

    public function view($id) {
        $dana = DB::table('dana')
        ->join('anggota', 'dana.nrp', '=', 'anggota.nrp')
        ->join('divisi', 'dana.divisiID', '=', 'divisi.divisiID')
        ->where('danaID', $id)
        ->get();

        $nama = DB::table('dana')
        ->select('nama')
        ->join('anggota', 'dana.nrp', '=', 'anggota.nrp')
        ->where('danaID', $id)
        ->get();
        return view('dana.detail',['dana' => $dana, 'nama' => $nama]);
    }

    public function edit($id) {
        $dana = DB::table('dana')
        ->where('nrp', $id)
        ->get();
        $nama = DB::table('dana')
        ->select('nama')
        ->where('nrp', $id)
        ->get();
        return view('dana.edit', ['dana' => $dana, 'nama' => $nama]);
    }

    public function delete($id) {
        DB::table('dana')->where('danaID',$id)->delete();
        return redirect('/dana');
    }

    public function add() {
        $anggota = DB::table('anggota')
        ->leftJoin('dana', 'anggota.nrp', '=', 'dana.nrp')
        ->where('dana.danaID', '=', null)
        ->get();
        $divisi = DB::table('divisi')
        ->get();
        return view('dana.add', ['anggota' => $anggota, 'divisi' => $divisi]);
    }

    public function store(Request $request) {
        DB::table('dana')->insert([
            'danaID' => $request->danaID,
            'nrp' => $request->nrp,
            'divisiID' => $request->divisiID,
            'jabatan' => $request->jabatan
        ]);
        return redirect('/dana');
    }

    public function update(Request $request) {
        DB::table('dana')->where('nrp',$request->nrp)->update([
            'danaID' => $request->danaID,
            'nrp' => $request->nrp,
            'divisiID' => $request->divisiID,
            'jabatan' => $request->jabatan
        ]);
        return redirect('/dana');
    }

}
