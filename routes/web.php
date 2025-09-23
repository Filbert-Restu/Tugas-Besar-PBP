<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;

// Landing Page
Route::get('/', [MainController::class, 'index'])->name('main');
Route::get('/products/{id}', [MainController::class, 'show'])->name('main.show');
Route::get('/search', [SearchController::class, 'index'])->name('search');
// Auth


Route::middleware('guest')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('/login', 'viewLogin')->name('login');
        Route::post('/login', 'inLogin');
        Route::get('/register', 'viewRegister')->name('register');
        Route::post('/register', 'inRegister');
    });
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // role admin
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
            // // Dashboard untuk admin

            // Route::controller(AdminController::class)->group(function () {
            //     Route::get('/dashboard', 'dashboard')->name('dashboard');
            //     // Route::get('/users', 'users')->name('users.index');
            //     // Route::delete('/users/{user}', 'destroyUser')->name('users.destroy');
            // });

            // Route::get('/products', [ProductController::class, 'index'])->name('products.index');
            // Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

            // // // Cart
            // Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
            // // Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
            // // Route::delete('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');

            // // // Orders
            // // Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
            // // Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');

            // // Route::resource('products', ProductController::class)->except(['show']);
            // // Route::resource('categories', CategoryController::class);
            // Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
            // // Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    });

    // role user
    Route::middleware('role:user')->group(function () {
        // user controller
        Route::controller(UserController::class)->group(function () {
            Route::get('/user/settings', 'index')->name('user.index');
        });


        // cart controller
        Route::controller(CartController::class)->group(function () {
            Route::get('/cart', 'index')->name('cart.index');
            Route::post('/cart/add/{product}', 'add')->name('cart.add');
            Route::delete('/cart/remove/{product}', 'remove')->name('cart.remove');
        });
        // hapus data keranjang
        // buat pesanan
        // Route::get('/', [DashboardController::class, 'index'])->name('user.dashboard');
    });
});
