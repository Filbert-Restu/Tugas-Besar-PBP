@extends('layouts.app')

@section('content')
  <div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-6">
      <div class="flex items-center gap-3 mb-2">
        <a href="{{ route('products') }}" class="w-10 h-10 bg-white rounded-lg flex items-center justify-center shadow-md hover:shadow-lg transition-shadow border border-gray-200">
          <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
          </svg>
        </a>
        <div>
          <h1 class="text-3xl font-bold text-gray-800">Tambah Produk Baru</h1>
          <p class="text-gray-500 mt-1">Lengkapi informasi produk Anda</p>
        </div>
      </div>
    </div>

    <!-- Form -->
    <form class="bg-white shadow-xl rounded-2xl p-8 space-y-6 border border-gray-100">
      <!-- Image Upload Section -->
      <div>
        <label class="block text-sm font-semibold text-gray-700 mb-3">Foto Produk</label>
        <div class="relative group">
          <div class="border-2 border-dashed border-gray-300 rounded-2xl flex flex-col items-center justify-center p-12 text-gray-500 cursor-pointer hover:border-green-500 hover:bg-green-50 transition-all bg-gradient-to-br from-gray-50 to-gray-100">
            <div class="w-16 h-16 bg-gradient-to-br from-green-400 to-emerald-500 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
              </svg>
            </div>
            <p class="text-base font-semibold text-gray-700 mb-1">Upload Gambar Produk</p>
            <p class="text-sm text-gray-500">PNG, JPG hingga 5MB</p>
          </div>
        </div>
      </div>

      <!-- Product Name -->
      <div>
        <label class="block text-sm font-semibold text-gray-700 mb-3">Nama Produk</label>
        <div class="relative">
          <input type="text" placeholder="Masukkan nama produk" class="w-full border-2 border-gray-200 rounded-xl p-4 focus:border-green-500 focus:ring-4 focus:ring-green-100 outline-none transition-all text-gray-800 placeholder-gray-400">
          <div class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
            </svg>
          </div>
        </div>
      </div>

      <!-- Product Description -->
      <div>
        <label class="block text-sm font-semibold text-gray-700 mb-3">Deskripsi Produk</label>
        <textarea placeholder="Ceritakan detail produk Anda..." rows="5" class="w-full border-2 border-gray-200 rounded-xl p-4 focus:border-green-500 focus:ring-4 focus:ring-green-100 outline-none transition-all text-gray-800 placeholder-gray-400 resize-none"></textarea>
        <p class="text-xs text-gray-500 mt-2 flex items-center gap-1">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
          </svg>
          Jelaskan fitur dan keunggulan produk Anda
        </p>
      </div>

      <!-- Product Details Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Category -->
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-3">Kategori Produk</label>
          <div class="relative">
            <input type="text" placeholder="Contoh: Kosmetik, Fashion" class="w-full border-2 border-gray-200 rounded-xl p-4 focus:border-green-500 focus:ring-4 focus:ring-green-100 outline-none transition-all text-gray-800 placeholder-gray-400">
            <div class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
              </svg>
            </div>
          </div>
        </div>

        <!-- Weight -->
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-3">Berat Produk</label>
          <div class="relative">
            <input type="text" placeholder="Contoh: 100" class="w-full border-2 border-gray-200 rounded-xl p-4 pr-16 focus:border-green-500 focus:ring-4 focus:ring-green-100 outline-none transition-all text-gray-800 placeholder-gray-400">
            <div class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 font-medium text-sm">
              gram
            </div>
          </div>
        </div>

        <!-- Price -->
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-3">Harga Produk</label>
          <div class="relative">
            <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-semibold">
              Rp
            </div>
            <input type="text" placeholder="0" class="w-full border-2 border-gray-200 rounded-xl p-4 pl-12 focus:border-green-500 focus:ring-4 focus:ring-green-100 outline-none transition-all text-gray-800 placeholder-gray-400">
          </div>
        </div>

        <!-- Stock -->
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-3">Stok Produk</label>
          <div class="relative">
            <input type="text" placeholder="Contoh: 100" class="w-full border-2 border-gray-200 rounded-xl p-4 pr-16 focus:border-green-500 focus:ring-4 focus:ring-green-100 outline-none transition-all text-gray-800 placeholder-gray-400">
            <div class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 font-medium text-sm">
              unit
            </div>
          </div>
        </div>
      </div>

      <!-- Info Box -->
      <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-xl p-4 flex gap-3">
        <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center flex-shrink-0">
          <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
          </svg>
        </div>
        <div class="flex-1">
          <p class="text-sm font-semibold text-blue-800 mb-1">Tips Produk Berkualitas</p>
          <p class="text-xs text-blue-700">Gunakan foto yang jelas, deskripsi detail, dan harga yang kompetitif untuk menarik lebih banyak pembeli.</p>
        </div>
      </div>

      <!-- Action Buttons -->
      <div class="flex flex-col sm:flex-row gap-3 pt-4">
        <button type="submit" class="flex-1 sm:flex-none px-8 py-4 bg-gradient-to-r from-green-600 to-emerald-600 text-white rounded-xl shadow-lg hover:shadow-xl hover:from-green-700 hover:to-emerald-700 transition-all font-semibold flex items-center justify-center gap-2">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
          </svg>
          Simpan Produk
        </button>
        <a href="{{ route('products') }}" class="flex-1 sm:flex-none px-8 py-4 bg-gradient-to-r from-gray-700 to-gray-800 text-white rounded-xl shadow-lg hover:shadow-xl hover:from-gray-800 hover:to-gray-900 transition-all font-semibold flex items-center justify-center gap-2">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
          Batal
        </a>
      </div>
    </form>
  </div>
@endsection