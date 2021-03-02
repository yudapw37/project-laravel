<?php

namespace App\Imports;

use App\mod_upload_customer;
use Maatwebsite\Excel\Concerns\ToModel;

class customerImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new mod_upload_customer([
            'nama_cust' => $row[1],
            'alamat' => $row[2], 
            'kota' => $row[3], 
            'telp' => $row[4], 
        ]);
    }
}
