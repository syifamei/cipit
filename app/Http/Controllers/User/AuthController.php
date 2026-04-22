<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Services\OTPService;

class AuthController extends Controller
{
    protected $otpService;

    public function __construct(OTPService $otpService)
    {
        $this->otpService = $otpService;
    }
    /*
    |--------------------------------------------------------------------------
    | USER DASHBOARD
    |--------------------------------------------------------------------------
    */
    public function dashboard()
    {
        return view('user.dashboard');
    }

    /*
    |--------------------------------------------------------------------------
    | TAMPILKAN FORM LOGIN
    |--------------------------------------------------------------------------
    */
    public function showLogin()
    {
        return view('user.auth.login');
    }

    /*
    |--------------------------------------------------------------------------
    | PROSES LOGIN
    |--------------------------------------------------------------------------
    */
    public function login(Request $request)
    {
        // Validate all input including reCAPTCHA
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'g-recaptcha-response' => 'required|recaptcha'
        ]);

        // Prepare credentials for authentication (only email and password)
        $credentials = $request->only('email', 'password');

        // Debug: Cek user exists
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->with('error', 'Email tidak ditemukan!')->withInput();
        }

        // Debug: Cek password
        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Password salah!')->withInput();
        }

        // Cek if email is verified
        if (!$user->email_verified_at) {
            // Generate and send OTP
            if ($this->otpService->generateAndSendOTP($user)) {
                return redirect()->route('user.otp.verify', ['email' => $user->email])
                    ->with('info', 'Silakan verifikasi email Anda dengan kode OTP yang telah dikirim.');
            } else {
                return back()->with('error', 'Gagal mengirim OTP. Silakan coba lagi.')->withInput();
            }
        }

        // Attempt login with clean credentials (only email and password)
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('user.dashboard')->with('success', 'Login berhasil!');
        }

        // Fallback: Manual login
        Auth::login($user);
        $request->session()->regenerate();
        return redirect()->route('user.dashboard')->with('success', 'Login berhasil!');
    }

    /*
    |--------------------------------------------------------------------------
    | TAMPILKAN FORM REGISTER
    |--------------------------------------------------------------------------
    */
    public function showRegister()
    {
        return view('user.auth.register');
    }

    /*
    |--------------------------------------------------------------------------
    | PROSES REGISTER
    |--------------------------------------------------------------------------
    */
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'g-recaptcha-response' => 'required|recaptcha'
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password)
        ]);

        // Generate and send OTP for email verification
        if ($this->otpService->generateAndSendOTP($user)) {
            return redirect()->route('user.otp.verify', ['email' => $user->email])
                ->with('success', 'Registrasi berhasil! Silakan verifikasi email Anda dengan kode OTP yang telah dikirim.');
        } else {
            return back()->with('error', 'Registrasi berhasil tetapi gagal mengirim OTP. Silakan hubungi admin.')->withInput();
        }
    }

    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */
    public function logout(Request $request)
    {
        Auth::logout();

        // 🔥 biar session bersih total
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    /*
    |--------------------------------------------------------------------------
    | TAMPILKAN FORM VERIFIKASI OTP
    |--------------------------------------------------------------------------
    */
    public function showOTPVerification(Request $request)
    {
        $email = $request->email;
        if (!$email) {
            return redirect()->route('user.login')->with('error', 'Email tidak valid.');
        }

        return view('user.auth.otp-verify', compact('email'));
    }

    /*
    |--------------------------------------------------------------------------
    | PROSES VERIFIKASI OTP
    |--------------------------------------------------------------------------
    */
    public function verifyOTP(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:6'
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->with('error', 'Email tidak ditemukan!')->withInput();
        }

        // Verify OTP
        if ($this->otpService->verifyOTP($user, $request->otp)) {
            // Mark email as verified
            if ($this->otpService->verifyEmail($user)) {
                // Auto login after verification
                Auth::login($user);
                $request->session()->regenerate();
                
                return redirect()->route('user.dashboard')
                    ->with('success', 'Email berhasil diverifikasi! Selamat datang di BAPPERIDA.');
            } else {
                return back()->with('error', 'Gagal verifikasi email. Silakan coba lagi.')->withInput();
            }
        }

        // Check if OTP is expired
        if ($this->otpService->isOTPExpired($user)) {
            return back()->with('error', 'Kode OTP telah kadaluarsa. Silakan kirim ulang OTP.')->withInput();
        }

        return back()->with('error', 'Kode OTP tidak valid.')->withInput();
    }

    /*
    |--------------------------------------------------------------------------
    | KIRIM ULANG OTP
    |--------------------------------------------------------------------------
    */
    public function resendOTP(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->with('error', 'Email tidak ditemukan!')->withInput();
        }

        // Check if already verified
        if ($user->email_verified_at) {
            return redirect()->route('user.login')->with('info', 'Email Anda sudah diverifikasi. Silakan login.');
        }

        // Resend OTP
        if ($this->otpService->generateAndSendOTP($user)) {
            return back()->with('success', 'OTP baru telah dikirim ke email Anda.');
        } else {
            return back()->with('error', 'Gagal mengirim OTP. Silakan coba lagi.')->withInput();
        }
    }
}
