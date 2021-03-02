<?php

namespace App\Http\Controllers;
use App\Http\Controllers\OpenFunction\login;
use App\ms_kategori_mobile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class c_md_kategoriMobile extends Controller
{
    public function index() {
        return view('dashboard.menu-lainnya.kategori-mobile.baru');
    }

    public function getImage(Request $request)
    {
        try {
            $images = DB::table('ms_kategori_mobile')
                ->select('id','gambar as filename')
                ->orderBy('created_at','asc')
                ->get();
            return json_encode($images);
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }

    public function delete(Request $request) {
        try {
            $image = DB::table('ms_kategori_mobile')->where('id','=',$request->id)->first();
            // Storage::disk('url')->delete($image->gambar);
            DB::table('ms_kategori_mobile')->where('id','=',$request->id)->delete();
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
            DB::table('ms_kategori_mobile')->where('id','=',$request->idX)
            ->update([
                'gambar' => 'storage/'.$fileName
            ]);
            DB::commit();
              
            return 'success';
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json($ex);
        }

       
    }
}
