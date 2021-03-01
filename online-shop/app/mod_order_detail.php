<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mod_order_detail extends Model
{
    protected $table = 'orderdetail';
    protected $fillable = ['code_order', 'code_barang', 'code_promo', 'nama_promo', 'jumlah', 'harga', 'harga_promo', 'diskon', 'status_barang', 'keterangan'];
}
