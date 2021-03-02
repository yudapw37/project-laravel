<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mod_kota;

class c_kota extends Controller
{
    public function get(){
        $kota = mod_kota::orderBy('nama', 'asc')->get();
        return $kota;
    }
}
