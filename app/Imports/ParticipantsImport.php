<?php

namespace App\Imports;

use App\Participants;
use Maatwebsite\Excel\Concerns\ToModel;

class ParticipantsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Participants([
            'name' => $row[0],
            'type' => $row[1]
        ]);
    }
}
