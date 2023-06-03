<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductsController;

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

Route::get('/', [ProductsController::class, 'showAllProducts']);

Route::get('/products', [ProductsController::class, 'showProducts'])->name('products');
Route::post('/products/filteredProducts', [ProductsController::class, 'getFilteredProducts'])->name('filteredProducts');
Route::post('/products/deleteProduct', [ProductsController::class, 'deleteProduct'])->name('deleteProduct');

Route::get('/newProdct', [App\Http\Controllers\AddProductController::class, 'showAddProduct'])->name('addProduct');
Route::post('/newProdct', [App\Http\Controllers\AddProductController::class, 'registProduct'])->name('registProduct');

Route::get('/prodctDeteal', [App\Http\Controllers\ProductDetealController::class, 'showProductDeteal'])->name('productDeteal');

Route::get('/editProdct', [App\Http\Controllers\EditProductController::class, 'showEditProduct'])->name('editProduct');
Route::post('/editProdct', [App\Http\Controllers\EditProductController::class, 'editProduct'])->name('submitEditProduct');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
