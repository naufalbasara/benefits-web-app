<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnggotaController;
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
    return view('dashboard');
});
Route::get('tables', function () {
    return view('system.tables');
});

// routing for anggota
Route::get('/anggota', [AnggotaController::class, 'index']);
Route::get('/anggota/detail/{id}', [AnggotaController::class, 'view']);
Route::get('/anggota/add', [AnggotaController::class, 'add']);
Route::post('/anggota/store', [AnggotaController::class, 'store']);
Route::get('/anggota/edit/{id}', [AnggotaController::class, 'edit']);
Route::post('/anggota/update', [AnggotaController::class, 'update']);
Route::get('/anggota/delete/{id}', [AnggotaController::class, 'delete']);
