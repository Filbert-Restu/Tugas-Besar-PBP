# ✅ Setup Checklist

Gunakan checklist ini untuk memastikan setup berhasil.

---

## 📦 Prerequisites

- [ ] PHP >= 8.2 installed (`php -v`)
- [ ] Composer installed (`composer -v`)
- [ ] Node.js >= 18.x installed (`node -v`)
- [ ] NPM installed (`npm -v`)
- [ ] Git installed (`git --version`)

---

## 🚀 Installation Steps

### 1. Clone & Navigate

- [ ] Clone repository: `git clone https://github.com/Filbert-Restu/Tugas-Besar-PBP.git`
- [ ] Navigate to folder: `cd Tugas-Besar-PBP`
- [ ] Checkout branch: `git checkout test_fe` (if needed)

### 2. Dependencies

- [ ] Install PHP packages: `composer install`
- [ ] Install Node packages: `npm install`

### 3. Environment Setup

- [ ] Copy `.env` file: `copy .env.example .env` (Windows) or `cp .env.example .env` (Linux/Mac)
- [ ] Generate app key: `php artisan key:generate`
- [ ] Edit `.env` - update Midtrans keys if needed

### 4. Database Setup

- [ ] Create database file: `New-Item database/database.sqlite -ItemType File` (Windows) or `touch database/database.sqlite` (Linux/Mac)
- [ ] Run migrations: `php artisan migrate`
- [ ] (Optional) Seed data: `php artisan db:seed`

### 5. Storage & Cache

- [ ] Create storage link: `php artisan storage:link`
- [ ] Clear caches: `php artisan config:clear && php artisan route:clear && php artisan view:clear`

### 6. Build & Run

- [ ] Terminal 1 - Start Vite: `npm run dev` (keep running)
- [ ] Terminal 2 - Start Laravel: `php artisan serve`
- [ ] Open browser: http://localhost:8000

---

## 🧪 Testing

### Basic Tests

- [ ] Homepage loads: http://localhost:8000
- [ ] Login page works: http://localhost:8000/login
- [ ] Register page works: http://localhost:8000/register
- [ ] Can register new account
- [ ] Can login successfully

### Midtrans Payment Test

- [ ] Test Midtrans connection: http://localhost:8000/test-midtrans
- [ ] Should see: `"status": "SUCCESS ✅"`
- [ ] Add product to cart
- [ ] Checkout flow works
- [ ] Payment page loads with Midtrans Snap
- [ ] Test payment with card: `4811 1111 1111 1114`

### User Features

- [ ] Can browse products
- [ ] Can add to cart
- [ ] Cart count updates
- [ ] Checkout → Address page works
- [ ] Review page shows order summary
- [ ] Payment integration works
- [ ] Profile page accessible: http://localhost:8000/user/profile
- [ ] Can edit profile information
- [ ] Can update address
- [ ] Can change password

### Admin Features (if seeded)

- [ ] Admin login works
- [ ] Admin dashboard accessible
- [ ] Can view products
- [ ] Can add new product
- [ ] Can edit product
- [ ] Can delete product
- [ ] Can view orders

---

## 🐛 Common Issues

### Issue: "composer: command not found"

- [ ] Solution: Install Composer from https://getcomposer.org

### Issue: "npm: command not found"

- [ ] Solution: Install Node.js from https://nodejs.org

### Issue: "No application encryption key"

- [ ] Solution: Run `php artisan key:generate`

### Issue: "SQLSTATE[HY000]: no such table"

- [ ] Solution: Run `php artisan migrate`
- [ ] Ensure `database/database.sqlite` exists

### Issue: "Session store not set"

- [ ] Check `.env`: `SESSION_DRIVER=database`
- [ ] Run: `php artisan migrate` (creates sessions table)
- [ ] Run: `php artisan config:clear`

### Issue: Midtrans error

- [ ] Check `.env` has correct keys
- [ ] Test endpoint: http://localhost:8000/test-midtrans
- [ ] Verify keys format: `Mid-server-...` and `Mid-client-...`

### Issue: Port 8000 already in use

- [ ] Solution: Use different port: `php artisan serve --port=8001`

### Issue: npm install fails

- [ ] Solution: Try `npm install --legacy-peer-deps`
- [ ] Or delete `node_modules` and `package-lock.json`, then `npm install` again

---

## 📝 Environment Variables Checklist

Check your `.env` file has these set:

- [ ] `APP_NAME="KlikMart"`
- [ ] `APP_KEY=base64:...` (generated)
- [ ] `APP_DEBUG=true` (for development)
- [ ] `APP_URL=http://localhost:8000`
- [ ] `DB_CONNECTION=sqlite`
- [ ] `SESSION_DRIVER=database`
- [ ] `MIDTRANS_SERVER_KEY=Mid-server-...`
- [ ] `MIDTRANS_CLIENT_KEY=Mid-client-...`
- [ ] `MIDTRANS_IS_PRODUCTION=false`

---

## 🎯 Success Indicators

You're all set if:

- ✅ Homepage loads without errors
- ✅ Can register and login
- ✅ Products are visible
- ✅ Cart functionality works
- ✅ Checkout flow is complete
- ✅ Midtrans test shows SUCCESS
- ✅ Payment page loads
- ✅ Profile page works
- ✅ No errors in Laravel logs (`storage/logs/laravel.log`)

---

## 📞 Need Help?

If something doesn't work:

1. Check `storage/logs/laravel.log`
2. Check browser console (F12)
3. Re-read [INSTALLATION_GUIDE.md](./INSTALLATION_GUIDE.md)
4. Clear all caches and try again

---

**🎉 Happy Coding!**
