<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:diproses,dikirim,selesai,batal',
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Status pesanan diperbarui.');
    }

    public function dashboard()
    {
        $totalProduk  = \App\Models\Product::count();
        $totalPesanan = Order::count();
        $totalUser    = \App\Models\User::count();

        // ambil 5 pesanan terbaru + relasi user
        $orders = Order::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalProduk',
            'totalPesanan',
            'totalUser',
            'orders'
        ));
    }
}
