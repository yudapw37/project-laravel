<?php

namespace App\Http\Controllers;

use App\mod_ms_review_gmbr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class c_md_review extends Controller
{
    public function index() {
        return view('dashboard.umpan-balik.review.baru');
    }

    public function list() {
        return view('dashboard.umpan-balik.review.list');
    }

    public function edit($id) {
        $data = DB::table('ms_barang')
        ->select('judul_buku as name')
        ->where('id','=',$id)->first();
        $dtCheck = DB::table('ms_kategori_trn')->select('id_kategori')->where('id_buku','=',$id)->get();
        $check = [];
        foreach ($dtCheck as $c) {
            $check[] = $c->id_kategori;
        }
        return view('dashboard.master-data.buku-kategori-inprint.edit')->with('data',$data)->with('check',$check);
    }

    public function data(Request $request) {
        try {
            $images = DB::table('ms_review_gmbr')
                ->select('id','path as filename')
                ->orderBy('created_at','asc')
                ->get();
            return json_encode($images);
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
        }

   
    public function submit(Request $request) {
           $file = $request->file('filepond');
        $extension = $request->file('filepond')->getClientOriginalExtension();
   
        try {
            DB::beginTransaction();
            $id = Uuid::uuid1()->toString();
            $fileName = $id.'.'.$extension;
            Storage::putFileAs('public', $file, $fileName);
            $image = new mod_ms_review_gmbr();
            $nama = 'storage/'.$fileName;
            $image->path = $nama;
            $image->save();
            DB::commit();
            // return 'success';
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json($ex);
        }

       
    }

    public function delete(Request $request) {
        try {
         
            // Storage::disk('url')->delete($image->gambar);
            DB::table('ms_review_gmbr')->where('id','=',$request->id)->delete();
            return 'success';
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }
}
