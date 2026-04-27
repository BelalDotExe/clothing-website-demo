<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/categories/womens-wear', [CategoryController::class, 'womensWear']);

// if no session exists, come here
Route::middleware('adm.guest')->group(function () {
    Route::get('/admin/login', [AdminAuthController::class, 'show'])->name('admin.login');
    Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
});
// if session exist, only then permit this
Route::middleware('adm.auth')->prefix('admin')->group(function () {
    Route::view('/dashboard', 'admin.dashboard')->name('admin.dashboard');
    Route::get('/products', [ProductController::class, 'index'])->name('admin.products');
    Route::post('/products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/products/{product}', [ProductController::class, 'delete'])->name('admin.products.delete');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});
