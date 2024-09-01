<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\firstPageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', [firstPageController::class, 'index'])->name('firstPage');
Route::view('/','pages.firstPage')->name('firstPage');

Route::get('/order',[firstPageController::class, 'order'])->name('order');
Route::post('/add-cart',[firstPageController::class, 'addToCart'])->name('add.cart');
Route::post('/update-cart',[firstPageController::class, 'updateCart'])->name('update.cart');

Route::get('/cart',[firstPageController::class, 'cart'])->name('cart');
Route::get('/checkout',[firstPageController::class, 'checkout'])->name('checkout');
Route::get('/checkout-clear-item',[firstPageController::class, 'clearItem'])->name('clearItem');
