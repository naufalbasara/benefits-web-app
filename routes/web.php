<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\ProgramKerjaController;
use App\Http\Controllers\DanaController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
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
})->middleware('auth');

Route::get('tables', function () {
    return view('system.tables');
});

// routing for anggota
Route::get('/anggota', [AnggotaController::class, 'index'])->middleware('auth');
Route::get('/anggota/detail/{id}', [AnggotaController::class, 'view'])->middleware('auth');
Route::get('/anggota/add', [AnggotaController::class, 'add'])->middleware('auth');
Route::post('/anggota/store', [AnggotaController::class, 'store'])->middleware('auth');
Route::get('/anggota/edit/{id}', [AnggotaController::class, 'edit'])->middleware('auth');
Route::post('/anggota/update', [AnggotaController::class, 'update'])->middleware('auth');
Route::get('/anggota/delete/{id}', [AnggotaController::class, 'delete'])->middleware('auth');

// routing for pengurus
Route::get('/pengurus', [PengurusController::class, 'index'])->middleware('auth');
Route::get('/pengurus/detail/{id}', [PengurusController::class, 'view'])->middleware('auth');
Route::get('/pengurus/add', [PengurusController::class, 'add'])->middleware('auth');
Route::post('/pengurus/store', [PengurusController::class, 'store'])->middleware('auth');
Route::get('/pengurus/edit/{id}', [PengurusController::class, 'edit'])->middleware('auth');
Route::post('/pengurus/update', [PengurusController::class, 'update'])->middleware('auth');
Route::get('/pengurus/delete/{id}', [PengurusController::class, 'delete'])->middleware('auth');

// routing for ProgramKerja
Route::get('/proker', [ProgramKerjaController::class, 'index'])->middleware('auth');
Route::get('/proker/detail/{id}', [ProgramKerjaController::class, 'view'])->middleware('auth');
Route::get('/proker/add', [ProgramKerjaController::class, 'add'])->middleware('auth');
Route::post('/proker/store', [ProgramKerjaController::class, 'store'])->middleware('auth');
Route::get('/proker/edit/{id}', [ProgramKerjaController::class, 'edit'])->middleware('auth');
Route::post('/proker/update', [ProgramKerjaController::class, 'update'])->middleware('auth');
Route::get('/proker/delete/{id}', [ProgramKerjaController::class, 'delete'])->middleware('auth');

// routing for dana
Route::get('/dana', [DanaController::class, 'index'])->middleware('auth');
Route::get('/dana/detail/{id}', [DanaController::class, 'view'])->middleware('auth');
Route::get('/dana/add', [DanaController::class, 'add'])->middleware('auth');
Route::post('/dana/store', [DanaController::class, 'store'])->middleware('auth');
Route::get('/dana/edit/{id}', [DanaController::class, 'edit'])->middleware('auth');
Route::post('/dana/update', [DanaController::class, 'update'])->middleware('auth');
Route::get('/dana/delete/{id}', [DanaController::class, 'delete'])->middleware('auth');

// routing for divisi
Route::get('/divisi', [DivisiController::class, 'index'])->middleware('auth');
Route::get('/divisi/detail/{id}', [DivisiController::class, 'view'])->middleware('auth');
Route::get('/divisi/add', [DivisiController::class, 'add'])->middleware('auth');
Route::post('/divisi/store', [DivisiController::class, 'store'])->middleware('auth');
Route::get('/divisi/edit/{id}', [DivisiController::class, 'edit'])->middleware('auth');
Route::post('/divisi/update', [DivisiController::class, 'update'])->middleware('auth');
Route::get('/divisi/delete/{id}', [DivisiController::class, 'delete'])->middleware('auth');

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout']);

// register
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest');
