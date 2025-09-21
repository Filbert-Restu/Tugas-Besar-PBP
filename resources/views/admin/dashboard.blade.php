{{-- @extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
  <!-- Ringkasan -->
  <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div class="bg-white shadow rounded-xl p-4">
      <h2 class="text-gray-500">Total Produk</h2>
      <p class="text-2xl font-bold">{{ $totalProduk }}</p>
    </div>
    <div class="bg-white shadow rounded-xl p-4">
      <h2 class="text-gray-500">Total Pesanan</h2>
      <p class="text-2xl font-bold">{{ $totalPesanan }}</p>
    </div>
    <div class="bg-white shadow rounded-xl p-4">
      <h2 class="text-gray-500">Total User</h2>
      <p class="text-2xl font-bold">{{ $totalUser }}</p>
    </div>
  </div>

  <!-- Pesanan Terbaru -->
  <div class="mt-6 bg-white shadow rounded-xl p-4">
    <h2 class="text-lg font-semibold mb-4">Pesanan Terbaru</h2>
    <table class="w-full border-collapse">
      <thead>
        <tr class="bg-gray-100 text-left">
          <th class="p-2">ID</th>
          <th class="p-2">User</th>
          <th class="p-2">Total</th>
          <th class="p-2">Status</th>
          <th class="p-2">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($orders as $order)
        <tr class="border-b">
          <td class="p-2">{{ $order->id }}</td>
          <td class="p-2">{{ $order->user->name }}</td>
          <td class="p-2">Rp {{ number_format($order->total,0,',','.') }}</td>
          <td class="p-2">
            <span class="px-2 py-1 rounded-full text-sm
              {{ $order->status=='pending' ? 'bg-yellow-200 text-yellow-800' :
                 ($order->status=='dikirim' ? 'bg-blue-200 text-blue-800' :
                 ($order->status=='selesai' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800')) }}">
              {{ ucfirst($order->status) }}
            </span>
          </td>
          <td class="p-2">
            <form method="POST" action="{{ route('orders.updateStatus', $order->id) }}">
              @csrf
              @method('PATCH')
              <select name="status" onchange="this.form.submit()" class="border rounded p-1">
                <option value="diproses" {{ $order->status=='diproses'?'selected':'' }}>Diproses</option>
                <option value="dikirim" {{ $order->status=='dikirim'?'selected':'' }}>Dikirim</option>
                <option value="selesai" {{ $order->status=='selesai'?'selected':'' }}>Selesai</option>
                <option value="batal" {{ $order->status=='batal'?'selected':'' }}>Batal</option>
              </select>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection --}}

@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('breadcrumb')
<a href="{{ route('admin.dashboard') }}">Dashboard</a>
@endsection

@section('content')
<div class="grid grid-cols-3 gap-4">
    <div class="bg-white p-4 shadow rounded">Total Produk: {{ $totalProduk }}</div>
    <div class="bg-white p-4 shadow rounded">Total Pesanan: {{ $totalPesanan }}</div>
    <div class="bg-white p-4 shadow rounded">Total User: {{ $totalUser }}</div>
</div>
@endsection
