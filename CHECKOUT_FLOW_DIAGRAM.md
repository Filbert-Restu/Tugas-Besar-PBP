# 🛒 Checkout Flow Diagram

Alur lengkap proses checkout di KlikMart.

---

## 📊 Visual Flow

```
┌─────────────────────────────────────────────────────────────────┐
│                        CHECKOUT FLOW                             │
└─────────────────────────────────────────────────────────────────┘

    ┌──────────────┐
    │   Browse     │
    │   Products   │
    └──────┬───────┘
           │
           ▼
    ┌──────────────┐
    │  Add to Cart │ ◄─── User dapat tambah/kurang qty
    └──────┬───────┘
           │
           ▼
    ┌──────────────┐
    │   STEP 1:    │
    │   Cart Page  │ ◄─── Review items, update qty, delete
    │   /cart      │
    └──────┬───────┘
           │ [Checkout Button]
           ▼
    ┌──────────────┐
    │   STEP 2:    │
    │   Address    │ ◄─── Input alamat pengiriman
    │   /checkout/ │      - Nama, Telepon, Alamat
    │   address    │      - Kota, Provinsi, Kode Pos
    └──────┬───────┘
           │ [Lanjut ke Review]
           ▼
    ┌──────────────┐
    │   STEP 3:    │
    │   Review     │ ◄─── Review pesanan & alamat
    │   /checkout  │      - Lihat items
    │              │      - Lihat alamat pengiriman
    │              │      - Lihat total harga + tax
    └──────┬───────┘
           │ [Bayar Sekarang]
           ▼
    ┌──────────────┐
    │   STEP 4:    │
    │   Payment    │ ◄─── Midtrans Snap popup
    │   /checkout/ │      - Pilih metode bayar
    │   payment    │      - Credit Card, Bank Transfer, etc.
    └──────┬───────┘
           │
           ├── [Success] ──────┐
           │                   ▼
           │            ┌──────────────┐
           │            │   Order      │
           │            │   Created    │
           │            │   /order/{id}│
           │            └──────────────┘
           │
           └── [Failed/Cancel] ─────┐
                                    ▼
                             ┌──────────────┐
                             │   Back to    │
                             │   Cart       │
                             └──────────────┘
```

---

## 🔄 Detailed Steps

### 1️⃣ **Cart Page** (`/cart`)

**Purpose**: Review items sebelum checkout

**Features**:

- Display semua items di cart
- Update quantity (+/-)
- Remove items
- Show subtotal per item
- Show total harga
- "Checkout" button

**Session Data Stored**: None (data di database)

---

### 2️⃣ **Address Page** (`/checkout/address`)

**Purpose**: Input alamat pengiriman

**Form Fields**:

```
- Nama Penerima   (pre-filled from user.name)
- No. Telepon     (pre-filled from user.phone)
- Alamat Lengkap  (pre-filled from user.address)
- Kota            (pre-filled from user.city)
- Provinsi        (dropdown, pre-filled)
- Kode Pos        (pre-filled from user.postal_code)
- □ Simpan info untuk checkout berikutnya
```

**Validation**:

- All fields required
- Phone must be numeric
- Postal code must be numeric

**Session Data Stored**:

```php
session()->put('shipping_address', [
    'name' => $request->name,
    'phone' => $request->phone,
    'address' => $request->address,
    'city' => $request->city,
    'province' => $request->province,
    'postal_code' => $request->postal_code,
]);
```

**Action**: Redirect to `/checkout` (review page)

---

### 3️⃣ **Review Page** (`/checkout`)

**Purpose**: Review pesanan sebelum bayar

**Display**:

- **Alamat Pengiriman** (dari session)
  - Nama, Telepon, Alamat lengkap
  - Link "Ubah" untuk edit address
- **Item Pesanan**

  - Gambar produk
  - Nama produk
  - Qty × Harga
  - Subtotal per item

- **Ringkasan Harga**
  - Subtotal: Rp xxx.xxx
  - Tax (10%): Rp xxx.xxx
  - **Total: Rp xxx.xxx**

**Validation**:

- Check if `shipping_address` exists in session
- If not → redirect to `/checkout/address`
- Check if cart not empty
- If empty → redirect to `/cart`

**Action**: "Bayar Sekarang" → `/checkout/payment`

---

### 4️⃣ **Payment Page** (`/checkout/payment`)

**Purpose**: Generate Midtrans Snap Token & handle payment

**Backend Process**:

```php
1. Ambil cart items dari database
2. Hitung subtotal, tax, total
3. Generate unique order_id
4. Prepare Midtrans payload:
   - transaction_details (order_id, gross_amount)
   - customer_details (name, email, phone, address)
   - item_details (product details)
5. Call Midtrans::getSnapToken($params)
6. Return Snap Token ke view
```

**Frontend**:

- Load Midtrans Snap JS
- Open Midtrans Snap popup
- Handle callbacks:
  - `onSuccess` → `/checkout/process`
  - `onPending` → show pending message
  - `onError` → show error message
  - `onClose` → back to review

**Payment Methods** (Midtrans):

- 💳 Credit/Debit Card
- 🏦 Bank Transfer
- 🏪 Convenience Store
- 💰 E-Wallet (GoPay, OVO, DANA)
- 📱 QRIS

---

### 5️⃣ **Process Payment** (`/checkout/process`)

**Purpose**: Create order after successful payment

**Backend Process**:

```php
1. Verify payment status dari Midtrans
2. Create Order:
   - user_id
   - order_id (unique)
   - total, subtotal, tax
   - status: 'pending'
   - shipping address
3. Create Order Items dari cart
4. Reduce product stock
5. Clear cart
6. Clear session (shipping_address)
7. Redirect to order detail
```

**Session Data Cleared**:

- `shipping_address`
- Cart items (database)

---

### 6️⃣ **Webhook Callback** (`/midtrans/callback`)

**Purpose**: Handle notifikasi dari Midtrans

**Process**:

```php
1. Receive POST request dari Midtrans
2. Verify signature
3. Update order status:
   - settlement → paid
   - pending → pending
   - expire → expired
   - cancel → cancelled
4. Return 200 OK
```

**Note**: Webhook bisa diakses tanpa auth

---

## 🔒 Security & Validation

### Session Storage

```php
// Address disimpan di session
session()->put('shipping_address', [...]);
session()->get('shipping_address');
```

### Middleware Protection

```php
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/checkout/address', ...);
    Route::get('/checkout', ...);
    Route::get('/checkout/payment', ...);
});
```

### CSRF Protection

Semua form POST dilindungi dengan `@csrf` token.

### Payment Verification

```php
// Verify dari Midtrans
$status = \Midtrans\Transaction::status($order_id);
```

---

## 📱 User Experience

### Mobile Responsive

- Form address: stacked layout
- Review page: cards stack vertically
- Payment: Midtrans Snap responsive

### Loading States

- Show loading spinner saat generate Snap Token
- Disable button saat proses payment

### Error Handling

- Validation errors: show red text below field
- Payment error: show alert message
- Network error: show retry option

---

## 🧪 Testing Scenarios

### Happy Path

1. ✅ Browse products
2. ✅ Add to cart
3. ✅ Click checkout
4. ✅ Fill address
5. ✅ Review order
6. ✅ Pay with test card
7. ✅ Order created
8. ✅ Cart cleared

### Edge Cases

1. ❌ Checkout dengan cart kosong → redirect to cart
2. ❌ Skip address step → redirect to address
3. ❌ Payment cancelled → back to review
4. ❌ Payment failed → show error
5. ❌ Out of stock saat checkout → show error
6. ❌ Session expired → redirect to login

---

## 🔧 Configuration

### Midtrans Settings (`.env`)

```env
MIDTRANS_SERVER_KEY=Mid-server-xxx
MIDTRANS_CLIENT_KEY=Mid-client-xxx
MIDTRANS_IS_PRODUCTION=false
MIDTRANS_IS_SANITIZED=true
MIDTRANS_IS_3DS=true
```

### Session Settings (`.env`)

```env
SESSION_DRIVER=database
SESSION_LIFETIME=120
```

---

## 📊 Database Tables Involved

### `carts`

```sql
- id
- user_id
- created_at, updated_at
```

### `cart_items`

```sql
- id
- cart_id
- product_id
- quantity
- created_at, updated_at
```

### `orders`

```sql
- id
- user_id
- order_id (unique, for Midtrans)
- total, subtotal, tax
- status (pending, paid, cancelled)
- notes
- shipping_name
- shipping_phone
- shipping_address
- shipping_city
- shipping_province
- shipping_postal_code
- created_at, updated_at
```

### `order_items`

```sql
- id
- order_id
- product_id
- quantity
- price (snapshot)
- created_at, updated_at
```

---

## 🎯 Key Points

1. **Session-based Address**: Alamat disimpan di session, bukan langsung ke database
2. **Order ID**: Unique untuk setiap transaksi (format: `ORDER-{timestamp}-{userId}`)
3. **Price Snapshot**: Harga disimpan di `order_items` (jika harga produk berubah)
4. **Stock Management**: Stock berkurang saat order dibuat
5. **Cart Clearing**: Cart dibersihkan setelah order berhasil
6. **Integer Prices**: Semua harga dikirim ke Midtrans sebagai integer (no decimals)

---

**📚 Related Files:**

- `app/Http/Controllers/CheckoutController.php`
- `resources/views/checkout/address.blade.php`
- `resources/views/checkout/review.blade.php`
- `resources/views/checkout/payment.blade.php`
- `routes/web.php`

---

**🔗 API Docs:**

- [Midtrans Snap Documentation](https://docs.midtrans.com/en/snap/overview)
- [Laravel Session Documentation](https://laravel.com/docs/session)
