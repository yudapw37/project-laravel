<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mod_kategori extends Model
{
    protected $table = 'ms_kategori_trn';
    protected $fillable = ['id_kategori', 'id_buku'];

}
