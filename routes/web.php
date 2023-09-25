<?php

use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PengeluaranController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/', [KeuanganController::class, 'index'])->name('dashboard');
    Route::get('/table-keuangan', [KeuanganController::class, 'table_keuangan'])->name('table_keuangan');
    Route::get('/show-saldo', [KeuanganController::class, 'show'])->name('showsaldo');

    Route::get('/pemasukan', [PemasukanController::class, 'index'])->name('pemasukan');
    Route::get('/table-pemasukan', [PemasukanController::class, 'table_pemasukan'])->name('table_pemasukan');
    Route::get('/create-pemasukan', [PemasukanController::class, 'create'])->name('createpemasukan');
    Route::post('/store-pemasukan', [PemasukanController::class, 'store'])->name('storepemasukan');
    Route::get('/show-pemasukan', [PemasukanController::class, 'show'])->name('showpemasukan');
    Route::get('/edit-pemasukan/{id}', [PemasukanController::class, 'edit'])->name('editpemasukan');
    Route::put('/update-pemasukan/{id}', [PemasukanController::class, 'update'])->name('updatepemasukan');
    Route::delete('/delete-pemasukan/{id}', [PemasukanController::class, 'delete'])->name('deletepemasukan');


    Route::get('/pengeluaran', [PengeluaranController::class, 'index'])->name('pengeluaran');
    Route::get('/table-pengeluaran', [PengeluaranController::class, 'table_pengeluaran'])->name('table_pengeluaran');
    Route::get('/create-pengeluaran', [PengeluaranController::class, 'create'])->name('createpengeluaran');
    Route::post('/store-pengeluaran', [PengeluaranController::class, 'store'])->name('storepengeluaran');
    Route::get('/show-pengeluaran', [PengeluaranController::class, 'show'])->name('showpengeluaran');
    Route::get('/edit-pengeluaran/{id}', [PengeluaranController::class, 'edit'])->name('editpengeluaran');
    Route::put('/update-pengeluaran/{id}', [PengeluaranController::class, 'update'])->name('updatepengeluaran');
    Route::delete('/delete-pengeluaran/{id}', [PengeluaranController::class, 'delete'])->name('deletepengeluaran');

    // Route::get('/profilmahasiswa', [ProfilController::class, 'index'])->name('profilmahasiswa');
});
