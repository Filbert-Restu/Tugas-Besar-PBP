    <!-- Sidebar -->
    {{-- bg bottom rounded --}}
    <aside class="w-64 h-screen bg-white shadow-xl flex flex-col rounded-b-lg sticky top-0 left-0 z-40">
      <!-- Header -->
      <div class="bg-gradient-to-br from-green-600 via-emerald-600 to-teal-600 text-white px-6 py-6">
        <div class="flex items-center gap-3">
          <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-lg transform hover:scale-105 transition-transform">
            <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
          </div>
          <div>
            <h1 class="font-bold text-xl tracking-tight">KlikMart</h1>
            <p class="text-xs text-green-100 flex items-center gap-1">
              <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
              </svg>
              Admin Panel
            </p>
          </div>
        </div>
      </div>

      <!-- Navigation -->
      <nav class="flex-1 flex flex-col gap-1 mt-6 px-3">
        <div class="px-3 mb-2">
          <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Menu Utama</span>
        </div>

        <a href="{{ route('admin.dashboard') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all group {{ request()->routeIs('admin.dashboard') ? 'bg-gradient-to-r from-green-600 to-emerald-600 text-white shadow-lg shadow-green-200' : 'hover:bg-green-50 hover:text-green-600 text-gray-700' }}">
          <svg class="w-5 h-5 {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-gray-400 group-hover:text-green-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
          </svg>
          <span class="font-medium">Dashboard</span>
          @if(request()->routeIs('admin.dashboard'))
            <svg class="w-4 h-4 ml-auto" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
            </svg>
          @endif
        </a>

        <a href="{{ route('admin.products.index') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all group {{ request()->routeIs('admin.products.*') ? 'bg-gradient-to-r from-green-600 to-emerald-600 text-white shadow-lg shadow-green-200' : 'hover:bg-green-50 hover:text-green-600 text-gray-700' }}">
          <svg class="w-5 h-5 {{ request()->routeIs('admin.products.*') ? 'text-white' : 'text-gray-400 group-hover:text-green-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
          </svg>
          <span class="font-medium">Produk</span>
          @if(request()->routeIs('admin.products.*'))
            <svg class="w-4 h-4 ml-auto" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
            </svg>
          @endif
        </a>

        <a href="{{ route('admin.orders.index') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all group {{ request()->routeIs('admin.orders.*') ? 'bg-gradient-to-r from-green-600 to-emerald-600 text-white shadow-lg shadow-green-200' : 'hover:bg-green-50 hover:text-green-600 text-gray-700' }}">
          <svg class="w-5 h-5 {{ request()->routeIs('admin.orders.*') ? 'text-white' : 'text-gray-400 group-hover:text-green-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
          </svg>
          <span class="font-medium">Pesanan</span>
          @if(request()->routeIs('admin.orders.*'))
            <svg class="w-4 h-4 ml-auto" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
            </svg>
          @endif
        </a>
      </nav>

      <!-- User Profile & Logout -->
      <div class="border-t border-gray-200 px-3 py-3 mt-auto">
        <div class="flex items-center gap-3 px-3 py-2 mb-3">
          <div class="w-10 h-10 bg-gradient-to-br from-green-400 to-emerald-500 rounded-full flex items-center justify-center text-white font-bold shadow-md">
            {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
          </div>
          <div class="flex-1 min-w-0">
            <p class="text-sm font-semibold text-gray-900 truncate">{{ auth()->user()->name ?? 'Admin' }}</p>
            <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email ?? 'admin@klikmart.com' }}</p>
          </div>
        </div>

        <form method="POST" action="{{ route('logout') }}" class="w-full">
          @csrf
          <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white rounded-xl font-medium shadow-md hover:shadow-lg transition-all transform hover:scale-[1.02] active:scale-[0.98]">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
            </svg>
            <span>Keluar</span>
          </button>
        </form>
      </div>
    </aside>
