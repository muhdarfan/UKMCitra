<?php

namespace App\Imports;

use App\Models\Citra;
use Maatwebsite\Excel\Concerns\ToModel;

class CitrasImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Citra([
            "courseCode" => $row[0],
            "courseName" => $row[1],
            "courseCredit" => $row[2],
            "courseCategory" => $row[3],
            "courseAvailability" => $row[4],
            "descriptions" => $row[5],
            "created_at" => $row[6],
            "updated_at" => $row[7]
        ]);
    }
}
