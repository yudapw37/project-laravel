<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\mod_buku;
use App\mod_gambar_buku;

class c_buku extends Controller
{
    
    public function getBuku (Request $request){
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
                
                $getBook = 
                        DB::table('ms_barang')
                        ->select('id as idBuku', 'judul_buku as judulBuku', 'harga as hargaBuku', 'gambar_buku as gambarBuku', 'store as showStore')
                        ->where('judul_buku','Like', '%'.$name.'%')
                        ->orderBy('judul_buku', 'asc')
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
        $idbook = $this->validasi($request->idBuku);
        try {
            if($idbook == 'error'){
                    $stat = ['code'=>'401', 'description'=>'too much variable'];
                    $data = ['status'=>$stat, 'result'=>'error'];
                    return response()->json(['success'=>false, 'data'=>$data], 401);

            }else{
                
                $getBook = 
                        DB::table('ms_barang')
                        ->select('id as idBuku', 'judul_buku as judulBuku', 'harga as hargaBuku','isbn as isbnBuku', 
                         'barcode as barcodeBuku', 'berat as beratBuku', 'kategori as kategoriBuku', 'status as statusBuku', 
                         'halaman as halamanBuku', 'ukuran as ukuranBuku', 'cover as coverBuku', 'penulis as penulisBuku', 
                         'penerbit as penerbitBuku', 'tahun as tahunBuku', 'gambar_buku as gambarBuku', 'store as showBuku', 'diskripsi as deskripsiBuku')                        
                        ->where('id','=', $idbook)
                        ->first();

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
    public function addbook(Request $request){
        $idbook = $this->validasinotnull($request->idBuku, 'Id');
        $barcode = $this->validasiadd($request->barcodeBuku, 'string');
        $berat = $this->validasiadd($request->beratBuku, 'int');
        $kategori = $this->validasiadd($request->kategoriBuku, 'string');
        $status = $this->validasiadd($request->statusBuku, 'string');
        $judul_buku = $this->validasiadd($request->judulBuku, 'string');
        $harga = $this->validasiadd($request->hargaBuku, 'int');
        $halaman = $this->validasiadd($request->halamanBuku, 'string');
        $ukuran = $this->validasiadd($request->ukuranBuku, 'string');
        $cover = $this->validasiadd($request->coverBuku, 'string');
        $penulis = $this->validasiadd($request->penulisBuku, 'string');
        $isbn = $this->validasiadd($request->isbnBuku, 'string');
        $penerbit = $this->validasiadd($request->penerbitBuku, 'string');
        $tahun = $this->validasiadd($request->tahunBuku, 'string');
        $diskripsi = $this->validasiadd($request->deskripsiBuku, 'string');
        $gambar_buku = 'storage/default/no-image.png';
        try {
            if(substr($idbook,-4) =='null'){
                    $stat = ['code'=>'401', 'description'=>$idbook.'. Cant create data'];
                    $data = ['status'=>$stat, 'result'=>'error'];
                    return response()->json(['success'=>false, 'data'=>$data], 401);

            }else{
                
                mod_buku::create([
                    'id' => $idbook,
                    'barcode' => $barcode,
                    'berat' => $berat,
                    'kategori' => $kategori,
                    'status' => $status,
                    'judul_buku' => $judul_buku,
                    'harga' => $harga,
                    'halaman' => $halaman,
                    'ukuran' => $ukuran,
                    'cover' => $cover,
                    'penulis' => $penulis,
                    'isbn' => $isbn,
                    'penerbit' => $penerbit,
                    'tahun' => $tahun,
                    'diskripsi' => $diskripsi,
                    'gambar_buku' => $gambar_buku,
                    'store' => 'N'
                ]);
            }
            return response()->json(['success'=>true, 'data'=>'success'], 200); 
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }
    public function editbook(Request $request){
        $idbook = $this->validasinotnull($request->idBuku, 'Id');
        $barcode = $request->barcodeBuku;
        $berat = $request->beratBuku;
        $kategori = $request->kategoriBuku;
        $status = $request->statusBuku;
        $judul_buku = $request->judulBuku;
        $harga = $request->hargaBuku;
        $halaman = $request->halamanBuku;
        $ukuran = $request->ukuranBuku;
        $cover = $request->coverBuku;
        $penulis = $request->penulisBuku;
        $isbn = $request->isbnBuku;
        $penerbit = $request->penerbitBuku;
        $tahun = $request->tahunBuku;
        $diskripsi = $request->deskripsiBuku;
        $gambar_buku = $request->gambarBuku;
        try {
            if(substr($idbook,-4) =='null'){
                    $stat = ['code'=>'401', 'description'=>$idbook.'. Cant edit data'];
                    $data = ['status'=>$stat, 'result'=>'error'];
                    return response()->json(['success'=>false, 'data'=>$data], 401);

            }else{
                
                mod_buku::where('id', '=', $idbook)
                        ->update
                        ([
                            'barcode' => $barcode,
                            'berat' => $berat,
                            'kategori' => $kategori,
                            'status' => $status,
                            'judul_buku' => $judul_buku,
                            'harga' => $harga,
                            'halaman' => $halaman,
                            'ukuran' => $ukuran,
                            'cover' => $cover,
                            'penulis' => $penulis,
                            'isbn' => $isbn,
                            'penerbit' => $penerbit,
                            'tahun' => $tahun,
                            'diskripsi' => $diskripsi,
                            'gambar_buku' => $gambar_buku
                        ]);
            }
            return response()->json(['success'=>true, 'data'=>'success'], 200); 
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }
    public function showstore(Request $request){
        $idbook = $this->validasinotnull($request->idBuku, 'Id');
        try {
            if(substr($idbook,-4) =='null'){
                    $stat = ['code'=>'401', 'description'=>$idbook.'. Cant edit data'];
                    $data = ['status'=>$stat, 'result'=>'error'];
                    return response()->json(['success'=>false, 'data'=>$data], 401);

            }else{
                $getBook = 
                        DB::table('ms_barang')
                        ->select('id as idBuku','store')                        
                        ->where('id','=', $idbook)
                        ->first();
                $params;
                if ($getBook->store == 'Y'){
                    $params = 'N';
                }else{
                    $params = 'Y';
                }
                
                mod_buku::where('id', '=', $idbook)
                        ->update
                        ([                            
                            'store' => $params
                        ]);
            }
            return response()->json(['success'=>true, 'data'=>'success update '.$idbook. ' from '.$getBook->store.' to '.$params ], 200); 
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }
    public function addimage(Request $request){
        $idbook = $this->validasinotnull($request->idBuku, 'Id');
        $gambar_buku = $request->gambar;
        try {
            if(substr($idbook,-4) =='null'){
                    $stat = ['code'=>'401', 'description'=>$idbook.'. Cant add data'];
                    $data = ['status'=>$stat, 'result'=>'error'];
                    return response()->json(['success'=>false, 'data'=>$data], 401);

            }else{                
                mod_gambar_buku::create([
                    'id_buku' => $idbook,
                    'gambar' => $gambar
                ]);
            }
            return response()->json(['success'=>true, 'data'=>'success'], 200); 
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }


    public function validasi($req){
        if(strlen($req) > 12){
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
