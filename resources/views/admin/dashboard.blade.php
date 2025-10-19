@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <!-- Welcome Header -->
    <div class="bg-gradient-to-r from-[#00a37a] via-[#00b385] to-[#00c390] rounded-2xl shadow-2xl p-8 mb-8 text-white relative overflow-hidden">
      <div class="absolute top-0 right-0 w-96 h-96 bg-white opacity-5 rounded-full -mr-48 -mt-48"></div>
      <div class="absolute bottom-0 left-0 w-64 h-64 bg-white opacity-5 rounded-full -ml-32 -mb-32"></div>
      <div class="relative z-10">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
          <div class="flex items-center gap-4 mb-4 md:mb-0">
            <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
              <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
              </svg>
            </div>
            <div>
              <p class="text-green-100 text-sm font-medium">Selamat Datang Kembali,</p>
              <h1 class="text-3xl md:text-4xl font-bold">Admin Dashboard</h1>
              <p class="text-green-100 text-sm mt-1">{{ now()->format('l, d F Y') }}</p>
            </div>
          </div>
          <div class="flex gap-3">
            <a href="{{ route('admin.products.index') }}" class="bg-white bg-opacity-20 hover:bg-opacity-30 backdrop-blur-sm px-4 py-2 rounded-lg font-medium transition text-sm">
              📦 Produk
            </a>
            <a href="{{ route('admin.orders.index') }}" class="bg-white bg-opacity-20 hover:bg-opacity-30 backdrop-blur-sm px-4 py-2 rounded-lg font-medium transition text-sm">
              🛒 Pesanan
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
      <!-- Total Revenue -->
      <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all p-6 border-l-4 border-[#00a37a]">
        <div class="flex items-start justify-between mb-4">
          <div>
            <p class="text-gray-500 text-sm font-medium">Total Pendapatan</p>
            <p class="{{ $totalRevenue >= 1000 ? 'text-xl' : 'text-3xl' }} font-bold text-gray-800 mt-2">Rp{{ number_format($totalRevenue, 0, ',', '.') }}</p>
            <p class="{{ $monthlyRevenue >= 1000 ? 'text-[10px]' : 'text-xs' }} text-gray-500 mt-2">Bulan ini: Rp{{ number_format($monthlyRevenue, 0, ',', '.') }}</p>
          </div>
          <div class="w-12 h-12 bg-gradient-to-br from-[#00a37a] to-[#00b385] rounded-lg flex items-center justify-center">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
          </div>
        </div>
      </div>

      <!-- Total Products -->
      <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all p-6 border-l-4 border-[#6bb5f5]">
        <div class="flex items-start justify-between mb-4">
          <div>
            <p class="text-gray-500 text-sm font-medium">Total Produk</p>
            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalProduk }}</p>
            <p class="text-xs text-[#00a37a] mt-2 font-semibold">✓ Aktif</p>
          </div>
          <div class="w-12 h-12 bg-gradient-to-br from-[#6bb5f5] to-[#5da5e5] rounded-lg flex items-center justify-center">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
            </svg>
          </div>
        </div>
      </div>

      <!-- Total Orders -->
      <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all p-6 border-l-4 border-[#f1a85b]">
        <div class="flex items-start justify-between mb-4">
          <div>
            <p class="text-gray-500 text-sm font-medium">Total Pesanan</p>
            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalPesanan }}</p>
            <p class="text-xs text-[#f1a85b] mt-2 font-semibold">{{ $pendingOrders }} Pending</p>
          </div>
          <div class="w-12 h-12 bg-gradient-to-br from-[#f1a85b] to-[#e19850] rounded-lg flex items-center justify-center">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
            </svg>
          </div>
        </div>
      </div>

      <!-- Total Users -->
      <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all p-6 border-l-4 border-[#e57373]">
        <div class="flex items-start justify-between mb-4">
          <div>
            <p class="text-gray-500 text-sm font-medium">Total Pengguna</p>
            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalUser }}</p>
            <p class="text-xs text-[#6bb5f5] mt-2 font-semibold">Pelanggan Aktif</p>
          </div>
          <div class="w-12 h-12 bg-gradient-to-br from-[#e57373] to-[#d56363] rounded-lg flex items-center justify-center">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
          </div>
        </div>
      </div>
    </div>

    <!-- Two Column Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
      <!-- Recent Orders -->
      <div class="lg:col-span-2 bg-white rounded-xl shadow-lg p-6">
        <div class="flex items-center justify-between mb-6">
          <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
            <span class="w-2 h-8 bg-gradient-to-b from-[#00a37a] to-[#00b385] rounded-full"></span>
            Pesanan Terbaru
          </h2>
          <a href="{{ route('admin.orders.index') }}" class="text-[#00a37a] hover:text-[#00b385] text-sm font-semibold">
            Lihat Semua →
          </a>
        </div>
        <div class="overflow-x-auto">
          <table class="w-full">
            <thead class="bg-gray-50 border-b-2 border-gray-200">
              <tr>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Order ID</th>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Customer</th>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Total</th>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Tanggal</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
              @forelse($recentOrders as $order)
                <tr class="hover:bg-gray-50 transition">
                  <td class="px-4 py-3 text-sm font-medium text-gray-900">#{{ $order->id }}</td>
                  <td class="px-4 py-3 text-sm text-gray-700">{{ $order->user->name ?? 'N/A' }}</td>
                  <td class="px-4 py-3 text-sm font-semibold text-gray-900">Rp{{ number_format($order->total, 0, ',', '.') }}</td>
                  <td class="px-4 py-3">
                    @if($order->status === 'pending')
                      <span class="px-3 py-1 bg-[#fff9e6] text-[#d4a647] text-xs font-semibold rounded-full">Pending</span>
                    @elseif($order->status === 'processing')
                      <span class="px-3 py-1 bg-[#e6f3ff] text-[#5da5e5] text-xs font-semibold rounded-full">Processing</span>
                    @elseif($order->status === 'completed')
                      <span class="px-3 py-1 bg-[#e6f4f1] text-[#00a37a] text-xs font-semibold rounded-full">Completed</span>
                    @else
                      <span class="px-3 py-1 bg-[#fdecec] text-[#d56363] text-xs font-semibold rounded-full">Cancelled</span>
                    @endif
                  </td>
                  <td class="px-4 py-3 text-sm text-gray-600">{{ $order->created_at->format('d M Y') }}</td>
                </tr>
              @empty
                <tr>
                  <td colspan="5" class="px-4 py-8 text-center text-gray-500">Belum ada pesanan</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>

      <!-- Low Stock Alert -->
      <div class="bg-white rounded-xl shadow-lg p-6">
        <div class="flex items-center justify-between mb-6">
          <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
            <span class="text-red-500">⚠️</span>
            Stok Menipis
          </h2>
        </div>
        <div class="space-y-4">
          @forelse($lowStockProducts as $product)
            <div class="flex items-center gap-3 p-3 bg-[#fdecec] rounded-lg border border-[#e57373]">
              <img src="{{ $product->image ?? 'https://via.placeholder.com/50' }}" alt="{{ $product->name }}" class="w-12 h-12 rounded object-cover">
              <div class="flex-1">
                <p class="font-semibold text-sm text-gray-800">{{ Str::limit($product->name, 30) }}</p>
                <p class="text-xs text-[#e57373] font-bold mt-1">Stok: {{ $product->stock }}</p>
              </div>
            </div>
          @empty
            <p class="text-center text-gray-500 py-4">Semua produk stok aman</p>
          @endforelse
        </div>
      </div>
    </div>

    <!-- Bottom Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
      <!-- Top Products -->
      <div class="bg-white rounded-xl shadow-lg p-6">
        <div class="flex items-center justify-between mb-6">
          <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
            <span class="text-2xl">🏆</span>
            Produk Terlaris
          </h2>
        </div>
        <div class="space-y-4">
          @forelse($topProducts as $index => $product)
            <div class="flex items-center gap-4 p-3 bg-gradient-to-r from-gray-50 to-white rounded-lg border border-gray-100">
              <div class="w-10 h-10 bg-gradient-to-br from-[#00a37a] to-[#00b385] rounded-full flex items-center justify-center text-white font-bold">
                {{ $index + 1 }}
              </div>
              <img src="{{ $product->image ?? 'https://via.placeholder.com/50' }}" alt="{{ $product->name }}" class="w-14 h-14 rounded-lg object-cover">
              <div class="flex-1">
                <p class="font-semibold text-gray-800">{{ Str::limit($product->name, 40) }}</p>
                <p class="text-sm text-gray-600 mt-1">Terjual: <span class="font-bold text-[#00a37a]">{{ $product->total_sold ?? 0 }}</span></p>
              </div>
            </div>
          @empty
            <p class="text-center text-gray-500 py-4">Belum ada data penjualan</p>
          @endforelse
        </div>
      </div>

      <!-- Recent Users -->
      <div class="bg-white rounded-xl shadow-lg p-6">
        <div class="flex items-center justify-between mb-6">
          <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
            <span class="text-2xl">👥</span>
            Pengguna Terbaru
          </h2>
        </div>
        <div class="space-y-4">
          @forelse($recentUsers as $user)
            <div class="flex items-center gap-4 p-3 bg-gradient-to-r from-[#e6f3ff] to-white rounded-lg border border-[#6bb5f5]/30">
              <div class="w-12 h-12 bg-gradient-to-br from-[#6bb5f5] to-[#5da5e5] rounded-full flex items-center justify-center text-white font-bold text-lg">
                {{ strtoupper(substr($user->name, 0, 1)) }}
              </div>
              <div class="flex-1">
                <p class="font-semibold text-gray-800">{{ $user->name }}</p>
                <p class="text-sm text-gray-600">{{ $user->email }}</p>
                <p class="text-xs text-gray-500 mt-1">Bergabung: {{ $user->created_at->diffForHumans() }}</p>
              </div>
            </div>
          @empty
            <p class="text-center text-gray-500 py-4">Belum ada pengguna</p>
          @endforelse
        </div>
      </div>
    </div>

  </div>
</div>
@endsection
