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

**Dibuat oleh [Ferdy Salsabilla](https://github.com/ferdy-s)**  

Sistem Informasi Inventory Gudang berbasis web adalah aplikasi yang digunakan untuk mengelola persediaan barang di gudang secara efisien dan terstruktur.  
Sistem ini mempermudah proses administrasi, pencatatan, serta pelaporan stok barang secara real-time melalui antarmuka web yang responsif.


## Fitur Utama

### Data Master
- Data Barang  
- Jenis Barang  
- Satuan  
- Perusahaan  
  - Customer  
  - Supplier  

### Transaksi
- Barang Masuk  
- Barang Keluar  

### Laporan
- Laporan Stok (Print)  
- Laporan Barang Masuk (Print)  
- Laporan Barang Keluar (Print)  

### Manajemen Pengguna
- Data User  
- Hak Akses (Role)  
- Activity Log  
- Ubah Password  


## Teknologi yang Digunakan

Proyek ini dibangun menggunakan kombinasi teknologi berikut:

| Teknologi | Deskripsi |
|------------|------------|
| **Laravel** | Framework PHP untuk pengembangan web modern |
| **JavaScript** | Bahasa pemrograman utama untuk interaktivitas frontend |
| **jQuery** | Library JS untuk manipulasi DOM dan AJAX |
| **Bootstrap** | Framework CSS untuk tampilan yang responsif dan mobile-first |


## Cara Instalasi

### Clone Repository
```bash
git clone https://github.com/ferdy-s/inventorygudang.git
Masuk ke direktori proyek:

bash
Copy code
cd inventorygudang
Install Dependencies
bash
Copy code
composer install
npm install
Buat Database
Buat database baru dengan nama:

nginx
Copy code
inventorygudang
Konfigurasi File .env
Ubah nama file:

bash
Copy code
.env.example ➜ .env
Kemudian sesuaikan konfigurasi database:

env
Copy code
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inventorygudang
DB_USERNAME=root
DB_PASSWORD=
Lalu generate application key:

bash
Copy code
php artisan key:generate
Migrasi dan Seeder Database
Jalankan migrasi untuk membuat tabel:

bash
Copy code
php artisan migrate
Atau jika ingin mengatur ulang database dan menambahkan data contoh:

bash
Copy code
php artisan migrate:fresh --seed
Jalankan Server Lokal
Jalankan perintah berikut untuk menyalakan server:

bash
Copy code
php artisan serve
Akses aplikasi melalui browser:

cpp
Copy code
http://127.0.0.1:8000
Atau:

arduino
Copy code
http://localhost:8000
kun Login Default (Seeder)
```

Jika kamu menjalankan php artisan migrate:fresh --seed, maka akun default akan otomatis dibuat:

Role	Email	Password
Admin	ferdysalsabilla87@gmail.com	ferdysal123

<img width="2879" height="1672" alt="Screenshot 2025-11-10 114108" src="https://github.com/user-attachments/assets/670c37ca-d016-4a7f-a386-6bf518db1809" />
<img width="2868" height="1671" alt="image" src="https://github.com/user-attachments/assets/d5981368-3a46-4789-8891-2fb95c54d900" />
<img width="2872" height="1667" alt="image" src="https://github.com/user-attachments/assets/17f30176-f753-4953-ae4f-8df9fa2aa93c" />
<img width="2870" height="1663" alt="image" src="https://github.com/user-attachments/assets/168283b0-5b65-4b1c-8991-8ab2edbc610b" />
<img width="2867" height="1672" alt="image" src="https://github.com/user-attachments/assets/15dca3eb-1361-4dac-a930-a24a90a5d058" />
<img width="2737" height="1660" alt="image" src="https://github.com/user-attachments/assets/7716b67c-51e6-45de-a47d-54302349d019" />
<img width="2868" height="1666" alt="image" src="https://github.com/user-attachments/assets/6fc960fc-d11d-4ec9-97c7-5fb70aacae33" />
<img width="2873" height="1665" alt="image" src="https://github.com/user-attachments/assets/0e3f6e24-8475-493e-8e76-f52f6af4f484" />
<img width="1393" height="1587" alt="image" src="https://github.com/user-attachments/assets/27b38ffd-f4eb-4b2b-965d-abcc29b85e69" />
<img width="2870" height="1668" alt="image" src="https://github.com/user-attachments/assets/901a8cac-2cd1-40a0-a331-547976fe3928" />
<img width="2871" height="1665" alt="image" src="https://github.com/user-attachments/assets/6f6ca221-1eb2-4c6d-8ff5-40f3e3f09fd5" />
<img width="2871" height="1667" alt="image" src="https://github.com/user-attachments/assets/5c69fcce-a120-4c8e-a3d3-077e0cd6a6e9" />
<img width="2873" height="1672" alt="image" src="https://github.com/user-attachments/assets/449e8a6b-f1ec-4e70-9592-96f468004c49" />




