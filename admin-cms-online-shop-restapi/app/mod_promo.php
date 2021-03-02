<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mod_promo extends Model
{
    protected $table = 'ms_admin';
    protected $fillable = ['code_perusahaan', 'username', 'password','keyhash', 'email', 'nama', 'no_telp', 'code_jabatan', 'kodeAdminTrx', 'created_at', 'updated_at' ];

}
