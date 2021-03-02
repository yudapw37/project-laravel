<?php

namespace App\Http\Controllers;

use App\mod_md_ms_kategori_trn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class c_md_buku_tipeTransaksi extends Controller
{
    public function index() {
        return view('dashboard.master-data.buku-tipeTransaksi.baru');
    }

    public function list() {
        return view('dashboard.master-data.buku-tipeTransaksi.list');
    }

    public function data(Request $request) {
        $data['data'] = DB::table('ms_barang')
        ->orderBy('ms_barang.judul_buku','ASC')
        ->get();
    return json_encode($data);

           
    }

    public function regulerPromo($id) {
   
        try {
            $query = DB::table('ms_barang')
                    ->where('id','=',$id)->first();
            if($query->jenis_pre_order_buku == '0'){$st = '1';}
            if($query->jenis_pre_order_buku == '1'){$st = '0';}
            DB::beginTransaction();
            DB::table('ms_barang')->where('id', '=', $id)
                        ->update(
                            ['jenis_pre_order_buku' => $st]
                        );
            DB::commit();
            return 'success';
        } catch (\Exception $ex) {
            DB::rollBack();
            return json_encode([$id]);
        }
    }

  
}

