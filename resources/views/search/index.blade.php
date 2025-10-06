{{-- Page: Search Results --}}
@extends('layouts.app')

@section('title', 'Hasil Pencarian | KlikMart')

@section('content')
<div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-10 py-10">

    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-2">Hasil Pencarian</h1>
        @if(request('q'))
            <p class="text-gray-500 text-sm">
                Menampilkan hasil untuk: 
                <span class="font-semibold text-emerald-600">"{{ request('q') }}"</span>
            </p>
        @elseif(request('category'))
            <p class="text-gray-500 text-sm">
                Menampilkan produk dalam kategori:
                <span class="font-semibold text-emerald-600">
                    {{ \App\Models\Category::where('slug', request('category'))->value('name') ?? 'Semua Kategori' }}
                </span>
            </p>
        @else
            <p class="text-gray-500 text-sm">Menampilkan semua produk</p>
        @endif
    </div>

    {{-- Cek apakah ada produk --}}
    @php
        use App\Models\Product;

        $query = Product::with('category')->latest();

        if (request('q')) {
            $query->where('name', 'like', '%' . request('q') . '%');
        }

        if (request('category')) {
            $query->whereHas('category', function($q) {
                $q->where('slug', request('category'));
            });
        }

        $products = $query->paginate(12);
    @endphp

    @if($products->count() > 0)
        {{-- Grid produk --}}
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($products as $product)
                <div class="bg-white shadow-md rounded-xl overflow-hidden hover:shadow-lg transition">
                    <a href="{{ route('main.show', $product->id) }}">
                        <img src="{{ asset('storage/' . $product->image) }}" 
                             alt="{{ $product->name }}" 
                             class="w-full h-48 object-cover">
                    </a>
                    <div class="p-4">
                        <p class="text-sm text-emerald-600 font-semibold mb-1">
                            {{ $product->category->name ?? 'Tanpa Kategori' }}
                        </p>
                        <h3 class="font-semibold text-gray-800 text-base mb-2 truncate">
                            {{ $product->name }}
                        </h3>
                        <p class="text-gray-600 font-medium mb-3">
                            Rp{{ number_format($product->price, 0, ',', '.') }}
                        </p>
                        <a href="{{ route('cart.add', $product->id) }}" 
                           class="inline-block bg-emerald-500 hover:bg-emerald-600 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                            Tambah ke Keranjang
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-10">
            {{ $products->appends(request()->query())->links() }}
        </div>

    @else
        {{-- Empty State --}}
        <div class="text-center py-16 text-gray-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto mb-4 w-16 h-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <h2 class="text-xl font-semibold mb-2">Produk tidak ditemukan</h2>
            <p class="text-gray-400 mb-6">Coba kata kunci lain atau telusuri kategori lainnya.</p>
            <a href="{{ route('main') }}" 
               class="bg-emerald-500 hover:bg-emerald-600 text-white px-6 py-3 rounded-lg transition">
                Kembali ke Beranda
            </a>
        </div>
    @endif
</div>
@endsection
