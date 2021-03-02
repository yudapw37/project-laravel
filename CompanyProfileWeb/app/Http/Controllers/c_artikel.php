<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mod_artikel;

class c_artikel extends Controller
{
    public function get(){
        $artikel = mod_artikel::orderBy('created_at', 'asc')->get();
        return $artikel;
    }
    public function detail($id){
        $artikeldetail = mod_artikel::where('id','=',$id)->orderBy('created_at', 'asc')->first();
        return $artikeldetail;
    }
    
}
