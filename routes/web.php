<?php

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

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/absensi', function () {
    return view('absensi.index');
})->middleware(['auth'])->name('absensi');

Route::get('/barang', function () {
    return view('barang.index');
})->middleware(['auth'])->name('barang');

Route::get('/keuangan', function () {
    return view('keuangan.index');
})->middleware(['auth'])->name('keuangan');

Route::get('/pegawai', function () {
    return view('pegawai.index');
})->middleware(['auth'])->name('pegawai');

Route::get('/suplayer', function () {
    return view('suplayer.index');
})->middleware(['auth'])->name('suplayer');

Route::get('/laporan/absensi', function () {
    return view('laporan.index');
})->middleware(['auth'])->name('lapabsensi');

Route::get('/laporan/barang', function () {
    return view('laporan.index');
})->middleware(['auth'])->name('lapbarang');

Route::get('/laporan/keuangan', function () {
    return view('laporan.index');
})->middleware(['auth'])->name('lapkeuangan');

Route::get('/laporan/penggajian', function () {
    return view('laporan.index');
})->middleware(['auth'])->name('lappenggajian');

Route::get('/laporan/transaksi', function () {
    return view('laporan.index');
})->middleware(['auth'])->name('laptransaksi');

require __DIR__.'/auth.php';
