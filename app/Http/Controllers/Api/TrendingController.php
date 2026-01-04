<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TrendingTopic;

class TrendingController extends Controller
{
    public function index()
{
    return response()->json([
        'app' => 'Trashding',
        'updated_at' => now(),
        'data' => TrendingTopic::orderByDesc('score')->limit(20)->get()
    ]);
}
}
