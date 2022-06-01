<?php

namespace App\Http\Services\Api;

use App\Models\Course;

class CourseServices
{
    public function getAll($limit)
    {
        return Course::paginate($limit);
    }

    public function create($data)
    {
        return Course::create($data);
    }

    public function getCourse($id)
    {
        return Course::find($id);
    }

    public function update($data, $id)
    {
        Course::find($id)->fill($data)->save();
        return Course::find($id);
    }

    public function delete($id)
    {
        $course = Course::find($id);
        $course->delete();
    }
}
