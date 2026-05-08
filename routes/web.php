<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $trendingProducts = Product::with('categoryRelation')
        ->orderBy('id')
        ->take(4)
        ->get()
        ->map(function (Product $product) {
            $product->category = $product->categoryRelation?->name ?? (string) ($product->category ?? '');
            return $product;
        });

    return view('welcome', compact('trendingProducts'));
});

Route::get('/categories/womens-wear', [CategoryController::class, 'womensWear'])->name('categories.index');
Route::get('/cart', [CategoryController::class, 'cart'])->name('cart');
Route::post('/checkout', [CategoryController::class, 'checkout'])->name('checkout');

// if no session exists, come here
Route::middleware('adm.guest')->group(function () {
    Route::get('/admin/login', [AdminAuthController::class, 'show'])->name('admin.login');
    Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
});
// if session exist, only then permit this
Route::middleware('adm.auth')->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/products', [ProductController::class, 'index'])->name('admin.products');
    Route::post('/products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/products/{product}', [ProductController::class, 'delete'])->name('admin.products.delete');
    Route::get('/categories', [AdminCategoryController::class, 'index'])->name('admin.categories');
    Route::post('/categories', [AdminCategoryController::class, 'store'])->name('admin.categories.store');
    Route::delete('/categories/{category}', [AdminCategoryController::class, 'destroy'])->name('admin.categories.destroy');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});
