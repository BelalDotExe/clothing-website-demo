<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'category_id')) {
                $table->foreignId('category_id')->nullable()->after('category')->constrained()->nullOnDelete();
            }
        });

        if (Schema::hasTable('categories')) {
            $categoryMap = DB::table('categories')->pluck('id', 'name');
            $products = DB::table('products')->select('id', 'category')->get();

            foreach ($products as $product) {
                $name = (string) ($product->category ?? '');
                $categoryId = $categoryMap[$name] ?? null;

                if (!$categoryId && $name !== '') {
                    $categoryId = DB::table('categories')->insertGetId([
                        'name' => $name,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    $categoryMap[$name] = $categoryId;
                }

                DB::table('products')
                    ->where('id', $product->id)
                    ->update(['category_id' => $categoryId]);
            }
        }
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'category_id')) {
                $table->dropConstrainedForeignId('category_id');
            }
        });
    }
};
