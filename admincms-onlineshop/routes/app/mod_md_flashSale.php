<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mod_md_flashSale extends Model
{
    protected $table = 'ms_flashsale';
    protected $fillable = ['id_buku', 'juduL_buku','harga_buku','gambar_buku','file_name','stock','terjual','harga_jadi'];
}
