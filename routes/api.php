<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\DiscountsController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login', [ApiController::class, 'login']);

/**
 * Product
 */
Route::get('/products', [ProductsController::class, 'index'])->middleware('auth:api');
Route::get('/products/{id}', [ProductsController::class, 'show'])->middleware('auth:api');
Route::post('/products', [ProductsController::class, 'store'])->middleware('auth:api');

/**
 * Order
 */
Route::get('/orders', [OrdersController::class, 'index'])->middleware('auth:api');
Route::get('/orders/{id}', [OrdersController::class, 'show'])->middleware('auth:api');
Route::post('/orders', [OrdersController::class, 'store'])->middleware('auth:api');
Route::post('/orders/delete/{id}', [OrdersController::class, 'delete'])->middleware('auth:api');

/**
 * Discount
 */
Route::post('/discount', [DiscountsController::class, 'discountCalculate'])->middleware('auth:api');

