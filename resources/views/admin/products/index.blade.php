@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
      <div>
        <h1 class="text-4xl font-bold text-gray-900 flex items-center gap-3">
          <div class="w-12 h-12 bg-gradient-to-br from-[#00a37a] to-[#00b385] rounded-xl flex items-center justify-center shadow-lg">
            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
            </svg>
          </div>
          Manajemen Produk
        </h1>
        <p class="text-gray-600 mt-2">Kelola semua produk toko Anda dengan mudah</p>
      </div>
      <a href="{{ route('admin.products.add') }}" class="px-6 py-3 bg-gradient-to-r from-[#00a37a] to-[#00b385] text-white rounded-xl shadow-lg hover:shadow-xl hover:from-[#00b385] hover:to-[#00c390] transition-all flex items-center gap-2 font-semibold">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Tambah Produk Baru
      </a>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
      <div class="mb-6 bg-green-50 border-l-4 border-green-500 rounded-lg p-4 shadow-sm">
        <div class="flex items-center">
          <svg class="w-6 h-6 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
          </svg>
          <p class="text-green-800 font-medium">{{ session('success') }}</p>
        </div>
      </div>
    @endif

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
      <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-[#6bb5f5] hover:shadow-xl transition">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-gray-500 text-sm font-medium mb-1">Total Produk</p>
            <p class="text-3xl font-bold text-gray-900">{{ $totalProducts }}</p>
          </div>
          <div class="w-14 h-14 bg-gradient-to-br from-[#6bb5f5] to-[#5da5e5] rounded-xl flex items-center justify-center">
            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
            </svg>
          </div>
        </div>
      </div>

      <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-[#f5d46b] hover:shadow-xl transition">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-gray-500 text-sm font-medium mb-1">Stok Menipis</p>
            <p class="text-3xl font-bold text-gray-900">{{ $lowStockCount }}</p>
          </div>
          <div class="w-14 h-14 bg-gradient-to-br from-[#f5d46b] to-[#e5c45b] rounded-xl flex items-center justify-center">
            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
            </svg>
          </div>
        </div>
      </div>

      <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-[#e57373] hover:shadow-xl transition">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-gray-500 text-sm font-medium mb-1">Stok Habis</p>
            <p class="text-3xl font-bold text-gray-900">{{ $outOfStockCount }}</p>
          </div>
          <div class="w-14 h-14 bg-gradient-to-br from-[#e57373] to-[#d56363] rounded-xl flex items-center justify-center">
            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </div>
        </div>
      </div>

      <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-[#00a37a] hover:shadow-xl transition">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-gray-500 text-sm font-medium mb-1">Nilai Inventori</p>
            <p class="font-bold text-gray-900 {{ strlen(number_format($totalValue, 0, ',', '.')) > 15 ? 'text-base' : (strlen(number_format($totalValue, 0, ',', '.')) > 12 ? 'text-lg' : (strlen(number_format($totalValue, 0, ',', '.')) > 9 ? 'text-xl' : 'text-2xl')) }}">
              Rp{{ number_format($totalValue, 0, ',', '.') }}
            </p>
          </div>
          <div class="w-14 h-14 bg-gradient-to-br from-[#00a37a] to-[#00b385] rounded-xl flex items-center justify-center">
            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
          </div>
        </div>
      </div>
    </div>

    <!-- Filters & Search -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
      <form method="GET" action="{{ route('admin.products.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <!-- Search -->
        <div class="md:col-span-2">
          <label class="block text-sm font-medium text-gray-700 mb-2">Cari Produk</label>
          <div class="relative">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Nama atau deskripsi produk..." class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
            <svg class="absolute left-3 top-3.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
          </div>
        </div>

        <!-- Category Filter -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
          <select name="category" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
            <option value="">Semua Kategori</option>
            @foreach($categories as $category)
              <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
              </option>
            @endforeach
          </select>
        </div>

        <!-- Stock Status Filter -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Status Stok</label>
          <select name="stock_status" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
            <option value="">Semua Status</option>
            <option value="available" {{ request('stock_status') == 'available' ? 'selected' : '' }}>Tersedia</option>
            <option value="low" {{ request('stock_status') == 'low' ? 'selected' : '' }}>Stok Menipis</option>
            <option value="out" {{ request('stock_status') == 'out' ? 'selected' : '' }}>Stok Habis</option>
          </select>
        </div>

        <!-- Filter Buttons -->
        <div class="md:col-span-4 flex gap-3">
          <button type="submit" class="px-6 py-3 bg-gradient-to-r from-[#00a37a] to-[#00b385] text-white rounded-lg font-semibold hover:from-[#00b385] hover:to-[#00c390] transition flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
            </svg>
            Terapkan Filter
          </button>
          <a href="{{ route('admin.products.index') }}" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg font-semibold hover:bg-gray-300 transition">
            Reset
          </a>
        </div>
      </form>
    </div>

    <!-- Products Grid/Table -->
    @if($products->count() > 0)
      <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-6">
        <div class="overflow-x-auto">
          <table class="w-full">
            <thead class="bg-gradient-to-r from-[#00a37a] to-[#00b385] text-white">
              <tr>
                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Produk</th>
                <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider">Kategori</th>
                <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider">Harga</th>
                <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider">Stok</th>
                <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider">Status</th>
                <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider">Aksi</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
              @foreach($products as $product)
                <tr class="hover:bg-[#e6f4f1] transition-colors">
                  <td class="px-6 py-4">
                    <div class="flex items-center gap-4">
                      <div class="relative">
                        @if($product->image)
                          <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-16 h-16 rounded-lg object-cover shadow-md border-2 border-gray-200">
                        @else
                          <div class="w-16 h-16 rounded-lg bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                            <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                          </div>
                        @endif
                        @if($product->stock > 0)
                          <div class="absolute -top-1 -right-1 w-4 h-4 bg-[#00a37a] rounded-full border-2 border-white"></div>
                        @else
                          <div class="absolute -top-1 -right-1 w-4 h-4 bg-[#e57373] rounded-full border-2 border-white"></div>
                        @endif
                      </div>
                      <div>
                        <p class="font-semibold text-gray-900">{{ Str::limit($product->name, 40) }}</p>
                        @if($product->description)
                          <p class="text-xs text-gray-500 mt-1">{{ Str::limit($product->description, 50) }}</p>
                        @endif
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4 text-center">
                    <span class="px-3 py-1 bg-[#e6f3ff] text-[#5da5e5] text-xs font-semibold rounded-full">
                      {{ $product->category->name ?? 'N/A' }}
                    </span>
                  </td>
                  <td class="px-6 py-4 text-center">
                    <p class="font-bold text-[#00a37a] text-lg">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                  </td>
                  <td class="px-6 py-4 text-center">
                    <div class="flex items-center justify-center gap-2">
                      @if($product->stock == 0)
                        <span class="w-2 h-2 bg-[#e57373] rounded-full"></span>
                      @elseif($product->stock < 10)
                        <span class="w-2 h-2 bg-[#f5d46b] rounded-full"></span>
                      @else
                        <span class="w-2 h-2 bg-[#00a37a] rounded-full"></span>
                      @endif
                      <span class="font-bold text-gray-900">{{ $product->stock }}</span>
                      <span class="text-gray-400 text-sm">unit</span>
                    </div>
                  </td>
                  <td class="px-6 py-4 text-center">
                    @if($product->stock == 0)
                      <span class="px-3 py-1 bg-[#fdecec] text-[#d56363] text-xs font-semibold rounded-full">
                        Habis
                      </span>
                    @elseif($product->stock < 10)
                      <span class="px-3 py-1 bg-[#fff9e6] text-[#d4a647] text-xs font-semibold rounded-full">
                        Menipis
                      </span>
                    @else
                      <span class="px-3 py-1 bg-[#e6f4f1] text-[#00a37a] text-xs font-semibold rounded-full">
                        Tersedia
                      </span>
                    @endif
                  </td>
                  <td class="px-6 py-4">
                    <div class="flex justify-center gap-2">
                      <a href="{{ route('admin.products.edit', $product->id) }}" class="p-2 bg-[#6bb5f5] hover:bg-[#5da5e5] text-white rounded-lg transition shadow-md hover:shadow-lg" title="Edit">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                      </a>
                      <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2 bg-[#e57373] hover:bg-[#d56363] text-white rounded-lg transition shadow-md hover:shadow-lg" title="Hapus">
                          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                          </svg>
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

      <!-- Pagination -->
      <div class="bg-white rounded-xl shadow-lg p-6">
        {{ $products->links() }}
      </div>
    @else
      <!-- Empty State -->
      <div class="bg-white rounded-xl shadow-lg p-12 text-center">
        <div class="w-24 h-24 bg-gradient-to-br from-[#e6f4f1] to-[#d0ede6] rounded-full flex items-center justify-center mx-auto mb-6">
          <svg class="w-12 h-12 text-[#00a37a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
          </svg>
        </div>
        <h3 class="text-2xl font-bold text-gray-900 mb-2">Belum Ada Produk</h3>
        <p class="text-gray-600 mb-8 max-w-md mx-auto">Mulai tambahkan produk pertama Anda untuk memulai berjualan di platform kami</p>
        <a href="{{ route('admin.products.add') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-[#00a37a] to-[#00b385] text-white rounded-xl hover:from-[#00b385] hover:to-[#00c390] font-semibold shadow-lg hover:shadow-xl transition">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
          </svg>
          Tambah Produk Pertama
        </a>
      </div>
    @endif

  </div>
</div>
@endsection
