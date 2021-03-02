<?php

namespace App\Http\Controllers;
use App\mod_strukturOrganisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class c_strukturOrganisasi extends Controller
{

    public function index() {
        return view('dashboard.master-data.struktur-organisasi.baru');
    }

    public function list() {
        return view('dashboard.master-data.struktur-organisasi.list');
    }

    public function data(Request $request) {
        $filters = $request->filters;
        $data = [
            'where' => []
        ];
        if ($filters !== null) {
            foreach ($filters as $f) {
                $data['where'][] = [
                    $f['field'],$f['type'],'%'.$f['value'].'%'
                ];
            }
        }
        return DB::table('tbl_strukturorganisasi')
            ->select('id','nama','jabatan','keterangan','gambar')
            ->paginate(8);
    }


    

    public function submit(Request $request) {
    $nama = $request->nama;
    $jabatan = $request->jabatan;
    $keteragan = $request->keteragan;
    $gambar = $request->foto;
    $foto = ($request->foto !== '') ? $request->file('foto') : '';
    try {
        DB::beginTransaction();


        
        $filename = null;

        if ($foto !== '') {
            $year = date('y');
            $month = date('m');
            $day = date('d');
            $jam = date('h');
            $menit = date('i');
            $xx = 'SO'.$year.$month.$day.$jam.$menit;
            $filename = $xx.'-'.$jabatan.'.'.$foto->getClientOriginalExtension();
            Storage::putFileAs('public',$foto,$filename);
        }

                $transaksi = new mod_strukturOrganisasi();
                $transaksi->nama = $nama;
                $transaksi->jabatan = $jabatan;
                $transaksi->keterangan = $keteragan;
                $transaksi->gambar = $filename;
                $transaksi->save();
        DB::commit();
        return 'success';
    } catch (\Exception $ex) {
        DB::rollBack();
        return response()->json($request);
    }
    }
}