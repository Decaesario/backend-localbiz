<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProdukController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

// POST /api/register - Registrasi akun baru (Admin UMKM / Customer)
Route::post('/register', [AuthController::class, 'register']);

// POST /api/login - Login, mengembalikan token Sanctum
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    // POST /api/logout - Logout, menghapus token yang aktif
    Route::post('/logout', [AuthController::class, 'logout']);

    /*
    |--------------------------------------------------------------------------
    | PRODUK (Admin)
    |--------------------------------------------------------------------------
    */

    // GET /api/produk - List semua produk
    Route::get('/produk', [ProdukController::class, 'index']);

    // POST /api/produk - Tambah produk baru
    Route::post('/produk', [ProdukController::class, 'store']);

    // GET /api/produk/{id} - Detail 1 produk
    Route::get('/produk/{id}', [ProdukController::class, 'show']);

    // PUT /api/produk/{id} - Update produk
    Route::put('/produk/{id}', [ProdukController::class, 'update']);

    // DELETE /api/produk/{id} - Hapus produk
    Route::delete('/produk/{id}', [ProdukController::class, 'destroy']);

    /*
    |--------------------------------------------------------------------------
    | KATALOG (Mobile / Customer, read-only)
    |--------------------------------------------------------------------------
    */

    // GET /api/katalog - List produk read-only untuk mobile
    Route::get('/katalog', [ProdukController::class, 'katalog']);

    // GET /api/dashboard - Summary total produk, pesanan, dan status pesanan
    Route::get('/dashboard', [DashboardController::class, 'index']);

});