<?php

namespace App\Http\Controllers;
use App\mod_categories;
use App\mod_kategori_inprint;
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
}
