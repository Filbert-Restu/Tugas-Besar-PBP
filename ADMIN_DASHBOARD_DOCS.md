# Admin Dashboard - Documentation

## 🎨 Overview

Dashboard admin yang modern dan interaktif dengan desain gradient, statistik real-time, dan visualisasi data yang menarik.

---

## ✨ Fitur Utama

### 1. **Welcome Header**

- Gradient background (indigo → purple → pink)
- Menampilkan tanggal hari ini
- Quick access buttons ke Produk & Pesanan
- Animated background circles

### 2. **Statistik Cards (4 Cards)**

#### 💰 Total Pendapatan

- Total revenue keseluruhan
- Revenue bulan ini
- Icon: Dollar sign
- Border: Green

#### 📦 Total Produk

- Jumlah produk aktif
- Status "Aktif"
- Icon: Box/Package
- Border: Blue

#### 🛒 Total Pesanan

- Jumlah pesanan keseluruhan
- Jumlah pesanan pending
- Icon: Shopping bag
- Border: Purple

#### 👥 Total Pengguna

- Jumlah user (role: user)
- Label: "Pelanggan Aktif"
- Icon: Users
- Border: Pink

### 3. **Pesanan Terbaru (Table)**

- Menampilkan 10 pesanan terbaru
- Kolom: Order ID, Customer, Total, Status, Tanggal
- Status badges dengan warna berbeda:
  - Pending: Yellow
  - Processing: Blue
  - Completed: Green
  - Cancelled: Red
- Link "Lihat Semua" ke halaman orders

### 4. **Alert Stok Menipis**

- Menampilkan 5 produk dengan stok < 10
- Card dengan background merah
- Thumbnail produk
- Jumlah stok tersisa
- Sorted by stock (ascending)

### 5. **Produk Terlaris**

- Top 5 produk dengan penjualan tertinggi
- Ranking dengan nomor badge
- Thumbnail produk
- Total terjual
- Gradient card design

### 6. **Pengguna Terbaru**

- 5 user terbaru
- Avatar dengan initial
- Nama & email
- Waktu bergabung (relative time)
- Gradient blue card

---

## 🎯 Controller Logic

### Data yang Diambil:

```php
// Basic Stats
$totalProduk        // Jumlah produk
$totalPesanan       // Jumlah pesanan
$totalUser          // Jumlah user (role: user)

// Revenue
$totalRevenue       // Total pendapatan (excluding cancelled)
$monthlyRevenue     // Pendapatan bulan ini

// Order Stats
$pendingOrders      // Jumlah pesanan pending
$completedOrders    // Jumlah pesanan completed

// Lists
$recentOrders       // 10 pesanan terbaru with user
$lowStockProducts   // 5 produk dengan stok < 10
$topProducts        // 5 produk terlaris (by total_sold)
$recentUsers        // 5 user terbaru
```

---

## 🎨 Design Features

### Color Scheme:

- **Primary**: Indigo (#4F46E5)
- **Secondary**: Purple (#9333EA)
- **Accent**: Pink (#EC4899)
- **Success**: Green (#10B981)
- **Warning**: Yellow (#F59E0B)
- **Danger**: Red (#EF4444)

### Gradient Backgrounds:

- Header: `indigo-600 → purple-600 → pink-600`
- Revenue card: `green-400 → emerald-500`
- Product card: `blue-400 → indigo-500`
- Order card: `purple-400 → pink-500`
- User card: `pink-400 → red-500`

### Shadows & Transitions:

- Hover effects pada semua cards
- Shadow elevation: `shadow-lg` → `shadow-xl` on hover
- Smooth transitions (0.3s)

### Responsive Design:

- Grid breakpoints:
  - Mobile: 1 column
  - Tablet (md): 2 columns
  - Desktop (lg): 3-4 columns
- Flexible layouts dengan Flexbox & Grid

---

## 📊 Query Optimizations

### Eager Loading:

```php
// Recent orders with user relationship
$recentOrders = Order::with('user')->latest()->take(10)->get();
```

### Aggregations:

```php
// Top products dengan total sold
$topProducts = Product::withCount([
    'orderItems as total_sold' => function($query) {
        $query->selectRaw('sum(quantity)');
    }
])->orderBy('total_sold', 'desc')->take(5)->get();
```

### Filtered Queries:

```php
// Revenue excluding cancelled orders
$totalRevenue = Order::where('status', '!=', 'cancelled')->sum('total');

// Monthly revenue
$monthlyRevenue = Order::where('status', '!=', 'cancelled')
    ->whereMonth('created_at', now()->month)
    ->sum('total');
```

---

## 🔗 Quick Links

Dashboard menyediakan quick access ke:

- **Produk**: `route('admin.products.index')`
- **Pesanan**: `route('admin.orders.index')`
- **Detail Pesanan**: Individual order pages
- **Pengguna**: `route('admin.users.index')`

---

## 📱 Mobile Responsive

Dashboard fully responsive dengan:

- Stack layout untuk mobile
- Horizontal scroll untuk tabel
- Collapsible sections
- Touch-friendly buttons
- Readable font sizes

---

## 🚀 Performance Tips

1. **Caching**: Consider caching dashboard stats untuk reduce queries
2. **Pagination**: Tabel sudah limited ke 10 items
3. **Lazy Loading**: Images menggunakan lazy loading
4. **Index Database**: Pastikan index pada:
   - `orders.status`
   - `orders.created_at`
   - `products.stock`
   - `users.role`
   - `users.created_at`

---

## 🎯 Future Enhancements

Suggestions untuk improvement:

- [ ] Add charts (line, bar, pie) menggunakan Chart.js
- [ ] Real-time updates dengan WebSockets/Pusher
- [ ] Export data to Excel/PDF
- [ ] Date range filter untuk stats
- [ ] Compare with previous period
- [ ] Sales forecast & analytics
- [ ] Customer activity heatmap
- [ ] Product category breakdown chart

---

## 🔧 Customization

### Mengubah Jumlah Items:

```php
// Di controller
$recentOrders = Order::latest()->take(20)->get(); // Ubah dari 10 ke 20
$lowStockProducts = Product::where('stock', '<', 5)->take(10)->get(); // Ubah threshold
```

### Mengubah Warna Theme:

```blade
<!-- Di view, ubah class Tailwind -->
from-indigo-600 via-purple-600 to-pink-600
<!-- menjadi -->
from-blue-600 via-cyan-600 to-teal-600
```

### Menambah Stats Card:

```blade
<div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all p-6 border-l-4 border-orange-500">
  <!-- Content here -->
</div>
```

---

## ✅ Checklist Implementation

- [x] Modern gradient header
- [x] 4 stats cards dengan icons
- [x] Recent orders table
- [x] Low stock alert
- [x] Top products list
- [x] Recent users list
- [x] Responsive design
- [x] Hover effects
- [x] Status badges
- [x] Quick action buttons
- [x] Optimized queries
- [x] Error handling
- [x] Loading states ready

---

## 📝 Notes

- Semua query sudah di-optimize dengan eager loading
- Status badges menggunakan conditional rendering
- Empty states sudah di-handle dengan `@forelse`
- Semua currency format: `Rp{{ number_format($value, 0, ',', '.') }}`
- Dates menggunakan Carbon: `->format('d M Y')` atau `->diffForHumans()`
