<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::prefix('dashboard')->middleware('role:admin')->group(function () {

    Route::get('/users', [\App\Http\Controllers\Admin\User\UserController::class, 'index'])
        ->name('users.index');

    Route::get('/orders', [\App\Http\Controllers\Admin\Order\OrderController::class, 'index'])
        ->name('orders.index');

});

require __DIR__.'/auth.php';
