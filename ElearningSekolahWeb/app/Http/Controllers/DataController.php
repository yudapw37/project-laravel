<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
// use App\Http\Controllers\Controller;
use App\User;

class DataController extends BaseController
{
    public function getDataSiswa(){
        return view ('index');
    }

    public function kegiatanSiswa(){
        $varKeg = 'Kegiatan Sekolah';
        return view('kegiatan', ['varKeg' => $varKeg]);
    }
}
