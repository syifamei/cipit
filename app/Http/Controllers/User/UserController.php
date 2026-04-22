<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function dashboard()
    {
        return view('user.dashboard');
    }

    public function register()
    {
        return view('user.auth.register');
    }

    public function store(Request $request)
    {

        User::create([

            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)

        ]);

        return redirect()->route('login');
    }

}
