<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Authentication Routes
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:8',
    ]);
    
    // Simulasi login (dalam production gunakan Auth::attempt)
    session()->put('user', [
        'email' => $request->email,
        'name' => 'User'
    ]);
    
    return redirect()->route('home')->with('success', 'Login berhasil!');
});

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register', function (Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8|confirmed',
    ]);
    
    // Simulasi register (dalam production simpan ke database)
    return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
});

Route::post('/logout', function () {
    session()->forget('user');
    return redirect()->route('login')->with('success', 'Logout berhasil!');
})->name('logout');

// Data Dummy Products
$products = [
    [
        'id' => 1,
        'name' => 'Smart TV',
        'price' => 3000000,
        'category' => 'Elektronik',
        'icon' => 'fa-television',
        'gradient' => 'from-purple-100 to-blue-100',
        'icon_color' => 'text-purple-500',
        'weight' => 300,
        'description' => 'Headphone berkualitas tinggi dengan noise cancellation'
    ],
    [
        'id' => 2,
        'name' => 'Kacamata',
        'price' => 24000,
        'category' => 'Aksesoris',
        'icon' => 'fa-glasses',
        'gradient' => 'from-amber-100 to-orange-100',
        'icon_color' => 'text-amber-600',
        'weight' => 50,
        'description' => 'Kacamata fashion dengan lensa anti UV'
    ],
    [
        'id' => 3,
        'name' => 'Hoodie',
        'price' => 112000,
        'category' => 'Fashion',
        'icon' => 'fa-tshirt',
        'gradient' => 'from-pink-100 to-rose-100',
        'icon_color' => 'text-pink-500',
        'weight' => 400,
        'description' => 'Hoodie nyaman untuk segala aktivitas'
    ],
    [
        'id' => 4,
        'name' => 'Lampu Tidur',
        'price' => 8400,
        'category' => 'Perlengkapan Rumah',
        'icon' => 'fa-lightbulb',
        'gradient' => 'from-yellow-100 to-amber-100',
        'icon_color' => 'text-yellow-500',
        'weight' => 200,
        'description' => 'Lampu tidur dengan intensitas cahaya yang dapat diatur'
    ],
    [
        'id' => 5,
        'name' => 'Lip Cream',
        'price' => 20000,
        'category' => 'Kecantikan',
        'icon' => 'fa-heart',
        'gradient' => 'from-rose-100 to-pink-100',
        'icon_color' => 'text-rose-400',
        'weight' => 30,
        'description' => 'Lip cream dengan formula tahan lama'
    ],
    [
        'id' => 6,
        'name' => 'Le Minerale',
        'price' => 3200,
        'category' => 'Makanan & Minuman',
        'icon' => 'fa-wine-bottle',
        'gradient' => 'from-cyan-100 to-blue-100',
        'icon_color' => 'text-cyan-600',
        'weight' => 600,
        'description' => 'Air mineral berkualitas dalam kemasan praktis'
    ],
    [
        'id' => 7,
        'name' => 'Wajan Stainless Steel',
        'price' => 40500,
        'category' => 'Perlengkapan Rumah',
        'icon' => 'fa-blender',
        'gradient' => 'from-gray-100 to-slate-100',
        'icon_color' => 'text-gray-600',
        'weight' => 800,
        'description' => 'Wajan stainless steel anti lengket'
    ],
    [
        'id' => 8,
        'name' => 'Spidol Papan Tulis',
        'price' => 8000,
        'category' => 'Alat & Alat Tulis',
        'icon' => 'fa-pen',
        'gradient' => 'from-blue-100 to-indigo-100',
        'icon_color' => 'text-blue-600',
        'weight' => 200,
        'description' => 'Snowman Spidol Whiteboard BG-10 Boardmarker - Single. Harga tertera untuk satuan'
    ],
];

// Data Dummy Categories
$categories = [
    'Semua',
    'Aksesoris',
    'Alat & Alat Tulis',
    'Fashion',
    'Perlengkapan Rumah',
    'Kecantikan',
    'Makanan & Minuman',
    'Elektronik'
];

Route::get('/', function (Request $request) use ($products, $categories) {
    $search = $request->get('search', '');
    $category = $request->get('category', 'Semua');
    
    $filteredProducts = collect($products);
    
    // Filter by category
    if ($category !== 'Semua') {
        $filteredProducts = $filteredProducts->filter(function($product) use ($category) {
            return $product['category'] === $category;
        });
    }
    
    // Filter by search
    if ($search !== '') {
        $filteredProducts = $filteredProducts->filter(function($product) use ($search) {
            return stripos($product['name'], $search) !== false;
        });
    }
    
    return view('home', [
        'products' => $filteredProducts->values()->all(),
        'categories' => $categories,
        'currentCategory' => $category,
        'currentSearch' => $search
    ]);
})->name('home');

Route::get('/product/{id}', function ($id) use ($products) {
    $product = collect($products)->firstWhere('id', (int)$id);
    
    if (!$product) {
        abort(404);
    }
    
    return view('product', ['product' => $product]);
})->name('product');

Route::post('/cart/add', function (Request $request) {
    // Check if user is logged in
    if (!session()->has('user')) {
        return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk menambahkan produk ke keranjang.');
    }
    
    $cart = session()->get('cart', []);
    $productId = $request->input('product_id');
    $quantity = $request->input('quantity', 1);
    
    if (isset($cart[$productId])) {
        $cart[$productId]['quantity'] += $quantity;
    } else {
        $cart[$productId] = [
            'product_id' => $productId,
            'quantity' => $quantity
        ];
    }
    
    session()->put('cart', $cart);
    return redirect()->route('cart');
})->name('cart.add');

Route::get('/cart', function () use ($products) {
    $cart = session()->get('cart', []);
    $cartItems = [];
    $total = 0;
    
    foreach ($cart as $item) {
        $product = collect($products)->firstWhere('id', $item['product_id']);
        if ($product) {
            $subtotal = $product['price'] * $item['quantity'];
            $cartItems[] = [
                'product' => $product,
                'quantity' => $item['quantity'],
                'subtotal' => $subtotal
            ];
            $total += $subtotal;
        }
    }
    
    return view('cart', [
        'cartItems' => $cartItems,
        'total' => $total,
        'totalItems' => count($cartItems)
    ]);
})->name('cart');

Route::post('/cart/update', function (Request $request) {
    $cart = session()->get('cart', []);
    $productId = $request->input('product_id');
    $quantity = $request->input('quantity');
    
    if ($quantity > 0) {
        $cart[$productId]['quantity'] = $quantity;
    }
    
    session()->put('cart', $cart);
    return redirect()->route('cart');
})->name('cart.update');

Route::post('/cart/remove', function (Request $request) {
    $cart = session()->get('cart', []);
    $productId = $request->input('product_id');
    
    unset($cart[$productId]);
    
    session()->put('cart', $cart);
    return redirect()->route('cart');
})->name('cart.remove');

Route::get('/checkout', function () use ($products) {
    // Check if user is logged in
    if (!session()->has('user')) {
        return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
    }
    
    $cart = session()->get('cart', []);
    $cartItems = [];
    $total = 0;
    
    foreach ($cart as $item) {
        $product = collect($products)->firstWhere('id', $item['product_id']);
        if ($product) {
            $subtotal = $product['price'] * $item['quantity'];
            $cartItems[] = [
                'product' => $product,
                'quantity' => $item['quantity'],
                'subtotal' => $subtotal
            ];
            $total += $subtotal;
        }
    }
    
    return view('checkout', [
        'cartItems' => $cartItems,
        'total' => $total,
        'totalItems' => count($cartItems)
    ]);
})->name('checkout');

Route::post('/checkout/process', function (Request $request) {
    // Check if user is logged in
    if (!session()->has('user')) {
        return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
    }
    
    $request->validate([
        'email' => 'required|email',
        'first_name' => 'required|string',
        'last_name' => 'required|string',
        'address' => 'required|string',
        'city' => 'required|string',
        'province' => 'required|string',
    ]);
    
    session()->put('customer', [
        'email' => $request->input('email'),
        'first_name' => $request->input('first_name'),
        'last_name' => $request->input('last_name'),
        'address' => $request->input('address'),
        'notes' => $request->input('notes'),
        'city' => $request->input('city'),
        'province' => $request->input('province'),
        'country' => $request->input('country', 'Indonesia'),
    ]);
    
    return redirect()->route('shipping');
})->name('checkout.process');

Route::get('/shipping', function () use ($products) {
    $cart = session()->get('cart', []);
    $customer = session()->get('customer', []);
    $cartItems = [];
    $total = 0;
    
    foreach ($cart as $item) {
        $product = collect($products)->firstWhere('id', $item['product_id']);
        if ($product) {
            $subtotal = $product['price'] * $item['quantity'];
            $cartItems[] = [
                'product' => $product,
                'quantity' => $item['quantity'],
                'subtotal' => $subtotal
            ];
            $total += $subtotal;
        }
    }
    
    return view('shipping', [
        'cartItems' => $cartItems,
        'total' => $total,
        'totalItems' => count($cartItems),
        'customer' => $customer
    ]);
})->name('shipping');

Route::post('/shipping/process', function (Request $request) {
    // Check if user is logged in
    if (!session()->has('user')) {
        return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
    }
    
    session()->put('shipping', [
        'method' => $request->input('shipping_method', 'standard'),
        'cost' => 0
    ]);
    
    session()->put('payment', [
        'method' => $request->input('payment_method', 'cod')
    ]);
    
    // Generate Order Number
    $orderNumber = date('dmy') . '26FLJW' . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);
    session()->put('order_number', $orderNumber);
    
    return redirect()->route('thankyou');
})->name('shipping.process');

Route::get('/thank-you', function () {
    $orderNumber = session()->get('order_number', 'N/A');
    
    return view('thankyou', [
        'orderNumber' => $orderNumber
    ]);
})->name('thankyou');

Route::get('/thank-you', function () {
    $orderNumber = session()->get('order_number', 'N/A');
    
    return view('thankyou', [
        'orderNumber' => $orderNumber
    ]);
})->name('thankyou');

Route::get('/receipt/{order}', function ($order) use ($products) {
    $cart = session()->get('cart', []);
    $customer = session()->get('customer', []);
    $cartItems = [];
    $subtotal = 0;
    
    foreach ($cart as $item) {
        $product = collect($products)->firstWhere('id', $item['product_id']);
        if ($product) {
            $itemSubtotal = $product['price'] * $item['quantity'];
            $cartItems[] = [
                'product' => $product,
                'quantity' => $item['quantity'],
                'subtotal' => $itemSubtotal
            ];
            $subtotal += $itemSubtotal;
        }
    }
    
    return view('receipt', [
        'orderNumber' => $order,
        'cartItems' => $cartItems,
        'customer' => $customer,
        'subtotal' => $subtotal,
        'shipping' => 0,
        'total' => $subtotal,
        'totalItems' => array_sum(array_column($cartItems, 'quantity'))
    ]);
})->name('receipt');