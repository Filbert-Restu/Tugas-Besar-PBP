@extends('layouts.app')

@section('title', 'Dashboard User')

@section('breadcrumb')
<a href="{{ route('landing') }}">Home</a> / Dashboard
@endsection

@section('content')
<div class="bg-white p-6 rounded shadow-md">
    <h2 class="text-xl font-bold mb-4">Halo, {{ auth()->user()->name }}</h2>
    <p>Selamat datang di dashboard Anda.</p>
    <a href="{{ route('cart.index') }}" class="text-blue-500 underline">Lihat Keranjang</a>
</div>
@endsection
