<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mod_penerima_alamat extends Model
{
    protected $table = 'ms_penerima_alamat';
    protected $fillable = ['code_customer', 'nama', 'no_telp', 'alamat','kecamatan', 'kode_ro', 'is_delete'];
}
