<nav x-data="{ isMobileMenuOpen: false, isSearchOpen: false }" class="bg-white shadow-sm">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">

            {{-- ==== KIRI: Logo & Kategori ==== --}}
            <div class="flex items-center space-x-8">
                <a href="{{ route('main') }}" class="text-2xl font-bold text-emerald-500 tracking-wider">
                    KlikMart
                </a>

                <div class="hidden md:flex relative group">
                    <a href="#" class="text-gray-700 hover:text-emerald-500 font-semibold flex items-center">
                        <span>Kategori</span>
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </a>
                    <div class="absolute z-20 hidden group-hover:block mt-6 w-48 bg-white rounded-md shadow-lg py-1">
                        @include('partials.categories-dropdown')
                    </div>
                </div>
            </div>

            {{-- ==== TENGAH: Search ==== --}}
            <div class="hidden md:flex flex-grow justify-center px-8">
                <form action="{{ route('search') }}" method="GET" class="relative w-full max-w-lg">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </span>
                    <input type="text" name="q" placeholder="Cari Produk"
                        class="w-full bg-gray-100 text-gray-900 placeholder-gray-500 border border-transparent rounded-lg py-2 pl-12 pr-4 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:bg-white">
                </form>
            </div>

            {{-- ==== KANAN: Cart, Profile, Logout, Mobile ==== --}}
            <div class="flex items-center space-x-5">
                {{-- Tombol Search (mobile) --}}
                <button @click="isSearchOpen = !isSearchOpen" class="md:hidden text-gray-600 hover:text-emerald-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>

                {{-- Keranjang --}}
                <a href="{{ route('cart.index') }}" class="relative text-gray-600 hover:text-emerald-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>

                    @auth
                        @if ($userCartQty > 0)
                            <span
                                class="absolute -top-2 -right-3 bg-emerald-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                                {{ $userCartQty }}
                            </span>
                        @endif
                    @endauth
                </a>

                {{-- Profile --}}
                <a href="{{ route('user.index') }}" class="text-gray-600 hover:text-emerald-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </a>

                {{-- Logout --}}
                @auth
                    <form method="POST" action="{{ route('logout') }}" class="hidden md:block">
                        @csrf
                        <button type="submit"
                            class="flex items-center gap-2 bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded-lg transition shadow">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h4a2 2 0 012 2v1" />
                            </svg>
                            <span>Logout</span>
                        </button>
                    </form>
                @endauth

                {{-- Tombol Menu Mobile --}}
                <div class="md:hidden">
                    <button @click="isMobileMenuOpen = !isMobileMenuOpen" class="text-gray-600 hover:text-emerald-500">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16m4 6h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- ==== SEARCH RESPONSIVE ==== --}}
        <div x-show="isSearchOpen" x-transition class="md:hidden pb-4">
            <form action="{{ route('search') }}" method="GET" class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </span>
                <input type="text" name="q" placeholder="Cari Produk"
                    class="w-full bg-gray-100 text-gray-900 placeholder-gray-500 border border-transparent rounded-lg py-2 pl-12 pr-4 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:bg-white"
                    autofocus>
            </form>
        </div>

        {{-- ==== MENU MOBILE ==== --}}
        <div x-show="isMobileMenuOpen" x-transition class="md:hidden" x-cloak>
            <div class="pt-2 pb-3 space-y-1 border-t border-gray-200">
                <a href="{{ route('main') }}"
                    class="block pl-3 pr-4 py-2 border-l-4 border-emerald-500 text-base font-medium text-emerald-700 bg-emerald-50">Home</a>
                <a href="#"
                    class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800">Kategori</a>
                <a href="#"
                    class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800">Promo</a>

                {{-- Logout di menu mobile --}}
                @auth
                    <form method="POST" action="{{ route('logout') }}" class="pl-3 pr-4 py-2">
                        @csrf
                        <button type="submit"
                            class="w-full text-left bg-red-500 hover:bg-red-600 text-white font-medium px-4 py-2 rounded-lg transition">
                            Logout
                        </button>
                    </form>
                @endauth
            </div>
        </div>
    </div>
</nav>
