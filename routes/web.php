<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminCustomerController;
use App\Http\Controllers\MessageController;

// ================== ADMIN ROUTES ==================
Route::middleware([AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', ProductController::class);

    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::post('orders/{order}/update-status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');

    Route::get('/customers', [AdminCustomerController::class, 'index'])->name('customers.index');
    Route::get('/customers/{id}', [AdminCustomerController::class, 'show'])->name('customers.show');

    Route::resource('categories', \App\Http\Controllers\AdminCategoryController::class);


    Route::get('/messages', [MessageController::class, 'index'])->name('messages');
    Route::get('/messages', [MessageController::class, 'index'])->name('messages');
    Route::get('/messages/{id}', [MessageController::class, 'show'])->name('messages.show');
    Route::post('/messages/{id}/reply', [MessageController::class, 'reply'])->name('messages.reply');

    Route::post('/messages/{id}/reply', [MessageController::class, 'reply'])->name('messages.reply');

});


// ================== AUTH ROUTES ==================
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ================== FRONTEND ROUTES ==================
//Route::get('/home', function () {
//    return view('frontend.layouts.home');
//})->name('home');

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/products/{id}', [HomeController::class, 'show'])->name('products.show');

// Cart
Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'viewCart'])->middleware('auth')->name('cart.view');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/delete/{id}', [CartController::class, 'delete'])->name('cart.delete');

// Checkout
Route::get('/checkout', [CartController::class, 'checkoutForm'])->middleware('auth')->name('checkout.form');
Route::post('/checkout/store', [CartController::class, 'checkout'])->middleware('auth')->name('checkout.store');

// Orders
Route::get('/orders/{order}', [OrderController::class, 'showOrders'])->middleware('auth')->name('orders.show');
Route::get('/my-orders', [OrderController::class, 'myOrders'])->middleware('auth')->name('my.orders');


// Contact form/MSG's
Route::get('/contact-admin', [App\Http\Controllers\MessageController::class, 'create'])->name('contact.admin');
Route::post('/contact-admin/store', [App\Http\Controllers\MessageController::class, 'store'])->name('contact.admin.store');


Route::middleware('auth')->group(function () {
    Route::get('/my-messages', [MessageController::class, 'userMessages'])
        ->name('user.messages');
});

