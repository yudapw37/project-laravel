<?php

namespace App\Http\Controllers;
use DB;
use App\mod_buku;
use App\mod_promo_detail;
use App\mod_manage_product;
use Illuminate\Http\Request;

class c_hame_product extends Controller
{
    public function getProduct (Request $request){
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
        $type = $this->validasi($request->type);
        $result = [];
        try {
            // var_dump(strlen($name));
            if($type == 'error'){
                $stat = ['code'=>'401', 'description'=>'too much variable'];
                $data = ['status'=>$stat, 'result'=>'error'];
                return response()->json(['success'=>false, 'data'=>$data], 401);

            }else{
                
                $getBook = 
                        DB::table('ms_top_produk')
                        ->select('ms_top_produk.id as idProduct','ms_top_produk.judul_buku as judulBuku','ms_top_produk.kategori as kategori','ms_top_produk.typePO as typePO')
                        ->where('ms_top_produk.kategori','Like', '%'.$type.'%')
                        ->orderBy('ms_top_produk.kategori', 'asc')
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
    public function getDetailProduct (Request $request){       
        $idProduct = $this->validasi($request->idProduct);
        $result = [];
        try {
            
            if($idProduct =='error'){
                    $stat = ['code'=>'401', 'description'=>'too much variable'];
                    $data = ['status'=>$stat, 'result'=>'error'];
                    return response()->json(['success'=>false, 'data'=>$data], 401);

            }else{
                // var_dump($idProduct);
                $getBook = 
                        DB::table('ms_top_produk')
                        ->select('id as idProduct','id_buku as idBuku','judul_buku as judulBuku','kategori as kategori','typePO as typePO')
                        ->where('id','=', $idProduct)
                        ->first();
                // var_dump(count($getBook));        
                if($getBook){
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

    public function addProduct(Request $request){
        $buku = $request->judulBuku;
        $kategori = $this->validasiadd($request->kategori, 'string');
        $typePO = $this->validasiadd($request->typePO, 'int');
        // $berat_total = $this->validasiadd($request->totalBerat, 'string');
        $gambar_buku = 'storage/default/no-image.png';
        try {
                $idBuku= $buku[0]['id'];
                $hargaAwal = 0;
                $hargaJadi = 0;
                $gambar_buku = '';
                if($kategori == 'po'){
                    $getBook = 
                        DB::table('ms_promo')
                        ->select('code_promo as codePromo', 'nama_promo as nama', 'pre_order as jenisPO', 'tanggal_cetak as tanggalCetak', 
                        'harga_jadi as hargaJadi', 'berat_total as totalBerat',  'deskripsi as deskripsi', 'gambar_buku as gambarBuku', 'is_del as aktif')
                        ->where('code_promo','=', $idBuku)
                        ->first();
                    $cekBukuPromo =
                        DB::table('ms_barang_promo')
                        ->select('code_promo', 'code_barang')
                        ->where('code_promo','=', $idBuku)
                        ->get();
                        if(count($cekBukuPromo) < 2){
                            $getBukuPromo =
                            DB::table('ms_barang_promo')
                            ->select('code_promo', 'code_barang')
                            ->where('code_promo','=', $idBuku)
                            ->first();
                            $getbk = DB::table('ms_barang')
                            ->select('id','harga as hargaBuku', 'gambar_buku as gambarBuku')                        
                            ->where('id','=', $getBukuPromo->code_barang)
                            ->first();
                            $hargaAwal = $getbk->hargaBuku;
                            if($getBook->gambarBuku != 'storage/default/no-image.png'){
                               $gambar_buku = $getBook->gambarBuku; 
                            }else{
                               $gambar_buku = $getbk->gambarBuku; 
                            }                            
                        }else{
                            $varharga=0;
                            $code_barang = mod_promo_detail::where('code_promo', '=',$idBuku)->pluck('code_barang');
                            $getbk = mod_buku::select('id as idBuku','harga')->whereIn('id', $code_barang)->get();
                            foreach ($getbk as $bk){
                                $hargabk = $bk->harga;
                                $varharga +=$hargabk ;
                            }
                            $hargaAwal = $varharga;
                            $gambar_buku = $getBook->gambarBuku;
                        }
                     $hargaJadi = $getBook->hargaJadi;
                     
                }else{
                    $getBook = 
                        DB::table('ms_barang')
                        ->select('id as idBuku', 'judul_buku as nama', 'harga as hargaBuku', 'gambar_buku as gambarBuku', 'store as showBuku', 'diskripsi as deskripsiBuku')                        
                        ->where('id','=', $idBuku)
                        ->first();
                    $hargaAwal = $getBook->hargaBuku;
                    $gambar_buku = $getBook->gambarBuku;
                }
                mod_manage_product::create([
                    'id_buku' => $idBuku,
                    'judul_buku' => $getBook->nama,
                    'kategori' => $kategori,
                    'typePO' => $typePO,
                    'harga_buku' => $hargaAwal,
                    'harga_jadi' => $hargaJadi,
                    'gambar_buku' => $gambar_buku
                ]);
                
                return response()->json(['success'=>true, 'data'=>'success'], 200);             
            
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }
    public function deleteProduct(Request $request){
        $idProduct = $this->validasinotnull($request->idProduct, 'Id');
        try {
            if(substr($idProduct,-4) =='null'){
                    $stat = ['code'=>'401', 'description'=>$nama_promo.'. Cant create data'];
                    $data = ['status'=>$stat, 'result'=>'error'];
                    return response()->json(['success'=>false, 'data'=>$data], 401);

            }else{
                DB::table('ms_top_produk')->where('id', $idProduct)->delete();
                return response()->json(['success'=>true, 'data'=>'success'], 200); 
            }
            
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
        if(strlen($req) < 1){
            $rslt = $string.' cant null';
        }else{
            $rslt = $req;
        }
        return $rslt;
    }
}
