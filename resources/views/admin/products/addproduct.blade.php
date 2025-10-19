@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

    <!-- Back Button -->
    <div class="mb-6">
      <a href="{{ route('admin.products.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white hover:bg-gray-50 text-gray-700 rounded-xl transition-all shadow-md font-medium border border-gray-200">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        Kembali ke Daftar Produk
      </a>
    </div>

    <!-- Header Card -->
    <div class="bg-gradient-to-r from-[#00a37a] to-[#00b385] rounded-2xl shadow-2xl p-8 mb-8 text-white relative overflow-hidden">
      <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-10 rounded-full -mr-32 -mt-32"></div>
      <div class="absolute bottom-0 left-0 w-48 h-48 bg-white opacity-10 rounded-full -ml-24 -mb-24"></div>
      <div class="relative z-10 flex items-center gap-4">
        <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
          <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
          </svg>
        </div>
        <div>
          <h1 class="text-3xl font-bold mb-1">Tambah Produk Baru</h1>
          <p class="text-green-100">Lengkapi informasi produk Anda</p>
        </div>
      </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
      <div class="p-8">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="space-y-6">
              <!-- Nama Produk -->
              <div>
                <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                  <svg class="w-4 h-4 text-[#00a37a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                  </svg>
                  Nama Produk
                </label>
                <input
                  type="text"
                  name="name"
                  value="{{ old('name') }}"
                  class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-[#00a37a] focus:ring-4 focus:ring-[#e6f4f1] outline-none transition-all font-medium"
                  placeholder="Masukkan nama produk..."
                  required
                >
                @error('name')
                  <p class="text-sm text-[#e57373] mt-2 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    {{ $message }}
                  </p>
                @enderror
              </div>

              <!-- Kategori -->
              <div>
                <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                  <svg class="w-4 h-4 text-[#00a37a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                  </svg>
                  Kategori
                </label>
                <div class="relative">
                  <select
                    name="category_id"
                    class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-[#00a37a] focus:ring-4 focus:ring-[#e6f4f1] outline-none transition-all font-medium appearance-none bg-white cursor-pointer"
                    required
                  >
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $category)
                      <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                      </option>
                    @endforeach
                  </select>
                  <svg class="w-5 h-5 text-gray-400 absolute right-4 top-4 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                  </svg>
                </div>
                @error('category_id')
                  <p class="text-sm text-[#e57373] mt-2 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    {{ $message }}
                  </p>
                @enderror
              </div>

              <!-- Deskripsi Produk -->
              <div>
                <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                  <svg class="w-4 h-4 text-[#00a37a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                  </svg>
                  Deskripsi Produk
                  <span class="text-xs text-gray-500 font-normal">(Opsional)</span>
                </label>
                <textarea
                  name="description"
                  rows="4"
                  class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-[#00a37a] focus:ring-4 focus:ring-[#e6f4f1] outline-none transition-all font-medium resize-none"
                  placeholder="Ceritakan detail produk Anda..."
                >{{ old('description') }}</textarea>
                <p class="text-xs text-gray-500 mt-2 flex items-center gap-1">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                  </svg>
                  Jelaskan fitur dan keunggulan produk Anda
                </p>
                @error('description')
                  <p class="text-sm text-[#e57373] mt-2 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    {{ $message }}
                  </p>
                @enderror
              </div>

              <!-- Upload Gambar -->
              <div>
                <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                  <svg class="w-4 h-4 text-[#00a37a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                  </svg>
                  Gambar Produk
                  <span class="text-xs text-gray-500 font-normal">(Opsional)</span>
                </label>

                <!-- Input File dengan Drag & Drop -->
                <div class="relative">
                  <input
                    type="file"
                    name="image"
                    id="imageInput"
                    accept="image/*"
                    class="hidden"
                    onchange="previewImage(event)"
                  >
                  <div
                    onclick="document.getElementById('imageInput').click()"
                    class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center cursor-pointer hover:border-[#00a37a] hover:bg-[#f0f9f6] transition-all"
                  >
                    <div class="flex flex-col items-center gap-3">
                      <div class="w-16 h-16 bg-gradient-to-br from-[#e6f4f1] to-[#d0ede6] rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-[#00a37a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                        </svg>
                      </div>
                      <div>
                        <p class="text-sm font-semibold text-gray-700">
                          <span class="text-[#00a37a]">Klik untuk upload</span> atau drag and drop
                        </p>
                        <p class="text-xs text-gray-500 mt-1">PNG, JPG, JPEG hingga 2MB</p>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Preview Gambar Baru -->
                <div id="newImagePreview" class="hidden mt-4 p-4 bg-gradient-to-r from-[#e6f4f1] to-[#f0f9f6] rounded-xl border-2 border-[#00a37a]">
                  <div class="flex items-center justify-between mb-2">
                    <p class="text-xs font-semibold text-[#00a37a]">Preview Gambar:</p>
                    <button
                      type="button"
                      onclick="removeNewImage()"
                      class="text-[#e57373] hover:text-[#d56363] text-xs font-semibold"
                    >
                      Hapus
                    </button>
                  </div>
                  <div class="flex items-center gap-4">
                    <img
                      id="newImagePreviewImg"
                      src=""
                      alt="Preview"
                      class="w-32 h-32 rounded-xl object-cover shadow-md border-2 border-[#00a37a]"
                    >
                    <div class="flex-1">
                      <p id="newImageName" class="text-sm font-semibold text-gray-800"></p>
                      <p id="newImageSize" class="text-xs text-gray-600 mt-1"></p>
                    </div>
                  </div>
                </div>

                @error('image')
                  <p class="text-sm text-[#e57373] mt-2 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    {{ $message }}
                  </p>
                @enderror
              </div>

              <!-- Grid 2 Kolom untuk Harga & Stok -->
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Harga -->
                <div>
                  <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                    <svg class="w-4 h-4 text-[#00a37a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Harga
                  </label>
                  <div class="relative">
                    <span class="absolute left-4 top-3.5 text-gray-500 font-semibold">Rp</span>
                    <input
                      type="number"
                      name="price"
                      value="{{ old('price') }}"
                      class="w-full pl-12 pr-4 py-3 border-2 border-gray-300 rounded-xl focus:border-[#00a37a] focus:ring-4 focus:ring-[#e6f4f1] outline-none transition-all font-medium"
                      placeholder="0"
                      min="0"
                      required
                    >
                  </div>
                  @error('price')
                    <p class="text-sm text-[#e57373] mt-2 flex items-center gap-1">
                      <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                      </svg>
                      {{ $message }}
                    </p>
                  @enderror
                </div>

                <!-- Stok -->
                <div>
                  <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-2">
                    <svg class="w-4 h-4 text-[#00a37a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    Stok
                  </label>
                  <div class="relative">
                    <input
                      type="number"
                      name="stock"
                      value="{{ old('stock') }}"
                      class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-[#00a37a] focus:ring-4 focus:ring-[#e6f4f1] outline-none transition-all font-medium"
                      placeholder="0"
                      min="0"
                      required
                    >
                    <span class="absolute right-4 top-3.5 text-gray-500 font-medium text-sm">unit</span>
                  </div>
                  @error('stock')
                    <p class="text-sm text-[#e57373] mt-2 flex items-center gap-1">
                      <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                      </svg>
                      {{ $message }}
                    </p>
                  @enderror
                </div>
              </div>

              <!-- Info Box -->
              <div class="bg-gradient-to-r from-[#e6f4f1] to-[#f0f9f6] border-l-4 border-[#00a37a] rounded-xl p-4">
                <div class="flex items-start gap-3">
                  <svg class="w-5 h-5 text-[#00a37a] flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                  </svg>
                  <div>
                    <p class="text-sm font-semibold text-gray-800 mb-1">Tips Produk Berkualitas</p>
                    <ul class="text-sm text-gray-700 space-y-1">
                      <li class="flex items-start gap-2">
                        <span class="text-[#00a37a] mt-1">•</span>
                        <span>Gunakan foto yang jelas dan menarik untuk meningkatkan penjualan</span>
                      </li>
                      <li class="flex items-start gap-2">
                        <span class="text-[#00a37a] mt-1">•</span>
                        <span>Tulis deskripsi detail tentang fitur dan keunggulan produk</span>
                      </li>
                      <li class="flex items-start gap-2">
                        <span class="text-[#00a37a] mt-1">•</span>
                        <span>Tentukan harga yang kompetitif sesuai nilai produk</span>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row items-center gap-4 mt-8 pt-6 border-t border-gray-200">
              <button
                type="submit"
                class="w-full sm:w-auto px-8 py-3 bg-gradient-to-r from-[#00a37a] to-[#00b385] text-white rounded-xl hover:from-[#00b385] hover:to-[#00c390] transition-all shadow-lg hover:shadow-xl font-semibold flex items-center justify-center gap-2"
              >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Simpan Produk
              </button>
              <a
                href="{{ route('admin.products.index') }}"
                class="w-full sm:w-auto px-8 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-xl transition-all font-semibold flex items-center justify-center gap-2"
              >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                Batal
              </a>
            </div>
        </form>
      </div>
    </div>

  </div>
</div>

<script>
function previewImage(event) {
  const file = event.target.files[0];

  if (file) {
    // Validasi ukuran file (max 2MB)
    if (file.size > 2 * 1024 * 1024) {
      alert('Ukuran file terlalu besar! Maksimal 2MB');
      event.target.value = '';
      return;
    }

    // Validasi tipe file
    const validTypes = ['image/jpeg', 'image/jpg', 'image/png'];
    if (!validTypes.includes(file.type)) {
      alert('Format file tidak valid! Gunakan PNG, JPG, atau JPEG');
      event.target.value = '';
      return;
    }

    const reader = new FileReader();

    reader.onload = function(e) {
      // Show preview container
      document.getElementById('newImagePreview').classList.remove('hidden');

      // Set preview image
      document.getElementById('newImagePreviewImg').src = e.target.result;

      // Set file info
      document.getElementById('newImageName').textContent = file.name;
      document.getElementById('newImageSize').textContent = formatFileSize(file.size);
    };

    reader.readAsDataURL(file);
  }
}

function removeNewImage() {
  // Clear file input
  document.getElementById('imageInput').value = '';

  // Hide preview
  document.getElementById('newImagePreview').classList.add('hidden');

  // Clear preview image
  document.getElementById('newImagePreviewImg').src = '';
  document.getElementById('newImageName').textContent = '';
  document.getElementById('newImageSize').textContent = '';
}

function formatFileSize(bytes) {
  if (bytes === 0) return '0 Bytes';

  const k = 1024;
  const sizes = ['Bytes', 'KB', 'MB'];
  const i = Math.floor(Math.log(bytes) / Math.log(k));

  return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
}

// Drag and drop functionality
const dropZone = document.querySelector('[onclick*="imageInput"]');

dropZone.addEventListener('dragover', (e) => {
  e.preventDefault();
  dropZone.classList.add('border-[#00a37a]', 'bg-[#f0f9f6]');
});

dropZone.addEventListener('dragleave', (e) => {
  e.preventDefault();
  dropZone.classList.remove('border-[#00a37a]', 'bg-[#f0f9f6]');
});

dropZone.addEventListener('drop', (e) => {
  e.preventDefault();
  dropZone.classList.remove('border-[#00a37a]', 'bg-[#f0f9f6]');

  const files = e.dataTransfer.files;
  if (files.length > 0) {
    document.getElementById('imageInput').files = files;
    previewImage({ target: { files: files } });
  }
});
</script>
@endsection
