<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Course\FormPostRequests;
use App\Http\Services\Course\CourseAdminServices;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseAdminController extends Controller
{
    protected $courseAdminServices;

    public function __construct(CourseAdminServices $courseAdminServices) {
        $this->courseAdminServices = $courseAdminServices;
    }

    public function create() {
        return view('admin/course/add', [
            'title' => 'Add course',
        ]);
    }

    public function store(FormPostRequests $request, Course $course) {
        $this->courseAdminServices->store($request, $course);
        return redirect()->back();
    }

    public function index() {
        return view('admin/course/list', [
            'title' => 'List course',
            'courses' => $this->courseAdminServices->getCourse(),
        ]);
    }

    public function show(Course $course) {
        return view('admin/course/add', [
            'title' => 'Edit course',
            'course' => $course,
        ]);
    }

    public function delete(Request $request)
    {
        $this->courseAdminServices->delete($request);
        return response()->json([
            'ok' => 'ok',
        ]);
    }

}
