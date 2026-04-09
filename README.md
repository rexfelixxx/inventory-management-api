# INVENTORY MANAGEMENT API

## Overview
API simpel yang dibuat dengan penuh cinta oleh [rexfelixxx](https://github.com/rexfelixxx)
ini adalah dokumentasi umum, untuk dokumentasi teknis silahkan lihat [docs](docs/main.md).

## Features
- Login
- Token Authorization (Database Based)
- Users CRUD
- Tokens CRUD

## Techstack
- **Backend**: PHP
- **Database**: MariaDB (see [docs/database](docs/database.md))

## Installation
- Clone repository ini ke folder server PHP milikmu.
- Buat database baru
- Import `database.sql` ke database yang baru kamu buat
- Jalankan server PHP milikmu

## Usage
Kamu bisa menggunakan program ini setelah menjalankannya.Karena program ini hanyalah API, kamu perlu membuat interface sendiri / menggunakan API tester seperti Postman dan Hopscotch.
see [docs/api-usage.php](docs/api-usage.php)

## Folder Structure
- **routes/** -> routing
- **controllers/** -> implementasi logika
- **models/** -> implementasi pengolahan database
- **configs/** -> file-file konfigurasi
- **helpers/** -> alat-alat
