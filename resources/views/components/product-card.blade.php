<div class="bg-white rounded-xl shadow-sm hover:shadow-md transition overflow-hidden">
    <a href="{{ route('main.show', $product->id) }}"
    class="block w-full overflow-hidden aspect-[16/9]">
        @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}"
                alt="{{ $product->name }}"
                class="object-cover w-full h-full transform hover:scale-105 transition duration-300">
        @else
            <div class="w-full h-full bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
        @endif
    </a>
    <div class="p-4">
        <a href="{{ route('main.show', $product->id) }}" class="block">
            <h3 class="font-semibold text-gray-800 mb-2 hover:text-teal-600 transition text-sm">
                {{ $product->name }}
            </h3>
        </a>
        <div class="flex items-center justify-between">
            <form action="{{ route('cart.add', $product->id) }}" method="POST" class=" w-2/5"> {{-- Tombol 50% dari lebar --}}
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button type="submit"
                    class="w-full bg-teal-500 text-white px-3 py-1.5 rounded-lg text-xs hover:bg-teal-600 transition text-center font-bold">
                    +
                </button>
            </form>
            <span class=" text-teal-600 font-bold text-sm text-right">
                Rp{{ number_format($product->price, 0, ',', '.') }}
            </span>
        </div>
    </div>
</div>
