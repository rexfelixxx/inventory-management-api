# STOCK

## ENDPOINT INFORMATION

| Item             | Detail                        |
| ---------------- | ----------------------------- |
| Endpoint Path    | /stock                        |
| Method Available | GET, POST, DELETE, PUT, PATCH |
| Authentication   | Required                      |
| Content-Type     | application/json              |

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

## DELETE

Menghapus stock movement log. csranya tinggal request `/stock/{id}` dan ganti id nya dengan id stock log yang ingin dihapus.

## PUT

    Mengupdate data untuk sebuah baris dalam  tabel stock.

### ROUTE PARAMETER

| Name | Position | Status   | Description        |
| ---- | -------- | -------- | ------------------ |
| id   | 1        | Required | id untuk stock log |

### REQUEST

**Request Field**:

| Field       | Type      | Status   | Description                                        |
| ----------- | --------- | -------- | -------------------------------------------------- |
| item_id     | integer   | Required | id item yang mengalami perubahan stok              |
| description | tiny text | Required | deskripsi tentang perubahan stok                   |
| user_id     | integer   | Required | id user yang bertanggung jawab atas perubahan stok |
| move_at     | datetime  | required | waktu saat perubahan stok terjadi                  |

**Example**:

```json
{
  "item_id": 5,
  "description": " The description",
  "user_id": 4,
  "move_at": "2026-07-13 20:00:00"
}
```

### RESPONSE

- status code: `200`

```json
{
  "status": "ok",
  "message": "A stock log successfully updated",
  "data": null
}
```

## PATCH

    Mengupdate sebuah baris dalam table stock_movement. Tapi ini akan mengubah jumlah stok.

### ROUTE PARAMETER

| Name | Position | Status   | Description        |
| ---- | -------- | -------- | ------------------ |
| id   | 1        | Required | id untuk stock log |

### REQUEST

**Request Field**:

| Field    | Type                          | Status   | Description                                                           |
| -------- | ----------------------------- | -------- | --------------------------------------------------------------------- |
| action   | enum("in"/"out"/"adjustment") | Required | Apa yang terjadi pada stok? penambahan, pengurangan, atau penyesuaian |
| quantity | integer                       | Required | Berapa banyak terjadinya perubahan tersebut                           |

**Example**:

```json
{
  "action": "in",
  "quantity": 20
}
```

### RESPONSE

- status code: `200`

```json
{
  "status": "ok",
  "message": "Updated successfully",
  "data": null
}
```
