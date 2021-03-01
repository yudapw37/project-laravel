<?php

namespace App\Http\Controllers;
use App\mod_headerfooter;
use Illuminate\Http\Request;

class c_headerfooter extends Controller
{
    public function getData(Request $request)
    {
        // $headerfooter = mod_headerfooter::orderBy('created_at', 'desc')->paginate(5);
        $headerfooter = mod_headerfooter::orderBy('created_at', 'asc')->get();
        return response()->json($headerfooter);
        // return $headerfooter;
    }
}
