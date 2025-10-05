@extends('layouts.admin')

@section('content')
  <div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
      <div>
        <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-3">
          <div class="w-10 h-10 bg-gradient-to-br from-green-400 to-emerald-500 rounded-lg flex items-center justify-center">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
            </svg>
          </div>
          Produk Saya
        </h1>
        <p class="text-gray-500 mt-1">Kelola semua produk toko Anda</p>
      </div>
      <a href="{{ route('admin.products.add') }}" class="px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 text-white rounded-xl shadow-lg hover:shadow-xl hover:from-green-700 hover:to-emerald-700 transition-all flex items-center gap-2 font-medium">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Tambah Produk Baru
      </a>
    </div>

    <!-- Products Table -->
    <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100">
      <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
          <thead>
            <tr class="bg-gradient-to-r from-gray-50 to-gray-100">
              <th class="p-5 font-semibold text-gray-700 text-sm">PRODUK</th>
              <th class="p-5 font-semibold text-gray-700 text-sm">PENJUALAN</th>
              <th class="p-5 font-semibold text-gray-700 text-sm">HARGA</th>
              <th class="p-5 font-semibold text-gray-700 text-sm">STOK</th>
              <th class="p-5 font-semibold text-gray-700 text-sm">AKSI</th>
            </tr>
          </thead>
          <tbody>
            <tr class="border-t border-gray-100 hover:bg-green-50 transition-colors">
              <td class="p-5">
                <div class="flex items-center gap-4">
                  <div class="relative">
                    <img src="https://dummyimage.com/80x80/cccccc/000000&text=Lip" class="w-16 h-16 rounded-xl object-cover shadow-md border-2 border-gray-200">
                    <div class="absolute -top-1 -right-1 w-5 h-5 bg-green-500 rounded-full border-2 border-white"></div>
                  </div>
                  <div>
                    <p class="font-semibold text-gray-800 text-base">Lip Cream</p>
                    <div class="flex items-center gap-2 mt-1">
                      <span class="px-2 py-1 bg-purple-100 text-purple-700 text-xs font-medium rounded-md">Kosmetik</span>
                    </div>
                  </div>
                </div>
              </td>
              <td class="p-5">
                <div class="flex items-center gap-2">
                  <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                  </div>
                  <span class="text-gray-600 font-medium">0</span>
                </div>
              </td>
              <td class="p-5">
                <p class="font-bold text-green-600 text-lg">Rp20.000</p>
              </td>
              <td class="p-5">
                <div class="flex items-center gap-2">
                  <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                  <span class="font-semibold text-gray-800">120</span>
                  <span class="text-gray-400 text-sm">unit</span>
                </div>
              </td>
              <td class="p-5">
                <div class="flex gap-2">
                  <button class="px-4 py-2 bg-gradient-to-r from-blue-500 to-indigo-500 text-white rounded-lg hover:from-blue-600 hover:to-indigo-600 transition-all shadow-md hover:shadow-lg flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit
                  </button>
                  <button class="px-4 py-2 bg-gradient-to-r from-red-500 to-pink-500 text-white rounded-lg hover:from-red-600 hover:to-pink-600 transition-all shadow-md hover:shadow-lg flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    Hapus
                  </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Empty State (commented - uncomment if no products) -->
      <!-- <div class="p-12 text-center">
        <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
          <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
          </svg>
        </div>
        <h3 class="text-lg font-semibold text-gray-800 mb-2">Belum Ada Produk</h3>
        <p class="text-gray-500 mb-6">Mulai tambahkan produk pertama Anda untuk berjualan</p>
        <a href="#" class="inline-flex items-center gap-2 px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
          </svg>
          Tambah Produk
        </a>
      </div> -->
    </div>
  </div>
@endsection
