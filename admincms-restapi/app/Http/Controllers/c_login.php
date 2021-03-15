<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mod_admin;
use App\Http\Controllers\Session;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;

class c_login extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:api', ['except' => ['login']]);
    // }

    public function validasi($req){
        if(strlen($req) > 12){
            return 'error';
        }else{
            return $req;
        }
    }
    public function login (Request $request){
        $result = [];
        $username = $this->validasi($request->username);
        $password = $this->validasi($request->password);
        try {

            $credentials = request(['username', 'password']);

            if (! $token = auth()->attempt($credentials)) {
                $stat = ['code'=>'401', 'description'=>'Incorrect username & password'];
                            $data = ['status'=>$stat, 'result'=>'Unauthorized'];
                            $result = $data; 
                            return response()->json(['success'=>false, 'data'=>$data], 401);
            }else{
                if($username == 'error' && $password == 'error'){
                    $stat = ['code'=>'401', 'description'=>'too much variable'];
                    $data = ['status'=>$stat, 'result'=>'error'];
                    return response()->json(['success'=>false, 'data'=>$data], 401);
                }else{ 
                    $user = mod_admin::select('id as idUser', 'username', 'nama', 'kodeAdminTrx', 'password', 'keyhash', 'code_jabatan')->where('username', '=', $request->username)->first();
                
                    if($user){
                        
                        $data = $user->password;
                        $keyhash = $user -> keyhash;
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
                        
                        if($request->password==$decryptpass){
                                
                                $credentials = request(['username', 'password']);
                                
                                $token = auth()->attempt($credentials);

                                $result = [];
                                $stat = ['code'=>'200', 'description'=>'success'];
                                $usernew = ['id'=>$user->idUser, 'nama'=>$user->nama, 'jabatan' => $user->code_jabatan, 'kodeAdmin' => $user->kodeAdminTrx,
                                 'access_token' => $token, 'token_type' => 'bearer', 'expires_in' => auth()->factory()->getTTL() * 60 ];
                                $data = ['status'=>$stat, 'result'=>$usernew];
                                $result = $data;

                                return response()->json(['success'=>true, 'data'=>$data], 200);
                        }
                        else{
                            // 
                            $stat = ['code'=>'401', 'description'=>'Incorrect password'];
                            $data = ['status'=>$stat, 'result'=>'password'];
                            $result = $data; 
                            return response()->json(['success'=>false, 'data'=>$data], 401);
                            // return response()->json('salah');
                        }                   
                    }
                    else{
                        $stat = ['code'=>'401', 'description'=>'username doesnt match'];
                        $data = ['status'=>$stat, 'result'=>'username'];
                        $result = $data;
                        return response()->json(['success'=>false, 'data'=>$data], 200);
                        // echo 'salah';statussalah
                    } 
                }
                
            }
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
        
    }

    public function regist(Request $request){
        
            User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => bcrypt($request->password)
            ]);
            return response(['benar']);
        
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['success'=>true,'message' => 'Successfully logged out'], 200);
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
        $name = $request->name;
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

   public function decrypt($data, $keyhash){
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
       return $decryptpass;
   }

   public function hash(){
       $listkey=['1122','1212','2112','2121','1221','2211'];
       $listhash=['@QW', 'Q@W', 'QW@', 'W@Q', 'WQ@'];
       

       $randIndexKEY = array_rand($listkey); 
       $hashKEY = $listkey[$randIndexKEY];

       $randIndexAQW = array_rand($listhash); 
       $hashAQW = $listhash[$randIndexAQW];
       $allhash = $hashAQW.$hashKEY;
       $sufflekey =str_shuffle($allhash);

       return $sufflekey;
   }
   public function encrypt($data, $hash){
       
       $hashvar = $hash;

       $pass = $data;

       $getkey = str_replace("@","",str_replace("Q","",str_replace("W","",$hashvar)));
       $key1=(int)substr($getkey,0,1);
       $key2=(int)substr($getkey,1,1);
       $key3=(int)substr($getkey,2,1);
       $key4=(int)substr($getkey,3,1);

       $sufflepass = substr($sufflekey,0,$key1).substr($pass,0,$key1).substr($sufflekey,$key1,$key2).substr($pass,$key1,$key2).substr($sufflekey,$key1+$key2,$key3).substr($pass,$key1+$key2,$key3).substr($sufflekey,$key1+$key2+$key3,$key4).substr($pass,$key1+$key2+$key3,$key4).substr($sufflekey,$key1+$key2+$key3+$key4).substr($pass,$key1+$key2+$key3+$key4);
       
       $simple_string = $sufflepass;

       $key = 'bRuD5WYw5wd0rdHR9yLlM6wt2vteuiniQBqE70nAuhU=';

       $encryption_key = base64_decode($key);
       $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
       $encrypted = openssl_encrypt($simple_string, 'aes-256-cbc', $encryption_key, 0, $iv);
       $encryption = base64_encode($encrypted . '::' . $iv);

       return $encryption;

   }

   protected function respondWithToken($token, $data)
    {
        return response()->json([
            'success'=>true,
            'data'=>$data,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ], 200);
    }
}
