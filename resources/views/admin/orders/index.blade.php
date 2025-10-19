@extends('layouts.admin')

@section('content')
  <div class="max-w-7xl mx-auto">
    <!-- Success/Error Messages -->
    @if(session('success'))
      <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-lg shadow-md animate-pulse">
        <div class="flex items-center">
          <svg class="w-6 h-6 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
          </svg>
          <p class="text-green-700 font-semibold">{{ session('success') }}</p>
        </div>
      </div>
    @endif

    @if(session('error'))
      <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-lg shadow-md">
        <div class="flex items-center">
          <svg class="w-6 h-6 text-red-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
          </svg>
          <p class="text-red-700 font-semibold">{{ session('error') }}</p>
        </div>
      </div>
    @endif

    <!-- Header -->
    <div class="mb-6">
      <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-3">
        <div class="w-10 h-10 bg-gradient-to-br from-[#f1a85b] to-[#e59a4b] rounded-lg flex items-center justify-center">
          <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
          </svg>
        </div>
        Manajemen Pesanan
      </h1>
      <p class="text-gray-500 mt-1">Kelola dan proses pesanan pelanggan</p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
      <!-- Total Orders -->
      <div class="bg-gradient-to-br from-[#6bb5f5] to-[#5da5e5] rounded-2xl p-6 text-white shadow-xl transform hover:scale-105 transition-all">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-[#d5ebfc] text-sm font-medium mb-1">Total Pesanan</p>
            <h3 class="text-3xl font-bold">{{ $stats['total_orders'] }}</h3>
          </div>
          <div class="w-14 h-14 bg-white/20 rounded-full flex items-center justify-center backdrop-blur-sm">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
            </svg>
          </div>
        </div>
        <div class="mt-4 flex items-center text-[#d5ebfc] text-sm">
          <span class="font-semibold">{{ $stats['pending'] }}</span>
          <span class="ml-1">menunggu pembayaran</span>
        </div>
      </div>

      <!-- Processing Orders -->
      <div class="bg-gradient-to-br from-[#f5d46b] to-[#e5c45b] rounded-2xl p-6 text-white shadow-xl transform hover:scale-105 transition-all">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-[#fef7de] text-sm font-medium mb-1">Diproses</p>
            <h3 class="text-3xl font-bold">{{ $stats['processing'] }}</h3>
          </div>
          <div class="w-14 h-14 bg-white/20 rounded-full flex items-center justify-center backdrop-blur-sm">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
          </div>
        </div>
        <div class="mt-4 flex items-center text-[#fef7de] text-sm">
          <div class="w-2 h-2 bg-white rounded-full animate-pulse mr-2"></div>
          <span>Sedang dikemas</span>
        </div>
      </div>

      <!-- Shipped Orders -->
      <div class="bg-gradient-to-br from-[#f1a85b] to-[#e59a4b] rounded-2xl p-6 text-white shadow-xl transform hover:scale-105 transition-all">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-[#fef3e9] text-sm font-medium mb-1">Dikirim</p>
            <h3 class="text-3xl font-bold">{{ $stats['shipped'] }}</h3>
          </div>
          <div class="w-14 h-14 bg-white/20 rounded-full flex items-center justify-center backdrop-blur-sm">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path>
            </svg>
          </div>
        </div>
        <div class="mt-4 flex items-center text-[#fef3e9] text-sm">
          <span>Dalam perjalanan</span>
        </div>
      </div>

      <!-- Total Revenue -->
      <div class="bg-gradient-to-br from-[#00a37a] to-[#00b385] rounded-2xl p-6 text-white shadow-xl transform hover:scale-105 transition-all">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-[#ccf0e8] text-sm font-medium mb-1">Total Pendapatan</p>
            <h3 class="text-2xl font-bold">Rp{{ number_format($stats['total_revenue'], 0, ',', '.') }}</h3>
          </div>
          <div class="w-14 h-14 bg-white/20 rounded-full flex items-center justify-center backdrop-blur-sm">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
          </div>
        </div>
        <div class="mt-4 flex items-center text-[#ccf0e8] text-sm">
          <span class="font-semibold">{{ $stats['completed'] }}</span>
          <span class="ml-1">pesanan selesai</span>
        </div>
      </div>
    </div>

    <!-- Orders Container -->
    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
      <!-- Search and Filter Form -->
      <div class="p-6 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
        <form method="GET" action="{{ route('admin.orders.index') }}" class="space-y-4">
          <!-- Search Bar -->
          <div class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
              <div class="relative">
                <input
                  type="text"
                  name="search"
                  value="{{ request('search') }}"
                  placeholder="Cari Order ID, Nama Pelanggan, Email..."
                  class="w-full pl-12 pr-4 py-3 border-2 border-gray-300 rounded-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 outline-none transition-all"
                />
                <svg class="w-6 h-6 text-gray-400 absolute left-4 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
              </div>
            </div>
            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-[#00a37a] to-[#00b385] text-white rounded-xl hover:from-[#00b385] hover:to-[#00c390] transition-all shadow-md hover:shadow-lg font-semibold">
              <span class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                Cari
              </span>
            </button>
          </div>

          <!-- Filters -->
          <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Status Filter -->
            <select name="status" class="border-2 border-gray-300 rounded-xl px-4 py-2.5 focus:border-[#00a37a] focus:ring-4 focus:ring-[#e6f4f1] outline-none transition-all bg-white font-medium">
              <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>Semua Status</option>
              <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
              <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
              <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>Shipped</option>
              <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
              <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>

            <!-- Payment Status Filter -->
            <select name="payment_status" class="border-2 border-gray-300 rounded-xl px-4 py-2.5 focus:border-[#00a37a] focus:ring-4 focus:ring-[#e6f4f1] outline-none transition-all bg-white font-medium">
              <option value="all" {{ request('payment_status') == 'all' ? 'selected' : '' }}>Semua Payment</option>
              <option value="unpaid" {{ request('payment_status') == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
              <option value="paid" {{ request('payment_status') == 'paid' ? 'selected' : '' }}>Paid</option>
            </select>

            <!-- Date From -->
            <input
              type="date"
              name="date_from"
              value="{{ request('date_from') }}"
              class="border-2 border-gray-300 rounded-xl px-4 py-2.5 focus:border-[#00a37a] focus:ring-4 focus:ring-[#e6f4f1] outline-none transition-all bg-white font-medium"
              placeholder="Dari Tanggal"
            />

            <!-- Date To -->
            <input
              type="date"
              name="date_to"
              value="{{ request('date_to') }}"
              class="border-2 border-gray-300 rounded-xl px-4 py-2.5 focus:border-[#00a37a] focus:ring-4 focus:ring-[#e6f4f1] outline-none transition-all bg-white font-medium"
              placeholder="Sampai Tanggal"
            />
          </div>

          <!-- Filter Actions -->
          <div class="flex items-center gap-3">
            <a href="{{ route('admin.orders.index') }}" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg transition-colors font-medium">
              Reset Filter
            </a>
          </div>
        </form>
      </div>

      <!-- Orders List -->
      <div class="p-6 space-y-4">
        @forelse($orders as $order)
          <!-- Order Card -->
          <div class="border-2 border-gray-200 rounded-2xl p-6 hover:border-indigo-300 hover:shadow-lg transition-all bg-gradient-to-br from-white to-gray-50">
            <!-- Order Header -->
            <div class="flex items-center justify-between mb-4 pb-4 border-b border-gray-200">
              <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-[#6bb5f5] to-[#5da5e5] rounded-full flex items-center justify-center text-white font-bold text-sm">
                  {{ substr($order->user->name ?? 'G', 0, 2) }}
                </div>
                <div>
                  <p class="font-bold text-gray-800">{{ $order->user->name ?? 'Guest' }}</p>
                  <p class="text-xs text-gray-500 flex items-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ $order->created_at->diffForHumans() }}
                  </p>
                </div>
              </div>
              <div class="text-right">
                <p class="text-xs text-gray-500 mb-1">Order ID</p>
                <p class="font-mono text-sm font-semibold text-gray-700">#{{ $order->id }}</p>
              </div>
            </div>

            <!-- Product Info -->
            <div class="space-y-3 mb-4">
              @foreach($order->items->take(2) as $item)
                <div class="flex items-center gap-4">
                  <div class="relative">
                    <img src="{{ $item->product->image ? asset('storage/' . $item->product->image) : 'https://dummyimage.com/80x80/cccccc/000000&text=No+Image' }}" class="w-16 h-16 rounded-xl object-cover shadow-md border-2 border-gray-200">
                    <div class="absolute -top-2 -right-2 w-6 h-6 bg-[#00a37a] text-white rounded-full flex items-center justify-center text-xs font-bold border-2 border-white">
                      {{ $item->qty }}
                    </div>
                  </div>
                  <div class="flex-1">
                    <p class="font-semibold text-gray-800">{{ $item->product->name ?? 'Product Deleted' }}</p>
                    <p class="text-sm text-gray-600">Rp{{ number_format($item->price, 0, ',', '.') }} × {{ $item->qty }}</p>
                  </div>
                  <div class="text-right">
                    <p class="text-sm font-bold text-gray-700">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</p>
                  </div>
                </div>
              @endforeach

              @if($order->items->count() > 2)
                <div class="text-center">
                  <p class="text-sm text-gray-500 italic">+ {{ $order->items->count() - 2 }} produk lainnya</p>
                </div>
              @endif
            </div>

            <!-- Total -->
            <div class="flex justify-between items-center mb-4 p-3 bg-gradient-to-r from-[#e6f4f1] to-[#f3f9f7] rounded-xl border border-[#c7ede3]">
              <span class="font-semibold text-gray-700">Total Pesanan</span>
              <span class="text-2xl font-bold text-[#00a37a]">Rp{{ number_format($order->total, 0, ',', '.') }}</span>
            </div>

            <!-- Status and Actions -->
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 pt-4 border-t border-gray-200">
              <!-- Status Badge -->
              <div class="flex items-center gap-3">
                @php
                  $statusConfig = [
                    'pending' => ['bg' => '#fff9e6', 'text' => '#d4a647', 'border' => '#f5d46b', 'label' => 'Menunggu', 'pulse' => true, 'pulseColor' => '#f5d46b'],
                    'processing' => ['bg' => '#e6f3ff', 'text' => '#5da5e5', 'border' => '#6bb5f5', 'label' => 'Diproses', 'pulse' => true, 'pulseColor' => '#6bb5f5'],
                    'shipped' => ['bg' => '#fef3e9', 'text' => '#e59a4b', 'border' => '#f1a85b', 'label' => 'Dikirim', 'pulse' => false],
                    'completed' => ['bg' => '#e6f4f1', 'text' => '#00a37a', 'border' => '#00a37a', 'label' => 'Selesai', 'pulse' => false],
                    'cancelled' => ['bg' => '#fdecec', 'text' => '#d56363', 'border' => '#e57373', 'label' => 'Dibatalkan', 'pulse' => false],
                  ];
                  $config = $statusConfig[$order->status] ?? ['bg' => '#f3f4f6', 'text' => '#6b7280', 'border' => '#d1d5db', 'label' => ucfirst($order->status), 'pulse' => false];
                @endphp

                @if($config['pulse'])
                  <div class="w-2 h-2 rounded-full animate-pulse" style="background-color: {{ $config['pulseColor'] }}"></div>
                @endif
                <span class="px-4 py-2 font-semibold rounded-xl border text-sm" style="background: linear-gradient(to right, {{ $config['bg'] }}, {{ $config['bg'] }}dd); color: {{ $config['text'] }}; border-color: {{ $config['border'] }}">
                  {{ $config['label'] }}
                </span>

                <!-- Payment Status -->
                <span class="px-3 py-1.5 {{ $order->payment_status === 'paid' ? 'border-[#00a37a] text-[#00a37a]' : 'bg-gray-100 text-gray-700 border-gray-300' }} border rounded-lg text-xs font-medium" style="{{ $order->payment_status === 'paid' ? 'background-color: #e6f4f1;' : '' }}">
                  {{ $order->payment_status === 'paid' ? '✓ Dibayar' : 'Belum Dibayar' }}
                </span>
              </div>

              <!-- Actions -->
              <div class="flex items-center gap-3 w-full sm:w-auto">
                <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="flex items-center gap-2">
                  @csrf
                  @method('PUT')
                  <select name="status" class="flex-1 sm:flex-none border-2 border-gray-300 rounded-xl px-4 py-2 focus:border-[#00a37a] focus:ring-4 focus:ring-[#e6f4f1] outline-none transition-all font-medium text-gray-700 cursor-pointer bg-white text-sm">
                    <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                    <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                    <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                  </select>
                  <button type="submit" class="px-4 py-2 bg-gradient-to-r from-[#00a37a] to-[#00b385] text-white rounded-xl hover:from-[#00b385] hover:to-[#00c390] transition-all shadow-md hover:shadow-lg font-medium text-sm">
                    Update
                  </button>
                </form>

                <a href="{{ route('admin.orders.show', $order->id) }}" class="px-4 py-2 bg-gradient-to-r from-[#6bb5f5] to-[#5da5e5] text-white rounded-xl hover:from-[#5da5e5] hover:to-[#4d95d5] transition-all shadow-md hover:shadow-lg font-medium flex items-center gap-2 text-sm">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                  </svg>
                  Detail
                </a>
              </div>
            </div>
          </div>
        @empty
          <!-- Empty State -->
          <div class="p-16 text-center">
            <div class="w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
              <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
              </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">Belum Ada Pesanan</h3>
            <p class="text-gray-500 mb-6">
              @if(request()->has('search') || request()->has('status'))
                Tidak ada pesanan yang sesuai dengan filter Anda
              @else
                Pesanan dari pelanggan akan muncul di sini
              @endif
            </p>
            @if(request()->has('search') || request()->has('status'))
              <a href="{{ route('admin.orders.index') }}" class="inline-block px-6 py-3 bg-gradient-to-r from-[#00a37a] to-[#00b385] text-white rounded-xl hover:from-[#00b385] hover:to-[#00c390] transition-all font-semibold">
                Reset Filter
              </a>
            @endif
          </div>
        @endforelse

        <!-- Pagination -->
        @if($orders->hasPages())
          <div class="mt-6">
            {{ $orders->links() }}
          </div>
        @endif
      </div>
    </div>
  </div>
@endsection
