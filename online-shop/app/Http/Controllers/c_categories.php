<?php

namespace App\Http\Controllers;
use App\mod_categories;
use App\mod_kategori_inprint;
use App\mod_kategori_promo;
use Illuminate\Http\Request;

class c_categories extends Controller
{
    public function getData(Request $request)
    {
        // $headerfooter = mod_headerfooter::orderBy('created_at', 'desc')->paginate(5);
        $categories = mod_categories::orderBy('created_at', 'asc')->get();
        return response()->json($categories);
        // return $headerfooter;
    }
    public function getDataInprint(Request $request)
    {
        // $headerfooter = mod_headerfooter::orderBy('created_at', 'desc')->paginate(5);
        $categories = mod_kategori_inprint::orderBy('created_at', 'asc')->get();
        return response()->json($categories);
        // return $headerfooter;
    }
    public function getDataSemua(Request $request)
    {
        
        $categories = mod_categories::orderBy('created_at', 'asc')->get();            
        return response()->json($categories);
    }
    public function getDataPenerbit(Request $request)
    {
        $categoriesinprint = mod_kategori_inprint::orderBy('id_inprint', 'asc')->get();
        return response()->json($categoriesinprint);
            
    }
    public function getDataPromo(Request $request)
    {
        $categoriespromo = mod_kategori_promo::select('id as idp', 'kategori')->where('status','=',0)->orderBy('created_at', 'asc')->get();
        return response()->json($categoriespromo);
        // return $headerfooter;
    }
}
