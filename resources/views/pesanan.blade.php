<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Daftar Pesanan</title>
  <!-- Tailwind CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900">
  <div class="max-w-6xl mx-auto p-5">

    <!-- Header -->
    <div class="flex justify-between gap-3 mb-5">
      <h1 class="m-0 text-4xl font-bold">Daftar Pesanan</h1>
      <a href="{{ url('/pengiriman-massal') }}">
        <div class="bg-orange-500 text-white rounded-xl px-4 py-3 shadow-sm hover:bg-orange-600">
          <strong>+ Pengiriman Massal</strong>
        </div>
      </a>
    </div>

    <!-- Kartu utama -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">

      <!-- Tabs -->
      <div class="border-b border-gray-200">
        <div id="tabs" class="flex overflow-x-auto whitespace-nowrap">
          @foreach(['Semua','Belum Bayar','Perlu Dikirim','Dikirim','Selesai','Dibatalkan','Pengembalian'] as $tab)
            <a href="{{ url('/pesanan/'.$tab) }}" data-tab="{{ $tab }}"
               class="tab px-4 py-2 font-semibold border-b-2 border-transparent hover:bg-gray-50
               {{ ($status??'Semua')==$tab ? 'border-orange-600 text-orange-600 bg-gray-50' : 'text-gray-600' }}">
              {{ $tab }}
            </a>
          @endforeach
        </div>
      </div>

      <!-- Filter: Cari + Waktu -->
      <div class="flex flex-wrap gap-2 items-center px-4 py-3 border-b border-gray-200">
        <input id="q" type="text" placeholder="Cari Produk"
               class="min-w-[220px] px-3 py-2 border border-gray-300 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-gray-300">
        <div class="flex items-center gap-2">
          <label class="text-sm">Waktu:</label>
          <input type="date" id="start_date"
                 class="px-3 py-2 border border-gray-300 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-gray-300">
          <span>-</span>
          <input type="date" id="end_date"
                 class="px-3 py-2 border border-gray-300 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-gray-300">
        </div>
        <button id="btnFilter"
           class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 text-sm">Filter</button>
      </div>

      <!-- Header kolom -->
      <div class="grid grid-cols-[3fr_1fr_2fr_2fr_1fr_2fr_1fr] gap-3 items-center px-4 py-3 bg-gray-100 font-semibold text-gray-800">
        <div>Produk</div>
        <div class="text-center">Jumlah</div>
        <div class="text-center">Harga</div>
        <div class="text-center">Status</div>
        <div class="text-center">Kurir</div>
        <div class="text-center">Waktu</div>
        <div class="text-center">Aksi</div>
      </div>

      <!-- Daftar Pesanan -->
      <div id="list">
        @forelse($orders as $o)
          @php 
            $color = [
              'Belum Bayar'=>'bg-yellow-100 text-yellow-700',
              'Perlu Dikirim'=>'bg-blue-100 text-blue-700',
              'Dikirim'=>'bg-indigo-100 text-indigo-700',
              'Selesai'=>'bg-green-100 text-green-700',
              'Dibatalkan'=>'bg-red-100 text-red-700',
              'Pengembalian'=>'bg-purple-100 text-purple-700'
            ][$o['status']] ?? 'bg-gray-100';
          @endphp
          <div class="row grid grid-cols-[3fr_1fr_2fr_2fr_1fr_2fr_1fr] gap-3 items-center px-4 py-3 border-t border-gray-100 hover:bg-gray-50"
               data-product="{{ strtolower($o['product']) }}"
               data-waktu="{{ \Carbon\Carbon::parse($o['waktu'])->toDateString() }}">
            
            <!-- Produk + Gambar -->
            <div class="flex items-center gap-3 font-medium">
              <img src="{{ $o['image'] ?? 'https://via.placeholder.com/50' }}" 
                   alt="gambar {{ $o['product'] }}" 
                   class="w-12 h-12 object-cover rounded-md border">
              <span>{{ $o['product'] }}</span>
            </div>

            <div class="text-center">{{ $o['jumlah'] }}</div>
            <div class="text-center">Rp{{ number_format($o['harga'],0,',','.') }}</div>
            <div class="text-center">
              <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $color }}">{{ $o['status'] }}</span>
            </div>
            <div class="text-center">{{ $o['kurir'] }}</div>
            <div class="text-center">{{ \Carbon\Carbon::parse($o['waktu'])->format('m/d/Y H:i') }}</div>

            <!-- ✅ Dropdown Update Status -->
            <div class="text-center">
              <form action="{{ url('/status/update/'.$o['id']) }}" method="POST">
                @csrf
                <select name="status" class="border rounded-lg px-2 py-1 text-sm" onchange="this.form.submit()">
                  <option value="Belum Bayar" {{ $o['status']=='Belum Bayar'?'selected':'' }}>Belum Bayar</option>
                  <option value="Perlu Dikirim" {{ $o['status']=='Perlu Dikirim'?'selected':'' }}>Perlu Dikirim</option>
                  <option value="Dikirim" {{ $o['status']=='Dikirim'?'selected':'' }}>Dikirim</option>
                  <option value="Selesai" {{ $o['status']=='Selesai'?'selected':'' }}>Selesai</option>
                  <option value="Dibatalkan" {{ $o['status']=='Dibatalkan'?'selected':'' }}>Dibatalkan</option>
                  <option value="Pengembalian" {{ $o['status']=='Pengembalian'?'selected':'' }}>Pengembalian</option>
                </select>
              </form>
            </div>
          </div>
        @empty
          <div class="p-6 text-center text-gray-500">Tidak ada pesanan</div>
        @endforelse
      </div>
    </div>
  </div>

  <!-- Script Filter -->
  <script>
    document.getElementById('btnFilter').addEventListener('click', function () {
      const q = document.getElementById('q').value.toLowerCase();
      const start = document.getElementById('start_date').value;
      const end = document.getElementById('end_date').value;

      document.querySelectorAll('#list .row').forEach(row => {
        const product = row.dataset.product;
        const waktu = row.dataset.waktu;

        let matchText = q === '' || product.includes(q);
        let matchDate = true;

        if (start && waktu < start) matchDate = false;
        if (end && waktu > end) matchDate = false;

        row.style.display = (matchText && matchDate) ? 'grid' : 'none';
      });
    });
  </script>
</body>
</html>