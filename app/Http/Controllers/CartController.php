<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
        $items = $cart->items()->with('product')->get();
        return view('cart.index', compact('cart', 'items'));
    }

    public function add(Request $request, Product $product) {
        $qty = $request->input('quantity', 1);
        // Buat cart jika belum ada
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

        $existingItem = $cart->items()->where('product_id', $product->id)->first();

        if ($existingItem) {
            $existingItem->increment('qty', $qty);
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'qty' => $qty,
            ]);
        }

        // Return JSON untuk AJAX dengan data lengkap cart
        if ($request->wantsJson()) {
            $items = $cart->items()->with('product')->get();
            $totalPrice = $items->sum(function($item) {
                return $item->product->price * $item->qty;
            });

            return response()->json([
                'success' => true,
                'items' => $items->map(function($item) {
                    return [
                        'id' => $item->id,
                        'product_id' => $item->product_id,
                        'qty' => $item->qty,
                        'product' => [
                            'id' => $item->product->id,
                            'name' => $item->product->name,
                            'price' => $item->product->price,
                            'price_formatted' => 'Rp' . number_format($item->product->price, 0, ',', '.'),
                            'image' => $item->product->image,
                        ]
                    ];
                }),
                'total' => $totalPrice,
                'total_formatted' => 'Rp' . number_format($totalPrice, 0, ',', '.'),
                'message' => 'Produk berhasil ditambahkan ke keranjang!'
            ]);
        }

        return back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    // Mengurangi qty produk di keranjang
    public function reduce(Request $request, Product $product){
        $cart = Cart::where('user_id', Auth::id())->first();

        if ($cart) {
            $item = $cart->items()->where('product_id', $product->id)->first();

            if ($item) {
                if ($item->qty > 1) {
                    $item->decrement('qty');
                } else {
                    $item->delete();
                }

                // Return JSON untuk AJAX dengan data lengkap cart
                if ($request->wantsJson()) {
                    $items = $cart->items()->with('product')->get();
                    $totalPrice = $items->sum(function($i) {
                        return $i->product->price * $i->qty;
                    });

                    return response()->json([
                        'success' => true,
                        'items' => $items->map(function($item) {
                            return [
                                'id' => $item->id,
                                'product_id' => $item->product_id,
                                'qty' => $item->qty,
                                'product' => [
                                    'id' => $item->product->id,
                                    'name' => $item->product->name,
                                    'price' => $item->product->price,
                                    'price_formatted' => 'Rp' . number_format($item->product->price, 0, ',', '.'),
                                    'image' => $item->product->image,
                                ]
                            ];
                        }),
                        'total' => $totalPrice,
                        'total_formatted' => 'Rp' . number_format($totalPrice, 0, ',', '.'),
                        'message' => 'Produk berhasil dikurangi dari keranjang'
                    ]);
                }
            }
        }

        return back()->with('success', 'Produk berhasil dikurangi dari keranjang');
    }

    public function remove(Request $request, Product $product) {
        $cart = Cart::where('user_id', Auth::id())->first();

        if ($cart) {
            $cart->items()->where('product_id', $product->id)->delete();

            // Return JSON untuk AJAX dengan data lengkap cart
            if ($request->wantsJson()) {
                $items = $cart->items()->with('product')->get();
                $totalPrice = $items->sum(function($i) {
                    return $i->product->price * $i->qty;
                });

                return response()->json([
                    'success' => true,
                    'items' => $items->map(function($item) {
                        return [
                            'id' => $item->id,
                            'product_id' => $item->product_id,
                            'qty' => $item->qty,
                            'product' => [
                                'id' => $item->product->id,
                                'name' => $item->product->name,
                                'price' => $item->product->price,
                                'price_formatted' => 'Rp' . number_format($item->product->price, 0, ',', '.'),
                                'image' => $item->product->image,
                            ]
                        ];
                    }),
                    'total' => $totalPrice,
                    'total_formatted' => 'Rp' . number_format($totalPrice, 0, ',', '.'),
                    'message' => 'Produk dihapus dari keranjang'
                ]);
            }
        }

        return back()->with('success', 'Produk dihapus dari keranjang');
    }

    public function checkout(Request $request) {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Ambil selected items dari session
        $selectedItemIds = session()->get('checkout_items');

        if (!$selectedItemIds || !is_array($selectedItemIds) || count($selectedItemIds) === 0) {
            return redirect()->route('cart.index')->with('error', 'Tidak ada item untuk checkout');
        }

        // Ambil user cart
        $userCart = Cart::where('user_id', Auth::id())->first();

        if (!$userCart) {
            return redirect()->route('cart.index')->with('error', 'Keranjang tidak ditemukan');
        }

        // Query item dengan validasi
        $CheckoutItems = CartItem::with('product')
            ->whereIn('id', $selectedItemIds)
            ->where('cart_id', $userCart->id)
            ->get();

        if ($CheckoutItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Item checkout tidak ditemukan');
        }

        // Validasi stok untuk semua item
        foreach ($CheckoutItems as $item) {
            if (!$item->product || $item->product->stock < $item->qty) {
                return redirect()->route('cart.index')->with('error',
                    'Stok tidak cukup untuk: ' . ($item->product->name ?? 'Produk Tidak Tersedia'));
            }
        }

        // Hitung total
        $subtotal = $CheckoutItems->sum(function ($item) {
            return $item->product->price * $item->qty;
        });

        $taxPercent = 10;
        $tax = round($subtotal * ($taxPercent / 100), 2);
        $total = $subtotal + $tax;

        return view('cart.checkout', [
            'CheckoutItems' => $CheckoutItems,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'taxPercent' => $taxPercent,
            'total' => $total,
        ]);
    }





    public function doCheckout(Request $request) {
        $selectedItemIds = $request->input('items', []); // array of selected cart_item_id

        if (empty($selectedItemIds)) {
            return redirect()->route('cart.index')->with('error', 'Tidak ada item yang dipilih untuk checkout.');
        }

        DB::beginTransaction();
        try {
            $items = CartItem::with('product')->whereIn('id', $selectedItemIds)->get();

            foreach ($items as $item) {
                if ($item->qty > $item->product->stock) {
                    DB::rollBack();
                    return redirect()->route('cart.index')->with('error', 'Stok produk tidak mencukupi untuk ' . $item->product->name);
                }
                $item->product->decrement('stock', $item->qty);
                // Hapus item dari keranjang setelah di-checkout
                $item->delete();
            }
            DB::commit();
            return redirect()->route('main')->with('success', 'Checkout berhasil! Terima kasih atas pembelian Anda.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('cart.index')->with('error', 'Terjadi kesalahan saat checkout. Silakan coba lagi.');
        }
    }

    // untuk update qty di halaman checkout single product
}
