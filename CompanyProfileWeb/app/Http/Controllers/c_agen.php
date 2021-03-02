<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mod_agen;

class c_agen extends Controller
{
    public function get(){
        $agen = mod_agen::orderBy('nama', 'asc')->get();
        return $agen;
        // return view('team',['agen'=>$agen]);
    }

    public function detail($id){
        $agendetail = mod_agen::where('id','=',$id)->orderBy('created_at', 'asc')->first();
        return $agendetail;
    }
}
