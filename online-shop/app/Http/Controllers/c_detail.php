<?php

namespace App\Http\Controllers;
use App\mod_categories;
use App\mod_headerfooter;

use App\mod_cart;
use App\mod_buku;
use App\mod_gambar_buku;
use App\mod_review;
use App\mod_ulasan;
use App\mod_barang_stock;
use App\mod_promo_detail;
use App\mod_promo;
use App\mod_promo_view;
use Illuminate\Http\Request;
use DB;

class c_detail extends Controller
{
    public function index($idBuku=null, Request $request)
    {
        $data = [];
        $a=array();
        $gmbrready='0';
        $allcategories="";
        $cekpromo="";
        $buku="";
        $gambar="";
        $review="";
        $ulasan="";
        $stockbuku="";
        $stockbukupromo=0;
        $hargaawal=0;
        $hargajadi=0;
        $countcategories=0;
        $reviewer=0;
        $reviewstars=0;
        $valpromo = 'reguler';
        $getBaseUrlEnv = env('APP_URL');
        // $pathPublic = '1m4g3st0r3/';
        $pathPublic = 'storage/';
        $getBaseUrl = 'https://aqwam.com/';
        $urlImage = 'https://admin.aqwam.com/';


        $idBuku = $idBuku;

        // $idBuku = '020-AUQ';

            $categories = mod_categories::orderBy('created_at', 'asc')->get();
            $headerfooter = mod_headerfooter::orderBy('created_at', 'asc')->get();

            // $countcategories = $categories->count();
            // if ($countcategories>7) {            
            //     $allcategories = mod_categories::orderBy('created_at', 'asc')->skip(7)->take($countcategories-6)->get();
            //     $categories = mod_categories::orderBy('created_at', 'asc')->skip(0)->take(7)->get();
            // }

            $headerphone = mod_headerfooter::where('type', '=', 'header_phone')->first();
            $footerphone1 = mod_headerfooter::where('type', '=', 'footer_phone1')->first();
            $footeraddrs1 = mod_headerfooter::where('type', '=', 'footer_addr1')->first();
            $footerphone2 = mod_headerfooter::where('type', '=', 'footer_phone2')->first();
            $footeraddrs2 = mod_headerfooter::where('type', '=', 'footer_addr2')->first();

            $promoview = mod_promo_view::first();
            $promoviewhome = $promoview->type;

            if(substr($idBuku,0,5)=='promo'){
                if($promoviewhome == 0){
                    return redirect('/')->with('statusLogin', 'Login Dahulu!');
                }else{
                    $valpromo = 'promo';
                    // dd($idBuku);
                    $cekstockprm=0;                
                    $buku = mod_promo::select('code_promo as idBuku','nama_promo','harga_jadi','gambar_buku','deskripsi','is_del')->where('code_promo', '=', $idBuku )->first();
                    if($buku->is_del==1){
                        return redirect('/')->with('statusLogin', 'Eror!');
                    }else{
                        $data = ['id'=>$buku->idBuku, 'gambar'=>$buku->gambar_buku ];
                        array_push($a, $data);
                        $gambarlist = mod_gambar_buku::where('id_buku', '=', $idBuku )->get();
                        foreach($gambarlist as $gmblist){
                            $data = ['id'=>$gmblist->id_buku, 'gambar'=>$gmblist->gambar ];
                            array_push($a, $data);
                        }
                        $gmbrready = '1';
                        $gambar = $a;
                        // dd($gambar);

                        $getpromo = mod_promo_detail::where('code_promo', '=', $idBuku )->get();
                        if(count($getpromo) < 2){
                            $promo = mod_promo::where('code_promo', '=', $idBuku )->first();
                            $getpromoall = mod_promo_detail::where('code_promo', '=', $idBuku )->first();
                            $bukupromo = mod_buku::select('harga')->where('id', '=', $getpromoall->code_barang )->first();
                            $hargajadi=$promo->harga_jadi;
                            $hargaawal=$bukupromo->harga; 
                            $stockbuku = mod_barang_stock::select('code_barang',DB::raw('d - k as total'))->where('code_barang','=', $getpromoall->code_barang)->where('code_gudang', '=', 'Gd_001')->first();
                            $stockbukupromo=$stockbuku->total;
                        }
                        else{
                            $varharga=0;
                            $code_barang = mod_promo_detail::where('code_promo', '=',$idBuku)->pluck('code_barang');
                            $getbk = mod_buku::select('id as idBuku','harga')->whereIn('id', $code_barang)->get();
                            foreach ($getbk as $bk){
                                $hargabk = $bk->harga;
                                $varharga +=$hargabk ;
                            }
                            $hargaawal=$varharga;
                            $hargajadi=$buku->harga_jadi;
                            foreach($getpromo as $gtprm){
                                $stockbuku = mod_barang_stock::select('code_barang',DB::raw('d - k as total'))->where('code_barang','=', $gtprm->code_barang)->where('code_gudang', '=', 'Gd_001')->first();
                                
                                if($cekstockprm <= $stockbuku->total){
                                    $cekstockprm = $stockbuku->total;
                                }
                            } 
                            $stockbukupromo=$cekstockprm;                       
                        }

                        $review = mod_review::where('id_buku', '=', $idBuku )->where('type', '=', 'rvw' )->get();
                        $ulasan = mod_review::where('id_buku', '=', $idBuku )->where('type', '=', 'ul' )->get();
                        // $ulasan = mod_ulasan::where('id_buku', '=', $idBuku )->get();
                    
                        $i=0;
                        if($review){
                            $rev = 0;
                            // $reviewstars = array_sum($review->rating);
                            $reviewer=count($ulasan);
                            foreach($ulasan as $rv){
                                $rev += $rv['rating'];
                            }
                            if($rev!=0){
                                $reviewstars =round($rev/$reviewer);
                                // dd( $reviewer);
                            }
                        }
                    }
                }
                                
                    
            }else{

                $cekpromo = mod_promo_detail::where('code_barang', '=', $idBuku )->orderBy('created_at', 'asc')->get();
                if($promoviewhome == 1){
                    if(count($cekpromo)>0){
                        foreach($cekpromo as $ckp=>$value){
                            $promodelete = mod_promo::where('code_promo', '=', $value['code_promo'])->first();
                            if($promodelete->is_del==0){
                                $getprmdetail = mod_promo_detail::where('code_promo', '=', $value['code_promo'])->get();
                                if(count($getprmdetail) < 2){
                                    $cekprmfix = mod_promo_detail::where('code_promo', '=', $value['code_promo'])->first();
                                    $promo = mod_promo::where('code_promo', '=', $cekprmfix->code_promo )->first();
                                    $hargajadi=$promo->harga_jadi;
                                }
                            }                        
                        }
                    }
                }
                
                    $buku = mod_buku::select('id as idBuku','judul_buku','harga','penerbit','penulis','isbn','cover','ukuran','berat','gambar_buku', 'jenis_pre_order_buku' ,'diskripsi', 'store')->where('id', '=', $idBuku )->first();
                    if($buku->store=='N'){
                        return redirect('/')->with('statusLogin', 'Eror!');
                    }else{
                        $data = ['id'=>$buku->idBuku, 'gambar'=>$buku->gambar_buku ];
                        array_push($a, $data);
                        $gambarlist = mod_gambar_buku::where('id_buku', '=', $idBuku )->get();
                        foreach($gambarlist as $gmblist){
                            $data = ['id'=>$gmblist->id_buku, 'gambar'=>$gmblist->gambar ];
                            array_push($a, $data);
                        }
                        $review = mod_review::where('id_buku', '=', $idBuku )->where('type', '=', 'rvw' )->get();
                        $ulasan = mod_review::where('id_buku', '=', $idBuku )->where('type', '=', 'ul' )->get();
                        // $ulasan = mod_ulasan::where('id_buku', '=', $idBuku )->get();
                        $gmbrready = '1';
                        $gambar = $a;
                    //    dd($gambar);
                        // if ($gambar = mod_gambar_buku::where('id_buku', '=', $idBuku )->exists()) {            
                        //     $gmbrready = '1';
                        // }else{$gmbrready = '2';}
                        $i=0;
                        if($review){
                            $rev = 0;
                            // $reviewstars = array_sum($review->rating);
                            $reviewer=count($ulasan);
                            foreach($ulasan as $rv){
                                $rev += $rv['rating'];
                            }
                            if($rev!=0){
                                $reviewstars =round($rev/$reviewer);
                                // dd( $reviewer);
                            }
                        }
                        $stockbuku = mod_barang_stock::select('code_barang',DB::raw('d - k as total'))->where('code_barang','=', $idBuku)->where('code_gudang', '=', 'Gd_001')->first();
                        $hargaawal=0;
                    }
                    
            }

            if ($request->session()->has('idUser')){
                    $username = $request->session()->get('username');
                    $nama = $request->session()->get('nama');
                    $countCart = $this->getcountcart($username);
                }else{
                    $countCart = 'null';
                    $nama = 'null';
                    $username = 'null';
                }
            

            $pathhf = 'api/headerfooter';
            $pathcs = 'api/categories';  
            return view('detail', ['gmbrready'=>$gmbrready,'pathhf'=>$pathhf, 'pathcs'=>$pathcs, 'idBuku'=>$idBuku, 'buku'=>$buku, 'gambar'=>$gambar, 'review'=>$review, 'ulasan'=>$ulasan, 'getBaseUrlEnv'=>$getBaseUrlEnv, 
            'headerphone'=>$headerphone, 'footerphone1'=>$footerphone1, 'footeraddrs1'=>$footeraddrs1, 'footerphone2'=>$footerphone2, 'footeraddrs2'=>$footeraddrs2,
            'pathPublic'=>$pathPublic, 'getBaseUrl'=>$getBaseUrl,'urlImage'=>$urlImage, 'categories'=>$categories,'countcategories'=>$countcategories, 'allcategories'=>$allcategories,
            'countCart'=>$countCart, 'review'=>$review, 'ulasan'=>$ulasan,'reviewer'=>$reviewer, 'reviewstars'=>$reviewstars, 'nama'=>$nama,  'stockbuku'=>$stockbuku, 
            'hargajadi'=>$hargajadi,'hargaawal'=>$hargaawal,'stockbukupromo'=>$stockbukupromo, 'valpromo'=>$valpromo, 'promoviewhome'=>$promoviewhome]);
    }

    public function getcountcart($username)
    {

        $cartCount = mod_cart::where('username', '=', $username)->count();

        return $cartCount;
       
    }
}
