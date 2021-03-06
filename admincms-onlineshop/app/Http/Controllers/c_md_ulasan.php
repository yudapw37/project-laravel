<?php

namespace App\Http\Controllers;
use App\mod_ms_review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class c_md_ulasan extends Controller
{
    public function index() {
        return view('dashboard.umpan-balik.ulasan.baru');
    }

    public function list() {
        return view('dashboard.umpan-balik.ulasan.list');
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

        $data['data'] =  DB::table('ms_review')
        ->select('ms_review.id as id','ms_barang.judul_buku as judulBuku', 'ms_review.nama_reviewer as namaReviewer','ms_review.text as text','ms_review.rating as rating','ms_review.status as status')
        ->join('ms_barang','ms_barang.id','=','ms_review.id_buku')
        ->where('ms_review.type','=','ul')
        ->get();
        return json_encode($data);
    }

   
    public function submit(Request $request) {
        $result = '';
        $type = $request->type;
        $idBuku = $request->id;
        $namaReviewer = $request->namaReviewer;
        $text = $request->review;
        $rating = $request->ratings;
        try {
            DB::beginTransaction();

            if ($type == 'baru') {  
                $ldate = date('Y');
                $ldate1 = date('m');
                $ldate2 = date('d');
                $ldate3 = date('h');
                $ldate4 = date('i');
                $ldate5 = date('s');
                $tahun = substr($ldate,2);
                $count = DB::table('ms_review')
                ->select(DB::raw('COUNT(ms_review.id) as count'))
                ->first();
                $c = $count->count;
                $kode = $tahun.$ldate1.$ldate2.'_'.$ldate3.$ldate4.$ldate5.'_'.str_pad($c, 5, '0', STR_PAD_LEFT);
                        $userPermission = new mod_ms_review();
                        $userPermission->id_buku = $idBuku;
                        $userPermission->type = 'rvw';
                        $userPermission->id_reviewer = $kode;
                        $userPermission->nama_reviewer = $namaReviewer;
                        $userPermission->text = $text;
                        $userPermission->rating = $rating;
                        $userPermission->save();
                    $result = 'success';
            } elseif ($type == 'edit') {
         
                    $userPermission = new sysPermission();
                    $userPermission->username = $username;
                    $userPermission->id_menu = $p;
                    $userPermission->save();
          
                $result = 'success';
            }
            DB::commit();
            return $result;
        } catch (\Exception $ex) {
            DB::rollBack();
            return $ex;
        }
    }

    public function delete(Request $request) {
        $id = $request->id;
        try {
            DB::beginTransaction();
            DB::table('ms_review')->where('id','=',$id)->delete();
            DB::commit();
            return 'success';
        } catch (\Exception $ex) {
            DB::rollBack();
            return json_encode([$ex]);
        }
    }

    
    public function disable(Request $request) {
        $id = $request->id;
        try {
            DB::beginTransaction();
            DB::table('ms_review')->where('id','=',$id)
                ->update([
                    'status' => 1
                ]);
            DB::commit();
            return 'success';
        } catch (\Exception $ex) {
            DB::rollBack();
            return json_encode([$ex]);
        }
    }

    public function activate(Request $request) {
        $id = $request->id;
        try {
            DB::beginTransaction();
            DB::table('ms_review')->where('id','=',$id)
                ->update([
                    'status' => 0
                ]);
            DB::commit();
            return 'success';
        } catch (\Exception $ex) {
            DB::rollBack();
            return json_encode([$ex]);
        }
    }
}

