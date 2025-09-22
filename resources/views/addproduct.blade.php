<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Tambah Produk</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-900">
  <div class="max-w-3xl mx-auto p-4 sm:p-6">
    <!-- Header -->
    <header class="flex items-center gap-3 mb-6">
      <a href="{{ route('catalog') }}"
         class="inline-flex items-center justify-center w-9 h-9 rounded-xl border border-gray-300 bg-white hover:bg-gray-100">←</a>
      <h1 class="text-2xl sm:text-3xl font-bold tracking-tight">Tambah Produk</h1>
    </header>

    <!-- Error summary -->
    @if ($errors->any())
      <div class="mb-6 rounded-2xl border border-gray-300 bg-white p-4">
        <div class="font-semibold text-gray-900">Periksa kembali isianmu:</div>
        <ul class="mt-2 list-disc pl-6 text-sm text-red-600">
          @foreach ($errors->all() as $err)
            <li>{{ $err }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('addproduct.store') }}" method="POST" class="space-y-5">
      @csrf

      <!-- Nama Produk -->
      <div>
        <label for="name" class="block text-sm font-medium text-gray-800 mb-1">
          Nama Produk <span class="text-red-600">*</span>
        </label>
        <input id="name" name="name" type="text" maxlength="255" required
               value="{{ old('name') }}"
               placeholder="Masukkan nama produk"
               class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 placeholder:text-gray-400
                      focus:outline-none focus:ring-2 focus:ring-gray-800 focus:border-gray-800" />
        @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
      </div>

      <!-- Deskripsi -->
      <div>
        <label for="description" class="block text-sm font-medium text-gray-800 mb-1">
          Deskripsi Produk <span class="text-red-600">*</span>
        </label>
        <textarea id="description" name="description" rows="5" required
                  placeholder="Tuliskan detail produk, kondisi, ukuran, dll."
                  class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3 placeholder:text-gray-400
                         focus:outline-none focus:ring-2 focus:ring-gray-800 focus:border-gray-800">{{ old('description') }}</textarea>
        @error('description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
      </div>

      <!-- Kategori -->
      <div>
        <label for="category" class="block text-sm font-medium text-gray-800 mb-1">
          Kategori <span class="text-red-600">*</span>
        </label>
        <input id="category" name="category" type="text" required
               value="{{ old('category') }}"
               placeholder="Contoh: Elektronik / Fashion / Furniture"
               class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3
                      focus:outline-none focus:ring-2 focus:ring-gray-800 focus:border-gray-800" />
        @error('category') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
      </div>

      <!-- Harga -->
      <div>
        <label for="price" class="block text-sm font-medium text-gray-800 mb-1">
          Harga <span class="text-red-600">*</span>
        </label>
        <div class="relative">
          <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500">Rp</span>
          <input id="price" name="price" type="number" min="0" step="100" required
                 value="{{ old('price') }}"
                 placeholder="0"
                 class="w-full rounded-2xl border border-gray-300 bg-white pl-12 pr-4 py-3
                        focus:outline-none focus:ring-2 focus:ring-gray-800 focus:border-gray-800" />
        </div>
        @error('price') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
      </div>

      <!-- Stok -->
      <div>
        <label for="stock" class="block text-sm font-medium text-gray-800 mb-1">
          Stok <span class="text-red-600">*</span>
        </label>
        <input id="stock" name="stock" type="number" min="0" step="1" required
               value="{{ old('stock', 0) }}"
               placeholder="0"
               class="w-full rounded-2xl border border-gray-300 bg-white px-4 py-3
                      focus:outline-none focus:ring-2 focus:ring-gray-800 focus:border-gray-800" />
        @error('stock') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
      </div>

      <!-- Ongkos Kirim -->
      <div>
        <label for="shipping_cost" class="block text-sm font-medium text-gray-800 mb-1">
          Ongkos Kirim <span class="text-red-600">*</span>
        </label>
        <div class="relative">
          <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500">Rp</span>
          <input id="shipping_cost" name="shipping_cost" type="number" min="0" step="100" required
                 value="{{ old('shipping_cost', 0) }}"
                 placeholder="0"
                 class="w-full rounded-2xl border border-gray-300 bg-white pl-12 pr-4 py-3
                        focus:outline-none focus:ring-2 focus:ring-gray-800 focus:border-gray-800" />
        </div>
        @error('shipping_cost') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
      </div>

      <!-- Tombol aksi -->
      <div class="pt-2 flex items-center gap-3">
        <button type="submit"
                class="inline-flex justify-center rounded-2xl bg-gray-900 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-black focus:outline-none focus:ring-2 focus:ring-gray-800">
          Simpan
        </button>
        <a href="{{ route('catalog') }}"
           class="inline-flex justify-center rounded-2xl border border-gray-300 bg-white px-5 py-3 text-sm font-semibold text-gray-900 hover:bg-gray-100">
          Batal
        </a>
      </div>
    </form>
  </div>
</body>
</html>