<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CustomerApiController;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\OrderApiController;

// Public API - no auth required for read
Route::apiResource('customers', CustomerApiController::class)->only(['index', 'show']);
Route::apiResource('products', ProductApiController::class)->only(['index', 'show']);
Route::apiResource('orders', OrderApiController::class)->only(['index', 'show']);

// Protected API routes
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('customers', CustomerApiController::class)->except(['index', 'show']);
    Route::apiResource('products', ProductApiController::class)->except(['index', 'show']);
    Route::apiResource('orders', OrderApiController::class)->except(['index', 'show']);
});
