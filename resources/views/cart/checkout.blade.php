@extends('layouts.app')

@section('title', 'Konfirmasi Checkout')

@section('content')
<div class="bg-white p-6 rounded shadow-md">
    <h1 class="text-2xl font-bold mb-6">Konfirmasi Checkout</h1>

    @if($CheckoutItems->isEmpty())
        <p>Tidak ada product untuk di-checkout.</p>
    @else
        <form action="{{ route('cart.doCheckout') }}" method="POST">
            @csrf
            <div class="mb-6">
                @php $total = 0; @endphp
                @foreach($CheckoutItems as $item)
                    <p>{{ $item->product->name }} (x{{ $item->qty }})</p>
                    {{-- tombol tambah qty --}}
                    {{-- hitung total --}}
                    @php $total += $item->product->price * $item->qty; @endphp
                @endforeach
            </div>

            <div class="text-right mb-6">
                <p class="text-lg">Total: <span class="font-bold text-blue-600">Rp {{ number_format($total, 0, ',', '.') }}</span></p>
            </div>

            <div>
                <button type="submit" class="w-full bg-green-500 text-white px-6 py-3 rounded hover:bg-green-600 transition duration-300">
                    Bayar Sekarang
                </button>
            </div>
        </form>
    @endif
</div>
@endsection
