<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SuplayerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransactionController;
use App\Models\Employee;
use App\Models\Finance;
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

    Route::resource('barang', ItemController::class);


    /** 
     * Route Pegawai
     **/
    Route::get('/kasir', 
        [KasirController::class, 'index'])
    ->name('kasir');

    Route::resource('keuangan', FinanceController::class);

    /** 
     * Route Pegawai
     **/
    Route::resource('pegawai', UserController::class);
    
    Route::resource('supplier', SupplierController::class);


    /** 
     * Route Laporan
     **/
    Route::get('laporan/absensi', 
        [AttendanceController::class, 'report']
    )->name('laporan.absensi');
    Route::get('laporan/barang', 
        [ItemController::class, 'report']
    )->name('laporan.barang');
    Route::get('laporan/keuangan', 
        [FinanceController::class, 'report']
    )->name('laporan.keuangan');
    Route::get('laporan/transaksi', 
        [TransactionController::class, 'report']
    )->name('laporan.transaksi');

    Route::resource('laporan', ReportController::class);
});

require __DIR__.'/auth.php';
