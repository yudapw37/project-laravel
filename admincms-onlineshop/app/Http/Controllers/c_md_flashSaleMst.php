<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;



class c_md_flashSaleMst extends Controller
{
    public function index() {
        $data = DB::table('ms_flashsale_general')
        ->select('ms_flashsale_general.id as id','ms_flashsale_general.gambar_sale as gambar_sale','ms_flashsale_general.waktu as waktu')
        ->first();
        $url = app('App\Http\Controllers\c_utility')->url();
        return view('dashboard.master-data.flash-sale-Mst.baru')->with('data',$data)->with('url',$url);
    }

    public function updateData(Request $request) {
        $type = $request->type;
        $tanggal = $request->tanggal;
  
        $gambar = $request->foto;
    
        // $foto = ($request->foto !== '') ? ;
        try {
            DB::beginTransaction();
            $filename = null;
           
            if ($gambar !== '') {
             
                $fileFoto=$request->file('foto');
              
                $filename = time().'.'.$fileFoto->getClientOriginalExtension();    
                
                $tujuan_upload = 'public/';

                $team = DB::table('ms_flashsale_general')->where('id','=',$request->id)->first();

                Storage::disk('public')->delete($team->file_name);
                // $fileFoto->move($tujuan_upload,$filename);
                Storage::putFileAs('public',$fileFoto,$filename);    
            }
          
            DB::table('ms_flashsale_general')->where('id','=',$request->id)
            ->update([
            //   'waktu' => $fasilitas,
              'gambar_sale' => 'storage/'.$filename,
              'file_name' => $filename,
              'waktu' => $tanggal.'-00-00-00'
             
            ]);
        
            $result = 'success';
      
            DB::commit();
            return $result;
        } catch (\Exception $ex) {
            DB::rollBack();
            $err = [$ex];
            return response()->json($ex);
        }
    }

}
