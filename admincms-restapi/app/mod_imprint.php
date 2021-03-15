<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mod_imprint extends Model
{
    protected $table = 'ms_inprint_trn';
    protected $fillable = ['id_inprint', 'id_buku'];
}
