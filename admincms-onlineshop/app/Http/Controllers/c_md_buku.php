<?php

namespace App\Http\Controllers;

use App\mod_md_flashSale;
use App\mod__ms_barang_promo;
use App\mod_md_ms_gambar_buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class c_md_buku extends Controller
{
    public function index() {
        return view('dashboard.master-data.buku.list');
    }

    public function list() {
        return view('dashboard.master-data.buku.list');
    }

    public function edit($id) {
        $data = DB::table('ms_barang')
        ->where('ms_barang.id',$id)
        ->first();      
        return view('dashboard.master-data.buku.edit')->with('data',$data);
    }

    public function collectionGambar($id) {
        $dataMst = DB::table('ms_barang')
        ->where('ms_barang.id',$id)
        ->first();      
        $dataTrn = DB::table('ms_gambar_buku')
        ->where('ms_gambar_buku.id_buku',$id)->get()->toArray();     
        return view('dashboard.master-data.buku.collection')->with('dataMst',$dataMst)->with('dataTrn',$dataTrn);
    }

    public function data(Request $request) {
    

        $data['data'] = DB::table('ms_barang')
        ->orderBy('ms_barang.judul_buku','ASC')
        ->get();
    return json_encode($data);
    }

    public function submit(Request $request) {
        $type = $request->type;
        $kodeBuku = $request->id;
        $fileLocation = $request->fileLocation;
        $barcode = $request->barcode;
        $berat = $request->berat;
        $status = $request->status;
        $judul = $request->judul;
        $penerbit = $request->penerbit;
        $harga = $request->harga;
        $halaman = $request->halaman;
        $ukuran = $request->ukuran;
        $cover = $request->cover;
        $penulis = $request->penulis;
        $isbn = $request->isbn;
        $tahun = $request->tahun;
        $deskripsi = $request->deskripsi;
     
        $gambar = $request->foto;
        $foto = ($request->foto !== '') ? $request->file('foto') : '';
        try {
            DB::beginTransaction();

            $filename = null;

            if ($type == 'baru') {    
             
                        
                    $result = 'success';

            } elseif ($type == 'edit') {
                if($request->file('foto') !==null){
                    $fileFoto=$request->file('foto');              
                    $filename = $kodeBuku.'.'.$fileFoto->getClientOriginalExtension(); 

                    Storage::putFileAs('public',$fileFoto,$filename);
                    DB::table('ms_barang')->where('id', '=', $kodeBuku)
                    ->update(
                            ['barcode' => $barcode, 'berat'=>$berat, 
                            'status' => $status, 'judul_buku'=>$judul, 
                            'penerbit' => $penerbit, 'harga'=>$harga, 
                            'halaman' => $halaman, 'ukuran'=>$ukuran, 
                            'cover' => $cover, 'penulis'=>$penulis, 
                            'isbn' => $isbn, 'tahun'=>$tahun, 
                            'diskripsi' => $deskripsi, 'penulis'=>$penulis, 
                            'gambar_buku'=>'storage/'.$filename]
                    );      
                }
                else{
                    DB::table('ms_barang')->where('id', '=', $kodeBuku)
                    ->update(
                            ['barcode' => $barcode, 'berat'=>$berat, 
                            'status' => $status, 'judul_buku'=>$judul, 
                            'penerbit' => $penerbit, 'harga'=>$harga, 
                            'halaman' => $halaman, 'ukuran'=>$ukuran, 
                            'cover' => $cover, 'penulis'=>$penulis, 
                            'isbn' => $isbn, 'tahun'=>$tahun, 
                            'diskripsi' => $deskripsi, 'penulis'=>$penulis]
                    );      
                }
                        $result = 'success';
            }
            DB::commit();
            return     $result;
        } catch (\Exception $ex) {
            DB::rollBack();
            $err = [$ex];
            return response()->json($ex);
        }
    }

    public function submitCollection(Request $request) {
        $id = $request->id;
        $file = $request->file('filepond');
        $extension = $request->file('filepond')->getClientOriginalExtension();

        try {
            DB::beginTransaction();
            $filename = Uuid::uuid1()->toString().'.'.$extension;

            Storage::putFileAs('public',$file,$filename);

            $gambar = new mod_md_ms_gambar_buku();
            $gambar->id_buku = $id;
            $gambar->gambar = 'storage/'.$filename;
            $gambar->save();

            DB::commit();
            return 'success';
        } catch (\Exception $ex) {
            DB::rollBack();
            dd('Exception Block',$ex);
        }
    }

    public function show(Request $request) {
        $id = $request->id;
        try {
            $query = DB::table('ms_barang')
                    ->where('id','=',$id)->first();
            if($query->store == 'N'){$st = 'Y';}
            if($query->store == 'Y'){$st = 'N';}
            DB::beginTransaction();
            DB::table('ms_barang')->where('id', '=', $id)
                        ->update(
                            ['store' => $st]
                        );
            DB::commit();
            return 'success';
        } catch (\Exception $ex) {
            DB::rollBack();
            return json_encode([$ex]);
        }
    }

    public function delete(Request $request) {
        $id = $request->id;
        try {
            DB::beginTransaction();
            DB::table('ms_gambar_buku')->where('id','=',$id)->delete();
            DB::commit();
            return 'success';
        } catch (\Exception $ex) {
            DB::rollBack();
            return json_encode([$ex]);
        }
    }
}


