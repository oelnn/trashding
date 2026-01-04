<?php

use Illuminate\Support\Facades\Route;
use App\Models\TrendingTopic;
use App\Http\Controllers\TrendingWebController;

Route::get('/', [TrendingWebController::class, 'index']);
Route::get('/topic/{keyword}', [TrendingWebController::class, 'show']);


