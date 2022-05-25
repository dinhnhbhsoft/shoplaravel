<?php

namespace App\Http\Controllers;

use App\Exports\CoursesExport;
use App\Imports\CoursesImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class MainController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function import(Request $request)
    {
        try {
            if($request->hasFile('file')) {
                Excel::import(new CoursesImport(), $request->file('file')->store('files'));
                Session::flash('success', 'You imported Course');
            } else {
                Session::flash('error', 'You need to import file');
            }
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
        }
        return redirect()->back();
    }

    public function export()
    {
        return Excel::download(new CoursesExport(), 'courses.xlsx');
    }
}
