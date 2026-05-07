<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminCategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::withCount('products')->orderBy('name')->get();

        return view('admin.categories', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:categories,name'],
        ]);

        Category::create([
            'name' => trim($data['name']),
        ]);

        return redirect()->route('admin.categories')->with('ok', 'Category added successfully.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $productCount = $category->products()->count();
        if ($productCount > 0) {
            return redirect()
                ->route('admin.categories')
                ->with('error', 'Cannot delete category with existing products. Move products first.');
        }

        $category->delete();

        return redirect()->route('admin.categories')->with('ok', 'Category deleted successfully.');
    }
}
