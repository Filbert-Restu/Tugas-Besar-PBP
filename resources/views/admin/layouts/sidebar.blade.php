<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 
    transition-transform -translate-x-full bg-white border-r border-gray-200 
    sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">

  <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
    <ul class="space-y-2 font-medium">
      <li>
        <a href="{{ route('admin.dashboard') }}" 
           class="flex items-center p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 
                  {{ request()->routeIs('admin.dashboard') ? 'bg-blue-500 text-white' : 'text-gray-700 dark:text-white' }}">
          📊 <span class="ml-2">Dashboard</span>
        </a>
      </li>
      <li>
        <a href="{{ route('products.index') }}" 
           class="flex items-center p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 
                  {{ request()->is('admin/products*') ? 'bg-blue-500 text-white' : 'text-gray-700 dark:text-white' }}">
          🛒 <span class="ml-2">Produk</span>
        </a>
      </li>
      <li>
        <a href="{{ route('orders.index') }}" 
           class="flex items-center p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 
                  {{ request()->is('admin/orders*') ? 'bg-blue-500 text-white' : 'text-gray-700 dark:text-white' }}">
          📦 <span class="ml-2">Pesanan</span>
        </a>
      </li>
      <li>
        <a href="{{ route('admin.users') }}" 
           class="flex items-center p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 
                  {{ request()->is('admin/users*') ? 'bg-blue-500 text-white' : 'text-gray-700 dark:text-white' }}">
          👥 <span class="ml-2">Users</span>
        </a>
      </li>
    </ul>
  </div>
</aside>
