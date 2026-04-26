<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProductController extends Controller
{
    private const CATEGORIES = [
        "Women's Wear",
        "Men's Wear",
        'Accessories',
        'Shoes',
    ];

    public function index(): View
    {
        $products = Product::latest()->get();

        return view('admin.products', compact('products'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'product_id' => ['nullable', 'integer', 'exists:products,id'],
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'category' => ['required', 'string', 'in:'.implode(',', self::CATEGORIES)],
            'on_sale' => ['nullable', 'boolean'],
            'in_stock' => ['nullable', 'boolean'],
            'image' => ['nullable', 'image', 'max:5120'],
            'remove_image' => ['nullable', 'boolean'],
        ]);

        $stock = (int) ($data['stock'] ?? 0);
        $inStock = $stock > 0;
        $payload = [
            'name' => $data['name'],
            'price' => $data['price'],
            'stock' => $stock,
            'category' => $data['category'],
            'on_sale' => (bool) ($data['on_sale'] ?? false),
            'in_stock' => $inStock,
        ];

        $product = null;
        if (!empty($data['product_id'])) {
            $product = Product::find($data['product_id']);
        }

        if ($request->hasFile('image')) {
            if ($product && !empty($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $payload['image'] = $request->file('image')->store('products', 'public');
        } elseif (($data['remove_image'] ?? false) && $product && !empty($product->image)) {
            Storage::disk('public')->delete($product->image);
            $payload['image'] = null;
        }

        if ($product) {
            $product->update($payload);

            return redirect()->route('admin.products')->with('ok', 'Product updated successfully.');
        }

        Product::create($payload);

        return redirect()->route('admin.products')->with('ok', 'Product added successfully.');
    }

    public function delete(Product $product): RedirectResponse
    {
        if (!empty($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products')->with('ok', 'Product deleted successfully.');
    }
}
