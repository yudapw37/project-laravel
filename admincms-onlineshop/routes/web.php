<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

 //UI c_
         Route::get('/login', 'c_login@index');

$routes = [
    [
        'method' => 'get',
        'url' => 'login',
        'act' => 'c_login@index'
    ],
];

foreach ($routes as $route) {
    if ($route['method'] == 'get') {
        Route::get($route['url'], $route['act'])->middleware();
    }
}


Route::get('/', 'c_Login@index');
Route::get('login', 'c_Login@index');
Route::post('login/submit', 'c_Login@submit');
Route::post('logout', 'c_Login@logout');
Route::get('reset-password', 'c_Login@resetPassword');
Route::post('reset-password/submit', 'c_Login@resetPasswordSubmit');
Route::get('storage/{filename}', function ($filename) {
    return response()->file(storage_path('app/public/' . $filename));
});

Route::middleware(['check.login'])->group(function () {


    Route::get('dashboard', 'c_Overview@index');
    Route::get('dashboard/profile', 'c_Profile@edit');
    Route::post('dashboard/profile/submit', 'c_Profile@submit');

    Route::middleware(['menu.permission'])->group(function () {
        Route::get('dashboard/system/menu', 'c_SysMenu@index');
        Route::get('dashboard/system/menu-group', 'c_SysMenuGroup@index');
        Route::get('dashboard/system/menu-group/list', 'c_SysMenuGroup@list');
        Route::get('dashboard/system/menu-group/list/data', 'c_SysMenuGroup@listData');
        Route::post('dashboard/system/menu-group/submit', 'c_SysMenuGroup@submit');
        Route::get('dashboard/system/menu-group/edit/{id}', 'c_SysMenuGroup@edit');

        Route::get('dashboard/system/menu', 'c_SysMenu@index');
        Route::get('dashboard/system/menu/list', 'c_SysMenu@list');
        Route::post('dashboard/system/menu/list/data', 'c_SysMenu@listData');
        Route::post('dashboard/system/menu/submit', 'c_SysMenu@submit');
        Route::get('dashboard/system/menu/edit/{id}', 'c_SysMenu@edit');
        Route::post('dashboard/system/menu/reorder', 'c_SysMenu@reorder');

        Route::get('dashboard/master/user-management', 'c_MasterUserManagement@index');
        Route::get('dashboard/master/user-management/list', 'c_MasterUserManagement@list');
        Route::get('dashboard/master/user-management/data', 'c_MasterUserManagement@data');
        Route::get('dashboard/master/user-management/edit/{username}', 'c_MasterUserManagement@edit');
        Route::post('dashboard/master/user-management/submit', 'c_MasterUserManagement@submit');
        Route::post('dashboard/master/user-management/reset-password', 'c_MasterUserManagement@resetPassword');
        Route::post('dashboard/master/user-management/disable', 'c_MasterUserManagement@disable');
        Route::post('dashboard/master/user-management/activate', 'c_MasterUserManagement@activate');

    //Class
    Route::get('jabatan', 'c_utility@jabatan');
    Route::get('perusahaan', 'c_utility@perusahaan');
    Route::get('judulBuku', 'c_utility@judulBuku');
    Route::get('kategoriBuku', 'c_utility@kategoriBuku');

    Route::get('kategoriPromo', 'c_utility@kategoriPromo');
    Route::get('promo', 'c_utility@promo');



    // karyawan
    Route::get('master/data/karyawan', 'c_md_karyawan@index');
    Route::get('master/data/karyawan/list', 'c_md_karyawan@list');
    Route::get('master/data/karyawan/list/data', 'c_md_karyawan@data');
    Route::post('master/data/karyawan/submit', 'c_md_karyawan@submit');
    Route::get('master/data/karyawan/edit/{username}', 'c_md_karyawan@edit');
    Route::post('master/data/karyawan/disable', 'c_md_karyawan@disable');
    Route::post('master/data/karyawan/activate', 'c_md_karyawan@activate');
    Route::get('master/data/karyawan/password/{username}', 'c_md_karyawan@editPass');
    Route::post('master/data/karyawan/pass/submit', 'c_md_karyawan@passSubmit');
    
    // Flash Sale Mst
    
    Route::get('master/data/flash-sale-master', 'c_md_flashSaleMst@index');
    Route::get('master/data/flash-sale-master/list', 'c_md_flashSaleMst@index');
    Route::post('master/data/flash-sale-master/submit', 'c_md_flashSaleMst@updateData');

    // Flash Sale
    Route::get('master/data/flash-sale', 'c_md_flashSale@index');
    Route::get('master/data/flash-sale/list', 'c_md_flashSale@list');
    Route::get('master/data/flash-sale/list/data', 'c_md_flashSale@data');
    Route::post('getHarga', 'c_md_flashSale@getHarga');
    Route::post('master/data/flash-sale/submit', 'c_md_flashSale@submit');
    Route::get('master/data/flash-sale/edit/{id}', 'c_md_flashSale@edit');
    Route::post('master/data/flash-sale/hapus', 'c_md_flashSale@delete');

    // Best Seller
    Route::get('master/data/best-seller', 'c_md_bestSeller@index');
    Route::get('master/data/best-seller/list', 'c_md_bestSeller@list');
    Route::get('master/data/best-seller/list/data', 'c_md_bestSeller@data');
    Route::post('master/data/best-seller/submit', 'c_md_bestSeller@submit');
    Route::get('master/data/best-seller/edit/{id}', 'c_md_bestSeller@edit');
    Route::post('master/data/best-seller/hapus', 'c_md_bestSeller@delete');

     // New Product
     Route::get('master/data/new-product', 'c_md_newProduct@index');
     Route::get('master/data/new-product/list', 'c_md_newProduct@list');
     Route::get('master/data/new-product/list/data', 'c_md_newProduct@data');
     Route::post('master/data/new-product/submit', 'c_md_newProduct@submit');
     Route::get('master/data/new-product/edit/{id}', 'c_md_newProduct@edit');
     Route::post('master/data/new-product/hapus', 'c_md_newProduct@delete');

   

    // Syncronise
    Route::get('MD-synchronize', 'c_md_synchronize@index');
    Route::get('MD-synchronize/submit', 'c_md_synchronize@syncroniseProvince');
    Route::post('MD-synchronizee/syncrone', 'c_md_synchronize@syncroniseAlamat');
    Route::post('MD-synchronize/list/data', 'c_md_synchronize@data');


    // Promo
    Route::get('master/data/promo', 'c_md_promo@index');
    Route::get('master/data/promo/list', 'c_md_promo@list');
    Route::get('master/data/promo/data-promo', 'c_md_promo@data');
    Route::get('master/data/promo/edit/{id}', 'c_md_promo@edit');
    Route::get('master/data/promo/list-buku', 'c_md_promo@listBuku');
    Route::get('master/data/promo/list-trn/{id}', 'c_md_promo@listBukuTrn');
    Route::get('master/data/promo/list-outstanding', 'c_md_promo@listBukuOutstanding');
    Route::post('master/data/promo/add', 'c_md_promo@listBukuOutstandingAdd');
    Route::post('master/data/promo/delete', 'c_md_promo@listBukuOutstandingDelete');
    Route::post('master/data/promo/submit', 'c_md_promo@submit');
    Route::post('master/data/promo/show/{id}', 'c_md_promo@show');

    // Tentang Kami
    Route::get('menu/profile/tentang-kami', 'c_md_tentangKami@index');
    Route::get('menu/profile/tentang-kami/list/data', 'c_md_tentangKami@data');
    Route::get('menu/profile/tentang-kami/edit/{id}', 'c_md_tentangKami@edit');
    Route::post('menu/profile/tentang-kami/submit', 'c_md_tentangKami@submit');

    // Banner-MST
    Route::get('menu/lainnya/slider-master', 'c_md_bannerMst@index');
    Route::post('web-component/image-slider/delete', 'c_md_bannerMst@delete');
    Route::post('web-component/image-slider/upload', 'c_md_bannerMst@upload');

    // Banner-TRN
    Route::get('menu/lainnya/slider-trn', 'c_md_bannerTrn@index');

    // Master Diskon
    Route::get('dashboard/master/diskon', 'c_md_diskon@index');
    Route::get('dashboard/master/diskon/list', 'c_md_diskon@list');
    Route::get('dashboard/master/diskon/list/data', 'c_md_diskon@data');
    Route::post('dashboard/master/diskon/submit', 'c_md_diskon@submit');
    Route::get('dashboard/master/diskon/edit/{id}', 'c_md_diskon@edit');
    // Route::post('master/data/buku/hapus', 'c_md_buku@delete');

    // Master Customer
    Route::get('MD-customer', 'c_md_customer@index');
    Route::get('MD-customer/list/data', 'c_md_customer@data');
    Route::post('MD-customer/reseller', 'c_md_customer@reseller');
    Route::post('MD-customer/customer', 'c_md_customer@customer');
    Route::get('MD-customer/edit/{id}', 'c_md_customer@edit');
    // Route::post('master/data/buku/hapus', 'c_md_buku@delete');

    
    // Master Buku
    Route::get('master/data/buku', 'c_md_buku@index');
    Route::get('master/data/buku/list', 'c_md_buku@list');
    Route::get('master/data/buku/collectionGambar/{id}', 'c_md_buku@collectionGambar');
    Route::get('master/data/buku/list/data', 'c_md_buku@data');
    Route::post('master/data/buku/submit', 'c_md_buku@submit');
    Route::get('master/data/buku/edit/{id}', 'c_md_buku@edit');
    Route::post('master/data/buku/show/{id}', 'c_md_buku@show');


    // collection
    Route::post('master/data/buku/submitCollection', 'c_md_buku@submitCollection');
    Route::post('master/data/buku/hapus', 'c_md_buku@delete');

    // Master Buku - Tipe Transaksi 
    Route::get('master/data/buku-tipe-transaksi', 'c_md_buku_tipeTransaksi@list');
    Route::get('master/data/buku-tipe-transaksi/list', 'c_md_buku_tipeTransaksi@list');
    Route::get('master/data/buku-tipe-transaksi/list/data', 'c_md_buku_tipeTransaksi@data');
    Route::post('master/data/buku-tipe-transaksi/submit', 'c_md_buku_tipeTransaksi@submit');
    Route::post('master/data/buku-tipe-transaksi/edit/{id}', 'c_md_buku_tipeTransaksi@regulerPromo');
    

    // Master Buku - Kategori
    Route::get('master/data/buku-kategori', 'c_md_buku_kategori@index');
    Route::get('master/data/buku-kategori/list', 'c_md_buku_kategori@list');
    Route::post('master/data/buku-kategori/list/data', 'c_md_buku_kategori@data');
    Route::post('master/data/buku-kategori/submit', 'c_md_buku_kategori@submit');
    Route::get('master/data/buku-kategori/edit/{id}', 'c_md_buku_kategori@edit');

    // Master Buku - Kategori- inprint
    Route::get('master/data/buku-kategori-inprint', 'c_md_kategori_inprint@index');
    Route::get('master/data/buku-kategori-inprint/list', 'c_md_kategori_inprint@list');
    Route::post('master/data/buku-kategori-inprint/list/data', 'c_md_kategori_inprint@data');
    Route::post('master/data/buku-kategori-inprint/submit', 'c_md_kategori_inprint@submit');
    Route::get('master/data/buku-kategori-inprint/edit/{id}', 'c_md_kategori_inprint@edit');

    // Master Promo - Kategori
    Route::get('master/data/promo-kategori', 'c_md_promo_kategori@index');
    Route::get('master/data/promo-kategori/list', 'c_md_promo_kategori@list');
    Route::post('master/data/promo-kategori/list/data', 'c_md_promo_kategori@data');
    Route::post('master/data/promo-kategori/submit', 'c_md_promo_kategori@submit');
    Route::get('master/data/promo-kategori/edit/{id}', 'c_md_promo_kategori@edit');
    Route::post('master/data/promo-kategori/disable', 'c_md_promo_kategori@disable');
    Route::post('master/data/promo-kategori/activate', 'c_md_promo_kategori@activate');

     // Master Promo - Kategori - TRN
     Route::get('master/data/kategori-promo-trn', 'c_md_promo_kategoriTrn@index');
     Route::get('master/data/kategori-promo-trn/list', 'c_md_promo_kategoriTrn@list');
     Route::post('master/data/kategori-promo-trn/list/data', 'c_md_promo_kategoriTrn@data');
     Route::post('master/data/kategori-promo-trn/submit', 'c_md_promo_kategoriTrn@submit');
     Route::get('master/data/kategori-promo-trn/edit/{id}', 'c_md_promo_kategoriTrn@edit');
     Route::post('master/data/kategori-promo-trn/delete', 'c_md_promo_kategoriTrn@delete');
    //  Route::post('master/data/kategori-promo-trn/disable', 'c_md_promo_kategoriTrn@disable');
    //  Route::post('master/data/kategori-promo-trn/activate', 'c_md_promo_kategoriTrn@activate');
    
    // Slider-Image MST
    Route::post('web-component/image-slider/list', 'c_utility@getSlider');

     // Kategori-Mobile
    Route::get('Menu-lainnya/data/kategori-mobile', 'c_md_kategoriMobile@index');
    Route::post('Menu-lainnya/data/kategori-mobile/update', 'c_md_kategoriMobile@upload');
    Route::post('Menu-lainnya/data/kategori-mobile/list', 'c_md_kategoriMobile@getImage');
    
    // Validasi Admin
    Route::get('validasi/data/expedisi', 'c_md_kodeExpedisi@index');
    Route::get('validasi/data/expedisi/list', 'c_md_kodeExpedisi@list');
    Route::get('validasi/data/expedisi/list/data', 'c_md_kodeExpedisi@data');
    Route::post('validasi/data/expedisi/submit', 'c_md_kodeExpedisi@submit');
    Route::get('validasi/data/expedisi/edit/{id}', 'c_md_kodeExpedisi@edit');

    // Ulasan Balik
    // Review
    Route::get('umpan-balik/data/review', 'c_md_review@index');
    Route::get('umpan-balik/data/review/list', 'c_md_review@list');
    Route::post('umpan-balik/data/review/list/dt', 'c_md_review@data');
    Route::post('umpan-balik/data/review/submit', 'c_md_review@submit');
    Route::get('umpan-balik/data/review/edit/{id}', 'c_md_review@edit');
    Route::post('umpan-balik/data/review/delete', 'c_md_review@delete');

    // Ulasan
    Route::get('umpan-balik/data/ulasan', 'c_md_ulasan@list');
    Route::get('umpan-balik/data/review/list/data', 'c_md_ulasan@data');
    Route::post('umpan-balik/data/ulasan/submit', 'c_md_ulasan@submit');
    Route::get('umpan-balik/data/ulasan/edit/{id}', 'c_md_ulasan@edit');
    Route::post('umpan-balik/data/ulasan/delete', 'c_md_ulasan@delete');
    Route::post('umpan-balik/data/ulasan/disable', 'c_md_ulasan@disable');
    Route::post('umpan-balik/data/ulasan/activate', 'c_md_ulasan@activate');

    // Review Tokoh
    Route::get('umpan-balik/data/review-tokoh', 'c_md_reviewTokoh@index');
    Route::get('umpan-balik/data/review-tokoh/list', 'c_md_reviewTokoh@list');
    Route::get('umpan-balik/data/review-tokoh/list/data', 'c_md_reviewTokoh@data');
    Route::post('umpan-balik/data/review-tokoh/submit', 'c_md_reviewTokoh@submit');
    Route::get('umpan-balik/data/review-tokoh/edit/{id}', 'c_md_reviewTokoh@edit');
    Route::post('umpan-balik/data/review-tokoh/delete', 'c_md_reviewTokoh@delete');
    });
});
