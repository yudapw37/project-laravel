<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mod_alamat_cust extends Model
{
    protected $table = 'ms_customer_alamat';
    protected $fillable = ['code_customer', 'alamat'];
}
