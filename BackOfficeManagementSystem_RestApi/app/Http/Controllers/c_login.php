<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use http\Env\Response;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\Psr7\str;

class c_login extends Controller
{
    public function login(Request $request) {
        $token = $request->token;
        $username = $request->username;
        $pass = $request->password;
        $password=base64_decode($pass);
        try {
            if($token=='eijcf9ma6b')
            {
                $dtUser = DB::table('ms_admin')
                    ->where('username','=',$username);
                if ($dtUser->exists()) {
                    $user = $dtUser->first();
                
                    $data = $user->password;
                    $keyhash = $user->keyhash;
                    if($keyhash == '-'){
                        $result = '2';
                    }
                    if($keyhash == null){
                        $result = '2';
                    }
                    // $decryptpass=decrypt($data, $keyhash);  
                    
                    $keydec=base64_decode($keyhash);
        
                    $passdb = $data;
                    $passkey = $keydec;
        
                    $sufflekey =$passkey;
        
                    $getkey = str_replace("@","",str_replace("Q","",str_replace("W","",$sufflekey)));
                    $key1=(int)substr($getkey,0,1);
                    $key2=(int)substr($getkey,1,1);
                    $key3=(int)substr($getkey,2,1);
                    $key4=(int)substr($getkey,3,1);
        
                
                    $key = 'bRuD5WYw5wd0rdHR9yLlM6wt2vteuiniQBqE70nAuhU=';
        
                    $encryption_key = base64_decode($key);
                    list($encrypted_data, $iv) = explode('::', base64_decode($passdb), 2);
                    $decryption= openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
        
                    $decryptpass = substr($decryption,$key1,$key1).substr($decryption,2*$key1+$key2,$key2).substr($decryption,2*$key1+2*$key2+$key3,$key3).substr($decryption,2*$key1+2*$key2+2*$key3+$key4,$key4).substr($decryption,2*$key1+2*$key2+2*$key3+2*$key4+1);
                    
                    if($decryptpass==$password){
                        $result = [];
                        $result = [
                                DB::table('ms_admin')
                                ->select('ms_admin.id as id','ms_admin.username  as username','ms_admin.nama as nama','ms_jabatan.jabatan as tipe','ms_admin.kodeAdminTrx as kodeAdmin','ms_admin.tipe as su')       
                                ->join('ms_jabatan','ms_jabatan.id','=','ms_admin.code_jabatan')         
                                ->where('username','=',$username)->first(),
                        ];          
                    } else {
                        $result = '2';
                    }
                } else {
                    $result = '1';
                }
            }
            else
            {
                $result = 'Invalid Token';   
            }
        
            return response()->json($result);
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }


    public function loginAndroid(Request $request) {
        $token = $request->token;
        $username = $request->username;
	$password= $request->password;
        

        //$password = $request->password;
        try {
            if($token=='eijcf9ma6b')
            {
                $dtUser = DB::table('ms_admin')
                    ->where('username','=',$username)
                    ->where('ms_admin.code_jabatan','=','4');
		    
                if ($dtUser->exists()) {
                    $user = $dtUser->first();
                
                    $data = $user->password;
                    $keyhash = $user->keyhash;
                    if($keyhash == '-'){
                        $result = [
                            'status' => '2',               
                        ];
                    }
                    if($keyhash == null){
                        $result = [
                            'status' => '2',               
                        ];
                    }
                    // $decryptpass=decrypt($data, $keyhash);  
                    
                    $keydec=base64_decode($keyhash);
        
                    $passdb = $data;
                    $passkey = $keydec;
        
                    $sufflekey =$passkey;
        
                    $getkey = str_replace("@","",str_replace("Q","",str_replace("W","",$sufflekey)));
                    $key1=(int)substr($getkey,0,1);
                    $key2=(int)substr($getkey,1,1);
                    $key3=(int)substr($getkey,2,1);
                    $key4=(int)substr($getkey,3,1);
        
                
                    $key = 'bRuD5WYw5wd0rdHR9yLlM6wt2vteuiniQBqE70nAuhU=';
        
                    $encryption_key = base64_decode($key);
                    list($encrypted_data, $iv) = explode('::', base64_decode($passdb), 2);
                    $decryption= openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
        
                    $decryptpass = substr($decryption,$key1,$key1).substr($decryption,2*$key1+$key2,$key2).substr($decryption,2*$key1+2*$key2+$key3,$key3).substr($decryption,2*$key1+2*$key2+2*$key3+$key4,$key4).substr($decryption,2*$key1+2*$key2+2*$key3+2*$key4+1);
                    

                  
                    
                    if ($decryptpass==$password) {
                                    $result = [];
                                    $result = [
                                        'status' => 'success',               
                                    ];
                    } else {
                        $result = [
                            'status' => '2',               
                        ];
                    }
                } else {
                    $result = [
                        'status' => '1',               
                    ];
                }
            }
            else
            {
                $result = 'Invalid Token';   
            }
        
            return response()->json($result);
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }
}
