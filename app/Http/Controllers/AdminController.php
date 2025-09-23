<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Order;

class AdminController extends Controller
{
    /**
     * Dashboard Admin
     */
    public function dashboard()
    {
        $totalProduk  = Product::count();
        $totalPesanan = Order::count();
        $totalUser    = User::count();
        $recentOrders = Order::with(['user','items.product'])->latest()->take(7)->get();

        return view('admin.dashboard', compact('totalProduk', 'totalPesanan', 'totalUser', 'recentOrders'));
    }

    /**
     * List User
     */
    public function users()
    {
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Hapus User
     */
    public function destroyUser(User $user)
    {
        if ($user->role === 'admin') {
            return back()->with('error', 'Admin tidak bisa dihapus');
        }

        $user->delete();
        return back()->with('success', 'User berhasil dihapus');
    }
}
