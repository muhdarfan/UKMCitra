<?php

namespace App\Exports;

use App\Models\Citra;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CitrasExport implements FromCollection, WithHeadings
{
    public function headings(): array
    {
        return [
            "courseCode",
            "courseName",
            "courseCredit",
            "courseCategory",
            "courseAvailability",
            "descriptions",
            "created_at",
            "updated_at"
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Citra::all();
    }
}
