<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mod_customer extends Model
{
    protected $table = 'ms_customer'; 
    protected $fillable = ['username', 'userId','password',
    'nama', 'alamat', 'telephone', 'kodeAdminTrx',
     'jenis_reseller', 'diskon', 'keyhash', 'email'];
   
}
