<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Basket\BasketController;
use App\Http\Controllers\Api\Category\CategoryController;
use App\Http\Controllers\Api\File\ImageController;
use App\Http\Controllers\Api\Product\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/auth/register', [AuthController::class, 'createUser']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);

Route::get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('admin')->resource('category', CategoryController::class);
Route::middleware('admin')->resource('product', ProductController::class);
Route::post('add/basket', [BasketController::class, 'inBasket']);
Route::get('basket', [BasketController::class, 'index']);
Route::post('delete/product/basket', [BasketController::class, 'deleteProductInBasket']);
Route::post('upload/image', [ImageController::class, 'upload']);
Route::post('images/product', [ProductController::class, 'addImage']);
