# Implementasi Sinkronisasi Otomatis Google Drive

Implementasi ini bertujuan untuk membuat sistem perpustakaan digital Ario Library dapat tersinkronisasi secara otomatis dengan folder Google Drive. Setiap file PDF baru yang diunggah ke Google Drive akan otomatis dicatat sebagai draft buku di website menggunakan Google Apps Script (GAS) dan Webhook API.

## User Review Required

> [!IMPORTANT]
> Mohon periksa penyesuaian skema database berikut. Karena database Ario Library menggunakan nama tabel bahasa Inggris (`categories`, `books`), kode dari dokumen `Ario Lib.md` telah disesuaikan dengan struktur asli aplikasi Anda (MVC Native).

## Open Questions

> [!WARNING]
>
> 1. Apakah Anda ingin langsung mengeksekusi script SQL untuk menambahkan kolom baru ke database lokal (MySQL Laragon) Anda sekarang? Ataukah cukup saya perbarui di file `db/setup.sql` saja?
> 2. Untuk URL Webhook di Google Apps Script (GAS), Anda akan membutuhkan Ngrok untuk _forwarding_ (misal: `https://abcd.ngrok.app/ario_library/public/api/bot_sync`). Apakah Anda sudah familiar dengan penggunaan Ngrok di komputer lokal Anda?

# Open Question Answare

1. Ya langsunmg eksekusi
2. apa ini maksud anda https://yam-charter-rimless.ngrok-free.dev -> http://ario_library.test:80

## Proposed Changes

### Database Updates

Pembaruan skema database untuk mencegah duplikasi:

#### [MODIFY] [setup.sql](file:///c:/laragon/www/ario_library/db/setup.sql)

- Menambahkan constraint `UNIQUE` pada kolom `name` di tabel `categories`.
- Menambahkan kolom `drive_file_id VARCHAR(255) UNIQUE` di tabel `books`.
- Menambahkan kolom `status_entri ENUM('draft', 'published') DEFAULT 'draft'` di tabel `books`.

### Webhook API (Backend MVC)

#### [NEW] [Api.php](file:///c:/laragon/www/ario_library/app/controllers/Api.php)

- Membuat Controller baru bernama `Api.php`.
- Menambahkan method `bot_sync()` untuk memproses *request* POST JSON dari Google Apps Script.
- Verifikasi keamanan menggunakan bearer token `ARIO_SECRET_TOKEN_2026`.

#### [NEW] [Api_model.php](file:///c:/laragon/www/ario_library/app/models/Api_model.php)

- Membuat Model `Api_model.php` untuk menangani *query* spesifik API sinkronisasi.
- Method `insertCategoryIfNotExists($name)`: Melakukan _Insert_ kategori ke tabel `categories` jika belum ada, dan mengembalikan ID-nya.
- Method `insertBookDraft($title, $categoryId, $driveFileId)`: Melakukan _Insert_ buku ke tabel `books` dengan `status_entri = 'draft'`. Menyimpan URL PDF secara otomatis dari ID Drive yang diterima.

### Dokumentasi & Tutorial

#### [NEW] [GASSetting.md](file:///c:/laragon/www/ario_library/GASSetting.md)

- Membuat panduan instalasi _step-by-step_ lengkap (seperti tutorial untuk Junior Dev) untuk mengatur skrip Google Apps Script, _Trigger_ otomatis 5 menit, dan cara menghubungkannya dengan Webhook Ario Library.

## Verification Plan

### Langkah Pengujian

1. Saya akan menerapkan penambahan Controller dan Model untuk API.
2. Saya akan memperbarui file `setup.sql` atau langsung mengeksekusinya ke DB Anda (jika disetujui).
3. Anda akan dapat mengikuti tutorial di `GASSetting.md` untuk memasang skrip GAS di akun Google Drive perpustakaan.
4. Anda akan menyalakan Ngrok dan memasukkan link *forwarding* ke GAS.
5. Anda dapat menguji dengan menambahkan satu buku PDF ke dalam folder Google Drive, lalu menjalankan *scanLibrary* secara manual di GAS. Jika berhasil, buku akan otomatis masuk ke tabel `books` di database Ario Library dengan status "draft".
