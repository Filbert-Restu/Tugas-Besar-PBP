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

// Define produk sebagai constant
define('DUMMY_PRODUCTS', [
    ['id' => 1, 'name' => 'Laptop Asus', 'category' => 'Elektronik'],
    ['id' => 2, 'name' => 'iPhone 15', 'category' => 'Elektronik'],
    ['id' => 3, 'name' => 'Meja Belajar', 'category' => 'Furniture'],
    ['id' => 4, 'name' => 'Kursi Gaming', 'category' => 'Furniture'],
    ['id' => 5, 'name' => 'Sepatu Nike', 'category' => 'Fashion'],
    ['id' => 6, 'name' => 'Kaos Polos', 'category' => 'Fashion'],
]);

// Home
Route::get('/', function (Request $request) {
    $products = DUMMY_PRODUCTS;

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



// ADMIN / SELLER

// Katalog Produk 
Route::get("/catalog", function() {
    $products = DUMMY_PRODUCTS; // Pake constant yang sama
    return view("catalog", compact('products'));
})->name('catalog');

// Add produk
Route::get('/addproduct', function () {
    return view('addproduct');
})->name('addproduct');

/**
 * Handle submit form tambah produk (validasi saja + redirect)
 * Catatan: karena DUMMY_PRODUCTS itu constant, kita tidak “menyimpan”
 * data baru di sini. Nanti kalau sudah DB, ganti dengan Product::create($data).
 */
Route::post('/addproduct', function (Request $request) {
    $data = $request->validate([
        'name'          => ['required','string','max:255'],
        'description'   => ['required','string','max:3000'],
        'category'      => ['required','string','max:255'],
        'price'         => ['required','integer','min:0'],
        'stock'         => ['required','integer','min:0'],
        'shipping_cost' => ['required','integer','min:0'],
    ]);

    // TODO (pakai DB nanti): Product::create($data);

    return redirect()->route('catalog')->with('ok', 'Produk baru berhasil ditambahkan!');
})->name('addproduct.store');