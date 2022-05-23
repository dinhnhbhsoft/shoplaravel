<?php

namespace App\Imports;

use App\Models\Course;
use Maatwebsite\Excel\Concerns\ToModel;

class CoursesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Course([
            'name' => $row[0],
            'description' => $row[1],
            'time_start' => $row[2],
            'time_end' => $row[3],
        ]);
    }
}
