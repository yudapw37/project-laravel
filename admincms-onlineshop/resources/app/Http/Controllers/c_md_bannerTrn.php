<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class c_md_bannerTrn extends Controller
{
    public function index() {
        return view('dashboard.menu-lainnya.banner-trn.baru');
    }
}
