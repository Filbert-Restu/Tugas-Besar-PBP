<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Produk Saya</title>
  <!-- Tailwind CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900">
  <div class="max-w-5xl mx-auto p-5">

    <!-- Header -->
    <div class="flex justify-between gap-3 mb-5">
      <h1 class="m-0 text-4xl font-bold">Produk Saya</h1>
      <a href=""><div class="bg-white border border-gray-200 rounded-xl px-4 py-3 shadow-sm">
        <strong>+ Tambah Produk Baru</strong><br />
      </div></a>
    </div>

    <!-- Kartu utama -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">

      <!-- Tabs -->
      <div class="border-b border-gray-200">
        <div id="tabs" class="flex overflow-x-auto whitespace-nowrap">
          <a href="#" data-tab="all"
             class="tab px-4 py-2 font-semibold text-red-500 border-b-2 border-transparent hover:bg-gray-50">
            Semua (<span id="count-all">0</span>)
          </a>
          <a href="#" data-tab="live"
             class="tab px-4 py-2 font-semibold text-gray-600 border-b-2 border-transparent hover:bg-gray-50">
            Live (<span id="count-live">0</span>)
          </a>
          <a href="#" data-tab="soldout"
             class="tab px-4 py-2 font-semibold text-gray-600 border-b-2 border-transparent hover:bg-gray-50">
            Habis (<span id="count-soldout">0</span>)
          </a>
          <a href="#" data-tab="archived"
             class="tab px-4 py-2 font-semibold text-gray-600 border-b-2 border-transparent hover:bg-gray-50">
            Diarsipkan (<span id="count-archived">0</span>)
          </a>
        </div>
      </div>

      <!-- Filters: hanya cari + urutkan -->
      <div class="flex flex-wrap gap-2 items-center px-4 py-3 border-b border-gray-200">
        <input id="q" type="text" placeholder="Cari Nama Produk"
               class="min-w-[260px] px-3 py-2 border border-gray-300 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-gray-300">
        <div class="ml-auto flex items-center gap-2">
          <span class="text-sm text-gray-700">Urutkan:</span>
          <select id="sort"
                  class="px-3 py-2 border border-gray-300 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-gray-300">
            <option value="reco">Rekomendasi</option>
            <option value="price-asc">Harga Terendah</option>
            <option value="price-desc">Harga Tertinggi</option>
          </select>
        </div>
      </div>

      <!-- Header kolom -->
      <div class="grid grid-cols-[6fr_1fr_2fr_1fr_2fr] gap-3 items-center px-4 py-3 bg-gray-100 font-semibold text-gray-800">
        <div>Produk</div>
        <div class="text-center">Penjualan</div>
        <div class="text-center">Harga</div>
        <div class="text-center">Stok</div>
        <div class="text-center">Aksi</div>
      </div>

      <!-- Daftar -->
      <div id="list"></div>

    </div>
  </div>

  <script>
  // Ambil dari PHP
  const RAW_FROM_PHP = @json($products ?? []);

  // Pastikan array
  const RAW = Array.isArray(RAW_FROM_PHP) ? RAW_FROM_PHP : Object.values(RAW_FROM_PHP);

  // Default harga/stok
  const DEFAULTS = {
    'Elektronik': { price: 5000000, stock: 50 },
    'Furniture' : { price: 750000,  stock: 30 },
    'Fashion'   : { price: 120000,  stock: 100 },
  };

  const PRODUCTS = RAW.map(p => ({
    ...p,
    sold: 0,
    price: (DEFAULTS[p.category]?.price) ?? 100000,
    stock: (DEFAULTS[p.category]?.stock) ?? 10,
    status: 'live',
  }));

  const state = { tab: 'all', q: '', sort: 'reco' };
  const listEl = document.getElementById('list');
  const fmtRp = n => 'Rp' + (n || 0).toLocaleString('id-ID');

  function counts() {
    const all = PRODUCTS.filter(p => !p._deleted).length;
    const live = PRODUCTS.filter(p => !p._deleted && p.status === 'live'    && !p._archived).length;
    const sold = PRODUCTS.filter(p => !p._deleted && p.status === 'soldout' && !p._archived).length;
    const arch = PRODUCTS.filter(p => !p._deleted && p._archived).length;
    document.getElementById('count-all').textContent = all;
    document.getElementById('count-live').textContent = live;
    document.getElementById('count-soldout').textContent = sold;
    document.getElementById('count-archived').textContent = arch;
  }

  function getFiltered() {
    let rows = PRODUCTS.filter(p => !p._deleted);
    if (state.tab === 'live')     rows = rows.filter(p => p.status === 'live'    && !p._archived);
    if (state.tab === 'soldout')  rows = rows.filter(p => p.status === 'soldout' && !p._archived);
    if (state.tab === 'archived') rows = rows.filter(p => p._archived);
    if (state.q.trim()) {
      const q = state.q.toLowerCase();
      rows = rows.filter(p => (p.name || '').toLowerCase().includes(q));
    }
    switch (state.sort) {
      case 'price-asc':  rows.sort((a, b) => a.price - b.price); break;
      case 'price-desc': rows.sort((a, b) => b.price - a.price); break;
      default:           rows.sort((a, b) => (b.sold || 0) - (a.sold || 0));
    }
    return rows;
  }

  function render() {
    const rows = getFiltered();
    listEl.innerHTML = '';
    rows.forEach(p => {
      const row = document.createElement('div');
      row.dataset.id = p.id;

      row.className =
        'row grid grid-cols-[6fr_1fr_2fr_1fr_2fr] gap-3 items-center px-4 py-3 border-t border-gray-100 bg-white ' +
        'hover:bg-gray-50 relative ' + (p._archived ? 'opacity-60' : '');

      row.innerHTML = `
        <div class="flex items-center gap-3">
          <div class="w-15 h-15 min-w-[60px] min-h-[60px] flex items-center justify-center bg-gray-100 rounded-lg text-xs text-gray-500">No Img</div>
          <div>
            <div class="font-semibold">
              ${p.name || '-'}
              ${p._archived ? '<span class="inline-block ml-2 px-2 py-0.5 border border-gray-300 rounded-full text-xs text-gray-700">Diarsipkan</span>' : ''}
            </div>
            <div class="text-xs text-gray-500">${p.category || '-'}</div>
          </div>
        </div>
        <div class="text-center">${p.sold || 0}</div>
        <div class="text-center">${fmtRp(p.price)}</div>
        <div class="text-center">${p.stock}</div>
        <div class="flex justify-center gap-2">
          <button class="btn px-3 py-1.5 border border-gray-300 rounded-lg bg-white hover:bg-gray-100 text-sm">Ubah</button>
          <div class="dropdown relative inline-block">
            <button class="btn dropdown-trigger px-3 py-1.5 border border-gray-300 rounded-lg bg-white hover:bg-gray-100 text-sm">Lainnya ▾</button>
            <div class="menu absolute right-0 mt-1 min-w-[150px] bg-white border border-gray-200 rounded-xl shadow-lg p-1 hidden z-10">
              <button class="act-archive w-full text-left bg-white px-3 py-2 rounded-lg hover:bg-gray-100 text-sm">${p._archived ? 'Batalkan Arsip' : 'Arsipkan'}</button>
              <button class="act-delete w-full text-left bg-white px-3 py-2 rounded-lg hover:bg-gray-100 text-sm">Hapus</button>
            </div>
          </div>
        </div>
      `;
      listEl.appendChild(row);
    });
    counts();
    syncActiveTabClasses();
  }

  function syncActiveTabClasses() {
    // Terapkan style aktif pada tab yang sesuai (Tailwind utilities)
    document.querySelectorAll('#tabs .tab').forEach(a => {
      a.classList.remove('border-gray-900','text-black','bg-gray-50');
      a.classList.add('text-gray-600','border-transparent');
      if (a.dataset.tab === state.tab) {
        a.classList.remove('text-gray-600','border-transparent');
        a.classList.add('border-gray-900','text-black','bg-gray-50');
      }
    });
  }

  // Tabs click
  document.getElementById('tabs').addEventListener('click', e => {
    const t = e.target.closest('.tab');
    if (!t) return;
    e.preventDefault();
    state.tab = t.dataset.tab;
    render();
  });

  // Search & sort
  document.getElementById('q').addEventListener('input', e => { state.q = e.target.value; render(); });
  document.getElementById('sort').addEventListener('change', e => { state.sort = e.target.value; render(); });

  // Dropdown + Actions
  document.addEventListener('click', e => {
    const trig = e.target.closest('.dropdown-trigger');
    const openMenus = document.querySelectorAll('.menu:not(.hidden)');
    if (trig) {
      const menu = trig.parentElement.querySelector('.menu');
      openMenus.forEach(m => { if (m !== menu) m.classList.add('hidden'); });
      menu.classList.toggle('hidden');
      return;
    }
    if (!e.target.closest('.dropdown')) openMenus.forEach(m => m.classList.add('hidden'));

    const row = e.target.closest('.row'); if (!row) return;
    const item = PRODUCTS.find(x => x.id == row.dataset.id);
    if (e.target.classList.contains('act-archive')) { item._archived = !item._archived; render(); }
    if (e.target.classList.contains('act-delete'))  { item._deleted  = true;           render(); }
  });

  // Init
  // Set tab awal sebagai "all"
  state.tab = 'all';
  render();
  </script>
</body>
</html>
