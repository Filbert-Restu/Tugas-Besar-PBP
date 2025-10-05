<!-- Sidebar -->
<aside class="w-64 min-h-screen bg-white shadow-xl flex flex-col justify-between">
  <div>
    <!-- Header -->
    <div class="bg-gradient-to-r from-green-600 to-emerald-600 text-white px-6 py-6">
      <div class="flex items-center gap-3">
        <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center">
          <span class="text-green-600 font-bold text-xl">K</span>
        </div>
        <div>
          <h1 class="font-bold text-lg">KlikMart</h1>
          <p class="text-xs text-green-100">Admin Centre</p>
        </div>
      </div>
    </div>

    <!-- Navigation -->
    <nav class="flex flex-col gap-2 mt-8 px-4">
      <!-- Dashboard -->
      <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-green-50 hover:text-green-600 transition-all group">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400 group-hover:text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6" />
        </svg>
        <span class="font-medium">Dashboard</span>
      </a>

      <!-- Kategori -->
      <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-green-50 hover:text-green-600 transition-all group">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400 group-hover:text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
        </svg>
        <span class="font-medium">Kelola Kategori</span>
      </a>

      <!-- Produk -->
      <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-green-50 hover:text-green-600 transition-all group">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400 group-hover:text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0a2 2 0 01-2 2H6a2 2 0 01-2-2m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5" />
        </svg>
        <span class="font-medium">Produk Saya</span>
      </a>

      <!-- Pesanan -->
      <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-green-50 hover:text-green-600 transition-all group">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400 group-hover:text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M9 12h6m-6 4h6m-2-10h2a2 2 0 012 2v10a2 2 0 01-2 2H7a2 2 0 01-2-2V8a2 2 0 012-2h2l1-2h4l1 2z" />
        </svg>
        <span class="font-medium">Pesanan Saya</span>
      </a>

      <!-- Manajemen User -->
      <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-green-50 hover:text-green-600 transition-all group">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400 group-hover:text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M17 20h5v-2a4 4 0 00-4-4h-1m-4 6v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2h9zM9 10a4 4 0 110-8 4 4 0 010 8zm6 0a4 4 0 110-8 4 4 0 010 8z" />
        </svg>
        <span class="font-medium">Manajemen User</span>
      </a>
    </nav>
  </div>

  <!-- Logout Button -->
  <div class="p-4 border-t border-gray-100">
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit"
        class="w-full flex items-center justify-center gap-2 bg-gradient-to-r from-red-500 to-pink-500 text-white font-medium px-4 py-3 rounded-lg shadow hover:from-red-600 hover:to-pink-600 transition-all">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h4a2 2 0 012 2v1" />
        </svg>
        Logout
      </button>
    </form>
  </div>
</aside>
