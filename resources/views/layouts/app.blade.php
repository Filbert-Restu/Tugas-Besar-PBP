<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>KlikMart Admin Centre</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-green-50 via-emerald-50 to-teal-50 min-h-screen">
  <div class="flex">
    <!-- Sidebar -->
    <aside class="w-64 min-h-screen bg-white shadow-xl">
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
      
      <nav class="flex flex-col gap-2 mt-8 px-4">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-green-50 hover:text-green-600 transition-all group">
          <svg class="w-5 h-5 text-gray-400 group-hover:text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
          </svg>
          <span class="font-medium">Dashboard</span>
        </a>
        
        <a href="{{ route('products') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-green-50 hover:text-green-600 transition-all group">
          <svg class="w-5 h-5 text-gray-400 group-hover:text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
          </svg>
          <span class="font-medium">Produk Saya</span>
        </a>
        
        <a href="{{ route('orders') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-green-50 hover:text-green-600 transition-all group">
          <svg class="w-5 h-5 text-gray-400 group-hover:text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
          </svg>
          <span class="font-medium">Pesanan Saya</span>
        </a>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8">
      @yield('content')
    </main>
  </div>
</body>
</html>