# Admin Order Management Documentation

## Overview

Sistem manajemen pesanan admin yang lengkap dan menarik dengan fitur pencarian, filter, statistik, dan update status pesanan.

## Features

### 1. Statistics Dashboard

- **Total Orders**: Jumlah total pesanan
- **Processing Orders**: Pesanan yang sedang diproses
- **Shipped Orders**: Pesanan dalam pengiriman
- **Total Revenue**: Total pendapatan dari pesanan completed/shipped/processing
- Setiap card memiliki gradient design dan hover animation

### 2. Search & Filters

- **Search Bar**: Cari berdasarkan Order ID, nama customer, atau email
- **Status Filter**: Filter berdasarkan status pesanan (all/pending/processing/shipped/completed/cancelled)
- **Payment Status Filter**: Filter berdasarkan status pembayaran (all/unpaid/paid)
- **Date Range**: Filter berdasarkan tanggal (dari - sampai)
- Reset Filter button untuk clear semua filter
- Export CSV button untuk download data pesanan

### 3. Order List Display

Setiap order card menampilkan:

- **Customer Info**: Avatar, nama, email, waktu pemesanan
- **Order ID**: ID pesanan dalam format monospace
- **Product List**:
  - Thumbnail produk dengan badge quantity
  - Nama produk dan harga
  - Subtotal per item
  - Menampilkan max 2 produk, sisanya ditampilkan "+" indicator
- **Total Amount**: Total pesanan dengan highlight
- **Status Badges**:
  - Status pesanan dengan warna berbeda (pending=yellow, processing=blue, shipped=purple, completed=green, cancelled=red)
  - Status pembayaran (paid/unpaid)
  - Animation pulse untuk status pending/processing
- **Actions**:
  - Dropdown untuk update status
  - Update button (green gradient)
  - Detail button (blue gradient) → navigate ke detail page

### 4. Order Detail Page

- **Order Header**: ID pesanan dan tanggal pemesanan dengan gradient banner
- **Customer Information**:
  - Avatar pelanggan
  - Nama dan email
  - Alamat pengiriman
- **Product List**:
  - Semua produk dalam order
  - Gambar produk, nama, harga, quantity
  - Subtotal per item
  - Grand total
- **Status Sidebar**:
  - Current status dengan icon dan warna
  - Status pembayaran
  - Form update status dengan notes
  - Delete button (hanya untuk cancelled orders)

### 5. Empty State

Ketika tidak ada pesanan:

- Icon ilustrasi
- Pesan yang jelas
- Different message jika karena filter atau memang kosong
- Reset filter button jika ada filter aktif

### 6. Pagination

Laravel pagination dengan query string preservation untuk mempertahankan filter saat navigasi

## Controller Methods

### `index(Request $request)`

- Menampilkan daftar pesanan dengan filter dan search
- Menghitung statistik untuk dashboard cards
- Pagination 10 items per page
- **Query Strings**:
  - `search`: Search term
  - `status`: Order status filter
  - `payment_status`: Payment status filter
  - `date_from`: Start date
  - `date_to`: End date
  - `sort_by`: Column to sort (default: created_at)
  - `sort_order`: Sort direction (default: desc)

### `show($id)`

- Menampilkan detail pesanan
- Load relationships: user, items.product

### `updateStatus(Request $request, $id)`

- Update status pesanan
- Validation: status harus salah satu dari pending/processing/shipped/completed/cancelled
- Optional notes field
- Redirect back dengan success message

### `destroy($id)`

- Delete pesanan (hanya cancelled orders)
- Delete order items terlebih dahulu
- Redirect ke index dengan success message

### `exportOrders(Request $request)`

- Export orders ke CSV
- Apply same filters sebagai index
- Include: Order ID, Customer, Email, Status, Payment, Total, Date

### `bulkUpdateStatus(Request $request)`

- Update status multiple orders sekaligus
- Validation: order_ids array dan status

## Routes

```php
// Admin Order Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::put('/orders/{id}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::delete('/orders/{id}', [AdminOrderController::class, 'destroy'])->name('orders.destroy');
    Route::get('/orders/export', [AdminOrderController::class, 'exportOrders'])->name('orders.export');
    Route::post('/orders/bulk-update', [AdminOrderController::class, 'bulkUpdateStatus'])->name('orders.bulkUpdate');
});
```

## Database Requirements

### Orders Table

```php
- id
- user_id (foreign key to users)
- total (decimal)
- status (pending/processing/shipped/completed/cancelled)
- payment_status (unpaid/paid)
- address_text (text)
- notes (text, nullable)
- created_at
- updated_at
```

### Order Items Table

```php
- id
- order_id (foreign key to orders)
- product_id (foreign key to products)
- price (decimal)
- qty (integer)
- subtotal (decimal)
- created_at
- updated_at
```

## Model Relationships

### Order Model

```php
public function user()
{
    return $this->belongsTo(User::class);
}

public function items()
{
    return $this->hasMany(OrderItem::class);
}
```

### OrderItem Model

```php
public function order()
{
    return $this->belongsTo(Order::class);
}

public function product()
{
    return $this->belongsTo(Product::class);
}
```

## Design Pattern

- **Color Scheme**: Indigo/Purple gradient theme (matching dashboard & products)
- **Cards**: Rounded-2xl with shadow-xl
- **Buttons**: Gradient backgrounds with hover effects
- **Status Badges**: Colored backgrounds with borders and appropriate text colors
- **Icons**: Heroicons (SVG)
- **Responsive**: Grid system untuk desktop, stack untuk mobile

## Usage Example

### Search & Filter Orders

```php
// URL dengan filter
/admin/orders?search=john&status=pending&date_from=2024-01-01

// URL dengan pagination + filter
/admin/orders?page=2&status=completed
```

### Update Status

```html
<form
  action="{{ route('admin.orders.updateStatus', $order->id) }}"
  method="POST"
>
  @csrf @method('PUT')
  <select name="status">
    <option value="pending">Pending</option>
    <option value="processing">Processing</option>
    <option value="shipped">Shipped</option>
    <option value="completed">Completed</option>
    <option value="cancelled">Cancelled</option>
  </select>
  <textarea name="notes"></textarea>
  <button type="submit">Update</button>
</form>
```

## Success/Error Messages

- Success: Green banner dengan checkmark icon
- Error: Red banner dengan warning icon
- Auto-dismiss menggunakan animation pulse

## Future Enhancements

1. Real-time order notifications
2. Order tracking integration
3. Invoice generation (PDF)
4. Email notifications untuk status changes
5. Bulk actions (select multiple orders)
6. Advanced filtering (by price range, by product)
7. Order timeline/history
8. Customer order history
9. Return/refund management
10. Analytics dashboard dengan charts

## Notes

- Gunakan middleware `auth` dan `role:admin` untuk protect routes
- Session flash messages untuk feedback user
- Query string preservation penting untuk UX yang baik saat pagination
- Image fallback untuk produk yang tidak ada gambar
- Soft deletes bisa dipertimbangkan untuk audit trail

## Testing Checklist

- [ ] Search berfungsi untuk Order ID, nama, email
- [ ] Filter status berfungsi
- [ ] Filter payment status berfungsi
- [ ] Date range filter berfungsi
- [ ] Reset filter menghapus semua filter
- [ ] Pagination mempertahankan filter
- [ ] Update status berfungsi
- [ ] Detail page menampilkan data yang benar
- [ ] Delete hanya berfungsi untuk cancelled orders
- [ ] Export CSV menghasilkan file yang benar
- [ ] Empty state muncul saat tidak ada data
- [ ] Responsive di mobile dan desktop
- [ ] Success/error messages muncul dengan benar
