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

    Route::get('/pemasukan', [PemasukanController::class, 'index'])->name('pemasukan');
    Route::get('/table-pemasukan', [PemasukanController::class, 'table_pemasukan'])->name('table_pemasukan');

    Route::get('/pengeluaran', [PengeluaranController::class, 'index'])->name('pengeluaran');
    Route::get('/table-pengeluaran', [PengeluaranController::class, 'table_pengeluaran'])->name('table_pengeluaran');

    // Route::get('/profilmahasiswa', [ProfilController::class, 'index'])->name('profilmahasiswa');
});
