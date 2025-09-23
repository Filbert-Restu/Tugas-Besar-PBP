<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class MainController extends Controller
{
    //
    public function index()
    {
        // Ambil semua produk
        $products = Product::all();

        // ambil jumlah keranjang user
        // $cartCount = 0;
        // $cart = auth()->user()->carts()->where('status', 'pending')->first();
        // $cartCount = $cart ? $cart->items()->count() : 0;

        // Kirim ke view
        return view('index', compact('products'));
    }

    public function show($id)
    {
        return view('products.index', ['product' => Product::findOrFail($id)]);
    }
}
