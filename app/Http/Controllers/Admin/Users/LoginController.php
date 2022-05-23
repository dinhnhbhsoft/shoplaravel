<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\StorePostRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index() {
        return view('admin.users.login', [
            'title' => "Login"
        ]);
    }

    public function store(StorePostRequest $request) {
        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];
        if(Auth::attempt($data)){
            return redirect()->route('admin');
        }

        session()->flash('error', 'email or password is incorrect');
        return redirect()->back();
    }
}
