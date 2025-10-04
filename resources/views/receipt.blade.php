@extends('layout')

@section('title', 'Kuitansi - KlikMart')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="bg-white rounded-xl shadow-sm p-8 md:p-10" id="receipt">
        <!-- Header -->
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-teal-600 mb-1">KlikMart</h1>
            <p class="text-gray-600 text-sm">Belanja Klik, Semua Asik!</p>
        </div>

        <!-- Order Note -->
        <div class="bg-gray-50 rounded-lg p-5 mb-6">
            <h2 class="text-lg font-bold text-gray-800 mb-3">Nota Pesanan</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm mb-3">
                <div>
                    <p class="text-gray-600 text-xs mb-0.5">Nama Pembeli:</p>
                    <p class="font-semibold text-gray-800">{{ ($customer['first_name'] ?? 'Pembeli') }} {{ $customer['last_name'] ?? '1' }}</p>
                </div>
                <div>
                    <p class="text-gray-600 text-xs mb-0.5">No. Handphone Pembeli:</p>
                    <p class="font-semibold text-gray-800">628111112223</p>
                </div>
            </div>

            <div>
                <p class="text-gray-600 text-xs mb-0.5">Alamat Pembeli:</p>
                <p class="font-semibold text-gray-800 text-sm">Jl. Kenanga no 7 RT 1/ Rw 1, Kota Semarang, Jawa Tengah, ID, 50245</p>
            </div>
        </div>

        <!-- Order Details -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-6">
            <div class="bg-gray-50 rounded-lg p-3">
                <p class="text-xs text-gray-600 mb-0.5">No. Pesanan</p>
                <p class="font-bold text-gray-800 text-xs">{{ $orderNumber }}</p>
            </div>
            <div class="bg-gray-50 rounded-lg p-3">
                <p class="text-xs text-gray-600 mb-0.5">Tanggal Transaksi</p>
                <p class="font-bold text-gray-800 text-xs">{{ date('d/m/y') }}</p>
            </div>
            <div class="bg-gray-50 rounded-lg p-3">
                <p class="text-xs text-gray-600 mb-0.5">Metode Pembayaran</p>
                <p class="font-bold text-gray-800 text-xs">COD</p>
            </div>
            <div class="bg-gray-50 rounded-lg p-3">
                <p class="text-xs text-gray-600 mb-0.5">Jasa Kirim</p>
                <p class="font-bold text-gray-800 text-xs">JNE Reguler</p>
            </div>
        </div>

        <!-- Order Items -->
        <div class="mb-6">
            <h3 class="text-base font-bold text-gray-800 mb-3">Rincian Pesanan</h3>
            
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="text-left py-2.5 px-3 font-semibold text-gray-700 text-xs">No.</th>
                            <th class="text-left py-2.5 px-3 font-semibold text-gray-700 text-xs">Produk</th>
                            <th class="text-right py-2.5 px-3 font-semibold text-gray-700 text-xs">Harga Produk</th>
                            <th class="text-center py-2.5 px-3 font-semibold text-gray-700 text-xs">Kuantitas</th>
                            <th class="text-right py-2.5 px-3 font-semibold text-gray-700 text-xs">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @foreach($cartItems as $index => $item)
                        <tr>
                            <td class="py-3 px-3 text-xs">{{ $index + 1 }}</td>
                            <td class="py-3 px-3 font-semibold text-gray-800 text-xs">{{ $item['product']['name'] }}</td>
                            <td class="py-3 px-3 text-right text-xs">Rp{{ number_format($item['product']['price'], 0, ',', '.') }}</td>
                            <td class="py-3 px-3 text-center text-xs">{{ $item['quantity'] }}</td>
                            <td class="py-3 px-3 text-right font-semibold text-xs">Rp{{ number_format($item['subtotal'], 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Summary -->
        <div class="border-t pt-5">
            <div class="bg-gray-50 rounded-lg p-5 max-w-md ml-auto">
                <div class="space-y-2 mb-3 text-sm">
                    <div class="flex justify-between text-gray-700">
                        <span>Subtotal Pesanan</span>
                        <span class="font-semibold">Rp{{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-gray-700">
                        <span>Subtotal Pengiriman</span>
                        <span class="font-semibold">Rp{{ number_format($shipping, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-gray-700">
                        <span>Biaya Layanan</span>
                        <span class="font-semibold">Rp0</span>
                    </div>
                    <div class="flex justify-between text-gray-700">
                        <span>Diskon Voucher</span>
                        <span class="font-semibold">Rp0</span>
                    </div>
                </div>
                
                <div class="border-t pt-3">
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-base font-bold text-gray-800">Total Pembayaran</span>
                        <span class="text-xl font-bold text-teal-600">Rp{{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <p class="text-xs text-gray-600 text-right">Total Kuantitas {{ $totalItems }} Produk</p>
                </div>
            </div>
        </div>

        <!-- Footer Note -->
        <div class="mt-6 pt-5 border-t text-center text-xs text-gray-600">
            <p>Biaya-biaya yang ditagihkan oleh KlikMart (jika ada) sudah termasuk PPN</p>
        </div>

        <!-- Print Button -->
        <div class="mt-6 text-center no-print">
            <button onclick="window.print()" class="bg-teal-500 hover:bg-teal-600 text-white font-semibold px-6 py-2.5 rounded-lg transition text-sm">
                <i class="fas fa-print mr-2"></i>Cetak Kuitansi
            </button>
        </div>
    </div>
</div>

<style>
    @media print {
        nav, footer, .no-print {
            display: none !important;
        }
        body {
            background: white;
        }
        #receipt {
            box-shadow: none;
        }
    }
</style>
@endsection