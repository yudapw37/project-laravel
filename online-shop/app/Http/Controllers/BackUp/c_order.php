<?php

namespace App\Http\Controllers;
use App\mod_transaksi;
use App\mod_order;
use App\mod_order_detail;
use App\mod_promo;
use App\mod_promo_detail;
use App\mod_buku;
use Illuminate\Http\Request;

class c_order extends Controller
{
    public function index(Request $request){
        $page = $request->page;

        if ($request->session()->has('idUser')){
            $idUser=$request->session()->get('idUser');
            $idOrder = mod_order::where('code_customer', '=', $idUser )->pluck('id as idOrd');
            $order = mod_transaksi::select('code_order','code_status','created_at','updated_at')->whereIn('code_order',  $idOrder )->where('code_status','<>', '10' )->where('hold','=', '0' )->orderBy('updated_at', 'DESC')->skip($page)->take(5)->get(); 
            if($order){ return $order;}
            else{return 'null';}
           
        }else{
            return 'login';
        }
            
    }
    public function count(Request $request){
        $page = $request->page;

        if ($request->session()->has('idUser')){
            $idUser=$request->session()->get('idUser');
            $idOrder = mod_order::where('code_customer', '=', $idUser )->pluck('id as idOrd');
            $count = mod_transaksi::whereIn('code_order',  $idOrder )->where('code_status','<>', '10' )->where('hold','=', '0' )->count();
            return $count;
        }else{
            return 'login';
        }
            
    }

    public function add(Request $request)
    {

        if ($request->session()->has('idUser')){
            $idUser=$request->session()->get('idUser');

            // $getwish = mod_wishlist::where('username', '=', $username )->where('id_buku', '=', $request->id )->first();
            // if($getwish){
            //     return 'Buku sudah ada di wishlist';
            // }else{
            //     mod_wishlist::create([
            //         // 'mapel' => strtoupper($request->mapel),
            //         'username' => $username,
            //         'id_buku' => $request->id,
            //     ]);
            //     return 'sukses';

            // }
        }else{
            return 'login';
        }
    }
    public function delete(Request $request){
        $id = $request->id;
        if ($request->session()->has('idUser')){
            $idUser=$request->session()->get('idUser');
            $delete = mod_invoice::where('code_customer', '=', $idUser )->where('idOrder', '=', $id)->delete();
            $deletedetail = mod_invoice_detail::where('code_order', '=', $id)->delete();
            if($delete){
                // $countbuku = mod_buku::whereIn('id', $idbuku )->count();
                $count = mod_invoice::where('code_customer', '=', $idUser )->count(); 
                return $count;               
            }else{
                return 'gagal delete';
            }
            
        }else{
            return 'login';
        }
            
    }
    public function detail(Request $request){
        $id = $request->id;
        $dataval = [];
        $a=array();
        $listbuku=array();

        $promocode = array("promo");
        $cekparam=0;
        if ($request->session()->has('idUser')){
            $idUser=$request->session()->get('idUser');          
            $ord = mod_order::where('code_customer', '=', $idUser )->where('id', '=', $id)->first();
            $orddetail = mod_order_detail::where('code_order', '=', $id)->get();

            foreach($orddetail as $ord1){
                if($ord1['code_promo']!='-'){
                    $codecek = $ord1['code_promo'];

                    if(!in_array($codecek,$promocode)){
                        // $cPromo += [$ord1['code_promo']=>'1'];
                         
                        array_push($promocode, $codecek);
                        $idpromodetail = mod_promo_detail::where('code_promo', '=', $ord1['code_promo'] )->pluck('code_barang');
                        $buku1 = mod_buku::select('id as idBuku','judul_buku')->whereIn('id', $idpromodetail )->get();
                        foreach($buku1 as $bk){ 
                            array_push($listbuku, $bk['judul_buku']);
                        }

                        $code = $ord1['code_promo'];   
                        $nama = [ 'nama' => $ord1['nama_promo'], 'buku'=> $listbuku];
                        $jumlah = $ord1['jumlah'];
                        $harga = $ord1['harga_promo'];
                        $diskon = $ord1['diskon'];
                        $total = $ord1['jumlah']*$ord1['harga_promo'];
                        $dataval = ['code'=>strtoupper($code), 'nama'=>$nama, 'jumlah' => $jumlah, 'harga' => $harga, 'diskon' => $diskon, 'total' => $total ];
                        array_push($a, $dataval);
                    }
                    else{
                        // break;
                    }

                    
                }else{
                    $buku2 = mod_buku::select('id as idBuku','judul_buku')->where('id','=', $ord1['code_barang'] )->first();
                    $code = $buku2->idBuku;
                    $nama = $buku2->judul_buku;
                    $jumlah = $ord1['jumlah'];
                    $harga = $ord1['harga'];
                    $diskon = $ord1['diskon'];
                    $total = $ord1['jumlah']*$ord1['harga'];
                    $dataval = ['code'=>strtoupper($code), 'nama'=>$nama, 'jumlah' => $jumlah, 'harga' => $harga, 'diskon' => $diskon, 'total' => $total ];
                    array_push($a, $dataval);
                }
                
                // break;
            }
            

            $data = ['ord'=>$ord, 'orddetail'=>$orddetail, 'a'=>$a];
            return $data;
        }else{
            return 'login';
        }
            
    }
    public function indexhold(Request $request){
        $page = $request->page;

        if ($request->session()->has('idUser')){
            $idUser=$request->session()->get('idUser');
            $idOrder = mod_order::where('code_customer', '=', $idUser )->pluck('id as idOrd');
            $order = mod_transaksi::select('code_order','code_status','created_at','updated_at')->whereIn('code_order',  $idOrder )->where('hold','=', '1' )->orderBy('updated_at', 'DESC')->skip($page)->take(5)->get(); 
            if($order){ return $order;}
            else{return 'null';}
           
        }else{
            return 'login';
        }
            
    }
    public function counthold(Request $request){
        $page = $request->page;

        if ($request->session()->has('idUser')){
            $idUser=$request->session()->get('idUser');
            $idOrder = mod_order::where('code_customer', '=', $idUser )->pluck('id as idOrd');
            $count = mod_transaksi::whereIn('code_order',  $idOrder )->where('hold','=', '1' )->count();
            return $count;
        }else{
            return 'login';
        }
            
    }
}
