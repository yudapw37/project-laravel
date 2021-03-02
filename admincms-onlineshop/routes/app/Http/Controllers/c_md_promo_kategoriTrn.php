<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class c_md_promo_kategoriTrn extends Controller
{
    public function index() {
        return view('dashboard.master-data.promo-kategori.baru');
    }

    public function list() {
        return view('dashboard.master-data.promo-kategori.list');
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
        return view('dashboard.master-data.promo-kategori.edit')->with('data',$data)->with('check',$check);
    }

    public function data(Request $request) {
        $filters = $request->filters;
        $query = DB::table('ms_kategori_promo');
        if(@$filters){
            $query->where('kategori','LIKE','%'.$filters.'%');
        }
        return $query->paginate(20);
    }

   
    public function submit(Request $request) {
        $result = '';
        $type = $request->type;
        $kategori = $request->kategori;
  
        try {
            DB::beginTransaction();

            if ($type == 'baru') {
           
                        $userPermission = new mod_md_ms_kategori_promo();
                        $userPermission->kategori = $kategori;
                        $userPermission->save();
                    $result = 'success';
            } elseif ($type == 'edit') {
                DB::table('users')
                    ->where('username','=',$username)
                    ->update([
                        'name' => $name,
                        'system' => $system
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
            DB::table('ms_barang')->where('id','=',$id)->delete();
            DB::commit();
            return 'success';
        } catch (\Exception $ex) {
            DB::rollBack();
            return json_encode([$ex]);
        }
    }
}