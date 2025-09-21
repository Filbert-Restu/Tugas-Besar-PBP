@extends('admin.layouts.admin')

@section('title', 'Pesanan')

@section('content')
<div class="flex justify-between items-center mb-4">
  <h1 class="text-2xl font-bold">Pesanan</h1>
</div>

<div class="bg-white shadow rounded-xl p-4">
  <table class="w-full border-collapse">
    <thead>
      <tr class="bg-gray-100 text-left">
        <th class="p-2">ID</th>
        <th class="p-2">User</th>
        <th class="p-2">Total</th>
        <th class="p-2">Status</th>
        <th class="p-2">Tanggal</th>
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
            {{ $order->status=='diproses' ? 'bg-yellow-200 text-yellow-800' :
               ($order->status=='dikirim' ? 'bg-blue-200 text-blue-800' :
               ($order->status=='selesai' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800')) }}">
            {{ ucfirst($order->status) }}
          </span>
        </td>
        <td class="p-2">{{ $order->created_at->format('d M Y H:i') }}</td>
        <td class="p-2">
          <form method="POST" action="{{ route('admin.orders.updateStatus', $order->id) }}">
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

<div class="mt-4">
  {{ $orders->links() }}
</div>
@endsection
