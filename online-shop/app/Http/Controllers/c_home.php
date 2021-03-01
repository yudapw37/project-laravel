<?php

namespace App\Http\Controllers;
use App\mod_categories;
use App\mod_headerfooter;
use App\mod_kategori_inprint_buku;
use App\mod_kategori_promo;
use App\mod_kategori_promo_trn;
use App\mod_promo_detail;
use App\mod_promo;
use App\mod_buku;
use App\mod_cart;
use App\mod_slider;
use App\mod_banner;
use App\mod_flashsale;
use App\mod_flashsale_general;
use App\mod_topproduct;
use App\mod_subscribe;
use App\mod_review;
use App\mod_review_gmbr;
use App\mod_promo_view;
use Illuminate\Http\Request;

class c_home extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $allcategories="";
        $countcategories=0;
        $reviewer=0;
        $reviewstars=0;
        $ulasan="";
        $dataval = [];
        $a=array();
        $datavalb = [];
        $b=array();
        $datavalc = [];
        $c=array();

        $getBaseUrlEnv = env('APP_URL');
        $pathPublic = 'storage/';
        $getBaseUrl = 'https://aqwam.com/';
        $urlImage = 'https://admin.aqwam.com/';

        $varNewRelease = 'new';
        $varBestSeller = 'best';

            $categories = mod_categories::orderBy('created_at', 'asc')->get();
            $headerfooter = mod_headerfooter::orderBy('created_at', 'asc')->get();
            $categoriesinprint = mod_kategori_inprint_buku::orderBy('created_at', 'asc')->get();

            $headerphone = mod_headerfooter::where('type', '=', 'header_phone')->first();
            $footerphone1 = mod_headerfooter::where('type', '=', 'footer_phone1')->first();
            $footeraddrs1 = mod_headerfooter::where('type', '=', 'footer_addr1')->first();
            $footerphone2 = mod_headerfooter::where('type', '=', 'footer_phone2')->first();
            $footeraddrs2 = mod_headerfooter::where('type', '=', 'footer_addr2')->first();
            $review_gambar= mod_review_gmbr::orderBy('created_at', 'asc')->get();

            $promoview = mod_promo_view::first();
            $promoviewhome = $promoview->type;

            $slider = mod_slider::orderBy('created_at', 'asc')->get();
            $banner = mod_banner::orderBy('created_at', 'asc')->get();
	        $bannerAll = mod_banner::orderBy('created_at', 'asc')->where('type', '=', 0)->first();
	        $bannerPromo = mod_banner::orderBy('created_at', 'asc')->where('type', '=', 1)->first();
            $flashSale = mod_flashsale::orderBy('created_at', 'asc')->get();
            // dd($flashSale);
            //$promohome =mod_kategori_promo::orderBy('created_at', 'desc')->first();
            //$idpromonow = $promohome->id;
            //$idPromo = mod_kategori_promo_trn::where('id_kategori', '=',$idpromonow )->take(5)->get();
	    $idPromo = mod_promo::where('is_del', '=', 0)->orderBy('created_at', 'desc')->take(5)->get();
	    $idpromonow = 'allpromo';
            foreach ($idPromo as $idp){
                $gambarbukupromo = '';
                $getMstPromo = mod_promo::where('code_promo', '=',$idp->code_promo)->first();
                $cekBukuPromo = mod_promo_detail::where('code_promo', '=',$idp->code_promo)->get();
                if(count($cekBukuPromo) < 2){
                    $getBukuPromo = mod_promo_detail::where('code_promo', '=',$idp->code_promo)->first();
                    $buku = mod_buku::select('id as idBuku','judul_buku','harga','penulis','isbn','cover','gambar_buku')->where('id','=', $getBukuPromo->code_barang )->first();
                    if($getMstPromo->gambar_buku=='storage/default/no-image.png'){
                        // $gambarbukupromo = $buku->gambar_buku;
                        $gambarbukupromo = $getMstPromo->gambar_buku;
                    }else{
                        $gambarbukupromo = $getMstPromo->gambar_buku;
                    }
                    
                    $dataval = ['idBuku'=>$idp->code_promo, 'judul_buku'=>$getMstPromo->nama_promo, 'harga' => $buku->harga,'harga_jadi' => $getMstPromo->harga_jadi,'gambar' => $gambarbukupromo];
                    array_push($a, $dataval);
                }else{
                    $hargaawal=0;
                    $getBukuPromoCode = mod_promo_detail::where('code_promo', '=',$idp->code_promo)->pluck('code_barang');
                    $buku = mod_buku::select('id as idBuku','harga')->whereIn('id', $getBukuPromoCode)->get();
                    foreach ($buku as $bk){
                        $hargabk = $bk->harga;
                        $hargaawal +=$hargabk ;
                    }
                    $dataval = ['idBuku'=>$getMstPromo->code_promo, 'judul_buku'=>$getMstPromo->nama_promo, 'harga' => $hargaawal,'harga_jadi' => $getMstPromo->harga_jadi,'gambar' => $getMstPromo->gambar_buku];
                    array_push($a, $dataval);
                }
            }

            $bigPromo=$a;
            // dd($bigPromo);

            $flashsalegen = mod_flashsale_general::orderBy('created_at', 'asc')->first();
            
            $bestsell = mod_topproduct::where('kategori', 'like', '%' . $varBestSeller . '%')->limit(6)->get();
            foreach ($bestsell as $bs){
                 $bukub = mod_buku::select('id as idBuku','gambar_buku')->where('id','=', $bs->id_buku )->first();
                if($promoviewhome == 1){
                  $datavalb = ['id_buku'=>$bs->id_buku, 'judul_buku'=>$bs->judul_buku, 'harga_buku'=>$bs->harga_buku,'harga_jadi' => $bs->harga_jadi,'gambar' => $bukub->gambar_buku];      
                }
                else{
                    $datavalb = ['id_buku'=>$bs->id_buku, 'judul_buku'=>$bs->judul_buku, 'harga_buku'=>$bs->harga_buku,'harga_jadi' => 0,'gambar' => $bukub->gambar_buku];
                }
                 
                array_push($b, $datavalb);
            }
            $bestSeller=$b;
            
            $newRel = mod_topproduct::where('kategori', 'like', '%' . $varNewRelease . '%')->limit(6)->get();
            foreach ($newRel as $nw){
                 $bukuc = mod_buku::select('id as idBuku','gambar_buku')->where('id','=', $nw->id_buku )->first();
                if($promoviewhome == 1){
                     $datavalc = ['id_buku'=>$nw->id_buku, 'judul_buku'=>$nw->judul_buku, 'harga_buku'=>$nw->harga_buku,'harga_jadi' => $nw->harga_jadi,'gambar' => $bukuc->gambar_buku];   
                }
                else{
                    $datavalc = ['id_buku'=>$nw->id_buku, 'judul_buku'=>$nw->judul_buku, 'harga_buku'=>$nw->harga_buku,'harga_jadi' => 0,'gambar' => $bukuc->gambar_buku];
                }
                 
                array_push($c, $datavalc);
            }
            $newRelease=$c;

            $ulasan = mod_review::where('type', '=', 'ul' )->get();

            if ($request->session()->has('idUser')){
                $username = $request->session()->get('username');
                $nama = $request->session()->get('nama');
                $countCart = $this->getcountcart($username);
            }else{
                $countCart = 'null';
                $nama = 'null';
                $username = 'null';
            }

                    if($ulasan){
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

            $pathhf = 'api/headerfooter';
            $pathcs = 'api/categories';
            return view('home', ['pathhf'=>$pathhf, 'pathcs'=>$pathcs, 'slider'=>$slider, 'banner'=>$banner,'bannerAll'=>$bannerAll,'bannerPromo'=>$bannerPromo , 'flashSale'=>$flashSale, 'flashsalegen'=>$flashsalegen, 'bestSeller'=>$bestSeller, 'newRelease'=>$newRelease,'getBaseUrlEnv'=>$getBaseUrlEnv, 'pathPublic'=>$pathPublic, 'urlImage'=>$urlImage,
            'headerphone'=>$headerphone, 'footerphone1'=>$footerphone1, 'footeraddrs1'=>$footeraddrs1, 'footerphone2'=>$footerphone2, 'footeraddrs2'=>$footeraddrs2,
            'pathPublic'=>$pathPublic, 'getBaseUrl'=>$getBaseUrl, 'categories'=>$categories,'categoriesinprint'=>$categoriesinprint,'countcategories'=>$countcategories, 'allcategories'=>$allcategories,
            'countCart'=>$countCart, 'nama'=>$nama,'ulasan'=>$ulasan, 'reviewer'=>$reviewer, 'reviewstars'=>$reviewstars, 'review_gambar'=>$review_gambar, 'idpromonow'=>$idpromonow, 'bigPromo'=>$bigPromo, 'promoviewhome'=>$promoviewhome]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'text'=>'required|unique:ms_subscribe|max:15|min:9|numeric'
        ]);

        mod_subscribe::create($request->all());
        return redirect('/')->with('statusSuksesSubscribe', 'Terimakasih Sudah Berlangganan');
        //
    }

    public function getcountcart($username)
    {
        $cartCount = mod_cart::where('username', '=', $username)->count();

        return $cartCount;

    }


}
