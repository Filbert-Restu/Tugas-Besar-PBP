@extends('layouts.admin')

@section('content')
  <div class="max-w-5xl mx-auto">
    <!-- Back Button -->
    <div class="mb-6">
      <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-xl transition-colors font-medium">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Kembali ke Daftar Pesanan
      </a>
    </div>

    <!-- Order Header -->
    <div class="bg-gradient-to-r from-[#00a37a] to-[#00b385] rounded-2xl p-8 text-white shadow-xl mb-6">
      <div class="flex items-center justify-between">
        <div>
          <h1 class="text-3xl font-bold mb-2">Detail Pesanan</h1>
          <p class="text-[#ccf0e8]">Order ID: <span class="font-mono font-bold">#{{ $order->id }}</span></p>
        </div>
        <div class="text-right">
          <p class="text-[#ccf0e8] text-sm mb-1">Tanggal Pesanan</p>
          <p class="text-xl font-bold">{{ $order->created_at->format('d M Y, H:i') }}</p>
        </div>
      </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
      <!-- Main Content -->
      <div class="lg:col-span-2 space-y-6">
        <!-- Customer Info -->
        <div class="bg-white rounded-2xl p-6 shadow-xl border border-gray-100">
          <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
            <svg class="w-6 h-6 text-[#00a37a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
            Informasi Pelanggan
          </h2>
          <div class="space-y-3">
            <div class="flex items-center gap-3">
              <div class="w-12 h-12 bg-gradient-to-br from-[#6bb5f5] to-[#5da5e5] rounded-full flex items-center justify-center text-white font-bold text-lg">
                {{ substr($order->user->name ?? 'G', 0, 2) }}
              </div>
              <div>
                <p class="font-semibold text-gray-800">{{ $order->user->name ?? 'Guest' }}</p>
                <p class="text-sm text-gray-500">{{ $order->user->email ?? '-' }}</p>
              </div>
            </div>

            @if($order->address_text)
              <div class="pt-3 border-t border-gray-200">
                <p class="text-xs text-gray-500 mb-1">Alamat Pengiriman</p>
                <p class="text-sm text-gray-700">{{ $order->address_text }}</p>
              </div>
            @endif
          </div>
        </div>

        <!-- Order Items -->
        <div class="bg-white rounded-2xl p-6 shadow-xl border border-gray-100">
          <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
            <svg class="w-6 h-6 text-[#00a37a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
            </svg>
            Produk ({{ $order->items->count() }} item)
          </h2>

          <div class="space-y-4">
            @foreach($order->items as $item)
              <div class="flex items-center gap-4 p-4 bg-gradient-to-r from-gray-50 to-white rounded-xl border border-gray-200">
                @if($item->product && $item->product->image)
                  <img
                    src="{{ asset('storage/' . $item->product->image) }}"
                    class="w-20 h-20 rounded-xl object-cover shadow-md"
                    alt="{{ $item->product->name ?? 'Product' }}"
                  />
                @else
                  <div class="w-20 h-20 rounded-xl bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center shadow-md">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                  </div>
                @endif
                <div class="flex-1">
                  <h3 class="font-semibold text-gray-800">{{ $item->product->name ?? 'Product Deleted' }}</h3>
                  <p class="text-sm text-gray-600 mt-1">
                    Rp{{ number_format($item->price, 0, ',', '.') }} × {{ $item->qty }}
                  </p>
                </div>
                <div class="text-right">
                  <p class="text-lg font-bold text-[#00a37a]">
                    Rp{{ number_format($item->subtotal, 0, ',', '.') }}
                  </p>
                </div>
              </div>
            @endforeach
          </div>

          <!-- Total -->
          <div class="mt-6 pt-6 border-t-2 border-gray-200">
            <div class="flex justify-between items-center">
              <span class="text-xl font-bold text-gray-800">Total Pesanan</span>
              <span class="text-3xl font-bold text-[#00a37a]">
                Rp{{ number_format($order->total, 0, ',', '.') }}
              </span>
            </div>
          </div>
        </div>
      </div>

      <!-- Sidebar -->
      <div class="space-y-6">
        <!-- Order Status -->
        <div class="bg-white rounded-2xl p-6 shadow-xl border border-gray-100">
          <h2 class="text-lg font-bold text-gray-800 mb-4">Status Pesanan</h2>

          @php
            $statusConfig = [
              'pending' => ['bg' => '#fff9e6', 'text' => '#d4a647', 'border' => '#f5d46b', 'label' => 'Menunggu Pembayaran', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
              'processing' => ['bg' => '#e6f3ff', 'text' => '#5da5e5', 'border' => '#6bb5f5', 'label' => 'Sedang Diproses', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
              'shipped' => ['bg' => '#fef3e9', 'text' => '#e59a4b', 'border' => '#f1a85b', 'label' => 'Dalam Pengiriman', 'icon' => 'M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0'],
              'completed' => ['bg' => '#e6f4f1', 'text' => '#00a37a', 'border' => '#00a37a', 'label' => 'Selesai', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
              'cancelled' => ['bg' => '#fdecec', 'text' => '#d56363', 'border' => '#e57373', 'label' => 'Dibatalkan', 'icon' => 'M6 18L18 6M6 6l12 12'],
            ];
            $config = $statusConfig[$order->status] ?? ['bg' => '#f3f4f6', 'text' => '#6b7280', 'border' => '#d1d5db', 'label' => ucfirst($order->status), 'icon' => 'M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'];
          @endphp

          <div class="p-4 rounded-xl border mb-4" style="background: linear-gradient(to right, {{ $config['bg'] }}, {{ $config['bg'] }}dd); border-color: {{ $config['border'] }}">
            <div class="flex items-center gap-3">
              <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: {{ $config['text'] }}">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $config['icon'] }}"></path>
              </svg>
              <div>
                <p class="text-sm font-medium" style="color: {{ $config['text'] }}">Status Saat Ini</p>
                <p class="text-lg font-bold" style="color: {{ $config['text'] }}">{{ $config['label'] }}</p>
              </div>
            </div>
          </div>

          <!-- Payment Status -->
          <div class="mb-4">
            <p class="text-sm text-gray-500 mb-2">Status Pembayaran</p>
            <div class="flex items-center gap-2">
              @if($order->payment_status === 'paid')
                <div class="w-3 h-3 rounded-full" style="background-color: #00a37a"></div>
                <span class="font-semibold" style="color: #00a37a">Sudah Dibayar</span>
              @else
                <div class="w-3 h-3 bg-gray-400 rounded-full"></div>
                <span class="font-semibold text-gray-700">Belum Dibayar</span>
              @endif
            </div>
          </div>

          <!-- Update Status Form -->
          <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="space-y-3">
            @csrf
            @method('PUT')

            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Ubah Status</label>
              <select name="status" class="w-full border-2 border-gray-300 rounded-xl px-4 py-2.5 focus:border-[#00a37a] focus:ring-4 focus:ring-[#e6f4f1] outline-none transition-all bg-white font-medium">
                <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
              </select>
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Catatan (Opsional)</label>
              <textarea
                name="notes"
                rows="3"
                class="w-full border-2 border-gray-300 rounded-xl px-4 py-2.5 focus:border-[#00a37a] focus:ring-4 focus:ring-[#e6f4f1] outline-none transition-all resize-none"
                placeholder="Tambahkan catatan..."
              >{{ $order->notes ?? '' }}</textarea>
            </div>

            <button type="submit" class="w-full px-4 py-3 bg-gradient-to-r from-[#00a37a] to-[#00b385] text-white rounded-xl hover:from-[#00b385] hover:to-[#00c390] transition-all shadow-md hover:shadow-lg font-semibold">
              Update Status
            </button>
          </form>
        </div>

        <!-- Delete Order (if cancelled) -->
        @if($order->status === 'cancelled')
          <div class="bg-white rounded-2xl p-6 shadow-xl border-2" style="border-color: #e57373">
            <h3 class="text-lg font-bold mb-3" style="color: #d56363">Hapus Pesanan</h3>
            <p class="text-sm text-gray-600 mb-4">Pesanan yang dibatalkan dapat dihapus dari sistem.</p>
            <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?')">
              @csrf
              @method('DELETE')
              <button type="submit" class="w-full px-4 py-2 text-white rounded-xl transition-colors font-semibold" style="background-color: #e57373" onmouseover="this.style.backgroundColor='#d56363'" onmouseout="this.style.backgroundColor='#e57373'">
                Hapus Pesanan
              </button>
            </form>
          </div>
        @endif
      </div>
    </div>
  </div>
@endsection
