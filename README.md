<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<p align="center">
  <a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Sistem Informasi Inventory Gudang

**Sistem Informasi Inventory Gudang Berbasis Web** adalah aplikasi untuk mengelola persediaan barang secara terstruktur, efisien, dan real-time melalui antarmuka web.

Dikembangkan untuk membantu proses pencatatan, monitoring, dan pelaporan stok barang dalam operasional gudang.

---

## Author

Dibuat oleh: **Ferdy Salsabilla**
GitHub: https://github.com/ferdy-s

---

## Fitur Utama

### Data Master

* Data Barang
* Jenis Barang
* Satuan
* Perusahaan

  * Customer
  * Supplier

### Transaksi

* Barang Masuk
* Barang Keluar

### Laporan

* Laporan Stok (Print)
* Laporan Barang Masuk (Print)
* Laporan Barang Keluar (Print)

### Manajemen Pengguna

* Data User
* Hak Akses (Role)
* Activity Log
* Ubah Password

---

## Teknologi yang Digunakan

| Teknologi  | Deskripsi                                            |
| ---------- | ---------------------------------------------------- |
| Laravel    | Framework PHP untuk pengembangan aplikasi web modern |
| JavaScript | Interaktivitas frontend                              |
| jQuery     | Manipulasi DOM dan AJAX                              |
| Bootstrap  | UI responsif dan mobile-first                        |

---

## Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/ferdy-s/inventorygudang.git
cd inventorygudang
```

### 2. Install Dependencies

```bash
composer install
npm install
```

### 3. Konfigurasi Environment

Salin file `.env`:

```bash
cp .env.example .env
```

Edit konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inventorygudang
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generate Key

```bash
php artisan key:generate
```

### 5. Migrasi & Seeder

```bash
php artisan migrate
```

Atau jika ingin fresh install + data contoh:

```bash
php artisan migrate:fresh --seed
```

### 6. Jalankan Server

```bash
php artisan serve
```

Akses aplikasi:

```
http://127.0.0.1:8000
```

---

## Akun Default (Seeder)

Jika menjalankan:

```bash
php artisan migrate:fresh --seed
```

Gunakan akun berikut:

| Role  | Email                                                             | Password    |
| ----- | ----------------------------------------------------------------- | ----------- |
| Admin | [ferdysalsabilla87@gmail.com](mailto:ferdysalsabilla87@gmail.com) | ferdysal123 |

---

## Tampilan Aplikasi

<img width="3000" height="2000" alt="1776222460222-1_inventory_gudang" src="https://github.com/user-attachments/assets/9d3f4a05-644d-4053-9a48-db7e2daf1c24" />
<img width="2619" height="1406" alt="1776222461366-2" src="https://github.com/user-attachments/assets/ef330bc5-cc4c-45eb-bbad-cecade2b4d1e" />
<img width="1919" height="1079" alt="image" src="https://github.com/user-attachments/assets/f453ff5f-85f6-494e-b00e-4a9f64aa2532" />
<img width="1323" height="892" alt="image" src="https://github.com/user-attachments/assets/0ce1c877-6a24-4002-adf7-0e94f8ba45ac" />
<img width="1319" height="888" alt="image" src="https://github.com/user-attachments/assets/cf816f24-e36a-4dc4-9554-6b26d53f1d41" />
<img width="1919" height="1079" alt="image" src="https://github.com/user-attachments/assets/f63815e7-82dc-4278-aa90-b874325c80ba" />
<img width="1919" height="1079" alt="image" src="https://github.com/user-attachments/assets/8894a61e-54dd-45c0-b7f1-a8d713d75b40" />


---

## Catatan

* Pastikan PHP ≥ 8.x
* Gunakan MySQL / MariaDB
* Jalankan `npm run dev` jika menggunakan asset build frontend

---

## 📄 Lisensi

Proyek ini bersifat open-source dan bebas digunakan untuk pembelajaran maupun pengembangan lebih lanjut.
