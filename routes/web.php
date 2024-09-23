<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\firstPageController;
use App\Http\Controllers\registerController;
use App\Http\Controllers\adminStaffController;
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

Route::view('/','pages.firstPage')->name('firstPage');
Route::view('/login-register','pages.login-register')->name('reg.log');
Route::post('/login-register',[registerController::class, 'store'])->name('reg.log.user');
Route::post('/logout', [registerController::class, 'logout'])->name('logout');
Route::post('/login', [registerController::class, 'login'])->name('login');

//only customer or guess can access order page
Route::middleware(['check.user.type'])->group(function () {
    Route::get('/order',[firstPageController::class, 'order'])->name('order');  //order page
});

//customer
Route::middleware(['auth.check','check.user.type'])->group(function () {
    
    Route::post('/add-cart',[firstPageController::class, 'addToCart'])->name('add.cart');
    Route::post('/update-cart',[firstPageController::class, 'updateCart'])->name('update.cart');
    Route::get('/order/{user}/cart',[firstPageController::class, 'cart'])->name('cart');  //cart page
    Route::get('/order/{user}/cart/checkout',[firstPageController::class, 'checkout'])->name('checkout');  //checkout page
    Route::get('/checkout-clear-item',[firstPageController::class, 'clearItem'])->name('clearItem');
    Route::get('/clear-bill/{id}',[firstPageController::class, 'clearBill'])->name('clearBill');
    Route::get('/get-bill-history',[firstPageController::class, 'viewBillHistory'])->name('viewBillHistory');

});

//admin and staff
Route::middleware(['auth.check','prevent.customer'])->group(function () {

    Route::get('/staff-dashboard/{user}',[adminStaffController::class,'index'])->name('staffPage'); //admin & staff dashboard page
    Route::post('/update-status/{id}', [adminStaffController::class, 'updateBillStatus'])->name('update.status');

    Route::group(['middleware' => ['admin']], function () {
        // Routes that only admins can access
        Route::get('/admin/bill-history', [adminStaffController::class, 'billHistory'])->name('admin.billHistory');

        Route::get('/admin/view-customer-list', [adminStaffController::class, 'viewCustomerList'])->name('admin.customerList');
        Route::delete('/admin/customers-delete/{id}', [adminStaffController::class, 'deleteCustomer'])->name('customers.destroy');
        Route::get('/admin/customers-edit/{id}', [adminStaffController::class, 'editCustomer'])->name(name: 'customers.edit');
        Route::put('/admin/customers-save/{id}', [adminStaffController::class, 'saveCustomer'])->name('customers.save');

        Route::get('/admin/view-staff-list', [adminStaffController::class, 'viewStaffList'])->name('admin.staffList');
        Route::delete('/admin/staff-delete/{id}', [adminStaffController::class, 'deleteStaff'])->name('staff.destroy');
        Route::get('/admin/staff-edit/{id}', [adminStaffController::class, 'editStaff'])->name(name: 'staff.edit');
        Route::put('/admin/staff-update/{id}', [adminStaffController::class, 'saveStaff'])->name('staff.save');
        Route::post('/admin/staff-store', [adminStaffController::class, 'storeStaff'])->name('staff.store');
        Route::view('/admin/create-staff','pages.staffCreatePage')->name('staff.view.store');
    });
});