<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\ProductController;



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


Route::get('products/categories', [ProductController::class, 'categories']);
Route::get('products/get_all_products', [ProductController::class, 'get_all_products']);
Route::post('products/get_products', [ProductController::class, 'get_products']);
Route::get('test', [ProductController::class, 'index']);
