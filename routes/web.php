<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// ==================== PUBLIC ROUTES ====================
// Homepage
Route::get('/', function () {
    return view('pages.home');
})->name('home');

// Category pages
Route::get('/categories/womens-wear', [CategoryController::class, 'womensWear'])->name('category.womens-wear');

// Shopping cart
Route::get('/cart', [CategoryController::class, 'cart'])->name('cart');

// ==================== ADMIN ROUTES (GUEST) ====================
// These routes are accessible only when NOT logged in
Route::middleware('adm.guest')->group(function () {
    Route::get('/admin/login', [AdminAuthController::class, 'show'])->name('admin.login');
    Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
});

// ==================== ADMIN ROUTES (AUTHENTICATED) ====================
// These routes require admin authentication
Route::middleware('adm.auth')->prefix('admin')->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Products management
    Route::get('/products', [ProductController::class, 'index'])->name('admin.products');
    Route::post('/products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/products/{product}', [ProductController::class, 'delete'])->name('admin.products.delete');

    // Logout
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});
