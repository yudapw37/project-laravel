<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mod_transaksi extends Model
{
    protected $table = 'transaksi';
    protected $fillable = ['code_order', 'code_perusahaan', 'kodeAdminTrx', 'kode_AWO', 'approve_sales', 'approve_keuangan', 'approve_sales2', 'approve_gudang', 'no_resi', 
    'hold','code_status', 'typeTransaksi', 'keterangan', 'cetak'];
}
