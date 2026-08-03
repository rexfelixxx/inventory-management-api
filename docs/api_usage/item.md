# /item

## POST

membuat sebuah item baru.

Request:

```json
{
  "sku": "TI-1",
  "name": "Test item 1",
  "category_id": 1,
  "description": "Test item 1"
}
```

- sku harus unik dan tidak dapat di duplikasi, ia juga akn selalu dalam huruf kapital, meskipun kamu menginput huruf kecil.
- name akan selalu mengcapitalize huruf pertama dalam sebuah kata dan semua huruf dibelakangnya akan mwnjadi huruf kecil.
- category_id opsional untuk diisi namun jika mengisi pastikan ada categpry dengan id tersebut.
- deskripsi bersifat opsional
  Response:

```json
{
  "status": "ok",
  "message": "Successfully created new item",
  "data": null
}
```

## GET

untuk mengambil data yang ada di tabel item. ada beberapa cara yang bisa kamu lakukan

### Paging

kamu menentukan offset dan limit untuk data yang kamu ambil jadi kamu bisa memilih darimana dan seberapa banyak data yang ingin kamu ambil. contohnya URL **/item?limit=30&offset=10** akan mengambil data dari baris ke 11 sampai ke 30.

### Path Parameter

kamu bisa menggunakan id atau sku item untuk melihat informasi tentang item tersebut. contohnya: **/item/5** (mengambil data item dengan id 5) dan **/item/ti-12** (mengambil item dengan sku TI-12). yang membedakan id dengan SKU adalah keberadaan huruf. untuk menggunakan SKU kamu tidak perlu khawatir tentang kapitalisasi karakter, soalnya sku bersifat case insensitive

### All

untuk mengambil swmua data item (sangat tidak disaranakan karena dapat menyebabkan overload sistem), kamu cukup menggunakan route **/item**

## DELETE

Untuk menghapus data sebuah item. Gunakan `/item/{id}` untuk menghapus itek dengan id {id}.

## PATCH

untuk mengupdate sebuah value dari suatu kolom. gunakan `/item/{id}` ganti id dengan id item yang ingin kamu ubah.

Request:

```json
{
  "{key}": "{value}",
  "{key}": "{value}"
}
```

- Ganti `{key}` dengan nama kolom yang ingin kamu ubah, dan `{value}` dengan isi baru untuk kolom tersebut.
- kamu bisa langsung mengubah beberapa sekaligus dengan format yang sama dibawahnya juga, tidak perlu melakukan requwst berulang.

Resoonse:

```json
{
  "status": "ok",
  "message": "Success: changed Key to Value",
  "data": null
}
```
