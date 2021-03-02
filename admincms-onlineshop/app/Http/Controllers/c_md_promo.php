<?php

namespace App\Http\Controllers;
use App\mod__ms_barang_promo;
use App\ms_promo;

use App\mod_md_ms_promo;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;


class c_md_promo extends Controller
{
    public function index() {
        DB::table('ms_barang_promo_outstanding')->delete();
        return view('dashboard.master-data.promo-msa.baru');
    }

    public function list() {
        return view('dashboard.master-data.promo-msa.list');
    }

    public function edit($id) {
        try
        {
        DB::beginTransaction();
        DB::table('ms_barang_promo_outstanding')->delete();
        $data = DB::table('ms_promo')
        ->where('ms_promo.code_promo',$id)->first();    
        $dataPromo = DB::table('ms_barang_promo')
        ->where('ms_barang_promo.code_promo',$id)->get();    
   
        foreach($dataPromo as $key => $val)
        {
            $d = DB::table('ms_barang')->where('id','=',$val->code_barang)->first();
            $k = new mod_md_ms_promo();
            $k->code_buku = $d->id;
            $k->judul_buku = $d->judul_buku;
            $k->berat = $d->berat;
            $k->harga = $d->harga;
            $k->save();
        
        }
   
        DB::commit();
        return view('dashboard.master-data.promo-msa.edit')->with('data',$data);

    } catch (\Exception $ex) {
        DB::rollBack();
        return json_encode([$data]);
    }
    }



    public function data(Request $request) {
        $data['data'] = DB::table('ms_promo')
        ->get();
    return json_encode($data);
    }

    public function listBuku(Request $request) {
        $data['data'] = DB::table('ms_barang')
            ->select('ms_barang.id as id','ms_barang.judul_buku as judul_buku','ms_barang.harga as harga','ms_barang.berat as berat')
            ->orderBy('ms_barang.judul_buku','ASC')
            ->get();
        return json_encode($data);
    }

    public function listBukuTrn($id) {
        $data['data'] = DB::table('ms_barang_promo')
            ->select('ms_barang_promo.id as id','ms_barang_promo.code_promo as code_promo','ms_barang_promo.code_barang as code_barang','ms_barang.judul_buku as judul_buku','ms_barang.harga as harga','ms_barang.berat as berat')
            ->join('ms_barang','ms_barang.id','ms_barang_promo.code_barang')
            ->where('ms_barang_promo.code_promo','=',$id)
            ->get();
        return json_encode($data);
    }

    public function listBukuOutstanding(Request $request) {
        $data['data'] = DB::table('ms_barang_promo_outstanding')
            ->select('ms_barang_promo_outstanding.id as id','ms_barang_promo_outstanding.code_buku as code_buku','ms_barang_promo_outstanding.judul_buku as judul_buku','ms_barang_promo_outstanding.harga as harga','ms_barang_promo_outstanding.berat as berat')
            ->orderBy('ms_barang_promo_outstanding.judul_buku','ASC')
            ->get();
        return json_encode($data);
    }

    public function submit(Request $request) {
        $type = $request->type;
        $nama_promo = $request->namaPromo;
        $hargaJadi = $request->hargaJadi;
        $tanggal = $request->tanggal;
        $code_promo=$request->code_promo;
        $gambar = $request->foto;
        $foto = ($request->foto !== '') ? $request->file('foto') : '';
        try {
            DB::beginTransaction();

            $filename = null;

            if ($type == 'baru') {   
                $count = DB::table('ms_promo')
                ->select(DB::raw('COUNT(ms_promo.code_promo) as count'))
                ->first();

                $outstanding = DB::table('ms_barang_promo_outstanding')->get();

                $ldate = date('Y');
                $ldate1 = date('m');
                $ldate2 = date('d');
                $ldate3 = date('h');
                $ldate4 = date('i');
                $ldate5 = date('s');
                $tahun = substr($ldate,2);
                $totalBerat=0;
           
                $c = $count->count;
                $kode = 'promo_' .$tahun.$ldate1.$ldate2.'_'.$ldate3.$ldate4.$ldate5.'_'.str_pad($c, 5, '0', STR_PAD_LEFT);


                foreach($outstanding as $key => $val)
                {
                   
                    $barangPromo = new mod__ms_barang_promo();
                        $barangPromo->code_promo = $kode;
                        $barangPromo->code_barang = $val->code_buku;
                        $barangPromo->save();
                        $totalBerat +=  $val->berat ;
                } 

                if ($gambar !== '') {
             
                    $fileFoto=$request->file('foto');
                  
                    $filename = time().'.'.$fileFoto->getClientOriginalExtension();    
                    
                    $tujuan_upload = 'public/';
    
                    Storage::putFileAs('public',$fileFoto,$filename);    
                }
                
              
                $promo = new ms_promo();
                $promo->code_promo = $kode;
                $promo->gambar_buku = $filename;
                $promo->nama_promo = $nama_promo;
                $promo->harga_jadi = $hargaJadi;
                $promo->berat_total = $totalBerat;
                $promo->tanggal_cetak = $tanggal;
                $promo->save();
                DB::table('ms_barang_promo_outstanding')->delete();
                    $result = 'success';

            } elseif ($type == 'edit') {
                if($request->file('foto') !==null){
                    $fileFoto=$request->file('foto');              
                    $filename =  time().'.'.$fileFoto->getClientOriginalExtension();  
                    Storage::putFileAs('public',$fileFoto,$filename);


                    $totalBerat=0;
                    $outstanding = DB::table('ms_barang_promo_outstanding')->get();
                    $s = DB::table('ms_barang_promo')->where('code_promo','=',$request->code_promo)->delete();
                    foreach($outstanding as $key => $val)
                    {
                        $barangPromo = new mod__ms_barang_promo();
                            $barangPromo->code_promo = $request->code_promo;
                            $barangPromo->code_barang = $val->code_buku;
                            $barangPromo->save();
                            $totalBerat +=  $val->berat ;
                    } 
                    $tz = 'Asia/Jakarta';
                    $dt = new DateTime("now", new DateTimeZone($tz));
                    $timestamp = $dt->format('Y-m-d G:i:s');
                  
                    DB::table('ms_promo')->where('code_promo','=',$code_promo)
                    ->update([
                        'nama_promo' => $nama_promo,
                        'harga_jadi' => $hargaJadi,
                        'berat_total' => $totalBerat,
                        'gambar_buku'=> 'storage/'.$filename,
                        'updated_at' => $timestamp
                    ]);
              
                    DB::table('ms_barang_promo_outstanding')->delete();
                    $result = 'success';


                }
                else
                {
                    $totalBerat=0;
                    $outstanding = DB::table('ms_barang_promo_outstanding')->get();
                    $s = DB::table('ms_barang_promo')->where('code_promo','=',$request->code_promo)->delete();
                    foreach($outstanding as $key => $val)
                    {
                        $barangPromo = new mod__ms_barang_promo();
                            $barangPromo->code_promo = $request->code_promo;
                            $barangPromo->code_barang = $val->code_buku;
                            $barangPromo->save();
                            $totalBerat +=  $val->berat ;
                    } 
                  
                    DB::table('ms_promo')->where('code_promo','=',$code_promo)
                    ->update([
                        'nama_promo' => $nama_promo,
                        'harga_jadi' => $hargaJadi,
                        'berat_total' => $totalBerat,
                    ]);
              
                    DB::table('ms_barang_promo_outstanding')->delete();
                    $result = 'success';
                }
                    
            }
            DB::commit();
            return     $result;
        } catch (\Exception $ex) {
            DB::rollBack();
            $err = [$ex];
            return response()->json($ex);
        }
    }

    // public function submitCollection(Request $request) {
    //     $id = $request->id;
    //     $file = $request->file('filepond');
    //     $extension = $request->file('filepond')->getClientOriginalExtension();

    //     try {
    //         DB::beginTransaction();
    //         $filename = Uuid::uuid1()->toString().'.'.$extension;

    //         Storage::putFileAs('public',$file,$filename);

    //         $gambar = new mod_md_ms_gambar_buku();
    //         $gambar->id_buku = $id;
    //         $gambar->gambar = 'storage/'.$filename;
    //         $gambar->save();

    //         DB::commit();
    //         return 'success';
    //     } catch (\Exception $ex) {
    //         DB::rollBack();
    //         dd('Exception Block',$ex);
    //     }
    // }

    public function listBukuOutstandingAdd(Request $request) {
        $id = $request->id;
        try {
            DB::beginTransaction();
            $x = DB::table('ms_barang_promo_outstanding')->where('code_buku','=',$id);
            $d = DB::table('ms_barang')->where('id','=',$id)->first();
            if ($x->doesntExist()) {
                $data = new mod_md_ms_promo();
                $data->code_buku = $id;
                $data->judul_buku = $d->judul_buku;
                $data->berat = $d->berat;
                $data->harga = $d->harga;
                $data->save();
                $result ='success';
                DB::commit();
            }
            else
            {
                $result='false';
            }
          
          return $result;
           
        } catch (\Exception $ex) {
            DB::rollBack();
            return json_encode([$ex]);
        }
    }

    public function listBukuOutstandingDelete(Request $request) {
        $id = $request->id;
        try {
            DB::beginTransaction();
            DB::table('ms_barang_promo_outstanding')->where('id','=',$id)->delete();
            DB::commit();
            return 'success';
        } catch (\Exception $ex) {
            DB::rollBack();
            return json_encode([$ex]);
        }
    }

    public function show(Request $request) {
        $id = $request->id;
        try {
            $query = DB::table('ms_promo')
                    ->where('code_promo','=',$id)->first();
            if($query->is_del == '0'){$st = '1';}
            if($query->is_del == '1'){$st = '0';}
            DB::beginTransaction();
            DB::table('ms_promo')->where('code_promo', '=', $id)
                        ->update(
                            ['is_del' => $st]
                        );
            DB::commit();
            return 'success';
        } catch (\Exception $ex) {
            DB::rollBack();
            return json_encode([$ex]);
        }
    }
}


