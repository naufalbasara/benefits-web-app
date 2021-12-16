<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class DivisiController extends Controller
{
    public function index() {
        $divisi = DB::table('divisi')
        ->join('anggota', 'divisi.nrp', '=', 'anggota.nrp')
        ->join('divisi', 'divisi.divisiID', '=', 'divisi.divisiID')
        ->paginate(10);

        return view('divisi.index',['divisi' => $divisi]);
    }

    public function view($id) {
        $divisi = DB::table('divisi')
        ->join('anggota', 'divisi.nrp', '=', 'anggota.nrp')
        ->join('divisi', 'divisi.divisiID', '=', 'divisi.divisiID')
        ->where('divisiID', $id)
        ->get();

        $nama = DB::table('divisi')
        ->select('nama')
        ->join('anggota', 'divisi.nrp', '=', 'anggota.nrp')
        ->where('divisiID', $id)
        ->get();
        return view('divisi.detail',['divisi' => $divisi, 'nama' => $nama]);
    }

    public function edit($id) {
        $divisi = DB::table('divisi')
        ->where('nrp', $id)
        ->get();
        $nama = DB::table('divisi')
        ->select('nama')
        ->where('nrp', $id)
        ->get();
        return view('divisi.edit', ['divisi' => $divisi, 'nama' => $nama]);
    }

    public function delete($id) {
        DB::table('divisi')->where('divisiID',$id)->delete();
        return redirect('/divisi');
    }

    public function add() {
        $anggota = DB::table('anggota')
        ->leftJoin('divisi', 'anggota.nrp', '=', 'divisi.nrp')
        ->where('divisi.divisiID', '=', null)
        ->get();
        $divisi = DB::table('divisi')
        ->get();
        return view('divisi.add', ['anggota' => $anggota, 'divisi' => $divisi]);
    }

    public function store(Request $request) {
        DB::table('divisi')->insert([
            'divisiID' => $request->divisiID,
            'nrp' => $request->nrp,
            'divisiID' => $request->divisiID,
            'jabatan' => $request->jabatan
        ]);
        return redirect('/divisi');
    }

    public function update(Request $request) {
        DB::table('divisi')->where('nrp',$request->nrp)->update([
            'divisiID' => $request->divisiID,
            'nrp' => $request->nrp,
            'divisiID' => $request->divisiID,
            'jabatan' => $request->jabatan
        ]);
        return redirect('/divisi');
    }

}
