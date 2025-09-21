@extends('admin.layouts.admin')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6">😅 Tambah Produk</h2>

    <div class="bg-white dark:bg-gray-900 shadow-md rounded-lg p-6">
        <form action="{{ route('admin.products.store') }}" method="POST">
            @csrf

            <!-- Nama Produk -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Produk</label>
                <input type="text" name="name" value="{{ old('name') }}"
                       class="w-full px-3 py-2 border rounded-lg 
                              bg-white text-gray-800 
                              dark:bg-gray-800 dark:text-gray-200 
                              border-gray-300 dark:border-gray-700 
                              focus:ring focus:ring-blue-400" required>
                @error('name') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Kategori -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Kategori</label>
                <select name="category_id"
                        class="w-full px-3 py-2 border rounded-lg 
                               bg-white text-gray-800 
                               dark:bg-gray-800 dark:text-gray-200 
                               border-gray-300 dark:border-gray-700 
                               focus:ring focus:ring-blue-400" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Harga -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Harga</label>
                <input type="number" name="price" value="{{ old('price') }}"
                       class="w-full px-3 py-2 border rounded-lg 
                              bg-white text-gray-800 
                              dark:bg-gray-800 dark:text-gray-200 
                              border-gray-300 dark:border-gray-700 
                              focus:ring focus:ring-blue-400" required>
                @error('price') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Stok -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Stok</label>
                <input type="number" name="stock" value="{{ old('stock') }}"
                       class="w-full px-3 py-2 border rounded-lg 
                              bg-white text-gray-800 
                              dark:bg-gray-800 dark:text-gray-200 
                              border-gray-300 dark:border-gray-700 
                              focus:ring focus:ring-blue-400" required>
                @error('stock') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Tombol -->
            <div class="flex items-center gap-3">
                <button type="submit"
                        class="px-5 py-2 text-white font-semibold bg-blue-600 rounded-lg hover:bg-blue-700">
                    Simpan
                </button>
                <a href="{{ route('admin.products.index') }}"
                   class="px-5 py-2 font-semibold text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 
                          dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
