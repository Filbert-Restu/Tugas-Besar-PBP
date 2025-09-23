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

    public function add(Request $request, Product $product)
    {
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

    public function remove(Product $product)
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        if ($cart) {
            $cart->items()->where('product_id', $product->id)->delete();
        }
        return back()->with('success', 'Produk dihapus dari keranjang');
    }
}
