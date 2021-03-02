<?php

namespace App\Http\Controllers;

use App\mod_ms_orderDetail;
use App\mod_ms_order;
use App\mod_transaksi;
use App\mod_transaksiLog;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\Psr7\str;

class c_adminSales extends Controller
{
    public function getAllOrder(Request $request)
    {
        $token = $request->token;
        $kodeAdmin = $request->kodeAdmin;
        $kodeOrderDetail = $request->kodeOrderDetail;
        $status = $request->status;
        $offset = $request->offset;
        $typeTransaksi = $request->typeTransaksi;
        $namaPenerima = $request->namaPenerima;
        $sb1 = $request->sortBy;

        try {
            if ($token == '2nkeygqp9l') {
                $result = [
                    'data' => $this->getOrder($offset, $kodeAdmin, $kodeOrderDetail, $status, $sb1, $typeTransaksi, $namaPenerima),
                    'count' => $this->getCount($offset, $kodeAdmin, $kodeOrderDetail, $status, $sb1, $typeTransaksi, $namaPenerima),
                ];
            } else {
                $result = 'Invalid Token';
            }
            return response()->json($result);
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }
    public function getOrder($offset, $kodeAdmin, $kodeOrderDetail, $status, $sb1, $typeTransaksi, $namaPenerima)
    {
        try {
            if ($offset) {
                $offset = (int)$offset;
            } else {
                $offset = 0;
            }
            $query =
                DB::table('order')
                ->select('transaksi.id as id', 'order.id as codeOrder', 'ms_customer.nama as nama', 'order.nama_pengirim as namaPengirim', 'order.telephone_pengirim as nomorPengirim', 'order.nama_penerima as namaPenerima', 'order.telephone_penerima as telephonePenerima', 'order.alamat as alamat', 'transaksi.typeTransaksi as typeTransaksi', 'ms_status_trx.status as status', 'transaksi.created_at as tanggal', 'ms_customer.telephone as nomor')
                ->join('ms_customer', 'ms_customer.id', '=', 'order.code_customer')
                ->join('transaksi', 'transaksi.code_order', '=', 'order.id')
                ->join('ms_status_trx', 'ms_status_trx.id', '=', 'transaksi.code_status')
                ->where('transaksi.kodeAdminTrx', '=', $kodeAdmin)
                ->orderBy('order.updated_at', 'DESC')
                ->limit(10)
                ->offset($offset);


            if ($namaPenerima) {
                $query->where('order.nama_penerima', 'like', $namaPenerima . '%');
            }
            if ($kodeOrderDetail) {
                $query->where('transaksi.code_order', 'like', '%' . $kodeOrderDetail . '%');
            }
            if ($status) {
                $query->where('transaksi.code_status', '=', $status);
            }

            if ($sb1) {
                $query->orderBy($sb1, 'ASC');
            }

            if ($typeTransaksi == 'konfirmasi') {
                $query->whereIn('transaksi.code_status', array(4, 5, 6));
                $query->where('transaksi.approve_sales', '=', '1');
            } else {
                $query->whereIn('transaksi.code_status', array(1, 3));
                $query->where('transaksi.approve_sales', '=', '0');
            }

            $result = $query->get();
            return   $result;
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }
    public function getCount($offset, $kodeAdmin, $kodeOrderDetail, $status, $sb1, $typeTransaksi, $namaPenerima)
    {
        try {
            if ($offset) {
                $offset = (int)$offset;
            } else {
                $offset = 0;
            }
            $result = 'True';
            $query =
                DB::table('transaksi')
                ->select(DB::raw('count(transaksi.id) as count'))
                ->join('order', 'transaksi.code_order', '=', 'order.id')
                ->where('transaksi.kodeAdminTrx', '=', $kodeAdmin)

                ->groupBy('transaksi.kodeAdminTrx');
            // ->limit(10);

            if ($namaPenerima) {
                $query->where('order.nama_penerima', 'like', $namaPenerima . '%');
            }
            if ($kodeOrderDetail) {
                $query->where('transaksi.code_order', 'like', '%' . $kodeOrderDetail . '%');
            }
            if ($status) {
                $query->where('transaksi.code_status', '=', $status);
            }

            if ($sb1) {
                $query->orderBy($sb1, 'ASC');
            }

            if ($typeTransaksi == 'konfirmasi') {
                $query->whereIn('transaksi.code_status', array(4, 5, 6));
                $query->where('transaksi.approve_sales', '=', '1');
            } else {
                $query->whereIn('transaksi.code_status', array(1, 3));
                $query->where('transaksi.approve_sales', '=', '0');
            }

            $result = $query->first();
            return   $result;
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }

    public function getDetailTransaction(Request $request)
    {
        $token = $request->token;
        $kodeOrderDetail = $request->kodeOrderDetail;

        try {
            if ($token == '6lscxf2ypx') {
                $result = [
                    'orderDetail' => $this->getOrderDetail($kodeOrderDetail),
                    'itemOrder' => $this->getItemOrder($kodeOrderDetail),
                ];
            } else {
                $result = 'Invalid Token';
            }
            return response()->json($result);
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }

    public function getOrderDetail($idOrder)
    {
        try {
            return    DB::table('order')
                ->select(
                    'order.id as code_order',
                    'order.codeGudang as codeGudang',
                    'order.nama_pengirim as namaPengirim',
                    'order.telephone_pengirim as nomorPengirim',
                    'order.nama_penerima as namaPenerima',
                    'order.telephone_penerima as telephonePenerima',
                    'order.alamat as alamat',
                    'order.total_harga as total_harga',
                    'order.totalDiskon as diskonTotal',
                    'transaksi.typeTransaksi as typeTransaksi',
                    'order.kecamatan as kecamatan',
                    'order.kab_kota as kab_kota',
                    'order.propinsi as propinsi',
                    'order.pre_order as preorder',
                    'ms_customer.telephone as nomor',
                    'ms_customer.nama as nama',
                    'order.expedisi as ekspedisi',
                    'order.biayaExpedisi as biayaExpedisi',
                    'order.image as gambar',
                    'ms_status_trx.status as status',
                    'ms_status_trx.id as statusId',
                    'transaksi.approve_sales as approveSales',
                    'transaksi.approve_keuangan as approveKeuangan',
                    'transaksi.approve_sales2 as approveSales2',
                    'transaksi.approve_gudang as approveGudang',
                    'transaksi.keterangan as keteranganHold',
                    'order.created_at as tanggal',
                    'transaksi.updated_at as tanggalTrxUpdate'
                )
                ->join('transaksi', 'transaksi.code_order', '=', 'order.id')

                ->join('ms_status_trx', 'ms_status_trx.id', '=', 'transaksi.code_status')
                ->join('ms_customer', 'ms_customer.id', '=', 'order.code_customer')
                // ->where('transaksi.approveSales','=','0')
                ->where('order.id', '=', $idOrder)
                ->get();
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }

    public function getItemOrder($idOrder)
    {
        try {
            return DB::table('orderdetail')
                ->select(
                    DB::raw('(SELECT SUM(berat) as totalBerat FROM ms_barang JOIN orderdetail A ON A.code_barang = ms_barang.id WHERE A.code_order = "' . $idOrder . '" AND A.code_promo = orderdetail.code_promo)as totalBerat'),
                    'orderdetail.code_barang as kodeBarang',
                    'ms_barang.judul_buku as judulBuku',
                    'orderdetail.jumlah as qty',
                    'orderdetail.harga as harga',
                    'orderdetail.diskon as diskon',
                    'orderdetail.code_promo as code_promo',
                    'orderdetail.nama_promo as nama_promo',
                    'orderdetail.harga_promo as harga_promo',
                    DB::raw('(orderdetail.jumlah) * (orderdetail.harga) as subTotal')
                )
                ->join('ms_barang', 'ms_barang.id', '=', 'orderdetail.code_barang')
                ->where('orderdetail.code_order', '=', $idOrder)
                ->get();
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }


    public function getTransaksiKonfirmasi(Request $request)
    {
        $sales = $request->kodeAdmin;
        try {
            return [
                'konfirmasiKeuangan' => $this->konfirmasiKeuangan($sales),
                'sales' => $this->sales($sales),
                'konfirmasiGudang' => $this->konfirmasiGudang($sales),
            ];
        } catch (\Exception $ex) {
            return response()->json([$ex]);
        }
    }




    public function konfirmasiKeuangan($sales)
    {
        return DB::table('transaksi')
            ->select(DB::raw('COUNT(transaksi.id) as Total'))
            ->where('transaksi.approveSales', '=', '1')
            ->where('transaksi.approveKeuangan', '=', '1')
            ->where('transaksi.approveGudang', '=', '0')

            ->where('transaksi.sales', '=', $sales)
            ->get();
    }
    public function sales($sales)
    {
        return DB::table('transaksi')
            ->select(DB::raw('COUNT(transaksi.id) as Total'))
            ->where('transaksi.approveSales', '=', '1')
            ->where('transaksi.approveKeuangan', '=', '1')
            ->where('transaksi.approveSales2', '=', '1')
            ->where('transaksi.approveGudang', '=', '0')

            ->where('transaksi.sales', '=', $sales)
            ->get();
    }

    public function konfirmasiGudang($sales)
    {
        return DB::table('transaksi')
            ->select(DB::raw('COUNT(transaksi.id) as Total'))
            ->where('transaksi.approveSales', '=', '1')
            ->where('transaksi.approveKeuangan', '=', '1')
            ->where('transaksi.approveGudang', '=', '1')
            ->where('transaksi.sales', '=', $sales)
            ->get();
    }

    public function history(Request $request)
    {
        $token = $request->token;
        $kodeAdmin = $request->kodeAdmin;
        $kodeOrderDetail = $request->kodeOrderDetail;
        $namaPenerima = $request->namaPenerima;
        $namaPembeli = $request->namaPembeli;
        $offset = $request->offset;
        $sortBy = $request->sortBy;

        try {
            if ($token == '0xorxdo6vw') {
                $result = [
                    'data' => $this->getOrderHistori($offset, $kodeAdmin, $kodeOrderDetail, $namaPenerima, $namaPembeli, $sortBy),
                    'count' => $this->getCountHistori($offset, $kodeAdmin, $kodeOrderDetail, $namaPenerima, $namaPembeli, $sortBy),
                ];
            } else {
                $result = 'Invalid Token';
            }
            return response()->json($result);
        } catch (\Exception $ex) {
            return response()->json($result);
        }
    }

    public function getOrderHistori($offset, $kodeAdmin, $kodeOrderDetail, $namaPenerima, $namaPembeli, $sortBy)
    {
        try {
            $result = [];

            if ($offset) {
                $offset = (int)$offset;
            } else {
                $offset = 0;
            }

            $query =
                DB::table('order')
                ->select('transaksi.id as id', 'order.id as codeOrder', 'ms_customer.nama as nama', 'order.nama_pengirim as namaPengirim', 'order.telephone_pengirim as nomorPengirim', 'order.nama_penerima as namaPenerima', 'order.telephone_penerima as telephonePenerima', 'order.alamat as alamat', 'transaksi.typeTransaksi as typeTransaksi', 'ms_status_trx.status as status', 'transaksi.no_resi as noResi', 'order.total_harga as total_harga', 'order.totalDiskon as totalDiskon', 'order.biayaExpedisi as biayaExpedisi', 'transaksi.updated_at as tanggal', 'order.expedisi as expedisi')
                ->join('ms_customer', 'ms_customer.id', '=', 'order.code_customer')
                ->join('transaksi', 'transaksi.code_order', '=', 'order.id')
                ->join('ms_status_trx', 'ms_status_trx.id', '=', 'transaksi.code_status')
                ->where('transaksi.approve_sales', '=', '1')
                ->where('transaksi.approve_keuangan', '=', '1')
                ->where('transaksi.approve_sales2', '=', '1')
                ->where('transaksi.approve_gudang', '=', '1')
                //->where('transaksi.no_resi','<>','-')
                ->where('transaksi.kodeAdminTrx', '=', $kodeAdmin)
                ->orderBy('transaksi.updated_at', 'DESC')
                ->limit(10)
                ->offset($offset);

            if ($kodeOrderDetail) {
                $query->where('transaksi.code_order', 'like', '%' . $kodeOrderDetail . '%');
            }
            if ($namaPembeli) {
                $query->where('ms_customer.nama', 'like', $namaPembeli . '%');
            }
            if ($namaPenerima) {
                $query->where('order.nama_penerima', 'like', $namaPenerima . '%');
            }

            if ($sortBy) {
                $query->orderBy($sortBy, 'ASC');
            }

            $result = $query->get();


            return   $result;
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }
    public function getCountHistori($offset, $kodeAdmin, $kodeOrderDetail, $namaPenerima, $namaPembeli, $sortBy)
    {
        try {

            $query =
                DB::table('transaksi')
                ->select(DB::raw('count(transaksi.id) as count'))
                ->join('order', 'transaksi.code_order', '=', 'order.id')
                ->join('ms_customer', 'ms_customer.id', '=', 'order.code_customer')
                ->where('transaksi.approve_sales', '=', '1')
                ->where('transaksi.approve_keuangan', '=', '1')
                ->where('transaksi.approve_sales2', '=', '1')
                ->where('transaksi.approve_gudang', '=', '1')
                //->where('transaksi.no_resi','<>','-')
                ->where('transaksi.kodeAdminTrx', '=', $kodeAdmin)

                ->groupBy('transaksi.kodeAdminTrx');

            if ($kodeOrderDetail) {
                $query->where('transaksi.code_order', 'like', '%' . $kodeOrderDetail . '%');
            }
            if ($namaPenerima) {
                $query->where('order.nama_penerima', 'like', $namaPenerima . '%');
            }
            if ($namaPembeli) {
                $query->where('ms_customer.nama', 'like', $namaPembeli . '%');
            }


            $result = $query->first();
            return   $result;
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }

    public function historyDetail(Request $request)
    {
        $token = $request->token;
        $kodeOrderDetail = $request->kodeOrderDetail;

        try {
            if ($token == 'cc82gl12eu') {
                $result = [
                    'orderDetail' => $this->getOrderDetail($kodeOrderDetail),
                    'itemOrder' => $this->getItemOrder($kodeOrderDetail),
                ];
            } else {
                $result = 'Invalid Token';
            }

            return response()->json($result);
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }


    public function updateConfirmationbyAdminSales(Request $request)
    {
        $token = $request->token;
        $approve = $request->approveKeuangan;
        $username = $request->username;
        $itemOrder = $request->itemOrder;
        $kodeOrderDetail = $request->kodeOrderDetail;
        try {
            if ($token == '9g8w11thnv') {
                DB::beginTransaction();
                if ($approve == 0) {
                    $status = '4';
                    DB::table('transaksi')
                        ->where('code_order', '=', $request->kodeOrderDetail)
                        ->update([
                            'approve_sales' => '1',
                            'code_status' => $status
                        ]);

                    foreach ($itemOrder as $y => $val) {
                        foreach ($val as $keyData => $valData) {
                            if ($keyData == 'kodeBarang') {
                                $kodeBarang = $valData;
                            }
                            if ($keyData == 'qty') {
                                $jumlah = $valData;
                            }
                            DB::table('ms_barang_stock')
                                ->where('code_barang', '=', $request->kodeBarang)
                                ->update([
                                    'k' => $jumlah
                                ]);
                        }
                    }
                } else {
                    $status = '6';

                    $statusKon = DB::table('ms_perusahaan')
                        ->select('konfDOW as konf')
                        ->first();

                    $cekPerusahaan = DB::table('transaksi')
                        ->select('code_perusahaan as codePerusahaan')
                        ->where('code_order', '=', $request->kodeOrderDetail)
                        ->first();
                    if ($cekPerusahaan->codePerusahaan == '1') {
                        $kodeAdminNew = 'WH%';
                    } else {
                        $kodeAdminNew = 'JKT%';
                    }
                    if ($statusKon->konf == '0') {

                        $query = DB::table('ms_admin')
                            ->select(DB::raw('(SELECT ms_admin.kodeAdminTrx) as kodeAwo'), DB::raw('(select COUNT(transaksi.id) from transaksi where transaksi.kode_AWO = ms_admin.kodeAdminTrx) as jumlah'))
                            // ->join('transaksi','transaksi.code_order','order.id')
                            ->where('ms_admin.code_jabatan', '=', '4')
                            ->where('ms_admin.kodeAdminTrx', '<>', 'WH000')
                            ->where('ms_admin.kodeAdminTrx', 'LIKE', $kodeAdminNew)
                            ->orderBy('jumlah', 'asc')
                            ->first();

                        DB::table('transaksi')
                            ->where('code_order', '=', $request->kodeOrderDetail)
                            ->update([
                                'approve_sales2' => '1',
                                'code_status' => $status,
                                'kode_AWO' => $query->kodeAwo,

                            ]);
                    } else {


                        DB::table('transaksi')
                            ->where('code_order', '=', $request->kodeOrderDetail)
                            ->update([
                                'approve_sales2' => '1',
                                'code_status' => $status,
                                'kode_AWO' => 'WH000'
                            ]);
                    }
                }
                $transaksi = new mod_transaksiLog();
                $transaksi->idOrder = $request->kodeOrderDetail;
                $transaksi->status = $status;
                $transaksi->pic = $username;
                $transaksi->save();
                DB::commit();
                $result = $kodeSales;
            } else {
                $result = 'Invalid Token';
            }

            return response()->json($result);
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }


    public function holdOrder(Request $request)
    {
        $token = $request->token;
        $username = $request->username;
        $keterangan = $request->keterangan;
        try {
            if ($token == 'idd5vr6owk') {
                DB::beginTransaction();
                $status = '71';
                DB::table('transaksi')
                    ->where('code_order', '=', $request->kodeOrderDetail)

                    ->update([
                        'hold' => '1',
                        'code_status' => $status,
                        'keterangan' => $keterangan
                    ]);
                $transaksi = new mod_transaksiLog();
                $transaksi->idOrder = $request->kodeOrderDetail;
                $transaksi->status = $status;
                $transaksi->pic = $username;
                $transaksi->save();

                DB::commit();
                $result = 'success';
            } else {
                $result = 'Invalid Token';
            }
            return response()->json($result);
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json($ex);
        }
    }


    public function activeholdOrder(Request $request)
    {
        $token = $request->token;
        $username = $request->username;
        // $keterangan = $request->keterangan;
        $kodeOrderDetail = $request->kodeOrderDetail;
        try {
            if ($token == 'wjnq3cen26') {
                DB::beginTransaction();

                $order = DB::table('transaksi')
                    ->select('transaksi.approve_sales as approveSales', 'transaksi.approve_keuangan as approveKeuangan', 'transaksi.approve_sales2 as approveSales2')
                    ->where('transaksi.code_order', '=', $request->kodeOrderDetail)
                    ->first();

                if ($order->approveSales == '0') {
                    $status = '1';
                } else {
                    if ($order->approveKeuangan == '0') {
                        $status = '4';
                    }
                    if ($order->approveSales2  == '0' && $order->approveKeuangan == '1') {
                        $status = '5';
                    }
                    if ($order->approveSales2  == '1' && $order->approveKeuangan == '1') {
                        $status = '6';
                    }
                }

                // $status = '0';
                DB::table('transaksi')
                    ->where('code_order', '=', $request->kodeOrderDetail)

                    ->update([
                        'hold' => '0',
                        'code_status' => $status,
                        'keterangan' => 'Status ditahan di aktifkan admin sales'
                    ]);
                $transaksi = new mod_transaksiLog();
                $transaksi->idOrder = $request->kodeOrderDetail;
                $transaksi->status = $status;
                $transaksi->pic = $username;
                $transaksi->save();

                DB::commit();
                $result = 'success';
            } else {
                $result = 'Invalid Token';
            }
            return response()->json($result);
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json($ex);
        }
    }


    public function getOrderHutangAll(Request $request)
    {
        $token = $request->token;
        $kodeAdmin = $request->kodeAdmin;
        $kodeOrderDetail = $request->kodeOrderDetail;
        $offset = $request->offset;
        // $status = $request->status;


        // $typeTransaksi = $request->typeTransaksi;
        // $sb1 = $request->sortBy;

        try {
            if ($token == '9kdnygqp9l') {
                $result = [
                    'data' => $this->getOrderHutang_($kodeAdmin, $kodeOrderDetail, $offset),
                    'count' => $this->getCountHutang_($kodeAdmin, $kodeOrderDetail),
                ];
            } else {
                $result = 'Invalid Token';
            }
            return response()->json($result);
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }
    public function getOrderHutang_($kodeAdmin, $kodeOrderDetail, $offset)
    {
        try {
            if ($offset) {
                $offset = (int)$offset;
            } else {
                $offset = 0;
            }
            $query =
                DB::table('order')
                ->select('transaksi.id as id', 'order.id as codeOrder', 'ms_customer.nama as nama', 'order.nama_pengirim as namaPengirim', 'order.telephone_pengirim as nomorPengirim', 'order.nama_penerima as namaPenerima', 'order.telephone_penerima as telephonePenerima', 'order.alamat as alamat', 'ms_customer.telephone as nomor', 'order.biayaExpedisi as biayaExpedisi', 'order.total_harga as totalHarga', 'order.totalDiskon as totalDiskon', 'transaksi.typeTransaksi as typeTransaksi', 'order.lunas as lunas', 'ms_status_trx.status as status', 'transaksi.updated_at as tanggal')

                ->join('ms_customer', 'ms_customer.id', '=', 'order.code_customer')
                ->join('transaksi', 'transaksi.code_order', '=', 'order.id')
                ->join('ms_status_trx', 'ms_status_trx.id', '=', 'transaksi.code_status')
                ->where('transaksi.code_status', '=', '10')
                ->where('transaksi.approve_gudang', '=', '1')
                // ->where('order.lunas','=','2')
                ->limit(10)
                //     ->limit(10)
                ->offset($offset);

            if ($kodeOrderDetail) {
                $query->where('transaksi.code_order', 'like', $kodeOrderDetail . '%');
            }
            if ($kodeAdmin) {
                $query->where('transaksi.kodeAdminTrx', '=', $kodeAdmin);
                $query->whereIn('order.lunas', [0, 2]);
            } else {
                $query->where('order.lunas', '=', '0');
            }

            $result = $query->get();
            return   $result;
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }
    public function getCountHutang_($kodeAdmin, $kodeOrderDetail)
    {
        try {
            //     if($offset){$offset=(int)$offset;}
            // else{$offset=0;}

            $query =
                DB::table('order')
                ->select(DB::raw('count(transaksi.id) as count'))
                ->join('ms_customer', 'ms_customer.id', '=', 'order.code_customer')
                ->join('transaksi', 'order.id', '=', 'transaksi.code_order')
                ->join('ms_status_trx', 'ms_status_trx.id', '=', 'transaksi.code_status')
                // ->where('transaksi.kodeAdminTrx','=',$kodeAdmin)
                ->where('transaksi.code_status', '=', '10')
                ->where('transaksi.approve_gudang', '=', '1');

            if ($kodeOrderDetail) {
                $query->where('transaksi.code_order', 'like', $kodeOrderDetail . '%');
            }
            if ($kodeAdmin) {
                $query->where('transaksi.kodeAdminTrx', '=', $kodeAdmin);
                $query->whereIn('order.lunas', [0, 2]);
            } else {
                $query->where('order.lunas', '=', '0');
            }


            $result = $query->first();
            return   $result;
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getOrderHold(Request $request)
    {
        $token = $request->token;
        $kodeAdmin = $request->kodeAdmin;
        $codeOrder = $request->codeOrder;
        // $status = $request->status;
        $offset = $request->offset;
        // $typeTransaksi = $request->typeTransaksi;
        // $sb1 = $request->sortBy;

        try {
            if ($token == '2ksnygqp9l') {
                $result = [
                    'data' => $this->getOrderHold_($offset, $kodeAdmin, $codeOrder),
                    'count' => $this->getCountHold_($offset, $kodeAdmin, $codeOrder)
                ];
            } else {
                $result = 'Invalid Token';
            }
            return response()->json($result);
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }
    public function getOrderHold_($offset, $kodeAdmin, $kodeOrderDetail)
    {
        try {
            if ($offset) {
                $offset = (int)$offset;
            } else {
                $offset = 0;
            }
            $query =
                DB::table('order')
                ->select('transaksi.id as id', 'transaksi.hold as hold', 'transaksi.kodeAdminTrx as kodeAdminTrx', 'order.id as codeOrder', 'ms_customer.nama as nama', 'order.nama_pengirim as namaPengirim', 'order.telephone_pengirim as nomorPengirim', 'order.nama_penerima as namaPenerima', 'order.telephone_penerima as telephonePenerima', 'order.alamat as alamat', 'ms_status_trx.status as status', 'ms_customer.telephone as nomor', 'order.biayaExpedisi as biayaExpedisi', 'order.total_harga as totalHarga', 'order.totalDiskon as totalDiskon', 'transaksi.keterangan as keterangan', 'transaksi.created_at as tanggal')

                ->join('ms_customer', 'ms_customer.id', '=', 'order.code_customer')
                ->join('transaksi', 'transaksi.code_order', '=', 'order.id')
                ->join('ms_status_trx', 'ms_status_trx.id', '=', 'transaksi.code_status')
                ->where('transaksi.kodeAdminTrx', '=', $kodeAdmin)
                ->where('transaksi.hold', '=', '1')
                ->limit(10)
                //     ->limit(10)
                ->offset($offset);

            if ($kodeOrderDetail) {
                $query->where('transaksi.code_order', 'like', $kodeOrderDetail . '%');
            }

            $result = $query->get();
            return   $result;
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }
    public function getCountHold_($offset, $kodeAdmin, $kodeOrderDetail)
    {
        if ($offset) {
            $offset = (int)$offset;
        } else {
            $offset = 0;
        }
        try {
            $query =
                DB::table('order')
                ->select(DB::raw('COUNT(transaksi.id) as count'))
                ->join('transaksi', 'transaksi.code_order', '=', 'order.id')
                ->where('transaksi.kodeAdminTrx', '=', $kodeAdmin)
                ->where('transaksi.hold', '=', '1')
                ->offset($offset);
            if ($kodeOrderDetail) {
                $query->where('transaksi.code_order', 'like', $kodeOrderDetail . '%');
            }

            $result = $query->first();
            return   $result;
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }

    public function GetOrderHutangDetail(Request $request)
    {
        $token = $request->token;
        $code_order = $request->code_order;
        try {
            if ($token == '6vkktpeblt') {
                $result = [
                    'dataGetOrderHutang' => $this->dataGetOrderHutang($code_order),
                    'dataGetOrderHutangDetail' => $this->dataGetOrderHutangDetail($code_order),
                ];
            } else {
                $result = 'Invalid Token';
            }
            return response()->json($result);
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }

    public function dataGetOrderHutang($code_order)
    {
        try {
            // $result = 'True';
            $result =
                DB::table('order')
                ->select('order.id as  id', 'order.code_customer as code_customer', 'ms_customer.nama as nama', 'order.nama_pengirim as namaPengirim', 'order.telephone_pengirim as telephonePengirim', 'order.nama_penerima as namaPenerima', 'order.alamat as alamat', 'order.kecamatan as kecamatan', 'order.telephone_penerima as telephonePenerima', 'order.kab_kota as kab_kota', 'order.propinsi as propinsi', 'order.created_at as created_at', 'order.expedisi as expedisi', 'order.biayaExpedisi as biayaExpedisi')
                ->join('ms_customer', 'ms_customer.id', '=', 'order.code_customer')
                ->where('order.id', '=', $code_order)
                // ->where('order.image','=','-')
                ->whereIn('order.lunas', [0, 2])
                ->get();
            return   $result;
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }

    public function dataGetOrderHutangDetail($code_order)
    {
        try {
            $result = DB::table('orderdetail')
                ->select(
                    DB::raw('(SELECT SUM(berat) as totalBerat FROM ms_barang JOIN orderdetail A ON A.code_barang = ms_barang.id WHERE A.code_order = "' . $code_order . '" AND A.code_promo = orderdetail.code_promo)as totalBerat'),
                    'orderdetail.id as id',
                    'orderdetail.code_barang as code_barang',
                    'ms_barang.judul_buku as judul_buku',
                    'orderdetail.jumlah as jumlah',
                    'orderdetail.harga as harga',
                    'orderdetail.diskon as diskon',
                    'orderdetail.code_promo as code_promo',
                    'orderdetail.nama_promo as nama_promo',
                    'orderdetail.harga_promo as harga_promo',
                    DB::raw('(orderdetail.jumlah) * (orderdetail.harga) as subTotal')
                )
                ->join('ms_barang', 'ms_barang.id', '=', 'orderdetail.code_barang')
                ->where('orderdetail.code_order', '=', $code_order)
                ->get();
            return   $result;
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }

    public function activeLunas(Request $request)
    {
        $token = $request->token;
        $username = $request->username;
        $gambar = $request->gambar;
        try {
            if ($token == 'klmq3cen26') {
                DB::beginTransaction();
                $status = '21';
                DB::table('order')
                    ->where('id', '=', $request->kodeOrderDetail)

                    ->update([
                        'lunas' => '0',
                        'image' => $gambar,
                    ]);
                DB::table('transaksi')
                    ->where('code_order', '=', $request->kodeOrderDetail)
                    ->update([
                        'approve_sales' => '1',
                    ]);
                $transaksi = new mod_transaksiLog();
                $transaksi->idOrder = $request->kodeOrderDetail;
                $transaksi->status = $status;
                $transaksi->pic = $username;
                $transaksi->save();

                DB::commit();
                $result = 'success';
            } else {
                $result = 'Invalid Token';
            }
            return response()->json($result);
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json($ex);
        }
    }

    public function activeLunasArisan(Request $request)
    {
        $token = $request->token;
        $code_order = $request->code_order;
        $nama_pengirim = $request->nama_pengirim;
        $telephone_pengirim = $request->telephone_pengirim;
        $nama_penerima = $request->nama_penerima;
        $telephone_penerima = $request->telephone_penerima;
        $alamat = $request->alamat;
        $kecamatan = $request->kecamatan;
        $kab_kota = $request->kab_kota;
        $code_expedisi = $request->code_expedisi;
        $biaya_expedisi = $request->biaya_expedisi;
        $gambar = $request->gambar;
        $username = $request->username;

        try {
            if ($token == 'kl7q3cen26') {
                DB::beginTransaction();
                if (isset($gambar)) {
                    DB::table('order')
                        ->where('id', '=', $code_order)
                        ->update([
                            'expedisi' => $code_expedisi,
                            'biayaExpedisi' => $biaya_expedisi,
                            'nama_pengirim' => $nama_pengirim,
                            'telephone_pengirim' => $telephone_pengirim,
                            'nama_penerima' => $nama_penerima,
                            'telephone_penerima' => $telephone_penerima,
                            'alamat' => $alamat,
                            'kecamatan' => $kecamatan,
                            'kab_kota' => $kab_kota,
                            'lunas' => '0',
                            'image' => $gambar
                        ]);
                } else {
                    DB::table('order')

                        ->where('id', '=', $code_order)
                        ->update([
                            'expedisi' => $code_expedisi,
                            'biayaExpedisi' => $biaya_expedisi,
                            'nama_pengirim' => $nama_pengirim,
                            'telephone_pengirim' => $telephone_pengirim,
                            'nama_penerima' => $nama_penerima,
                            'telephone_penerima' => $telephone_penerima,
                            'alamat' => $alamat,
                            'kecamatan' => $kecamatan,
                            'kab_kota' => $kab_kota,
                            'lunas' => '0',

                        ]);
                }


                $status = '21';
                DB::table('transaksi')
                    ->where('code_order', '=', $request->kodeOrderDetail)
                    ->update([
                        'approve_sales' => '1',
                    ]);

                $transaksi = new mod_transaksiLog();
                $transaksi->idOrder = $request->kodeOrderDetail;
                $transaksi->status = $status;
                $transaksi->pic = $username;
                $transaksi->save();

                DB::commit();
                $result = 'success';
            } else {
                $result = 'Invalid Token';
            }
            return response()->json($result);
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json($ex);
        }
    }
    ////////////////////////////////////////////////////////////////////////////////////////
    public function getCustomerCost(Request $request)
    {
        $token = $request->token;
        $kodeAdmin = $request->kodeAdmin;
        $offset = $request->offset;

        try {
            if ($token == '6ksjygqp9l') {
                $result = [
                    'data' => $this->getTotalBelanja($offset, $kodeAdmin),
                    'count' => $this->getCountTotalBelanja($this->getTotalBelanja($offset, $kodeAdmin)),
                ];
            } else {
                $result = 'Invalid Token';
            }
            return response()->json($result);
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }
    public function getTotalBelanja($offset, $kodeAdmin)
    {
        try {
            $ldate = date('Y');
            $ldate1 = date('m');
            $date = $ldate . '-' . $ldate1;
            if ($offset) {
                $offset = (int)$offset;
            } else {
                $offset = 0;
            }
            $query =

                DB::table('order')
                ->select('order.code_customer as codeCustomer', DB::raw("(SELECT nama FROM ms_customer WHERE ms_customer.id = order.code_customer) as nama"), DB::raw('SUM(order.total_harga - order.totalDiskon) as totalPembelian'))
                ->groupBy('order.code_customer')
                ->orderBy('totalPembelian', 'DESC')
                ->where('transaksi.kodeAdminTrx', '=', $kodeAdmin)
                ->where('order.created_at', 'like', '%' . $date . '%')
                ->join('transaksi', 'transaksi.code_order', '=', 'order.id')
                ->limit(10)
                ->offset($offset);

            $result = $query->get();
            return   $result;
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }
    public function getCountTotalBelanja($data)
    {
        try {

            $result = 0;
            foreach ($data as $val) {
                $result++;
            }
            return   $result;
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }
    //////////////HOLD//////////////////////////////////////
    public function getDetailOrderHold(Request $request)
    {
        $token = $request->token;
        $code_order = $request->code_order;
        try {
            if ($token == '6vkktpeblt') {
                $result = [
                    'dataGetOrderHold' => $this->dataGetOrderHold($code_order),
                    'dataGetOrderHoldDetail' => $this->dataGetOrderHoldDetail($code_order),
                ];
            } else {
                $result = 'Invalid Token';
            }
            return response()->json($result);
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }

    public function dataGetOrderHold($code_order)
    {
        try {
            // $result = 'True';
            $result =
                DB::table('order')
                ->select('transaksi.id as id', 'transaksi.hold as hold', 'transaksi.kodeAdminTrx as kodeAdminTrx', 'order.id as codeOrder', 'ms_customer.nama as nama', 'order.nama_pengirim as namaPengirim', 'order.telephone_pengirim as nomorPengirim', 'order.nama_penerima as namaPenerima', 'order.telephone_penerima as telephonePenerima', 'order.alamat as alamat', 'ms_status_trx.status as status', 'ms_customer.telephone as nomor', 'order.biayaExpedisi as biayaExpedisi', 'order.total_harga as totalHarga', 'order.totalDiskon as totalDiskon', 'transaksi.created_at as tanggal')
                ->join('ms_customer', 'ms_customer.id', '=', 'order.code_customer')
                ->join('transaksi', 'transaksi.code_order', '=', 'order.id')
                ->join('ms_status_trx', 'ms_status_trx.id', '=', 'transaksi.code_status')
                ->where('order.id', '=', $code_order)

                ->get();
            return   $result;
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }

    public function dataGetOrderHoldDetail($code_order)
    {
        try {
            // $result = 'True';
            $result =
                DB::table('orderdetail')
                ->select('orderdetail.id as  id', 'orderdetail.code_order as code_order', 'ms_barang.id as code_barang', 'ms_barang.judul_buku as judul_buku', 'orderdetail.jumlah as jumlah', 'ms_barang.berat as berat', 'orderdetail.diskon as diskon', 'orderdetail.harga as harga')
                ->join('ms_barang', 'ms_barang.id', '=', 'orderdetail.code_barang')
                ->where('orderdetail.code_order', '=', $code_order)
                ->get();
            return   $result;
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }

    public function deleteOrderHold(Request $request)
    {
        $token = $request->token;
        $code_order = $request->code_order;
        try {
            if ($token == '9g8w11thnv') {
                DB::beginTransaction();
                // $result = 'True';

                $result =
                    DB::table('order')->where('id', '=', $code_order)
                    ->delete();
                DB::table('transaksi')->where('code_order', '=', $code_order)
                    ->delete();

                DB::table('orderdetail')->where('code_order', '=', $code_order)
                    ->delete();

                DB::commit();
                $result = 'success';
            } else {
                $result = 'Invalid Token';
            }

            return response()->json($result);
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }


    public function editDataOrder(Request $request)
    {
        $token = $request->token;
        $code_order = $request->code_order;
        $nama_pengirim = $request->nama_pengirim;
        $telephone_pengirim = $request->telephone_pengirim;
        $nama_penerima = $request->nama_penerima;
        $telephone_penerima = $request->telephone_penerima;
        $alamat = $request->alamat;
        $kecamatan = $request->kecamatan;
        $kab_kota = $request->kab_kota;
        $totalDiskon = $request->totalDiskon;
        $code_expedisi = $request->code_expedisi;
        $biaya_expedisi = $request->biaya_expedisi;
        $totalBiaya = $request->biaya_expedisi;
        $total_harga = $request->total_harga;
        $total_barang = $request->total_barang;
        $gambar = $request->gambar;
        try {
            if ($token == '9g8w11thnv') {
                DB::beginTransaction();
                if (isset($gambar)) {
                    DB::table('order')
                        ->where('id', '=', $code_order)
                        ->update([
                            'expedisi' => $code_expedisi,
                            'biayaExpedisi' => $biaya_expedisi,
                            'totalDiskon' => $totalDiskon,
                            'total_barang' => $total_barang,
                            'total_harga' => $total_harga,
                            'nama_pengirim' => $nama_pengirim,
                            'telephone_pengirim' => $telephone_pengirim,
                            'nama_penerima' => $nama_penerima,
                            'telephone_penerima' => $telephone_penerima,
                            'alamat' => $alamat,
                            'kecamatan' => $kecamatan,
                            'kab_kota' => $kab_kota,
                            'image' => $gambar
                        ]);
                } else {
                    DB::table('order')

                        ->where('id', '=', $code_order)
                        ->update([
                            'expedisi' => $code_expedisi,
                            'biayaExpedisi' => $biaya_expedisi,
                            'totalDiskon' => $totalDiskon,
                            'total_barang' => $total_barang,
                            'total_harga' => $total_harga,
                            'nama_pengirim' => $nama_pengirim,
                            'telephone_pengirim' => $telephone_pengirim,
                            'nama_penerima' => $nama_penerima,
                            'telephone_penerima' => $telephone_penerima,
                            'alamat' => $alamat,
                            'kecamatan' => $kecamatan,
                            'kab_kota' => $kab_kota,

                        ]);
                }




                DB::commit();
                $result = 'success';
            } else {
                $result = 'Invalid Token';
            }

            return response()->json($result);
        } catch (\Exception $ex) {

            return response()->json($ex);
        }
    }

    public function UpdatedeleteOrderHold(Request $request)
    {
        $token = $request->token;
        $code_order = $request->code_order;
        try {
            if ($token == '1k1w11thnv') {
                DB::beginTransaction();
                $orderData = DB::table('order')
                    ->select('codeGudang as codeGudang')
                    ->where('id', '=', $code_order)
                    ->first();

                $OutstandingOrderItem = [];
                $OutstandingOrderItem = DB::table('orderdetail')
                    ->select('code_barang as codeBarang', 'jumlah as jumlah')
                    ->where('code_order', '=', $code_order)
                    ->get();
                $val_decode = json_decode($OutstandingOrderItem);

                foreach ($val_decode as  $val) {
                    $kodeBarang = $val->codeBarang;
                    $jumlah = $val->jumlah;


                    $k = DB::table('ms_barang_stock')
                        ->select('k as stock')
                        ->where('code_barang', '=', $kodeBarang)
                        ->where('code_gudang', '=', $orderData->codeGudang)
                        ->first();
                    $stock_sekarang = ($k->stock - $jumlah);

                    DB::table('ms_barang_stock')
                        ->where('code_barang', '=', $kodeBarang)
                        ->where('code_gudang', '=', $orderData->codeGudang)
                        ->update([
                            'k' => $stock_sekarang,
                        ]);
                }

                DB::commit();
                $result = 'success';
            } else {
                $result = 'Invalid Token';
            }

            return response()->json($result);
        } catch (\Exception $ex) {

            return response()->json($ex);
        }
    }

    public function inputItemOrderSession(Request $request)
    {
        $token = $request->token;
        $sberat = $request->berat;
        $sjumlah = $request->jumlah;
        $sharga = $request->harga;
        $sdiskon = $request->diskon;

        $code_order = $request->code_order;

        // $code_order = $request->code_order;
        // $code_barang = $request->code_barang;
        // $code_promo = $request->code_promo;
        // $nama_promo = $request->nama_promo;
        // $harga_promo = $request->harga_promo;
        // $harga = $request->harga;

        // $jumlah = $request->jumlah;
        // $diskon = $request->diskon;

        $codeGudang = $request->codeGudang;
        $diskonInput = 0;
        $total_barang = 0;
        $total_harga = 0;

        try {
            if ($token == 'z68cn8gfvl') {
                DB::beginTransaction();
                foreach ($sjumlah as $keyJumlah => $valueJumlah) {
                    $code_barang = $keyJumlah;
                    $jumlah = $valueJumlah;
                    $harga = $sharga[$code_barang];
                    $berat = $sberat[$code_barang];
                    $diskon = $sdiskon[$code_barang];

                    $total_barang = $total_barang + $jumlah;
                    $total_harga = $total_harga + ($harga * $jumlah);
                    if ($diskon != '') {
                        $diskon = $sdiskon[$code_barang];
                        $diskontotal = ($harga * $jumlah) * ($diskon / 100);
                    } else {
                        $diskon = 0;
                        $diskontotal = 0;
                    }
                    $diskonInput = $diskonInput + $diskontotal;

                    $id = '';
                    $idchar = str_split($code_barang);
                    foreach ($idchar as $char) {
                        if ($char == '_') {
                            break;
                        }
                        $id =  $id . $char;
                    }

                    if (strtolower($id) == 'promo') {
                        $code_promo = $code_barang;
                        $detailPromo =  DB::table('ms_promo')
                            ->select('ms_promo.code_promo as codePromo', 'ms_promo.nama_promo as namaPromo', 'ms_promo.harga_jadi as hargaJadi', 'ms_promo.tanggal_cetak as tanggal_cetak', 'ms_promo.created_at as created_at')
                            ->where('ms_promo.code_promo', '=', $code_promo)
                            ->limit(1)
                            ->first();

                        $detailBarangPromo =  DB::table('ms_barang_promo')
                            ->select('ms_barang.id as kodeBarang', 'ms_barang.judul_buku as judulBuku', 'ms_barang.harga as harga')
                            ->join('ms_barang', 'ms_barang.id', '=', 'ms_barang_promo.code_barang')
                            ->where('ms_barang_promo.code_promo', '=', $code_promo)
                            // ->limit(1)
                            // ->first();
                            ->get();

                        for ($i = 0; $i < count($detailBarangPromo); $i++) {
                            $transaksi = new mod_ms_orderDetail();
                            $transaksi->code_order = $code_order;
                            $transaksi->code_barang = $detailBarangPromo[$i]->kodeBarang;
                            $transaksi->code_promo = $code_promo;
                            $transaksi->nama_promo = $detailPromo->namaPromo;
                            $transaksi->harga_promo = $detailPromo->hargaJadi;
                            $transaksi->jumlah = $jumlah;
                            $transaksi->diskon = $diskon;
                            $transaksi->harga = $detailBarangPromo[$i]->harga;
                            $transaksi->status_barang = 0;
                            $transaksi->keterangan = '-';
                            $transaksi->save();

                            $k = DB::table('ms_barang_stock')
                                ->select('k as stock')
                                ->where('code_barang', '=', $detailBarangPromo[$i]->kodeBarang)
                                ->where('code_gudang', '=', $codeGudang)
                                ->first();
                            $stock_sekarang = ($k->stock + $jumlah);
                            // DB::beginTransaction();
                            DB::table('ms_barang_stock')
                                ->where('code_barang', '=', $detailBarangPromo[$i]->kodeBarang)
                                ->where('code_gudang', '=', $codeGudang)
                                ->update([
                                    'k' => $stock_sekarang,
                                ]);
                        }
                    } else {

                        $code_promo = '-';
                        $nama_promo = '-';
                        $harga_promo = 0;

                        // $inputOrder = $vartest->BO_inputItemOrder($code_order,$code_barang,$code_promo,$nama_promo,$hargaJadi, $diskon,  $jumlah_barang,$harga,$_SESSION['cGudang']);
                        $transaksi = new mod_ms_orderDetail();
                        $transaksi->code_order = $code_order;
                        $transaksi->code_barang = $code_barang;
                        $transaksi->code_promo = $code_promo;
                        $transaksi->nama_promo = $nama_promo;
                        $transaksi->harga_promo = $harga_promo;
                        $transaksi->jumlah = $jumlah;
                        $transaksi->diskon = $diskon;
                        $transaksi->harga = $harga;
                        $transaksi->status_barang = 0;
                        $transaksi->keterangan = '-';
                        $transaksi->save();

                        $k = DB::table('ms_barang_stock')
                            ->select('k as stock')
                            ->where('code_barang', '=', $code_barang)
                            ->where('code_gudang', '=', $codeGudang)
                            ->first();
                        $stock_sekarang = ($k->stock + $jumlah);
                        DB::beginTransaction();
                        DB::table('ms_barang_stock')
                            ->where('code_barang', '=', $code_barang)
                            ->where('code_gudang', '=', $codeGudang)
                            ->update([
                                'k' => $stock_sekarang,
                            ]);
                    }
                }

                DB::table('order')->where('id', '=', $code_order)
                    ->update([
                        'total_barang' => $total_barang,
                        'total_harga' => $total_harga,
                        'totalDiskon' => $diskonInput
                    ]);


                DB::commit();
                $result = 'success';
            } else {
                $result = 'Invalid Token';
            }
            return response()->json($result);
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json($ex);
        }
    }

    public function inputItemOrder(Request $request)
    {
        $token = $request->token;
        $code_order = $request->code_order;
        $code_barang = $request->code_barang;
        $code_promo = $request->code_promo;
        $nama_promo = $request->nama_promo;
        $harga_promo = $request->harga_promo;
        $harga = $request->harga;

        $jumlah = $request->jumlah;
        $diskon = $request->diskon;
        $codeGudang = $request->codeGudang;
        try {
            if ($token == 'z68cn8gfvl') {
                $log = 'log1';
                DB::beginTransaction();
                //update jumlah
                $orderDetail = new mod_ms_orderDetail();
                //    $orderDetail = new mod_ms
                $orderDetail->code_order = $code_order;
                $orderDetail->code_barang = $code_barang;
                $orderDetail->code_promo = $code_promo;
                $orderDetail->nama_promo = $nama_promo;
                $orderDetail->harga_promo = $harga_promo;
                $orderDetail->jumlah = $jumlah;
                $orderDetail->diskon = $diskon;
                $orderDetail->harga = $harga;
                $orderDetail->status_barang = 0;
                $orderDetail->keterangan = '-';
                $orderDetail->save();


                $k = DB::table('ms_barang_stock')
                    ->select('k as stock')
                    ->where('code_barang', '=', $code_barang)
                    ->where('code_gudang', '=', $codeGudang)
                    ->first();
                $stock_sekarang = ($k->stock + $jumlah);
                DB::beginTransaction();
                DB::table('ms_barang_stock')
                    ->where('code_barang', '=', $code_barang)
                    ->where('code_gudang', '=', $codeGudang)
                    ->update([
                        'k' => $stock_sekarang,
                    ]);

                //    $log = 'log3';
                DB::commit();
                $result = 'success';
            } else {
                $result = 'Invalid Token';
            }
            return response()->json($result);
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json($ex);
        }
    }


    public function deleteItemOrder(Request $request)
    {
        $token = $request->token;
        $code_order = $request->code_order;
        $code_barang = $request->code_barang;
        try {
            if ($token == 'z68cn8gfvl') {
                DB::beginTransaction();

                $jumlah = DB::table('orderdetail')
                    ->select('jumlah as jumlah')
                    ->where('code_barang', '=', $code_barang)
                    ->where('code_order', '=', $code_order)
                    ->first();

                DB::table('orderdetail')->where('code_order', '=', $code_order)
                    ->where('code_barang', '=', $code_barang)->delete();

                $k = DB::table('ms_barang_stock')
                    ->select('k as stock')
                    ->where('code_barang', '=', $code_barang)
                    ->first();
                $stock_sekarang = ($k->stock - $jumlah->jumlah);
                DB::beginTransaction();
                DB::table('ms_barang_stock')
                    ->where('code_barang', '=', $code_barang)
                    ->update([
                        'k' => $stock_sekarang,
                    ]);

                DB::commit();
                $result = 'success';
            } else {
                $result = 'Invalid Token';
            }
            return response()->json($result);
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json($ex);
        }
    }

    public function deleteItemOrderHold(Request $request)
    {
        $token = $request->token;
        $code_order = $request->code_order;
        // $code_gudang = $request->code_gudang;
        try {
            if ($token == 'z68458gfvl') {
                DB::beginTransaction();

                DB::table('orderdetail')->where('code_order', '=', $code_order)->delete();
                DB::commit();
                $result = 'success';
            } else {
                $result = 'Invalid Token';
            }
            return response()->json($result);
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json($ex);
        }
    }

    ///////////////// INPUT
    public function inputOrderTransaction(Request $request)
    {
        $token = $request->token;
        $image = $request->image;
        $codeGudang = $request->codeGudang;
        $kodeAdmin = $request->kodeAdmin;
        $keterangan = $request->keterangan;
        $jumlahbuku = $request->jumlahbuku;
        $diskonbuku = $request->diskonbuku;
        $hargabuku = $request->hargabuku;


        try {
            if ($token == 'z68cn8gfv9') {
                $ldate = date('Y');
                $ldate1 = date('m');
                $ldate2 = date('d');
                $ldate3 = date('h');
                $ldate4 = date('i');
                $ldate5 = date('s');
                $tahun = substr($ldate, 2);

                $id_rec = 'ORD-' . $tahun . $ldate1 . $ldate2 . '-' . $ldate3 . $ldate4 . $ldate5;

                $alamatDefault = 'Aqwam';
                $detailGd = DB::table('ms_barang_gudang')
                    ->select('ms_barang_gudang.code_gudang as code_gudang', 'ms_barang_gudang.nama_gudang as nama_gudang', 'ms_barang_gudang.alamat as alamat', 'ms_barang_gudang.telephone as telephone')
                    // ->join('ms_barang','ms_barang.id','=','ms_barang_promo.code_barang')
                    ->where('ms_barang_gudang.code_gudang', '=', $codeGudang)
                    ->first();

                DB::beginTransaction();

                $jumlahbukudecode = json_decode($jumlahbuku);
                $diskonbukudecode = json_decode($diskonbuku);
                $hargabukudecode = json_decode($hargabuku);
                $n = 0;
                $totalHarga = 0;
                $totalDiskon = 0;
                $totalBarang = 0;
                foreach ($jumlahbukudecode as $y => $val) {
                    $code = $y;
                    $jumlah = $val;
                    $diskon = $diskonbukudecode->$code;
                    $harga = $hargabukudecode->$code;
                    // $n += 1;
                    $orderDetail = new mod_ms_orderDetail();

                    $id = '';
                    $idchar = str_split($y);
                    foreach ($idchar as $char) {
                        if ($char == '_') {
                            break;
                        }
                        $id =  $id . $char;
                    }

                    if (strtolower($id) == 'promo') {

                        $allPromo = DB::table('ms_promo')
                            ->select('ms_promo.code_promo as codePromo', 'ms_promo.nama_promo as namaPromo', 'ms_promo.harga_jadi as hargaJadi', 'ms_promo.created_at as created_at')
                            ->where('ms_promo.code_promo', '=', $id)
                            ->get();

                        $detailPromo = DB::table('ms_barang_promo')
                            ->select('ms_barang.id as kodeBarang', 'ms_barang.judul_buku as judulBuku', 'ms_barang.harga as harga')
                            ->join('ms_barang', 'ms_barang.id', '=', 'ms_barang_promo.code_barang')
                            ->where('ms_barang_promo.code_promo', '=', $id)
                            ->get();

                        foreach ($detailPromo as $keyPromo => $valPromo) {
                            $orderDetail->code_order = $id_rec;
                            $orderDetail->code_barang = $valPromo['kodeBarang'];
                            $orderDetail->code_promo = $allPromo->codePromo;
                            $orderDetail->nama_promo = $allPromo->namaPromo;
                            $orderDetail->harga_promo = $allPromo->harga_jadi;
                            $orderDetail->jumlah = $jumlah;
                            $orderDetail->diskon = $diskon;
                            $orderDetail->harga = $harga;
                            $orderDetail->status_barang = 0;
                            $orderDetail->keterangan = '-';
                            $orderDetail->save();

                            $k = DB::table('ms_barang_stock')
                                ->select('k as stock')
                                ->where('code_barang', '=', $valPromo['kodeBarang'])
                                ->where('code_gudang', '=', $codeGudang)
                                ->first();
                            $stock = $k->stock;
                            if ($stock != null) {
                                $stock_sekarang = ($k->stock + $jumlah);
                            } else {
                                $stock_sekarang = $jumlah;
                            }

                            DB::beginTransaction();
                            DB::table('ms_barang_stock')
                                ->where('code_barang', '=', $valPromo['kodeBarang'])
                                ->where('code_gudang', '=', $codeGudang)
                                ->update([
                                    'k' => $stock_sekarang,
                                ]);
                        }
                    } else {
                        $orderDetail->code_order = $id_rec;
                        $orderDetail->code_barang = $y;
                        $orderDetail->code_promo = '-';
                        $orderDetail->nama_promo = '-';
                        $orderDetail->harga_promo = 0;
                        $orderDetail->jumlah = $jumlah;
                        $orderDetail->diskon = $diskon;
                        $orderDetail->harga = $harga;
                        $orderDetail->status_barang = 0;
                        $orderDetail->keterangan = '-';
                        $orderDetail->save();

                        $k = DB::table('ms_barang_stock')
                            ->select('k as stock')
                            ->where('code_barang', '=', $y)
                            ->where('code_gudang', '=', $codeGudang)
                            ->first();
                        $stock = $k->stock;
                        if ($stock != null) {
                            $stock_sekarang = ($k->stock + $jumlah);
                        } else {
                            $stock_sekarang = $jumlah;
                        }

                        DB::beginTransaction();
                        DB::table('ms_barang_stock')
                            ->where('code_barang', '=', $y)
                            ->where('code_gudang', '=', $codeGudang)
                            ->update([
                                'k' => $stock_sekarang,
                            ]);
                    }


                    $totalHarga = $totalHarga + ($jumlah * $harga);
                    $totalDiskon = $totalDiskon + ($jumlah * ($harga * $diskon / 100));
                    $totalBarang = $totalBarang + $jumlah;
                }


                //update jumlah
                $order = new mod_ms_order();
                $order->id = $id_rec;
                $order->image = $image;
                $order->lunas = 0;
                $order->codeGudang = 'Gd_001';
                $order->totalDiskon = $totalDiskon;
                $order->total_barang = $totalBarang;
                $order->total_harga = $totalHarga;
                $order->code_customer = 'ADM000001';
                //    $order->code_promo = $alamatDefault;
                $order->expedisi = $alamatDefault;
                $order->biayaExpedisi = 0;
                $order->nama_pengirim = $detailGd->nama_gudang;
                $order->telephone_pengirim = $detailGd->telephone;
                $order->status_alamat = 0;
                $order->nama_penerima = $detailGd->nama_gudang;
                $order->telephone_penerima = $detailGd->telephone;
                $order->alamat = $detailGd->alamat;
                $order->kecamatan = $detailGd->alamat;
                $order->kab_kota = $detailGd->alamat;
                $order->propinsi = $detailGd->alamat;
                $order->pre_order = 0;
                $order->save();


                $transaksi = new mod_transaksi();
                $transaksi->code_order = $id_rec;
                $transaksi->code_perusahaan = '1';
                $transaksi->kodeAdminTrx = $kodeAdmin;
                $transaksi->kode_AWO = $kodeAdmin;
                $transaksi->approve_sales = 1;
                $transaksi->approve_keuangan = 0;
                $transaksi->approve_sales2 = 0;
                $transaksi->approve_gudang = 0;
                $transaksi->no_resi = '0000000';
                $transaksi->hold = 0;
                $transaksi->code_status = '4';
                $transaksi->typeTransaksi = 'pembayaranAgen';
                $transaksi->keterangan = $keterangan;
                $transaksi->save();



                //    $log = 'log3';
                DB::commit();
                $result = 'success';
            } else {
                $result = 'Invalid Token';
            }
            return response()->json($result);
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json($ex);
        }
    }
}
