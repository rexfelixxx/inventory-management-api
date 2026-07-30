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
