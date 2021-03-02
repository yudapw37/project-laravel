<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mod_return_buku extends Model
{
    protected $table = 'ms_return_buku';
    protected $fillable=['type', 'code_barang', 'jumlah', 'pic','asal','keterangan' ];
}
