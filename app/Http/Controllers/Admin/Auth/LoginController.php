<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Debug: Cek admin exists
        $admin = \App\Models\Petugas::where('email', $request->email)->first();
        if (!$admin) {
            return back()->withErrors([
                'email' => 'Email tidak ditemukan di database admin!'
            ]);
        }

        // Debug: Cek password
        if (!\Illuminate\Support\Facades\Hash::check($request->password, $admin->password)) {
            return back()->withErrors([
                'email' => 'Password salah!'
            ]);
        }

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(Auth::guard('admin')->attempt($credentials)){

            $request->session()->regenerate();

            $user = Auth::guard('admin')->user();

            // Debug log
            \Log::info('Admin login success', [
                'user_id' => $user->id,
                'role' => $user->role,
                'redirect_to' => $user->role == 'admin' ? 'admin.dashboard' : 'petugas.dashboard'
            ]);

            if($user->role == 'admin'){
                return redirect()->route('admin.dashboard');
            }

            if($user->role == 'petugas'){
                return redirect()->route('petugas.dashboard');
            }

        }

        return back()->withErrors([
            'email' => 'Login gagal - Auth::guard gagal'
        ]);

    }


    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }

}
