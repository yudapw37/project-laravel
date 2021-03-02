<?php

namespace App\Imports;

use App\mod_polreg;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class polregImport implements ToModel,  WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new mod_polreg([
            'area' => $row['area'],
            'kecamatan' => $row['kecamatan'],
            'no_rangka' => $row['no_rangka'], 
            'keterangan' => $row['keterangan'], 
        ]);
    }
}
