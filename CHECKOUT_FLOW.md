# Checkout Flow Documentation

## Alur Checkout Baru

### 1. Cart Page (Keranjang)

**Route:** `GET /cart`  
**Controller:** `CartPage` (Livewire Component)  
**View:** `resources/views/livewire/cart-page.blade.php`

User memilih item yang ingin dibeli dengan checkbox dan klik tombol "Check-out".

**Actions:**

- Select/deselect items dengan checkbox
- Increment/decrement quantity
- Remove items
- Checkout → redirect ke Review Page

---

### 2. Review Page (Review Pesanan)

**Route:** `GET /checkout`  
**Controller:** `CheckoutController@show`  
**View:** `resources/views/checkout/review.blade.php`

User mereview pesanan sebelum melanjutkan ke pembayaran.

**Features:**

- Menampilkan semua item yang akan dibeli
- Menampilkan ringkasan harga (subtotal, pajak, total)
- Validasi stok produk
- Button "Kembali ke Keranjang"
- Button "Lanjut ke Pembayaran" → redirect ke Payment Page

---

### 3. Payment Page (Halaman Pembayaran)

**Route:** `GET /checkout/payment`  
**Controller:** `CheckoutController@payment`  
**View:** `resources/views/checkout/payment.blade.php`

User memilih metode pembayaran dan menambahkan catatan (optional).

**Features:**

- Radio button untuk memilih payment method:
  - Transfer Bank 🏦
  - E-Wallet 💳
  - Cash on Delivery (COD) 💵
- Textarea untuk catatan pesanan (optional)
- Menampilkan ringkasan pesanan di sidebar
- Button "Kembali"
- Button "Konfirmasi Pembayaran" → submit form ke Process

---

### 4. Process Payment (Proses Checkout)

**Route:** `POST /checkout/process`  
**Controller:** `CheckoutController@process`

Memproses pembayaran dan membuat order di database.

**Process:**

1. Validasi payment_method (required)
2. Validasi notes (optional, max 500 chars)
3. Cek user sudah login
4. Ambil selected items dari session
5. Validasi stok semua produk
6. Hitung total (subtotal + tax)
7. **Database Transaction:**
   - Create Order dengan status 'pending'
   - Create OrderItems untuk setiap item
   - Kurangi stok produk
   - Hapus items dari cart
8. Commit transaction
9. Hapus session 'checkout_items'
10. Redirect ke Order Detail page

**On Success:**  
Redirect ke `route('order.show', $order->id)` dengan success message

**On Error:**  
Rollback transaction, redirect ke payment page dengan error message

---

### 5. Cancel Checkout

**Route:** `GET /checkout/cancel`  
**Controller:** `CheckoutController@cancel`

Membatalkan proses checkout dan kembali ke cart.

**Actions:**

- Hapus session 'checkout_items'
- Redirect ke cart.index
- Items tetap ada di keranjang

---

## Routes Summary

```php
// User routes (middleware: auth, role:user)
Route::get('/cart', CartPage::class)->name('cart.index');
Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');
Route::get('/checkout/payment', [CheckoutController::class, 'payment'])->name('checkout.payment');
Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
Route::get('/checkout/cancel', [CheckoutController::class, 'cancel'])->name('checkout.cancel');
Route::get('/order/{order}', [OrderController::class, 'show'])->name('order.show');
```

---

## Session Data

**Key:** `checkout_items`  
**Type:** Array of CartItem IDs  
**Set in:** `CartPage@checkout`  
**Used in:** `CheckoutController@show`, `CheckoutController@payment`, `CheckoutController@process`  
**Removed in:** `CheckoutController@process`, `CheckoutController@cancel`

---

## Payment Methods

1. **transfer_bank** - Transfer Bank
2. **e-wallet** - E-Wallet (GoPay, OVO, DANA, dll)
3. **cod** - Cash on Delivery

---

## Database Tables

### orders

- user_id
- subtotal
- tax
- total
- status (default: 'pending')
- payment_method
- notes
- timestamps

### order_items

- order_id
- product_id
- product_name
- product_price
- quantity
- subtotal
- timestamps

---

## Flow Diagram

```
[Cart Page]
    ↓ (Select items & click Checkout)
[Review Page]
    ↓ (Click "Lanjut ke Pembayaran")
[Payment Page]
    ↓ (Select payment method & click "Konfirmasi Pembayaran")
[Process Payment]
    ↓ (Create order & reduce stock)
[Order Detail / Thank You Page]
```

---

## Notes

- Stok produk dikurangi saat order dibuat (bukan saat item masuk cart)
- Semua proses di dalam database transaction untuk memastikan data consistency
- Session 'checkout_items' dihapus setelah order berhasil dibuat
- Items di cart dihapus setelah order berhasil dibuat
- Tax default: 10%
