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
        $cart = Auth::user()->cart;

        $existingItem = $cart->items()->where('product_id', $product->id)->first();

        if ($existingItem) {
            $existingItem->increment('qty');
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'qty' => 1,
            ]);
        }

        return back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    // Mengurangi qty produk di keranjang
    public function reduce(Product $product){
        $cart = Cart::where('user_id', Auth::id())->first();
        if ($cart) {
            $item = $cart->items()->where('product_id', $product->id)->first();
            if ($item) {
                if ($item->qty > 1) {
                    $item->decrement('qty');
                } else {
                    $item->delete();
                }
            }
        }
        return back()->with('success', 'Produk berhasil dikurangi dari keranjang');
    }

    public function remove(Product $product) {
        $cart = Cart::where('user_id', Auth::id())->first();
        if ($cart) {
            $cart->items()->where('product_id', $product->id)->delete();
        }
        return back()->with('success', 'Produk dihapus dari keranjang');
    }


    public function checkout(Request $request) {
        // ambil items di cart sesuai request id, ambil beberapa atribut saja
        $CheckoutItems = CartItem::with('product:id,name,price')
            ->whereIn('id', $request->input('items', []))
            ->get(['id', 'name', 'product_id', 'qty']);

        return view('checkout', compact('CheckoutItems'));
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
