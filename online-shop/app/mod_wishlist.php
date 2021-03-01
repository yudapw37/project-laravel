<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mod_wishlist extends Model
{
    protected $table = 'ms_favorite';
    protected $fillable = ['id_buku', 'username'];

}
