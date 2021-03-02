<?php

namespace App\Http\Controllers;

use App\mod_md_ms_kode_ro_log;
use App\mod_md_ms_kode_ro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class c_md_kodeExpedisi extends Controller
{
    public function index() {
        return view('dashboard.validasi-admin.kode-expedisi.baru');
    }

    public function list() {
        return view('dashboard.validasi-admin.kode-expedisi.list');
    }

    public function edit($id) {
        $data = DB::table('tbl_instansi_fasilitas')
        ->select('id','fasilitas')
        ->where('id',$id)
        ->first();
       
        return view('dashboard.validasi-admin.kode-expedisi.edit')->with('data',$data);
    }

    public function data(Request $request) {
        try
        {
            // if ($request->session()->has('idUser')){

        $username = $request->session()->get('username');
        // $filters = $request->filters;
        // $pic = $username;
        // $data = [
        //     'where' => []
        // ];
        // if ($filters !== null) {
        //     foreach ($filters as $f) {
        //         $data['where'][] = [
        //             $f['field'],$f['type'],'%'.$f['value'].'%'
        //         ];
        //     }
        // }

        $query = DB::table('ms_kode_ro')
        ->select('id','kode_ro','expedisi','total_berat','total_harga','pic')
        ->where('pic','=', $username);

        if(@$filters){
            $query->where('kode_ro','LIKE','%'.$filters.'%');
        }
       
         return $query->paginate(10);
        
    } catch (\Exception $ex) {
 
        $err = [$ex];
        return response()->json($request);
    }
    }

    public function submit(Request $request) {
        $type = $request->type;
        $expedisi = $request->iExpedisi;
        $totalBerat = $request->iTotalBerat;
        $totalHarga = $request->iTotalHarga;
        $pic=$request->username;
        try {
            DB::beginTransaction();

            if ($type == 'baru') {
                $ldate = date('Y');
                $ldate1 = date('m');
                $ldate2 = date('d');
          

                $id_rec = 'EX'.$ldate1.$ldate2.Str::random(5);
                        $transaksi = new mod_md_ms_kode_ro();
                        $transaksi->kode_ro = $id_rec;
                        $transaksi->expedisi = $expedisi;
                        $transaksi->total_berat = $totalBerat;
                        $transaksi->total_harga = $totalHarga;
                        $transaksi->pic = $pic;
                        $transaksi->save();

                        $c = new mod_md_ms_kode_ro_log();
                        $c->kode_ro  = $id_rec;
                        $c->expedisi = $expedisi;
                        $c->total_berat = $totalBerat;
                        $c->total_harga = $totalHarga;
                        $c->pic = $pic;
                        $c->save();
                    $result = 'success';
            } elseif ($type == 'edit') {
         
                DB::table('tbl_instansi_fasilitas')->where('id','=',$request->id)
                    ->update([
                       'fasilitas' => $fasilitas
                    ]);
        
                $result = 'success';
            }
            DB::commit();
            return $result;
        } catch (\Exception $ex) {
            DB::rollBack();
            $err = [$ex];
            return response()->json($ex);
        }
    
    }

    public function delete(Request $request) {
        $id = $request->id;
        try {
            DB::beginTransaction();
            DB::table('tbl_instansi_fasilitas')->where('id','=',$id)->delete();
            DB::commit();
            return 'success';
        } catch (\Exception $ex) {
            DB::rollBack();
            return json_encode([$ex]);
        }
    }
}