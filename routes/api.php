<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OrderController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Order API Routes
Route::prefix('orders')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [OrderController::class, 'index']);           // GET /api/orders - List all orders
    Route::post('/', [OrderController::class, 'store']);           // POST /api/orders - Create order
    Route::get('/{order}', [OrderController::class, 'show']);       // GET /api/orders/{id} - Get single order
    Route::put('/{order}/cancel', [OrderController::class, 'cancel']); // PUT /api/orders/{id}/cancel - Cancel order
    Route::put('/{order}', [OrderController::class, 'update']);    // PUT /api/orders/{id} - Update order
    Route::delete('/{order}', [OrderController::class, 'destroy']); // DELETE /api/orders/{id} - Delete order
});

