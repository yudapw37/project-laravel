<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mod_cart extends Model
{
    protected $table = 'ms_keranjang';
    protected $fillable = ['id_buku', 'username', 'jumlah', 'harga', 'berat', 'judul_buku'];
}
