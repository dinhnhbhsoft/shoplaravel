<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\Api\CourseServices;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CourseController extends Controller
{
    protected $courseServices;

    public function __construct(CourseServices $courseServices)
    {
        $this->courseServices = $courseServices;
    }

    public function index(Request $request)
    {
        try {
            $limit = $request->get('limit') ?? config('app.paginate.per_page');
            $coursePaginate = $this->courseServices->getAll($limit);

            return response()->json([
                'status' => true,
                'code' => Response::HTTP_OK,
                'courses' => $coursePaginate->items(),
                'meta' => [
                    'total' => $coursePaginate->total(),
                    'perPage' => $coursePaginate->perPage(),
                    'currentPage' => $coursePaginate->currentPage(),
                ],
            ]);

        } catch (\Exception $err) {
            return response()->json([
                'status' => false,
                'code' =>Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $err->getMessage(),
            ]);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $course = $this->courseServices->create($data);
            return response()->json([
                'status' => true,
                'code' => Response::HTTP_CREATED,
                'course' => $course,
            ]);
        } catch (\Exception $err) {
            return response()->json([
                'status' => false,
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $err->getMessage(),
            ]);
        }
    }

    public function show($id)
    {
        try {
            $course = $this->courseServices->getCourse($id);
            return response()->json([
                'status' => true,
                'code' => Response::HTTP_OK,
                'course' => $course,
            ]);
        } catch (\Exception $err) {
            return response()->json([
                'status' => false,
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $err->getMessage(),
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $data = $request->all();
            $course = $this->courseServices->update($data, $id);
            return response()->json([
                'status' => true,
                'code' => Response::HTTP_OK,
                'course' => $course,
            ]);
        } catch (\Exception $err) {
            return response()->json([
                'status' => false,
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $err->getMessage(),
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $this->courseServices->delete($id);
            return response()->json([
                'status' => true,
                'code' => Response::HTTP_OK,
            ]);
        } catch (\Exception $err) {
            return response()->json([
                'status' => false,
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $err->getMessage(),
            ]);
        }
    }
}
