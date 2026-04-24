<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/categories/womens-wear', 'categories.womens-wear');
Route::view('/admin/login', 'admin.login');
Route::view('/admin/dashboard', 'admin.dashboard');
Route::view('/admin/products', 'admin.products');
