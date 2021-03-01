<?php

namespace App\Http\Controllers;
use App\mod_categories;
use App\mod_headerfooter;
use App\mod_kategori_inprint_buku;
use App\mod_cart;
use App\mod_slider;
use App\mod_banner;
use App\mod_flashsale;
use App\mod_flashsale_general;
use App\mod_topproduct;
use App\mod_subscribe;
use App\mod_review;
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

        $getBaseUrlEnv = env('APP_URL');
        $pathPublic = '1m4g3st0r3/';
        $getBaseUrl = 'http://store.aqwam.biz/';
        $urlImage = 'http://cemaraitsalatiga.com/';

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


            $slider = mod_slider::orderBy('created_at', 'asc')->get();
            $banner = mod_banner::orderBy('created_at', 'asc')->get();
            $flashSale = mod_flashsale::orderBy('created_at', 'asc')->get();
            $flashsalegen = mod_flashsale_general::orderBy('created_at', 'asc')->first();
            $bestSeller = mod_topproduct::where('kategori', 'like', '%' . $varBestSeller . '%')->get();
            $newRelease = mod_topproduct::where('kategori', 'like', '%' . $varNewRelease . '%')->get();

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
            return view('home', ['pathhf'=>$pathhf, 'pathcs'=>$pathcs, 'slider'=>$slider, 'banner'=>$banner, 'flashSale'=>$flashSale, 'flashsalegen'=>$flashsalegen, 'bestSeller'=>$bestSeller, 'newRelease'=>$newRelease,'getBaseUrlEnv'=>$getBaseUrlEnv, 'pathPublic'=>$pathPublic, 'urlImage'=>$urlImage,
            'headerphone'=>$headerphone, 'footerphone1'=>$footerphone1, 'footeraddrs1'=>$footeraddrs1, 'footerphone2'=>$footerphone2, 'footeraddrs2'=>$footeraddrs2,
            'pathPublic'=>$pathPublic, 'getBaseUrl'=>$getBaseUrl, 'categories'=>$categories,'categoriesinprint'=>$categoriesinprint,'countcategories'=>$countcategories, 'allcategories'=>$allcategories,
            'countCart'=>$countCart, 'nama'=>$nama,'ulasan'=>$ulasan, 'reviewer'=>$reviewer, 'reviewstars'=>$reviewstars]);
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
