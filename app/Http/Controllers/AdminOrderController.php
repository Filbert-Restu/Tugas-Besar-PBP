<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class AdminOrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['user', 'items.product']);

        $stats = [
            'total_orders' => Order::count(),
            'pending' => Order::where('status', 'pending')->count(),
            'processing' => Order::where('status', 'processing')->count(),
            'shipped' => Order::where('status', 'shipped')->count(),
            'completed' => Order::where('status', 'completed')->count(),
            'cancelled' => Order::where('status', 'cancelled')->count(),
            'total_revenue' => Order::whereIn('status', ['completed', 'shipped', 'processing'])->sum('total'),
            'pending_revenue' => Order::where('status', 'pending')->sum('total'),
        ];

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%")
                                ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        if ($request->filled('payment_status') && $request->payment_status !== 'all') {
            $query->where('payment_status', $request->payment_status);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $orders = $query->paginate(10)->withQueryString();

        return view('admin.orders.index', compact('orders', 'stats'));
    }

    public function store(Request $request)
    {
        $cart = Auth::user()->cart;

        if (!$cart) {
            return back()->with('error', 'Keranjang kosong');
        }

        $cart->load('items.product');

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

    public function show($id)
    {
        $order = Order::with(['user', 'items.product'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,completed,cancelled',
            'notes' => 'nullable|string|max:500',
        ]);

        $order = Order::findOrFail($id);
        $oldStatus = $order->status;
        $order->status = $request->status;

        if ($request->filled('notes')) {
            $order->notes = $request->notes;
        }

        $order->save();

        return redirect()->back()->with('success', "Status pesanan berhasil diubah dari {$oldStatus} menjadi {$request->status}!");
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);

        if ($order->status !== 'cancelled') {
            return redirect()->back()->with('error', 'Hanya pesanan yang dibatalkan yang dapat dihapus!');
        }

        $order->items()->delete();
        $order->delete();

        return redirect()->route('admin.orders.index')->with('success', 'Pesanan berhasil dihapus!');
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
