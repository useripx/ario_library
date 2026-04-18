# Architecture - Ario Library (PHP Native MVC)

Proyek ini menggunakan pola arsitektur **Model-View-Controller (MVC)** yang dibangun secara native menggunakan PHP 8.4.15.

## 🏗️ Struktur Folder

- **`app/`**: Folder utama aplikasi.
  - **`core/`**: Berisi class inti (App.php, Controller.php, Database.php).
  - **`controllers/`**: Menangani logika request dan memanggil model/view.
  - **`models/`**: Menangani interaksi data dengan database (PDO).
  - **`views/`**: Berisi file UI (PHP/HTML). Memiliki subfolder `templates/` untuk komponen reusable.
- **`public/`**: Satu-satunya folder yang dapat diakses dari luar. Berisi `index.php` sebagai entry point dan asset (CSS, JS, Images).
- **`config/`**: Konfigurasi basis data dan BASEURL.
- **`db/`**: Skema database SQL dan data awal (seeds).
- **`docs/`**: Dokumentasi teknis proyek.

## 🔄 Alur Request
1. Request diarahkan ke `public/index.php` melalui `.htaccess`.
2. `App.php` melakukan parsing URL untuk menentukan Controller, Method, dan Parameter.
3. Controller memproses data (menggunakan Model jika perlu) dan memuat View yang sesuai.

## 🔐 Keamanan
- **PDO Wrapper**: Menggunakan prepared statements untuk mencegah SQL Injection.
- **Password Hashing**: Menggunakan algoritma `PASSWORD_DEFAULT`.
- **Session Auth**: Halaman admin dan member dilindungi oleh verifikasi session.

## 🖼️ Sistem Layout
Sistem layout dibagi menjadi dua kategori:
1. **Frontend Layout**: `header.php` & `footer.php` untuk halaman umum.
2. **Admin Layout**: `admin_header.php`, `admin_sidebar.php`, & `admin_footer.php` untuk panel manajemen.

---
*Terakhir diperbarui: 18 April 2026*
