Baca Panduan berikut adalah panduan teknis implementasi fitur sinkronisasi otomatis menggunakan integrasi Google Apps Script (GAS) dan Webhook PHP Native MVC.

> [!important] PENTING
> Jika ada kode yang kurang sesuai silahkan sesuaikan ya, ini gambaran kasar saya, anda yang ngerjakan silahkan eksekusi jika ada kurang atau salahnya kode saya tolong diperbaiki.

````
# 🤖 Implementation Plan: Bot Auto-Sync Google Drive ke Ario Library

## 🎯 Tujuan Implementasi (Objectives)
Sistem sinkronisasi otomatis (Auto-Sync Bot) ini dibangun dengan tujuan utama sebagai berikut:
1. **Otomatisasi Entri Data (Efisiensi):** Meringankan tugas admin dengan mengotomatisasi pendaftaran e-book baru. Setiap file PDF yang diunggah ke Google Drive akan otomatis dicatat ke dalam *database* web sebagai *draft* (admin hanya tinggal melengkapi ISBN atau data pelengkap lainnya nanti).
2. **Manajemen Kategori Dinamis:** Membaca nama folder di Google Drive untuk secara otomatis membuat master data kategori rak buku di sistem web.
3. **Pencegahan Duplikasi Secara Absolut:** Memastikan skrip otomatis yang berjalan setiap 5 menit tidak menginput buku atau kategori yang sama berkali-kali (Jika Folder/Kategori dihapus maka di web juga ikut terhapus). Hal ini dijamin melalui kombinasi *cache* di Google Apps Script dan validasi `UNIQUE constraint` di MySQL.
4. **Optimalisasi Penyimpanan Server:** Menggunakan Google Drive sebagai *Cloud Storage* utama untuk *file* PDF yang berat, sehingga penyimpanan *hosting* (Laragon/CWP) tetap ringan dan buku dapat diakses pengguna melalui *iframe reader*.

---

## 🗺️ 1. Alur Sistem (Workflow)

Berikut adalah diagram sekuensial yang menggambarkan interaksi antara Google Apps Script, Google Drive, Ngrok, dan sistem PHP Native Anda setiap 5 menit sekali.

```mermaid
sequenceDiagram
    autonumber
    participant Timer as Trigger (Setiap 5 Menit)
    participant GAS as Google Apps Script
    participant GDrive as Google Drive (Root Folder)
    participant Ngrok as Ngrok Tunnel (Lokal)
    participant PHP as Webhook PHP Native
    participant DB as MySQL Database

    Timer->>GAS: Jalankan fungsi scanLibrary()
    GAS->>GDrive: Akses Root Folder ID
    GDrive-->>GAS: Detail Folder

    loop Setiap Subfolder
        GAS->>GDrive: Ambil Nama Folder (Sbg Kategori) & Daftar File PDF
        GDrive-->>GAS: Data Kategori & File PDF
  
        GAS->>GAS: Cek internal cache (PropertiesService)
        alt Jika File ID belum pernah dikirim
            GAS->>GAS: Tambahkan ke antrean Payload (JSON)
            GAS->>GAS: Simpan File ID ke cache (Tandai 'Terkirim')
        else Jika File ID sudah pernah dikirim
            GAS->>GAS: Abaikan (Skip)
        end
    end

    alt Jika Antrean Payload memiliki data
        GAS->>Ngrok: HTTP POST JSON + Header Authorization Token
        Ngrok->>PHP: Teruskan request ke localhost (Laragon)
        PHP->>PHP: Verifikasi Token Keamanan
  
        loop Setiap Item Buku dalam JSON
            PHP->>DB: INSERT IGNORE ke tabel 'kategori'
            PHP->>DB: Ambil 'id_kategori'
            DB-->>PHP: Kembalikan ID
            PHP->>DB: INSERT IGNORE ke tabel 'buku' (Validasi drive_file_id unik)
        end
        PHP-->>Ngrok: HTTP 200 OK (Status Success)
        Ngrok-->>GAS: Selesai
    else Jika Antrean Payload kosong
        GAS->>GAS: Log "Tidak ada buku baru ditemukan"
    end
````

## 🗄️ 2. Fase 1: Pembaruan Skema Database (MySQL)

Pembaruan tabel ini adalah benteng pertahanan utama untuk mencegah duplikasi data di sisi _backend_.

1. **Tabel `kategori`**:

   - Pastikan kolom nama kategori memiliki _constraint_ `UNIQUE`.

   SQL

   ```
   ALTER TABLE kategori ADD UNIQUE (nama_kategori);
   ```
2. **Tabel `buku`**:

   - Tambahkan kolom `drive_file_id` dan setel sebagai `UNIQUE`.
   - Tambahkan kolom status untuk membedakan buku hasil _scrape_ bot dan buku yang sudah siap rilis.

   SQL

   ```
   ALTER TABLE buku ADD COLUMN drive_file_id VARCHAR(255) UNIQUE;
   ALTER TABLE buku ADD COLUMN status_entri ENUM('draft', 'published') DEFAULT 'draft';
   ```

## 💻 3. Fase 2: Pembuatan Endpoint Webhook (PHP Native MVC)

Buat _file_ baru di direktori MVC Anda (misalnya di `api/bot_sync.php`). Skrip ini bertugas menerima data dari GAS secara otomatis.

PHP

```
<?php
// File: api/bot_sync.php

// 1. Verifikasi Token Keamanan
$headers = apache_request_headers();
$secret_token = "ARIO_SECRET_TOKEN_2026"; 

if (!isset($headers['Authorization']) || $headers['Authorization'] !== 'Bearer ' . $secret_token) {
    http_response_code(403);
    die(json_encode(["status" => "error", "message" => "Akses Ditolak! Token tidak valid."]));
}

// 2. Tangkap Payload JSON dari GAS
$input = file_get_contents("php://input");
$data = json_decode($input, true);

if (empty($data)) {
    die(json_encode(["status" => "error", "message" => "Data payload kosong."]));
}

// 3. Koneksi database
$conn = new mysqli("localhost", "root", "", "nama_database_perpustakaan");

$total_masuk = 0;

// 4. Looping data yang dikirim oleh GAS
foreach ($data as $item) {
    $kategori = $conn->real_escape_string($item['kategori']);
    $judul = $conn->real_escape_string($item['judul']);
    $file_id = $conn->real_escape_string($item['file_id']);

    // Insert kategori jika belum ada
    $conn->query("INSERT IGNORE INTO kategori (nama_kategori) VALUES ('$kategori')");

    // Ambil ID kategori
    $resKat = $conn->query("SELECT id_kategori FROM kategori WHERE nama_kategori = '$kategori'");
    $rowKat = $resKat->fetch_assoc();
    $id_kategori = $rowKat['id_kategori'];

    // Insert buku ke dalam draft
    $sqlBuku = "INSERT IGNORE INTO buku (judul_buku, id_kategori, drive_file_id, status_entri)
                VALUES ('$judul', '$id_kategori', '$file_id', 'draft')";
  
    if ($conn->query($sqlBuku) && $conn->affected_rows > 0) {
        $total_masuk++;
    }
}

echo json_encode(["status" => "success", "buku_baru_ditambahkan" => $total_masuk]);
?>
```

## 🚀 4. Fase 3: Skrip Google Apps Script (GAS)

1. Buka [script.google.com](https://script.google.com/) dan buat proyek baru.
2. Salin kode di bawah ini. Ganti `WEBHOOK_URL` dengan URL hijau dari Ngrok Anda.

JavaScript

```
const ROOT_FOLDER_ID = '1S08dlu_Aee-j6OVrZafGk3elhXc6WqP_'; 
const WEBHOOK_URL = 'https://URL_NGROK_ANDA_DI_SINI/api/bot_sync.php';
const SECRET_TOKEN = 'ARIO_SECRET_TOKEN_2026';

function scanLibrary() {
  const rootFolder = DriveApp.getFolderById(ROOT_FOLDER_ID);
  const subFolders = rootFolder.getFolders();
  const scriptProperties = PropertiesService.getScriptProperties();
  
  let payloadData = [];

  // Looping Kategori
  while (subFolders.hasNext()) {
    let folder = subFolders.next();
    let folderName = folder.getName();
    let files = folder.getFilesByType(MimeType.PDF);

    // Looping Buku (PDF)
    while (files.hasNext()) {
      let file = files.next();
      let fileId = file.getId();
    
      // Filter Lapis Pertama: Cek memori internal GAS
      if (!scriptProperties.getProperty(fileId)) {
        let fileName = file.getName().replace('.pdf', ''); 
      
        payloadData.push({
          kategori: folderName,
          judul: fileName,
          file_id: fileId
        });
      
        // Simpan File ID ke memori agar pengecekan berikutnya diabaikan
        scriptProperties.setProperty(fileId, 'sent');
      }
    }
  }

  // Jika ada buku baru, kirim POST Request
  if (payloadData.length > 0) {
    let options = {
      'method' : 'post',
      'contentType': 'application/json',
      'headers': {
        'Authorization': 'Bearer ' + SECRET_TOKEN
      },
      'payload' : JSON.stringify(payloadData)
    };
  
    try {
      UrlFetchApp.fetch(WEBHOOK_URL, options);
      Logger.log(payloadData.length + " data buku berhasil dikirim ke Webhook.");
    } catch (e) {
      Logger.log("Error koneksi ke Webhook: " + e.toString());
    }
  } else {
    Logger.log("Pengecekan selesai. Tidak ada file buku PDF baru.");
  }
}
```

## ⏱️ 5. Fase 4: Konfigurasi Trigger Otomatis (5 Menit)

1. Pada editor GAS, klik ikon **Jam Alarm (Triggers)** di menu sebelah kiri.
2. Klik **Add Trigger** (kanan bawah).
3. Atur parameter berikut:

   - **Choose which function to run:** `scanLibrary`
   - **Select event source:** `Time-driven`
   - **Select type of time based trigger:** `Minutes timer`
   - **Select minute interval:** `Every 5 minutes`
4. Klik **Save** dan izinkan _pop-up_ persetujuan akun Google.

## 🧪 6. Fase 5: Alur Pengujian Sinkronisasi Lokal

1. Pastikan **Laragon (Apache/MySQL)** menyala.
2. Pastikan **Ngrok** sedang berjalan di CMD dan meneruskan trafik ke port lokal Anda (misal: `ngrok http 80`).
3. Pastikan URL Ngrok yang aktif saat ini sudah dimasukkan ke dalam variabel `WEBHOOK_URL` di skrip GAS.
4. Buat folder baru (misal: `Buku Pemrograman`) di dalam Root Folder Google Drive Anda, lalu unggah satu _file_ PDF ke dalamnya.
5. Jalankan fungsi `scanLibrary` di GAS secara manual (klik tombol _Run_).
6. Cek MySQL lokal Anda. Kategori baru dan _file_ buku PDF tersebut harusnya sudah otomatis masuk ke dalam tabel!

```

Jika dalam proses pengerjaannya ada langkah yang dirasa rancu atau jika pertanyaan/logika teknisnya masih ambigu, boleh bertanya lagi ya, karena untuk ketepatan jawaban dan meminimalisasi *bug* nanti sangatlah penting.
```

> [!info] PERTANYAAN
>
> 1. Berikan saya Tutorial jika waktunya saya setting GAS karena saya msih bingung berikan tutorial step by step lengkapnya seperti anda mengajari junior dev simpan di root projek folder ini dengan nama GASSetting.md
