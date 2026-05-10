<?php

namespace App\Http\Controllers;

use App\Models\HbNotif;
use Illuminate\Http\JsonResponse;

class HbNotifController extends Controller
{
    public function list(): JsonResponse
    {
        $items = HbNotif::query()
            ->latest('sent_at')
            ->latest('id')
            ->take(20)
            ->get(['id', 'title', 'msg', 'meta', 'sent_at']);

        return response()->json([
            'count' => HbNotif::count(),
            'items' => $items,
        ]);
    }

    public function clear(): JsonResponse
    {
        HbNotif::query()->delete();

        return response()->json([
            'ok' => true,
        ]);
    }
}

