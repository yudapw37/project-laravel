<?php

namespace App\Http\Controllers;
use App\mod_admin;
use Illuminate\Http\Request;
use DB;
class c_admin extends Controller
{
    public function validasi($req){
        if(strlen($req) > 12){
            return 'error';
        }else{
            return $req;
        }
    }
    public function getAdmin (Request $request){
        $limit = 10;
        $offset = 0;
        $getOffset = $request->offset;
        if($getOffset){
            if($getOffset == 1){
                $offset = 0;
            }
            else{
               $offset = ($getOffset-1)*10; 
            }            
        }
        $name = $this->validasi($request->name);
        $result = [];
        try {
            if( $name == 'error'){
                $stat = ['code'=>'401', 'description'=>'too much variable'];
                $data = ['status'=>$stat, 'result'=>'error'];
                return response()->json(['success'=>false, 'data'=>$data], 401);
            }else{    
                $getAdmin = 
                        DB::table('ms_admin')
                        ->select('ms_admin.id as idUser', 'ms_admin.username', 'ms_admin.kodeAdminTrx', 'ms_admin.nama as nama', 'ms_admin.code_jabatan as code_jabatan', 'ms_jabatan.jabatan', 'ms_admin.no_telp', 'ms_admin.code_perusahaan as code_lokasi', 'ms_perusahaan.nama as lokasi')
                        ->join('ms_jabatan', 'ms_jabatan.id', '=', 'ms_admin.code_jabatan')
                        ->leftjoin('ms_perusahaan', 'ms_perusahaan.id', '=', 'ms_admin.code_perusahaan')
                        ->where('ms_admin.nama','Like', '%'.$name.'%')
                        ->orderBy('ms_admin.nama', 'asc')
                        ->limit($limit)
                        ->offset($offset)
                        ->get();
                        
                if(count($getAdmin)!=0){
                    return response()->json(['success'=>true, 'data'=>$getAdmin], 200);  
                }
                else{
                    $stat = ['code'=>'401', 'description'=>'doesnt match data'];
                    $data = ['status'=>$stat, 'result'=>'null'];
                    return response()->json(['success'=>false, 'data'=>$data], 401); 
                }
            }
                        
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
        
    }
}
