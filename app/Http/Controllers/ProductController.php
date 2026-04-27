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
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'category' => ['required', 'string', 'in:'.implode(',', self::CATEGORIES)],
            'on_sale' => ['nullable', 'boolean'],
            'in_stock' => ['nullable', 'boolean'],
            'image' => ['nullable', 'image', 'max:5120'],
            'discount' => ['required', 'integer', 'min:0', 'max:100'],
        ]);

        $stock = (int) ($data['stock'] ?? 0);
        $discount = (int) ($data['discount'] ?? 0);
        $inStock = $stock > 0;
        $payload = [
            'name' => $data['name'],
            'price' => $data['price'],
            'stock' => $stock,
            'category' => $data['category'],
            'discount' => $discount,
            'on_sale' => $discount > 0,
            'in_stock' => $inStock,
        ];

        if ($request->hasFile('image')) {
            $payload['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($payload);

        return redirect()->route('admin.products')->with('ok', 'Product added successfully.');
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'category' => ['required', 'string', 'in:'.implode(',', self::CATEGORIES)],
            'on_sale' => ['nullable', 'boolean'],
            'in_stock' => ['nullable', 'boolean'],
            
            // image validations here (MIME)
            'image' => ['nullable',
            File::image()
            ->types(['jpg','png','jpeg','webp']),
             'extensions:jpg,jpeg,png,webp',
             'max:5120'],
            'remove_image' => ['nullable', 'boolean'],
            'discount' => ['required', 'integer', 'min:0', 'max:100'],
        ]);

        $stock = (int) ($data['stock'] ?? 0);
        $discount = (int) ($data['discount'] ?? 0);
        $inStock = $stock > 0;
        $payload = [
            'name' => $data['name'],
            'price' => $data['price'],
            'stock' => $stock,
            'category' => $data['category'],
            'discount' => $discount,
            'on_sale' => $discount > 0,
            'in_stock' => $inStock,
        ];

        if ($request->hasFile('image')) {
            if (!empty($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $payload['image'] = $request->file('image')->store('products', 'public');
        } elseif (($data['remove_image'] ?? false) && !empty($product->image)) {
            Storage::disk('public')->delete($product->image);
            $payload['image'] = null;
        }

        $product->update($payload);

        return redirect()->route('admin.products')->with('ok', 'Product updated successfully.');
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
