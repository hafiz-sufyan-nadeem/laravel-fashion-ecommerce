<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

Route::middleware([AdminMiddleware::class])->group(function () {
    Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('products', ProductController::class);
    });

});

// auth views
Route::get('/login', function () {
    return view('auth.login');
})->name('auth.login');

Route::get('/register', function () {
    return view('auth.register');
})->name('auth.register');

// auth actions
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// frontend home page
Route::get('/home', function (){
    return view('frontend.layouts.home');
})->name('home');

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/products/{id}', [HomeController::class, 'show'])->name('products.show');



Route::middleware('auth')->group(function() {
    Route::post('/cart/add', [CartController::class,'add'])->name('cart.add');     // AJAX-friendly
    Route::get('/cart', [CartController::class,'index'])->name('cart.index');     // full cart page
    Route::get('/cart/mini', [CartController::class,'mini'])->name('cart.mini');   // offcanvas partial HTML
    Route::post('/cart/{cartItem}/update', [CartController::class,'update'])->name('cart.update');
    Route::post('/cart/{cartItem}/remove', [CartController::class,'remove'])->name('cart.remove');
    Route::post('/cart/clear', [CartController::class,'clear'])->name('cart.clear');

    // Checkout (simple)
    Route::get('/checkout', [CheckoutController::class,'show'])->name('checkout.show');
    Route::post('/checkout', [CheckoutController::class,'process'])->name('checkout.process');
});
