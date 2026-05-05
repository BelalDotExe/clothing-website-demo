<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function womensWear(): View
    {
        $products = Product::latest()->get();

        return view('pages.categories.show', compact('products'));
    }

    public function cart(): View
    {
        return view('pages.cart');
    }
}
