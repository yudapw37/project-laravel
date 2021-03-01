<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class c_session extends Controller
{
    public function getSession(Request $request)
    {
        if ($request->session()->has('idUser')){
            return $request->session()->get('idUser');
        }else{
            return 'null';
        }
    }
    
    public function removeSession(Request $request)
    {
         $request->session()->forget('idUser');
         return 'success';
    }
}
