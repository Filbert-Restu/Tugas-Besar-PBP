@extends('admin.layouts.admin')

@section('title', 'Dashboard Admin')

@section('breadcrumb')
<a href="{{ route('admin.dashboard') }}">Dashboard</a>
@endsection

@section('content')
  <div class="grid grid-cols-3 gap-4">
      <div class="bg-white p-4 shadow rounded">Total Produk: {{ $totalProduk }}</div>
      <div class="bg-white p-4 shadow rounded">Total Pesanan: {{ $totalPesanan }}</div>
      <div class="bg-white p-4 shadow rounded">Total User: {{ $totalUser }}</div>
  </div>
  <!-- Recent Orders -->
    <div class="bg-white dark:bg-gray-900 shadow rounded-xl p-6">
        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">Recent Orders</h2>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead class="bg-gray-100 dark:bg-gray-800">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">Order ID</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">Purchase date</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">Customer</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">Items</th>
                        <th class="px-4 py-3 text-right text-sm font-semibold text-gray-600 dark:text-gray-300">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentOrders as $order)
                    <tr class="border-b hover:bg-gray-50 dark:hover:bg-gray-800">
                        <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-200">{{ $order->id }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-200">{{ $order->created_at->format('M d, Y') }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-200">{{ $order->user->name }}</td>
                        <td class="px-4 py-3 flex items-center gap-2">
                            @foreach($order->items as $item)
                                <div class="flex items-center gap-2">
                                    @if($item->product->image)
                                        <img src="{{ asset('storage/'.$item->product->image) }}" alt="img"
                                             class="w-8 h-8 rounded-full object-cover">
                                    @else
                                        <div class="w-8 h-8 rounded-full bg-gray-300 dark:bg-gray-700"></div>
                                    @endif
                                    <span class="text-sm text-gray-700 dark:text-gray-200">{{ $item->product->name }}</span>
                                </div>
                            @endforeach
                        </td>
                        <td class="px-4 py-3 text-sm font-semibold text-right text-green-600 dark:text-green-400">
                            Rp {{ number_format($order->total, 0, ',', '.') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
@endsection
