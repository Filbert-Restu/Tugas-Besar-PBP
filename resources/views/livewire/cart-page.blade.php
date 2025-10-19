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
                                            @if(!empty($item['product']['image']))
                                                <img
                                                    src="{{ asset('storage/' . $item['product']['image']) }}"
                                                    alt="{{ $item['product']['name'] ?? 'Product' }}"
                                                    class="w-20 h-20 object-cover rounded border border-gray-200 flex-shrink-0"
                                                >
                                            @else
                                                <div class="w-20 h-20 rounded border border-gray-200 bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center flex-shrink-0">
                                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                    </svg>
                                                </div>
                                            @endif
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
