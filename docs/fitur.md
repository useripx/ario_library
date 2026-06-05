# Fitur Ario Library

Berikut adalah dokumentasi lengkap dari fitur-fitur yang telah diimplementasikan pada sistem perpustakaan digital **Ario Library** (berbasis PHP Native MVC).

## 👥 Fitur Pengguna / Anggota (Front-End)

1.  **Autentikasi Pengguna**
    *   Pendaftaran akun anggota baru (Register).
    *   Login anggota menggunakan *username* atau *email*.
    *   Logout.

2.  **Katalog Buku (OPAC)**
    *   Menampilkan daftar seluruh koleksi buku yang tersedia.
    *   Fitur **Live Search** untuk mencari buku berdasarkan judul, nama penulis, atau nama kategori secara *real-time*.
    *   Halaman detail buku yang menampilkan informasi lengkap (sinopsis, penulis, penerbit, stok, dsb).

3.  **Peminjaman Buku**
    *   Fitur peminjaman buku dengan satu klik dari halaman detail buku atau katalog.
    *   Sistem validasi:
        *   Maksimal meminjam **3 buku** dalam satu waktu (belum dikembalikan).
        *   Validasi stok buku (tidak bisa meminjam jika stok habis).
        *   Validasi agar tidak meminjam buku yang sama dua kali secara bersamaan.
    *   Otomatis menetapkan batas waktu pengembalian (Jatuh Tempo) selama **7 hari** dari tanggal peminjaman.

4.  **Manajemen Pinjaman (Rak Pinjaman Saya)**
    *   Melihat daftar buku yang sedang dipinjam, riwayat buku yang sudah dikembalikan, dan buku yang berstatus terlambat (lewat jatuh tempo).
    *   **Fitur Membaca (PDF Reader):** Membaca buku secara langsung di website melalui *interactive reader* yang terintegrasi dengan tautan *Google Drive preview*. Terdapat *overlay* pengaman untuk mencegah *download* langsung (jika di-set mode aman).
    *   **Perpanjangan Buku (Renew):** Anggota dapat memperpanjang masa pinjam secara online selama 7 hari tambahan, dengan batas maksimal perpanjangan sebanyak **3 kali**.
    *   **Pengembalian Mandiri:** Anggota dapat mengklik tombol pengembalian buku jika sudah selesai membaca.

5.  **Koleksi Favorit (Wishlist)**
    *   Menyimpan buku-buku yang diinginkan ke dalam daftar *wishlist*.
    *   Menghapus buku dari daftar *wishlist*.

6.  **Layanan Pelanggan (Customer Service / Masukan)**
    *   Anggota dapat mengirimkan pesan, pertanyaan, atau masukan (dengan subjek dan isi pesan).
    *   Anggota dapat melihat riwayat pesan dan membaca balasan dari pihak admin perpustakaan.

7.  **Profil Anggota**
    *   Melihat ringkasan statistik pribadi (jumlah buku yang pernah dipinjam, jumlah buku terlambat).
    *   Mengubah informasi akun (*username* dan *email*).
    *   Mengubah kata sandi (*password*).

---

## 🛡️ Fitur Administrator (Back-End)

1.  **Autentikasi Admin**
    *   Login khusus Admin.
    *   Hak akses berlapis (Multi-level): **Super Admin** dan **Admin Cabang** (*Branch Admin*).

2.  **Dasbor Analitik (Dashboard)**
    *   Menampilkan statistik ringkas perpustakaan: Total Buku, Total Anggota, Total Buku Sedang Dipinjam, dan Total Admin.

3.  **Manajemen Master Data (Inventaris)**
    *   **Kategori (CRUD):** Tambah, lihat, ubah, dan hapus kategori buku.
    *   **Penulis (CRUD):** Tambah, lihat, ubah, dan hapus nama penulis buku.
    *   **Penerbit (CRUD):** Tambah, lihat, ubah, dan hapus nama penerbit buku.

4.  **Manajemen Koleksi Buku**
    *   CRUD lengkap untuk koleksi buku.
    *   Menyimpan tautan (link) Google Drive PDF buku.
    *   Manajemen stok (stok otomatis berkurang saat buku dipinjam, dan bertambah saat dikembalikan).
    *   Data relasional ke Penulis, Kategori, dan Penerbit.

5.  **Manajemen Sirkulasi (Peminjaman)**
    *   Melihat seluruh riwayat dan status transaksi peminjaman oleh anggota (Sedang Dipinjam, Sudah Kembali).
    *   Admin dapat memproses pengembalian buku (klik kembali) yang akan secara otomatis memperbarui status dan menambah stok buku.

6.  **Manajemen Anggota**
    *   Melihat daftar seluruh anggota perpustakaan.
    *   Mengubah data anggota.
    *   Menghapus akun anggota yang bermasalah.

7.  **Manajemen Layanan Masukan (CS)**
    *   Melihat seluruh pesan/masukan yang dikirim oleh anggota.
    *   Memberikan balasan (*reply*) ke pesan anggota.
    *   Menandai pesan sebagai "Sudah Dibaca".

8.  **Manajemen Staf / Admin Cabang** *(Eksklusif Super Admin)*
    *   Menambahkan akun admin cabang baru.
    *   Mengubah data admin lain.
    *   Menghapus admin cabang.
    *   *(Admin Cabang tidak dapat mengakses menu ini)*.

9.  **Profil Admin**
    *   Mengubah data *username* pribadi admin.
    *   Mengubah kata sandi (*password*) admin.

---

## ⚙️ Fitur Sistem & Teknis

*   **Penyimpanan Cloud:** Menggunakan tautan *Google Drive* untuk menyimpan *file* e-book PDF sehingga tidak membebani ruang penyimpanan *hosting* lokal.
*   **Mode Aman Reader:** Integrasi iframe Google Drive yang menggunakan *overlay* transparan di bagian kanan atas untuk menyembunyikan tombol 'pop-out/download' bawaan dari Google Drive, agar buku dibaca di dalam platform.
*   **Password Hashing:** Keamanan kata sandi bagi seluruh entitas (Admin & Member) menggunakan *algoritma hashing* bcrypt (`password_hash`).
*   **Sistem Peringatan (Flasher):** Notifikasi *pop-up* alert (berhasil/gagal) pada aksi-aksi tertentu.
*   **Database Relasional:** Menggunakan skema basis data MySQL dengan *Foreign Key* constraints untuk menjaga konsistensi data antara Buku, Kategori, Penulis, Peminjaman, dll.
