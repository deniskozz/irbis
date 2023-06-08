<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CallbackController;
use App\Http\Controllers\UserController;


use Illuminate\Support\Facades\Auth;




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

Route::get('/', [MainController::class, 'index'])->name('index');
Route::get('/contact', [MainController::class, 'contact'])->name('contact');

Route::get('/catalog', [CategoryController::class, 'index'])->name('catalog');
Route::get('/catalog/search', [MainController::class, 'search'])->name('search');
Route::get('/catalog/{category}', [CategoryController::class, 'categoryFilter']);
Route::get('/catalog/{category}/{product}', [ProductController::class, 'productPage']);
Route::get('/admin', [MainController::class, 'admin'])->name('admin');

Route::prefix('admin')->group(function () {

    Route::get('/productlist', [ProductController::class, 'index'])->name('productlist');

    Route::get('/create', [ProductController::class, 'create'])->name('create');

    Route::post('/destroy/{id}', [ProductController::class, 'destroy'])->name('destroy');

    Route::post('/store', [ProductController::class, 'store'])->name('store');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders');

    Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('editproduct');

    Route::post('/edit/{id}', [ProductController::class, 'update'])->name('updateproduct');

    Route::put('/orders/{order}/update-status', [OrderController::class, 'updateStatus'])->name('update_status');

    Route::get('/orders/{order}/details', [OrderController::class, 'show'])->name('order_details');
});


Route::get('/cart', [CartController::class, 'cartShow'])->name('cart');
Route::post('/cart/add', [CartController::class, 'add']);
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/{product}', [CartController::class, 'deleteFromCart'])->name('cart.delete');


Route::get('/personal', [UserController::class, 'showPersonalCabinet'])->middleware('auth')->name('personal');
Route::post('/update-profile', [UserController::class, 'updateProfile'])->middleware('auth')->name('updateProfile');
Route::post('/change-password', [UserController::class, 'changePassword'])->middleware('auth')->name('changePassword');


Route::post('/order/place', [OrderController::class, 'placeOrder'])->name('order.place');


Route::post('/callback', [CallbackController::class, 'callback'])->name('callback');


Route::post('/update-cart', 'CartController@updateCart');


Auth::routes();
