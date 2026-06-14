# Holland Bakery 

Website bakery sederhana berbasis PHP murni dengan tampilan produk, halaman daftar akun, dan halaman login.

## Halaman

| File | Deskripsi |
|---|---|
| `bakery.php` | Halaman utama hero section + daftar produk |
| `daftar.php` | Form pendaftaran akun baru dengan validasi |
| `login.php` | Form login dengan simulasi autentikasi |

## Fitur

- **Katalog produk** 6 item bakery dengan gambar, harga, dan deskripsi
- **Registrasi** validasi server-side (nama, email, telepon, password, konfirmasi)
- **Indikator kekuatan password** visual bar real-time via JavaScript
- **Login simulasi** autentikasi dengan data dummy (tanpa database)
- **Responsif** layout menyesuaikan tampilan mobile

## Cara Menjalankan

Butuh PHP 7.4+ dan web server lokal (XAMPP / Laragon / php built-in server).

```bash
# Menggunakan built-in server PHP
php -S localhost

# Buka di browser
http://localhost/bakery.php
```

## Akun Demo (Login)

```
Email    : user@hollandbakery.com
Password : roti123
```
