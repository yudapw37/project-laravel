<?php

namespace App\Http\Controllers;

use App\mod_md_ms_alamat_ro;
use App\mod_md_ms_alamat_ro_mst;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;


class c_md_synchronize extends Controller
{
    public function index() {
        return view('dashboard.master-data.synchronize.baru');
    }

    public function list() {
        return view('dashboard.master-data.synchronize.list');
    }

    public function edit($id) {
        $data = DB::table('ms_barang')
        ->where('ms_barang.id',$id)
        ->first();      
        return view('dashboard.master-data.buku.edit')->with('data',$data);
    }

    public function data(Request $request) {
        $filters = $request->filters;
        $query = DB::table('ms_alamat_ro_mst')
        ->select('ms_alamat_ro_mst.id as id','ms_alamat_ro_mst.province as province','ms_alamat_ro_mst.city_id as cityId','ms_alamat_ro_mst.city_name as kota')
        // ->select(DB::Raw("DISTINCT(ms_alamat_ro_mst.province) as province"))
        ->orderBy('ms_alamat_ro_mst.province','ASC');
        if(@$filters){
            $query->where('ms_alamat_ro_mst.province','LIKE','%'.$filters.'%');
        }
        return $query->paginate(20);
    }

   public function callApiRajaOngkir($typeReq, $typeParam, $urlSpesifik, $dataArray){
        $client = new Client();
        $url = $this-> baseUrlRajaOngkir();
        $urlApi = $url . $urlSpesifik;
        $request = strtoupper($typeReq);

        if ($typeParam == "header") { $setTypeParam = 'query'; }
        elseif ($typeParam == "body") { $setTypeParam = 'json'; }
        
        $response = $client->request($request, $urlApi, [ $setTypeParam => $dataArray ]);

        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
        }

        private function baseUrlRajaOngkir()
        {
            $baseUrl = 'https://pro.rajaongkir.com/api/';
            return $baseUrl ;
        }

        		
		 public function getprovince()
         {
                 $spesifikApi = 'city';
 
                 $typeParam = 'header';
 
                 $typeReq = 'get';
 
                 $key = '33bb31f84e8ed7d793d08db159771b2d';
                 $dataArray = ['key' => $key];
                 $province = $this->callApiRajaOngkir($typeReq, $typeParam, $spesifikApi, $dataArray);
                 return $province['rajaongkir']['results'];
        }

        public function getDistric($id)
        {
                $spesifikApi = 'subdistrict';

                $typeParam = 'header';

                $typeReq = 'get';

                $key = '33bb31f84e8ed7d793d08db159771b2d';
                $dataArray = ['key' => $key,'city'=>$id];
                $value = $this->callApiRajaOngkir($typeReq, $typeParam, $spesifikApi, $dataArray);
                return $value['rajaongkir']['results'];
       }

       public function syncroniseProvince()
       {
           try {
          $province= $this->getprovince();
          DB::table('ms_alamat_ro_mst')->delete();
       
          foreach($province as $m)
          {
           $city_id=$m['city_id'];
           $propinsi=$m['province'];
           $province_id=$m['province_id'];
           $kota = $m['city_name'];

               $ms_alamat_ro = new mod_md_ms_alamat_ro_mst();
               $ms_alamat_ro->province_id = $province_id;
               $ms_alamat_ro->city_id = $city_id;
               $ms_alamat_ro->city_name = $kota;
               $ms_alamat_ro->province = $propinsi;
               $ms_alamat_ro->save();
          }
          return 'success';
       } catch (\Exception $ex) {
           DB::rollBack();
           $err = [$ex];
           return response()->json($ex);
       }
       }

        public function syncroniseAlamat(Request $request)
        {
            $id = $request->id;
            try {

                $x = DB::table('ms_alamat_ro_mst')
                ->select('ms_alamat_ro_mst.id as id','ms_alamat_ro_mst.province_id as province_id','ms_alamat_ro_mst.province as province')
                ->where('ms_alamat_ro_mst.id','=',$id)
                ->first();

                $query = DB::table('ms_alamat_ro_mst')
                ->select('ms_alamat_ro_mst.id as id','ms_alamat_ro_mst.province_id as province_id','ms_alamat_ro_mst.province as province','ms_alamat_ro_mst.city_id as cityId')
                ->where('ms_alamat_ro_mst.province_id','=',$x->province_id)
                ->get();
                DB::beginTransaction();
           foreach($query as $m)
           {
            $idPropinsi = $m->province_id;
            $province=$m->province;
            $distric= $this->getDistric($m->cityId);
            foreach($distric as $n)
            {
                $result=$n;
                $districk = DB::table('ms_alamat_ro')->select('ms_alamat_ro.id_alamat as id')->where('ms_alamat_ro.id_alamat','=',$n['subdistrict_id'])->first();
                if ($districk) {
                    DB::table('ms_alamat_ro')->where('id_alamat','=',$districk->id)
                    ->update([
                        'text' => $n['subdistrict_name'].', '.$n['city'].', '.$n['province']
                    ]);
                }
                else
                {
                    $ms_alamat_ro = new mod_md_ms_alamat_ro();
                    $ms_alamat_ro->id_alamat = $n['subdistrict_id'];
                    $ms_alamat_ro->text = $n['subdistrict_name'].', '.$n['city'].', '.$n['province'];
                    $ms_alamat_ro->save();
                }
               
            }
           }
           DB::table('ms_alamat_ro_mst')->where('province_id','=',$idPropinsi)->delete();
        DB::commit();
           return 'success';
        } catch (\Exception $ex) {
            DB::rollBack();
            $err = [$ex];
            return response()->json($ex);
        }
    }

    // public function submit(Request $request) {
    //     $type = $request->type;
    //     try {
    //         DB::beginTransaction();

    //         $response = Http::get('http://test.com');
    //         DB::commit();
    //         return $response;
    //     } catch (\Exception $ex) {
    //         DB::rollBack();
    //         $err = [$ex];
    //         return response()->json($ex);
    //     }
    // }

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