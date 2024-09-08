<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\firstPageController;
use App\Http\Controllers\registerController;
use App\Models\User;

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

Route::view('/login-register','pages.login-register')->name('reg.log');
Route::post('/login-register',[registerController::class, 'store'])->name('reg.log.user');
Route::post('/logout', [registerController::class, 'logout'])->name('logout');
Route::post('/login', [registerController::class, 'login'])->name('login');
Route::get('/order',[firstPageController::class, 'order'])->name('order');

Route::middleware(['auth.check'])->group(function () {
    
    Route::post('/add-cart',[firstPageController::class, 'addToCart'])->name('add.cart');
    Route::post('/update-cart',[firstPageController::class, 'updateCart'])->name('update.cart');
    Route::get('/order/{user}/cart',[firstPageController::class, 'cart'])->name('cart');
    Route::get('/order/{user}/cart/checkout',[firstPageController::class, 'checkout'])->name('checkout');
    Route::get('/checkout-clear-item',[firstPageController::class, 'clearItem'])->name('clearItem');
});
