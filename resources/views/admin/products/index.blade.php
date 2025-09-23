@extends('admin.layouts.admin')

@section('content')
    <div class="p-6">
        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-purple-900">Daftar Produk</h2>
            <a href="{{ route('admin.products.create') }}"
                class="px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                Tambah Produk
            </a>
        </div>

        <!-- Alert -->
        @if (session('success'))
            <div class="mb-4 p-3 text-sm text-green-700 bg-green-100 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <!-- Kartu utama -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">

            <!-- Tabs -->
            <div class="border-b border-gray-200">
                <div id="tabs" class="flex overflow-x-auto whitespace-nowrap">
                    <a href="#" data-tab="all"
                        class="tab px-4 py-2 font-semibold text-gray-600 border-b-2 border-transparent hover:bg-gray-50">
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

            <!-- Table -->
            <div class="overflow-x-auto bg-white dark:bg-gray-900 shadow-md rounded-lg">
                <table class="w-full border-collapse">
                    <thead class="bg-gray-100 dark:bg-gray-800">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">ID</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">Gambar
                            </th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">Nama</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">Kategori
                            </th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">Harga
                            </th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300">Stok</th>
                            <th class="px-4 py-3 text-center text-sm font-semibold text-gray-600 dark:text-gray-300">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr class="border-b hover:bg-gray-50 dark:hover:bg-gray-800">
                                <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-200">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2">
                                    @if ($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}"
                                            class="w-16 h-16 object-cover rounded-lg">
                                    @else
                                        <span class="text-gray-500">No Image</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-200">{{ $product->name }}</td>
                                <td class="px-4 py-3">
                                    <span
                                        class="px-2 py-1 text-xs font-medium text-blue-700 bg-blue-100 rounded dark:bg-blue-800 dark:text-blue-200">
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
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                        onsubmit="return confirm('Yakin hapus produk ini?')">
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

            {{-- <script>
                // Ambil data produk dari Laravel
                const RAW_FROM_PHP = @json($products);

                // Format array
                const PRODUCTS = RAW_FROM_PHP.map(p => ({
                    ...p,
                    status: p.stock > 0 ? 'live' : 'soldout',
                    _archived: false,
                    _deleted: false,
                }));

                const state = { tab: 'all', q: '', sort: 'reco' };
                const listEl = document.getElementById('list');
                const fmtRp = n => 'Rp' + (n || 0).toLocaleString('id-ID');

                // Hitung jumlah tab
                function counts() {
                    document.getElementById('count-all').textContent     = PRODUCTS.filter(p => !p._deleted).length;
                    document.getElementById('count-live').textContent    = PRODUCTS.filter(p => !p._deleted && p.status === 'live'    && !p._archived).length;
                    document.getElementById('count-soldout').textContent = PRODUCTS.filter(p => !p._deleted && p.status === 'soldout' && !p._archived).length;
                    document.getElementById('count-archived').textContent= PRODUCTS.filter(p => !p._deleted && p._archived).length;
                }

                // Filter data
                function getFiltered() {
                    let rows = PRODUCTS.filter(p => !p._deleted);
                    if (state.tab === 'live')     rows = rows.filter(p => p.status === 'live'    && !p._archived);
                    if (state.tab === 'soldout')  rows = rows.filter(p => p.status === 'soldout' && !p._archived);
                    if (state.tab === 'archived') rows = rows.filter(p => p._archived);

                    if (state.q.trim()) {
                    const q = state.q.toLowerCase();
                    rows = rows.filter(p => (p.name || '').toLowerCase().includes(q));
                    }

                    if (state.sort === 'price-asc')  rows.sort((a,b)=>a.price-b.price);
                    if (state.sort === 'price-desc') rows.sort((a,b)=>b.price-a.price);

                    return rows;
                }

                // Render tabel
                function render() {
                    const rows = getFiltered();
                    listEl.innerHTML = '';

                    if (!rows.length) {
                    listEl.innerHTML = `<tr><td colspan="7" class="px-4 py-6 text-center text-gray-500">Belum ada produk</td></tr>`;
                    return;
                    }

                    rows.forEach((p, idx) => {
                    const tr = document.createElement('tr');
                    tr.className = "border-b hover:bg-gray-50 " + (p._archived ? 'opacity-60' : '');
                    tr.innerHTML = `
                        <td class="px-4 py-3 text-sm">${idx+1}</td>
                        <td class="px-4 py-2">${p.image ? `<img src="/storage/${p.image}" class="w-16 h-16 object-cover rounded-lg">` : `<span class="text-gray-500">No Image</span>`}</td>
                        <td class="px-4 py-3 text-sm">${p.name}</td>
                        <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium text-blue-700 bg-blue-100 rounded">${p.category?.name || '-'}</span></td>
                        <td class="px-4 py-3 text-sm font-semibold text-green-600">${fmtRp(p.price)}</td>
                        <td class="px-4 py-3 text-sm">${p.stock}</td>
                        <td class="px-4 py-3 text-center flex gap-2 justify-center">
                        <a href="/admin/products/${p.id}/edit" class="px-3 py-1 text-xs font-semibold text-white bg-yellow-500 rounded hover:bg-yellow-600">Edit</a>
                        <button onclick="toggleArchive(${p.id})" class="px-3 py-1 text-xs font-semibold text-white bg-gray-600 rounded hover:bg-gray-700">
                            ${p._archived ? 'Unarchive' : 'Archive'}
                        </button>
                        <button onclick="deleteProduct(${p.id})" class="px-3 py-1 text-xs font-semibold text-white bg-red-600 rounded hover:bg-red-700">Delete</button>
                        </td>
                    `;
                    listEl.appendChild(tr);
                    });

                    counts();
                    syncTabs();
                }

                // Action arsip / hapus
                function toggleArchive(id) {
                    const item = PRODUCTS.find(p => p.id === id);
                    if (item) { item._archived = !item._archived; render(); }
                }
                function deleteProduct(id) {
                    const item = PRODUCTS.find(p => p.id === id);
                    if (item) { item._deleted = true; render(); }
                }

                // Tab aktif
                function syncTabs() {
                    document.querySelectorAll('#tabs .tab').forEach(a => {
                    a.classList.remove('border-gray-900','text-black','bg-gray-50');
                    a.classList.add('text-gray-600','border-transparent');
                    if (a.dataset.tab === state.tab) {
                        a.classList.remove('text-gray-600','border-transparent');
                        a.classList.add('border-gray-900','text-black','bg-gray-50');
                    }
                    });
                }

                // Event listener
                document.getElementById('tabs').addEventListener('click', e => {
                    const t = e.target.closest('.tab');
                    if (!t) return;
                    e.preventDefault();
                    state.tab = t.dataset.tab;
                    render();
                });
                document.getElementById('q').addEventListener('input', e => { state.q = e.target.value; render(); });
                document.getElementById('sort').addEventListener('change', e => { state.sort = e.target.value; render(); });

                // Init
                state.tab = 'all';
                render();
            </script>   --}}


            <!-- Pagination -->
            <div class="mt-4">
                {{ $products->links() }}
            </div>
        </div>
    @endsection
