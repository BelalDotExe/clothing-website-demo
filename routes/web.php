<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/categories/womens-wear', [CategoryController::class, 'womensWear']);
Route::view('/admin/login', 'admin.login');
Route::view('/admin/dashboard', 'admin.dashboard');
Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.products');
Route::post('/admin/products', [ProductController::class, 'store'])->name('admin.products.store');
Route::delete('/admin/products/{product}', [ProductController::class, 'delete'])->name('admin.products.delete');
