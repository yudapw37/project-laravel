<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mod_promo extends Model
{
    protected $table = 'ms_promo';
    protected $fillable = ['code_promo', 'nama_promo', 'pre_order','harga_jadi', 'berat_total', 'tanggal_cetak', 'gambar_buku', 'deskripsi', 'is_del'];

}
