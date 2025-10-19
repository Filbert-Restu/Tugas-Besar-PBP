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

class CheckoutController extends Controller
{
    /**
     * Tampilkan halaman konfirmasi checkout (review items)
     */
    public function show(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $selectedItemIds = session()->get('checkout_items');

        if (!$selectedItemIds || !is_array($selectedItemIds) || count($selectedItemIds) === 0) {
            return redirect()->route('cart.index')->with('error', 'Tidak ada item untuk checkout.');
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
        $tax = round($subtotal * ($taxPercent / 100), 2);
        $total = $subtotal + $tax;

        return view('checkout.review', [
            'checkoutItems' => $checkoutItems,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'taxPercent' => $taxPercent,
            'total' => $total,
        ]);
    }

    /**
     * Tampilkan halaman payment
     */
    public function payment(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $selectedItemIds = session()->get('checkout_items');

        if (!$selectedItemIds || !is_array($selectedItemIds) || count($selectedItemIds) === 0) {
            return redirect()->route('cart.index')->with('error', 'Tidak ada item untuk checkout.');
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
        $tax = round($subtotal * ($taxPercent / 100), 2);
        $total = $subtotal + $tax;

        return view('checkout.payment', [
            'checkoutItems' => $checkoutItems,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'taxPercent' => $taxPercent,
            'total' => $total,
        ]);
    }

    /**
     * Proses pembayaran dan buat order (setelah payment)
     */
    public function process(Request $request)
    {
        // Validasi input payment
        $request->validate([
            'payment_method' => 'required|string|in:transfer_bank,e-wallet,cod',
            'notes' => 'nullable|string|max:500',
        ]);

        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Ambil selected items dari session
        $selectedItemIds = session()->get('checkout_items');

        if (!$selectedItemIds || !is_array($selectedItemIds) || count($selectedItemIds) === 0) {
            return redirect()->route('cart.index')->with('error', 'Tidak ada item untuk checkout.');
        }

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

            // Hitung total
            $subtotal = 0;
            foreach ($checkoutItems as $item) {
                $subtotal += $item->product->price * $item->qty;
            }

            $taxPercent = 10;
            $tax = round($subtotal * ($taxPercent / 100), 2);
            $total = $subtotal + $tax;

            // Buat order
            $order = Order::create([
                'user_id' => Auth::id(),
                'subtotal' => $subtotal,
                'tax' => $tax,
                'total' => $total,
                'status' => 'pending',
                'payment_method' => $request->input('payment_method'),
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

            // Hapus session checkout_items
            session()->forget('checkout_items');

            // Log sukses
            Log::info('Order dibuat berhasil', [
                'user_id' => Auth::id(),
                'order_id' => $order->id,
                'total' => $total,
            ]);

            // Redirect ke halaman thank you atau order detail
            return redirect()->route('order.show', $order->id)
                ->with('success', 'Pesanan berhasil dibuat! Terima kasih atas pembelian Anda.');

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

            // Redirect kembali dengan pesan error
            return redirect()->route('cart.checkout')
                ->with('error', 'Terjadi kesalahan saat memproses order: ' . $e->getMessage())
                ->withInput();
        }
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
