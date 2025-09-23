@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')
<div class="bg-white p-6 rounded shadow-md grid grid-cols-1 md:grid-cols-5 gap-8">
    <!-- Gambar -->
    <div class="md:col-span-2">
        <img src="{{ asset('storage/' . $product->image) }}"
             alt="{{ $product->name }}"
             class="w-1/2 aspect-square object-cover rounded-md shadow-md">
    </div>

    <!-- Detail -->
    <div class="md:col-span-3">
        <h1 class="text-2xl font-bold mb-2">{{ $product->name }}</h1>
        <p class="text-gray-600 mb-4">Kategori: <span class="font-semibold">{{ $product->category->name ?? 'Tidak ada kategori' }}</span></p>
        <p class="text-lg font-semibold text-blue-600 mb-4">Rp {{ number_format($product->price,0,',','.') }}</p>
        <p class="mb-4">Stok: <span class="font-semibold">{{ $product->stock }}</span></p>

        <div class="prose max-w-none mb-4">
            <p>{{ $product->description }}</p>
        </div>

        <form action="{{ route('cart.add', $product->id) }}" method="POST">
            @csrf
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-300">
                + Tambah ke Keranjang
            </button>
        </form>
    </div>
</div>
@endsection
