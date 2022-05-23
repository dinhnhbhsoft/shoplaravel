<?php

namespace App\Http\Controllers;

use App\Exports\CoursesExport;
use App\Imports\CoursesImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MainController extends Controller
{
    public function index(Request $request){
        return view('index');
    }

    public function import(Request $request){
        Excel::import(new CoursesImport(), $request->file('file')->store('files'));
        return redirect()->back();
    }

    public function export(Request $request){
        return Excel::download(new CoursesExport(), 'courses.xlsx');
    }
}
