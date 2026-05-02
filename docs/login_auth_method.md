# LOGIN & AUTH METHOD
File ini berisi dokumentasi tentang metode login dan autentikasi. Ini kubuat karena metode login dan auth disini kubuat sendiri. Tidak ada metode mendaftar disini, user hanya bisa dibuat oleh User yang memiliki role admin di database. Semua fungsi untuk melakukan login dan autentikasi dapat kamu temukan di (controllers/AuthController.php)[../controllers/AuthController.php]

## Login 
Okay, mulai dengan fungsi **login**. Berikut alurnya:
1. Mengambil item `name` dan `password` dari `request body`
2. Mencari di tabel `users` apakah user dengan `name` tersebut ada. jika tidak ada, mengirimkan bad response. jika ada maka,
3. Mencocokkan `password`. password yang disimpan di tabel berupa hash, karena itu harus dicocokkan dengan `password_verify()`, sehingga lebih aman. jika password tidak cocok, mengirimkan bad response. jika cocok maka,  
4. Membuat token baru, lalu menyimpan token tersebut di tabel tokens dan mengirimkannya ke client agar bisa digunakan kembali. token akan berubah jika kamu mencoba login menggunakan user yang memiliki token tersebut.

Aku menyarankan agar kalian membaca kodenya setelah membaca ini agar kalian dapat memahaminya secara langsung.

## Authentication
Seperti sebelumnya, akan kutunjukkan alurnya:
1. Mengambil token dari bearer
2. Mencari token yang sama dengan token dari bearer di tabel tokens, jika tidak ditemukan, mengirmkan bad response. jika ada maka,
3. Mencari pemilik/ user dari token tersebut di tabel users
4. Mengembalikan role(`admin` atau `staff`) dari user tersebut. Bukan sebagai response, melainkan sebagai return fungsi berupa string. Ini bisa digunakan untuk fungsi lain yang membutuhkan autorisasi



