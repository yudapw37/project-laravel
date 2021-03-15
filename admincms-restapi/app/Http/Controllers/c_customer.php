<?php

namespace App\Http\Controllers;
use DB;
use App\mod_customer;
use Illuminate\Http\Request;

class c_customer extends Controller
{
    public function getCustomer (Request $request){
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
        $name = $this->validasi($request->nama);
        $result = [];

        $dataval = [];
        $a=array();

        try {
            // var_dump(strlen($name));
            if($name == 'error'){
                $stat = ['code'=>'401', 'description'=>'too much variable'];
                $data = ['status'=>$stat, 'result'=>'error'];
                return response()->json(['success'=>false, 'data'=>$nama], 401);

            }else{
                
                $getCust = 
                        DB::table('ms_customer')
                        ->select('id as idCust', 'username as userName', 'jenis_reseller as jenisCust', 'nama', 'telephone', 'alamat')
                        ->where('nama','Like', '%'.$name.'%')
                        ->orderBy('nama', 'asc')
                        ->limit($limit)
                        ->offset($offset)
                        ->get();
                foreach($getCust as $var){
                    $idCust = $var->idCust;
                    $userName = $var->userName;    
                    $jenisCust = (int)$var->jenisCust; 
                    $nama = $var->nama; 
                    $telephone = $var->telephone; 
                    $alamat = $var->alamat;
                    $dataval = ['idCust'=>$idCust, 'userName'=>$userName, 'jenisCust'=>$jenisCust, 'nama'=>$nama, 'telephone'=>$telephone, 'alamat'=>$alamat];
                    array_push($a, $dataval);
                }        
                if(count($getCust)!=0){
                    return response()->json(['success'=>true, 'data'=>$a], 200);  
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
    public function getDetailCust(Request $request){
        $idCust = $this->validasi($request->idCust);
        try {
            // var_dump($idCust);
            if($idCust == 'error'){
                    $stat = ['code'=>'401', 'description'=>'too much variable'];
                    $data = ['status'=>$stat, 'result'=>'error'];
                    return response()->json(['success'=>false, 'data'=>$data], 401);

            }else{
                // var_dump($idCust);
                $dataval = [];
                $getCust = 
                        DB::table('ms_customer')
                        ->select('id as idCust', 'username as userId',  'userId as username','nama', 
                         'jenis_reseller as jenisCust', 'email','telephone', 'alamat')                        
                        ->where('id','=', $idCust)
                        ->first();
                        
                        $idCust = $getCust->idCust;
                        $userId = $getCust->userId; 
                        $userName = $getCust->username;  
                        $jenisCust = (int)$getCust->jenisCust; 
                        $nama = $getCust->nama; 
                        $telephone = $getCust->telephone; 
                        $alamat = $getCust->alamat;
                        $dataval = ['idCust'=>$idCust, 'userId'=>$userId, 'userName'=>$userName, 'jenisCust'=>$jenisCust, 'nama'=>$nama, 'telephone'=>$telephone, 'alamat'=>$alamat];
                                

                if($getCust){
                    return response()->json(['success'=>true, 'data'=>$dataval], 200);  
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
    public function editcust(Request $request){
        $idCust = $this->validasinotnull($request->idCust, 'Id');
        // $username = $request->username;
        $alamat = $request->alamat;
        $nama = $request->nama;
        $jenisCust = $request->jenisCust;
        $telephone = $request->telephone;
        
        try {
            if(substr($idCust,-4) =='null'){
                    $stat = ['code'=>'401', 'description'=>$idCust.'. Cant edit data'];
                    $data = ['status'=>$stat, 'result'=>'error'];
                    return response()->json(['success'=>false, 'data'=>$data], 401);

            }else{
                
                mod_customer::where('id', '=', $idCust)
                        ->update
                        ([
                            'alamat' => $alamat,
                            'nama' => $nama,
                            'jenis_reseller' => $jenisCust,
                            'telephone' => $telephone
                        ]);
            }
            return response()->json(['success'=>true, 'data'=>'success'], 200); 
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }

    public function resetPasswordCust(Request $request){
        $idCust = $this->validasinotnull($request->idCust, 'Id');
        try {
            if(substr($idCust,-4) =='null'){
                    $stat = ['code'=>'401', 'description'=>$idCust.'. Cant edit data'];
                    $data = ['status'=>$stat, 'result'=>'error'];
                    return response()->json(['success'=>false, 'data'=>$data], 401);

            }else{

                $data = '@!2e*45';
                $gethash = $this->hash();
                $keyenc = base64_encode($gethash);
                // $pass = encrypt($data, $gethash);

                $hashvar = $gethash;

                $pass = $data;

                $getkey = str_replace("@","",str_replace("Q","",str_replace("W","",$hashvar)));
                $key1=(int)substr($getkey,0,1);
                $key2=(int)substr($getkey,1,1);
                $key3=(int)substr($getkey,2,1);
                $key4=(int)substr($getkey,3,1);

                $sufflepass = substr( $hashvar,0,$key1).substr($pass,0,$key1).substr($hashvar,$key1,$key2).substr($pass,$key1,$key2).substr($hashvar,$key1+$key2,$key3).substr($pass,$key1+$key2,$key3).substr($hashvar,$key1+$key2+$key3,$key4).substr($pass,$key1+$key2+$key3,$key4).substr($hashvar,$key1+$key2+$key3+$key4).substr($pass,$key1+$key2+$key3+$key4);
                
                $simple_string = $sufflepass;

                $key = 'bRuD5WYw5wd0rdHR9yLlM6wt2vteuiniQBqE70nAuhU=';

                $encryption_key = base64_decode($key);
                $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
                $encrypted = openssl_encrypt($simple_string, 'aes-256-cbc', $encryption_key, 0, $iv);
                $encryption = base64_encode($encrypted . '::' . $iv);
                
                mod_customer::where('id', '=', $idCust)
                    ->update
                        ([
                            'password' => $encryption,
                            'keyhash' => $keyenc
                        ]);
            }
            return response()->json(['success'=>true, 'data'=>'success' ], 200); 
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }

    public function validasi($req){
        if(strlen($req) > 17){
            return 'error';
        }else{
            return $req;
        }
    }
    public function validasiadd($req, $type){
        $rslt;
        if(strlen($req) == 0){
            if($type == 'int'){
                $rslt= 0;
            }else{$rslt='-';}
            
        }else{
            $rslt=$req;
        }
        return $req;
    }
    public function validasinotnull($req, $string){
        $rslt;
        if(strlen($req) < 1){
            $rslt = $string.' cant null';
        }else{
            $rslt = $req;
        }
        return $rslt;
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
}

