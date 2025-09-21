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


// DAFTAR PESANAN 
Route::get('/pesanan/{status?}', function ($status = null) {
    $orders = collect([
        ['id'=>1,'product'=>'Laptop Asus','category'=>'Elektronik','jumlah'=>1,'harga'=>12000000,'status'=>'Selesai','kurir'=>'JNE Express','waktu'=>'2025-09-10 10:00'],
        ['id'=>2,'product'=>'iPhone 15','category'=>'Elektronik','jumlah'=>1,'harga'=>20000000,'status'=>'Belum Bayar','kurir'=>'SiCepat','waktu'=>'2025-09-11 14:30'],
        ['id'=>3,'product'=>'Sepatu Nike','category'=>'Fashion','jumlah'=>2,'harga'=>3000000,'status'=>'Dibatalkan','kurir'=>'J&T Express','waktu'=>'2025-09-12 09:15'],
        ['id'=>4,'product'=>'Meja Belajar','category'=>'Furniture','jumlah'=>1,'harga'=>2500000,'status'=>'Dikirim','kurir'=>'J&T Express','waktu'=>'2025-08-12 08:18'],
        ['id'=>5,'product'=>'Kursi Gaming','category'=>'Furniture','jumlah'=>1,'harga'=>1500000,'status'=>'Perlu Dikirim','kurir'=>'SiCepat','waktu'=>'2025-08-13 11:45'],
        ['id'=>6,'product'=>'Kaos Polos','category'=>'Fashion','jumlah'=>3,'harga'=>100000,'status'=>'Selesai','kurir'=>'JNE Express','waktu'=>'2025-08-14 16:20'],
    ]);

    // Filter berdasarkan status jika diberikan
    if ($status && strtolower($status) !== 'semua') {
        $status = urldecode($status); // fix spasi
        $orders = $orders->where('status', $status);
    }
    
    return view('pesanan', compact('orders','status'));
});

// STATUS PESANAN
Route::get('/status/{id}', function ($id) {
    $orders = collect([
        ['id'=>1,'product'=>'Laptop Asus','category'=>'Elektronik','jumlah'=>1,'harga'=>12000000,'status'=>'Selesai','kurir'=>'JNE Express','waktu'=>'2025-09-10 10:00'],
        ['id'=>2,'product'=>'iPhone 15','category'=>'Elektronik','jumlah'=>1,'harga'=>20000000,'status'=>'Belum Bayar','kurir'=>'SiCepat','waktu'=>'2025-09-11 14:30'],
        ['id'=>3,'product'=>'Sepatu Nike','category'=>'Fashion','jumlah'=>2,'harga'=>3000000,'status'=>'Dibatalkan','kurir'=>'J&T Express','waktu'=>'2025-09-12 09:15'],
        ['id'=>4,'product'=>'Meja Belajar','category'=>'Furniture','jumlah'=>1,'harga'=>2500000,'status'=>'Dikirim','kurir'=>'J&T Express','waktu'=>'2025-08-12 08:18'],
        ['id'=>5,'product'=>'Kursi Gaming','category'=>'Furniture','jumlah'=>1,'harga'=>1500000,'status'=>'Perlu Dikirim','kurir'=>'SiCepat','waktu'=>'2025-08-13 11:45'],
        ['id'=>6,'product'=>'Kaos Polos','category'=>'Fashion','jumlah'=>3,'harga'=>100000,'status'=>'Selesai','kurir'=>'JNE Express','waktu'=>'2025-08-14 16:20'],
    ]);

    // Cari pesanan berdasarkan ID
    $order = $orders->firstWhere('id', $id);

    if (!$order) {
        abort(404, "Pesanan tidak ditemukan");
    }

    return view('status', [
        'product' => ['name' => $order['product'], 'category' => $order['category']],
        'status' => $order['status'],
    ]);
});

// // PENGIRIMAN MASAL
// // Route pengiriman massal
// Route::get('/pengiriman-massal', function () {
//     return "Fitur Pengiriman Massal";
// });