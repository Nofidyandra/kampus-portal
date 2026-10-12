# Portal Kampus Fiktif (Sengaja Rentan)

Aplikasi latihan keamanan. **Semua akun dan data fiktif. Jangan dipakai untuk data asli.**

## Setup
1. Import `schema.sql` ke MySQL.
2. Sesuaikan kredensial di `config.php`.
3. Jalankan: `php -S localhost:8000`

## Akun uji
admin/admin123, dosen1/dosen123, mhs1/mhs123, mhs2/mhs456, mhs3/mhs789

## Kerentanan yang sengaja dibuat
| # | Jenis | File | Penjelasan | Perbaikan |
|---|-------|------|------------|-----------|
| 1 | SQL Injection | login.php | Input digabung ke query | Prepared statement |
| 2 | IDOR | nilai.php | Parameter `id` tidak dicek kepemilikan | Bandingkan dengan `$_SESSION['uid']` |
| 3 | Stored XSS | diskusi.php | Komentar tanpa escape saat tampil | `htmlspecialchars()` |
| 4 | Validasi berkas lemah | upload.php | Semua tipe file diterima | Whitelist ekstensi + MIME, ganti nama file |

## Bukti uji (isi sendiri)
- SQLi: username `' OR '1'='1' -- ` , password bebas
- IDOR: ubah `nilai.php?id=3` menjadi `id=4`
- XSS: kirim komentar berisi tag script sederhana (mis. `alert(1)`) lalu buka ulang halaman

## Versi aman
Folder `fixed/` berisi versi yang sudah diperbaiki (login, nilai, diskusi, upload). Jalankan dengan
`php -S localhost:8001 -t .` lalu buka `/fixed/login.php`, dan ulangi pengujian yang sama untuk membuktikan serangan gagal.
Perbaikan: prepared statement, cek kepemilikan data, `htmlspecialchars`, whitelist file + nama acak + blokir eksekusi PHP di `uploads/`.

## Deploy ke hosting (InfinityFree)
Gunakan `schema_hosting.sql` (tanpa CREATE DATABASE/USE) dan ubah kredensial di `config.php`.
