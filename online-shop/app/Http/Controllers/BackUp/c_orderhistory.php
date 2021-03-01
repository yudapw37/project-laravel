<?php

namespace App\Http\Controllers;
use App\mod_transaksi;
use App\mod_order;
use App\mod_customer;
use App\mod_invoice;
use App\mod_invoice_detail;
use App\mod_categories;
use App\mod_headerfooter;
use App\mod_cart;
use Illuminate\Http\Request;

class c_orderhistory extends Controller
{
    public function index(Request $request){
        $page = $request->page;
        $ordInput = $request->ordInput;

        if ($request->session()->has('idUser')){
            $idUser=$request->session()->get('idUser');
            $idOrder = mod_order::where('code_customer', '=', $idUser )->pluck('id');          
            $code_order = mod_transaksi::whereIn('code_order',  $idOrder )
            ->where('code_status','=', '10' )->pluck('code_order');
            $order = mod_order::select('id as idOrder','nama_penerima','alamat','total_harga','biayaExpedisi','totalDiskon','created_at','updated_at')
            ->whereIn('id',  $code_order )->where('nama_penerima', 'like' ,'%'.$ordInput.'%' )
            ->orderBy('updated_at', 'DESC')->where('code_customer', '=', $idUser )->skip($page)->take(5)->get(); 
            return $order;
            // if($order){ return $order;}
            // else{return 'null';}
        }else{
            return 'login';
        }
            
    }
    public function count(Request $request){
        $page = $request->page;
        $ordInput = $request->ordInput;
        if ($request->session()->has('idUser')){
            $idUser=$request->session()->get('idUser');
            $idOrder = mod_order::where('code_customer', '=', $idUser )->pluck('id');
            $idOrder = mod_order::where('code_customer', '=', $idUser )->pluck('id');
            $code_order = mod_transaksi::whereIn('code_order',  $idOrder )->where('code_status','=', '10' )->pluck('code_order');
            $count = mod_order::whereIn('id',  $code_order )->where('nama_penerima', 'like' ,'%'.$ordInput.'%' )->count(); 
            // $count = mod_transaksi::whereIn('code_order',  $idOrder )->where('code_status','=', '10' )->where('hold','=', '0' )->count();
            return $count;
        }else{
            return 'login';
        }
            
    }

    public function detail(Request $request, $id){


       $idUser=$request->session()->get('idUser');
       
        

            // $penerima = mod_penerima_alamat::orderBy('created_at', 'asc')->first();

            if ($request->session()->has('idUser')){
                if($request->session()->get('token')=='4qw4m5t0r3'){
                    $allcategories="";
                    $countcategories=0;
                    $totalberat=0;
                    $totalharga=0;
                    $totalbarang=0;
                    $totaldiskon=0;
                    $countCart =0;
                    $penerima ="";
                    $getBaseUrlEnv = env('APP_URL');
                    $pathPublic = '1m4g3st0r3/';
                    $getBaseUrl = 'http://storeaqwam.cemaraitsalatiga.com/';

                        $categories = mod_categories::orderBy('created_at', 'asc')->get();
                        $headerfooter = mod_headerfooter::orderBy('created_at', 'asc')->get();

                        $headerphone = mod_headerfooter::where('type', '=', 'header_phone')->first();
                        $footerphone1 = mod_headerfooter::where('type', '=', 'footer_phone1')->first();
                        $footeraddrs1 = mod_headerfooter::where('type', '=', 'footer_addr1')->first();
                        $footerphone2 = mod_headerfooter::where('type', '=', 'footer_phone2')->first();
                        $footeraddrs2 = mod_headerfooter::where('type', '=', 'footer_addr2')->first();

                    $idUser=$request->session()->get('idUser');
                    $inv = mod_invoice::where('code_customer', '=', $idUser )->where('idOrder', '=', $id)->first();
                    $invdetail = mod_invoice_detail::where('code_order', '=', $id)->get();
                    // return $invdetail;

                    $username = $request->session()->get('username');
                    $nama = $request->session()->get('nama');
                    // $countCart = $this->getcount($username);
                    $user = mod_customer::where('username','=',$username)->first();
                    $diskon = $user->diskon;
                    $buku = mod_cart::select('id_buku as idBuku','judul_buku','harga', 'berat', 'jumlah')->where('username', '=', $username)->get();
                    if($buku){  
                        foreach($buku as $val=>$value){
                            $totalberat = $totalberat + ($value['berat'] * $value['jumlah']);
                            $totalharga = $totalharga + $value['harga'] * $value['jumlah'] ;                        
                            $totalbarang =  $totalbarang+ $value['jumlah'];
                        }
                        $totaldiskon = $totalharga - ($diskon * $totalharga)/100 ;
                        $totaldiskonrupiah = "Rp. " . number_format($totaldiskon,2,',','.');
                        $totalhargarupiah = "Rp. " . number_format($totalharga,2,',','.');
                
                        $pathhf = 'api/headerfooter';
                        $pathcs = 'api/categories';

                        return view('detailordhistory', ['pathhf'=>$pathhf, 'pathcs'=>$pathcs, 'getBaseUrlEnv'=>$getBaseUrlEnv, 
                        'headerphone'=>$headerphone, 'footerphone1'=>$footerphone1, 'footeraddrs1'=>$footeraddrs1, 'footerphone2'=>$footerphone2, 'footeraddrs2'=>$footeraddrs2,
                        'pathPublic'=>$pathPublic, 'getBaseUrl'=>$getBaseUrl, 'categories'=>$categories,'countcategories'=>$countcategories, 'allcategories'=>$allcategories,
                        'countCart'=>$countCart, 'nama'=>$nama, 'buku'=>$buku, 'penerima'=>$penerima, 'totalberat'=>$totalberat, 'totalharga'=>$totalharga,'totalbarang'=>$totalbarang, 
                        'totaldiskon'=>$totaldiskon, 'totaldiskonrupiah'=>$totaldiskonrupiah, 'totalhargarupiah'=>$totalhargarupiah, 'invdetail'=>$invdetail]);
                }
               }else{

                return redirect('/')->with('statusLogin', 'Login Dahulu!');
                }
            }else{

                return redirect('/')->with('statusLogin', 'Login Dahulu!');
            }


        // $id = $request->id;
        // if ($request->session()->has('idUser')){
        //     $idUser=$request->session()->get('idUser');
        //     $inv = mod_invoice::where('code_customer', '=', $idUser )->where('idOrder', '=', $id)->first();
        //     $invdetail = mod_invoice_detail::where('code_order', '=', $id)->get();
        //     return $invdetail;
        // }else{
        //     return 'login';
        // }
            
    }
}
