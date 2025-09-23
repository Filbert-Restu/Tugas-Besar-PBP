@extends('admin.layouts.admin')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6">Edit Produk</h2>

    <div class="bg-white dark:bg-gray-900 shadow-md rounded-lg p-6">
        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')

            <!-- Nama Produk -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Produk</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}"
                       class="w-full px-3 py-2 border rounded-lg focus:ring focus:ring-blue-400 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-200" required>
                @error('name') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Kategori -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Kategori</label>
                <select name="category_id"
                        class="w-full px-3 py-2 border rounded-lg focus:ring focus:ring-blue-400 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-200" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Harga -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Harga</label>
                <input type="number" name="price" value="{{ old('price', $product->price) }}"
                       class="w-full px-3 py-2 border rounded-lg focus:ring focus:ring-blue-400 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-200" required>
                @error('price') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Stok -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Stok</label>
                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}"
                       class="w-full px-3 py-2 border rounded-lg focus:ring focus:ring-blue-400 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-200" required>
                @error('stock') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Gambar -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Gambar Produk</label>
                @if($product->image)
                    <img src="{{ asset('storage/'.$product->image) }}" class="w-32 h-32 object-cover mb-2 rounded-lg">
                @endif
                <input type="file" name="image"
                    class="w-full px-3 py-2 border rounded-lg bg-white text-gray-800 
                            dark:bg-gray-800 dark:text-gray-200 
                            border-gray-300 dark:border-gray-700 
                            focus:ring focus:ring-blue-400">
                @error('image') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Deskripsi -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Deskripsi</label>
                <textarea name="description" rows="4"
                        class="w-full px-3 py-2 border rounded-lg bg-white text-gray-800 
                                dark:bg-gray-800 dark:text-gray-200 
                                border-gray-300 dark:border-gray-700 
                                focus:ring focus:ring-blue-400">{{ old('description', $product->description) }}</textarea>
                @error('description') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>


            <!-- Tombol -->
            <div class="flex items-center gap-3">
                <button type="submit"
                        class="px-5 py-2 text-white font-semibold bg-green-600 rounded-lg hover:bg-green-700">
                    Update
                </button>
                <a href="{{ route('admin.products.index') }}"
                   class="px-5 py-2 text-gray-700 font-semibold bg-gray-200 rounded-lg hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
