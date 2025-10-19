<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Order;

class AdminDashboardController extends Controller
{
    /**
     * Dashboard Admin
     */
    public function dashboard()
    {
        // Total Counts
        $totalProduk  = Product::count();
        $totalPesanan = Order::count();
        $totalUser    = User::where('role', 'user')->count();

        // Revenue
        $totalRevenue = Order::where('status', '!=', 'cancelled')->sum('total');
        $monthlyRevenue = Order::where('status', '!=', 'cancelled')
            ->whereMonth('created_at', now()->month)
            ->sum('total');

        // Order Statistics
        $pendingOrders = Order::where('status', 'pending')->count();
        $completedOrders = Order::where('status', 'completed')->count();

        // Recent Orders
        $recentOrders = Order::with('user')
            ->latest()
            ->take(10)
            ->get();

        // Low Stock Products
        $lowStockProducts = Product::where('stock', '<', 10)
            ->orderBy('stock', 'asc')
            ->take(5)
            ->get();

        // Top Selling Products
        $topProducts = Product::withCount(['orderItems as total_sold' => function($query) {
                $query->selectRaw('sum(quantity)');
            }])
            ->orderBy('total_sold', 'desc')
            ->take(5)
            ->get();

        // Recent Users
        $recentUsers = User::where('role', 'user')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalProduk',
            'totalPesanan',
            'totalUser',
            'totalRevenue',
            'monthlyRevenue',
            'pendingOrders',
            'completedOrders',
            'recentOrders',
            'lowStockProducts',
            'topProducts',
            'recentUsers'
        ));
    }

    /**
     * List User
     */
    // public function users()
    // {
    //     $users = User::paginate(10);
    //     return view('admin.users.index', compact('users'));
    // }

    // /**
    //  * Hapus User
    //  */
    // public function destroyUser(User $user)
    // {
    //     if ($user->role === 'admin') {
    //         return back()->with('error', 'Admin tidak bisa dihapus');
    //     }

    //     $user->delete();
    //     return back()->with('success', 'User berhasil dihapus');
    // }
}
