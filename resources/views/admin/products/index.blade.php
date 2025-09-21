@extends('admin.layouts.admin')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-purple-900">📦 Daftar Produk</h2>
        <a href="{{ route('admin.products.create') }}" 
           class="px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700">
           + Tambah Produk
        </a>
    </div>

    <!-- Alert -->
    @if(session('success'))
        <div class="mb-4 p-3 text-sm text-green-700 bg-green-100 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- Table -->
    <div class="overflow-x-auto bg-white dark:bg-gray-900 shadow-md rounded-lg">
        <table class="w-full border-collapse">
            <thead class="bg-gray-100 dark:bg-gray-800">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">#</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">Nama</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">Kategori</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">Harga</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">Stok</th>
                    <th class="px-4 py-3 text-center text-sm font-semibold text-gray-600 dark:text-gray-300">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr class="border-b hover:bg-gray-50 dark:hover:bg-gray-800">
                    <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-200">{{ $loop->iteration }}</td>
                    <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-200">{{ $product->name }}</td>
                    <td class="px-4 py-3">
                        <span class="px-2 py-1 text-xs font-medium text-blue-700 bg-blue-100 rounded dark:bg-blue-800 dark:text-blue-200">
                            {{ $product->category ? $product->category->name : '-' }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-sm font-semibold text-green-600 dark:text-green-400">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-200">{{ $product->stock }}</td>
                    <td class="px-4 py-3 text-center flex gap-2 justify-center">
                        <a href="{{ route('admin.products.edit', $product) }}" 
                           class="px-3 py-1 text-xs font-semibold text-white bg-yellow-500 rounded hover:bg-yellow-600">
                           Edit
                        </a>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Yakin hapus produk ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" 
                                    class="px-3 py-1 text-xs font-semibold text-white bg-red-600 rounded hover:bg-red-700">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-4 py-6 text-center text-gray-500 dark:text-gray-400">
                        Belum ada produk
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $products->links() }}
    </div>
</div>
@endsection
