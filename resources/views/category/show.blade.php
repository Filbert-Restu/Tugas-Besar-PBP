@extends('layouts.app')

@section('title', 'Kategori ' . $category->name . ' | KlikMart')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-green-700">{{ $category->name }}</h1>
            <p class="text-gray-500 mt-1">
                Menampilkan produk dari kategori 
                <span class="font-semibold text-green-600">{{ $category->name }}</span>
            </p>
        </div>
        <a href="{{ route('main') }}" class="text-green-600 hover:underline">← Kembali ke semua produk</a>
    </div>

    <!-- Sidebar + Produk -->
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Sidebar Kategori -->
        <aside class="lg:w-56 flex-shrink-0">
            <div class="bg-teal-50 rounded-xl p-5 sticky top-20">
                <h2 class="text-lg font-bold text-gray-800 mb-4">Kategori</h2>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('main') }}"
                           class="block text-gray-700 hover:text-teal-600 hover:bg-teal-100 px-3 py-2 rounded-lg transition text-sm">
                            Semua
                        </a>
                    </li>
                    @foreach ($categories as $cat)
                        <li>
                            <a href="{{ route('category.show', $cat->slug) }}"
                               class="block text-gray-700 hover:text-teal-600 hover:bg-teal-100 px-3 py-2 rounded-lg transition text-sm 
                               {{ $cat->slug === $currentCategory ? 'bg-teal-100 text-teal-600 font-semibold' : '' }}">
                                {{ $cat->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </aside>

        <!-- Produk -->
        <div class="flex-1">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
                @forelse($products as $product)
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition overflow-hidden border border-gray-100">
                        <a href="{{ route('main.show', $product->id) }}" 
                           class="h-48 bg-gray-50 flex items-center justify-center">
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" 
                                     alt="{{ $product->name }}" 
                                     class="object-contain h-full w-full">
                            @else
                                <i class="fas fa-box-open text-6xl text-gray-400"></i>
                            @endif
                        </a>
                        <div class="p-4">
                            <a href="{{ route('main.show', $product->id) }}" class="block">
                                <h3 class="font-semibold text-gray-800 mb-2 hover:text-teal-600 transition text-sm truncate">
                                    {{ $product->name }}
                                </h3>
                            </a>
                            <p class="text-green-700 font-bold mb-3">
                                Rp{{ number_format($product->price, 0, ',', '.') }}
                            </p>

                            {{-- Tombol aksi --}}
                            @guest
                                <a href="{{ route('login') }}"
                                   class="block text-center w-full bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg transition font-semibold">
                                   Login untuk Beli
                                </a>
                            @else
                                @if (Auth::user()->role === 'user')
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition font-semibold">
                                            + Tambah ke Keranjang
                                        </button>
                                    </form>
                                @else
                                    <button type="button" disabled
                                        class="w-full bg-gray-200 text-gray-500 cursor-not-allowed px-4 py-2 rounded-lg font-semibold">
                                        Khusus User (Admin Tidak Bisa Beli)
                                    </button>
                                @endif
                            @endguest
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-16">
                        <i class="fas fa-box-open text-6xl text-gray-300 mb-4"></i>
                        <p class="text-gray-500 text-lg">Belum ada produk di kategori ini.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-10">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
