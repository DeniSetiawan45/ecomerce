<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// ============================================
// HALAMAN PUBLIK (SEMUA BISA AKSES)
// ============================================
Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.detail');
Route::get('/kategori/{type}', [ProductController::class, 'filter'])->name('category.type');
Route::get('/kategori/{type}/{slug}', [ProductController::class, 'filter'])->name('category.detail');

// ============================================
// GUEST ONLY (TANPA LOGIN) - BISA JUAL PRODUK
// ============================================
Route::middleware('guest')->group(function () {
    Route::get('/jual', [ProductController::class, 'create'])->name('product.create');
    
});
Route::post('/products', [ProductController::class, 'store'])->name('products.store');

// ============================================
// AUTHENTICATION (LOGIN / REGISTER)
// ============================================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ============================================
// ADMIN ONLY - DASHBOARD (TIDAK BISA CRUD)
// ============================================
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

Route::get('/admin/profile', [App\Http\Controllers\AdminController::class, 'profile'])
    ->name('admin.profile');

// ============================================
// TESTING (HAPUS PRODUK EXPIRED)
// ============================================
Route::get('/delete-expired', function () {
    $deleted = App\Models\Product::deleteExpired();
    return "Berhasil hapus {$deleted} produk expired!";
});

// Pencarian admin berdasarkan lokasi
Route::get('/cari-admin', [App\Http\Controllers\AdminController::class, 'search'])
    ->name('admin.search');