<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MerkController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', 
        [DashboardController::class, 'index'])
    ->name('dashboard');
    /** Route Absensi **/
    Route::resource('absensi', AttendanceController::class);
    /** Route Kasir **/
    Route::resource('kasir', CashierController::class);
    /** Route Barang **/
    Route::resource('barang', ItemController::class);
    Route::resource('merek', MerkController::class);
    Route::resource('kategori', CategoriesController::class);
    /** Route Keuangan **/
    Route::resource('keuangan', FinanceController::class);
    /** Route Pegawai **/
    Route::resource('pegawai', UserController::class);
    Route::resource('jabatan', RoleController::class);
    /** Route Supplier **/
    Route::resource('supplier', SupplierController::class);
    /** Route Laporan **/
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

    Route::resource('profil', ProfileController::class);
});

require __DIR__.'/auth.php';
