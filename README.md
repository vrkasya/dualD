# Aplikasi Web Manajemen Acara Kampus

Ini adalah aplikasi web sederhana untuk organisasi kampus untuk mengelola acara seperti seminar, lokakarya, dan kompetisi.

## Fitur

- Halaman beranda dengan daftar acara yang akan datang
- Registrasi dan login pengguna
- Formulir pendaftaran acara untuk peserta
- Dasbor admin untuk operasi CRUD pada acara
- Penyimpanan data menggunakan MySQL
- Pemberitahuan keberhasilan setelah pendaftaran
- Struktur folder modular yang cocok untuk XAMPP dan GitHub

## Struktur Proyek

```
nama-proyek/
├── index.php
├── assets/
│ ├── css/
│ ├── js/
│ └── img/
├── includes/
├── pages/
├── admin/
├── actions/
├── config/
└── database/
```

Petunjuk Penyiapan ## Petunjuk Penyiapan

1. Impor skema basis data dari `database/init.sql` ke dalam server MySQL Anda.
2. Konfigurasikan koneksi basis data Anda di `config/db.php`.
3. Letakkan folder proyek di dalam direktori `htdocs` XAMPP Anda.
4. Mulai layanan Apache dan MySQL di XAMPP.
5. Akses aplikasi melalui `http://localhost/project-name/index.php`.

## Catatan

- Proyek ini ditujukan untuk tujuan pendidikan.
- Kata sandi di-hash menggunakan fungsi `password_hash` PHP.
- Otentikasi admin merupakan dasar dan dapat diperluas.

## Lisensi

Lisensi MIT
