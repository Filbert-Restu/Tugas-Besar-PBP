<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Status Pesanan</title>
  @vite('resources/css/app.css') <!-- Import CSS Laravel Vite -->
  <script src="https://cdn.tailwindcss.com"></script> <!-- Import Tailwind via CDN -->
</head>
<body class="bg-gray-50">
  <div class="max-w-xl mx-auto p-6"><!-- Container utama -->

    <!-- ================= DETAIL PESANAN ================= -->
    <div class="bg-white shadow rounded-xl p-6 mb-5"><!-- Card untuk detail pesanan -->
      <h2 class="text-xl font-bold mb-4">Detail Pesanan</h2>

      <!-- Bagian produk -->
      <div class="flex items-center gap-3 mb-4">
        <!-- Gambar produk -->
        <img src="{{ $order->image ?? 'https://via.placeholder.com/60' }}" 
             class="w-16 h-16 rounded-md border">
        <!-- Informasi produk -->
        <div>
          <p class="font-semibold">{{ $order->product }}</p>
          <p class="text-sm text-gray-500">Jumlah: {{ $order->jumlah }}</p>
          <p class="text-sm text-gray-500">Harga: Rp{{ number_format($order->harga,0,',','.') }}</p>
        </div>
      </div>

      <!-- Info kurir & waktu -->
      <p class="text-sm">Kurir: <span class="font-medium">{{ $order->kurir }}</span></p>
      <p class="text-sm">Waktu: 
        <span class="font-medium">{{ \Carbon\Carbon::parse($order->waktu)->format('d/m/Y H:i') }}</span>
      </p>
    </div>

    <!-- ================= FORM UBAH STATUS ================= -->
    <div class="bg-white shadow rounded-xl p-6"><!-- Card form update -->
      <h2 class="text-lg font-bold mb-4">Ubah Status Pesanan</h2>
      
      <!-- Form untuk update status -->
      <form action="{{ url('/status/update/'.$order->id) }}" method="POST" class="space-y-4">
        @csrf <!-- Token keamanan Laravel -->
        
        <!-- Dropdown pilih status -->
        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
        <select id="status" name="status" 
                class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-orange-300">
          <!-- Opsi status dengan kondisi selected sesuai data -->
          <option value="Belum Bayar" {{ $order->status=='Belum Bayar' ? 'selected':'' }}>Belum Bayar</option>
          <option value="Perlu Dikirim" {{ $order->status=='Perlu Dikirim' ? 'selected':'' }}>Perlu Dikirim</option>
          <option value="Dikirim" {{ $order->status=='Dikirim' ? 'selected':'' }}>Dikirim</option>
          <option value="Selesai" {{ $order->status=='Selesai' ? 'selected':'' }}>Selesai</option>
          <option value="Dibatalkan" {{ $order->status=='Dibatalkan' ? 'selected':'' }}>Dibatalkan</option>
          <option value="Pengembalian" {{ $order->status=='Pengembalian' ? 'selected':'' }}>Pengembalian</option>
        </select>
        
        <!-- Tombol submit -->
        <button type="submit" 
                class="w-full bg-orange-500 hover:bg-orange-600 text-white font-medium py-2 px-4 rounded-lg">
          Simpan Perubahan
        </button>
      </form>
    </div>

    <!-- ================= LINK KEMBALI ================= -->
    <div class="mt-4 text-center">
      <a href="{{ url('/pesanan') }}" 
         class="text-blue-500 hover:underline text-sm">← Kembali ke daftar pesanan</a>
    </div>
  </div>
</body>
</html>