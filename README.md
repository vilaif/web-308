<<<<<<< HEAD
# 🛒 Sistem Informasi Penjualan Pakaian Online — Toko 308 Abslt Unscared

## 📋 Deskripsi
Proyek ini adalah **sistem informasi penjualan pakaian online berbasis web** yang dibangun untuk membantu pengelolaan produk, transaksi, dan laporan penjualan di toko **308 Abslt Unscared**. Sistem ini bertujuan untuk mempermudah proses penjualan tanpa biaya layanan pihak ketiga seperti marketplace.

## 🛠️ Teknologi yang Digunakan
- **HTML, CSS, JavaScript** → Untuk tampilan antarmuka pengguna.
- **PHP** → Bahasa pemrograman utama.
- **CodeIgniter 4** → Framework PHP untuk manajemen MVC.
- **MySQL** → Sebagai basis data.
- **Bootstrap** → Framework CSS untuk responsivitas.

## 📂 Struktur Direktori Utama
```
/app          -> Folder aplikasi (controller, models, views)
/public       -> Folder aset publik (CSS, JS, gambar)
/writable     -> Folder untuk cache, logs, uploads
/system       -> Core dari framework CodeIgniter 4
.env          -> Konfigurasi environment (database dsb)
composer.json -> Dependency management
```

## ⚙️ Instalasi & Konfigurasi
1. Clone repository:
   ```bash
   git clone https://github.com/namaakun/nama-repo.git
   ```
2. Jalankan composer install:
   ```bash
   composer install
   ```
3. Salin file **env**:
   ```bash
   cp env .env
   ```
4. Atur koneksi database di file `.env`:
   ```
   database.default.hostname = localhost
   database.default.database = nama_database
   database.default.username = root
   database.default.password =
   database.default.DBDriver = MySQLi
   ```
5. Jalankan migrasi database:
   ```bash
   php spark migrate
   ```
6. Jalankan project:
   ```bash
   php spark serve
   ```
7. Akses di browser:
   ```
   http://localhost:8080
   ```

## 📦 Fitur Utama
- ✅ Halaman Produk & Katalog
- ✅ Manajemen Stok Produk
- ✅ Keranjang Belanja
- ✅ Checkout & Konfirmasi Pembayaran
- ✅ Riwayat Transaksi Pelanggan
- ✅ Dashboard Admin (produk, kategori, transaksi, laporan)
- ✅ Cetak Invoice Transaksi
- ✅ Laporan Penjualan

## 👨‍💼 Role Pengguna
- **Admin** → Kelola produk, kategori, transaksi, laporan.
- **Pelanggan** → Melihat produk, memesan, cek riwayat transaksi.

## 📝 Author
- Avila Difa Adhiguna  
  Sistem Informasi - Universitas Amikom Yogyakarta  
  Tahun 2025

## 📄 Lisensi
Proyek ini dibuat untuk keperluan skripsi & pengembangan sistem internal. Tidak untuk dikomersilkan tanpa izin.
# web-308
Web E-commerce for 308 Absolute Unscared
>>>>>>> af98b1743c45fbbb893c59a15cbb07f509009fdb
