<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

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
        $name = $request->nameBook;
        $result = [];
        try {
            // var_dump(strlen($name));
            if(strlen($name) <= 12){
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
            }else{
                $stat = ['code'=>'401', 'description'=>'too much variable'];
                $data = ['status'=>$stat, 'result'=>'error'];
                return response()->json(['success'=>false, 'data'=>$data], 401);
            }
                        
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
        
    }
}
