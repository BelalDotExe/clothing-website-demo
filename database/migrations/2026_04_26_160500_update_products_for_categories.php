<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'stock')) {
                $table->integer('stock')->default(0)->after('price');
            }

            if (!Schema::hasColumn('products', 'category')) {
                $table->string('category')->default("Women's Wear")->after('stock');
            }

            if (!Schema::hasColumn('products', 'on_sale')) {
                $table->boolean('on_sale')->default(false)->after('category');
            }
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'on_sale')) {
                $table->dropColumn('on_sale');
            }

            if (Schema::hasColumn('products', 'category')) {
                $table->dropColumn('category');
            }

            if (Schema::hasColumn('products', 'stock')) {
                $table->dropColumn('stock');
            }
        });
    }
};
