@extends('layout.guest')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100">
    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md border border-gray-100">
        <!-- Logo/Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center space-x-3 mb-4">
                <div class="bg-transparent p-2 rounded-lg flex items-center">
                    <img src="{{ asset('bapperida.png') }}" alt="BAPPERIDA Logo" class="w-8 h-8 object-contain">
                    <img src="{{ asset('logo-kanan.jpg') }}" alt="BAPPERIDA Logo" class="w-8 h-8 object-contain ml-3">
                </div>
            </div>
            <h2 class="text-3xl font-bold text-gray-800 mb-2">Verifikasi Email</h2>
            <p class="text-gray-600">Masukkan kode OTP yang dikirim ke {{ $email }}</p>
        </div>

        @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-600 p-3 mb-4 rounded-lg">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    {{ session('error') }}
                </div>
            </div>
        @endif

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-600 p-3 mb-4 rounded-lg">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if(session('info'))
            <div class="bg-blue-50 border border-blue-200 text-blue-600 p-3 mb-4 rounded-lg">
                <div class="flex items-center">
                    <i class="fas fa-info-circle mr-2"></i>
                    {{ session('info') }}
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('user.otp.verify.submit') }}" class="space-y-4">
            @csrf
            <input type="hidden" name="email" value="{{ $email }}">
            
            <!-- OTP Input -->
            <div class="relative">
                <label class="block text-sm font-medium text-gray-700 mb-1">Kode OTP</label>
                <div class="relative">
                    <i class="fas fa-shield-alt absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="text" name="otp" placeholder="Masukkan 6 digit kode OTP" maxlength="6" required
                        class="w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition text-center text-2xl font-bold tracking-widest">
                </div>
                <p class="text-xs text-gray-500 mt-1">Kode OTP berlaku selama 15 menit</p>
            </div>

            <!-- Submit Button -->
            <button type="submit" 
                    class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-3 rounded-lg font-semibold hover:from-blue-700 hover:to-indigo-700 transition transform hover:scale-[1.02] shadow-lg">
                <i class="fas fa-check mr-2"></i>
                Verifikasi Email
            </button>
        </form>

        <!-- Resend OTP Link -->
        <div class="mt-6 text-center">
            <p class="text-gray-600 mb-2">
                Tidak menerima kode OTP?
            </p>
            <form method="POST" action="{{ route('user.otp.resend') }}" class="inline">
                @csrf
                <input type="hidden" name="email" value="{{ $email }}">
                <button type="submit" class="text-blue-600 hover:text-blue-700 font-medium">
                    <i class="fas fa-redo mr-1"></i>
                    Kirim Ulang OTP
                </button>
            </form>
        </div>

        <!-- Back to Login -->
        <div class="mt-4 text-center">
            <a href="{{ route('user.login') }}" class="text-sm text-gray-500 hover:text-gray-700">
                <i class="fas fa-arrow-left mr-1"></i>
                Kembali ke Login
            </a>
        </div>
    </div>
</div>

<script>
// Auto-focus on OTP input
document.addEventListener('DOMContentLoaded', function() {
    const otpInput = document.querySelector('input[name="otp"]');
    if (otpInput) {
        otpInput.focus();
        
        // Only allow numbers
        otpInput.addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    }
});
</script>
@endsection
