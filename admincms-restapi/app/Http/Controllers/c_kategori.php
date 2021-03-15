<?php

namespace App\Http\Controllers;
use DB;
use App\mod_buku;
use App\mod_imprint;
use App\mod_kategori;
use Illuminate\Http\Request;

class c_kategori extends Controller
{
    public function getkategori(Request $request){
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
        $name = $this->validasi($request->judul);
        $result = [];
        try {
            // var_dump(strlen($name));
            if($name == 'error'){
                $stat = ['code'=>'401', 'description'=>'too much variable'];
                $data = ['status'=>$stat, 'result'=>'error'];
                return response()->json(['success'=>false, 'data'=>$data], 401);

            }else{
                $dataval = [];
                $a=array();
                $getBook = 
                        DB::table('ms_barang')
                        ->select('id as idBuku', 'judul_buku as judulBuku')
                        ->where('judul_buku','Like', '%'.$name.'%')
                        ->orderBy('judul_buku', 'asc')
                        ->limit($limit)
                        ->offset($offset)
                        ->get();

                foreach($getBook as $var){
                    $getPenerbit = 
                        DB::table('ms_inprint_trn')
                        ->select('ms_inprint_mst.nama_inprint as namaPenerbit')
                        ->join('ms_inprint_mst', 'ms_inprint_mst.id_inprint', '=','ms_inprint_trn.id_inprint')
                        ->where('ms_inprint_trn.id_buku','=',  $var->idBuku)
                        ->first();

                    $getKategori = 
                        DB::table('ms_kategori_trn')
                        ->select('ms_kategori_buku.nama_kategori as namaKategori')
                        ->join('ms_kategori_buku', 'ms_kategori_buku.id_kategori', '=','ms_kategori_trn.id_kategori')
                        ->where('ms_kategori_trn.id_buku','=',  $var->idBuku)
                        ->get();
                    
                    $dataval = ['idBuku'=>$var->idBuku, 'judulBuku'=>$var->judulBuku, 
                    'penerbit'=>$getPenerbit->namaPenerbit, 'kategori'=>$getKategori];
                    array_push($a, $dataval);     
                }
                        
                if(count($a)!=0){
                    return response()->json(['success'=>true, 'data'=>$a], 200);  
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
    public function editkategori(Request $request){
        $idBuku = $this->validasinotnull($request->idBuku, 'Id');
        $codePenerbit = $request->codePenerbit;
        $kategori = $request->kategori;
        try {
            // var_dump(strlen($name));
            if(substr($idBuku,-4) =='null'){
                $stat = ['code'=>'401', 'description'=>'too much variable'];
                $data = ['status'=>$stat, 'result'=>'error'];
                return response()->json(['success'=>false, 'data'=>$data], 401);

            }else{
                $dataval = [];
                $a=array();

                mod_imprint::where('id_buku', '=', $idbook)
                        ->update
                        ([
                            'id_inprint' => $codePenerbit
                        ]);

                $deleteKategori = mod_kategori::where('id_buku', '=', $idbook)->delete();
                foreach($kategori as $var){
                    mod_kategori::where('id_buku', '=', $idbook)
                        ->update
                        ([
                            'id_kategori' => $var['codeKategori']
                        ]);     
                }
                        
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
