# HELPERS DOCUMENTATION
Karena aku membuat API ini tanpa framework ataupun library, aku harus membuat fungsi-fungsi yang dapat kugunakan berulang-ulang. Karena hal itu juga aku merasa bagian ini perlu kudokumentasikan agar semua orang tahu cara menggunakannya.

## Auther
- `generateToken()`: membuat token random dan mengembalikan nilainya.
- `getAuthHeader()`: mengambil request header bagian autorisasi dan mengembalikan nilainya. ini fungsi private, tidak bisa digunakan diluar class
- `getBearerToken()`: mengembalikan token yang ada di request header

## Databaser
- `runQuery($query, $param[])`: menjalankan query sql yang kamu letakkan di `$query`, query mengunakan PDO, jadi bisa kamu gunakan sesuai PDO. `$param` berupa array yang bisa kamu masukkan berbagai parameter untuk PDO, menggunakan parameter untuk data sensitif disarankan untuk keamanan. fungsi ini akan mengembalikan hasil dari query yang sudah di execute. kamu harus memproses hasilnya terlebih dahulu menggunakan `fetch()`, `fetchAll()`, `rowCount()` dan sebagainya.

## Responser
- `ok($data)`: mengirimkan response ke client, dengan kode status 200. kamu juga bisa menyertakan data dengan memasukkannya ke `$data`
- `bad($data)`: mengerimkan response ke client, dengan kode status 400. kamu juga bisa menyertakan data
- `custom($code, $status, $data)`: mengirimkan response ke client yang bisa kamu tweak sendiri. `$code` untuk kode status, `$status` untuk pesan status( ok, bad, error dan lain-lain), `$data` untuk data

## Inputter
- `getInput()`: mengambil data di request body dan mengembalikannya sebagai objek

## Router
- `addDefault($controller)`: menjalankan controller yang dipilih setiap kali client meminta url yang tidak terdefinisi
- `add($path, $method, $controller)`: membuat rute baru, `$path` untuk url, `$method` untuk metode request, dan $controller untuk controller yang akan dijalankan, biasanya dengan format `[ControllerName::class, "methodName"]`
- `run()`: menjalankan router, fungsi ini harus dijalanakan setalah semua rute ditambahkan
