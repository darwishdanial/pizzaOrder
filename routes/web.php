<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\customerController;
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

Route::view('/','customerPage.firstPage')->name('firstPage');
Route::view('/login-register','customerPage.loginRegister')->name('reg.log');
Route::post('/login-register',[registerController::class, 'store'])->name('reg.log.user');
Route::post('/logout', [registerController::class, 'logout'])->name('logout');
Route::post('/login', [registerController::class, 'login'])->name('login');

//only customer or guess can access order page
Route::middleware(['prevent.staffAdmin'])->group(function () {
    Route::get('/order',[customerController::class, 'order'])->name('order');  //order page
});

//customer
Route::middleware(['auth.check','prevent.staffAdmin'])->group(function () {
    
    Route::post('/add-cart',[customerController::class, 'addToCart'])->name('add.cart');
    Route::post('/update-cart',[customerController::class, 'updateCart'])->name('update.cart');
    Route::get('/order/{user}/cart',[customerController::class, 'cart'])->name('cart');  //cart page
    Route::get('/order/{user}/cart/checkout',[customerController::class, 'checkout'])->name('checkout');  //checkout page
    Route::get('/delivery-status',[customerController::class, 'viewDeliveryStatus'])->name('deliveryStatus'); //delivery status page
    Route::get('/checkout-clear-item',[customerController::class, 'clearItem'])->name('clearItem');
    Route::get('/clear-bill/{id}',[customerController::class, 'clearBill'])->name('clearBill');
    Route::get('/get-bill-history',[customerController::class, 'viewBillHistory'])->name('viewBillHistory'); //bill history page

});

//admin and staff
Route::middleware(['auth.check','prevent.customer'])->group(function () {

    Route::get('/staff-dashboard/{user}',[adminStaffController::class,'index'])->name('staffPage'); //admin & staff dashboard page
    Route::post('/update-status/{id}', [adminStaffController::class, 'updateBillStatus'])->name('update.status');

    Route::group(['middleware' => ['admin']], function () {
        // Routes that only admins can access
        Route::get('/admin/bill-history', [adminStaffController::class, 'billHistory'])->name('admin.billHistory'); //bill history page

        Route::get('/admin/customer-view-list', [adminStaffController::class, 'viewCustomerList'])->name('admin.customerList'); //customer list page
        Route::delete('/admin/customers-delete/{id}', [adminStaffController::class, 'deleteCustomer'])->name('customers.destroy');
        Route::get('/admin/customers-edit/{id}', [adminStaffController::class, 'editCustomer'])->name(name: 'customers.edit'); //customer edit page
        Route::put('/admin/customers-save/{id}', [adminStaffController::class, 'saveCustomer'])->name('customers.save');

        Route::get('/admin/staff-view-list', [adminStaffController::class, 'viewStaffList'])->name('admin.staffList'); //staff list page
        Route::delete('/admin/staff-delete/{id}', [adminStaffController::class, 'deleteStaff'])->name('staff.destroy');
        Route::get('/admin/staff-edit/{id}', [adminStaffController::class, 'editStaff'])->name(name: 'staff.edit'); //staff edit page
        Route::put('/admin/staff-update/{id}', [adminStaffController::class, 'saveStaff'])->name('staff.save');
        Route::post('/admin/staff-store', [adminStaffController::class, 'storeStaff'])->name('staff.store');
        Route::view('/admin/staff-create','adminStaffPage.staffCreatePage')->name('staff.view.store'); //store staff page
    });
});