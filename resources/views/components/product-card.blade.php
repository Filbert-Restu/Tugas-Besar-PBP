<div class="bg-white rounded-xl shadow-sm hover:shadow-md transition overflow-hidden">
    <a href="{{ route('main.show', $product->id) }}"
    class="block w-full overflow-hidden aspect-[16/9]">
        <img src="{{ asset('bg-waguri1.png') }}"
            alt="{{ $product->name }}"
            class="object-cover w-full h-full transform hover:scale-105 transition duration-300">
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
