<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class c_md_bannerTrn extends Controller
{
    public function index() {
        return view('dashboard.menu-lainnya.banner-trn.baru');
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
            DB::beginTransaction();
            $id = Uuid::uuid1()->toString();
            $fileName = $id.'.'.$extension;
            Storage::putFileAs('public', $file, $fileName);
            $image = new mod_md_ms_slider();
            $nama = 'storage/'.$fileName;
            $image->gambar = $nama;
            $image->save();
            DB::commit();
            return 'success';
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json($ex);
        }

       
    }
}
