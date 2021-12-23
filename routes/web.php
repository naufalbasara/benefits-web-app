<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\ProgramKerjaController;
use App\Http\Controllers\DanaController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// logged in user
Route::group(['middleware' => ['auth']], function(){
    Route::get('/', function () {
        $anggota = DB::table('anggota')
            ->count();

        $doneProgram = DB::table('programkerja')
            ->where('status', '=', 'Sudah')
            ->count();
        $onProgressProgram = DB::table('programkerja')
            ->where('status', '=', 'Sedang')
            ->count();
        $pendingProgram = DB::table('programkerja')
            ->where('status', '=', 'Belum')
            ->count();

        $totalProgram = DB::table('programkerja')
            ->count();

        $progress =  number_format(($doneProgram/$totalProgram)*100);
        $onProgress =  number_format(($onProgressProgram/$totalProgram)*100);
        $pendingProgress =  number_format(($pendingProgram/$totalProgram)*100);

        $danaMasuk = DB::table('dana')
            ->where('tipeTransaksi', '=', 'DanaMasuk')
            ->sum('biaya');
        $danaKeluar = DB::table('dana')
            ->where('tipeTransaksi', '=', 'DanaKeluar')
            ->sum('biaya');
        $totalKas = $danaMasuk - $danaKeluar;

        $thisMonth = DB::table('dana')
        ->where('tanggalTransaksi', '=', date('m'))
        ->sum('biaya');

        return view('dashboard', [
            'anggota' => $anggota,
            'progress' => $progress,
            'onProgress' => $onProgress,
            'pendingProgress' => $pendingProgress,
            'thisMonth' => $thisMonth,
            'totalKas' => number_format($totalKas, 2, ',', '.')
        ]);
    });

    // routing for anggota
    Route::get('/anggota', [AnggotaController::class, 'index']);
    Route::get('/anggota/detail/{id}', [AnggotaController::class, 'view']);

    // routing for pengurus
    Route::get('/pengurus', [PengurusController::class, 'index']);
    Route::get('/pengurus/detail/{id}', [PengurusController::class, 'view']);

    // routing for ProgramKerja
    Route::get('/proker', [ProgramKerjaController::class, 'index']);
    Route::get('/proker/detail/{id}', [ProgramKerjaController::class, 'view']);
    Route::get('/proker/add', [ProgramKerjaController::class, 'add']);
    Route::post('/proker/store', [ProgramKerjaController::class, 'store']);
    Route::get('/proker/edit/{id}', [ProgramKerjaController::class, 'edit']);
    Route::post('/proker/update', [ProgramKerjaController::class, 'update']);
    Route::get('/proker/delete/{id}', [ProgramKerjaController::class, 'delete']);

    // routing for dana
    Route::get('/dana', [DanaController::class, 'index']);
    Route::get('/dana/detail/{id}', [DanaController::class, 'view']);

    // routing for divisi
    Route::get('/divisi', [DivisiController::class, 'index']);
    Route::get('/divisi/detail/{id}', [DivisiController::class, 'view']);
});


// sekretaris
Route::group(['middleware' => 'sekretaris', 'middleware' => 'admin'], function(){
    // anggota
    Route::get('/anggota/add', [AnggotaController::class, 'add']);
    Route::post('/anggota/store', [AnggotaController::class, 'store']);
    Route::get('/anggota/edit/{id}', [AnggotaController::class, 'edit']);
    Route::post('/anggota/update', [AnggotaController::class, 'update']);
    Route::get('/anggota/delete/{id}', [AnggotaController::class, 'delete']);

    // pengurus
    Route::get('/pengurus/add', [PengurusController::class, 'add']);
    Route::post('/pengurus/store', [PengurusController::class, 'store']);
    Route::get('/pengurus/edit/{id}', [PengurusController::class, 'edit']);
    Route::post('/pengurus/update', [PengurusController::class, 'update']);
    Route::get('/pengurus/delete/{id}', [PengurusController::class, 'delete']);

    // divisi
    Route::get('/divisi/add', [DivisiController::class, 'add']);
    Route::post('/divisi/store', [DivisiController::class, 'store']);
    Route::get('/divisi/edit/{id}', [DivisiController::class, 'edit']);
    Route::post('/divisi/update', [DivisiController::class, 'update']);
    Route::get('/divisi/delete/{id}', [DivisiController::class, 'delete']);
});

// kewirausahaan
Route::group(['middleware' => 'kewirausahaan', 'middleware' => 'admin'], function() {
    // dana
    Route::get('/dana/add', [DanaController::class, 'add']);
    Route::post('/dana/store', [DanaController::class, 'store']);
    Route::get('/dana/edit/{id}', [DanaController::class, 'edit']);
    Route::post('/dana/update', [DanaController::class, 'update']);
    Route::get('/dana/delete/{id}', [DanaController::class, 'delete']);
});

// guest (not logged user)
Route::group(['middleware' => 'guest'], function() {
    // login
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate']);
    // register
    Route::get('/register', [RegisterController::class, 'index']);
    Route::post('/register', [RegisterController::class, 'store']);

});


Route::post('/logout', [LoginController::class, 'logout']);

