# 📦 Installation Guide - KlikMart E-commerce

Panduan lengkap untuk setup project Laravel KlikMart setelah clone dari GitHub.

---

## 📋 Prerequisites (Yang Harus Diinstall Dulu)

Sebelum memulai, pastikan sudah install:

- ✅ **PHP** >= 8.2 ([Download](https://www.php.net/downloads))
- ✅ **Composer** ([Download](https://getcomposer.org/download/))
- ✅ **Node.js** >= 18.x ([Download](https://nodejs.org/))
- ✅ **Git** ([Download](https://git-scm.com/downloads))
- ✅ **SQLite** (biasanya sudah include di PHP)

### Cek Versi (di Terminal/CMD):

```bash
php -v
composer -v
node -v
npm -v
git --version
```

---

## 🚀 Step 1: Clone Repository dari GitHub

```bash
# Clone repository
git clone https://github.com/Filbert-Restu/Tugas-Besar-PBP.git

# Masuk ke folder project
cd Tugas-Besar-PBP

# Checkout ke branch yang tepat (jika perlu)
git checkout test_fe
```

---

## 🔧 Step 2: Install Dependencies

### A. Install PHP Dependencies (Laravel & Packages)

```bash
composer install
```

**Jika error "composer not found"**, install Composer dulu dari [getcomposer.org](https://getcomposer.org)

**Jika error memory limit**, jalankan:

```bash
php -d memory_limit=-1 $(which composer) install
```

### B. Install JavaScript Dependencies (Node.js & NPM)

```bash
npm install
```

**Jika error**, coba:

```bash
npm install --legacy-peer-deps
```

---

## ⚙️ Step 3: Setup Environment File

### A. Copy file .env

```bash
# Windows PowerShell
copy .env.example .env

# Linux/Mac
cp .env.example .env
```

### B. Edit file .env

Buka file `.env` dengan text editor dan sesuaikan:

```env
APP_NAME="KlikMart"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

# Database (SQLite)
DB_CONNECTION=sqlite
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=laravel
# DB_USERNAME=root
# DB_PASSWORD=

# Session Driver
SESSION_DRIVER=database
SESSION_LIFETIME=120

# Midtrans Payment Gateway
MIDTRANS_SERVER_KEY=your_midtrans_server_key_here
MIDTRANS_CLIENT_KEY=your_midtrans_client_key_here
MIDTRANS_IS_PRODUCTION=false
MIDTRANS_IS_SANITIZED=true
MIDTRANS_IS_3DS=true
```

**⚠️ PENTING untuk Production:**

- Ganti `MIDTRANS_SERVER_KEY` dan `MIDTRANS_CLIENT_KEY` dengan key Anda sendiri
- Dapatkan key gratis di [Midtrans Sandbox](https://dashboard.sandbox.midtrans.com/)
- Set `MIDTRANS_IS_PRODUCTION=true` jika sudah live

---

## 🔑 Step 4: Generate Application Key

```bash
php artisan key:generate
```

Output: `Application key set successfully.`

---

## 🗄️ Step 5: Setup Database

### A. Buat file database SQLite

```bash
# Windows PowerShell
New-Item -Path database/database.sqlite -ItemType File -Force

# Linux/Mac
touch database/database.sqlite
```

### B. Jalankan Migration (buat tabel)

```bash
php artisan migrate
```

**Jika error "database not found"**, pastikan file `database/database.sqlite` sudah dibuat.

### C. (Optional) Seed Data Sample

```bash
php artisan db:seed
```

---

## 📦 Step 6: Create Storage Link

```bash
php artisan storage:link
```

Ini untuk link folder `storage/app/public` ke `public/storage` agar gambar bisa diakses.

---

## 🎨 Step 7: Build Frontend Assets

### Development Mode (auto-reload)

```bash
npm run dev
```

Biarkan terminal ini tetap berjalan! Jangan ditutup.

### Production Mode (untuk deploy)

```bash
npm run build
```

---

## 🚀 Step 8: Jalankan Laravel Server

Buka **terminal baru** (jangan tutup terminal `npm run dev`), lalu:

```bash
php artisan serve
```

Server akan jalan di: `http://localhost:8000`

---

## ✅ Step 9: Test Aplikasi

Buka browser dan akses:

- **Home**: http://localhost:8000
- **Login**: http://localhost:8000/login
- **Register**: http://localhost:8000/register

### Default Admin Account (jika ada seeder):

```
Email: admin@example.com
Password: admin123
```

### Default User Account:

```
Email: user@example.com
Password: user123
```

---

## 🛒 Step 10: Test Payment Gateway (Midtrans)

### Test Midtrans Connection:

```
http://localhost:8000/test-midtrans
```

Jika muncul **"SUCCESS ✅"**, berarti Midtrans sudah terhubung!

### Test Checkout Flow:

1. Login sebagai user
2. Tambah produk ke cart
3. Checkout → Isi alamat → Review → Payment
4. Gunakan **Test Card** untuk pembayaran:
   - **Card Number**: `4811 1111 1111 1114`
   - **CVV**: `123`
   - **Exp Date**: `01/25`
   - **OTP**: `112233`

---

## 🔧 Troubleshooting

### ❌ Error: "No application encryption key has been specified"

```bash
php artisan key:generate
php artisan config:clear
```

### ❌ Error: "SQLSTATE[HY000]: General error: 1 no such table"

```bash
php artisan migrate:fresh
```

### ❌ Error: "Class 'Midtrans\Config' not found"

```bash
composer dump-autoload
```

### ❌ Error: SSL Certificate di Midtrans

Sudah di-handle otomatis di code. Tapi jika masih error:

```php
// Di .env, pastikan:
MIDTRANS_IS_PRODUCTION=false
```

### ❌ Error: "Session store not set"

```bash
php artisan migrate  # pastikan tabel sessions sudah dibuat
php artisan config:clear
php artisan session:table  # jika tabel sessions belum ada
php artisan migrate
```

### ❌ Error: npm run dev gagal

```bash
rm -rf node_modules package-lock.json  # hapus folder lama
npm install --legacy-peer-deps
npm run dev
```

### ❌ Port 8000 sudah dipakai

```bash
# Gunakan port lain
php artisan serve --port=8001
```

---

## 🗂️ Struktur Project Penting

```
Tugas-Besar-PBP/
├── app/
│   ├── Http/Controllers/
│   │   ├── AuthController.php          # Login/Register
│   │   ├── CheckoutController.php      # Checkout & Midtrans
│   │   ├── UserController.php          # User Profile
│   │   ├── CartController.php          # Shopping Cart
│   │   └── AdminProductController.php  # Admin Product Management
│   ├── Models/
│   │   ├── User.php
│   │   ├── Product.php
│   │   ├── Order.php
│   │   └── Cart.php
│   └── Livewire/
│       └── CartPage.php                # Cart dengan Livewire
├── database/
│   ├── database.sqlite                 # Database SQLite
│   └── migrations/                     # Database schema
├── resources/
│   ├── views/
│   │   ├── home.blade.php              # Landing page
│   │   ├── login.blade.php
│   │   ├── register.blade.php
│   │   ├── cart.blade.php
│   │   ├── checkout/
│   │   │   ├── address.blade.php       # Step 1: Alamat
│   │   │   ├── review.blade.php        # Step 2: Review
│   │   │   └── payment.blade.php       # Step 3: Payment
│   │   └── user/
│   │       └── profile.blade.php       # User Profile
│   ├── css/
│   │   └── app.css                     # Tailwind CSS
│   └── js/
│       └── app.js                      # JavaScript
├── routes/
│   └── web.php                         # All routes
├── config/
│   └── midtrans.php                    # Midtrans config
├── .env                                # Environment variables
└── composer.json                       # PHP dependencies
```

---

## 📚 Fitur Aplikasi

### User Features:

- ✅ Register & Login
- ✅ Browse Products
- ✅ Add to Cart (Livewire)
- ✅ Checkout Flow (Cart → Address → Review → Payment)
- ✅ Payment with Midtrans
- ✅ User Profile Management
- ✅ Order History

### Admin Features:

- ✅ Product Management (CRUD)
- ✅ Order Management
- ✅ View Orders
- ✅ Update Order Status

### Payment Gateway:

- ✅ Midtrans Snap Integration
- ✅ Multiple Payment Methods
- ✅ Webhook Callback
- ✅ Test Mode & Production Mode

---

## 🌐 Deploy ke Production

### 1. **Push ke GitHub**

```bash
git add .
git commit -m "Ready for production"
git push origin test_fe
```

### 2. **Setup di Server** (VPS/Hosting)

```bash
# Clone di server
git clone https://github.com/Filbert-Restu/Tugas-Besar-PBP.git
cd Tugas-Besar-PBP

# Install dependencies
composer install --optimize-autoloader --no-dev
npm install
npm run build

# Setup environment
cp .env.example .env
php artisan key:generate

# Setup database
php artisan migrate --force

# Cache config
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Set permissions
chmod -R 755 storage bootstrap/cache
```

### 3. **Environment Production**

Edit `.env`:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

MIDTRANS_IS_PRODUCTION=true
MIDTRANS_SERVER_KEY=your_production_server_key
MIDTRANS_CLIENT_KEY=your_production_client_key
```

### 4. **Setup Web Server** (Nginx/Apache)

Point document root ke `/public` folder.

---

## 📞 Support

Jika ada masalah, cek:

1. **Laravel Log**: `storage/logs/laravel.log`
2. **Browser Console**: F12 → Console tab
3. **Network Tab**: F12 → Network tab (untuk API errors)

---

## 🔐 Security Notes

**⚠️ JANGAN COMMIT file-file ini ke GitHub:**

- ✅ `.env` (sudah di `.gitignore`)
- ✅ `database/database.sqlite` (data sensitif)
- ✅ `vendor/` folder
- ✅ `node_modules/` folder

**✅ YANG BOLEH di-commit:**

- `.env.example` (template tanpa key asli)
- Source code
- Migration files
- Public assets

---

## 📝 Changelog

### Version 1.0.0 (October 2025)

- ✅ Laravel 11 setup
- ✅ Midtrans payment integration
- ✅ Complete checkout flow
- ✅ User profile management
- ✅ Admin dashboard
- ✅ SQLite database
- ✅ Livewire cart
- ✅ Tailwind CSS styling

---

## 📄 License

This project is for educational purposes (Tugas Besar PBP).

---

**Happy Coding! 🚀**
