# ARSITEKTUR SISTEM

API ini mencoba menerapkan arsitektur yang terinspirasi dari Laravel, yaitu MVC (Model, View, Controller). Dalam project ini, kode untuk pengolahan database dan logika aplikasi dipisahkan agar setiap bagian memiliki tanggung jawab yang jelas.

Karena project ini merupakan API dan tidak menghasilkan tampilan antarmuka, bagian View tidak digunakan. Jadi, secara sederhana arsitektur project ini dapat disebut sebagai MC (Model, Controller) dengan beberapa komponen tambahan seperti `configs`, `routes`, dan `helpers`.

Penjelasan mengenai masing-masing folder dapat dilihat pada bagian [Penjelasan Folder](#penjelasan-folder).

## Tech Stack

- Backend: PHP
- Database: MariaDB
- Database Name: `stockdb`

## Sistem Penamaan File

Penamaan file yang baik dapat membantu membuat workflow lebih rapi dan mudah dibaca. Oleh karena itu, project ini menggunakan beberapa konvensi penamaan file.

Saya berharap siapapun yang ingin berkontribusi pada project ini dapat mengikuti konvensi tersebut agar struktur project tetap konsisten.

### PascalCase

Gunakan PascalCase untuk menamai file yang memengaruhi perilaku project.

Contohnya:

```
Api.php
Database.php
```

File-file tersebut menggunakan PascalCase karena perubahan pada isinya dapat mengubah perilaku API.

### snake_case

Gunakan snake_case untuk menamai folder dan file lainnya yang tidak secara langsung mengubah perilaku API/project.

Contohnya:
```
routes/
controllers/
models/
api_documentation.md
architecture.md
```

Dengan begitu, file yang memiliki pengaruh terhadap perilaku aplikasi dapat dibedakan dari file dokumentasi atau file lainnya.

---

## Penjelasan Folder

### `configs/`

Berisi konfigurasi yang digunakan oleh project, seperti:

- konfigurasi database;
- CORS;
- debug mode;
- konfigurasi aplikasi lainnya.

File konfigurasi menggunakan PHP.

### `routes/`

Berisi file routing yang menentukan endpoint API dan menghubungkannya dengan controller yang sesuai.

File routing harus dipilih dan di-`require` di dalam `index.php`.

Untuk API kecil, semua routing dapat ditempatkan dalam satu file. Namun, jika API memiliki banyak fitur, routing dapat dipisahkan menjadi beberapa file berdasarkan URL atau fitur agar lebih mudah di-maintain.

### `controllers/`

Berisi kode untuk memproses request dan logika aplikasi.

Contohnya:

- mengambil input dari request;
- memvalidasi dan memfilter data;
- memproses data;
- melakukan password hashing;
- menangani autentikasi;
- memanggil model;
- membuat response JSON.

Controller bertanggung jawab terhadap proses dan logika aplikasi, sedangkan operasi database ditangani oleh model.

### `models/`

Berisi kode yang digunakan untuk mengolah data pada database.

Contohnya:

- menambahkan user;
- mencari user;
- mengubah data item;
- mengambil kategori;
- menambahkan stock movement;
- mengambil data inventory.

Dengan memisahkan database logic ke dalam model, controller tidak perlu menangani query database secara langsung.

### `views/`

Dalam arsitektur MVC, folder ini biasanya digunakan untuk menyimpan tampilan antarmuka.

Namun, karena project ini hanya merupakan API dan response dikirim dalam bentuk JSON, folder `views/` tidak digunakan.

### `helpers/`

Berisi fungsi-fungsi pembantu yang digunakan berulang kali di berbagai bagian project.

Contohnya:

- mengambil body request;
- mengambil authentication token;
- membuat token;
- membuat route;
- fungsi utility lainnya.

Karena project ini tidak menggunakan framework/library untuk menyediakan fungsi-fungsi tersebut, beberapa fungsi yang biasanya sudah tersedia dalam framework perlu dibuat sendiri.

### `docs/`

Berisi dokumentasi teknis untuk project.

Contohnya:

- dokumentasi arsitektur;
- dokumentasi endpoint;
- dokumentasi database;
- dokumentasi penggunaan API.

---

## Alur Program

Alur utama request pada API adalah:

Request → `index.php` → `routes/` → `controllers/` → `models/` → MariaDB → JSON Response

Setelah server menerima request, server akan menjalankan `index.php` sebagai entry point aplikasi.

`index.php` kemudian memuat file routing yang diperlukan. Router menentukan program atau controller yang sesuai berdasarkan route dari request.

Setelah controller dijalankan, controller akan mengambil input request dan memproses logika yang diperlukan.

Jika proses membutuhkan data dari database, controller akan memanggil model. Model kemudian melakukan operasi terhadap database MariaDB dan mengembalikan hasilnya kepada controller.

Setelah proses selesai, controller membuat response dan mengirimkannya kembali kepada client dalam bentuk JSON.

---

## Pembagian Tanggung Jawab

Setiap bagian memiliki tanggung jawab yang berbeda:

Komponen| Tanggung Jawab
---|---
`index.php`| Entry point aplikasi
`routes/`| Menentukan route dan controller yang digunakan
`controllers/`| Memproses request dan logika aplikasi
`models/`| Mengolah data dan berinteraksi dengan database
`configs/`| Menyediakan konfigurasi aplikasi
`helpers/`| Menyediakan fungsi pembantu
`views/`| Tidak digunakan karena project merupakan API
`docs/`| Dokumentasi teknis

Pemisahan ini bertujuan agar perubahan pada satu bagian tidak menyebabkan kode pada bagian lain menjadi terlalu bergantung satu sama lain.

Sebagai contoh, perubahan query database sebaiknya dilakukan pada model dan tidak perlu mengubah controller selama interface model yang digunakan tetap sama.

---

## Database

Database yang digunakan oleh API adalah MariaDB dengan nama database `stockdb`. Database menggunakan `utf8mb4` sebagai character set.

Database terdiri dari lima tabel:

- `category`
- `item`
- `stock_movement`
- `token`
- `user`

### `category`

Tabel `category` digunakan untuk menyimpan kategori item.

Field| Type| Keterangan
---|---|---
`id`| `INT`| Primary key dan auto increment
`name`| `VARCHAR(100)`| Nama kategori dan unique

Kolom `name` memiliki constraint `UNIQUE`, sehingga dua kategori tidak dapat memiliki nama yang sama.

### `item`

Tabel `item` digunakan untuk menyimpan data barang atau item inventory.

Field| Type| Keterangan
---|---|---
`id`| `INT`| Primary key dan auto increment
`sku`| `VARCHAR(30)`| SKU item dan unique
`name`| `VARCHAR(150)`| Nama item
`category_id`| `INT`| ID kategori
`description`| `TINYTEXT`| Deskripsi item
`quantity`| `INT`| Jumlah item

`category_id` merupakan foreign key yang mengarah ke `category.id`. Kolom `sku` juga memiliki constraint `UNIQUE`.

### `stock_movement`

Tabel `stock_movement` digunakan untuk mencatat perubahan stok.

Field| Type| Keterangan
---|---|---
`id`| `INT`| Primary key dan auto increment
`item_id`| `INT`| ID item
`action`| `ENUM`| `in`, `out`, atau `adjustment`
`quantity`| `INT`| Jumlah perubahan
`description`| `TINYTEXT`| Deskripsi perubahan
`user_id`| `INT`| ID user yang melakukan perubahan
`created_at`| `TIMESTAMP`| Waktu record dibuat
`move_at`| `TIMESTAMP`| Waktu pergerakan stok

`item_id` merupakan foreign key ke `item.id`, sedangkan `user_id` merupakan foreign key ke `user.id`. Kedua foreign key tersebut menggunakan `ON UPDATE CASCADE`.

Nilai `action` dibatasi menjadi tiga jenis:

- `in` — stok masuk;
- `out` — stok keluar;
- `adjustment` — penyesuaian stok.

### `user`

Tabel `user` digunakan untuk menyimpan data pengguna API.

Field| Type| Keterangan
---|---|---
`id`| `INT`| Primary key dan auto increment
`name`| `VARCHAR(100)`| Nama user dan unique
`password`| `VARCHAR(255)`| Password user
`role`| `ENUM`| `staff` atau `admin`

Kolom `name` memiliki constraint `UNIQUE`, sedangkan `role` hanya dapat berisi `staff` atau `admin`.

### `token`

Tabel `token` digunakan untuk menyimpan authentication token milik user.

Field| Type| Keterangan
---|---|---
`user_id`| `INT`| ID user
`token`| `VARCHAR(100)`| Authentication token
`created_at`| `TIMESTAMP`| Waktu token dibuat
`expired_at`| `TIMESTAMP`| Waktu token kedaluwarsa

`user_id` merupakan foreign key yang mengarah ke `user.id`.

---

## Relasi Database

Relasi antar tabel dapat dijelaskan sebagai berikut:

Tabel| Relasi| Tabel Tujuan
---|---|---
`category`| satu kategori dapat memiliki banyak item| `item`
`item`| satu item dapat memiliki banyak stock movement| `stock_movement`
`user`| satu user dapat memiliki banyak token| `token`
`user`| satu user dapat melakukan banyak stock movement| `stock_movement`

Foreign key digunakan untuk menghubungkan tabel-tabel tersebut dan menjaga integritas referensial database.

---

## Contoh Alur Endpoint

Sebagai contoh, ketika client meminta data item melalui endpoint:

GET /items/15

Prosesnya adalah:

1. Request diterima oleh server.
2. `index.php` dijalankan.
3. `index.php` memuat routing.
4. Router menentukan controller untuk endpoint tersebut.
5. Controller mengambil parameter `15` dari request.
6. Controller memanggil model item.
7. Model melakukan query ke tabel `item`.
8. Database mengembalikan data item.
9. Model mengembalikan hasil kepada controller.
10. Controller mengubah hasil menjadi response JSON.
11. Response dikirim kembali kepada client.

Dengan cara ini, controller tidak perlu mengetahui detail query SQL yang digunakan untuk mengambil data.

---

## Prinsip Arsitektur

Prinsip utama dari arsitektur project ini adalah:

«Routes menentukan request harus diproses ke mana, Controller menentukan bagaimana request diproses, dan Model menangani bagaimana data disimpan atau diambil dari database.»

Pemisahan tersebut membuat setiap bagian memiliki tanggung jawab yang lebih jelas dan membuat project lebih mudah untuk dikembangkan.

Meskipun struktur ini terinspirasi dari MVC, project ini tidak bermaksud menjadi implementasi MVC secara penuh. Karena tidak terdapat server-side view, arsitektur yang digunakan lebih tepat disebut sebagai MVC-like architecture untuk REST API, dengan Model dan Controller sebagai komponen utama serta Routes, Configs, dan Helpers sebagai komponen pendukung.

---

## Catatan Keamanan

Database dump yang digunakan untuk development saat ini berisi data user `admin` beserta password yang ditulis langsung pada SQL dump.

Data tersebut sebaiknya hanya digunakan untuk development/testing.

Untuk deployment production:

- password harus disimpan menggunakan password hashing;
- password production tidak boleh ditulis langsung di source code atau database seed;
- credentials production sebaiknya disimpan melalui environment variable atau konfigurasi yang aman;
- authentication token harus memiliki expiration;
- database dump yang berisi credentials development tidak sebaiknya digunakan sebagai database production.

---

## Kesimpulan

Project ini menggunakan arsitektur sederhana yang terinspirasi dari MVC untuk memisahkan routing, business logic, dan database logic.

Struktur utamanya terdiri dari:

- `routes/` untuk routing;
- `controllers/` untuk request dan logic aplikasi;
- `models/` untuk database;
- `configs/` untuk konfigurasi;
- `helpers/` untuk fungsi pembantu;
- `docs/` untuk dokumentasi;
- `views/` tidak digunakan karena project merupakan API.

Dengan struktur tersebut, project tetap sederhana tanpa framework besar, tetapi memiliki pemisahan tanggung jawab yang jelas sehingga lebih mudah dikembangkan dan di-maintain.