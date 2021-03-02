<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    //
    // public function present()
    // {
    // 	return $this->hasMany('App\present','code_students', 'id');
    // }

    protected $fillable=['username', 'password', 'nama', 'kelas','alamat' ];
}
