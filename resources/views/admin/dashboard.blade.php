@extends('layouts.admin')

@section('content')
  <div class="max-w-6xl mx-auto">
    <!-- Welcome Card -->
    <div class="bg-gradient-to-r from-green-500 to-emerald-600 rounded-2xl shadow-xl p-8 mb-8 text-white relative overflow-hidden">
      <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full -mr-32 -mt-32"></div>
      <div class="absolute bottom-0 left-0 w-48 h-48 bg-white opacity-5 rounded-full -ml-24 -mb-24"></div>
      <div class="relative z-10">
        <div class="flex items-center gap-3 mb-2">
          <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
          </div>
          <div>
            <p class="text-green-100 text-sm">Selamat Datang Kembali,</p>
            <h1 class="text-3xl font-bold">Admin Klik!</h1>
          </div>
        </div>
      </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
      <!-- Total Produk -->
      <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-shadow border border-gray-100">
        <div class="flex items-start justify-between">
          <div>
            <p class="text-gray-500 text-sm font-medium mb-1">Total Produk</p>
            <p class="text-4xl font-bold text-gray-800">0</p>
            <div class="flex items-center gap-2 mt-3">
              <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">Aktif</span>
            </div>
          </div>
          <div class="w-14 h-14 bg-gradient-to-br from-green-400 to-emerald-500 rounded-xl flex items-center justify-center shadow-lg">
            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
            </svg>
          </div>
        </div>
        <div class="mt-4 pt-4 border-t border-gray-100">
        </div>
      </div>

      <!-- Total Pesanan -->
      <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition-shadow border border-gray-100">
        <div class="flex items-start justify-between">
          <div>
            <p class="text-gray-500 text-sm font-medium mb-1">Total Pesanan</p>
            <p class="text-4xl font-bold text-gray-800">0</p>
            <div class="flex items-center gap-2 mt-3">
              <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded-full">Hari Ini</span>
            </div>
          </div>
          <div class="w-14 h-14 bg-gradient-to-br from-blue-400 to-indigo-500 rounded-xl flex items-center justify-center shadow-lg">
            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
            </svg>
          </div>
        </div>
        <div class="mt-4 pt-4 border-t border-gray-100">
        </div>
      </div>
      </div>
    </div>
    {{-- logout --}}
    <div class="text-center">
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="mt-4 bg-red-500 hover:bg-red-600 text-white font-semibold px-6 py-2 rounded-lg transition">
          Logout
        </button>
      </form>
  </div>
@endsection
