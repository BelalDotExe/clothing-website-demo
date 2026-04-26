<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function womensWear(): View
    {
        $products = Product::latest()->get();

        return view('categories.womens-wear', compact('products'));
    }
}
