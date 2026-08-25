# INVENTORY MANAGEMENT API

API simpel yang dibuat dengan penuh cinta oleh [sadonat🍩](https://github.com/sadonat).

ini adalah dokumentasi umum, untuk dokumentasi teknis silahkan lihat [docs](docs/table_of_contents.md).

## Techstack

- **Backend**: PHP
- **Database**: MariaDB (see [docs/database](docs/database.md))

## How to Use

### LOKAL

    Menjalankan semuanya di mesinmu sendiri.

**Persyaratan**:

- PHP 8.2+
- PHP PDO Extension
- PHP `pdo_mysql` Driver
- MariaDB 10.6+

**Cara Instalasi**:

- Clone repository ini dengan menjalankan perintah ini

```sh
git clone https://github.com/sadonat/inventory-management-api.git
```

- Masuk ke dalam folder `inventory-management-api` tersebut.
- Pastikan mariadb sudah berjalan, kalau belum, jalankan perintah ini

```sh
maridbd-safe &
```

- Import skema database dengan command ini. Kamu boleh menggunakan user manapun yang kamu mau.

```sh
mariadb -u root -p < database.sql
```

- Masuk ke mariadb

```sh
mariadb -u root -p
```

- Jalankan ini jika belum membuat user

```sql
CREATE USER 'nama_user'@'localhost' IDENTIFIED BY 'password';
```

- Jalankan ini jika belum memberi user yang kamu tentukan privileges untuk mengakses database `stockdb`

```sql
GRANT ALL PRIVILEGES ON stockdb.* TO 'nama_user'@'localhost';
```

- Sesuaikan file konfigurasi database sesuai milikmu di [Database.php](configs/Database.php). Dalam kasus umum kamu cukup mengganti `$user` dan `$password` sesuai user yang kamu beri privilege untuk stockdb

```php
<?php
$host = '127.0.0.1';
$db = 'stockdb';
$user = 'stock_admin';
$pass = 'admin1234';
$charset = 'utf8mb4';
```

- Jalankan server PHP milikmu dengan

```sh
php -S localhost:8000
```

- Selamat sekarang API ini berjalan di mesinmu, untuk login awal ke API nya. gunakan username `admin` dan password `1234`

## Usage

Kamu bisa menggunakan program ini setelah menjalankannya.Karena program ini hanyalah API, kamu perlu membuat interface sendiri / menggunakan API tester seperti Postman dan Hopscotch.
see [docs/api-usage](docs/api-usage/table_of_contents.md)
