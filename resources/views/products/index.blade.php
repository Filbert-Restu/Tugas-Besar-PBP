@extends('layouts.app')

@section('title', $product->name . ' - KlikMart')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 p-8">
            <!-- Product Image -->
            <div class="items-center justify-center rounded-xl p-2 min-h-[400px]">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="max-w-full max-h-full object-contain m-auto h-3/4 my-1 rounded-2xl">
                @else
                    <div class="max-w-full h-3/4 my-1 rounded-2xl bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                        <svg class="w-32 h-32 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                @endif
                <div class="text-center">
                    <div class="flex items-center justify-center text-teal-600 mt-4">
                        <i class="fas fa-truck"></i>
                        <span class="text-sm font-semibold">Pengiriman Gratis</span>
                    </div>
                </div>
            </div>

            <!-- Product Info -->
            <div class="flex flex-col justify-center">
                <h1 class="text-2xl font-bold text-gray-800 mb-3">{{ $product->name }}</h1>
                <div class="text-3xl font-bold text-teal-600 mb-6">Rp{{ number_format($product->price, 0, ',', '.') }}</div>

                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <div class="space-y-4 mb-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Jumlah</label>
                            <div class="flex items-center space-x-1">
                                <button type="button"
                                    class="w-7 h-7 flex items-center justify-center bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition text-sm"
                                    onclick="updateQuantity(-1)">
                                    -
                                </button>

                                <input
                                    type="number"
                                    name="quantity"
                                    id="quantity"
                                    value="1"
                                    min="1"
                                    class="w-9 h-7 text-center border border-gray-300 rounded focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 text-sm"
                                    style="-webkit-appearance: none; -moz-appearance: textfield; appearance: textfield;"
                                >

                                <button type="button"
                                    class="w-7 h-7 flex items-center justify-center bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition text-sm"
                                    onclick="updateQuantity(1)">
                                    +
                                </button>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3 text-sm">
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <span class="text-gray-600">Kategori:</span>
                                <span class="font-semibold text-gray-800 ml-1">{{ $product->category->name }}</span>
                            </div>
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <span class="text-gray-600">Berat:</span>
                                <span class="font-semibold text-gray-800 ml-1">{{ $product->weight }}g</span>
                            </div>
                        </div>
                        @if ($product->description)
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-3">
                                <p class="text-sm text-gray-700">{{ $product->description }}</p>
                            </div>
                        @else
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-3">
                                <p class="text-sm text-gray-700 italic">Deskripsi produk tidak tersedia.</p>
                            </div>
                        @endif

                    </div>

                    <button type="submit" class="w-full bg-teal-500 hover:bg-teal-600 text-white font-semibold py-3 rounded-lg transition">
                        + Masukkan Keranjang
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function updateQuantity(delta) {
    const input = document.getElementById('quantity');
    let value = parseInt(input.value) || 1;
    value = Math.max(1, value + delta);
    input.value = value;
}
</script>
@endsection
