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
        ->where('tanggalTransaksi', '=', date('Y-M'))
        ->where('tipeTransaksi', '=', 'DanaMasuk')
        ->sum('biaya');

        return view('dana.index',[
            'dana' => $dana,
            'thisMonthIncome' => $thisMonthIncome,
            'totalKas' => number_format($totalKas, 0, ',', '.'),
            'danaMasuk' => number_format($danaMasuk, 0, ',', '.'),
            'danaKeluar' => number_format($danaKeluar, 0, ',', '.')
        ]);
    }

    public function view($id) {
        $dana = DB::table('dana')
        ->where('danaID', $id)
        ->get();
        return view('dana.detail',['dana' => $dana]);
    }

    public function edit($id) {
        $dana = DB::table('dana')
        ->where('danaID', $id)
        ->get();
        return view('dana.edit', ['dana' => $dana]);
    }

    public function delete($id) {
        DB::table('dana')->where('danaID',$id)->delete();
        return redirect('/dana');
    }

    public function add() {
        return view('dana.add');
    }

    public function store(Request $request) {
        $last_danaID = DB::table('dana')->select('danaID')->orderBy('danaID', 'desc')->first();
        $last_danaID = (int)substr($last_danaID->danaID , -3);
        $biaya = $request->biaya;
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
            'tipeTransaksi' => $request->tipeTransaksi,
            'biaya' => $biaya,
            'tanggalTransaksi' => $request->tanggalTransaksi,
            'sumber' => $request->sumber,
            'keperluan' => $request->keperluan,
        ]);
        return redirect('/dana');
    }

    public function update(Request $request) {
        $biaya = $request->biaya;
        if($request->biaya == '' or $request->biaya == null) {
            $biaya = 0;
        }
        DB::table('dana')->where('danaID',$request->danaID)->update([
            'danaID' => $request->danaID,
            'tipeTransaksi' => $request->tipeTransaksi,
            'biaya' => $biaya,
            'tanggalTransaksi' => $request->tanggalTransaksi,
            'sumber' => $request->sumber,
            'keperluan' => $request->keperluan,
        ]);
        return redirect('/dana');
    }

}
