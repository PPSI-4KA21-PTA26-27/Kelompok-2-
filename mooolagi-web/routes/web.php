<?php

use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\AuthPelangganController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\PublicProfilController;
use Illuminate\Support\Facades\Route;

// Rute Publik (UC-01 & UC-02)
Route::get('/', [PublicProfilController::class, 'index'])->name('beranda');
Route::get('/portofolio', [PublicProfilController::class, 'portofolio'])->name('portofolio');
Route::get('/testimoni', [PublicProfilController::class, 'testimoni'])->name('testimoni');
Route::get('/kontak', [PublicProfilController::class, 'kontak'])->name('kontak');
Route::get('/katalog', [KatalogController::class, 'katalog'])->name('katalog');
Route::get('/produk/{id}', [KatalogController::class, 'detail'])->name('produk.detail');

// Rute Autentikasi Pelanggan (UC-13 & UC-14)
Route::get('/login', [AuthPelangganController::class, 'showAuth'])->name('login');
Route::get('/register', [AuthPelangganController::class, 'showAuth'])->name('register');
Route::post('/register', [AuthPelangganController::class, 'register'])->name('pelanggan.register');
Route::post('/login', [AuthPelangganController::class, 'login'])->name('pelanggan.login');
Route::post('/logout', [AuthPelangganController::class, 'logout'])->name('pelanggan.logout');

// Rute Autentikasi & Dashboard Admin (UC-06)
Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthAdminController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AuthAdminController::class, 'loginAdmin'])->name('admin.login.post');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [AuthAdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::post('/logout', [AuthAdminController::class, 'logoutAdmin'])->name('admin.logout');
    });
});
