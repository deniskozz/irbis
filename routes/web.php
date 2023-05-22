<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CallbackController;


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
    Route::get('/productlist', [ProductController::class, 'index'])
        ->name('productlist');

    Route::get('/create', [ProductController::class, 'create'])
        ->name('create');

    Route::post('/destroy/{id}', [ProductController::class, 'destroy'])
        ->name('destroy');

    Route::post('/store', [ProductController::class, 'store'])
        ->name('store');

    // Маршрут для отображения страницы редактирования продукта
    Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('editproduct');

    // Маршрут для обработки запроса на редактирование продукта
    Route::post('/edit/{id}', [ProductController::class, 'update'])->name('updateproduct');
});

Route::get('/cart', [CartController::class, 'cartShow']);
Route::post('/cart/add', [CartController::class, 'add']);
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');



Route::post('/callback', [CallbackController::class, 'callback'])->name('callback');


Auth::routes();
