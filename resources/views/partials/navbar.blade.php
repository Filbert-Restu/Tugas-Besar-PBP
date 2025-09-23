<nav class="bg-white shadow-md p-2">
    <div class="max-w-7xl px-4 sm:px-6 lg:px-8 mx-auto">
        <div class="flex justify-between">
            <!-- Logo and Brand Name -->
            <p class="flex-shrink-0 flex items-center text-4xl font-bold leading-tight">
                <a href="{{ route('main') }}" class=" text-orange-600">Sho<span class="text-green-600">Ped</span></a>
            </p>

            <!-- Navigation Links -->
            <p class="hidden md:flex items-center space-x-8 ml-4">
                <a href="/categories" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium">Kategori</a>
            </p>

            <!-- Search Bar -->
            <div class="hidden md:flex items-center flex-1 mx-8">
                <div class="w-full max-w-lg">
                    <form action="{{ route('search') }}" method="GET" class="relative">
                        <input
                            type="text"
                            name="q"
                            class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-indigo-500"
                            placeholder="Search products..."
                        >
                        <div class="absolute left-3 top-3">
                            <svg class="h-4 w-4 fill-current text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"></path>
                            </svg>
                        </div>
                    </form>
                </div>
            </div>


            <!-- Right Side Icons -->
            <div class="flex items-center space-x-4">
                <!-- Cart -->
                <a href="/cart" class="text-gray-700 hover:text-indigo-600 relative">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span class="absolute -top-2 -right-2 bg-indigo-600 text-white rounded-full text-xs px-1.5">3</span>
                </a>

                <!-- User Account -->
                <a href="{{ route('user.index') }}" class="text-gray-700 hover:text-indigo-600">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </a>

                <!-- Mobile Menu Button (only shows on small screens) -->
                <button type="button" class="md:hidden bg-white p-2 rounded-md text-gray-500 hover:text-indigo-600 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu (hidden by default) -->
    <div class="hidden md:hidden">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <a href="/" class="block px-3 py-2 rounded-md text-base font-medium text-indigo-600 bg-indigo-50">Home</a>
            <a href="/products" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50">Products</a>
            <a href="/categories" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50">Categories</a>
            <a href="/deals" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50">Deals</a>
        </div>
        <div class="pt-4 pb-3 border-t border-gray-200">
            <div class="px-2 space-y-1">
                <a href="/account" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50">My Account</a>
                <a href="/orders" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50">My Orders</a>
                <a href="/wishlist" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50">Wishlist</a>
                <a href="/logout" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50">Sign out</a>
            </div>
        </div>
    </div>
</nav>
