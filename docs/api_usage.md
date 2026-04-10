# API USAGE
## /user
### GET
mengirimkan data semua user
request: none  
response: 
```json
{
    "status":"ok",
    "data": {
    {
        "id":1,
        "name":"Admin",
        "password":"password123",
        "role":"admin",
        "created_at":"2026-03-18 07:48:29"}
    }
}
```
### PUT
membuat user baru  
request:
```json
{
    "status": "ok",
    "data": {
    }
}

