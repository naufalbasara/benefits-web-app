<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class AnggotaController extends Controller
{
    public function index() {
        $anggota = DB::table('anggota')->paginate(10);

        return view('anggota.index',['anggota' => $anggota]);
    }

    public function view($id) {
        $anggota = DB::table('anggota')
        ->where('nrp', $id)
        ->get();

        $nama = DB::table('anggota')
        ->select('nama')
        ->where('nrp', $id)
        ->get();
        return view('anggota.detail',['anggota' => $anggota, 'nama' => $nama]);
    }

    public function edit($id) {
        $anggota = DB::table('anggota')
        ->where('nrp', $id)
        ->get();
        $nama = DB::table('anggota')
        ->select('nama')
        ->where('nrp', $id)
        ->get();
        return view('anggota.edit', ['anggota' => $anggota, 'nama' => $nama]);
    }

    public function delete($id) {
        DB::table('anggota')->where('nrp',$id)->delete();
        return redirect('/anggota');
    }

    public function add() {
        return view('anggota.add');
    }

    public function store(Request $request) {
        DB::table('anggota')->insert([
            'nrp' => $request->nrp,
            'departemen' => $request->departemen,
            'nama' => $request->nama,
            'angkatan' => $request->angkatan,
            'gender' => $request->gender,
            'alamat' => $request->alamat,
            'asalSekolah' => $request->asalSekolah,
            'noHp' => $request->noHp
        ]);
        return redirect('/anggota');
    }

    public function update(Request $request) {
        DB::table('anggota')->where('nrp',$request->nrp)->update([
            'nrp' => $request->nrp,
            'departemen' => $request->departemen,
            'nama' => $request->nama,
            'angkatan' => $request->angkatan,
            'gender' => $request->gender,
            'alamat' => $request->alamat,
            'asalSekolah' => $request->asalSekolah,
            'noHp' => $request->noHp
        ]);
        return redirect('/anggota');
    }

}
