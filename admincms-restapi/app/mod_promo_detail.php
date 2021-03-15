<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mod_promo_detail extends Model
{
    protected $table = 'ms_barang_promo';
    protected $fillable = ['code_promo', 'code_barang'];

}
