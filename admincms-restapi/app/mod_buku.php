<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mod_buku extends Model
{
    protected $table = 'ms_barang';
    protected $fillable = ['id', 'barcode', 'berat','kategori','status', 'judul_buku', 'harga', 'halaman', 'ukuran', 'cover', 'penulis', 'isbn', 'penerbit', 'tahun', 'diskripsi', 'gambar_buku', 'store' ];

}
