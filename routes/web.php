<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\IndexController;

Route::get('/', [IndexController::class, 'index'])->name('home');

Route::controller(CategoryController::class)->group(function () {
    Route::get('/categories', 'index')->name('categories.index');
    Route::get('/categories/{category}', 'show')->name('categories.show');
});

Route::resource('products', ProductController::class)
    ->only(['index', 'show'])
    ->parameters(['products' => 'product']);

Route::prefix('cart')->controller(CartController::class)->group(function () {
    Route::post('/add/{product}', 'add')->name('cart.add');
    Route::post('/remove/{product}', 'remove')->name('cart.remove');
    Route::post('/clear', 'clear')->name('cart.clear');
    Route::get('/', 'view')->name('cart.view');
});
