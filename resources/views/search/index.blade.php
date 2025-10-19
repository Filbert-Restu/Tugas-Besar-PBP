@extends('layouts.app')

@section('title', 'KlikMart - Belanja Klik, Semua Asik')

@section('content')
<!-- Main Content -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="flex flex-col lg:flex-row gap-6">
    <!-- Products Section -->
    <section class="flex-1" id="products">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Produk</h2>
        </div>
        <!-- Products Grid -->
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3" id="productsGrid">
            @forelse($products as $product)
                <x-product-card :product="$product" />
            @empty
            <div class="col-span-full text-center py-12">
                <i class="fas fa-search text-6xl text-gray-300 mb-4"></i>
                <p class="text-gray-w600 text-lg">Produk tidak ditemukan</p>
                <a href="#" class="inline-block mt-4 text-teal-600 hover:text-teal-700 font-semibold">
                    Lihat Semua Produk
                </a>
            </div>
            @endforelse
        </div>
    </section>
</div>
@endsection
