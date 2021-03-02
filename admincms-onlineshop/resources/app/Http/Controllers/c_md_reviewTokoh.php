<?php
namespace App\Http\Controllers;
use App\mod_ms_review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;


class c_md_reviewTokoh extends Controller
{
    public function index() {
        return view('dashboard.umpan-balik.review-tokoh.baru');
    }

    public function list() {
        return view('dashboard.umpan-balik.review-tokoh.list');
    }

    public function edit($id) {
        $data = DB::table('ms_review')
        ->select('ms_review.id as id','ms_barang.judul_buku as judulBuku', 'ms_review.nama_reviewer as namaReviewer','ms_review.text as text','ms_review.rating as rating')
        ->join('ms_barang','ms_barang.id','=','ms_review.id_buku')
        ->where('ms_review.id','=',$id)
        ->first();
        return view('dashboard.umpan-balik.review-tokoh.edit')->with('data',$data);
    }

    public function data(Request $request) {
        $filters = $request->filters;
        $query = DB::table('ms_review')
        ->select('ms_review.id as id','ms_barang.judul_buku as judulBuku', 'ms_review.nama_reviewer as namaReviewer','ms_review.text as text','ms_review.rating as rating')
        ->join('ms_barang','ms_barang.id','=','ms_review.id_buku')
        ->where('ms_review.type','=','rvw');
        if(@$filters){
            $query->where('ms_barang.judul_buku','LIKE','%'.$filters.'%');
        }
        return $query->paginate(20);
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
         
                DB::table('ms_review')
                ->where('id','=',$request->id)
                ->update([
                    'nama_reviewer' => $namaReviewer,   
                    'text' => $text,   
                    'rating' => $rating,   
                ]);
          
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
}
