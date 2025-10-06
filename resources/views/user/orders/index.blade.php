@extends('user.layouts.user')

@section('title', 'Pesanan Saya | KlikMart')

@section('content')
<div class="max-w-6xl mx-auto px-6 sm:px-8 lg:px-10 py-10">

    {{-- Header --}}
    <div class="mb-10">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Pesanan Saya</h1>
        <p class="text-gray-500 text-sm">Lihat riwayat dan status pesanan Anda di KlikMart.</p>
    </div>

    {{-- Data Pesanan --}}
    @php
        use App\Models\Order;
        $orders = Order::with(['items.product'])
                    ->where('user_id', auth()->id())
                    ->latest()
                    ->paginate(10);
    @endphp

    @if ($orders->count() > 0)
        <div class="bg-white border border-gray-100 shadow rounded-2xl overflow-hidden">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-4 text-left">ID Pesanan</th>
                        <th class="px-6 py-4 text-left">Tanggal</th>
                        <th class="px-6 py-4 text-left">Total</th>
                        <th class="px-6 py-4 text-left">Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($orders as $order)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-medium text-gray-800">
                                #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}
                            </td>
                            <td class="px-6 py-4 text-gray-600">
                                {{ $order->created_at->translatedFormat('d F Y, H:i') }}
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-800">
                                Rp{{ number_format($order->total_amount, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $statusColors = [
                                        'pending' => 'bg-yellow-100 text-yellow-700',
                                        'processing' => 'bg-blue-100 text-blue-700',
                                        'completed' => 'bg-green-100 text-green-700',
                                        'cancelled' => 'bg-red-100 text-red-700',
                                    ];
                                    $status = $order->status ?? 'pending';
                                @endphp
                                <span class="px-3 py-1 rounded-full text-xs font-medium {{ $statusColors[$status] ?? 'bg-gray-100 text-gray-600' }}">
                                    {{ ucfirst($status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('orders.show', $order->id) }}"
                                   class="inline-flex items-center gap-1 px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-white rounded-md text-xs font-semibold transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-8">
            {{ $orders->links() }}
        </div>
    @else
        {{-- Empty State --}}
        <div class="text-center py-16 text-gray-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto mb-4 w-16 h-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 3h18M9 3v18m6-18v18M4 9h16" />
            </svg>
            <h2 class="text-xl font-semibold mb-2">Belum ada pesanan</h2>
            <p class="text-gray-400 mb-6">Pesan produk sekarang untuk melihat riwayat pembelian Anda di sini.</p>
            <a href="{{ route('main') }}" 
               class="bg-emerald-500 hover:bg-emerald-600 text-white px-6 py-3 rounded-lg transition">
                Belanja Sekarang
            </a>
        </div>
    @endif
</div>
@endsection
