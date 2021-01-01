<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SuplayerController;
use App\Http\Controllers\SupplierController;
use App\Models\Employee;
use App\Models\Report;
use App\Models\Supplier;
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
    
    Route::get('/', 
        [DashboardController::class, 'index'])
    ->name('dashboard');
    
    Route::resource('absensi', AttendanceController::class);

    Route::get('/barang', function () {
        return view('barang.index');
    })->name('barang');


    /** 
     * Route Pegawai
     **/
    Route::get('/kasir', 
        [KasirController::class, 'index'])
    ->name('kasir');

    Route::get('/keuangan', function () {
        return view('keuangan.index');
    })->name('keuangan');

    /** 
     * Route Pegawai
     **/
    Route::resource('pegawai', EmployeeController::class);
    // Route::get('/pegawai', 
    //     [PegawaiController::class, 'index'])
    // ->name('pegawai');

    /** 
     * Route Suplayer
     **/
    Route::get('/suplayer', 
        [SupplierController::class, 'index'])
    ->name('supplier');

    /** 
     * Route Laporan
     **/
    Route::get('laporan/absensi', 
        [ReportController::class, 'absensi']
    )->name('laporan.absensi');
});

require __DIR__.'/auth.php';
