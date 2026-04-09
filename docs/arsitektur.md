# ARSITEKTUR SISTEM

Saya mencoba meniru arsitektur Laravel, yaitu MVC(Model, View, Controller). disini saya memisah kode untuk pengolahan database dan logika. saya tidak menggunakan View karena ini cuma API. jadi mungkin lebih cocok jika menyebutnya MC? hehe. selain itu ada beberapa folder tambahan seperti configs, dan helpers, untuk penjelasannya lihat di [penjelasan folder](#penjelasan-folder).

## Tech Stack
- Backend: PHP
- Database: MariaDB

## Sistem Penamaan File
Penamaan file yang baik dapat sangat membantu untuk membuat workflow lebih rapi dan mudah dibaca, oleh karena itu saya membuat konvensi untuk penamaan filenya. jadi saya harap siapaun yang ingin berkontribusi dapat mengikuti konvensi ini.
### PascalCase
Gunakan pascal case untuk menamai file yang memengaruhi perilaku project ini, contohnya file konfig akan dinamai dengan PascalCase karena mengubahnya dapat mengubah perilaku API ini.
### snake_case
Gunakan snake_case untuk menamai folder(ya, semua folder) dan file lainnya, yang jika diubah tidak mengubah perilaku API/project ini. Contohnya, file dokumentasi dan sebagainya.

## Penjelasan Folder
### configs/
Berisi konfigurasi yang digunakan untuk project ini, seperti CORS, konfigurasi databasa, mode debug dan sebagainya. Untuk file konfignya saya menggunakan file PHP.
### routes/
Berisi file routing. file routing harus dipilih dan di-require di dalam index.php, kamu bisa membuat single file untuk semua routing, atau banyak file yang dipisah berdasarkan url-nya. opsi ke dua sangat bagus jika API memiliki banyak fitur, karena mudah di maintenance.
### controllers/
Berisi file-file dengan kode untuk memproses logika, seperti mengambil input, memproses dan memfilter data, password hashing, dan lain-lain.
### models/
Berisi file-file untuk mengolah database, seperti menambahkan user baru, mengedit nama item, dan sebagainya.
### views/
Berisi tampilan antarmuka, namun karena ini API, folder ini tidak saya gunakan.
### helpers/
Berisi fungsi-fungsi pembantu yang sering saya gunakan berulang seperti, mengambil body request, mengambil token Auth, membuat token, membuat route, dan sebagainya. yah meskipun karena saya tidak menggunakan library apapun saya terlihat seperti membuat framework sendiri.
### docs/
Berisi dokumentasi teknis untuk project ini.

## Alur Program
request -> index.php -> routes/Api.php -> controllers/ -> models/ -> respon berupa json

Setelah server menerima request, server akan menjalankan index.php yang akan memuat routes/Api.php lalu menjalankan program sesuai rute request. Setelah itu server menjalankan controller yang sesuai dengan rute, dan memproses logika, baru setelah itu menjalankan models untuk mengolah database dan memberikan response berupa json.

