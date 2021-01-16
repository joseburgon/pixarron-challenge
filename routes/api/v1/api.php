<?php

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

Route::post('/register', [\App\Http\Controllers\api\v1\AuthController::class, 'register'])
    ->name('register');

Route::post('/login', [\App\Http\Controllers\api\v1\AuthController::class, 'login'])
    ->name('login');

Route::get('/posts', [\App\Http\Controllers\api\v1\post\PostController::class, 'index'])
    ->name('posts');

Route::name('api.v1.')->middleware('auth:api')->group(function () {

    Route::apiResource('users', \App\Http\Controllers\api\v1\user\UserController::class)
        ->except('store', 'update', 'destroy');

    Route::apiResource('addresses', \App\Http\Controllers\api\v1\address\AddressController::class)
        ->except('store', 'update', 'destroy');

    Route::apiResource('orders', \App\Http\Controllers\api\v1\order\OrderController::class)
        ->except('store', 'update', 'destroy');

    Route::apiResource('products', \App\Http\Controllers\api\v1\product\ProductController::class)
        ->except('store', 'update', 'destroy');

});


