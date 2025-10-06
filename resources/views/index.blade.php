@extends('layouts.app')

@section('title', 'KlikMart - Belanja Klik, Semua Asik')

@section('content')

<!-- HERO SECTION -->
<div class="relative h-screen bg-gradient-to-br from-green-200 via-emerald-300 to-green-400 flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute w-[600px] h-[600px] bg-emerald-500/30 rounded-full blur-3xl top-[-100px] left-[-150px]"></div>
        <div class="absolute w-[500px] h-[500px] bg-lime-400/30 rounded-full blur-3xl bottom-[-150px] right-[-100px]"></div>
    </div>

    <div class="relative z-10 text-center text-gray-800 px-6">
        <div class="bg-white/40 backdrop-blur-md rounded-3xl p-10 shadow-2xl inline-block">
            <h1 class="text-5xl sm:text-6xl font-extrabold text-green-900 mb-6">
                Belanja Hemat, Hidup Sehat 🌿
            </h1>
            <p class="text-lg sm:text-xl text-gray-700 max-w-2xl mx-auto mb-8">
                Temukan produk terbaik dari UMKM lokal, semua bisa kamu dapatkan dengan sekali klik.
            </p>
            <div class="flex justify-center gap-4">
                <a href="#products" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-8 py-3 rounded-xl shadow-lg transition">
                    Mulai Belanja
                </a>
                <a href="#" class="text-green-800 font-semibold hover:underline">Pelajari Lebih Lanjut →</a>
            </div>
        </div>
    </div>
</div>

<!-- MAIN CONTENT -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="flex flex-col lg:flex-row gap-6">

        <!-- SIDEBAR KATEGORI -->
        <aside class="lg:w-56 flex-shrink-0">
            <div class="bg-emerald-50 rounded-xl p-5 sticky top-20">
                <h2 class="text-lg font-bold text-gray-800 mb-4">Kategori</h2>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('main') }}"
                           class="block text-gray-700 hover:text-emerald-600 hover:bg-emerald-100 px-3 py-2 rounded-lg transition text-sm {{ !$currentCategory ? 'bg-emerald-100 text-emerald-600 font-semibold' : '' }}">
                            Semua
                        </a>
                    </li>
                    @foreach ($categories as $category)
                        <li>
                            <a href="{{ route('category.show', $category->slug) }}"
                            @class([
                                'block px-3 py-2 rounded-lg transition text-sm',
                                'text-gray-700 hover:text-emerald-600 hover:bg-emerald-100',
                                'bg-emerald-100 text-emerald-600 font-semibold' => $currentCategory == $category->slug,
                            ])>
                            {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </aside>

        <!-- PRODUK -->
        <div class="flex-1" id="products">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Produk</h2>
                {{-- <form method="GET" action="{{ route('main') }}" class="relative">
                    <input type="text" name="search" placeholder="Cari produk..."
                        value="{{ request('search') }}"
                        class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent w-64">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400 text-sm"></i>
                </form> --}}
            </div>

            <!-- GRID PRODUK -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse ($products as $product)
                    <div class="bg-white rounded-xl shadow hover:shadow-md transition overflow-hidden border border-gray-100">
                        <a href="{{ route('main.show', $product->id) }}" class="h-48 bg-gray-50 flex items-center justify-center">
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="object-cover h-full w-full">
                            @else
                                <i class="fas fa-box-open text-6xl text-gray-400"></i>
                            @endif
                        </a>
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-800 mb-2 truncate">{{ $product->name }}</h3>
                            <p class="text-emerald-600 font-bold mb-3">
                                Rp{{ number_format($product->price, 0, ',', '.') }}
                            </p>

                            @auth
                                @if (Auth::user()->role === 'user')
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="w-full bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-lg transition font-semibold">
                                            + Tambah ke Keranjang
                                        </button>
                                    </form>
                                @endif
                            @else
                                <a href="{{ route('login') }}"
                                   class="block text-center w-full bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg transition font-semibold">
                                    Login untuk Beli
                                </a>
                            @endauth
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <i class="fas fa-box-open text-6xl text-gray-300 mb-4"></i>
                        <p class="text-gray-600 text-lg">Produk belum tersedia</p>
                        <a href="{{ route('main') }}" class="inline-block mt-4 text-emerald-600 hover:text-emerald-700 font-semibold">
                            Lihat Semua Produk
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
