<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Authentication
Route::controller(AuthController::class)->group(function () {
    Route::get('/register', 'viewregister')->name('register');
    Route::post('/register', 'inRegister');
    Route::get('/login', 'viewLogin')->name('login');
    Route::post('/login', 'inLogin');
    Route::get('/logout', 'logout');
});

// Home
Route::get('/', function (Request $request) {
    // Dummy produk
    $products = [
        ['id' => 1, 'name' => 'Laptop Asus', 'category' => 'Elektronik'],
        ['id' => 2, 'name' => 'iPhone 15', 'category' => 'Elektronik'],
        ['id' => 3, 'name' => 'Meja Belajar', 'category' => 'Furniture'],
        ['id' => 4, 'name' => 'Kursi Gaming', 'category' => 'Furniture'],
        ['id' => 5, 'name' => 'Sepatu Nike', 'category' => 'Fashion'],
        ['id' => 6, 'name' => 'Kaos Polos', 'category' => 'Fashion'],
    ];

    // Ambil query pencarian
    $search = $request->input('search');
    $category = $request->input('category');

    // Filter produk
    $filtered = array_filter($products, function ($product) use ($search, $category) {
        $matchName = !$search || stripos($product['name'], $search) !== false;
        $matchCategory = !$category || stripos($product['category'], $category) !== false;
        return $matchName && $matchCategory;
    });

    // Ambil keranjang dari session
    $cart = session('cart', []);

    return view('home', [
        'products' => $filtered,
        'search' => $search,
        'category' => $category,
        'cart' => $cart,
    ]);
})->name('home');

// Tambah ke keranjang
Route::post('/cart/add', function (Request $request) {
    $id = $request->input('id');
    $name = $request->input('name');
    $category = $request->input('category');

    $cart = session('cart', []);

    // kalau produk sudah ada, tambah qty
    if (isset($cart[$id])) {
        $cart[$id]['qty']++;
    } else {
        $cart[$id] = [
            'id' => $id,
            'name' => $name,
            'category' => $category,
            'qty' => 1,
        ];
    }

    session(['cart' => $cart]);
    return redirect()->route('home');
})->name('cart.add');

// Hapus item dari keranjang
Route::post('/cart/remove', function (Request $request) {
    $id = $request->input('id');
    $cart = session('cart', []);
    unset($cart[$id]);
    session(['cart' => $cart]);
    return redirect()->route('home');
})->name('cart.remove');


// ========Keranjang=======



    // ========CheckOut========





    // ========CheckOut========

// ========Keranjang=======



