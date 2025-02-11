<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ReservationController;
use App\Http\Controllers\Api\OrderController;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/auth/register', [UserController::class, 'createUser']);
Route::post('/auth/login', [UserController::class, 'loginUser']);

Route::apiResource('products',ProductController::class);
Route::apiResource('reservations',ReservationController::class);

Route::get('/fetch-products', [ProductController::class, 'fetchProducts'])->name('products.fetch');
Route::get('/product-details/{id}', [ProductController::class, 'show'])->name('products.show');

Route::prefix('orders')->group(function () {
    Route::get('/', [OrderController::class, 'index']); 
    Route::post('/', [OrderController::class, 'store']); 
    Route::get('/{id}', [OrderController::class, 'show']); 
    Route::put('/{id}', [OrderController::class, 'update']);
    Route::delete('/{id}', [OrderController::class, 'destroy']);});
