<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'total_items',
        'total_amount',
        'items',
        'ordered_at',
    ];

    protected $casts = [
        'items' => 'array',
        'ordered_at' => 'datetime',
    ];
}
