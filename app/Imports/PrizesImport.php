<?php

namespace App\Imports;

use App\Prizes;
use Maatwebsite\Excel\Concerns\ToModel;

class PrizesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Prizes([
            'name' => $row[0],
            'type' => $row[1],
            'size' => $row[2]
        ]);
    }
}
