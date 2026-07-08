# Backend LocalBiz

Backend REST API untuk platform digitalisasi UMKM berbasis Web & Mobile. Dibangun menggunakan Laravel dengan autentikasi token via Laravel Sanctum.

## Tech Stack

- **Framework**: Laravel 13
- **Bahasa**: PHP 8.5
- **Database**: MySQL
- **Autentikasi**: Laravel Sanctum (token-based)

## Requirements

Pastikan sudah terinstall di komputer kamu:

- PHP >= 8.3
- Composer
- MySQL
- Git

## Cara Setup Project

### 1. Clone repository

```
git clone https://github.com/Decaesario/backend-localbiz.git
cd backend-localbiz
```

### 2. Install dependencies

```
composer install
```

### 3. Konfigurasi environment

Duplikat file `.env.example` menjadi `.env`:

```
copy .env.example .env
```

Generate application key:

```
php artisan key:generate
```

### 4. Konfigurasi database

Buat database baru di MySQL, lalu sesuaikan bagian berikut di file `.env`:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=localbiz
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Jalankan migration

```
php artisan migrate
```

### 6. Jalankan server lokal

```
php artisan serve
```

Server akan berjalan di `http://127.0.0.1:8000`.

## Autentikasi (Sanctum)

Project ini menggunakan Laravel Sanctum untuk autentikasi berbasis token. Endpoint yang membutuhkan autentikasi harus menyertakan header:

```
Authorization: Bearer <token>
```

## Struktur API

Seluruh endpoint API terdaftar di `routes/api.php` dengan prefix `/api`. Response menggunakan format JSON yang konsisten.

| Fitur | Status |
| --- | --- |
| Login & Register | 🔧 In Progress |
| Manajemen Produk | 🔧 In Progress |
| Manajemen Pesanan | 🔧 In Progress |
| Dashboard Summary | 🔧 In Progress |
| Katalog & Detail Produk | 🔧 In Progress |
| Keranjang & Checkout | 🔧 In Progress |
| Riwayat Transaksi | 🔧 In Progress |

## Catatan

Project ini merupakan bagian dari Final Project "Chevalier" — Platform Digitalisasi UMKM Berbasis Web & Mobile.