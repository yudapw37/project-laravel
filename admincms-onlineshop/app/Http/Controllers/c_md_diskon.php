<?php

namespace App\Http\Controllers;
use App\mod_md_ms_diskon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class c_md_diskon extends Controller
{
    public function index() {
        return view('dashboard.master-data.diskon.baru');
    }

    public function list() {
        return view('dashboard.master-data.diskon.list');
    }

    public function edit($id) {
        $data = DB::table('ms_diskon')
        ->where('ms_diskon.id',$id)
        ->first();      
        return view('dashboard.master-data.diskon.edit')->with('data',$data);
    }

    public function data(Request $request) {
        $data['data'] =  DB::table('ms_diskon')
        ->orderBy('ms_diskon.id','ASC')->get();
        return json_encode($data);
    }

    public function submit(Request $request) {
        $type = $request->type;
        $diskon = $request->diskon;
        $minimalNominal = $request->minimalNominal;
        $maximalNominal = $request->maximalNominal;
        $tipe = $request->tipe;
     
        try {
            DB::beginTransaction();

            $filename = null;

            if ($type == 'baru') {    

                        $transaksi = new mod_md_ms_diskon();
                        $transaksi->jenis_user = $tipe;
                        $transaksi->rangeMin = $minimalNominal;
                        $transaksi->rangeMax = $maximalNominal;
                        $transaksi->diskon = $diskon;
                        $transaksi->save();
                    $result = 'success';
            } elseif ($type == 'edit') {
         
                DB::table('ms_diskon')->where('id','=',$request->id)
                    ->update([
                       'diskon' => $diskon,
                       'rangeMax'=>$maximalNominal,
                       'rangeMin'=>$minimalNominal
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
            DB::table('ms_barang')->where('id','=',$id)->delete();
            DB::commit();
            return 'success';
        } catch (\Exception $ex) {
            DB::rollBack();
            return json_encode([$ex]);
        }
    }
}


