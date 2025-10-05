{{-- page search --}}
@extends('layouts.app')

@section('title', 'Search Results')

@section('content')
<div>
    <h1 class="text-2xl font-bold mb-4">Keranjang Belanja</h1>

    @if($items->isEmpty())
        <p>Keranjang Anda kosong.</p>
    @else
        {{-- Loop untuk menampilkan setiap item di keranjang --}}
        @foreach($items as $item)
            <div class="flex items-center justify-between border-b py-4">

                {{-- BAGIAN KIRI: Info item (tidak perlu di dalam form sendiri) --}}
                <div class="flex items-center">
                    {{-- Checkbox ini akan menjadi bagian dari form checkout di bawah --}}
                    {{-- Kita beri `form="checkout-form"` agar terhubung --}}
                    <input type="checkbox" name="items[]" value="{{ $item->id }}" class="mr-4" form="checkout-form" checked>

                    <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-16 h-16 object-cover rounded mr-4">
                    <div>
                        <p class="font-semibold">{{ $item->product->name }}</p>
                        <p class="text-gray-600">Rp {{ number_format($item->product->price, 0, ',', '.') }}</p>
                    </div>
                </div>

                {{-- BAGIAN KANAN: Form-form aksi yang terpisah --}}
                <div class="flex items-center">
                    <form action="{{ route('cart.reduce', $item->product) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="px-2 py-1 bg-gray-200 rounded">-</button>
                    </form>

                    <span class="mx-4 w-8 text-center">{{ $item->qty }}</span>

                    <form action="{{ route('cart.add', $item->product) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="px-2 py-1 bg-gray-200 rounded">+</button>
                    </form>

                    <form action="{{ route('cart.remove', $item->product) }}" method="POST" class="inline ml-4">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700">Hapus</button>
                    </form>
                </div>

            </div>
        @endforeach

        {{-- Form KHUSUS untuk Checkout, diletakkan di luar loop --}}
        <form action="{{ route('cart.checkout') }}" method="POST" id="checkout-form">
            @csrf
            <div class="mt-6 text-right">
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">Checkout</button>
            </div>
        </form>
    @endif
</div>

@endsection
