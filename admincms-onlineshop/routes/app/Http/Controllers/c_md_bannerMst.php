<?php

namespace App\Http\Controllers;

use App\Http\Controllers\OpenFunction\login;
use App\mod_md_ms_slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class c_md_bannerMst extends Controller
{
    public function index() {
        return view('dashboard.menu-lainnya.banner-mst.baru');
    }

    public function delete(Request $request) {
        try {
            $image = DB::table('ms_slider')->where('id','=',$request->id)->first();
            // Storage::disk('url')->delete($image->gambar);
            DB::table('ms_slider')->where('id','=',$request->id)->delete();
            return 'success';
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }


    public function upload(Request $request) {
        $file = $request->file('filepond');
        $extension = $request->file('filepond')->getClientOriginalExtension();
      
        try {
            $id = Uuid::uuid1()->toString();
            $fileName = $id.'.'.$extension;
            Storage::putFileAs('public', $file, $fileName);
            $image = new mod_md_ms_slider();
            $nama = 'storage/'.$fileName;
            $image->gambar = $nama;
            $image->save();
        } catch (\Exception $ex) {
            return response()->json($ex);
        }

        return 'success';
    }
}
