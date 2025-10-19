<?php
// livewire
use App\Livewire\CartPage;

// Main Controller
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CheckoutController;

// Admin Controller
// use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminOrderController;


// Landing Page
Route::middleware('main')->group(function () {
    Route::get('/', [MainController::class, 'index'])->name('main');
    Route::get('/products/{id}', [MainController::class, 'show'])->name('main.show');
    Route::get('/search', [SearchController::class, 'index'])->name('search');
});

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

            Route::controller(AdminDashboardController::class)->group(function () {
                Route::get('/dashboard', 'dashboard')->name('dashboard');
            });

            Route::controller(AdminProductController::class)->group(function () {
                Route::get('/products', 'index')->name('products.index');
                Route::get('/products/add', 'create')->name('products.add');
                Route::post('/products', 'store')->name('products.store');
                Route::get('/products/{product}/edit', 'edit')->name('products.edit');
                Route::put('/products/{product}', 'update')->name('products.update');
                Route::delete('/products/{product}', 'destroy')->name('products.destroy');
            });


            // order admin
            Route::controller(AdminOrderController::class)->group(function () {
                Route::get('/orders', 'index')->name('orders.index');
                Route::get('/orders/{id}', 'show')->name('orders.show');
                Route::put('/orders/{id}/status', 'updateStatus')->name('orders.updateStatus');
                Route::delete('/orders/{id}', 'destroy')->name('orders.destroy');
                Route::get('/orders/export', 'exportOrders')->name('orders.export');
                Route::post('/orders/bulk-update', 'bulkUpdateStatus')->name('orders.bulkUpdate');
            });

            // admin categories
            Route::controller(AdminCategoryController::class)->group(function () {
                Route::get('/categories', 'index')->name('categories.index');

            });

            // user admin
            Route::controller(UserController::class)->group(function () {
                Route::get('/users', 'index')->name('users.index');
                // Route::delete('/users/{user}', 'destroy')->name('users.destroy');
            });
    });

    // role user
    Route::middleware('role:user')->group(function () {
        // user controller
        Route::controller(UserController::class)->group(function () {
            Route::get('/user/settings', 'index')->name('user.index');
        });

        Route::get('/cart', CartPage::class)->name('cart.index');

        Route::controller(CartController::class)->group(function () {
            Route::post('/cart/add/{product}', 'add')->name('cart.add');
            Route::post('/cart/reduce/{product}', 'reduce')->name('cart.reduce');
            Route::delete('/cart/remove/{product}', 'remove')->name('cart.remove');
            Route::get('/cart/checkout', 'checkout')->name('cart.checkout');
            Route::post('/cart/checkout', 'checkout')->name('cart.checkout.single');
            // Route::post('/checkout', 'doCheckout')->name('cart.doCheckout');

            Route::get('cart/checkout/shipping', [OrderController::class, 'shipping'])->name('cart.checkout.shipping');
            Route::post('/checkout/process', [OrderController::class, 'processCheckout'])->name('cart.checkout.process');
        });

        // Checkout Routes
        Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');
        Route::get('/checkout/payment', [CheckoutController::class, 'payment'])->name('checkout.payment');
        Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
        Route::get('/checkout/cancel', [CheckoutController::class, 'cancel'])->name('checkout.cancel');

        // Route Order Detail (opsional, untuk melihat order yang dibuat)
        Route::get('/order/{order}', [OrderController::class, 'show'])->name('order.show');
    });
});
