# 📊 Struktur Database - Tugas Besar PBP

> Dokumentasi lengkap struktur database, tabel, dan kolom untuk aplikasi E-Commerce

---

## 📋 Daftar Isi

- [Ringkasan Database](#ringkasan-database)
- [Entity Relationship Diagram](#entity-relationship-diagram)
- [Detail Tabel](#detail-tabel)
  - [1. Users](#1-users)
  - [2. Categories](#2-categories)
  - [3. Products](#3-products)
  - [4. Carts](#4-carts)
  - [5. Cart Items](#5-cart-items)
  - [6. Orders](#6-orders)
  - [7. Order Items](#7-order-items)
  - [8. Sessions](#8-sessions)
  - [9. Cache](#9-cache)
  - [10. Cache Locks](#10-cache-locks)

---

## 🗄️ Ringkasan Database

| No  | Tabel         | Jumlah Kolom | Fungsi                                 |
| --- | ------------- | ------------ | -------------------------------------- |
| 1   | `users`       | 12           | Menyimpan data pengguna (user & admin) |
| 2   | `categories`  | 3            | Menyimpan kategori produk              |
| 3   | `products`    | 9            | Menyimpan data produk                  |
| 4   | `carts`       | 4            | Menyimpan keranjang belanja per user   |
| 5   | `cart_items`  | 5            | Menyimpan item dalam keranjang         |
| 6   | `orders`      | 14           | Menyimpan data pesanan                 |
| 7   | `order_items` | 7            | Menyimpan detail item pesanan          |
| 8   | `sessions`    | 6            | Menyimpan session management Laravel   |
| 9   | `cache`       | 3            | Menyimpan cache aplikasi               |
| 10  | `cache_locks` | 3            | Menyimpan cache locks                  |

**Total: 10 Tabel | 66 Kolom**

---

## 🔗 Entity Relationship Diagram

```
┌─────────────┐
│   USERS     │
│  (id, name, │
│   email)    │
└──────┬──────┘
       │
       │ 1:N
       │
   ┌───┴────────────────────┬───────────────────┐
   │                        │                   │
   │                        │                   │
┌──▼──────┐          ┌──────▼──────┐    ┌──────▼──────┐
│  CARTS  │          │   ORDERS    │    │  SESSIONS   │
│ (id)    │          │   (id)      │    │    (id)     │
└──┬──────┘          └──────┬──────┘    └─────────────┘
   │                        │
   │ 1:N                    │ 1:N
   │                        │
┌──▼────────────┐    ┌──────▼────────────┐
│  CART_ITEMS   │    │   ORDER_ITEMS     │
│     (id)      │    │      (id)         │
└──┬────────────┘    └──┬────────────────┘
   │                    │
   │ N:1                │ N:1
   │                    │
   └────────┬───────────┘
            │
      ┌─────▼──────┐
      │  PRODUCTS  │
      │   (id)     │
      └─────┬──────┘
            │
            │ N:1
            │
     ┌──────▼────────┐
     │  CATEGORIES   │
     │     (id)      │
     └───────────────┘
```

---

## 📖 Detail Tabel

### 1. Users

**Tabel:** `users`  
**Fungsi:** Menyimpan data pengguna sistem (customer & admin)

| No  | Nama Kolom    | Tipe Data            | Null | Default        | Keterangan         |
| --- | ------------- | -------------------- | ---- | -------------- | ------------------ |
| 1   | `id`          | BIGINT UNSIGNED      | NO   | AUTO_INCREMENT | Primary Key        |
| 2   | `name`        | VARCHAR(255)         | NO   | -              | Nama lengkap user  |
| 3   | `email`       | VARCHAR(255)         | NO   | UNIQUE         | Email user (login) |
| 4   | `password`    | VARCHAR(255)         | NO   | -              | Password (hashed)  |
| 5   | `role`        | ENUM('user','admin') | NO   | 'user'         | Role pengguna      |
| 6   | `phone`       | VARCHAR(255)         | YES  | NULL           | Nomor telepon      |
| 7   | `address`     | TEXT                 | YES  | NULL           | Alamat lengkap     |
| 8   | `city`        | VARCHAR(255)         | YES  | NULL           | Kota               |
| 9   | `province`    | VARCHAR(255)         | YES  | NULL           | Provinsi           |
| 10  | `postal_code` | VARCHAR(255)         | YES  | NULL           | Kode pos           |
| 11  | `created_at`  | TIMESTAMP            | YES  | NULL           | Waktu dibuat       |
| 12  | `updated_at`  | TIMESTAMP            | YES  | NULL           | Waktu diupdate     |

**Indexes:**

- PRIMARY KEY: `id`
- UNIQUE KEY: `email`

**Relasi:**

- `1:N` dengan `carts` (user_id)
- `1:N` dengan `orders` (user_id)
- `1:1` dengan `sessions` (user_id)

---

### 2. Categories

**Tabel:** `categories`  
**Fungsi:** Menyimpan kategori produk

| No  | Nama Kolom   | Tipe Data       | Null | Default        | Keterangan     |
| --- | ------------ | --------------- | ---- | -------------- | -------------- |
| 1   | `id`         | BIGINT UNSIGNED | NO   | AUTO_INCREMENT | Primary Key    |
| 2   | `name`       | VARCHAR(255)    | NO   | UNIQUE         | Nama kategori  |
| 3   | `created_at` | TIMESTAMP       | YES  | NULL           | Waktu dibuat   |
| 4   | `updated_at` | TIMESTAMP       | YES  | NULL           | Waktu diupdate |

**Indexes:**

- PRIMARY KEY: `id`
- UNIQUE KEY: `name`

**Relasi:**

- `1:N` dengan `products` (category_id)

**Contoh Data:**

- Elektronik
- Fashion
- Makanan & Minuman
- Olahraga
- Buku

---

### 3. Products

**Tabel:** `products`  
**Fungsi:** Menyimpan data produk yang dijual

| No  | Nama Kolom    | Tipe Data       | Null | Default        | Keterangan                |
| --- | ------------- | --------------- | ---- | -------------- | ------------------------- |
| 1   | `id`          | BIGINT UNSIGNED | NO   | AUTO_INCREMENT | Primary Key               |
| 2   | `name`        | VARCHAR(255)    | NO   | -              | Nama produk               |
| 3   | `description` | TEXT            | YES  | NULL           | Deskripsi produk          |
| 4   | `image`       | VARCHAR(255)    | YES  | NULL           | Path gambar produk        |
| 5   | `price`       | DECIMAL(12,2)   | NO   | -              | Harga produk              |
| 6   | `stock`       | INTEGER         | NO   | 0              | Stok tersedia             |
| 7   | `category_id` | BIGINT UNSIGNED | NO   | -              | Foreign Key ke categories |
| 8   | `is_active`   | BOOLEAN         | NO   | TRUE           | Status aktif produk       |
| 9   | `created_at`  | TIMESTAMP       | YES  | NULL           | Waktu dibuat              |
| 10  | `updated_at`  | TIMESTAMP       | YES  | NULL           | Waktu diupdate            |

**Indexes:**

- PRIMARY KEY: `id`
- FOREIGN KEY: `category_id` → `categories(id)` ON DELETE CASCADE

**Relasi:**

- `N:1` dengan `categories` (category_id)
- `1:N` dengan `cart_items` (product_id)
- `1:N` dengan `order_items` (product_id)

---

### 4. Carts

**Tabel:** `carts`  
**Fungsi:** Menyimpan keranjang belanja per user

| No  | Nama Kolom   | Tipe Data       | Null | Default        | Keterangan                         |
| --- | ------------ | --------------- | ---- | -------------- | ---------------------------------- |
| 1   | `id`         | BIGINT UNSIGNED | NO   | AUTO_INCREMENT | Primary Key                        |
| 2   | `user_id`    | BIGINT UNSIGNED | NO   | -              | Foreign Key ke users               |
| 3   | `status`     | VARCHAR(255)    | NO   | 'active'       | Status: active, ordered, cancelled |
| 4   | `created_at` | TIMESTAMP       | YES  | NULL           | Waktu dibuat                       |
| 5   | `updated_at` | TIMESTAMP       | YES  | NULL           | Waktu diupdate                     |

**Indexes:**

- PRIMARY KEY: `id`
- FOREIGN KEY: `user_id` → `users(id)` ON DELETE CASCADE

**Relasi:**

- `N:1` dengan `users` (user_id)
- `1:N` dengan `cart_items` (cart_id)

**Status Values:**

- `active` - Keranjang aktif
- `ordered` - Sudah di-checkout
- `cancelled` - Dibatalkan

---

### 5. Cart Items

**Tabel:** `cart_items`  
**Fungsi:** Menyimpan item dalam keranjang belanja

| No  | Nama Kolom   | Tipe Data       | Null | Default        | Keterangan              |
| --- | ------------ | --------------- | ---- | -------------- | ----------------------- |
| 1   | `id`         | BIGINT UNSIGNED | NO   | AUTO_INCREMENT | Primary Key             |
| 2   | `cart_id`    | BIGINT UNSIGNED | NO   | -              | Foreign Key ke carts    |
| 3   | `product_id` | BIGINT UNSIGNED | NO   | -              | Foreign Key ke products |
| 4   | `qty`        | INTEGER         | NO   | 1              | Jumlah produk           |
| 5   | `created_at` | TIMESTAMP       | YES  | NULL           | Waktu dibuat            |
| 6   | `updated_at` | TIMESTAMP       | YES  | NULL           | Waktu diupdate          |

**Indexes:**

- PRIMARY KEY: `id`
- FOREIGN KEY: `cart_id` → `carts(id)` ON DELETE CASCADE
- FOREIGN KEY: `product_id` → `products(id)` ON DELETE CASCADE

**Relasi:**

- `N:1` dengan `carts` (cart_id)
- `N:1` dengan `products` (product_id)

---

### 6. Orders

**Tabel:** `orders`  
**Fungsi:** Menyimpan data pesanan customer

| No  | Nama Kolom        | Tipe Data       | Null | Default        | Keterangan              |
| --- | ----------------- | --------------- | ---- | -------------- | ----------------------- |
| 1   | `id`              | BIGINT UNSIGNED | NO   | AUTO_INCREMENT | Primary Key             |
| 2   | `order_id`        | VARCHAR(255)    | YES  | NULL (UNIQUE)  | Order ID untuk Midtrans |
| 3   | `user_id`         | BIGINT UNSIGNED | NO   | -              | Foreign Key ke users    |
| 4   | `subtotal`        | DECIMAL(12,2)   | NO   | 0              | Subtotal sebelum pajak  |
| 5   | `tax`             | DECIMAL(12,2)   | NO   | 0              | Pajak (PPN)             |
| 6   | `total`           | DECIMAL(12,2)   | NO   | -              | Total pembayaran        |
| 7   | `status`          | VARCHAR(255)    | NO   | 'pending'      | Status pesanan          |
| 8   | `address_text`    | TEXT            | YES  | NULL           | Alamat pengiriman       |
| 9   | `payment_status`  | VARCHAR(255)    | NO   | 'unpaid'       | Status pembayaran       |
| 10  | `payment_method`  | VARCHAR(255)    | YES  | NULL           | Metode pembayaran       |
| 11  | `notes`           | TEXT            | YES  | NULL           | Catatan pesanan         |
| 12  | `shipping_status` | VARCHAR(255)    | NO   | 'pending'      | Status pengiriman       |
| 13  | `created_at`      | TIMESTAMP       | YES  | NULL           | Waktu dibuat            |
| 14  | `updated_at`      | TIMESTAMP       | YES  | NULL           | Waktu diupdate          |

**Indexes:**

- PRIMARY KEY: `id`
- UNIQUE KEY: `order_id`
- FOREIGN KEY: `user_id` → `users(id)` ON DELETE CASCADE

**Relasi:**

- `N:1` dengan `users` (user_id)
- `1:N` dengan `order_items` (order_id)

**Status Values:**

- **Order Status**: `pending`, `processing`, `shipped`, `delivered`, `cancelled`
- **Payment Status**: `unpaid`, `paid`, `failed`, `refunded`
- **Shipping Status**: `pending`, `processing`, `shipped`, `delivered`

---

### 7. Order Items

**Tabel:** `order_items`  
**Fungsi:** Menyimpan detail item dalam pesanan

| No  | Nama Kolom   | Tipe Data       | Null | Default        | Keterangan              |
| --- | ------------ | --------------- | ---- | -------------- | ----------------------- |
| 1   | `id`         | BIGINT UNSIGNED | NO   | AUTO_INCREMENT | Primary Key             |
| 2   | `order_id`   | BIGINT UNSIGNED | NO   | -              | Foreign Key ke orders   |
| 3   | `product_id` | BIGINT UNSIGNED | NO   | -              | Foreign Key ke products |
| 4   | `price`      | DECIMAL(12,2)   | NO   | -              | Harga saat checkout     |
| 5   | `qty`        | INTEGER         | NO   | -              | Jumlah produk           |
| 6   | `subtotal`   | DECIMAL(12,2)   | NO   | -              | price × qty             |
| 7   | `created_at` | TIMESTAMP       | YES  | NULL           | Waktu dibuat            |
| 8   | `updated_at` | TIMESTAMP       | YES  | NULL           | Waktu diupdate          |

**Indexes:**

- PRIMARY KEY: `id`
- FOREIGN KEY: `order_id` → `orders(id)` ON DELETE CASCADE
- FOREIGN KEY: `product_id` → `products(id)` ON DELETE CASCADE

**Relasi:**

- `N:1` dengan `orders` (order_id)
- `N:1` dengan `products` (product_id)

**Note:** Harga disimpan saat checkout untuk mencegah perubahan harga produk mempengaruhi order lama.

---

### 8. Sessions

**Tabel:** `sessions`  
**Fungsi:** Menyimpan session management Laravel

| No  | Nama Kolom      | Tipe Data       | Null | Default | Keterangan                   |
| --- | --------------- | --------------- | ---- | ------- | ---------------------------- |
| 1   | `id`            | VARCHAR(255)    | NO   | -       | Primary Key (session ID)     |
| 2   | `user_id`       | BIGINT UNSIGNED | YES  | NULL    | Foreign Key ke users         |
| 3   | `ip_address`    | VARCHAR(45)     | YES  | NULL    | IP address user              |
| 4   | `user_agent`    | TEXT            | YES  | NULL    | Browser user agent           |
| 5   | `payload`       | LONGTEXT        | NO   | -       | Session data (serialized)    |
| 6   | `last_activity` | INTEGER         | NO   | -       | Timestamp aktivitas terakhir |

**Indexes:**

- PRIMARY KEY: `id`
- INDEX: `user_id`
- INDEX: `last_activity`

**Relasi:**

- `N:1` dengan `users` (user_id) - Optional

---

### 9. Cache

**Tabel:** `cache`  
**Fungsi:** Menyimpan cache aplikasi Laravel

| No  | Nama Kolom   | Tipe Data    | Null | Default | Keterangan               |
| --- | ------------ | ------------ | ---- | ------- | ------------------------ |
| 1   | `key`        | VARCHAR(255) | NO   | -       | Primary Key (cache key)  |
| 2   | `value`      | MEDIUMTEXT   | NO   | -       | Cache value (serialized) |
| 3   | `expiration` | INTEGER      | NO   | -       | Timestamp kadaluarsa     |

**Indexes:**

- PRIMARY KEY: `key`

**Fungsi:** Menyimpan cache untuk meningkatkan performa (query results, views, dll.)

---

### 10. Cache Locks

**Tabel:** `cache_locks`  
**Fungsi:** Menyimpan lock untuk atomic cache operations

| No  | Nama Kolom   | Tipe Data    | Null | Default | Keterangan             |
| --- | ------------ | ------------ | ---- | ------- | ---------------------- |
| 1   | `key`        | VARCHAR(255) | NO   | -       | Primary Key (lock key) |
| 2   | `owner`      | VARCHAR(255) | NO   | -       | Lock owner identifier  |
| 3   | `expiration` | INTEGER      | NO   | -       | Timestamp kadaluarsa   |

**Indexes:**

- PRIMARY KEY: `key`

**Fungsi:** Mencegah race condition saat multiple processes mengakses cache yang sama.

---

## 🔐 Foreign Key Constraints

| Tabel Child   | Kolom         | Tabel Parent | Kolom Parent | On Delete |
| ------------- | ------------- | ------------ | ------------ | --------- |
| `products`    | `category_id` | `categories` | `id`         | CASCADE   |
| `carts`       | `user_id`     | `users`      | `id`         | CASCADE   |
| `cart_items`  | `cart_id`     | `carts`      | `id`         | CASCADE   |
| `cart_items`  | `product_id`  | `products`   | `id`         | CASCADE   |
| `orders`      | `user_id`     | `users`      | `id`         | CASCADE   |
| `order_items` | `order_id`    | `orders`     | `id`         | CASCADE   |
| `order_items` | `product_id`  | `products`   | `id`         | CASCADE   |

**Note:** Semua foreign key menggunakan `ON DELETE CASCADE` untuk menjaga referential integrity.

---

## 📊 Data Flow

### 1. User Registration & Login

```
users → sessions
```

### 2. Shopping Process

```
users → carts → cart_items → products
                              ↓
                          categories
```

### 3. Checkout Process

```
cart_items → orders → order_items → products
      ↓
   (status: ordered)
```

### 4. Order Lifecycle

```
orders (pending) → payment (unpaid → paid) → shipping (pending → shipped → delivered)
```

---

## 🛠️ Migration Files

| File                                                        | Fungsi                                        |
| ----------------------------------------------------------- | --------------------------------------------- |
| `0001_01_01_000000_create_users_table.php`                  | Membuat tabel users (dengan kolom alamat)     |
| `2025_09_12_052019_create_categories_table.php`             | Membuat tabel categories                      |
| `2025_09_12_052057_create_products_table.php`               | Membuat tabel products                        |
| `2025_09_12_052122_create_orders_table.php`                 | Membuat tabel orders                          |
| `2025_09_12_052146_create_order_items_table.php`            | Membuat tabel order_items                     |
| `2025_09_12_052201_create_carts_table.php`                  | Membuat tabel carts                           |
| `2025_09_12_052222_create_cart_items_table.php`             | Membuat tabel cart_items                      |
| `2025_09_21_152933_create_cache_table.php`                  | Membuat tabel cache & cache_locks             |
| `2025_10_19_024252_add_midtrans_fields_to_orders_table.php` | Menambah kolom order_id, subtotal, tax, notes |
| `2025_10_19_030000_create_sessions_table.php`               | Membuat tabel sessions                        |

---

## 🎯 Best Practices

### 1. **Soft Deletes**

Tidak menggunakan soft deletes karena CASCADE delete sudah handle referential integrity.

### 2. **Timestamps**

Semua tabel (kecuali cache & sessions) menggunakan `created_at` dan `updated_at`.

### 3. **Naming Convention**

- Table names: **plural, snake_case** (`cart_items`)
- Column names: **snake_case** (`user_id`, `created_at`)
- Foreign keys: **{table}\_id** format (`user_id`, `product_id`)

### 4. **Indexing**

- Primary keys: `id` (BIGINT UNSIGNED AUTO_INCREMENT)
- Foreign keys: Automatic index
- Unique constraints: `email`, `name` (categories), `order_id`

### 5. **Data Types**

- IDs: `BIGINT UNSIGNED`
- Prices: `DECIMAL(12,2)` untuk presisi
- Text panjang: `TEXT` / `LONGTEXT`
- Boolean: `BOOLEAN` (TINYINT(1))
- Enum: `ENUM()` untuk fixed values

---

## 📚 Query Examples

### Get User dengan Orders

```sql
SELECT u.*, o.*
FROM users u
LEFT JOIN orders o ON u.id = o.user_id
WHERE u.id = 1;
```

### Get Cart Items dengan Product Details

```sql
SELECT ci.*, p.name, p.price, (ci.qty * p.price) AS subtotal
FROM cart_items ci
JOIN products p ON ci.product_id = p.id
WHERE ci.cart_id = 1;
```

### Get Order dengan Items

```sql
SELECT o.*, oi.*, p.name
FROM orders o
JOIN order_items oi ON o.id = oi.order_id
JOIN products p ON oi.product_id = p.id
WHERE o.id = 1;
```

### Products by Category

```sql
SELECT p.*, c.name AS category_name
FROM products p
JOIN categories c ON p.category_id = c.id
WHERE c.id = 1 AND p.is_active = 1;
```

---

## 🔄 Database Seeding

Untuk mengisi data dummy, jalankan:

```bash
php artisan migrate:fresh --seed
```

Seeders yang tersedia:

- `DatabaseSeeder.php` - Master seeder
- `UserFactory.php` - Factory untuk generate user dummy
- `ProductSeeder.php` - Seeder untuk produk (jika ada)

---

## 📝 Notes

1. **Order ID**: Kolom `order_id` di tabel `orders` digunakan untuk integrasi Midtrans payment gateway
2. **Price Snapshot**: Harga disimpan di `order_items` untuk historical data
3. **Session Driver**: Menggunakan database session driver (lihat `config/session.php`)
4. **Cache Driver**: Menggunakan database cache driver (lihat `config/cache.php`)

---

## 📞 Support

Jika ada pertanyaan tentang struktur database, silakan buka issue di repository atau hubungi tim developer.

---

**Last Updated:** October 19, 2025  
**Laravel Version:** 11.x  
**Database Engine:** MySQL / MariaDB
