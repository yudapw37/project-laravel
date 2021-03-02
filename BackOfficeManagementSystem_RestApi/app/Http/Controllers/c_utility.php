<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\Psr7\str;

class c_utility extends Controller
{
    public function getMsJabatan() {
        try {
            $result = [];
                    $result = 
                             DB::table('ms_jabatan')
                             ->select('ms_jabatan.id_jabatan as id','ms_jabatan.jabatan as jabatan')
                             ->where('ms_jabatan.id_jabatan','<>','A001')
                             ->get();
                    
            return response()->json($result);
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
       }

       public function getMsKategori(Request $request) {
	 $token = $request->token;
        try {
            if($token=='nzrkw6rlez')
            {
            $result = [];
                    $result = 
                             DB::table('ms_kategori_buku')
                             ->select('ms_kategori_buku.id as id','ms_kategori_buku.nama_kategori as kategori')
                             ->get();
            }
            else
            {
                $result = 'Invalid Token';   
            }  
            return response()->json($result); 
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
       }

       public function getMsGudang(Request $request) {
        $token = $request->token;
           try {
               if($token=='kslkw6rlez')
               {
               $result = [];
                       $result = 
                                DB::table('ms_barang_gudang')
                                ->select('ms_barang_gudang.id as id','ms_barang_gudang.code_gudang as codeGudang','ms_barang_gudang.nama_gudang as namaGudang','ms_barang_gudang.alamat as alamat')
                                ->where('ms_barang_gudang.is_del','=','0')
                                ->get();
               }
               else
               {
                   $result = 'Invalid Token';   
               }  
               return response()->json($result); 
           } catch (\Exception $ex) {
               return response()->json($ex);
           }
          }
}
