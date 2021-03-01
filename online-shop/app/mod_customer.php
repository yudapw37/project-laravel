<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mod_customer extends Model
{
    protected $table = 'ms_customer';
    protected $fillable = ['id', 'username','userId', 'password', 'email', 'nama', 'telephone', 'kodeAdminTrx', 'alamat' ,'keyhash'];
}
