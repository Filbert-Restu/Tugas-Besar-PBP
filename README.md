# 🛒 KlikMart E-Commerce

Modern e-commerce platform built with Laravel 11, Livewire, and Midtrans Payment Gateway.

[![Laravel](https://img.shields.io/badge/Laravel-11.x-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-blue.svg)](https://php.net)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind-3.x-38B2AC.svg)](https://tailwindcss.com)
[![Livewire](https://img.shields.io/badge/Livewire-3.x-FB70A9.svg)](https://livewire.laravel.com)

---

## 📸 Screenshots

![Home Page](https://via.placeholder.com/800x400?text=KlikMart+Home+Page)

---

## ✨ Features

### 🛍️ Customer Features

- ✅ User Registration & Authentication
- ✅ Browse Products with Search
- ✅ Shopping Cart (Livewire Real-time)
- ✅ Multi-step Checkout Flow
  - Cart → Shipping Address → Order Review → Payment
- ✅ Midtrans Payment Integration
  - Credit Card, Bank Transfer, E-Wallet, etc.
- ✅ User Profile Management
  - Edit personal info, address, change password
- ✅ Order History

### 👨‍💼 Admin Features

- ✅ Product Management (CRUD)
- ✅ Order Management
- ✅ View Order Details
- ✅ Update Order Status
- ✅ Dashboard Analytics

### 💳 Payment Gateway

- ✅ Midtrans Snap Integration
- ✅ Sandbox & Production Mode
- ✅ Multiple Payment Methods
- ✅ Webhook Callback
- ✅ Transaction Verification

---

## 🚀 Quick Start

```bash
# Clone repository
git clone https://github.com/Filbert-Restu/Tugas-Besar-PBP.git
cd Tugas-Besar-PBP

# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Setup database
touch database/database.sqlite  # Linux/Mac
# New-Item database/database.sqlite -ItemType File  # Windows
php artisan migrate

# Run development
npm run dev          # Terminal 1
php artisan serve    # Terminal 2

# Open http://localhost:8000
```

**📚 Full Installation Guide:** [INSTALLATION_GUIDE.md](./INSTALLATION_GUIDE.md)

**📖 All Documentation:** [DOCS_INDEX.md](./DOCS_INDEX.md)

---

## 📋 Requirements

- PHP >= 8.2
- Composer
- Node.js >= 18.x
- NPM
- SQLite (or MySQL/PostgreSQL)

---

## 🔧 Configuration

### 1. Environment Variables

Copy `.env.example` to `.env` and configure:

```env
APP_NAME="KlikMart"
APP_URL=http://localhost:8000

# Database
DB_CONNECTION=sqlite

# Session
SESSION_DRIVER=database

# Midtrans Payment Gateway
MIDTRANS_SERVER_KEY=your_server_key
MIDTRANS_CLIENT_KEY=your_client_key
MIDTRANS_IS_PRODUCTION=false
```

### 2. Get Midtrans API Keys

1. Register at [Midtrans Sandbox](https://dashboard.sandbox.midtrans.com/)
2. Get your **Server Key** and **Client Key**
3. Update `.env` file

---

## 🧪 Testing

### Test Midtrans Connection

```
http://localhost:8000/test-midtrans
```

### Test Payment (Sandbox)

Use these test cards:

- **Card Number**: `4811 1111 1111 1114`
- **CVV**: `123`
- **Expiry**: `01/25`
- **OTP**: `112233`

---

## 📁 Project Structure

```
├── app/
│   ├── Http/Controllers/
│   │   ├── AuthController.php
│   │   ├── CheckoutController.php
│   │   ├── UserController.php
│   │   └── AdminProductController.php
│   ├── Models/
│   │   ├── User.php
│   │   ├── Product.php
│   │   └── Order.php
│   └── Livewire/
│       └── CartPage.php
├── resources/
│   ├── views/
│   │   ├── home.blade.php
│   │   ├── checkout/
│   │   └── user/profile.blade.php
│   └── css/app.css
├── routes/web.php
└── config/midtrans.php
```

---

## 🗄️ Database Schema

- **users** - User accounts
- **products** - Product catalog
- **carts** - Shopping carts
- **cart_items** - Cart items
- **orders** - Customer orders
- **order_items** - Order line items
- **sessions** - Session data

---

## 🎨 Tech Stack

- **Backend**: Laravel 11
- **Frontend**: Blade Templates, Livewire, Alpine.js
- **Styling**: Tailwind CSS
- **Database**: SQLite (development), MySQL (production)
- **Payment**: Midtrans Snap
- **Build Tool**: Vite

---

## 🔐 Default Accounts

### Admin

```
Email: admin@example.com
Password: admin123
```

### User

```
Email: user@example.com
Password: user123
```

_(Create via seeder or register manually)_

---

## 📝 Development

### Run Development Server

```bash
# Terminal 1 - Frontend build
npm run dev

# Terminal 2 - Laravel server
php artisan serve
```

### Clear Caches

```bash
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Run Migrations

```bash
php artisan migrate:fresh
```

---

## 🚢 Deployment

### Build for Production

```bash
npm run build
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Environment

Update `.env` for production:

```env
APP_ENV=production
APP_DEBUG=false
MIDTRANS_IS_PRODUCTION=true
```

---

## 🐛 Troubleshooting

### Common Issues

**Error: "No application encryption key"**

```bash
php artisan key:generate
```

**Error: "No such table"**

```bash
php artisan migrate:fresh
```

**Error: Session store not set**

```bash
php artisan migrate  # Ensure sessions table exists
php artisan config:clear
```

**Midtrans SSL Error**
Already handled in code with SSL bypass for development.

---

## 📚 Documentation

- [Installation Guide](./INSTALLATION_GUIDE.md) - Detailed setup instructions
- [Quick Start](./QUICK_START.md) - Get started in 5 minutes
- [Checkout Flow](./CHECKOUT_FLOW_UPDATED.md) - Checkout process documentation
- [Payment Integration](./MIDTRANS_QUICKSTART.md) - Midtrans setup guide

---

## 🤝 Contributing

This is an educational project (Tugas Besar PBP). Feel free to fork and modify.

---

## 📄 License

This project is for educational purposes.

---

## 👨‍💻 Author

**Filbert Restu**

- GitHub: [@Filbert-Restu](https://github.com/Filbert-Restu)

---

## 🙏 Acknowledgments

- Laravel Framework
- Tailwind CSS
- Livewire
- Midtrans Payment Gateway

---

**Made with ❤️ for Tugas Besar PBP**
