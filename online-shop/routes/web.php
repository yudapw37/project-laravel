<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'c_home@index');
Route::post('/subscribe', 'c_home@store');

Route::get('/trace', 'c_lacakpesanan@index');
Route::post('/traceOrder', 'c_lacakpesanan@cektrace');

Route::get('/detail/{idBuku}', 'c_detail@index');
Route::get('/katalog/{cat}', 'c_katalog@index');
Route::get('/search', 'c_katalog@indexsearch');

Route::get('/cartcount', 'c_cart@getcountcart');
Route::get('/cart', 'c_cart@getcart');
Route::get('/cartall', 'c_cart@index');
Route::get('/cart/{id}', 'c_cart@add');
Route::get('/wishlist/{id}', 'c_wishlist@add');
Route::post('/addcart', 'c_cart@addcart');
Route::post('/delcart', 'c_cart@delcart');
Route::post('/updatecart', 'c_cart@updatecart');

Route::get('/checkout', 'c_checkout@index');
Route::post('/costrajaongkir', 'c_checkout@getcostrajaongkir');
Route::post('/getmoota', 'c_checkout@getmoota');

Route::get('/login', 'c_login_register@index');
Route::get('/register', 'c_login_register@regindex');
Route::get('/logout', 'c_login_register@logout');

Route::post('/ceklogin', 'c_login_register@ceklogin');
Route::post('/registercust', 'c_login_register@registercust');

Route::get('/akun', 'c_akun@index');
Route::post('/wishlist', 'c_wishlist@index');
Route::get('/countwishlist', 'c_wishlist@count');
Route::post('/deletewishlist', 'c_wishlist@delete');
Route::post('/invoice', 'c_invoice@index');
Route::get('/print/{id}', 'c_invoice@printinv');
Route::get('/verif/{id}', 'c_invoice@verif');
Route::get('/countinvoice', 'c_invoice@count');
Route::post('/deleteinvoice', 'c_invoice@delete');
Route::post('/order', 'c_order@index');
Route::get('/countorder', 'c_order@count');
Route::post('/orderdetail', 'c_order@detail');
Route::post('/orderhistory', 'c_orderhistory@index');
Route::get('/detailorderhistory/{id}', 'c_orderhistory@detail');
Route::get('/countorderhistory', 'c_orderhistory@count');
Route::post('/orderhold', 'c_order@indexhold');
Route::get('/countorderhold', 'c_order@counthold');

Route::post('/akunalamat', 'c_akunalamat@index');
Route::get('/countakunalamat', 'c_akunalamat@count');
Route::post('/getalamat', 'c_akunalamat@getalamat');
Route::post('/getalamatutama', 'c_akunalamat@getalamatutama');
Route::post('/addalamat', 'c_akunalamat@addalamatakun');
Route::post('/editalamat', 'c_akunalamat@editalamatakun');
Route::post('/getdetailalamat', 'c_akunalamat@detailalamatakun');
Route::post('/deletealamat', 'c_akunalamat@hapusalamatakun');

Route::post('/alamatro', 'c_akunalamat@alamatro');
Route::get('/admin', 'c_admin@getadmincust');
Route::post('/getongkirmanual', 'c_checkout@getongkirmanual');
Route::post('/addinv', 'c_checkout@addinvoice');
Route::post('/invdetail', 'c_invoice@getdetailinv');
Route::post('/editpass', 'c_akun@editpass');
Route::post('/edituser', 'c_akun@editakun');
Route::get('/reseller', 'c_akun@editreseller');

Route::post('/bayar', 'c_invoice@bayar');

Route::get('/m_semua', 'c_categories@getDataSemua');
Route::get('/m_penerbit', 'c_categories@getDataPenerbit');
Route::get('/m_promo', 'c_categories@getDataPromo');
