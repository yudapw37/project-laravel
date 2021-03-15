<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mod_manage_product extends Model
{
    protected $table = 'ms_top_produk';
    protected $fillable = ['id_buku', 'judul_buku', 'kategori','typePO', 'harga_buku', 'harga_jadi', 'gambar_buku' ];

}
