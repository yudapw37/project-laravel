<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mod_area;

class c_area extends Controller
{
    public function get($idkota){
        if($idkota){
            $area = mod_area::where('id_kota','=',$idkota)->orderBy('nama', 'asc')->get();
        }else{
            $area = mod_area::orderBy('nama', 'asc')->get();
        }        
        return $area;
    }
}
