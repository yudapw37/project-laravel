<?php

namespace App\Http\Controllers;

use App\mod_md_ms_inprint_trn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class c_md_kategori_inprint extends Controller
{
    public function index() {
        return view('dashboard.master-data.buku-kategori-inprint.baru');
    }

    public function list() {
        return view('dashboard.master-data.buku-kategori-inprint.list');
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
        $filters = $request->filters;
        $query = DB::table('ms_inprint_trn')
        ->select('ms_inprint_trn.id as id','ms_barang.judul_buku as judulBuku', 'ms_inprint_mst.nama_inprint as namaKategori')
        ->join('ms_barang','ms_barang.id','=','ms_inprint_trn.id_buku')
        ->join('ms_inprint_mst','ms_inprint_mst.id_inprint','=','ms_inprint_trn.id_inprint');
        if(@$filters){
            $query->where('ms_barang.judul_buku','LIKE','%'.$filters.'%');
        }
        return $query->paginate(20);
    }

   
    public function submit(Request $request) {
        $result = '';
        $type = $request->type;
        $idBuku = $request->id;
        $permission = $request->permission;
        try {
            DB::beginTransaction();

            if ($type == 'baru') {
                $dtUser = DB::table('ms_inprint_trn')->where('id_buku','=',$idBuku);
                if ($dtUser->doesntExist()) {
                    foreach ($permission as $p) {
                        $userPermission = new mod_md_ms_inprint_trn();
                        $userPermission->id_inprint = $p;
                        $userPermission->id_buku = $idBuku;
                        $userPermission->save();
                    $result = 'success';
                } 
            }
            else
            {
                $result = 'Kategori Buku Sudah Ditambahkan';
            }
            } elseif ($type == 'edit') {
                DB::table('users')
                    ->where('username','=',$username)
                    ->update([
                        'name' => $name,
                        'system' => $system
                    ]);
                DB::table('sys_permission')->where('username','=',$username)->delete();
                foreach ($permission as $p) {
                    $userPermission = new sysPermission();
                    $userPermission->username = $username;
                    $userPermission->id_menu = $p;
                    $userPermission->save();
                }
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
