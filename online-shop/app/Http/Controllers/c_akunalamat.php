<?php

namespace App\Http\Controllers;
use App\mod_penerima_alamat;
use App\mod_alamat_ro;
use Illuminate\Http\Request;

class c_akunalamat extends Controller
{
    public function index(Request $request){
        $page = $request->page;

        if ($request->session()->has('idUser')){
            $idUser=$request->session()->get('idUser');
            $alamat = mod_penerima_alamat::select('id','code_customer','nama','no_telp','alamat','kecamatan','kode_ro')->where('code_customer','=', $idUser )->where('is_delete','=', 0 )->orderBy('updated_at', 'DESC')->skip($page)->take(5)->get(); 
            if($alamat){ return $alamat;}
            else{return 'null';}
           
        }else{
            return 'login';
        }
            
    }
    public function count(Request $request){
        $page = $request->page;

        if ($request->session()->has('idUser')){
            $idUser=$request->session()->get('idUser');
            $count = $alamat = mod_penerima_alamat::where('code_customer','=', $idUser )->where('is_delete','=', 0 )->count();
            return $count;
        }else{
            return 'login';
        }
            
    }

    public function detailalamatakun(Request $request){
        $id = $request->id;

        if ($request->session()->has('idUser')){
            $idUser=$request->session()->get('idUser');
            $alamat = mod_penerima_alamat::select('id','code_customer','nama','no_telp','alamat','kecamatan','kode_ro')
                    ->where('code_customer','=', $idUser )->where('is_delete','=', 0 )->where('id','=', $id )->first(); 
            if($alamat){ return $alamat;}
            else{return 'null';}
           
        }else{
            return 'login';
        }
            
    }

    public function getalamat(Request $request){

        if ($request->session()->has('idUser')){
            $idUser=$request->session()->get('idUser');
            $alamat = mod_penerima_alamat::select('id','code_customer','nama','no_telp','alamat','kecamatan','kode_ro')->where('code_customer','=', $idUser )->where('is_delete','=', 0 )->orderBy('updated_at', 'DESC')->get(); 
            if($alamat){ return $alamat;}
            else{return 'null';}
           
        }else{
            return 'login';
        }
            
    }
    public function getalamatutama(Request $request){

        if ($request->session()->has('idUser')){
            $idUser=$request->session()->get('idUser');
            $alamat = mod_penerima_alamat::select('id','code_customer','nama','no_telp','alamat','kecamatan','kode_ro')->where('code_customer','=', $idUser )->where('id','=', $request->id )->where('is_delete','=', 0 )->orderBy('updated_at', 'DESC')->first(); 
            if($alamat){ return $alamat;}
            else{return 'null';}
           
        }else{
            return 'login';
        }
            
    }

    public function alamatro(Request $request){
            

        $val=$request->val;
        if ($request->session()->has('idUser')){
            
            $idUser=$request->session()->get('idUser');
            $alamat = mod_alamat_ro::where('text','like','%'.$val.'%' )->orderBy('text', 'ASC')->take(20)->get(); 
            if($alamat){ return $alamat;}
            else{return 'null';}
           
        }else{
            return 'login';
        }
            
    }

    public function addalamatakun(Request $request){
        if ($request->session()->has('idUser')){  
                $request->validate([
                    'nama'=>'required|max:99|min:1',
                    'no_telp'=>'required|min:1|numeric',
                    'alamat'=>'required|max:999|min:1',
                    'kecamatan'=>'required',
                    'kode_ro'=>'required',
                ]);
            $idUser=$request->session()->get('idUser');
            $alamat = mod_penerima_alamat::where('code_customer','=', $idUser )->where('is_delete','=', 0 )->orderBy('updated_at', 'DESC')->get(); 
            if(count($alamat)>9){
                return 'hapus';
            }else{        
                mod_penerima_alamat::create([
                    'code_customer' => $idUser,
                    'nama' => $request->nama,
                    'no_telp' => $request->no_telp,
                    'alamat' => $request->alamat,
                    'kecamatan' =>$request->kecamatan,
                    'kode_ro' => $request->kode_ro
                ]);
                return 'sukses';
            }
        }else{
            return 'login';
        }
    }
    public function editalamatakun(Request $request){
        if ($request->session()->has('idUser')){  
            $id=$request->id;
                $request->validate([
                    'nama'=>'required|max:99|min:1',
                    'no_telp'=>'required|min:1|numeric',
                    'alamat'=>'required|max:999|min:1',
                    'kecamatan'=>'required',
                    'kode_ro'=>'required',
                ]);
            $idUser=$request->session()->get('idUser');
                   
                mod_penerima_alamat::where('code_customer','=', $idUser )
                ->where('id','=', $id )
                ->update([
                    'nama' => $request->nama,
                    'no_telp' => $request->no_telp,
                    'alamat' => $request->alamat,
                    'kecamatan' =>$request->kecamatan,
                    'kode_ro' => $request->kode_ro
                ]);
                return 'sukses';
        }else{
            return 'login';
        }
    }
    public function hapusalamatakun(Request $request){
        if ($request->session()->has('idUser')){  
            $id=$request->id;
            $idUser=$request->session()->get('idUser');
                  
                mod_penerima_alamat::where('code_customer','=', $idUser )
                ->where('id','=', $id )
                ->update([                    
                    'is_delete' => 1
                ]);
                return 'sukses';
           
        }else{
            return 'login';
        }
    }
}
