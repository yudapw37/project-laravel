<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mod_foto_store;

class c_foto extends Controller
{
    public function detail($idstore){
        $fotodetail = mod_foto_store::where('id_store','=',$idstore)->orderBy('created_at', 'asc')->first();
        return $fotodetail;
    }
}
