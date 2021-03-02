<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class c_home extends Controller
{
    public function home() {
        return view('ui.index');
    }


}
