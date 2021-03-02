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

Route::get('/', 'home');

Route::get('/slide', 'c_slide@get');
Route::get('/about', 'c_tentang@get');

Route::post('/store', 'c_store@get');
Route::get('/artikel', 'c_artikel@get');

Route::get('/agen', 'c_agen@get');
Route::get('/visimisi', 'c_visimisi@get');

Route::get('/kota', 'c_kota@get');
Route::get('/area/{idkota}', 'c_area@get');

Route::get('/tipe', 'c_tipe@get');

Route::get('/dtabout/{id}', 'c_tentang@detail');

Route::get('/dtfoto/{id}', 'c_foto@detail');

Route::get('/dtstore/{id}', 'c_store@detail');

Route::get('/dtagen/{id}', 'c_agen@detail');

Route::get('/dtartikel/{id}', 'c_artikel@detail');
