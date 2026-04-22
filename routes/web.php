<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| IMPORT CONTROLLERS
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Guest\GuestController;

use App\Http\Controllers\User\PengaduanController as UserPengaduan;
use App\Http\Controllers\User\AuthController as UserAuth;

use App\Http\Controllers\Admin\PengaduanController as AdminPengaduan;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\PetugasController;

use App\Http\Controllers\Petugas\PengaduanController as PetugasPengaduan;


/*
|--------------------------------------------------------------------------
| HALAMAN UTAMA (GUEST)
|--------------------------------------------------------------------------
*/

Route::get('/debug-users', function() {
    $users = \App\Models\User::all();
    echo "<h3>Users in Database:</h3>";
    foreach ($users as $user) {
        echo "<p>ID: {$user->id}, Name: {$user->name}, Email: {$user->email}, Password Hash: {$user->password}</p>";
    }
});

Route::get('/debug-admin', function() {
    $admins = \App\Models\Petugas::all();
    echo "<h3>Admins/Petugas in Database:</h3>";
    foreach ($admins as $admin) {
        echo "<p>ID: {$admin->id}, Name: {$admin->name}, Email: {$admin->email}, Role: {$admin->role}, Password Hash: {$admin->password}</p>";
    }
});

Route::get('/', [GuestController::class, 'dashboard'])->name('home');

// Global login route for authentication middleware
Route::get('/login', [UserAuth::class, 'showLogin'])->name('login');

// Global admin login route for admin authentication middleware
Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login');


/*
|--------------------------------------------------------------------------
| GUEST
|--------------------------------------------------------------------------
*/

Route::prefix('guest')->name('guest.')->group(function () {

    Route::get('/dashboard', [GuestController::class, 'dashboard'])->name('dashboard');
    Route::get('/create', [GuestController::class, 'create'])->name('create');
    Route::post('/store', [GuestController::class, 'store'])->name('store');

});


/*
|--------------------------------------------------------------------------
| AUTH USER (LOGIN & REGISTER)
|--------------------------------------------------------------------------
*/

Route::prefix('user')->name('user.')->group(function () {

    // LOGIN
    Route::get('/login', [UserAuth::class, 'showLogin'])->name('login');
    Route::post('/login', [UserAuth::class, 'login'])->name('login.submit');

    // REGISTER
    Route::get('/register', [UserAuth::class, 'showRegister'])->name('register');
    Route::post('/register', [UserAuth::class, 'register'])->name('register.submit');

    // OTP VERIFICATION
    Route::get('/otp/verify', [UserAuth::class, 'showOTPVerification'])->name('otp.verify');
    Route::post('/otp/verify', [UserAuth::class, 'verifyOTP'])->name('otp.verify.submit');
    Route::post('/otp/resend', [UserAuth::class, 'resendOTP'])->name('otp.resend');

    // LOGOUT
    Route::post('/logout', [UserAuth::class, 'logout'])->name('logout');

});


/*
|--------------------------------------------------------------------------
| USER / MASYARAKAT (WAJIB LOGIN)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->prefix('pengaduan')->name('pengaduan.')->group(function () {

    Route::get('/', [UserPengaduan::class, 'index'])->name('index');
    Route::get('/create', [UserPengaduan::class, 'create'])->name('create');
    Route::post('/store', [UserPengaduan::class, 'store'])->name('store');
    Route::get('/{id}', [UserPengaduan::class, 'show'])->name('show');

});

Route::middleware('auth')->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserAuth::class, 'dashboard'])->name('dashboard');
});


/*
|--------------------------------------------------------------------------
| AUTH ADMIN
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function(){

    Route::get('/login', [LoginController::class,'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class,'login'])->name('login.submit');
    Route::post('/logout', [LoginController::class,'logout'])->name('logout');

});


/*
|--------------------------------------------------------------------------
| ADMIN PANEL (WAJIB LOGIN ADMIN)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // EXPORT
    Route::get('/pengaduan/export-excel', [AdminPengaduan::class,'exportExcel'])->name('pengaduan.exportExcel');
    Route::get('/pengaduan/export-pdf', [AdminPengaduan::class,'exportPDF'])->name('pengaduan.exportPDF');

    // CRUD
    Route::resource('pengaduan', AdminPengaduan::class);
    Route::resource('petugas', PetugasController::class);

});


/*
|--------------------------------------------------------------------------
| PETUGAS PANEL
|--------------------------------------------------------------------------
*/

Route::prefix('petugas')->name('petugas.')->group(function () {

    Route::get('/dashboard', [PetugasPengaduan::class, 'dashboard'])->name('dashboard');

    Route::get('/pengaduan', [PetugasPengaduan::class, 'index'])->name('pengaduan.index');
    Route::get('/pengaduan/{id}', [PetugasPengaduan::class, 'show'])->name('pengaduan.show');
    Route::get('/pengaduan/{id}/edit', [PetugasPengaduan::class, 'edit'])->name('pengaduan.edit');
    Route::put('/pengaduan/{id}', [PetugasPengaduan::class, 'update'])->name('pengaduan.update');
    
    // Export Routes
    Route::get('/pengaduan/export-excel', [PetugasPengaduan::class, 'exportExcel'])->name('pengaduan.exportExcel');
    Route::get('/pengaduan/export-pdf', [PetugasPengaduan::class, 'exportPDF'])->name('pengaduan.exportPDF');

});
