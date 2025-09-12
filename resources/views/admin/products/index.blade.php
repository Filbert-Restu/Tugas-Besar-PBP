@extends('layouts.admin')

@section('title', 'Produk')

@section('content')
<div class="flex justify-between items-center mb-4">
  <h1 class="text-2xl font-bold">Produk</h1>
  <a href="{{ route('products.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">+ Tambah Produk</a>
</div>

<div class="bg-white shadow rounded-xl p-4">
  <table class="w-full border-collapse">
    <thead>
      <tr class="bg-gray-100 text-left">
        <th class="p-2">ID</th>
        <th class="p-2">Nama</th>
        <th class="p-2">Harga</th>
        <th class="p-2">Stok</th>
        <th class="p-2">Kategori</th>
        <th class="p-2">Status</th>
        <th class="p-2">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach($products as $product)
      <tr class="border-b">
        <td class="p-2">{{ $product->id }}</td>
        <td class="p-2">{{ $product->name }}</td>
        <td class="p-2">Rp {{ number_format($product->price,0,',','.') }}</td>
        <td class="p-2">{{ $product->stock }}</td>
        <td class="p-2">{{ $product->category->name ?? '-' }}</td>
        <td class="p-2">
          @if($product->is_active)
            <span class="px-2 py-1 bg-green-200 text-green-800 rounded-full text-sm">Aktif</span>
          @else
            <span class="px-2 py-1 bg-red-200 text-red-800 rounded-full text-sm">Nonaktif</span>
          @endif
        </td>
        <td class="p-2">
          <a href="{{ route('products.edit', $product->id) }}" class="text-blue-600">Edit</a> |
          <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-600" onclick="return confirm('Hapus produk ini?')">Hapus</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
