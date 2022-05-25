<?php

namespace App\Http\Services\Course;

use App\Models\Course;
use Illuminate\Support\Facades\Session;

class CourseAdminServices {
    public function store($request, $course)
    {
        $data = [
            'name' => $request->input('name'),
            'description' => $request->input('description') ? $request->input('description') : "",
            'time_start' => $request->input('time_start'),
            'time_end' => $request->input('time_end'),
        ];

        try {
            if ($course->getAttribute('id') !== null) {
                $course->fill($data);
                $course->save();
                Session::flash('success', 'You updated Course');
            } else {
                Course::create($data);
                Session::flash('success', 'You created Course');
            }

        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
        return true;
    }

    public function getCourse()
    {
        return Course::orderbyDesc('id')->paginate(20);
    }

    public function delete($request)
    {
        try {
            $id = $request->get('id');
            $course = Course::where('id', $id)->first();
            if ($course) {
                $course->delete();
                Session::flash('success', 'You deleted');
            }
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
        return true;
    }

}
