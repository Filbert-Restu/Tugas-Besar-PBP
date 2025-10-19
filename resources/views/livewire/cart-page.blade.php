<div class="min-h-screen bg-white py-8">
    <div class="max-w-5xl mx-auto px-4">
        <!-- Header -->
        <h1 class="text-2xl font-bold text-gray-900 text-center mb-2">Keranjang Belanja</h1>

        <!-- Link Belanja Sekarang -->
        <div class="text-center mb-8">
            <a href="{{ route('main') }}" class="text-teal-500 hover:text-teal-600 text-sm font-medium">
                Belanja Sekarang
            </a>
        </div>

        @if (is_array($items) && count($items) > 0)
            <div class="bg-white">
                <!-- Tabel Cart -->
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="border-b-2 border-gray-300">
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Produk</th>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700">Harga Satuan</th>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700">Kuantitas</th>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700">Total Harga</th>
                                <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr class="border-b border-gray-200">
                                    <td class="px-4 py-6">
                                        <div class="flex items-center gap-4">
                                            <input
                                                type="checkbox"
                                                wire:change="toggleSelect({{ $item['id'] }})"
                                                @checked(in_array($item['id'], $selectedItems))
                                                class="rounded cursor-pointer w-4 h-4 flex-shrink-0"
                                            >
                                            <img
                                                {{-- src="{{ $item['product']['image'] ?? 'resources/images/placeholder.png' }}" --}}
                                                src="{{ asset('bg-waguri1.png') }}"
                                                alt="{{ $item['product']['name'] ?? 'Product' }}"
                                                class="w-20 h-20 object-cover rounded border border-gray-200 flex-shrink-0"
                                            >
                                            <div>
                                                <p class="font-medium text-gray-900">
                                                    {{ $item['product']['name'] ?? 'Produk Tidak Tersedia' }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-6 text-center text-gray-700">
                                        Rp{{ number_format($item['product']['price'] ?? 0, 0, ',', '.') }}
                                    </td>
                                    <td class="px-4 py-6">
                                        <div class="flex items-center justify-center gap-2">
                                            <button
                                                wire:click="decrementQty({{ $item['id'] }})"
                                                class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded hover:bg-gray-100 transition text-gray-600 font-bold"
                                                title="Kurangi qty"
                                            >
                                                -
                                            </button>
                                            <span class="w-12 text-center font-medium text-gray-900">
                                                {{ $item['qty'] ?? 1 }}
                                            </span>
                                            <button
                                                wire:click="incrementQty({{ $item['id'] }})"
                                                class="w-8 h-8 flex items-center justify-center border border-gray-300 rounded hover:bg-gray-100 transition text-gray-600 font-bold"
                                                title="Tambah qty"
                                            >
                                                +
                                            </button>
                                        </div>
                                    </td>
                                    <td class="px-4 py-6 text-center text-gray-900 font-medium">
                                        Rp{{ number_format(($item['product']['price'] ?? 0) * ($item['qty'] ?? 1), 0, ',', '.') }}
                                    </td>
                                    <td class="px-4 py-6 text-center">
                                        <button
                                            wire:click="removeItem({{ $item['id'] }})"
                                            class="text-teal-500 hover:text-teal-600 font-medium text-sm transition"
                                        >
                                            Hapus
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Total dan Checkout -->
                <div class="mt-6 flex items-center justify-end gap-6 px-4">
                    <div class="text-lg">
                        <span class="font-medium text-gray-700">Total ({{ is_array($selectedItems) ? count($selectedItems) : 0 }} Produk):</span>
                        <span class="font-bold text-gray-900 ml-2">Rp{{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <button
                        wire:click="checkout"
                        @disabled(empty($selectedItems) || !is_array($selectedItems) || $total <= 0)
                        class="bg-teal-500 hover:bg-teal-600 disabled:bg-gray-400 disabled:cursor-not-allowed text-white font-semibold px-8 py-3 rounded transition duration-200"
                    >
                        Check-out
                    </button>
                </div>
            </div>
        @else
            <div class="bg-white rounded-lg shadow p-12 text-center">
                <div class="mb-6">
                    <p class="text-6xl mb-4">🛒</p>
                    <p class="text-gray-500 text-xl font-semibold mb-2">Keranjang Anda Kosong</p>
                    <p class="text-gray-400">Tambahkan produk untuk memulai berbelanja</p>
                </div>
                <a
                    href="{{ route('main') }}"
                    class="inline-block bg-teal-500 hover:bg-teal-600 text-white font-semibold py-3 px-6 rounded transition"
                >
                    Mulai Berbelanja
                </a>
            </div>
        @endif
    </div>
</div>
