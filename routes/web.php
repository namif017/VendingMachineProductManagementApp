<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductsController;
use App\Http\Controllers\AddProductController;
use App\Http\Controllers\ProductDetealController;
use App\Http\Controllers\EditProductController;
use App\Http\Controllers\HomeController;

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

Route::get('/', [ProductsController::class, 'showProducts']);

Route::get('/products', [ProductsController::class, 'showProducts'])->name('products');
Route::post('/products/filteredProducts', [ProductsController::class, 'getFilteredProducts'])->name('filteredProducts');
Route::post('/products/deleteProduct', [ProductsController::class, 'deleteProduct'])->name('deleteProduct');

Route::get('/newProdct', [AddProductController::class, 'showAddProduct'])->name('addProduct');
Route::post('/newProdct', [AddProductController::class, 'registProduct'])->name('registProduct');

Route::get('/prodctDeteal', [ProductDetealController::class, 'showProductDeteal'])->name('productDeteal');

Route::get('/editProdct', [EditProductController::class, 'showEditProduct'])->name('editProduct');
Route::post('/editProdct', [EditProductController::class, 'editProduct'])->name('submitEditProduct');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
