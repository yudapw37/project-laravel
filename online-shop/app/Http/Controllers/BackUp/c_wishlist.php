<?php

namespace App\Http\Controllers;
use App\mod_wishlist;
use App\mod_buku;

use App\mod_promo_detail;

use App\mod_promo;
use App\mod_barang_stock;

use Illuminate\Http\Request;

class c_wishlist extends Controller
{
    public function index(Request $request){
        $page = $request->page;
        $stock = 0;
        $dataval = [];
        $a=array();
        if ($request->session()->has('idUser')){
            $username=$request->session()->get('username');
            $idbuku = mod_wishlist::where('username', '=', $username )->skip($page)->take(5)->get();
            if($idbuku){
                foreach( $idbuku as $id){
                    // dd($id);
                    if(substr($id->id_buku,0,5)!='promo'){
                        $cart = mod_buku::select('id as idBuku','judul_buku','harga','penulis','isbn','cover','gambar_buku')->where('id','=', $id->id_buku )->get();
                        $getstock = mod_barang_stock::where('code_barang','=', $id->id_buku)->where('code_gudang', '=', 'Gd_001')->first();
                        $stck = $getstock->d - $getstock->k;
                        if($stck<1){$stock=0;}else{$stock = 1;}
                        foreach ($cart as $crt){
                            $harga = 0;
                            $cekpromo = mod_promo_detail::where('code_barang', '=', $crt->idBuku)->first();
                            if($cekpromo){
                                $getpromo = mod_promo_detail::where('code_promo', '=', $cekpromo->code_promo )->get();
                                if(count($getpromo) < 2){
                                    $promo = mod_promo::where('code_promo', '=', $cekpromo->code_promo )->first();
                                    $harga=$promo->harga_jadi;
                                }else{
                                    $harga = $crt->harga;
                                }
                            }else{
                                $harga = $crt->harga;
                            }
                            $dataval = ['idBuku'=>$crt->idBuku, 'judul_buku'=>$crt->judul_buku, 'harga' => $harga,'gambar' => $crt->gambar_buku,'stock'=>$stock, 'penulis' => $crt->penulis, 'isbn' => $crt->isbn , 'cover' => $crt->cover];
                            array_push($a, $dataval);
                        }
                    }else{
                        $prm = mod_promo::where('code_promo', '=',$id->id_buku )->get();
                       
                        foreach ($prm as $pr){
                            $harga = 0;
                            $prmdetail=mod_promo_detail::where('code_promo', '=',$pr->code_promo )->get();
                                foreach ($prmdetail as $prd){
                                    $getstock = mod_barang_stock::where('code_barang','=', $prd->code_barang)->where('code_gudang', '=', 'Gd_001')->first();
                                    $stck = $getstock->d - $getstock->k;
                                    if($stck<1){$stock=0;}
                                    if($stck<1){$stock=0;break;}else{$stock = 1;}
                                }                            
                                $dataval = ['idBuku'=>$pr->code_promo, 'judul_buku'=>$pr->nama_promo, 'harga' => $pr->harga_jadi,'gambar' => $pr->gambar_buku,'stock'=>$stock, 'penulis' => '-', 'isbn' => '-' , 'cover' => '-'];
                                array_push($a, $dataval);
                            }
                    }
                }
                    // $idbuku = mod_wishlist::where('username', '=', $username)->where('id_buku','not like', "%promo%")->pluck('id_buku');
                    

                    // $idprm = mod_wishlist::where('username', '=', $username)->where('id_buku','like', "%promo%")->pluck('id_buku');
                    $buku=$a;
                    return $buku; 
            // }
            // if($idbuku){
            //     // $countbuku = mod_buku::whereIn('id', $idbuku )->count();
            //     $buku = mod_buku::select('id as idBuku','judul_buku','harga','cover')->whereIn('id', $idbuku )
            //     ->skip($page)->take(5)->get();  
            //     return $buku;              
           }else{
               return 'null';
           }
            
        }else{
            return 'login';
        }
            
    }
    public function count(Request $request){
        $page = $request->page;

        if ($request->session()->has('idUser')){
            $username=$request->session()->get('username');
            $count = mod_wishlist::where('username', '=', $username )->count();
        //     if($idbuku){
        //         // $countbuku = mod_buku::whereIn('id', $idbuku )->count();
        //         $count = mod_buku::whereIn('id', $idbuku )->count();                
        //    }
            return $count;
        }else{
            return 'login';
        }
            
    }

    public function add(Request $request)
    {

        if ($request->session()->has('idUser')){
            $username=$request->session()->get('username');

            $getwish = mod_wishlist::where('username', '=', $username )->where('id_buku', '=', $request->id )->first();
            if($getwish){
                return 'Buku sudah ada di wishlist';
            }else{
                mod_wishlist::create([
                    // 'mapel' => strtoupper($request->mapel),
                    'username' => $username,
                    'id_buku' => $request->id,
                ]);
                return 'sukses';

            }
        }else{
            return 'login';
        }
    }
    public function delete(Request $request){
        $id = $request->id;
        if ($request->session()->has('idUser')){
            $username=$request->session()->get('username');
            $delete = mod_wishlist::where('username', '=', $username )->where('id_buku', '=', $id)->delete();
            if($delete){
                // $countbuku = mod_buku::whereIn('id', $idbuku )->count();
                $count = mod_wishlist::where('username', '=', $username )->count(); 
                return $count;               
            }else{
                return 'gagal delete';
            }
            
        }else{
            return 'login';
        }
            
    }
}
