<?php

use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\SuplayerController;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => ['auth']], function () {
    
    Route::get('/', function () {
        return redirect('/dashboard');
    });

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/absensi', function () {
        return view('absensi.index');
    })->name('absensi');

    Route::get('/barang', function () {
        return view('barang.index');
    })->name('barang');

    Route::get('/keuangan', function () {
        return view('keuangan.index');
    })->name('keuangan');

    /** 
     * Route Pegawai
     **/
    Route::get('/pegawai', 
        [PegawaiController::class, 'index'])
    ->name('pegawai');

    /** 
     * Route Suplayer
     **/
    Route::get('/suplayer', 
        [SuplayerController::class, 'index'])
    ->name('suplayer');

    /** 
     * Route Laporan
     **/
    Route::get('/laporan/absensi', 
        [LaporanController::class, 'absensi'])
    ->name('lapabsensi');

    Route::get('/laporan/barang', 
        [LaporanController::class, 'barang'])
    ->name('lapbarang');
    
    Route::get('/laporan/keuangan', 
        [LaporanController::class, 'keuangan'])
    ->name('lapkeuangan');

    Route::get('/laporan/penggajian', 
        [LaporanController::class, 'penggajian'])
    ->name('lappenggajian')
    ;
    Route::get('/laporan/transaksi', 
        [LaporanController::class, 'transaksi'])
    ->name('laptransaksi');
});

require __DIR__.'/auth.php';
