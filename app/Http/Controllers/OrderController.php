<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user', 'items.product')->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function store(Request $request)
    {
        $cart = Auth::user()->cart;   // pakai relasi hasOne
        
        if (!$cart) {
            return back()->with('error', 'Keranjang kosong');
        }

        $cart->load('items.product'); // load relasi items + product

        if ($cart->items->isEmpty()) {
            return back()->with('error', 'Keranjang kosong');
        }

        $total = $cart->items->sum(fn($i) => $i->product->price * $i->qty);

        $order = Order::create([
            'user_id' => Auth::id(),
            'total' => $total,
            'status' => 'pending',
            'address_text' => Auth::user()->address,
            'payment_status' => 'unpaid',
        ]);

        foreach ($cart->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'price' => $item->product->price,
                'qty' => $item->qty,
                'subtotal' => $item->product->price * $item->qty,
            ]);
        }

        $cart->items()->delete();
        return redirect()->route('orders.show', $order->id)->with('success', 'Pesanan berhasil dibuat');
    }

    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate(['status' => 'required|string']);
        $order->update(['status' => $request->status]);
        return back()->with('success', 'Status pesanan diperbarui');
    }

    public function dashboard()
    {
        $totalProduk = Product::count();
        $totalPesanan = Order::count();
        $totalUser = \App\Models\User::count();
        $orders = Order::latest()->take(5)->get();

        return view('admin.dashboard', compact('totalProduk', 'totalPesanan', 'totalUser', 'orders'));
    }
}
