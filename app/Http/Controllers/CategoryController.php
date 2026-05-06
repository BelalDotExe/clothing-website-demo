<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function womensWear(): View
    {
        $products = Product::with('categoryRelation')->latest()->get()->map(function (Product $product) {
            $product->category = $product->categoryRelation?->name ?? (string) ($product->category ?? '');
            return $product;
        });
        $categories = Category::orderBy('name')->get();

        return view('categories.womens-wear', compact('products', 'categories'));
    }

    public function cart(): View
    {
        return view('categories.cart');
    }

    public function checkout(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'items' => ['required', 'array', 'min:1'],
            'items.*.id' => ['required', 'integer', 'min:1'],
            'items.*.qty' => ['required', 'integer', 'min:1'],
        ]);

        $requested = collect($validated['items'])
            ->groupBy(fn (array $item) => (int) $item['id'])
            ->map(fn ($group) => (int) $group->sum('qty'));

        return DB::transaction(function () use ($requested) {
            $productIds = $requested->keys()->all();
            $products = Product::whereIn('id', $productIds)->lockForUpdate()->get()->keyBy('id');

            $outOfStock = [];
            foreach ($requested as $productId => $qty) {
                /** @var Product|null $product */
                $product = $products->get((int) $productId);
                $available = $product ? max(0, (int) $product->stock) : 0;

                if (!$product || $available < (int) $qty) {
                    $outOfStock[] = [
                        'id' => (int) $productId,
                        'name' => $product ? (string) $product->name : 'Unknown Product',
                        'requested' => (int) $qty,
                        'available' => $available,
                    ];
                }
            }

            if (!empty($outOfStock)) {
                return response()->json([
                    'message' => 'Some items are out of stock or no longer available.',
                    'out_of_stock' => $outOfStock,
                ], 422);
            }

            $orderItems = [];
            $totalItems = 0;
            $totalAmount = 0.0;

            foreach ($requested as $productId => $qty) {
                /** @var Product $product */
                $product = $products->get((int) $productId);
                $lineTotal = ((float) $product->price) * (int) $qty;

                $orderItems[] = [
                    'product_id' => (int) $product->id,
                    'name' => (string) $product->name,
                    'price' => (float) $product->price,
                    'qty' => (int) $qty,
                    'line_total' => round($lineTotal, 2),
                ];

                $totalItems += (int) $qty;
                $totalAmount += $lineTotal;

                $product->stock = max(0, (int) $product->stock - (int) $qty);
                $product->in_stock = $product->stock > 0;
                $product->save();
            }

            $orderPayload = [
                'id' => null,
                'order_number' => null,
                'ordered_at' => now()->toDateTimeString(),
                'total_items' => $totalItems,
                'total_amount' => round($totalAmount, 2),
            ];

            if (Schema::hasTable('orders')) {
                $order = Order::create([
                    'order_number' => 'ORD-'.now()->format('YmdHis').'-'.Str::upper(Str::random(4)),
                    'total_items' => $totalItems,
                    'total_amount' => round($totalAmount, 2),
                    'items' => $orderItems,
                    'ordered_at' => now(),
                ]);

                $toEmail = (string) config('mail.from.address');
                if ($toEmail !== '') {
                    try {
                        Mail::raw(
                            "Your order has been placed successfully.\n\nOrder Number: {$order->order_number}\nItems: {$order->total_items}\nTotal: $".number_format((float) $order->total_amount, 2)."\nDate: ".optional($order->ordered_at)->toDateTimeString(),
                            function ($message) use ($toEmail, $order): void {
                                $message->to($toEmail)->subject('Order Confirmation - '.$order->order_number);
                            }
                        );
                    } catch (\Throwable $mailError) {
                        Log::warning('Order confirmation email failed to send.', [
                            'order_id' => $order->id,
                            'error' => $mailError->getMessage(),
                        ]);
                    }
                }

                $orderPayload = [
                    'id' => $order->id,
                    'order_number' => $order->order_number,
                    'ordered_at' => optional($order->ordered_at)->toDateTimeString(),
                    'total_items' => $order->total_items,
                    'total_amount' => (float) $order->total_amount,
                ];
            }

            return response()->json([
                'message' => 'Order placed successfully.',
                'order' => $orderPayload,
            ]);
        });
    }
}
