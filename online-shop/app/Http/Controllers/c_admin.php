<?php

namespace App\Http\Controllers;
use App\mod_admin;
use Illuminate\Http\Request;

class c_admin extends Controller
{
    public function getadmincust(Request $request)
    {
        if ($request->session()->has('idUser')){
            $kodeAdminTrx = $request->session()->get('kodeAdminTrx');

            $admin = mod_admin::select('nama','no_telp')->where('kodeAdminTrx', '=', $kodeAdminTrx)->first();
            return $admin;
        }else{
            return 'login';
        }      
       
    }
}
