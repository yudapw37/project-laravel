<?php

namespace App\Http\Controllers;

use App\mod_barang_trn;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\Psr7\str;

class c_barangGudang extends Controller
{
    public function addBarangTrn(Request $request) {
        $token = $request->token;
        $codeBarang = $request->codeBarang;
        $jml = $request->jml;
        $lokasiGudang = $request->lokasiGudang;


        try {
            if($token=='kw89r7nm79')
            {
                DB::beginTransaction();
                $transaksi = new mod_barang_trn();
                $transaksi->code_barang = $codeBarang;
                $transaksi->d = $jml;
                $transaksi->lokasiGudang = $lokasiGudang;
                $transaksi->save();

                DB::commit();
                $result='success';    
                    }
                    else
                    {
                        $result = 'Invalid Token';   
                    }  
                    return response()->json($result); 
            } catch (\Exception $ex) {
                DB::rollBack();
                return response()->json($transaksi);
            }
        }
    

        public function updateBarangTrn(Request $request) {
            $token = $request->token;
            $codeBarang = $request->codeBarang;
            $jml = $request->jml;
            $lokasiGudang = $request->lokasiGudang;
    
    
            try {
                if($token=='23dkr7nm11')
                {
                    DB::beginTransaction();
                    DB::table('ms_barang_trn')
                    ->where('code_barang','=',$codeBarang)
                    ->update([
                        'k' => $jml,
                        'lokasiGudang'=>$lokasiGudang,
                    ]);
                    $result='success';    
                        }
                        else
                        {
                            $result = 'Invalid Token';   
                        }  
                        return response()->json($result); 
            } catch (\Exception $ex) {
                DB::rollBack();
                return response()->json($ex);
            }
        }

        public function getBarangTrn(Request $request) {
            $token = $request->token;
            $code_barang = $request->codeBarang;
            $namaBuku = $request->namaBuku;
            $offset  = $request->offset;
            try {
                if($token=='4f397id1ot')
                {
                    $result= [
                        'data' => $this->getAllItem_($code_barang,$namaBuku,$offset),
                        'count' => $this->getCount_($code_barang,$namaBuku),
                    ];
        
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
        
            public function getAllItem_($code_barang,$namaBuku,$offset) {
        
                if($offset){$offset=(int)$offset;}
                else{$offset=0;}
                try {
        
                    $result = [];
                            $result = 
                                     DB::table('ms_barang_trn')
                                     ->select('ms_barang_trn.code_barang as code_barang','ms_barang.judul_buku as judul_buku','ms_barang.berat as berat','ms_barang.harga as harga', DB::raw('(ms_barang_trn.d - ms_barang_trn.k) as stock'),'ms_barang_trn.lokasiGudang as lokasiGudang')
                                     ->join('ms_barang','ms_barang.id','=','ms_barang_trn.code_barang')
                              
                                      ->orWhere('ms_barang.judul_buku','like', '%'.$namaBuku.'%')
                                      ->orWhere('ms_barang_trn.code_barang','like', '%'.$code_barang.'%')
                                    //   ->limit(10)
                                    //   ->offset($offset)
                                      ->get();
            
                            return $result; 
                } catch (\Exception $ex) {
                    return response()->json($ex);
                }
            }
            public function getCount_($code_barang,$namaBuku) {
            
                try {
          
                    $result = [];
                            $result = 
                                     DB::table('ms_barang_trn')
                                     ->select(DB::raw('Count(ms_barang_trn.id) as count'))
                                     ->join('ms_barang','ms_barang.id','=','ms_barang_trn.code_barang')
                                     ->orWhere('ms_barang.judul_buku','like', '%'.$namaBuku.'%')
                                     ->orWhere('ms_barang_trn.code_barang','like', '%'.$code_barang.'%')  
                           
                                    ->first();
           
                            return $result; 
                } catch (\Exception $ex) {
                    return response()->json($ex);
                }
            }
        
            
}
