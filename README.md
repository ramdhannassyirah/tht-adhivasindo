# 🛒 Simple Online Store API

Aplikasi toko online sederhana berbasis **Laravel 13** dengan **JWT Authentication**.

---

# ⚙️ Installation

## 1. Clone Repository

```bash
git clone https://github.com/ramdhannassyirah/tht-adhivasindo.git
cd tht-adhivasindo
```

## 2. Install Dependency

```bash
composer install
```

## 3. Setup Environment

```bash
cp .env.example .env
php artisan key:generate
```

---

# 🗄️ Database Setup

Sesuaikan konfigurasi database di file `.env`:

```env
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

Jalankan migrasi:

```bash
php artisan migrate
```

---

# Storage Setup

Buat symbolic link untuk storage:

```bash
php artisan storage:link
```

---


# 🔐 JWT Configuration

Generate JWT secret:

```bash
php artisan jwt:secret
```

Pastikan guard API menggunakan JWT di `config/auth.php`:

```php
'defaults' => [
    'guard' => 'api',
],

'guards' => [
    'api' => [
        'driver' => 'jwt',
        'provider' => 'users',
    ],
],
```

---

# 🌐 CORS Setup (Jika Frontend Terpisah)

Buat file `config/cors.php` jika belum ada:

```php
return [
    'paths' => ['api/*'],
    'allowed_methods' => ['*'],
    'allowed_origins' => ['*'],
    'allowed_headers' => ['*'],
];
```

---

# ▶️ Run Application

```bash
php artisan serve
```

Akses aplikasi di:

```
http://127.0.0.1:8000
```

---

# 🔑 Authentication

Gunakan JWT Token untuk setiap request ke endpoint yang dilindungi:

```
Authorization: Bearer {token}
```

---

# ⚠️ Notes

* Endpoint API berada di `/api/*`
* Authentication menggunakan JWT (tanpa session)
* Pastikan token dikirim di header saat mengakses route protected

---
