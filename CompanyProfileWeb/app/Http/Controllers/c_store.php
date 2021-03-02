<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mod_store;

class c_store extends Controller
{
    public function get(Request $request){
        $hargaFrom = 0;
        $hargaTo = 999999999999999;
        if($request->hargaawal){
            $hargaFrom = $request->hargaawal;
        }
        if($request->hargaakhir){
            $hargaTo = $request->hargaakhir;
        }
        $store = mod_store::select('id as isdtore','cd_properti','judul','harga','lt','lb','foto')
        ->where('id_kota','=',$request->idkota)
        ->where('id_area','=',$request->idarea)
        ->where('id_pic','=',$request->idpic)
        ->whereBetween('harga', [$hargaFrom, $hargaTo])
        ->where('status','=',$request->status)
        ->where('tipe','=',$request->tipe)
        ->where('ac','=',$request->ac)
        ->where('mesincuci','=',$request->mesincuci)
        ->where('bathup','=',$request->bathup)
        ->where('microwave','=',$request->microwave)
        ->where('taman','=',$request->taman)
        ->where('fitnes','=',$request->fitnes)
        ->where('tvcable','=',$request->tvcable)
        ->where('kolam','=',$request->kolam)
        ->where('heater','=',$request->heater)
        ->where('kulkas','=',$request->kulkas)
        ->where('wifi','=',$request->wifi)
        ->where('is_del','=',0)
        ->orderBy('created_at', 'asc')->get();
        return $store;
    }
    public function detail($idstore){
        $storedetail = mod_store::where('id','=',$idstore)->orderBy('created_at', 'asc')->first();
        return $storedetail;
    }
}
