@extends('layouts.app')

@section('title', $product->name)

@section('breadcrumb')
<a href="{{ route('products.index') }}">Produk</a> / <span>{{ $product->name }}</span>
@endsection

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow-md grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Gambar -->
    <div>
        @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}"
                 alt="{{ $product->name }}"
                 class="rounded-md shadow-md w-full mb-4">
        @else
            <div class="rounded-md shadow-md w-full mb-4 aspect-square bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                <svg class="w-32 h-32 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
        @endif
    </div>

    <!-- Detail -->
    <div>
        <h1 class="text-2xl font-bold mb-2">{{ $product->name }}</h1>
        <p class="text-gray-600 mb-4">Kategori: {{ $product->category->name ?? '-' }}</p>
        <p class="text-lg font-semibold text-blue-600 mb-4">Rp {{ number_format($product->price,0,',','.') }}</p>
        <p class="mb-4">Stok: {{ $product->stock }}</p>

        <form action="{{ route('cart.add', $product->id) }}" method="POST">
            @csrf
            <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                + Tambah ke Keranjang
            </button>
        </form>
    </div>
    <h1>ini detail</h1>
</div>
@endsection
