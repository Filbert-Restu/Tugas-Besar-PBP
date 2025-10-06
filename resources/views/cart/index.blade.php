@extends('layouts.app')

@section('title', 'Keranjang Belanja | KlikMart')

@section('content')
<div class="bg-gray-50 min-h-screen py-10">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Header --}}
        <div class="text-center mb-10">
            <h1 class="text-3xl font-extrabold text-gray-900">Keranjang Belanja</h1>
            <a href="{{ route('main') }}" class="text-emerald-600 hover:text-emerald-700 font-medium mt-2 inline-block">
                Belanja Sekarang
            </a>
        </div>

        {{-- Jika Keranjang Kosong --}}
        @if($items->isEmpty())
            <div class="bg-white shadow-sm rounded-2xl p-12 text-center max-w-3xl mx-auto border border-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-20 h-20 mx-auto text-gray-300 mb-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <h2 class="text-xl font-bold text-gray-800 mb-2">Keranjang Belanja Kosong</h2>
                <p class="text-gray-500 mb-6">Anda belum menambahkan produk apapun ke keranjang</p>
                <a href="{{ route('main') }}" class="bg-emerald-500 hover:bg-emerald-600 text-white px-8 py-3 rounded-lg font-semibold transition">
                    Mulai Belanja
                </a>
            </div>
        @else
            {{-- Jika Ada Item di Keranjang --}}
            <div class="bg-white shadow-sm rounded-2xl overflow-hidden border border-gray-100">
                <table class="w-full text-sm text-gray-700">
                    <thead class="bg-gray-50 text-gray-600 uppercase text-xs font-semibold">
                        <tr>
                            <th class="px-6 py-4 text-left">Produk</th>
                            <th class="px-6 py-4 text-center">Harga Satuan</th>
                            <th class="px-6 py-4 text-center">Kuantitas</th>
                            <th class="px-6 py-4 text-center">Total Harga</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @php $grandTotal = 0; @endphp
                        @foreach($items as $item)
                            @php
                                $subtotal = $item->product->price * $item->qty;
                                $grandTotal += $subtotal;
                            @endphp
                            <tr class="hover:bg-gray-50 transition">
                                {{-- Produk --}}
                                <td class="px-6 py-5 flex items-center gap-4">
                                    <div class="flex-shrink-0 bg-gradient-to-tr from-emerald-100 to-emerald-50 p-4 rounded-xl">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-800">{{ $item->product->name }}</p>
                                    </div>
                                </td>

                                {{-- Harga --}}
                                <td class="text-center font-medium">
                                    Rp{{ number_format($item->product->price, 0, ',', '.') }}
                                </td>

                                {{-- Kuantitas --}}
                                <td class="text-center">
                                    <div class="inline-flex items-center border border-gray-200 rounded-lg">
                                        <form action="{{ route('cart.reduce', $item->product) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="px-3 py-1 text-gray-600 hover:text-emerald-600 font-bold">−</button>
                                        </form>
                                        <span class="px-4 py-1 font-semibold text-gray-800">{{ $item->qty }}</span>
                                        <form action="{{ route('cart.add', $item->product) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="px-3 py-1 text-gray-600 hover:text-emerald-600 font-bold">+</button>
                                        </form>
                                    </div>
                                </td>

                                {{-- Subtotal --}}
                                <td class="text-center font-semibold text-emerald-600">
                                    Rp{{ number_format($subtotal, 0, ',', '.') }}
                                </td>

                                {{-- Hapus --}}
                                <td class="text-center">
                                    <form action="{{ route('cart.remove', $item->product) }}" method="POST" onsubmit="return confirm('Hapus produk ini dari keranjang?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 font-medium">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Total --}}
                <div class="px-6 py-6 flex justify-between items-center bg-gray-50 border-t border-gray-100">
                    <p class="text-lg font-semibold text-gray-700">
                        Total ({{ $items->count() }} Item):
                    </p>
                    <p class="text-2xl font-extrabold text-emerald-600">
                        Rp{{ number_format($grandTotal, 0, ',', '.') }}
                    </p>
                </div>

                {{-- Checkout --}}
                <div class="px-6 pb-8 bg-gray-50">
                    <form action="{{ route('cart.checkout') }}" method="POST">
                        @csrf
                        <button type="submit" 
                            class="w-full bg-emerald-500 hover:bg-emerald-600 text-white font-semibold py-4 rounded-lg text-lg transition shadow">
                            Check-out
                        </button>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
