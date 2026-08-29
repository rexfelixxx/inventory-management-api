# ITEM

## ENDPOINT INFORMATION

| Item             | Detail                   |
| ---------------- | ------------------------ |
| Endpoint Path    | /user                    |
| Method Available | GET, POST, DELETE, PATCH |
| Authentication   | Required                 |
| Content-Type     | application/json         |

## POST

    Membuat item baru

### REQUEST

**Request Field**:

| Field       | Type      | Status   | Description                                      |
| ----------- | --------- | -------- | ------------------------------------------------ |
| sku         | varchar   | Required | SKU untuk item yang ingin dibuat, SKU harus unik |
| name        | varchar   | Required | nama item yang ingin dibuat                      |
| category_id | integer   | Optional | Id kategori dimana item tersebut dikategorikan   |
| description | tiny text | Optional | Deskripsi singkat untuk item tersebut            |

**Example**:

```json
{
  "sku": "TI-1",
  "name": "Test item 1",
  "category_id": 1,
  "description": "Test item 1"
}
```

### RESPONSE

| Request URL | Status Code |
| ----------- | ----------- |
| /item       | 200         |

```json
{
  "status": "ok",
  "message": "Successfully created new item",
  "data": null
}
```

## GET

    Mengambil data item

### ROUTE PARAMETER

| Name | Position | Status   | Description                |
| ---- | -------- | -------- | -------------------------- |
| id   | 1        | Optional | id item yang ingin diambil |

### QUERY PARAMETER

**Query Field**:

| Name   | Type    | Status   | Description                                                                            |
| ------ | ------- | -------- | -------------------------------------------------------------------------------------- |
| limit  | integer | Optional | Membatasi jumlah baris yang diambil                                                    |
| offset | integer | Optional | Menentukan dari baris mana kita mengambil datanya. **HARUS DIGUNAKAN BERSAMA `limit`** |

### RESPONSE

| Request URL | Status Code |
| ----------- | ----------- |
| /item/5     | 200         |

```json
{
  "status": "ok",
  "message": "successfuly find item",
  "data": {
    "id": 5,
    "sku": "TI-2",
    "name": "Test Item Dua",
    "category_id": null,
    "description": null,
    "quantity": 20
  }
}
```

## DELETE

    Menghapus user

### ROUTE PARAMETER

| Name | Position | Status   | Description                |
| ---- | -------- | -------- | -------------------------- |
| id   | 1        | Optional | id item yang ingin dihapus |

### RESPONSE

| Request URL | Status Code |
| ----------- | ----------- |
| /item/5     | 200         |

```json
{
  "status": "ok",
  "data": {
    "message": "item successfully deleted"
  }
}
```

## PATCH

    Mengupdate data suatu item

### ROUTE PARAMETER

| Name | Position | Status   | Description                 |
| ---- | -------- | -------- | --------------------------- |
| id   | 1        | Optional | id item yang ingin diupdate |

### REQUEST

**Request Field**:

| Field       | Type      | Status   | Description                                      |
| ----------- | --------- | -------- | ------------------------------------------------ |
| sku         | varchar   | Optional | SKU untuk item yang ingin dibuat, SKU harus unik |
| name        | varchar   | Optional | nama item yang ingin dibuat                      |
| category_id | integer   | Optional | Id kategori dimana item tersebut dikategorikan   |
| description | tiny text | Optional | Deskripsi singkat untuk item tersebut            |

**Example**:

```json
{
  "notexist": "testing",
  "name": "Changed"
}
```

### RESPONSE

| Request URL | Status Code |
| ----------- | ----------- |
| /item/5     | 200         |

```json
{
  "status": "ok",
  "message": "Error: Theres no column named notexist, Success: changed name to Changed",
  "data": null
}
```
