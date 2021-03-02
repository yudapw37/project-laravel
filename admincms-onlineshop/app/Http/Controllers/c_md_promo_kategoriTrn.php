<?php

namespace App\Http\Controllers;

use App\mod_md_ms_kategori_promo_trn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class c_md_promo_kategoriTrn extends Controller
{
    public function index() {
        return view('dashboard.master-data.promo-kategori-trn.baru');
    }

    public function list() {
        return view('dashboard.master-data.promo-kategori-trn.list');
    }

    public function edit($id) {
        // $data = DB::table('ms_barang')
        // ->select('judul_buku as name')
        // ->where('id','=',$id)->first();
        // $dtCheck = DB::table('ms_kategori_trn')->select('id_kategori')->where('id_buku','=',$id)->get();
        // $check = [];
        // foreach ($dtCheck as $c) {
        //     $check[] = $c->id_kategori;
        // }
        // return view('dashboard.master-data.promo-kategori.edit')->with('data',$data)->with('check',$check);
        $data = DB::table('ms_kategori_promo_trn')
        ->where('id','=',$id)->first();
       
        return view('dashboard.master-data.promo-kategori-trn.edit')->with('data',$data);
    }

    public function data(Request $request) {
        $filters = $request->filters;
        $query = DB::table('ms_kategori_promo')
                ->select('ms_kategori_promo_trn.id as  id','ms_kategori_promo.id as  idKategoriPromo','ms_kategori_promo.kategori as kategori','ms_kategori_promo.status as status','ms_kategori_promo_trn.id_kategori as id_kategori',
                         'ms_promo.code_promo as code_promo','ms_promo.nama_promo as nama_promo')
                    ->join('ms_kategori_promo_trn','ms_kategori_promo_trn.id_kategori','=','ms_kategori_promo.id')
                    ->join('ms_promo','ms_promo.code_promo','=','ms_kategori_promo_trn.id_promo');
        if(@$filters){
            $query->where('kategori','LIKE','%'.$filters.'%');
        }
        return $query->paginate(20);
    }

   
    public function submit(Request $request) {
        $result = '';
        $type = $request->type;
        $kategori = $request->kategori;
        $promo = $request->promo;
  
        try {
            DB::beginTransaction();

            if ($type == 'baru') {
           
                        $msKategoriTrn = new mod_md_ms_kategori_promo_trn();
                        $msKategoriTrn->id_kategori = $kategori;
                        $msKategoriTrn->id_promo = $promo;
                        $msKategoriTrn->save();
                    $result = 'success';
            } elseif ($type == 'edit') {
                DB::table('ms_kategori_promo_trn')
                    ->where('id','=',$id)
                    ->update([
                        'id_kategori' => $kategori,
                        'id_promo' => $promo
                    ]);
                $result = 'success';
            }
            DB::commit();
            return $result;
        } catch (\Exception $ex) {
            DB::rollBack();
            $err = [$ex];
            return response()->json($err);
        }
    }

    public function delete(Request $request) {
        $id = $request->id;
        try {
            DB::beginTransaction();
            DB::table('ms_kategori_promo_trn')->where('id','=',$id)->delete();
            DB::commit();
            return 'success';
        } catch (\Exception $ex) {
            DB::rollBack();
            return json_encode([$ex]);
        }
    }
}