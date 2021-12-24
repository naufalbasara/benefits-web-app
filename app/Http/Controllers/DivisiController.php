<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;


class DivisiController extends Controller
{
    public function index() {
        $divisi = DB::table('divisi')
        ->paginate(10);

        $Staff = DB::table('pengurus')
        ->join('divisi', 'pengurus.divisiID', '=', 'divisi.divisiID')
        ->get();

        $numberOfProker = DB::table('divisi')
        ->join('programkerja', 'divisi.divisiID', '=', 'programkerja.divisiID')
        ->get();

        return view('divisi.index',[
            'divisi' => $divisi,
            'Staff' => $Staff,
            'numberOfProker' => $numberOfProker
        ]);
    }

    public function view($id) {
        $staff = DB::table('pengurus')
        ->join('divisi', 'pengurus.divisiID', '=', 'divisi.divisiID')
        ->join('anggota', 'pengurus.nrp', '=', 'anggota.nrp')
        ->where('divisi.divisiID', $id)
        ->paginate(5);

        $proker = DB::table('divisi')
        ->join('programkerja', 'divisi.divisiID', '=', 'programkerja.divisiID')
        ->where('divisi.divisiID', $id)
        ->get();

        $nama = DB::table('divisi')
        ->select('namaDivisi')
        ->where('divisiID', $id)
        ->first();
        return view('divisi.detail',['staff' => $staff,
        'nama' => $nama,
        'proker' => $proker
    ]);
    }

    public function edit($id) {
        $divisi = DB::table('divisi')
        ->where('divisiID', $id)
        ->first();
        $nama = DB::table('divisi')
        ->select('namaDivisi')
        ->where('divisiID', $id)
        ->first();
        return view('divisi.edit', ['divisi' => $divisi, 'nama' => $nama]);
    }

    public function delete($id) {
        DB::table('divisi')->where('divisiID',$id)->delete();
        return redirect('/divisi');
    }

    public function add() {
        return view('divisi.add');
    }

    public function store(Request $request) {
        $last_divisiID = DB::table('divisi')->select('divisiID')->orderBy('divisiID', 'desc')->first();
        $last_divisiID = (int)substr($last_divisiID->divisiID , -2);
        if($last_divisiID < 9) {
            $divisiID = "D0".strval($last_divisiID+1);
        } else {
            $divisiID = "D".strval($last_divisiID+1);
        }

        DB::table('divisi')->insert([
            'divisiID' => $divisiID,
            'namaDivisi' => $request->namaDivisi,
        ]);
        return redirect('/divisi');
    }

    public function update(Request $request) {
        DB::table('divisi')->where('divisiID',$request->divisiID)->update([
            'divisiID' => $request->divisiID,
            'namaDivisi' => $request->namaDivisi,
        ]);
        return redirect('/divisi');
    }

}
