<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class PengurusController extends Controller
{
    public function index() {
        $pengurus = DB::table('pengurus')
        ->join('anggota', 'pengurus.nrp', '=', 'anggota.nrp')
        ->join('divisi', 'pengurus.divisiID', '=', 'divisi.divisiID')
        ->paginate(10);

        return view('pengurus.index',['pengurus' => $pengurus]);
    }

    public function view($id) {
        $pengurus = DB::table('pengurus')
        ->join('anggota', 'pengurus.nrp', '=', 'anggota.nrp')
        ->join('divisi', 'pengurus.divisiID', '=', 'divisi.divisiID')
        ->where('pengurusID', $id)
        ->get();

        $nama = DB::table('pengurus')
        ->select('nama')
        ->join('anggota', 'pengurus.nrp', '=', 'anggota.nrp')
        ->where('pengurusID', $id)
        ->get();
        return view('pengurus.detail',['pengurus' => $pengurus, 'nama' => $nama]);
    }

    public function edit($id) {
        $pengurus = DB::table('pengurus')
        ->where('nrp', $id)
        ->get();
        $nama = DB::table('pengurus')
        ->select('nama')
        ->where('nrp', $id)
        ->get();
        return view('pengurus.edit', ['pengurus' => $pengurus, 'nama' => $nama]);
    }

    public function delete($id) {
        DB::table('pengurus')->where('pengurusID',$id)->delete();
        return redirect('/pengurus');
    }

    public function add() {
        $anggota = DB::table('anggota')
        ->leftJoin('pengurus', 'anggota.nrp', '=', 'pengurus.nrp')
        ->where('pengurus.pengurusID', '=', null)
        ->get();
        $divisi = DB::table('divisi')
        ->get();
        return view('pengurus.add', ['anggota' => $anggota, 'divisi' => $divisi]);
    }

    public function store(Request $request) {
        DB::table('pengurus')->insert([
            'pengurusID' => $request->pengurusID,
            'nrp' => $request->nrp,
            'divisiID' => $request->divisiID,
            'jabatan' => $request->jabatan
        ]);
        return redirect('/pengurus');
    }

    public function update(Request $request) {
        DB::table('pengurus')->where('nrp',$request->nrp)->update([
            'pengurusID' => $request->pengurusID,
            'nrp' => $request->nrp,
            'divisiID' => $request->divisiID,
            'jabatan' => $request->jabatan
        ]);
        return redirect('/pengurus');
    }

}
