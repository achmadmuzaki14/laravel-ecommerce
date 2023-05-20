<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PDFController;

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

Route::get('/', function () {
    return view('auth.login');
});

Route::group(['middleware' => ['auth']], function () {

    //CRUD Category
    Route::get('/category', [CategoryController::class, 'index']);
    Route::post('/category', [CategoryController::class, 'store']);
    Route::delete('/category/{id}', [CategoryController::class, 'destroy']);
    Route::get('/category/{id}/edit', [CategoryController::class, 'edit']);
    Route::patch('/category/{id}', [CategoryController::class, 'update']);

    //CRUD Product
    Route::get('product', [ProductController::class, 'index']);
    Route::get('product/create', [ProductController::class, 'create']);
    Route::post('product', [ProductController::class, 'store']);
    Route::get('product/edit', [ProductController::class, 'edit']);
    Route::post('product/{product_id}', [ProductController::class, 'update']);
    Route::get('product/{product_id}/show', [ProductController::class, 'show']);
    Route::resource('product', ProductController::class);

    //CRUD Profile
    Route::get('/profile/{id}/show', [ProfileController::class, 'index']);
    Route::patch('/profile/{id}', [ProfileController::class, 'update']);

    //Customer
    Route::get('/products', [CustomerController::class, 'index']);
    Route::get('/search-products={product_name}', [ProductController::class, 'search']);
    Route::get('/products/category/{category_id}', [CategoryController::class, 'showProductByCategory']);
    Route::get('/myorders', [CustomerController::class, 'order_index']);

    //Cart
    Route::post('/add-to-cart/{user_id}/{product_id}', [CartController::class, 'addToCart']);
    Route::post('/subtract-quntity/{user_id}/{product_id}', [CartController::class, 'subtractCartItemQuantity']);
    Route::post('/add-quntity/{user_id}/{product_id}', [CartController::class, 'addCartItemQuantity']);

    //Order
    Route::get('/checkout', [OrderController::class, 'index']);
    Route::post('/order', [OrderController::class, 'store']);

    //PDF
    Route::get('/download-invoice/{order_id}', [PDFController::class, 'generatePDF']);
});

Auth::routes();

