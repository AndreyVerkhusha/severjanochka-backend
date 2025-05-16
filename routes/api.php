<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CartItem\CartItemController;
use App\Http\Controllers\Comment\CommentController;
use App\Http\Controllers\Favorite\FavoriteController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/user', [UserController::class, 'store']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/products', [ProductController::class, 'index']);

Route::group(['middleware' => 'jwt.auth'], function () {
    Route::get('/favorites', [FavoriteController::class, 'index']);
    Route::get('/cart-items', [CartItemController::class, 'index']);
    Route::post('/cart-items', [CartItemController::class, 'store']);
    Route::get('/comments/{id}', [CommentController::class, 'index']);
    Route::post('/comments/{id}', [CommentController::class, 'store']);
    Route::delete('/comments/{id}', [CommentController::class, 'destroy']);
    Route::patch('/comments/{id}', [CommentController::class, 'update']);
    Route::delete('/cart-items', [CartItemController::class, 'destroy']);
    Route::delete('/cart-items/remove-all', [CartItemController::class, 'removeAll']);
    Route::post('/favorites/toggle/{id}', [FavoriteController::class, 'toggleFavorite']);
});
