<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//------------Utilits------------
Route::post('getMsJabatan','c_utility@getMsJabatan');
Route::post('getMsKategori','c_utility@getMsKategori');

//------------UserManagement-----------------//
Route::post('SU_getAllAdmin','c_superUser@getSemuaUser');
Route::post('SU_viewEdit','c_superUser@viewEdit');
Route::post('SU_edit','c_superUser@edit');
Route::post('SU_submit','c_superUser@submit');
Route::post('SU_resetPassword','c_superUser@resetPassword');
Route::post('SU_disable','c_superUser@disable');
Route::post('SU_activate','c_superUser@activate');

//-------------Login------------------//
Route::post('login','c_login@login');

//------------dashboard-----------///
Route::post('dashboard','c_dashboard@dashboard');

//-------------adminSalesService--------//
Route::post('getAllOrderbyKodeAdmin','c_adminSales@getAllOrder');
// Route::post('getTransaksiKonfirmasi','c_adminSales@getTransaksiKonfirmasi');
Route::post('getDetailTransactionbyId','c_adminSales@getDetailTransaction');
Route::post('updateConfirmationbyAdminSales','c_adminSales@updateConfirmationbyAdminSales');
Route::post('holdOrder','c_adminSales@holdOrder');
Route::post('activeholdOrder','c_adminSales@activeholdOrder');
Route::post('getHistoryTransaction','c_adminSales@history');
Route::post('getHistoryDetail','c_adminSales@historyDetail');


//------------adminFinance-----------------//
Route::post('getAllOrderbyKodeAdminFinance','c_adminFinance@getAllOrder');
Route::post('getAllOrderbyKodeAdminFinance_search','c_adminFinance@getAllOrder_search');
Route::post('getDetailTransactionbyIdFinance','c_adminFinance@getDetailTransaction');
// Route::post('getDetailCustomer','c_adminSales@getDetailCustomer');
Route::post('updateConfirmationbyAdminFinance','c_adminFinance@updateConfirmationbyAdminSales');
Route::post('holdOrderFinance','c_adminFinance@holdOrder');
Route::post('activeholdOrderFinance','c_adminFinance@activeholdOrderFinance');
Route::post('getHistoryTransactionFinance','c_adminFinance@history');
Route::post('getHistoryDetailFinance','c_adminFinance@historyDetail');


//------------adminWairehouse-----------------//
Route::post('getAllOrderbyKodeAdminWarehouse','c_adminWarehouse@getAllOrder');
Route::post('getAllOrderbyKodeAdminWarehouse_search','c_adminWarehouse@getAllOrder_search');
Route::post('getDetailTransactionbyIdWarehouse','c_adminWarehouse@getDetailTransaction');
// Route::post('getDetailCustomer','c_adminSales@getDetailCustomer');
Route::post('updateConfirmationbyAdminWarehouse','c_adminWarehouse@updateConfirmationbyAdminSales');
Route::post('holdOrderWarehouse','c_adminWarehouse@holdOrder');
Route::post('activeholdOrderWarehouse','c_adminWarehouse@activeholdOrderWarehouse');
Route::post('getHistoryTransactionWarehouse','c_adminWarehouse@history');
Route::post('getHistoryDetailWarehouse','c_adminWarehouse@historyDetail');
Route::post('uploadResi','c_adminWarehouse@uploadResi');


//------------UserManagement-----------------//
Route::post('insertOrder','c_customer@insertOrder');


//------------BackOffice-----------------//
Route::post('BO_getAllItem','c_transactionOffline@getAllItem');
