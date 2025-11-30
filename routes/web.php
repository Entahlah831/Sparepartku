<?php

use Illuminate\Support\Facades\Route;

// --- 1. IMPORT CONTROLLER (WAJIB ADA) ---
// Agar Laravel kenal siapa yang dipanggil
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminProductController;
/*
|--------------------------------------------------------------------------
| Web Routes (Jalan Raya Aplikasi)
|--------------------------------------------------------------------------
*/

// ====================================================
// A. JALUR UMUM (Bisa diakses Tanpa Login)
// ====================================================

// 1. Halaman Depan (Landing Page)
// Memanggil file: resources/views/home.blade.php
Route::get('/', function () {
    return view('home');
})->name('home');

// 2. Halaman Katalog (Daftar Produk)
Route::get('/katalog', [ProductController::class, 'index'])->name('products.index');

// 3. Detail Produk
Route::get('/produk/{id}', [ProductController::class, 'show'])->name('products.show');


// ====================================================
// B. JALUR KHUSUS MEMBER (Wajib Login)
// ====================================================
Route::middleware(['auth'])->group(function () {

    // --- FITUR USER PROFILE ---
    Route::get('/profil', [UserController::class, 'index'])->name('users.index');
    Route::get('/profil/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/profil/update', [UserController::class, 'update'])->name('users.update');

    // --- FITUR KERANJANG (CART) ---
    Route::get('/keranjang', [CartController::class, 'index'])->name('carts.index');
    Route::post('/keranjang/tambah/{id}', [CartController::class, 'store'])->name('carts.store');
    Route::delete('/keranjang/{id}', [CartController::class, 'destroy'])->name('carts.destroy');

    // --- FITUR CHECKOUT & TRANSAKSI ---
    // Isi Alamat
    Route::get('/checkout', [TransactionController::class, 'checkoutPage'])->name('transactions.checkout');
    // Proses Simpan Pesanan
    Route::post('/checkout', [TransactionController::class, 'store'])->name('transactions.store');
    // Riwayat Belanja
    Route::get('/transaksi', [TransactionController::class, 'index'])->name('transactions.index');
    // Invoice / Bayar (Midtrans)
    Route::get('/transaksi/{uuid}', [TransactionController::class, 'show'])->name('transactions.show');
    Route::prefix('admin')->name('admin.')->group(function(){
        Route::get('/products/create', [AdminProductController::class, 'create'])->name('products.create');
        Route::post('/products', [AdminProductController::class, 'store'])->name('products.store');
    });

    
});

// ====================================================
// C. JALUR AUTH (Login, Register, Logout)
// ====================================================
// Ini otomatis dibuat oleh Laravel Breeze
require __DIR__.'/auth.php';

Route::post('/midtrans-callback', [TransactionController::class, 'callback']);