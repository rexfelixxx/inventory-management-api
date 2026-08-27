# CATEGORY

| Item             | Detail                 |
| ---------------- | ---------------------- |
| Endpoint Path    | /category              |
| Method Available | GET, POST, DELETE, PUT |
| Authentication   | Required               |
| Content-Type     | application/json       |

## POST

    Membuat category baru

### REQUEST

**Request Field**:

| Field | Type    | Status   | Description                    |
| ----- | ------- | -------- | ------------------------------ |
| name  | varchar | Required | nama kategori yag ingin dibuat |

**Example**:

```json
{
  "name": "Category Name"
}
```

### RESPONSE

| Request URL | Status Code |
| ----------- | ----------- |
| /category   | 200         |

```json
{
  "status": "ok",
  "message": "Category successfully created!",
  "data": null
}
```

## GET

    Mengambil data kategori

### ROUTE PARAMETER

| Name | Position | Status   | Description                    |
| ---- | -------- | -------- | ------------------------------ |
| id   | 1        | Optional | id kategori yang ingin diambil |

### QUERY PARAMETER

**Query Field**:

| Name   | Type    | Status   | Description                                                                            |
| ------ | ------- | -------- | -------------------------------------------------------------------------------------- |
| limit  | integer | Optional | Membatasi jumlah baris yang diambil                                                    |
| offset | integer | Optional | Menentukan dari baris mana kita mengambil datanya. **HARUS DIGUNAKAN BERSAMA `limit`** |

### RESPONSE

| Request URL | Status Code |
| ----------- | ----------- |
| /category/1 | 200         |

```json
{
  "status": "ok",
  "message": "Successfuly find category",
  "data": {
    "id": 1,
    "name": "Category Name"
  }
}
```

| Request URL                | Status Code |
| -------------------------- | ----------- |
| /category?offset=0&limit=5 | 200         |

```json
{
  "status": "ok",
  "message": "Successfully find all categories",
  "data": [
    {
      "id": 3,
      "name": "Category Name"
    },
    {...},
    ...
  ]
}
```

## DELETE

    Menghapus sebuah kategori

### ROUTE PARAMETER

| Name | Position | Status   | Description                    |
| ---- | -------- | -------- | ------------------------------ |
| id   | 1        | Optional | id kategori yang ingin dihapus |

### RESPONSE

| Request URL | Status Code |
| ----------- | ----------- |
| /category/1 | 200         |

```json
{
  "status": "ok",
  "message": "Category with id 1 is succesfully deleted",
  "data": null
}
```

## PUT

    Mengupdate nama sebuah kategori

### ROUTE PARAMETER

| Name | Position | Status   | Description                     |
| ---- | -------- | -------- | ------------------------------- |
| id   | 1        | Optional | id kategori yang ingin diupdate |

### REQUEST

**Request Field**:

| Field | Type    | Status   | Description |
| ----- | ------- | -------- | ----------- |
| name  | varchar | Required | nama baru   |

**Example**:

```json
{
  "name": "New Category Name"
}
```

### RESPONSE

| Request URL | Status Code |
| ----------- | ----------- |
| /category/1 | 200         |

```json
{
  "status": "ok",
  "message": "A category name successfulky updated",
  "data": null
}
```
