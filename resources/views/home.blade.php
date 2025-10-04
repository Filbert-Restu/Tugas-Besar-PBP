@extends('layout')

@section('title', 'KlikMart - Belanja Klik, Semua Asik')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-r from-sky-300 via-cyan-300 to-blue-300 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <div class="bg-white rounded-2xl shadow-xl p-10 max-w-xl mx-auto">
                <div class="text-5xl mb-5">🛒</div>
                <h1 class="text-3xl font-bold text-gray-800 mb-5">Belanja Klik, Semua Asik</h1>
                <a href="#products" class="inline-block bg-teal-500 hover:bg-teal-600 text-white font-semibold px-7 py-3 rounded-lg transition">
                    Temukan Produk Kami
                </a>
            </div>
            
            <!-- Shopping Bags Decoration -->
            <div class="mt-10 flex justify-center items-end space-x-3">
                <div class="w-16 h-20 bg-orange-400 rounded-t-xl"></div>
                <div class="w-14 h-16 bg-blue-300 rounded-t-xl"></div>
                <div class="w-20 h-24 bg-orange-500 rounded-t-xl"></div>
                <div class="w-16 h-28 bg-blue-500 rounded-t-xl"></div>
                <div class="w-14 h-20 bg-red-400 rounded-t-xl"></div>
                <div class="w-16 h-16 bg-yellow-400 rounded-t-xl"></div>
                <div class="w-20 h-24 bg-blue-400 rounded-t-xl"></div>
                <div class="w-14 h-20 bg-red-500 rounded-t-xl"></div>
                <div class="w-16 h-24 bg-blue-200 rounded-t-xl"></div>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="flex flex-col lg:flex-row gap-6">
        <!-- Sidebar Categories -->
        <aside class="lg:w-56 flex-shrink-0">
            <div class="bg-teal-50 rounded-xl p-5 sticky top-20">
                <h2 class="text-lg font-bold text-gray-800 mb-4">Kategori</h2>
                <ul class="space-y-2">
                    @foreach($categories as $category)
                    <li>
                        <a href="{{ route('home', ['category' => $category, 'search' => $currentSearch]) }}" 
                           class="block text-gray-700 hover:text-teal-600 hover:bg-teal-100 px-3 py-2 rounded-lg transition text-sm {{ $currentCategory === $category ? 'bg-teal-100 text-teal-600 font-semibold' : '' }}">
                            {{ $category }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </aside>

        <!-- Products Section -->
        <div class="flex-1" id="products">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Produk</h2>
                <div class="relative">
                    <input type="text" id="searchInput" value="{{ $currentSearch }}" placeholder="Cari" class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent w-64">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400 text-sm"></i>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5" id="productsGrid">
                @forelse($products as $product)
                <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition overflow-hidden">
                    <a href="{{ route('product', $product['id']) }}" class="block h-40 bg-gradient-to-br {{ $product['gradient'] }} flex items-center justify-center">
                        <i class="fas {{ $product['icon'] }} text-5xl {{ $product['icon_color'] }}"></i>
                    </a>
                    <div class="p-4">
                        <a href="{{ route('product', $product['id']) }}" class="block">
                            <h3 class="font-semibold text-gray-800 mb-2 hover:text-teal-600 transition text-sm">{{ $product['name'] }}</h3>
                        </a>
                        <div class="flex items-center justify-between">
                            <span class="text-teal-600 font-bold">Rp{{ number_format($product['price'], 0, ',', '.') }}</span>
                            <form action="{{ route('cart.add') }}" method="POST" class="inline">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                                <button type="submit" class="bg-teal-500 text-white px-3 py-1.5 rounded-lg text-xs hover:bg-teal-600 transition">
                                    Beli
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-12">
                    <i class="fas fa-search text-6xl text-gray-300 mb-4"></i>
                    <p class="text-gray-600 text-lg">Produk tidak ditemukan</p>
                    <a href="{{ route('home') }}" class="inline-block mt-4 text-teal-600 hover:text-teal-700 font-semibold">
                        Lihat Semua Produk
                    </a>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<script>
// Real-time search
let searchTimeout;
const searchInput = document.getElementById('searchInput');

searchInput.addEventListener('input', function() {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        const search = this.value;
        const category = '{{ $currentCategory }}';
        const url = new URL(window.location.href);
        url.searchParams.set('search', search);
        url.searchParams.set('category', category);
        window.location.href = url.toString();
    }, 500);
});
</script>
@endsection