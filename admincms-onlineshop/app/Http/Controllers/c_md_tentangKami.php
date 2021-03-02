<?php

namespace App\Http\Controllers;

use App\mod_md_flashSale;
use App\mod__ms_barang_promo;
use App\ms_promo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class c_md_tentangKami extends Controller
{
    public function index() {
        return view('dashboard.tentang-kami.baru');
    }

    public function edit($id) {
        $data = DB::table('ms_header_footer')
        ->select('id','type','text')
        ->where('id',$id)
        ->first();
       
        return view('dashboard.tentang-kami.edit')->with('data',$data);
    }

    public function data(Request $request) {
        $data['data'] =  DB::table('ms_header_footer')
        ->select('id','type','text')->get();
        return json_encode($data);
     
    }
    

    public function submit(Request $request) {
        $type = $request->type;
        $text = $request->text;
        try {
            DB::beginTransaction();

       

            if ($type == 'baru') {    
              
            } elseif ($type == 'edit') {
         
                DB::table('ms_header_footer')->where('id','=',$request->id)
                    ->update([
                       'text' => $text
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
}

