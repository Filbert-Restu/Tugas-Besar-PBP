@extends('layouts.app')

@section('title', 'KlikMart - Belanja Klik, Semua Asik')

@section('content')
<!-- Hero Section -->
<div class="relative h-screen bg-gradient-to-br from-green-200 via-emerald-300 to-green-400 flex items-center justify-center overflow-hidden">
  <!-- Decorative Background Shapes -->
  <div class="absolute inset-0 overflow-hidden">
    <div class="absolute w-[600px] h-[600px] bg-emerald-500/30 rounded-full blur-3xl top-[-100px] left-[-150px]"></div>
    <div class="absolute w-[500px] h-[500px] bg-lime-400/30 rounded-full blur-3xl bottom-[-150px] right-[-100px]"></div>
  </div>

  <!-- Floating Icons -->
  <img src="https://cdn-icons-png.flaticon.com/512/3081/3081559.png" alt="cart" class="absolute w-20 top-24 left-16 opacity-60 animate-float-slow" />
  <img src="https://cdn-icons-png.flaticon.com/512/891/891462.png" alt="leaf" class="absolute w-16 bottom-24 right-20 opacity-50 animate-float-medium" />
  <img src="https://cdn-icons-png.flaticon.com/512/869/869869.png" alt="box" class="absolute w-24 top-1/2 right-32 opacity-40 animate-float-slow" />

  <!-- Hero Content -->
  <div class="relative z-8 text-center text-gray-800 px-6 animate-fadeInUp">
    <div class="bg-white/30 backdrop-blur-md rounded-3xl p-10 shadow-2xl inline-block">
      <h1 class="text-4xl sm:text-7xl font-extrabold tracking-tight text-green-900 mb-6 drop-shadow-md">
        Belanja Hemat, Hidup Sehat 🌿
      </h1>
      <p class="text-lg sm:text-xl text-gray-700 max-w-2xl mx-auto mb-10">
        Temukan berbagai produk UMKM terbaik dan berkualitas untuk kebutuhan sehari-hari Anda.
      </p>
      <div class="flex justify-center gap-4">
        <a href="#products" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-8 py-3 rounded-xl shadow-lg transition-transform transform hover:scale-105">
          Mulai Belanja
        </a>
        <a href="#" class="text-green-800 font-semibold hover:underline">Pelajari Lebih Lanjut →</a>
      </div>
    </div>
  </div>

  <style>
    @keyframes fadeInUp {
      0% { opacity: 0; transform: translateY(40px); }
      100% { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeInUp {
      animation: fadeInUp 1.2s ease-out forwards;
    }

    @keyframes fadeInSlow {
      0% { opacity: 0; }
      100% { opacity: 1; }
    }
    .animate-fadeInSlow {
      animation: fadeInSlow 2s ease-in forwards;
    }

    @keyframes float-slow {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-12px); }
    }
    .animate-float-slow {
      animation: float-slow 5s ease-in-out infinite;
    }

    @keyframes float-medium {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-20px); }
    }
    .animate-float-medium {
      animation: float-medium 3.5s ease-in-out infinite;
    }
  </style>
</div>

<!-- Main Content -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="flex flex-col lg:flex-row gap-6">
        <!-- Sidebar Categories -->
        <aside class="lg:w-56 flex-shrink-0">
            <div class="bg-teal-50 rounded-xl p-5 sticky top-20">
                <h2 class="text-lg font-bold text-gray-800 mb-4">Kategori</h2>
                <ul class="space-y-2">
                    {{-- semua kategori --}}
                    <li>
                        <a href="{{ route('main', ['category' => null]) }}"
                           class="block text-gray-700 hover:text-teal-600 hover:bg-teal-100 px-3 py-2 rounded-lg transition text-sm {{ $currentCategory === null ? 'bg-teal-100 text-teal-600 font-semibold' : '' }}">
                            Semua
                        </a>
                    @foreach($categories as $category)
                    <li>
                        <a href="{{ route('main', ['category' => $category->id]) }}"
                           class="block text-gray-700 hover:text-teal-600 hover:bg-teal-100 px-3 py-2 rounded-lg transition text-sm {{ $currentCategory === $category ? 'bg-teal-100 text-teal-600 font-semibold' : '' }}">
                            {{ $category->name }}
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
                    <input type="text" id="searchInput" value="#" placeholder="Cari" class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent w-64">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400 text-sm"></i>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5" id="productsGrid">
                @forelse($products as $product)
                <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition overflow-hidden">
                    <a href="{{ route('main.show', $product->id) }}" class="block h-40 bg-gradient-to-br {{ $product['gradient'] }} flex items-center justify-center">
                        <i class="fas {{ $product['icon'] }} text-5xl {{ $product['icon_color'] }}"></i>
                    </a>
                    <div class="p-4">
                        <a href="{{ route('main.show', $product->id) }}" class="block">
                            <h3 class="font-semibold text-gray-800 mb-2 hover:text-teal-600 transition text-sm">{{ $product['name'] }}</h3>
                        </a>
                        <div class="flex items-center justify-between">
                            <span class="text-teal-600 font-bold">Rp{{ number_format($product['price'], 0, ',', '.') }}</span>
                            <form action="#" method="POST" class="inline">
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
                    <a href="#" class="inline-block mt-4 text-teal-600 hover:text-teal-700 font-semibold">
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
