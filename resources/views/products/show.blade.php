@extends('layouts.app')

@section('title', $product->name)

@section('breadcrumb')
<a href="{{ route('products.index') }}">Produk</a> / <span>{{ $product->name }}</span>
@endsection

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow-md grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Gambar -->
    {{-- <div>
        <img src="{{ $product->image_url ?? 'https://via.placeholder.com/300' }}"
             alt="{{ $product->name }}"
             class="rounded-md shadow-md w-full mb-4">
        <div class="flex space-x-2">
            <img src="{{ $product->image_url ?? 'https://via.placeholder.com/100' }}" class="w-20 h-20 object-cover rounded">
            <img src="{{ $product->image_url ?? 'https://via.placeholder.com/100' }}" class="w-20 h-20 object-cover rounded">
        </div>
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
    </div> --}}
    <h1>ini detail</h1>
</div>
@endsection
