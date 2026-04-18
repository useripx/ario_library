# Request

1. Saya ingin anda sesuaikan template website html ini menjadi Ario library berbasiskan php native (MVC) yang dimana akan menjadi website perpustakaan bernama Ario Library.
2. dimana saya bisa melakukan CRUD ke database untuk update buku dll
3. untuk buku biasanya berupa pdf nah karena keterbatasan penyimpanan di hosting maka untuk buku akan di simpan di google drive dan di hosting hanya akan menyimpan link downloadnya saja
4. untuk admin akan ada 2 yaitu admin utama dan admin cabang
5. untuk admin utama bisa melakukan CRUD ke database dan bisa mengelola admin cabang
6. untuk admin cabang hanya bisa melakukan CRUD ke database untuk update buku dll
7. untuk user bisa login dan bisa meminjam buku
8. buatkan layanan membaca yang interkatif di website setelah user meminjam
9. ketersediaan buku akan diupdate oleh admin cabang dan admin utama

# Request 2

Website perpustakaan pada umumnya memiliki berbagai fitur yang dirancang untuk melayani dua jenis pengguna utama: **Anggota/Pengunjung** (Front-end) dan **Admin/Pustakawan** (Back-end). 

Berikut adalah daftar fitur standar yang biasanya ada pada website perpustakaan:

### 1. Fitur untuk Pengunjung dan Anggota (Front-end)

Fitur ini berfokus pada kemudahan pengguna dalam mencari informasi dan mengelola aktivitas peminjaman mereka.

* **Pencarian dan Katalog (OPAC - Online Public Access Catalog):** Fitur utama untuk mencari buku atau literatur. Pengunjung dapat memfilter pencarian berdasarkan judul, penulis, penerbit, tahun terbit, ISBN, atau kategori/subjek.
* **Detail Buku:** Menampilkan informasi lengkap mengenai sebuah buku, termasuk sinopsis, ketersediaan fisik (status dipinjam atau tersedia), lokasi rak, dan ulasan.
* **Pendaftaran Anggota Online:** Formulir untuk mendaftar menjadi anggota perpustakaan secara digital sebelum verifikasi langsung (jika diperlukan).
* **Dasbor Anggota (Member Area):** Area khusus untuk anggota yang sudah login. Fitur di dalamnya meliputi:
    * **Riwayat Peminjaman:** Daftar buku yang sedang dan pernah dipinjam.
    * **Status Jatuh Tempo:** Informasi batas waktu pengembalian buku.
    * **Koleksi Favorit (Wishlist):** Menyimpan buku yang ingin dipinjam di masa mendatang.
* **Pemesanan Buku (Booking/Hold):** Memungkinkan anggota untuk "memesan" atau antre untuk buku yang saat ini sedang dipinjam oleh orang lain.
* **Perpanjangan Online (Renewal):** Fitur untuk memperpanjang masa pinjam buku tanpa harus datang ke perpustakaan (biasanya memiliki batasan kuota perpanjangan).
* **Koleksi Digital:** Akses untuk membaca atau mengunduh *e-book*, jurnal, artikel, atau repositori karya ilmiah secara langsung melalui website.
* **Halaman Informasi Umum:** Berisi jadwal operasional perpustakaan, aturan dan tata tertib, berita/pengumuman, kontak, dan lokasi (peta).


### 2. Fitur untuk Admin dan Pustakawan (Back-end)

Fitur ini berfokus pada manajemen sistem, inventaris, dan kelancaran operasional perpustakaan.

* **Manajemen Sirkulasi:** Sistem untuk mencatat proses peminjaman (Check-out) dan pengembalian buku (Check-in) secara real-time, sering kali terintegrasi dengan pemindai barcode.
* **Manajemen Inventaris/Katalog:** Fitur (CRUD) untuk menambah buku baru, mengedit data buku lama, mencetak label/barcode buku, dan menghapus atau menonaktifkan buku yang rusak/hilang.
* **Manajemen Anggota:** Digunakan untuk memverifikasi pendaftaran baru, mengedit data anggota, melihat riwayat peminjaman tiap anggota, atau memblokir kartu anggota yang bermasalah.
* **Manajemen Denda:** Sistem yang secara otomatis menghitung denda keterlambatan berdasarkan tarif harian yang ditentukan, serta fitur pencatatan pembayaran denda.
* **Laporan dan Statistik:** Fitur untuk menghasilkan laporan berkala (harian/bulanan/tahunan). Contohnya: statistik buku paling sering dipinjam, jumlah pengunjung, total denda yang terkumpul, dan laporan buku hilang.
* **Manajemen Konten (CMS):** Fitur untuk memperbarui informasi di halaman depan website, seperti menambahkan banner promosi acara perpustakaan atau menulis berita terbaru.

# Request 3
sekarang fitur denda adalah unik buat agar telat mengembalikan akan ada peringatan pop up modern bertuliskan "Buku yang Anda pinjam telah habis masa pinjaman, untuk meminjam lagi silahkan klik perpanjang jika perpanjang habis silahkan hibingi admin di wa.me/081358113087