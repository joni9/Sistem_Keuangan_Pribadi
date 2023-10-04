<?php

use App\Http\Controllers\Api\PemasukanControllerApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/pemasukan-api', [PemasukanControllerApi::class, 'index'])->name('pemasukan-api');
Route::get('/pemasukan-api/{id}', [PemasukanControllerApi::class, 'show'])->name('show-pemasukan-api');
Route::post('/store-pemasukan-api', [PemasukanControllerApi::class, 'store'])->name('stroe-pemasukan-api');
Route::get('/edit-pemasukan-api/{id}', [PemasukanControllerApi::class, 'edit'])->name('edit-pemasukan-api');
Route::put('/edit-pemasukan-api/{id}', [PemasukanControllerApi::class, 'update'])->name('update-pemasukan-api');
Route::delete('/destroy-pemasukan-api/{id}', [PemasukanControllerApi::class, 'destroy'])->name('destroy-pemasukan-api');
