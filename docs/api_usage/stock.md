# stock

## POST

membuat log stock movement baru.

Request:

```json
{
  "item_id": 1,
  "action": "in",
  "quantity": 5,
  "user_id": 1,
  "move_at": "2021-9-16 19:00:00",
  "description": "Example"
}
```

- item_id: gunakan id item alih-alih nama item, pastikan ada item dengan id tersebut.
- action: "in" untuk stok masuk, "out" untuk stok yang keluar, dan "adjustment" yang akan mebgubah total jumlah item di inventory sesuai quantity yang ada di request body.
- quantity: jumlah item, ini bisa berarti berbagai hal sesuai action yang kamu pilih
- user_id: user yabg bertabggu jawab atas perubahan stok.
- move_at: kapan perubahan itu terjadi.
- description: untuk menjelaskan kenapa stoknya berubah.
- semua param diatas harus diisi.

Response:

```json
{
  "status": "ok",
  "message": "Succesfully created new stock log",
  "data": null
}
```

## GET

Kamu bisa mendaoatkan banyak hal disini. ada beberaoa cara untuk menggunakan ini.

### `/stock`

mengambil semua data stok movement yang ada didatabase. sangat tidak disarankan

### `/stock/{id}`

mengabil stock movement dengan id tersebut.

### `/stock?{param_key}={param_value}`

ada beberapa param yang bisa kamu pakai.

- `limit` dan `offset`: isinya harus berupa angka, kamu bisa menggunakan limit tanpa offset tapi offset tidak bisa digunakan sendiri.
- `userid`: isinya berupa id user yang membuat stock movement. denngan ini kamu bisa tahu user tertentu membuat perubahan apa saja.
- `itemid`: isinya beruoa item id. dengan begini kamu bisa tahu item tertentu mengalami perubahan apa saja.
  _Kamu bisa mengkombinasikan semuanya juga_. Contoh `/stock?limit=10&offset=10&userid=4&itemid=8` yang akan mengambil 10 data dari posisi baris ke 10 dan yang dibuat oleh user dengan id 4 dan item dengan id 8. semacam filter sih.
