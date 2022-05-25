<?php

namespace App\Exports;

use App\Models\Course;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CoursesExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Course::select('name', 'description', 'time_start', 'time_end')->get();
    }

    public function headings(): array
    {
        return [
            'Tên môn học',
            'Miêu tả',
            'Thời gian bắt đầu',
            'Thời gian kết thúc'
        ];
    }
}
