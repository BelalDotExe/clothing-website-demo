<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HbNotif extends Model
{
    protected $table = 'hb_notifs';

    protected $fillable = [
        'title',
        'msg',
        'meta',
        'sent_at',
    ];

    protected function casts(): array
    {
        return [
            'meta' => 'array',
            'sent_at' => 'datetime',
        ];
    }
}

