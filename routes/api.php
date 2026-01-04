<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TrendingController;

Route::get('/trending', [TrendingController::class, 'index']);
