<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mod_order extends Model
{
    protected $table = 'order';
    protected $fillable = ['id', 'code_customer', 'expedisi', 'biayaExpedisi', 'totalDiskon', 'total_barang', 'total_harga', 'nama_pengirim', 'telephone_pengirim', 
    'status_alamat','nama_penerima', 'telephone_penerima', 'alamat', 'kecamatan', 'kab_kota', 'propinsi', 'pre_order', 'image','lunas', 'codeGudang', 'bank','diskonKodeUnik'];
}
