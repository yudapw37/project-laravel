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

Route::get('/', 'c_login@index');
Route::post('/loginGuru', 'c_login@cekLoginGuru');
Route::post('/loginSiswa', 'c_login@cekLoginSiswa');

// Route::post('/activities', 'c_login@cekLoginSiswa');


Route::get('/students', 'c_student@index');
Route::get('/students/search', 'c_student@getStudent');
Route::get('/students/create', 'c_student@create');
Route::post('/students', 'c_student@store');
Route::get('/students/delete/{student}', 'c_student@destroy');
Route::get('/students/{student}/edit', 'c_student@edit');
Route::post('/students/edit/{student}', 'c_student@update');

Route::get('/task', 'c_task@index');
Route::get('/task/search', 'c_task@getTask');
Route::get('/task/create', 'c_task@create');
Route::post('/task', 'c_task@store');
Route::get('/task/delete/{task}', 'c_task@destroy');
Route::get('/task/{task}/edit', 'c_task@edit');
Route::post('/task/edit/{task}', 'c_task@update');

Route::get('/aktifitas', 'c_present@index');
Route::get('/aktifitas/search', 'c_present@getPresent');

Route::get('/kegiatan', 'c_present@create');
Route::post('/kegiatan/add', 'c_present@store');
Route::get('/kegiatan/{present}/edit', 'c_present@edit');
Route::post('/kegiatan/edit/{present}', 'c_present@update');

Route::get('/kegiatan/{present}/nilai', 'c_present@showEditNilai');
Route::post('/kegiatan/nilai/{present}', 'c_present@updateNilai');

Route::get('/logout', 'c_login@logout');




// Route::get('/absensi', 'DataController@kegiatanSiswa');