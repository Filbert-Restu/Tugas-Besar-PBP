@extends('layouts.app')

@section('title', 'Landing Page')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-purple-600 rounded-2xl p-8 md:p-12 text-white overflow-hidden">
        <div class="flex flex-col md:flex-row items-center justify-between">

            <div class="md:w-1/2 text-center md:text-left mb-8 md:mb-0">
                <h1 class="text-4xl lg:text-5xl font-bold mb-2">
                    Ingin mendukung UMKM?
                </h1>
                <p class="text-lg lg:text-xl mb-6 opacity-90">
                    Coba Shoped aja!
                </p>

                <a href="#" class="inline-block border-2 border-white px-8 py-3 rounded-lg font-bold hover:bg-white hover:text-purple-600 transition-colors duration-300">
                    Cek Sekarang
                </a>
            </div>

            <div class="relative md:w-1/2 flex justify-center md:justify-end">

                <img src="#" alt="Ilustrasi Promo Official Store" class="max-w-xs md:max-w-sm lg:max-w-md">

            </div>

        </div>
    </div>
    <h1 class="text-3xl font-bold mb-6 text-center">Produk Terbaru</h1>

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
        @foreach($products as $product)
        <div class="bg-white rounded-lg p-4 shadow-lg transition duration-300 ease-in-out hover:shadow-xl flex flex-col justify-between">
            <a href="{{ route('main.show', $product->id) }}">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-40 object-cover rounded-md mb-3">
                <h2 class="text-lg font-semibold mb-1 truncate">{{ $product->name }}</h2>
            </a>
            <div class="mt-auto">
                <div class="flex flex-row gap-2">
                    {{-- Tombol masukan ke keranjang --}}
                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex-1">
                        @csrf
                        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600 transition">Keranjang</button>
                    </form>
                    {{-- Tombol beli sekarang (contoh route 'order.now') --}}
                    <a href="#" class="flex-1 bg-green-500 text-white py-2 rounded hover:bg-green-600 transition text-center">Beli</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    {{-- Button logout --}}
    @auth
        <p>Anda login sebagai: <strong>{{ auth()->user()->role }}</strong></p>
        <form action="{{ route('logout') }}" method="POST" class="inline">
            @csrf
            <button class="hover:text-red-500">Logout</button>
        </form>
    @endauth
</div>
@endsection
