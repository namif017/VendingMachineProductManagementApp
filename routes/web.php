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

Route::get('/', [App\Http\Controllers\ProductsController::class, 'showAllProducts']);

Route::get('/products', [App\Http\Controllers\ProductsController::class, 'showAllProducts'])->name('products');
Route::post('/products', [App\Http\Controllers\ProductsController::class, 'showSearchedProducts'])->name('search');
