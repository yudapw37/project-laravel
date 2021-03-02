<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class task extends Model
{
    //
    // public function present()
    // {
    // 	return $this->hasMany('App\present', 'code_tasks', 'id');
    // }

    protected $fillable=['mapel', 'nama', 'keterangan', 'file', 'kelas','tanggal' ];
}
