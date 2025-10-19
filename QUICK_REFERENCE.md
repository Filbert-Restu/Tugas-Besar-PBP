# 🎯 Quick Reference Card

Cheat sheet untuk command & link penting.

---

## ⚡ Essential Commands

### First Time Setup

```bash
git clone https://github.com/Filbert-Restu/Tugas-Besar-PBP.git
cd Tugas-Besar-PBP
composer install && npm install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite  # Linux/Mac
php artisan migrate
```

### Daily Development

```bash
# Terminal 1
npm run dev

# Terminal 2
php artisan serve
```

### Clear Caches

```bash
php artisan config:clear && php artisan route:clear && php artisan view:clear
```

### Reset Database

```bash
php artisan migrate:fresh --seed
```

---

## 🔗 Important URLs

| Purpose           | URL                                   |
| ----------------- | ------------------------------------- |
| **Homepage**      | http://localhost:8000                 |
| **Login**         | http://localhost:8000/login           |
| **Register**      | http://localhost:8000/register        |
| **Cart**          | http://localhost:8000/cart            |
| **Profile**       | http://localhost:8000/user/profile    |
| **Admin**         | http://localhost:8000/admin/dashboard |
| **Test Midtrans** | http://localhost:8000/test-midtrans   |

---

## 👤 Test Accounts

### Admin

```
Email: admin@klikmart.com
Password: password123
```

### User

```
Email: user@klikmart.com
Password: password123
```

---

## 💳 Test Payment (Midtrans Sandbox)

| Field           | Value               |
| --------------- | ------------------- |
| **Card Number** | 4811 1111 1111 1114 |
| **CVV**         | 123                 |
| **Expiry**      | 01/25               |
| **OTP**         | 112233              |

---

## 📁 Key Files

| File                                          | Purpose            |
| --------------------------------------------- | ------------------ |
| `.env`                                        | Environment config |
| `routes/web.php`                              | All routes         |
| `app/Http/Controllers/CheckoutController.php` | Checkout logic     |
| `resources/views/checkout/`                   | Checkout views     |
| `config/midtrans.php`                         | Midtrans config    |

---

## 🗂️ Database Tables

| Table         | Purpose          |
| ------------- | ---------------- |
| `users`       | User accounts    |
| `products`    | Product catalog  |
| `carts`       | Shopping carts   |
| `cart_items`  | Cart items       |
| `orders`      | Customer orders  |
| `order_items` | Order line items |
| `sessions`    | Session data     |

---

## 🛠️ Artisan Commands

```bash
# Database
php artisan migrate              # Run migrations
php artisan migrate:fresh        # Fresh database
php artisan db:seed              # Seed data

# Cache
php artisan config:cache         # Cache config
php artisan route:cache          # Cache routes
php artisan view:cache           # Cache views
php artisan optimize:clear       # Clear all caches

# Development
php artisan serve                # Start server
php artisan serve --port=8001    # Custom port
php artisan tinker               # REPL console
php artisan route:list           # List all routes

# Generate
php artisan make:controller ControllerName
php artisan make:model ModelName -m
php artisan make:migration migration_name
php artisan make:livewire ComponentName
```

---

## 🐛 Quick Fixes

| Problem             | Solution                        |
| ------------------- | ------------------------------- |
| **No app key**      | `php artisan key:generate`      |
| **No such table**   | `php artisan migrate`           |
| **Session error**   | `php artisan config:clear`      |
| **Route not found** | `php artisan route:clear`       |
| **View not found**  | `php artisan view:clear`        |
| **Port in use**     | `php artisan serve --port=8001` |
| **Midtrans error**  | Check `/test-midtrans` endpoint |

---

## 📚 Documentation Links

| Doc                                                    | Description       |
| ------------------------------------------------------ | ----------------- |
| [QUICK_START.md](./QUICK_START.md)                     | 5-minute setup    |
| [INSTALLATION_GUIDE.md](./INSTALLATION_GUIDE.md)       | Full setup guide  |
| [SETUP_CHECKLIST.md](./SETUP_CHECKLIST.md)             | Verification list |
| [CHECKOUT_FLOW_DIAGRAM.md](./CHECKOUT_FLOW_DIAGRAM.md) | Visual flow       |
| [CONTRIBUTING.md](./CONTRIBUTING.md)                   | How to contribute |
| [GIT_GUIDE.md](./GIT_GUIDE.md)                         | Git workflow      |
| [DOCS_INDEX.md](./DOCS_INDEX.md)                       | All docs index    |

---

## 🔧 Environment Variables

```env
# App
APP_NAME=KlikMart
APP_URL=http://localhost:8000
APP_DEBUG=true

# Database
DB_CONNECTION=sqlite

# Session
SESSION_DRIVER=database

# Midtrans
MIDTRANS_SERVER_KEY=your_server_key
MIDTRANS_CLIENT_KEY=your_client_key
MIDTRANS_IS_PRODUCTION=false
```

---

## 🚦 Checkout Flow

```
1. Cart (/cart)
   ↓
2. Address (/checkout/address)
   ↓
3. Review (/checkout)
   ↓
4. Payment (/checkout/payment)
   ↓
5. Order Created (/order/{id})
```

---

## 🎨 Tech Stack

- **Backend**: Laravel 11, PHP 8.2+
- **Frontend**: Blade, Livewire, Alpine.js
- **Styling**: Tailwind CSS
- **Database**: SQLite (dev), MySQL (prod)
- **Payment**: Midtrans Snap
- **Build**: Vite

---

## 📞 Where to Get Help

1. Check `storage/logs/laravel.log`
2. Check browser console (F12)
3. Read [INSTALLATION_GUIDE.md](./INSTALLATION_GUIDE.md)
4. Check [DOCS_INDEX.md](./DOCS_INDEX.md)
5. Google the error message
6. Check Laravel docs: https://laravel.com/docs

---

## ⚡ Speed Tips

### Faster Development

```bash
# Watch changes
npm run dev

# Auto-reload (optional, install browser extension)
# LiveReload or BrowserSync
```

### Faster Database Reset

```bash
php artisan migrate:fresh --seed
```

### Faster Cache Clear

```bash
php artisan optimize:clear
```

---

## 🎯 Project Structure (Simplified)

```
├── app/
│   ├── Http/Controllers/    # Logic
│   ├── Models/              # Database models
│   └── Livewire/            # Real-time components
├── resources/
│   ├── views/               # HTML templates
│   └── css/                 # Styles
├── routes/web.php           # Routes definition
├── database/
│   └── migrations/          # Database schema
└── public/                  # Public assets
```

---

**💡 Tip**: Print this page and keep it beside you while coding!

---

**🚀 Happy Coding!**
