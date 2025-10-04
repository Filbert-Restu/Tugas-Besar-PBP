@extends('layout')

@section('title', $product['name'] . ' - KlikMart')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 p-8">
            <!-- Product Image -->
            <div class="flex items-center justify-center bg-gradient-to-br {{ $product['gradient'] }} rounded-xl p-12 min-h-[400px]">
                <div class="text-center">
                    <i class="fas {{ $product['icon'] }} text-8xl {{ $product['icon_color'] }} mb-4"></i>
                    <div class="flex items-center justify-center space-x-2 text-teal-600 mt-4">
                        <i class="fas fa-truck"></i>
                        <span class="text-sm font-semibold">Pengiriman Gratis</span>
                    </div>
                </div>
            </div>

            <!-- Product Info -->
            <div class="flex flex-col justify-center">
                <h1 class="text-2xl font-bold text-gray-800 mb-3">{{ $product['name'] }}</h1>
                <div class="text-3xl font-bold text-teal-600 mb-6">Rp{{ number_format($product['price'], 0, ',', '.') }}</div>
                
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                    
                    <div class="space-y-4 mb-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Kuantitas</label>
                            <div class="flex items-center space-x-2">
                                <button type="button" onclick="decreaseQuantity()" class="w-9 h-9 rounded-lg border border-gray-300 hover:border-teal-500 hover:text-teal-500 transition flex items-center justify-center">
                                    <i class="fas fa-minus text-xs"></i>
                                </button>
                                <input type="number" name="quantity" id="quantity" value="1" min="1" class="w-16 text-center border border-gray-300 rounded-lg py-2 focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500">
                                <button type="button" onclick="increaseQuantity()" class="w-9 h-9 rounded-lg border border-gray-300 hover:border-teal-500 hover:text-teal-500 transition flex items-center justify-center">
                                    <i class="fas fa-plus text-xs"></i>
                                </button>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3 text-sm">
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <span class="text-gray-600">Kategori:</span>
                                <span class="font-semibold text-gray-800 ml-1">{{ $product['category'] }}</span>
                            </div>
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <span class="text-gray-600">Berat:</span>
                                <span class="font-semibold text-gray-800 ml-1">{{ $product['weight'] }}g</span>
                            </div>
                        </div>

                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-3">
                            <p class="text-sm text-gray-700">{{ $product['description'] }}</p>
                        </div>
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
function increaseQuantity() {
    const input = document.getElementById('quantity');
    input.value = parseInt(input.value) + 1;
}

function decreaseQuantity() {
    const input = document.getElementById('quantity');
    if (parseInt(input.value) > 1) {
        input.value = parseInt(input.value) - 1;
    }
}
</script>
@endsection