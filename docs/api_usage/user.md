# USER

## ENDPOINT INFORMATION

| Item             | Detail                 |
| ---------------- | ---------------------- |
| Endpoint Path    | /user                  |
| Method Available | GET, POST, DELETE, PUT |
| Authentication   | Required               |
| Content-Type     | application/json       |

## GET

    Mengambil data user

### ROUTE PARAMETER

| Name | Position | Status   | Description                |
| ---- | -------- | -------- | -------------------------- |
| id   | 1        | Optional | id user yang ingin diambil |

### QUERY PARAMETER

**Query Field**:

| Name   | Type    | Status   | Description                                                                            |
| ------ | ------- | -------- | -------------------------------------------------------------------------------------- |
| limit  | integer | Optional | Membatasi jumlah baris yang diambil                                                    |
| offset | integer | Optional | Menentukan dari baris mana kita mengambil datanya. **HARUS DIGUNAKAN BERSAMA `limit`** |

### RESPONSE

| Request URL | Status Code |
| ----------- | ----------- |
| /user/1     | 200         |

```json
{
  "status": "ok",
  "data": {
    "id": 1,
    "name": "username",
    "password": "$2y$12$kPajNexWnC1NsMyQbRIWgez5ADkGyGqtuPPjg0MxsxYALJAdvDzwO",
    "role": "staff"
  }
}
```

| Request URL            | Status Code |
| ---------------------- | ----------- |
| /user?offset=0&limit=5 | 200         |

```json
{
  "status": "ok",
  "data": [
    {
      "id": 1,
      "name": "username",
      "password": "$2y$12$RpdRyBbmh5A88cazCYG8MutyQAzW4sSLPqJ9QaSNTQ/aSy2ASNlQK",
      "role": "staff"
    },
    {dan seterusnya}
  ]
}
```

## POST

    Membuat akun user baru

### REQUEST

**Request Field**:

| Field    | Type                   | Status   | Description                                                 |
| -------- | ---------------------- | -------- | ----------------------------------------------------------- |
| name     | varchar                | Required | nama user yang ingin dibuat                                 |
| password | varchar                | Required | password untuk user yang ingin dibuat                       |
| role     | enum("admin", "staff") | Optional | Level privilige untuk user tersebut, secara default "staff" |

**Example**:

```json
{
  "name": "username",
  "password": "userpassword",
  "role": "admin"
}
```

### RESPONSE

| Request URL | Status Code |
| ----------- | ----------- |
| /user       | 200         |

```json
{
  "status": "ok",
  "data": {
    "message": "User successfully created"
  }
}
```

## PUT

    Mengupdate sebuah user yang sudah ada.

### ROUTE PARAMETER

| Name | Position | Status   | Description                 |
| ---- | -------- | -------- | --------------------------- |
| id   | 1        | Required | id user yang ingin diupdate |

### REQUEST

**Request Field**:

| Field    | Type    | Status   | Description              |
| -------- | ------- | -------- | ------------------------ |
| name     | varchar | Required | nama user baru           |
| password | varchar | Required | password baru untuk user |

**Example**

```json
{
  "name": "new user name",
  "password": "new user password"
}
```

### RESPONSE

| Request URL | Status Code |
| ----------- | ----------- |
| /user/1     | 200         |

```json
{
  "status": "ok",
  "data": {
    "message": "User successfully updated"
  }
}
```

## DELETE

    Menghapus user

### ROUTE PARAMETER

| Name | Position | Status   | Description                |
| ---- | -------- | -------- | -------------------------- |
| id   | 1        | Optional | id user yang ingin dihapus |

### RESPONSE

| Request URL | Status Code |
| ----------- | ----------- |
| /user/1     | 200         |

```json
{
  "status": "ok",
  "data": {
    "message": "User successfully deleted"
  }
}
```
