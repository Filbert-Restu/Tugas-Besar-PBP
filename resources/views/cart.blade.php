@extends('layout')

@section('title', 'Keranjang Belanja - KlikMart')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Keranjang Belanja</h1>
        <a href="{{ route('home') }}" class="text-teal-600 hover:text-teal-700 font-medium text-sm">
            Belanja Sekarang
        </a>
    </div>

    @if(count($cartItems) > 0)
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <!-- Cart Header -->
        <div class="bg-gray-50 px-6 py-3 border-b">
            <div class="grid grid-cols-12 gap-4 font-semibold text-gray-700 text-sm">
                <div class="col-span-5">Produk</div>
                <div class="col-span-2 text-center">Harga Satuan</div>
                <div class="col-span-2 text-center">Kuantitas</div>
                <div class="col-span-2 text-center">Total Harga</div>
                <div class="col-span-1 text-center">Aksi</div>
            </div>
        </div>

        <!-- Cart Items -->
        <div class="divide-y">
            @foreach($cartItems as $item)
            <div class="px-6 py-5">
                <div class="grid grid-cols-12 gap-4 items-center">
                    <div class="col-span-5 flex items-center space-x-4">
                        <div class="w-16 h-16 bg-gradient-to-br {{ $item['product']['gradient'] }} rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas {{ $item['product']['icon'] }} text-2xl {{ $item['product']['icon_color'] }}"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800 text-sm">{{ $item['product']['name'] }}</h3>
                        </div>
                    </div>
                    <div class="col-span-2 text-center font-medium text-gray-700 text-sm">Rp{{ number_format($item['product']['price'], 0, ',', '.') }}</div>
                    <div class="col-span-2">
                        <form action="{{ route('cart.update') }}" method="POST" class="flex items-center justify-center space-x-2">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $item['product']['id'] }}">
                            <button type="button" onclick="decreaseQty{{ $item['product']['id'] }}()" class="w-7 h-7 rounded border border-gray-300 hover:border-teal-500 hover:text-teal-500 transition flex items-center justify-center">
                                <i class="fas fa-minus text-xs"></i>
                            </button>
                            <input type="number" name="quantity" id="qty{{ $item['product']['id'] }}" value="{{ $item['quantity'] }}" min="1" class="w-14 text-center border border-gray-300 rounded py-1 text-sm focus:outline-none focus:border-teal-500" onchange="this.form.submit()">
                            <button type="button" onclick="increaseQty{{ $item['product']['id'] }}()" class="w-7 h-7 rounded border border-gray-300 hover:border-teal-500 hover:text-teal-500 transition flex items-center justify-center">
                                <i class="fas fa-plus text-xs"></i>
                            </button>
                        </form>
                        <script>
                        function increaseQty{{ $item['product']['id'] }}() {
                            const input = document.getElementById('qty{{ $item['product']['id'] }}');
                            input.value = parseInt(input.value) + 1;
                            input.form.submit();
                        }
                        function decreaseQty{{ $item['product']['id'] }}() {
                            const input = document.getElementById('qty{{ $item['product']['id'] }}');
                            if (parseInt(input.value) > 1) {
                                input.value = parseInt(input.value) - 1;
                                input.form.submit();
                            }
                        }
                        </script>
                    </div>
                    <div class="col-span-2 text-center font-bold text-teal-600 text-sm">Rp{{ number_format($item['subtotal'], 0, ',', '.') }}</div>
                    <div class="col-span-1 text-center">
                        <form action="{{ route('cart.remove') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $item['product']['id'] }}">
                            <button type="submit" class="text-red-500 hover:text-red-700 font-medium text-xs transition">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Cart Footer -->
        <div class="bg-gray-50 px-6 py-5 border-t">
            <div class="flex justify-between items-center mb-4">
                <span class="text-base font-semibold text-gray-700">Total ({{ array_sum(array_column($cartItems, 'quantity')) }} Item):</span>
                <span class="text-2xl font-bold text-teal-600">Rp{{ number_format($total, 0, ',', '.') }}</span>
            </div>
            <a href="{{ route('checkout') }}" class="block w-full bg-teal-500 hover:bg-teal-600 text-white text-center font-semibold py-3 rounded-lg transition">
                Check-out
            </a>
        </div>
    </div>
    @else
    <div class="bg-white rounded-xl shadow-sm p-12 text-center">
        <i class="fas fa-shopping-cart text-6xl text-gray-300 mb-4"></i>
        <h2 class="text-xl font-bold text-gray-800 mb-3">Keranjang Belanja Kosong</h2>
        <p class="text-gray-600 mb-6">Anda belum menambahkan produk apapun ke keranjang</p>
        <a href="{{ route('home') }}" class="inline-block bg-teal-500 hover:bg-teal-600 text-white font-semibold px-7 py-3 rounded-lg transition">
            Mulai Belanja
        </a>
    </div>
    @endif</div>
@endsection