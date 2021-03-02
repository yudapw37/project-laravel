<?php

namespace App\Imports;

use App\mod_rs;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class rsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new mod_rs([
            'no_rangka' =>  $row['no_rangka'], 
                'tgl_rs' =>  $row['tgl_rs'],         
                'keterangan' => $row['keterangan'],  
        ]);
    }
}
