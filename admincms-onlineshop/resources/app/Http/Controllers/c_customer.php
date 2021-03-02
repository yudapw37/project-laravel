<?php

namespace App\Http\Controllers;
use App\mod_transaksi;
use App\mod_ms_order;
use App\mod_ms_orderDetail;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\Psr7\str;


class c_customer extends Controller
{
    public function insertOrder(Request $request) {
        $username = $request->username;
        $kodeAdmin = $request->kodeAdmin;
        $ldate = date('Y');
        $ldate1 = date('m');
        $ldate2 = date('d');
        try {
            DB::beginTransaction();
                    $user = new mod_transaksi();
                    $user->codeOrder = '-';
                    $user->codePerusahaan = 1;
                    $user->idCustomer = $username;
                    $user->sales = $kodeAdmin;
                    $user->statusTerakhir = 'Order Baru';
                     $user->tglInput = date('Y:m:d');
                    $user->save();

                    $kode = str_pad($user->id, 3, '0', STR_PAD_LEFT);
                    $id_rec = 'ORD-'.$ldate.$ldate1.$ldate2.'-'.$kode;
                    DB::table('ms_transaksi')->where('id', '=', $user->id)
                    ->update([
                        'codeOrder' => $id_rec
                    ]);

                    $order = new mod_ms_order();
                    $order->kodePembeli = $username;
                    $order->kodeOrderDetail = $id_rec;
                    $order->save();

                    $orderDetail = new mod_ms_orderDetail();
                    $orderDetail->idOrderDetail = $id_rec;
                    $orderDetail->kodeBarang = 'A002';
                    $orderDetail->qty = 5;
                    $orderDetail->harga = 76000;
                    $user->save();

                    $result = 'success';
            DB::commit();
            return $result;
        } catch (\Exception $ex) {
            DB::rollBack();
            $err = [$ex];
            return response()->json($user);
        }
    }
}
