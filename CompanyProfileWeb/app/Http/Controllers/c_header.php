<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mod_header_footer;

class c_header extends Controller
{
    public function get(){
        $headfoot = mod_header_footer::orderBy('created_at', 'asc')->get();
        return $headfoot;
    }
}
