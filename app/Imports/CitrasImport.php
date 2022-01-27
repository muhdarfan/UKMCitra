<?php

namespace App\Imports;

use App\Models\Citra;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Validators\Failure;
use Throwable;

class CitrasImport implements ToModel, WithUpserts, WithHeadingRow, SkipsEmptyRows
{

    public function __construct($courseCode, $courseName, $courseCredit, $courseCategory, $courseAvailability, $courseDescriptions, $created_at = 'created_at', $updated_at = 'updated_at')
    {
        $this->courseCode = $courseCode;
        $this->courseName = $courseName;
        $this->courseCredit = $courseCredit;
        $this->courseCategory = $courseCategory;
        $this->courseAvailability = $courseAvailability;
        $this->courseDescriptions = $courseDescriptions;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Citra([
            "courseCode" => $row[$this->courseCode] ?? null,
            "courseName" => $row[$this->courseName] ?? null,
            "courseCredit" => $row[$this->courseCredit] ?? null,
            "courseCategory" => $row[$this->courseCategory] ?? 'C1',
            "courseAvailability" => $row[$this->courseAvailability] ?? 0,
            "descriptions" => $row[$this->courseDescriptions] ?? '',
            "created_at" => $row[$this->created_at] ?? Carbon::now(),
            "updated_at" => $row[$this->updated_at] ?? Carbon::now()
        ]);
    }

    public function uniqueBy()
    {
        return 'courseCode';
    }

    public function headingRow(): int
    {
        return 1;
    }

    public function onFailure(Failure ...$failures)
    {
        // TODO: Implement onFailure() method.
    }

    public function onError(Throwable $e)
    {
        // TODO: Implement onError() method.
    }
}
