<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    /**
     * Tampilkan halaman alamat pengiriman
     */
    public function address(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $selectedItemIds = session()->get('checkout_items');

        if (!$selectedItemIds || !is_array($selectedItemIds) || count($selectedItemIds) === 0) {
            return redirect()->route('cart.index')->with('error', 'Tidak ada item untuk checkout.');
        }

        return view('checkout.address');
    }

    /**
     * Simpan alamat dan lanjut ke review
     */
    public function storeAddress(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'city' => 'required|string|max:100',
            'province' => 'required|string|max:100',
            'postal_code' => 'required|string|max:10',
            'notes' => 'nullable|string|max:500',
        ]);

        // Update user data jika checkbox save_info dicentang
        if ($request->has('save_info')) {
            Auth::user()->update([
                'phone' => $validated['phone'],
                'address' => $validated['address'],
                'city' => $validated['city'],
                'province' => $validated['province'],
                'postal_code' => $validated['postal_code'],
            ]);
        }

        // Simpan data alamat ke session untuk digunakan di review & payment
        session([
            'shipping_address' => [
                'name' => $validated['name'] . ' ' . ($request->last_name ?? ''),
                'phone' => $validated['phone'],
                'address' => $validated['address'],
                'city' => $validated['city'],
                'province' => $validated['province'],
                'postal_code' => $validated['postal_code'],
                'notes' => $validated['notes'] ?? null,
            ]
        ]);

        return redirect()->route('checkout.show');
    }

    /**
     * Tampilkan halaman konfirmasi checkout (review items)
     */
    public function show(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $selectedItemIds = session()->get('checkout_items');
        $shippingAddress = session()->get('shipping_address');

        // Debug session
        \Log::info('Show (Review) method called', [
            'session_checkout_items' => $selectedItemIds,
            'shipping_address' => $shippingAddress,
            'user_id' => Auth::id(),
        ]);

        if (!$selectedItemIds || !is_array($selectedItemIds) || count($selectedItemIds) === 0) {
            return redirect()->route('cart.index')->with('error', 'Tidak ada item untuk checkout.');
        }

        // Redirect ke halaman alamat jika belum diisi
        if (!$shippingAddress) {
            return redirect()->route('checkout.address')->with('info', 'Silakan isi alamat pengiriman terlebih dahulu.');
        }

        $userCart = Cart::where('user_id', Auth::id())->first();

        if (!$userCart) {
            return redirect()->route('cart.index')->with('error', 'Keranjang tidak ditemukan.');
        }

        $checkoutItems = CartItem::with('product')
            ->whereIn('id', $selectedItemIds)
            ->where('cart_id', $userCart->id)
            ->get();

        if ($checkoutItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Item checkout tidak ditemukan.');
        }

        // Validasi stok
        foreach ($checkoutItems as $item) {
            if (!$item->product || $item->product->stock < $item->qty) {
                return redirect()->route('cart.index')->with('error',
                    'Stok tidak cukup untuk: ' . ($item->product->name ?? 'Produk Tidak Tersedia'));
            }
        }

        // Hitung total
        $subtotal = $checkoutItems->sum(function ($item) {
            return $item->product->price * $item->qty;
        });

        $taxPercent = 10;
        $tax = round($subtotal * ($taxPercent / 100));  // Bulatkan ke integer untuk konsistensi
        $total = $subtotal + $tax;

        // Re-save session untuk memastikan persist
        session()->put('checkout_items', $selectedItemIds);
        session()->save();

        \Log::info('Review page rendered successfully', [
            'checkout_items_count' => count($checkoutItems),
            'session_saved' => true,
        ]);

        return view('checkout.review', [
            'checkoutItems' => $checkoutItems,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'taxPercent' => $taxPercent,
            'total' => $total,
            'shippingAddress' => $shippingAddress,
        ]);
    }

    /**
     * Tampilkan halaman payment dengan Midtrans Snap Token
     */
    public function payment(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $selectedItemIds = session()->get('checkout_items');

        // Debug session
        \Log::info('Payment method called', [
            'session_checkout_items' => $selectedItemIds,
            'session_all' => session()->all(),
            'user_id' => Auth::id(),
        ]);

        if (!$selectedItemIds || !is_array($selectedItemIds) || count($selectedItemIds) === 0) {
            \Log::warning('Checkout items not found in session', [
                'session_data' => session()->all()
            ]);
            return redirect()->route('cart.index')->with('error', 'Tidak ada item untuk checkout. Silakan pilih item terlebih dahulu.');
        }

        $userCart = Cart::where('user_id', Auth::id())->first();

        if (!$userCart) {
            return redirect()->route('cart.index')->with('error', 'Keranjang tidak ditemukan.');
        }

        $checkoutItems = CartItem::with('product')
            ->whereIn('id', $selectedItemIds)
            ->where('cart_id', $userCart->id)
            ->get();

        if ($checkoutItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Item checkout tidak ditemukan.');
        }

        // Validasi stok
        foreach ($checkoutItems as $item) {
            if (!$item->product || $item->product->stock < $item->qty) {
                return redirect()->route('cart.index')->with('error',
                    'Stok tidak cukup untuk: ' . ($item->product->name ?? 'Produk Tidak Tersedia'));
            }
        }

        // Hitung total
        $subtotal = $checkoutItems->sum(function ($item) {
            return $item->product->price * $item->qty;
        });

        $taxPercent = 10;
        $tax = round($subtotal * ($taxPercent / 100));  // Bulatkan ke integer
        $total = $subtotal + $tax;

        // Buat order ID unik
        $orderId = 'ORDER-' . Auth::id() . '-' . time();

        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        // Fix SSL certificate issue untuk development
        // PENTING: Set sebagai array kosong dulu, baru tambahkan SSL options
        if (!is_array(Config::$curlOptions)) {
            Config::$curlOptions = [];
        }

        Config::$curlOptions[CURLOPT_SSL_VERIFYHOST] = 0;
        Config::$curlOptions[CURLOPT_SSL_VERIFYPEER] = 0;

        // Siapkan item details untuk Midtrans
        $itemDetails = [];
        foreach ($checkoutItems as $item) {
            $itemDetails[] = [
                'id' => $item->product_id,
                'price' => (int) $item->product->price,  // Cast ke integer
                'quantity' => $item->qty,
                'name' => substr($item->product->name, 0, 50),  // Batasi 50 karakter
            ];
        }

        // Tambahkan pajak sebagai item
        $itemDetails[] = [
            'id' => 'TAX',
            'price' => (int) $tax,  // Cast ke integer
            'quantity' => 1,
            'name' => 'Pajak (10%)',
        ];

        // Data transaksi untuk Midtrans
        $transactionDetails = [
            'order_id' => $orderId,
            'gross_amount' => (int) $total,  // Cast ke integer
        ];

        // Data customer
        $customerDetails = [
            'first_name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'phone' => Auth::user()->phone ?? '08123456789',
        ];

        // Parameter untuk Snap API
        $params = [
            'transaction_details' => $transactionDetails,
            'item_details' => $itemDetails,
            'customer_details' => $customerDetails,
        ];

        try {
            // Dapatkan Snap Token dari Midtrans
            $snapToken = Snap::getSnapToken($params);

            // Simpan data ke session untuk digunakan setelah payment
            session([
                'pending_order' => [
                    'order_id' => $orderId,
                    'checkout_items' => $selectedItemIds,
                    'subtotal' => $subtotal,
                    'tax' => $tax,
                    'total' => $total,
                ]
            ]);

            return view('checkout.payment', [
                'checkoutItems' => $checkoutItems,
                'subtotal' => $subtotal,
                'tax' => $tax,
                'taxPercent' => $taxPercent,
                'total' => $total,
                'snapToken' => $snapToken,
                'clientKey' => config('midtrans.client_key'),
            ]);

        } catch (\Exception $e) {
            \Log::error('Midtrans Snap Token Error', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            // Error message yang lebih detail
            $errorMsg = $e->getMessage();

            if (str_contains($errorMsg, 'SSL certificate')) {
                $errorMsg = 'Error SSL: Koneksi ke Midtrans gagal. Pastikan koneksi internet stabil.';
            } elseif (str_contains($errorMsg, 'Access denied')) {
                $errorMsg = 'API Keys tidak valid. Pastikan MIDTRANS_SERVER_KEY dan MIDTRANS_CLIENT_KEY sudah benar di file .env (harus diawali dengan SB- untuk Sandbox).';
            } elseif (str_contains($errorMsg, '401') || str_contains($errorMsg, 'Unauthorized')) {
                $errorMsg = 'API Keys tidak valid atau tidak cocok dengan environment (Sandbox/Production). Cek kembali keys di .env';
            }

            return redirect()->route('checkout.show')
                ->with('error', $errorMsg . ' Detail: ' . $e->getMessage());
        }
    }

    /**
     * Proses pembayaran dan buat order (callback dari Midtrans)
     */
    public function process(Request $request)
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Ambil data dari session
        $pendingOrder = session()->get('pending_order');

        if (!$pendingOrder) {
            return redirect()->route('cart.index')->with('error', 'Data pesanan tidak ditemukan.');
        }

        $selectedItemIds = $pendingOrder['checkout_items'];
        $orderId = $pendingOrder['order_id'];

        // Ambil user cart
        $userCart = Cart::where('user_id', Auth::id())->first();

        if (!$userCart) {
            return redirect()->route('cart.index')->with('error', 'Keranjang tidak ditemukan.');
        }

        // Query items untuk checkout
        $checkoutItems = CartItem::with('product')
            ->whereIn('id', $selectedItemIds)
            ->where('cart_id', $userCart->id)
            ->get();

        if ($checkoutItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Item checkout tidak ditemukan.');
        }

        // Mulai transaksi database
        DB::beginTransaction();

        try {
            // Validasi stok untuk semua item terlebih dahulu
            foreach ($checkoutItems as $item) {
                $product = $item->product;

                if (!$product) {
                    throw new \Exception('Produk tidak ditemukan: ' . ($item->product_name ?? 'Unknown'));
                }

                if ($product->stock < $item->qty) {
                    throw new \Exception(
                        'Stok tidak cukup untuk ' . $product->name .
                        '. Tersedia: ' . $product->stock . ', Diminta: ' . $item->qty
                    );
                }
            }

            // Buat order
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_id' => $orderId,
                'subtotal' => $pendingOrder['subtotal'],
                'tax' => $pendingOrder['tax'],
                'total' => $pendingOrder['total'],
                'status' => 'pending',
                'payment_method' => 'midtrans',
                'notes' => $request->input('notes'),
            ]);

            // Buat order items dan kurangi stok
            foreach ($checkoutItems as $item) {
                // Buat order item
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'product_name' => $item->product->name,
                    'product_price' => $item->product->price,
                    'quantity' => $item->qty,
                    'subtotal' => $item->product->price * $item->qty,
                ]);

                // Kurangi stok produk
                $product = Product::find($item->product_id);
                if ($product) {
                    $product->decrement('stock', $item->qty);
                }

                // Hapus item dari cart
                $item->delete();
            }

            // Commit transaksi
            DB::commit();

            // Hapus session
            session()->forget(['checkout_items', 'pending_order']);

            // Log sukses
            Log::info('Order dibuat berhasil', [
                'user_id' => Auth::id(),
                'order_id' => $order->id,
                'total' => $pendingOrder['total'],
            ]);

            // Return JSON response untuk AJAX
            return response()->json([
                'success' => true,
                'redirect_url' => route('order.show', $order->id),
            ]);

        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi error
            DB::rollBack();

            // Log error
            Log::error('Checkout Process Error', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            // Return JSON error response
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memproses order: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Midtrans callback handler
     */
    public function callback(Request $request)
    {
        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');

        $notification = new \Midtrans\Notification();

        $orderId = $notification->order_id;
        $transactionStatus = $notification->transaction_status;
        $fraudStatus = $notification->fraud_status;

        // Cari order berdasarkan order_id
        $order = Order::where('order_id', $orderId)->first();

        if (!$order) {
            Log::error('Order tidak ditemukan', ['order_id' => $orderId]);
            return response()->json(['message' => 'Order not found'], 404);
        }

        // Update status order berdasarkan notification
        if ($transactionStatus == 'capture') {
            if ($fraudStatus == 'accept') {
                $order->update(['status' => 'paid']);
            }
        } elseif ($transactionStatus == 'settlement') {
            $order->update(['status' => 'paid']);
        } elseif ($transactionStatus == 'pending') {
            $order->update(['status' => 'pending']);
        } elseif ($transactionStatus == 'deny') {
            $order->update(['status' => 'failed']);
        } elseif ($transactionStatus == 'expire') {
            $order->update(['status' => 'expired']);
        } elseif ($transactionStatus == 'cancel') {
            $order->update(['status' => 'cancelled']);
        }

        Log::info('Midtrans callback processed', [
            'order_id' => $orderId,
            'status' => $transactionStatus,
        ]);

        return response()->json(['message' => 'OK']);
    }

    /**
     * Batalkan checkout
     */
    public function cancel()
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Ambil session checkout_items
        $selectedItemIds = session()->get('checkout_items');

        // Hapus session checkout_items
        session()->forget('checkout_items');

        // Log pembatalan
        if ($selectedItemIds) {
            Log::info('Checkout dibatalkan', [
                'user_id' => Auth::id(),
                'items_count' => count($selectedItemIds),
            ]);
        }

        // Redirect ke halaman cart dengan pesan info
        return redirect()->route('cart.index')
            ->with('info', 'Checkout dibatalkan. Item tetap tersimpan di keranjang Anda.');
    }
}
