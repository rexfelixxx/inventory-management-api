# API USAGE
## /user
### PUT
membuat user baru  

**request:**
```json
{
    "name": "username",
    "password": "password123",
    "role": "staff"
}
```
> [!NOTE]
> - name: nama user yang ingin dibuat
> - password: password untuk user yang ingin dibuat
> - role(opsional): dapat berisi "staff" atau "admin", staff memiliki privilege yang lebih terbatas daripada admin. secara default user yang dibuat akan menjadi staff.

**response:**
```json
{
  "status": "ok",
  "data": null
}
```
> [!NOTE]
> Status akan menjadi "bad request" dengan kode 400 jika user gagal dibuat

### DELETE
menghapus user
**request:**
```json
{
    "id": "1"
}
```
> [!NOTE]
> - id: id user

**response:**
```json
{
  "status": "ok",
  "data": null
}
```
> [!NOTE]
> Status akan menjadi "bad request" dengan kode 400 jika user dengan tersebut tidak ditemukan.

### POST
mengambil user berdasarkan id
**request:**
```json
{
    "id": "1"
}
```
> [!NOTE]
> - id: id user

**response:**
```json
{
  "status": "ok",
  "data": {
    "id": 1,
    "name": "username",
    "password": "password123",
    "role": "admin",
    "created_at": "2026-03-18 07:48:29"
  }
}
```
> [!NOTE]
> Status akan menjadi "bad request" dengan kode 400 jika user dengan tersebut tidak ditemukan.


