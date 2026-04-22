@extends('layout.register')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100">
    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md border border-gray-100">
        <!-- Logo/Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center space-x-3 mb-4">
                <div class="bg-transparent p-2 rounded-lg flex items-center">
                    <img src="{{ asset('bapperida.png') }}" alt="BAPPERIDA Logo" class="w-12 h-12 object-contain">
                    <img src="{{ asset('logo-kanan.jpg') }}" alt="BAPPERIDA Logo" class="w-12 h-12 object-contain ml-3">
                </div>
            </div>
            <h2 class="text-3xl font-bold text-gray-800 mb-2">Buat Akun Baru</h2>
            <p class="text-gray-600">Daftar untuk mengakses Pusat Bantuan BAPPERIDA</p>
        </div>

        @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-600 p-3 mb-4 rounded-lg">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    {{ $errors->first() }}
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-600 p-3 mb-4 rounded-lg">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    {{ session('error') }}
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('user.register.submit') }}" class="space-y-4">
            @csrf
            
            <!-- Name Input -->
            <div class="relative">
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                <div class="relative">
                    <i class="fas fa-user absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="text" name="name" placeholder="Masukkan nama lengkap Anda" required
                        class="w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" autocomplete="off">
                </div>
            </div>

            <!-- Email Input -->
            <div class="relative">
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <div class="relative">
                    <i class="fas fa-envelope absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="email" name="email" placeholder="Masukkan email Anda" required
                        class="w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" autocomplete="off">
                </div>
            </div>

            <!-- Password Input -->
            <div class="relative">
                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <div class="relative">
                    <i class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="password" name="password" id="password" placeholder="Masukkan password Anda" required
                        class="w-full pl-10 pr-12 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" autocomplete="new-password">
                    <button type="button" onclick="togglePassword()" 
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                        <i id="passwordToggle" class="fas fa-eye-slash"></i>
                    </button>
                </div>
            </div>

            <!-- Password Confirmation -->
            <div class="relative">
                <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                <div class="relative">
                    <i class="fas fa-lock absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Masukkan kembali password Anda" required
                        class="w-full pl-10 pr-12 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" autocomplete="new-password">
                    <button type="button" onclick="togglePasswordConfirm()" 
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                        <i id="passwordConfirmToggle" class="fas fa-eye-slash"></i>
                    </button>
                </div>
            </div>

            <!-- reCAPTCHA -->
            <div class="relative">
                <label class="block text-sm font-medium text-gray-700 mb-1">Verifikasi Keamanan</label>
                <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                @error('g-recaptcha-response')
                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" 
                    class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-semibold transition transform hover:scale-[1.02] shadow-lg">
                <i class="fas fa-user-plus mr-2"></i>
                Daftar Sekarang
            </button>
        </form>

        <!-- Login Link -->
        <div class="mt-6 text-center">
            <p class="text-gray-600">
                Sudah punya akun? 
                <a href="{{ route('user.login') }}" class="font-medium text-blue-600 hover:text-blue-700">Masuk di sini</a>
            </p>
        </div>
    </div>
</div>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const passwordToggle = document.getElementById('passwordToggle');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        passwordToggle.classList.remove('fa-eye-slash');
        passwordToggle.classList.add('fa-eye');
    } else {
        passwordInput.type = 'password';
        passwordToggle.classList.remove('fa-eye');
        passwordToggle.classList.add('fa-eye-slash');
    }
}

function togglePasswordConfirm() {
    const passwordConfirmInput = document.getElementById('password_confirmation');
    const passwordConfirmToggle = document.getElementById('passwordConfirmToggle');
    
    if (passwordConfirmInput.type === 'password') {
        passwordConfirmInput.type = 'text';
        passwordConfirmToggle.classList.remove('fa-eye-slash');
        passwordConfirmToggle.classList.add('fa-eye');
    } else {
        passwordConfirmInput.type = 'password';
        passwordConfirmToggle.classList.remove('fa-eye');
        passwordConfirmToggle.classList.add('fa-eye-slash');
    }
}
</script>
@endsection
