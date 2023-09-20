<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LoginController;
use App\Models\Kategori;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/register', [LoginController::class, 'register'])->name('login');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/check', [LoginController::class, 'check'])->name('check');

    //Kategori
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');
    Route::get('/kategori/{id}', [KategoriController::class, 'show'])->name('kategori_id');
    Route::get('/kategori/barang/{id}', [KategoriController::class, 'showbarang'])->name('kategori_barang_id');
    
    //BARANG
    Route::get('/barang', [BarangController::class, 'index'])->name('barang');
    Route::post('/barang/create', [BarangController::class, 'store'])->name('barang_create');
    Route::post('/barang/update/{id}', [BarangController::class, 'update'])->name('barang_update');
    Route::get('/barang/delete/{id}', [BarangController::class, 'destroy'])->name('barang_delete');

});
