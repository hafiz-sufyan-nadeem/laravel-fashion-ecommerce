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

Route::middleware([AdminMiddleware::class])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {

        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('products', ProductController::class);

        Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
        Route::post('orders/{order}/update-status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');

    });

// auth views
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');

// auth actions
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// frontend home page
    Route::get('/home', function () {
        return view('frontend.layouts.home');
    })->name('home');

    Route::get('/', [HomeController::class, 'home'])->name('home');

    Route::get('/products/{id}', [HomeController::class, 'show'])->name('products.show');


    Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'viewCart'])->middleware('auth')->name('cart.view');
    Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/delete/{id}', [CartController::class, 'delete'])->name('cart.delete');

    Route::get('/checkout', [CartController::class, 'checkoutForm'])->middleware('auth')->name('checkout.form');

    Route::post('/checkout/store', [CartController::class, 'checkout'])->middleware('auth')->name('checkout.store');


    Route::get('/orders/{order}', [OrderController::class, 'showOrders'])->middleware('auth')->name('orders.show');
    Route::get('/my-orders', [OrderController::class, 'myOrders'])->middleware('auth')->name('my.orders');
});
