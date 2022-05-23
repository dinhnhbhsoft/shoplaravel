<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\StorePostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainAdminController extends Controller
{
    public function index()
    {
        return view('admin.home', [
            'title' => 'Admin page',
        ]);
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login');
    }
}
