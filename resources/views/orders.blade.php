@extends('layouts.app')

@section('content')
  <div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="mb-6">
      <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-3">
        <div class="w-10 h-10 bg-gradient-to-br from-amber-400 to-orange-500 rounded-lg flex items-center justify-center">
          <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
          </svg>
        </div>
        Pesanan Saya
      </h1>
      <p class="text-gray-500 mt-1">Kelola dan proses pesanan pelanggan</p>
    </div>

    <!-- Orders Container -->
    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
      <!-- Tabs Navigation -->
      <div class="border-b border-gray-200 bg-gradient-to-r from-gray-50 to-gray-100">
        <div class="flex gap-1 px-6 overflow-x-auto">
          <button class="px-6 py-4 font-semibold text-green-600 border-b-3 border-green-600 whitespace-nowrap flex items-center gap-2 bg-white rounded-t-xl">
            Semua
            <span class="px-2 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full">1</span>
          </button>
          <button class="px-6 py-4 text-gray-500 hover:text-gray-700 hover:bg-gray-50 whitespace-nowrap transition-colors rounded-t-xl flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Belum Bayar
          </button>
          <button class="px-6 py-4 text-gray-500 hover:text-gray-700 hover:bg-gray-50 whitespace-nowrap transition-colors rounded-t-xl flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
            </svg>
            Perlu Dikirim
          </button>
          <button class="px-6 py-4 text-gray-500 hover:text-gray-700 hover:bg-gray-50 whitespace-nowrap transition-colors rounded-t-xl flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path>
            </svg>
            Dikirim
          </button>
          <button class="px-6 py-4 text-gray-500 hover:text-gray-700 hover:bg-gray-50 whitespace-nowrap transition-colors rounded-t-xl flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Selesai
          </button>
          <button class="px-6 py-4 text-gray-500 hover:text-gray-700 hover:bg-gray-50 whitespace-nowrap transition-colors rounded-t-xl flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
            Pembatalan
          </button>
        </div>
      </div>

      <!-- Orders List -->
      <div class="p-6 space-y-4">
        <!-- Order Card -->
        <div class="border-2 border-gray-200 rounded-2xl p-6 hover:border-green-300 hover:shadow-lg transition-all bg-gradient-to-br from-white to-gray-50">
          <!-- Order Header -->
          <div class="flex items-center justify-between mb-4 pb-4 border-b border-gray-200">
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 bg-gradient-to-br from-purple-400 to-pink-500 rounded-full flex items-center justify-center text-white font-bold">
                P1
              </div>
              <div>
                <p class="font-bold text-gray-800">Pembeli 1</p>
                <p class="text-xs text-gray-500 flex items-center gap-1">
                  <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                  </svg>
                  2 jam yang lalu
                </p>
              </div>
            </div>
            <div class="text-right">
              <p class="text-xs text-gray-500 mb-1">Order ID</p>
              <p class="font-mono text-sm font-semibold text-gray-700">#ORD-2024-001</p>
            </div>
          </div>

          <!-- Product Info -->
          <div class="flex items-center gap-4 mb-4">
            <div class="relative">
              <img src="https://dummyimage.com/80x80/cccccc/000000&text=Lip" class="w-20 h-20 rounded-xl object-cover shadow-md border-2 border-gray-200">
              <div class="absolute -top-2 -right-2 w-6 h-6 bg-green-500 text-white rounded-full flex items-center justify-center text-xs font-bold border-2 border-white">
                1
              </div>
            </div>
            <div class="flex-1">
              <p class="font-semibold text-gray-800 text-base">Lip Cream</p>
              <p class="text-sm text-gray-500 flex items-center gap-1 mt-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
                Kosmetik
              </p>
              <p class="text-sm text-gray-600 mt-1">Quantity: <span class="font-semibold">1 unit</span></p>
            </div>
            <div class="text-right">
              <p class="text-sm text-gray-500 mb-1">Total Harga</p>
              <p class="text-2xl font-bold text-green-600">Rp20.000</p>
            </div>
          </div>

          <!-- Status and Actions -->
          <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 pt-4 border-t border-gray-200">
            <div class="flex items-center gap-2">
              <div class="w-2 h-2 bg-yellow-500 rounded-full animate-pulse"></div>
              <span class="px-4 py-2 bg-gradient-to-r from-yellow-100 to-amber-100 text-yellow-700 font-semibold rounded-xl border border-yellow-300 text-sm">
                Perlu Dikirim
              </span>
            </div>
            
            <div class="flex items-center gap-3 w-full sm:w-auto">
              <select class="flex-1 sm:flex-none border-2 border-gray-300 rounded-xl px-4 py-2 focus:border-green-500 focus:ring-4 focus:ring-green-100 outline-none transition-all font-medium text-gray-700 cursor-pointer bg-white">
                <option>Perlu Dikirim</option>
                <option>Dikirim</option>
                <option>Selesai</option>
              </select>
              <button class="px-5 py-2 bg-gradient-to-r from-blue-500 to-indigo-500 text-white rounded-xl hover:from-blue-600 hover:to-indigo-600 transition-all shadow-md hover:shadow-lg font-medium flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
                Detail
              </button>
            </div>
          </div>
        </div>

        <!-- Empty State (uncomment if no orders) -->
        <!-- <div class="p-16 text-center">
          <div class="w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
            </svg>
          </div>
          <h3 class="text-xl font-bold text-gray-800 mb-2">Belum Ada Pesanan</h3>
          <p class="text-gray-500 mb-6">Pesanan dari pelanggan akan muncul di sini</p>
        </div> -->
      </div>
    </div>
  </div>
@endsection