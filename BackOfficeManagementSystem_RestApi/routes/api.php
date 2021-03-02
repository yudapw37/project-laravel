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

//----------------Android--------------------//

Route::post('loginAndroid','c_login@loginAndroid');

Route::post('getItemBarang','c_Android_SO@getItemBarang');

Route::post('inputStockOpnam','c_Android_SO@inputStockOpnam');

Route::post('syncroniseSO','c_Android_SO@syncroniseSO');

Route::post('deleteSO','c_Android_SO@deleteSO');

Route::post('syncroniseSOInsert','c_Android_SO@syncroniseSOInsert');

Route::post('getlistStockOpnamBarang','c_Android_SO@getlistStockOpnamBarang');

Route::post('getlistStockOpnamAndroid','c_Android_SO@getlistStockOpnamAndroid');

Route::post('getListInputSO','c_Android_SO@getListInputSO');

Route::post('deleteInputSO','c_Android_SO@deleteInputSO');



Route::post('getDetailListStockOpnam','c_Android_SO@getDetailListSO');

//------------Utilits------------

Route::post('getMsJabatan','c_utility@getMsJabatan');

Route::post('getMsKategori','c_utility@getMsKategori');

Route::post('getMsExpedisi','c_utility@getMsExpedisi');

Route::post('getMsGudang','c_utility@getMsGudang');



Route::post('update_distribusi','c_utility@getMsExpedisi');





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



//------------dashboardSU-----------///

Route::post('getDashboardSales','c_dashboard_SU@getDashboardSales');

Route::post('getDashboardFinance','c_dashboard_SU@getDashboardFinance');

Route::post('getDashboardWarehouse','c_dashboard_SU@getDashboardWarehouse');



//-------------adminSalesService--------//

Route::post('getAllOrderbyKodeAdmin','c_adminSales@getAllOrder');

Route::post('getDetailTransactionbyId','c_adminSales@getDetailTransaction');

Route::post('updateConfirmationbyAdminSales','c_adminSales@updateConfirmationbyAdminSales');

Route::post('holdOrder','c_adminSales@holdOrder');



Route::post('getHistoryTransaction','c_adminSales@history');

Route::post('getHistoryDetail','c_adminSales@historyDetail');

Route::post('activeLunas','c_adminSales@activeLunas');

Route::post('activeLunasArisan','c_adminSales@activeLunasArisan');

Route::post('getAllOrderHutang','c_adminSales@getOrderHutangAll');

Route::post('getAllOrderHold','c_adminSales@getOrderHold');

Route::post('activeholdOrder','c_adminSales@activeholdOrder');

Route::post('DeleteItemOrderHold','c_adminSales@deleteItemOrderHold');



Route::post('InputOrderTransaction','c_adminSales@inputOrderTransaction');

//-------------------------------------------------

Route::post('TotalCostTransaction','c_adminSales@TotalCostTransaction');

Route::post('GetDetailOrderHold','c_adminSales@getDetailOrderHold');

Route::post('DeleteOrderHold','c_adminSales@deleteOrderHold');

Route::post('UpdateDeleteOrderHold','c_adminSales@UpdatedeleteOrderHold');

Route::post('EditDataOrder','c_adminSales@editDataOrder');

Route::post('inputItemOrderSession','c_adminSales@inputItemOrderSession');

Route::post('inputItemOrder','c_adminSales@inputItemOrder');

Route::post('EditItemOrder','c_adminSales@editItemOrder');

Route::post('deleteItemOrder','c_adminSales@deleteItemOrder');



Route::post('ReturBuku','c_adminSales@returBuku');

//Route::post('deleteItemOrder','c_adminSales@deleteItemOrder');



Route::post('GetOrderHutangDetail','c_adminSales@GetOrderHutangDetail');

Route::post('GetTotalBelanja','c_adminSales@getCustomerCost');



//------------adminFinance-----------------//

Route::post('getAllOrderbyKodeAdminFinance','c_adminFinance@getAllOrder');

Route::post('getAllOrderbyKodeAdminFinance_search','c_adminFinance@getAllOrder_search');

Route::post('getDetailTransactionbyIdFinance','c_adminFinance@getDetailTransaction');

Route::post('updateConfirmationbyAdminFinance','c_adminFinance@updateConfirmationbyAdminSales');

Route::post('holdOrderFinance','c_adminFinance@holdOrder');

Route::post('activeholdOrderFinance','c_adminFinance@activeholdOrderFinance');

Route::post('getHistoryTransactionFinance','c_adminFinance@history');

Route::post('getHistoryDetailFinance','c_adminFinance@historyDetail');



Route::post('InsertOrderHibah','c_adminFinance@inputOrderHibah');

Route::post('InsertOrderHibahDetail','c_adminFinance@inputItemOrderHibah');





//------------adminWairehouse-----------------//

Route::post('getAllOrderbyKodeAdminWarehouseManajer','c_adminWarehouse@getAllOrderManajer');

Route::post('getAllOrderbyKodeAdminWarehouse','c_adminWarehouse@getAllOrder');

Route::post('getAllOrderbyKodeAdminWarehouse_search','c_adminWarehouse@getAllOrder_search');

Route::post('getDetailTransactionbyIdWarehouse','c_adminWarehouse@getDetailTransaction');

Route::post('updateConfirmationbyAdminWarehouse','c_adminWarehouse@updateConfirmationbyAdminSales');

Route::post('holdOrderWarehouse','c_adminWarehouse@holdOrder');

Route::post('activeholdOrderWarehouse','c_adminWarehouse@activeholdOrderWarehouse');

Route::post('getHistoryTransactionWarehouse','c_adminWarehouse@history');

Route::post('getHistoryDetailWarehouse','c_adminWarehouse@historyDetail');

Route::post('uploadResi','c_adminWarehouse@uploadResi');

Route::post('cekValidasiItem','c_adminWarehouse@cekValidasiItem');

Route::post('hibahreturn','c_adminWarehouse@hibahreturn');

Route::post('gethibahreturn','c_adminWarehouse@gethibahreturn');





//------------UserManagement-----------------//

Route::post('insertOrder','c_customer@insertOrder');





//------------BackOffice-----------------//



Route::post('BO_searchCustomer','c_transactionOffline@searchCustomer');

Route::post('BO_addCustomer','c_transactionOffline@addCustomer');

Route::post('BO_deleteCustomer','c_transactionOffline@deleteCustomer');

Route::post('BO_inputOrder','c_transactionOffline@inputOrder');

Route::post('BO_getOutstandingOrder_Customer','c_transactionOffline@getOutstandingOrderCustomer');



Route::post('BO_getAllItem','c_transactionOffline@getAllItem');



Route::post('BO_inputItemOrderSession','c_transactionOffline@inputItemOrderSession');

Route::post('BO_inputItemOrder','c_transactionOffline@inputItemOrder');

// Route::post('BO_updateAlamatIO','c_transactionOffline@updateAlamatIO');

// Route::post('BO_editItemOrder','c_transactionOffline@editItemOrder');

Route::post('BO_deleteItemOrder','c_transactionOffline@deleteItemOrder');

Route::post('BO_getItemOrder','c_transactionOffline@getItemOrder');

Route::post('BO_orderNow','c_transactionOffline@orderNow');



Route::post('getAllOutstanding','c_transactionOffline@getAllOrderOutstanding');



Route::post('BO_EditOrderOutstanding','c_transactionOffline@editOutstanding');



Route::post('BO_DeleteOrderItemOutsanding','c_transactionOffline@deleteOutstandingItemOrder');



Route::post('BO_DeleteOrderOutstanding','c_transactionOffline@deleteOutstanding');



Route::post('BO_GetTransaksiDataPG','c_transactionOffline@getTransaksiDataPG');

Route::post('BO_GetTransaksiDataPG_Notif','c_transactionOffline@getTransaksiDataPGNotif');

Route::post('BO_GetDetailTransaksiDataPG','c_transactionOffline@getDetailTransaksiDataPG');



Route::post('BO_InsertGudang','c_transactionOffline@insertGudang');

Route::post('BO_DeleteGudang','c_transactionOffline@deleteGudang');

Route::post('BO_GetGudang','c_transactionOffline@getGudang');

Route::post('BO_InsertTransaksiDataPG','c_transactionOffline@insertTransaksiDataPG');

Route::post('BO_InsertTransaksiDataPG_Detail','c_transactionOffline@insertTransaksiDataPG_Detail');



Route::post('BO_UpdateTransaksiDataPG','c_transactionOffline@updateTransaksiDataPG');



Route::post('BO_CekStock','c_transactionOffline@cekStock');



//----------------Barang Trn--------------------//

Route::post('Add_BarangTrn','c_barangGudang@addBarangTrn');

Route::post('Update_BarangTrn','c_barangGudang@updateBarangTrn');

Route::post('GET_BarangTrn','c_barangGudang@getBarangTrn');



//----------------Manajer Sales--------------------//

// Route::post('GetAllPromo','c_manajerSales@getAllPromo');

// Route::post('AddPromo','c_manajerSales@addPromo');

// Route::post('UpdatePromo','c_manajerSales@updatePromo');

// Route::post('DeletePromo','c_manajerSales@deletePromo');

// Route::post('GetAllSalesSale','c_manajerSales@getAllSalesSale');

// Route::post('getTopBookSale','c_manajerSales@getTopBookSale');





Route::post('GetAllPromo','c_manajerSales@getAllPromo');

Route::post('GetDetailPromo','c_manajerSales@getDetailPromo');

Route::post('AddPromo','c_manajerSales@addPromo');

Route::post('EditPromo','c_manajerSales@editPromo');

Route::post('DeletePromo','c_manajerSales@deletePromo');

Route::post('SoftDeletePromo','c_manajerSales@softDeletePromo');

Route::post('SalesAmount','c_manajerSales@salesAmount');



Route::post('BukuOrderSale','c_manajerSales@bukuordersale');

Route::post('ResellerAdminSales','c_manajerSales@Reselleradminsales');



Route::post('GetAdminSales','c_manajerSales@getAdminSales');

Route::post('salesAmountDetailTransaksi','c_manajerSales@salesAmountDetailTransaksi');

Route::post('SalesOrder','c_manajerSales@salesOrder');

Route::post('BestSeller','c_manajerSales@bestSeller');

Route::post('MostPurchases','c_manajerSales@mostPurchases');

Route::post('GetDetailTransaksiSales','c_manajerSales@getDetailTransaksiSales');



//----------------Barang Stock Update--------------------//

Route::post('GetAllStockBuku','c_stockUpdate@getAllStockBuku');

Route::post('GetDetailBuku','c_stockUpdate@getDetailBuku');

Route::post('AddNewBuku','c_stockUpdate@addNewBuku');

Route::post('EditBuku','c_stockUpdate@editBuku');

Route::post('DeleteBuku','c_stockUpdate@deleteBuku');

Route::post('GetBukuStockOpdnameBulanan','c_stockUpdate@getBukuStockOpdnameBulanan');

Route::post('UpdatedBukuStockOpnameBulanan','c_stockUpdate@updatedBukuStockOpnameBulanan');

Route::post('UpdatedBukuMasuk','c_stockUpdate@updatedBukuMasuk');

Route::post('ReturnBuku','c_stockUpdate@returnBuku');

Route::post('SelectExport','c_stockUpdate@selectExport');

Route::post('DetailExport','c_stockUpdate@detailExport');

Route::post('UpdateStatusExport','c_stockUpdate@updateStatusExport');

Route::post('GetAllBuku','c_stockUpdate@getAllStockBukuItem');

Route::post('UpdateStatusCetak','c_transactionOffline@updatestatuscetak');

Route::post('GetStockBuku','c_stockUpdate@getStockBuku');

//----------------New Update--------------------//
Route::post('GetKecamatan','c_invoice@getKecamatan');
Route::post('GetCustAdmin','c_invoice@getCustAdmin');
Route::post('GetBukuPO','c_invoice@getBukuPO');
Route::post('GetCostRajaOngkir','c_invoice@getcostrajaongkir');
Route::post('GetCostRajaOngkirUpdate','c_invoice@getcostrajaongkirupdate');
Route::post('CreateInvoice','c_invoice@createInvoice');
Route::post('CreateInvoiceUpdate','c_invoice@createInvoiceUpdate');
Route::post('UpdateInvoice','c_invoice@updateInvoice');
Route::post('GetDisc','c_invoice@getDisc');
Route::post('GetOutstandingOrderCustomer','c_invoice@getOutstandingOrderCustomer');
Route::post('GetListPO','c_invoice@getListPO');
Route::post('CreatePO','c_invoice@createPO');
Route::post('GetDetailPO','c_invoice@getDetailPO');
Route::post('UpdatePO','c_invoice@updatePO');
Route::post('CreateInvoicePO','c_invoice@createInvoicePO');
Route::post('DeletePO','c_invoice@deletePO');
Route::post('DeleteInvoice','c_invoice@deleteInvoice');
Route::post('GetFullDataAkunCust','c_invoice@getFullDataAkunCust');
Route::post('CreateCustomer','c_invoice@createCustomer');
Route::post('EditCustomer','c_invoice@editCustomer');
Route::post('DeleteCustomer','c_invoice@deleteCustomer');
Route::post('GetOrderMonthCustomer','c_invoice@getOrderMonthCustomer');
Route::post('UpdateDiskon','c_invoice@updateDiskon');

Route::get('GetFullDataAkunCust','c_invoice@getFullDataAkunCust');
Route::put('EditCustomer','c_invoice@editCustomer');
Route::delete('DeleteCustomer','c_invoice@deleteCustomer');

Route::post('SearchCustomerInvoice','c_invoice@searchCustomerInvoice');