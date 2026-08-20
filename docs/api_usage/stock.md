# STOCK

## ENDPOINT INFORMATION

| Item             | Detail                        |
| ---------------- | ----------------------------- |
| Endpoint Path    | /stock                        |
| Method Available | GET, POST, DELETE, PUT, PATCH |
| Authentication   | Required                      |
| Content-Type     | application/json              |

## POST

    Membuat log stock movement baru.

### REQUEST

**Request Field**:

| Field       | Type                                    | Status   | Description                                                           |
| ----------- | --------------------------------------- | -------- | --------------------------------------------------------------------- |
| item_id     | integer                                 | Required | id item yang mengalami perubahan stok                                 |
| action      | enum(`"in"` / `"out"` / `"adjustment"`) | Required | Apa yang terjadi pada stok? penambahan, pengurangan, atau penyesuaian |
| quantity    | integer                                 | Required | Berapa banyak terjadinya perubahan tersebut                           |
| description | tiny text                               | Required | deskripsi tentang perubahan stok                                      |
| user_id     | integer                                 | Required | id user yang bertanggung jawab atas perubahan stok                    |
| move_at     | datetime                                | required | waktu saat perubahan stok terjadi                                     |

**Example**:

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

### RESPONSE

| Request URL | Status Code |
| ----------- | ----------- |
| /stock      | 200         |

```json
{
  "status": "ok",
  "message": "Succesfully created new stock log",
  "data": null
}
```

## GET

    Mengambil data dari table stock.

### ROUTE PARAMETER

| Name | Position | Status   | Description                                                                          |
| ---- | -------- | -------- | ------------------------------------------------------------------------------------ |
| id   | 1        | Optional | id untuk stock log yang ingin di ambil, digunakan untuk mengambil 1 baris stock log. |

### QUERY PARAMETER

**Query Field**:

| Name   | Type    | Status   | Description                                                                                                          |
| ------ | ------- | -------- | -------------------------------------------------------------------------------------------------------------------- |
| limit  | integer | Optional | Membatasi jumlah baris yang diambil, dalam contoh kita cuma mengambil 20 baris                                       |
| offset | integer | Optional | Menentukan dari baris mana kita mengambil datanya. **HARUS DIGUNAKAN BERSAMA `limit`**                               |
| itemid | integer | Optional | Hanya mengambil baris yang memiliki id item tertentu, dalam contoh kita memilih semu log yang memiliki id item 2     |
| userid | integer | Optional | Hanya mengambi baris yang dibuat dengan id tertentu, dalam contoh kita mengambil semua baris yang dibuat oleh user 4 |

### RESPONSE

| Request URL | Status Code |
| ----------- | ----------- |
| /stock/5    | 200         |

```json
{
  "status": "ok",
  "message": "Success",
  "data": {
    "id": 5,
    "item_id": 5,
    "action": "in",
    "quantity": 20,
    "description": " The descriptionua",
    "user_id": 4,
    "created_at": "2026-07-30 19:30:14",
    "move_at": "2026-07-13 20:00:00"
  }
}
```

## DELETE

    Menghapus stock movement log.

### ROUTE PARAMETER

| Name | Position | Status   | Description                            |
| ---- | -------- | -------- | -------------------------------------- |
| id   | 1        | Required | id untuk stock log yang ingin di hapus |

### RESPONSE

| Request URL | Status Code |
| ----------- | ----------- |
| /stock/5    | 200         |

```json
{
  "status": "ok",
  "message": "Stock Log Successfully Deleted",
  "data": null
}
```

## PUT

    Mengupdate data untuk sebuah baris dalam  tabel stock.

### ROUTE PARAMETER

| Name | Position | Status   | Description                             |
| ---- | -------- | -------- | --------------------------------------- |
| id   | 1        | Required | id untuk stock log yang ingin di update |

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

| Request URL | Status Code |
| ----------- | ----------- |
| /stock/5    | 200         |

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

| Name | Position | Status   | Description                            |
| ---- | -------- | -------- | -------------------------------------- |
| id   | 1        | Required | id untuk stock log yang ingin diupdate |

### REQUEST

**Request Field**:

| Field    | Type                                    | Status   | Description                                                           |
| -------- | --------------------------------------- | -------- | --------------------------------------------------------------------- |
| action   | enum(`"in"` / `"out"` / `"adjustment"`) | Required | Apa yang terjadi pada stok? penambahan, pengurangan, atau penyesuaian |
| quantity | integer                                 | Required | Berapa banyak terjadinya perubahan tersebut                           |

**Example**:

```json
{
  "action": "in",
  "quantity": 20
}
```

### RESPONSE

| Request URL | Status Code |
| ----------- | ----------- |
| /stock/5    | 200         |

```json
{
  "status": "ok",
  "message": "Updated successfully",
  "data": null
}
```
