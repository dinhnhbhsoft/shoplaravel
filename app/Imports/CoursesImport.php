<?php

namespace App\Imports;

use App\Models\Course;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CoursesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $course = Course::where('name', $row['name'])->first();
        $data = [
            'description' => $row['description'],
            'time_start' => $row['time_start'],
            'time_end' => $row['time_end'],
        ];

        if($course !== null) {
            $course->fill($data);
            $course->save();
        } else {
            $data = array_merge($data, ['name' => $row['name'] ]);
            Course::create($data);
        }
    }
}
