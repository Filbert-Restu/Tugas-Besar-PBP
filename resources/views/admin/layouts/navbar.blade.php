<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 
            dark:bg-gray-800 dark:border-gray-700">
  <div class="px-3 py-3 lg:px-5 lg:pl-3 flex items-center justify-between">
    <!-- Left -->
    <div class="flex items-center">
      <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" 
              aria-controls="logo-sidebar" type="button" 
              class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden 
                     hover:bg-gray-100 focus:ring-2 focus:ring-gray-200 
                     dark:text-gray-400 dark:hover:bg-gray-700">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
          <path clip-rule="evenodd" fill-rule="evenodd" 
                d="M2 4.75h14.5a.75.75 0 010 1.5H2zM2 10h14.5a.75.75 0 010 1.5H2zM2 15.25h14.5a.75.75 0 010 1.5H2z"/>
        </svg>
      </button>
      <span class="ml-3 text-xl font-bold text-blue-600">Admin Panel</span>
    </div>

    <!-- Right -->
    <div class="flex items-center space-x-3">
      <span class="text-gray-700 dark:text-gray-300">Halo, Admin</span>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" 
                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg">
          Logout
        </button>
      </form>
    </div>
  </div>
</nav>
