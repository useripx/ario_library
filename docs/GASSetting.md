# Panduan Setting Google Apps Script (GAS) Auto-Sync Ario Library

Hai! Berikut adalah tutorial step-by-step lengkap yang bisa kamu ikuti untuk mengatur Bot Sinkronisasi Otomatis dari Google Drive ke Ario Library kamu. Tenang saja, tutorial ini dibuat sejelas mungkin supaya gampang diikuti. 

## 📝 Persiapan Awal
1. Buka browser dan login ke akun Google (Google Drive) tempat kamu akan menyimpan file-file PDF buku perpustakaan.
2. Buat satu **Folder Utama (Root Folder)** di Google Drive kamu, misal beri nama `Ario Library E-Books`.
3. Buka folder tersebut, lalu perhatikan URL di bagian atas browser kamu. URL-nya akan terlihat seperti ini:
   `https://drive.google.com/drive/folders/1S08dlu_Aee-j6OVrZafGk3elhXc6WqP_`
   Copy kombinasi huruf dan angka acak di paling belakang (`1S08dlu_Aee-j6OVrZafGk3elhXc6WqP_`). Itu adalah **Folder ID** kamu. Simpan ID ini, kita akan butuhkan nanti.

## 🚀 Langkah 1: Membuat Project Google Apps Script
1. Buka [Google Apps Script Dashboard](https://script.google.com/) di tab baru.
2. Klik tombol **New Project** (Project Baru) di kiri atas.
3. Di kiri atas, klik tulisan "Untitled project" dan ganti namanya menjadi `Ario Library Auto-Sync`.

## 💻 Langkah 2: Memasukkan Kode Skrip
1. Kamu akan melihat editor kode dengan tulisan `function myFunction() { ... }`. Hapus semua kode tersebut!
2. Salin (*copy*) kode di bawah ini, dan tempel (*paste*) ke dalam editor GAS kamu:

```javascript
// Ganti ID di bawah dengan Folder ID yang kamu dapatkan dari Langkah Persiapan!
const ROOT_FOLDER_ID = 'MASUKKAN_FOLDER_ID_KAMU_DISINI'; 

// URL Webhook Ngrok kamu (tidak perlu diubah lagi jika ngrok jalan terus)
const WEBHOOK_URL = 'https://yam-charter-rimless.ngrok-free.dev/api/bot_sync';
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
    
      // Cek memori internal GAS agar tidak kirim data yang sama berulang kali
      if (!scriptProperties.getProperty(fileId)) {
        let fileName = file.getName().replace('.pdf', ''); 
      
        payloadData.push({
          kategori: folderName,
          judul: fileName,
          file_id: fileId
        });
      
        // Simpan File ID ke memori (tandai sudah terkirim)
        scriptProperties.setProperty(fileId, 'sent');
      }
    }
  }

  // Jika ada file baru, kirim ke Ario Library via Ngrok!
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
      Logger.log(payloadData.length + " data buku berhasil dikirim ke Webhook Ario Library.");
    } catch (e) {
      Logger.log("Yah, gagal konek ke Ngrok/Ario Library: " + e.toString());
    }
  } else {
    Logger.log("Pengecekan selesai. Belum ada PDF buku baru.");
  }
}
```

3. Pada baris ke-2 kode di atas, **jangan lupa** ganti `MASUKKAN_FOLDER_ID_KAMU_DISINI` dengan Folder ID Google Drive kamu tadi!
4. Klik tombol **Save** (ikon disket) atau tekan `Ctrl + S`.

## 🔒 Langkah 3: Memberikan Izin Akses (Authorization)
1. Di menu atas editor GAS, pastikan fungsi yang terpilih di dropdown adalah `scanLibrary`.
2. Klik tombol **Run** (Jalankan).
3. Karena ini pertama kali, Google akan memunculkan popup "Authorization Required" (Memerlukan Otorisasi). Klik **Review permissions**.
4. Pilih akun Google kamu.
5. Akan muncul peringatan "Google hasn't verified this app" (Google belum memverifikasi aplikasi ini). Tenang, ini aman karena kode kamu buat sendiri. Klik teks **Advanced** (Lanjutan) di kiri bawah, lalu klik **Go to Ario Library Auto-Sync (unsafe)**.
6. Scroll ke bawah dan klik **Allow** (Izinkan).

## ⏱️ Langkah 4: Mengatur Trigger Otomatis 5 Menit
Kita ingin skrip ini berjalan otomatis tanpa perlu kita klik terus. 

1. Di menu sebelah kiri layar GAS, klik ikon jam yang bernama **Triggers** (Pemicu).
2. Klik tombol **Add Trigger** (Tambahkan pemicu) berwarna biru di kanan bawah layar.
3. Atur pengaturannya agar persis seperti ini:
   - **Choose which function to run:** `scanLibrary`
   - **Choose which deployment should run:** `Head`
   - **Select event source:** `Time-driven` (Berdasarkan waktu)
   - **Select type of time based trigger:** `Minutes timer` (Timer menit)
   - **Select minute interval:** `Every 5 minutes` (Setiap 5 menit)
4. Klik **Save**. (Jika diminta izin lagi, ulangi langkah otorisasi seperti di atas).

## 🎉 Selamat! Bot Sinkronisasi Sudah Aktif!

### Cara Mengujinya:
1. Pastikan **Laragon** kamu sedang menyala (Apache & MySQL jalan).
2. Pastikan **Ngrok** kamu sedang menyala dan alamat forwardingnya adalah `https://yam-charter-rimless.ngrok-free.dev`.
3. Buka "Ario Library E-Books" di Google Drive kamu. 
4. Buat sub-folder baru, misal "Buku Pemrograman".
5. Upload satu file PDF ke dalam folder "Buku Pemrograman".
6. Tunggu maksimal 5 menit (atau kamu bisa langsung klik tombol `Run` di editor GAS untuk mempercepat).
7. Cek *database* MySQL lokal kamu di tabel `books` dan `categories`. Harusnya buku baru kamu sudah otomatis masuk dan siap digunakan di web Ario Library!
