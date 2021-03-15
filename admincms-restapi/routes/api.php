<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::group(['prefix' => 'auth'], function () {    
//     Route::post('login', 'c_login@login');
// });

Route::post('regist', 'c_login@regist');
Route::post('ceklogin', 'c_login@login');



Route::group(['middleware' => ['auth:api']], function () {
    Route::post('logout', 'c_login@logout');
});

     
    Route::get('getadmin','c_admin@getAdmin');

    Route::get('getbook','c_buku@getBuku');
    Route::get('getdetailbook','c_buku@getdetail');
    Route::post('addbook','c_buku@addbook');
    Route::post('editbook','c_buku@editbook');
    Route::post('showstore','c_buku@showstore');
    Route::post('addimagebook','c_buku@addimage');

    Route::get('getcust','c_customer@getCustomer');
    Route::get('getdetailcust','c_customer@getDetailCust');
    Route::post('editcust','c_customer@editcust');
    Route::post('resetcust','c_customer@resetPasswordCust');

    Route::get('showpromo','c_promo@getShowPromo');
    Route::post('setshowpromo','c_promo@showstore');
    Route::post('addshowpromo','c_promo@addPromo');
    Route::post('editshowpromo','c_promo@editPromo');
    Route::get('getpromo','c_promo@getPromo');
    Route::get('getdetailpromo','c_promo@getdetail');

    Route::get('getproduct','c_hame_product@getProduct');
    Route::get('getdetailproduct','c_hame_product@getDetailProduct');
    Route::post('addproduct','c_hame_product@addProduct');
    Route::post('deleteproduct','c_hame_product@deleteProduct');

// Route::post('ceklogin','c_login@cekLoginAdmin');

