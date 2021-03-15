<?php

namespace App\Http\Controllers;
use DB;
use App\mod_buku;
use App\mod_promo;
use App\mod_promo_detail;
use App\mod_promo_view;

use Illuminate\Http\Request;

class c_promo extends Controller
{

    public function getPromo (Request $request){
        $limit = 10;
        $offset = 0;
        $getOffset = $request->offset;
        if($getOffset){
            if($getOffset == 1){
                $offset = 0;
            }
            else{
               $offset = ($getOffset-1)*10; 
            }
            
        }
        $name = $this->validasi($request->namaPromo);
        $result = [];
        try {
            // var_dump(strlen($name));
            if($name == 'error'){
                $stat = ['code'=>'401', 'description'=>'too much variable'];
                $data = ['status'=>$stat, 'result'=>'error'];
                return response()->json(['success'=>false, 'data'=>$data], 401);

            }else{
                
                $getBook = 
                        DB::table('ms_promo')
                        ->select('code_promo as codePromo', 'nama_promo as namaPromo', 'pre_order as jenisPO', 'tanggal_cetak as tanggalCetak', 
                        'gambar_buku as gambarBuku', 'is_del as aktif')
                        ->where('nama_promo','Like', '%'.$name.'%')
                        ->orderBy('nama_promo', 'asc')
                        ->limit($limit)
                        ->offset($offset)
                        ->get();
                        
                if(count($getBook)!=0){
                    return response()->json(['success'=>true, 'data'=>$getBook], 200);  
                }
                else{
                    $stat = ['code'=>'401', 'description'=>'doesnt match data'];
                    $data = ['status'=>$stat, 'result'=>'null'];
                    return response()->json(['success'=>false, 'data'=>$data], 401); 
                }
            }
                        
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
        
    }
    public function getdetail(Request $request){
        $codePromo = $request->codePromo;
        try {
            if($codePromo == 'error'){
                    $stat = ['code'=>'401', 'description'=>'too much variable'];
                    $data = ['status'=>$stat, 'result'=>'error'];
                    return response()->json(['success'=>false, 'data'=>$data], 401);

            }else{
                $dataval = [];
                $getPO = 
                        DB::table('ms_promo')
                        ->select('code_promo as codePromo', 'nama_promo as namaPromo', 'pre_order as jenisPO', 'tanggal_cetak as tanggalCetak', 
                        'harga_jadi as hargaJadi', 'berat_total as totalBerat',  'deskripsi as deskripsi', 'gambar_buku as gambarBuku', 'is_del as aktif')
                        ->where('code_promo','=', $codePromo)
                        ->first();
                $getBookPO = 
                        DB::table('ms_barang_promo')
                        ->select('ms_barang.id as idBuku', 'ms_barang.judul_buku as judulBuku')
                        ->join('ms_barang','ms_barang.id','=', 'ms_barang_promo.code_barang')
                        ->where('ms_barang_promo.code_promo','=', $codePromo)
                        ->get();
                
                $dataval = ['codePromo'=>$getPO->codePromo, 'namaPromo'=>$getPO->namaPromo, 
                'jenisPO'=>$getPO->jenisPO, 'hargaJadi'=>$getPO->hargaJadi, 'totalBerat'=>$getPO->totalBerat, 
                'tanggalCetak'=>$getPO->tanggalCetak, 'deskripsi'=>$getPO->deskripsi, 'gambarBuku'=>$getPO->gambarBuku, 'listBuku'=>$getBookPO];

                if($getPO){
                    return response()->json(['success'=>true, 'data'=>$dataval], 200);  
                }
                else{
                    $stat = ['code'=>'401', 'description'=>'doesnt match data'];
                    $data = ['status'=>$stat, 'result'=>'null'];
                    return response()->json(['success'=>false, 'data'=>$data], 401); 
                }
            }
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
        
    }
    public function addPromo(Request $request){
        $nama_promo = $this->validasinotnull($request->namaPromo, 'namaPromo');
        $pre_order = $this->validasiadd($request->jenisPO, 'int');
        $harga_jadi = $this->validasiadd($request->hargaJadi, 'int');
        // $berat_total = $this->validasiadd($request->totalBerat, 'string');
        $tanggal_cetak = $this->validasiadd($request->tanggalCetak, 'string');
        $deskripsi = $this->validasiadd($request->deskripsi, 'string');
        $buku = $request->listBuku;
        $gambar_buku = 'storage/default/no-image.png';
        try {
            if(substr($nama_promo,-4) =='null'){
                    $stat = ['code'=>'401', 'description'=>$nama_promo.'. Cant create data'];
                    $data = ['status'=>$stat, 'result'=>'error'];
                    return response()->json(['success'=>false, 'data'=>$data], 401);

            }else{
                $count = DB::table('ms_promo')
                ->select(DB::raw('COUNT(ms_promo.code_promo) as count'))
                ->first();

                $ldate = date('Y');
                $ldate1 = date('m');
                $ldate2 = date('d');
                $ldate3 = date('h');
                $ldate4 = date('i');
                $ldate5 = date('s');
                $tahun = substr($ldate,2);
           
                $c = $count->count;
                $kode = 'promo_' .$tahun.$ldate1.$ldate2.'_'.$ldate3.$ldate4.$ldate5.'_'.str_pad($c, 5, '0', STR_PAD_LEFT);
                
                // {"success":true,"data":[{"id":"211-AQP","judulBuku":"Berobatlah dengan Puasa dan Sedekah PRY"},{"id":"AQ-001","judulBuku":"40 Wasiat Nabi tentang Kesehatan PRY"}]}
                $berat = 0;
                foreach($buku as $bk){
                    // $rslt = $bk['id'];
                    $getBook = 
                        DB::table('ms_barang')
                        ->select('id as idBuku', 'berat as beratBuku')                        
                        ->where('id','=', $bk['idBuku'])
                        ->first();
                    $val = $getBook->beratBuku;
                    $berat = $berat + (int)$val;
                }

                mod_promo::create([
                    'code_promo' => $kode,
                    'nama_promo' => $nama_promo,
                    'pre_order' => $pre_order,
                    'harga_jadi' => $harga_jadi,
                    'berat_total' => $berat,
                    'tanggal_cetak' => $tanggal_cetak,
                    'gambar_buku' => $gambar_buku,
                    'deskripsi' => $deskripsi,
                    'is_del' => 0
                ]);

                // mod_promo_detail::create([
                //     'code_promo' => $idbook,
                //     'code_barang' => $code_barang
                // ]);
                $rslt;
                foreach($buku as $bk){
                    // $rslt = $bk['id'];
                    mod_promo_detail::create([
                        'code_promo' => $kode,
                        'code_barang' => $bk['idBuku']
                    ]);
                }
                return response()->json(['success'=>true, 'data'=>'success'], 200); 
            }
            
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }
    public function editPromo(Request $request){
        $codePromo = $this->validasinotnull($request->codePromo, 'Id');
        $nama_promo = $this->validasinotnull($request->namaPromo, 'namaPromo');
        $pre_order = $this->validasiadd($request->jenisPO, 'int');
        $harga_jadi = $this->validasiadd($request->hargaJadi, 'int');
        // $berat_total = $this->validasiadd($request->totalBerat, 'string');
        $tanggal_cetak = $this->validasiadd($request->tanggalCetak, 'string');
        $deskripsi = $this->validasiadd($request->deskripsi, 'string');
        $buku = $request->listBuku;
        $gambar_buku = 'storage/default/no-image.png';
        try {
            if(substr($codePromo,-4) =='null'){
                    $stat = ['code'=>'401', 'description'=>$codePromo.'. Cant edit data'];
                    $data = ['status'=>$stat, 'result'=>'error'];
                    return response()->json(['success'=>false, 'data'=>$data], 401);

            }else{

                $berat = 0;
                foreach($buku as $bk){
                    $idbook = $bk['idBuku'];
                    $getBook = 
                        DB::table('ms_barang')
                        ->select('id as idBuku', 'berat as beratBuku')                        
                        ->where('id','=', $idbook)
                        ->first();
                    $val = $getBook->beratBuku;
                    $berat = $berat + (int)$val;
                }
                
                mod_promo::where('code_promo', '=', $codePromo)
                        ->update
                        ([
                            'nama_promo' => $nama_promo,
                            'pre_order' => $pre_order,
                            'harga_jadi' => $harga_jadi,
                            'berat_total' => $berat,
                            'tanggal_cetak' => $tanggal_cetak,
                            'deskripsi' => $deskripsi
                        ]);

                // $res=mod_promo_detail::where('code_promo',$codePromo)->delete();
                DB::table('ms_barang_promo')->where('code_promo', $codePromo)->delete();

                $rslt;
                foreach($buku as $bk){
                    // $rslt = $bk['idBuku'];
                    mod_promo_detail::create([
                        'code_promo' => $codePromo,
                        'code_barang' => $bk['idBuku']
                    ]);
                }
            }
            return response()->json(['success'=>true, 'data'=>'success'], 200); 
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }
    public function getShowPromo(Request $request){
        try {
            
                $getView = 
                        DB::table('ms_promo_view')
                        ->select('id','type')                        
                        ->where('id','=', 1)
                        ->first();               
            
            return response()->json(['success'=>true, 'data'=>$getView ], 200); 
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }
    public function showstore(Request $request){
        try {
                $getView = 
                        DB::table('ms_promo_view')
                        ->select('id as idView','type')                        
                        ->where('id','=', 1)
                        ->first();
                $params;
                if ($getView->type == 0){
                    $params = 1;
                }else{
                    $params = 0;
                }
                
                mod_promo_view::where('id', '=', 1)
                        ->update
                        ([                            
                            'type' => $params
                        ]);
            return response()->json(['success'=>true, 'data'=>'success' ], 200); 
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }

    public function validasi($req){
        if(strlen($req) > 17){
            return 'error';
        }else{
            return $req;
        }
    }
    public function validasiadd($req, $type){
        $rslt;
        if(strlen($req) == 0){
            if($type == 'int'){
                $rslt= 0;
            }else{$rslt='-';}
            
        }else{
            $rslt=$req;
        }
        return $req;
    }
    public function validasinotnull($req, $string){
        $rslt;
        // if(strlen($req) < 1){
        //     $rslt = $string.' cant null';
        // }else{
        //     $rslt = $req;
        // }
        $rslt = $req;
        return $rslt;
    }
}
