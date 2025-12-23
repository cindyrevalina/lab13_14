# Aplikasi Manajemen Inventaris Barang

Aplikasi web sederhana untuk mengelola database barang menggunakan PHP dan MySQL. Versi ini telah dioptimalkan untuk tampilan yang bersih **tanpa kolom gambar** dan form yang berada di posisi **tengah (center)**.

---

## Fitur Utama
* **Form Tengah (Centered UI)**: Halaman Login, Tambah, dan Edit berada di tengah layar untuk estetika yang lebih baik.
* **CRUD Database**: Create (Tambah), Read (Tampil), Update (Ubah), dan Delete (Hapus) data barang.
* **Pencarian Data**: Filter data barang berdasarkan nama secara langsung.
* **Pagination**: Pembagian data per halaman (default: 5 data per halaman).
* **Tanpa Gambar**: Fokus pada data tekstual untuk kecepatan input.
* **Konfirmasi Hapus**: Fitur keamanan berupa pesan konfirmasi sebelum data benar-benar dihapus.

---

## Persyaratan Sistem
* **Web Server**: XAMPP (Apache & MySQL).
* **Bahasa**: PHP 7.x atau lebih baru.
* **Database**: MySQL/MariaDB.

---

## Struktur Tabel Database
Pastikan kamu memiliki database bernama `latihan_13_14` dan jalankan perintah SQL berikut:

```sql
CREATE TABLE data_barang (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    kategori VARCHAR(50),
    harga_jual DECIMAL(10,2),
    harga_beli DECIMAL(10,2),
    stok INT(11)
);

## Screenshots
Tampilan utama
<img width="1332" height="684" alt="image" src="https://github.com/user-attachments/assets/929a52b6-f3d2-40ab-bc28-9ef9832647f8" />

