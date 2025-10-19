# 🚀 Quick Start Guide

Setup cepat untuk KlikMart E-commerce project.

---

## ⚡ Setup dalam 5 Menit

```bash
# 1. Clone repository
git clone https://github.com/Filbert-Restu/Tugas-Besar-PBP.git
cd Tugas-Besar-PBP

# 2. Install dependencies
composer install
npm install

# 3. Setup environment
copy .env.example .env        # Windows
cp .env.example .env          # Linux/Mac

# 4. Generate key
php artisan key:generate

# 5. Setup database
New-Item database/database.sqlite -ItemType File    # Windows PowerShell
touch database/database.sqlite                      # Linux/Mac
php artisan migrate

# 6. Build assets
npm run dev                   # Terminal 1 (biarkan jalan)

# 7. Run server (terminal baru)
php artisan serve             # Terminal 2

# ✅ Buka http://localhost:8000
```

---

## 🔑 Default Accounts

### Admin:

```
Email: admin@klikmart.com
Password: password123
```

### User:

```
Email: user@klikmart.com
Password: password123
```

_(Jika seeder belum dijalankan, register manual)_

---

## 🧪 Test Midtrans Payment

1. Buka: http://localhost:8000/test-midtrans
2. Jika SUCCESS ✅ → Midtrans ready!
3. Test checkout dengan kartu:
   - **Card**: `4811 1111 1111 1114`
   - **CVV**: `123`
   - **Exp**: `01/25`
   - **OTP**: `112233`

---

## ❌ Quick Fixes

### Error: "No application encryption key"

```bash
php artisan key:generate && php artisan config:clear
```

### Error: "No such table"

```bash
php artisan migrate:fresh
```

### Error: npm/node not found

Install Node.js: https://nodejs.org/

### Error: composer not found

Install Composer: https://getcomposer.org/

---

## 📚 Full Documentation

Lihat **[INSTALLATION_GUIDE.md](./INSTALLATION_GUIDE.md)** untuk dokumentasi lengkap.

---

**Need Help?** Check `storage/logs/laravel.log`
