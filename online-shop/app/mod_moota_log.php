<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mod_moota_log extends Model
{
    protected $table = 'ms_mota_log';
    protected $fillable = ['bank','getOrder', 'getTransaksi','getMoota'];
}
