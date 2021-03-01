<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mod_outstandingorder extends Model
{
    protected $table = 'outstanding_order';
    protected $fillable = ['idOrder', 'kodeAdminTrx', 'totalDiskon', 'typeTransaksi', 'code_customer', 'expedisi', 'biaya_expedisi', 'total_barang', 'total_harga', 'nama_pengirim','telephone_pengirim', 'nama_penerima', 'telephone_penerima', 'alamat', 'kecamatan', 'kab_kota', 'propinsi', 'diskonKodeUnik','invStore','codeGudang'];
}
