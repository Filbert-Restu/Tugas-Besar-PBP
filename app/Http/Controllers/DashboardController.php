<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProduk = Product::count();
        $totalPesanan = Order::count();
        $totalUser = User::count();
        $orders = Order::latest()->take(5)->get();

        return view('admin.dashboard', compact('totalProduk', 'totalPesanan', 'totalUser', 'orders'));
    }
}
