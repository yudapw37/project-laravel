<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class present extends Model
{
    //
    protected $fillable=['code_students', 'code_tasks', 'file_upload', 'komentar'];

    // public function student()
    // {
    // 	return $this->belongsTo('App\student', 'code_students', 'id');
    // }

    // public function task()
    // {
    // 	return $this->belongsTo('App\task', 'code_tasks', 'id');
    // }
}
