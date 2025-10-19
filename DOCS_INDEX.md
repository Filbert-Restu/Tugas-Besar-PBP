# 📚 Documentation Index

Daftar lengkap dokumentasi project KlikMart.

---

## 🚀 Getting Started

### For New Users (Clone dari GitHub)

1. **[QUICK_START.md](./QUICK_START.md)** - Setup dalam 5 menit
2. **[INSTALLATION_GUIDE.md](./INSTALLATION_GUIDE.md)** - Panduan lengkap step-by-step
3. **[SETUP_CHECKLIST.md](./SETUP_CHECKLIST.md)** - Checklist untuk memastikan semua setup berhasil

### Quick Commands

```bash
# Clone & Setup
git clone https://github.com/Filbert-Restu/Tugas-Besar-PBP.git
cd Tugas-Besar-PBP
composer install && npm install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate

# Run
npm run dev          # Terminal 1
php artisan serve    # Terminal 2
```

---

## 💳 Payment Integration

### Midtrans Setup

1. **[MIDTRANS_SETUP.md](./MIDTRANS_SETUP.md)** - Setup Midtrans dari awal
2. **[MIDTRANS_QUICKSTART.md](./MIDTRANS_QUICKSTART.md)** - Quick guide untuk Midtrans
3. **[MIDTRANS_KEYS_PROBLEM.md](./MIDTRANS_KEYS_PROBLEM.md)** - Troubleshooting API keys
4. **[SSL_FIX.md](./SSL_FIX.md)** - Fix SSL certificate issues

### Test Midtrans

```bash
# Test endpoint
http://localhost:8000/test-midtrans

# Test card
Card: 4811 1111 1111 1114
CVV: 123
Exp: 01/25
OTP: 112233
```

---

## 🛒 Checkout Process

### Flow Documentation

1. **[CHECKOUT_FLOW.md](./CHECKOUT_FLOW.md)** - Original checkout flow
2. **[CHECKOUT_FLOW_UPDATED.md](./CHECKOUT_FLOW_UPDATED.md)** - Updated dengan address step
3. **[CHECKOUT_FLOW_DIAGRAM.md](./CHECKOUT_FLOW_DIAGRAM.md)** - Visual diagram lengkap

### Checkout Steps

```
Cart → Address → Review → Payment → Order Created
```

---

## 🐛 Troubleshooting

### Common Issues

1. **[FIX_PAYMENT_NEW_PRODUCT.md](./FIX_PAYMENT_NEW_PRODUCT.md)** - Fix payment untuk produk baru
2. **[ADD_PRODUCT_TROUBLESHOOTING.md](./ADD_PRODUCT_TROUBLESHOOTING.md)** - Troubleshooting add product

### Quick Fixes

```bash
# Clear caches
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Reset database
php artisan migrate:fresh

# Regenerate key
php artisan key:generate

# Check logs
tail -f storage/logs/laravel.log
```

---

## 👨‍💻 Development

### Contributing

1. **[CONTRIBUTING.md](./CONTRIBUTING.md)** - Guidelines untuk kontribusi
2. **README.md** - Project overview

### Code Standards

- PSR-12 for PHP
- Laravel best practices
- Tailwind for styling
- Alpine.js for interactivity

---

## 📁 Project Structure

```
Tugas-Besar-PBP/
├── app/
│   ├── Http/Controllers/
│   │   ├── AuthController.php
│   │   ├── CheckoutController.php
│   │   ├── UserController.php
│   │   └── Admin*.php
│   ├── Models/
│   └── Livewire/
├── resources/
│   ├── views/
│   │   ├── home.blade.php
│   │   ├── checkout/
│   │   └── user/
│   └── css/
├── routes/web.php
├── config/midtrans.php
└── database/
```

---

## 🎯 Features

### User Features

- ✅ Authentication (Register/Login)
- ✅ Browse Products
- ✅ Shopping Cart (Livewire)
- ✅ Checkout Flow (4 steps)
- ✅ Midtrans Payment
- ✅ User Profile Management
- ✅ Order History

### Admin Features

- ✅ Product Management (CRUD)
- ✅ Order Management
- ✅ Dashboard

---

## 🔐 Security

### Important Files (NEVER COMMIT)

- `.env` - Environment variables
- `database/database.sqlite` - Database
- `storage/logs/*.log` - Log files

### Committed Files

- `.env.example` - Template
- All source code
- Migrations
- Documentation

---

## 🧪 Testing

### Manual Testing Checklist

- [ ] User registration works
- [ ] Login/logout works
- [ ] Can browse products
- [ ] Cart functionality works
- [ ] Checkout flow complete
- [ ] Payment integration works
- [ ] Profile page accessible
- [ ] Admin features work

### Test Accounts

```
Admin:
  Email: admin@klikmart.com
  Password: password123

User:
  Email: user@klikmart.com
  Password: password123
```

---

## 📱 Tech Stack

- **Backend**: Laravel 11
- **Frontend**: Blade, Livewire, Alpine.js
- **Styling**: Tailwind CSS
- **Database**: SQLite (dev), MySQL (prod)
- **Payment**: Midtrans Snap
- **Build**: Vite

---

## 🌐 Deployment

### Production Checklist

- [ ] Update `.env` for production
- [ ] Set `APP_DEBUG=false`
- [ ] Set `MIDTRANS_IS_PRODUCTION=true`
- [ ] Use production Midtrans keys
- [ ] Run `npm run build`
- [ ] Run `composer install --no-dev`
- [ ] Cache configs: `php artisan config:cache`
- [ ] Set proper file permissions
- [ ] Setup HTTPS
- [ ] Configure web server

---

## 📞 Support

### Resources

- **Laravel Docs**: https://laravel.com/docs
- **Midtrans Docs**: https://docs.midtrans.com
- **Tailwind Docs**: https://tailwindcss.com/docs
- **Livewire Docs**: https://livewire.laravel.com/docs

### Logs

```bash
# Laravel logs
storage/logs/laravel.log

# Web server logs (if applicable)
/var/log/nginx/error.log
/var/log/apache2/error.log
```

---

## 📝 Version History

### v1.0.0 (October 2025)

- ✅ Initial release
- ✅ Laravel 11 setup
- ✅ Midtrans integration
- ✅ Complete checkout flow
- ✅ User profile management
- ✅ Admin dashboard
- ✅ SQLite database
- ✅ Comprehensive documentation

---

## 🎓 Educational Purpose

This project is created for **Tugas Besar Pemrograman Berbasis Platform (PBP)**.

---

## 📄 License

Educational purpose only.

---

## 👨‍💻 Author

**Filbert Restu**

- GitHub: [@Filbert-Restu](https://github.com/Filbert-Restu)
- Repository: [Tugas-Besar-PBP](https://github.com/Filbert-Restu/Tugas-Besar-PBP)

---

**Last Updated**: October 19, 2025

---

## 🗺️ Documentation Map

```
📚 DOCS_INDEX.md (YOU ARE HERE)
├── 🚀 Getting Started
│   ├── QUICK_START.md
│   ├── INSTALLATION_GUIDE.md
│   └── SETUP_CHECKLIST.md
├── 💳 Payment Integration
│   ├── MIDTRANS_SETUP.md
│   ├── MIDTRANS_QUICKSTART.md
│   ├── MIDTRANS_KEYS_PROBLEM.md
│   └── SSL_FIX.md
├── 🛒 Checkout Process
│   ├── CHECKOUT_FLOW.md
│   ├── CHECKOUT_FLOW_UPDATED.md
│   └── CHECKOUT_FLOW_DIAGRAM.md
├── 🐛 Troubleshooting
│   ├── FIX_PAYMENT_NEW_PRODUCT.md
│   └── ADD_PRODUCT_TROUBLESHOOTING.md
└── 👨‍💻 Development
    ├── CONTRIBUTING.md
    └── README.md
```

---

**Happy Coding! 🎉**
