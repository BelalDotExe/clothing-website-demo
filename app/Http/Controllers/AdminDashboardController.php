<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function index(): View
    {
        $totalRevenue = (float) Order::sum('total_amount');
        $totalItemsSold = (int) Order::sum('total_items');
        $inventoryItems = (int) Product::sum('stock');
        $categoriesCount = (int) Category::count();

        return view('admin.dashboard', compact(
            'totalRevenue',
            'totalItemsSold',
            'inventoryItems',
            'categoriesCount'
        ));
    }
}
