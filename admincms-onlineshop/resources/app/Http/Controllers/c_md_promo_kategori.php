<?php

namespace App\Http\Controllers;

use App\mod_md_ms_kategori_promo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class c_md_promo_kategori extends Controller
{
    public function index() {
        return view('dashboard.master-data.promo-kategori.baru');
    }

    public function list() {
        return view('dashboard.master-data.promo-kategori.list');
    }

    public function edit($id) {
        $data = DB::table('ms_kategori_promo')
        ->where('id','=',$id)->first();
       
        return view('dashboard.master-data.promo-kategori.edit')->with('data',$data);
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
        $id = $request->id;
        $kategori = $request->kategori;
  
        try {
            DB::beginTransaction();

            if ($type == 'baru') {
           
                        $userPermission = new mod_md_ms_kategori_promo();
                        $userPermission->kategori = $kategori;
                        $userPermission->save();
                    $result = 'success';
            } elseif ($type == 'edit') {
                DB::table('ms_kategori_promo')
                    ->where('id','=',$id)
                    ->update([
                        'kategori' => $kategori
                    ]);
                $result = 'success';
            }
            DB::commit();
            return $result;
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json($ex);
        }
    }

    public function disable(Request $request) {
        $id = $request->id;
        try {
            DB::table('ms_kategori_promo')
            ->where('id','=',$id)
            ->update([
                'status' => 1
            ]);
        $result = 'success';
        } catch (\Exception $ex) {
            DB::rollBack();
            return json_encode([$ex]);
        }
    }
    public function activate(Request $request) {
        $id = $request->id;
        try {
            DB::table('ms_kategori_promo')
            ->where('id','=',$id)
            ->update([
                'status' => 0
     
            ]);
        $result = 'success';
        } catch (\Exception $ex) {
            DB::rollBack();
            return json_encode([$ex]);
        }
    }

    public function delete(Request $request) {
        $id = $request->id;
        try {
            DB::beginTransaction();
            DB::table('ms_kategori_promo')->where('id','=',$id)->delete();
            DB::commit();
            return 'success';
        } catch (\Exception $ex) {
            DB::rollBack();
            return json_encode([$ex]);
        }
    }
}