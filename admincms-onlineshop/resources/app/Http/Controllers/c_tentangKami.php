<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class c_tentangKami extends Controller
{
    public function index() {
        return view('dashboard.master-data.tentang-kami.baru');
    }

    public function getTentangKami(Request $request) {
            $data = DB::table('tbl_tentangkami')
            ->first();
            return view('dashboard.master-data.tentang-kami.baru')->with('data',$data);
    }

    public function submit(Request $request) {
        $tentangKami = $request->tentangKami;
  
        try {
            DB::beginTransaction();
  
                DB::table('tbl_tentangkami')
                    ->where('id','=','1')
                    ->update([
                        'text' => $tentangKami,   
                    ]);
            DB::commit();
            return 'success';
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json($ex);
        }
    }

}
