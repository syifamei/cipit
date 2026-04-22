@extends('layout.user')

@section('content')
<!-- Hero Section -->
<section class="relative h-[400px] md:h-[500px] lg:h-[600px] flex items-center justify-center overflow-hidden">
    <!-- Background Image -->
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('images/bapperida-kota-bogor-profil.jpeg') }}" alt="BAPPERIDA Kota Bogor" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/60 to-black/80"></div>
    </div>

    <!-- Hero Content -->
    <div class="relative z-10 text-center text-white px-4 sm:px-6 lg:px-8 max-w-4xl lg:max-w-5xl mx-auto">
        <div class="space-y-4 sm:space-y-6">
            <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold leading-tight">
                Pusat Pengaduan<br>
                <span class="text-blue-400">BAPPERIDA</span>
            </h1>
            <p class="text-sm sm:text-base md:text-lg lg:text-xl leading-relaxed text-gray-200 max-w-3xl mx-auto">
                Pusat layanan pengaduan dan konsultasi terpadu<br>
                untuk melayani masyarakat dengan lebih baik
            </p>
            
            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-3 justify-center items-center pt-4 sm:pt-6">
                <a href="{{ route('pengaduan.create') }}" 
                   class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white px-5 sm:px-6 py-2 sm:py-3 rounded-lg font-semibold transition transform hover:scale-105 shadow-xl text-sm sm:text-base">
                    <i class="fas fa-edit mr-2"></i>
                    Buat Pengaduan
                </a>
                <a href="#features" 
                   class="w-full sm:w-auto bg-transparent border-2 border-white text-white hover:bg-white hover:text-gray-900 px-5 sm:px-6 py-2 sm:py-3 rounded-lg font-semibold transition transform hover:scale-105 text-sm sm:text-base">
                    <i class="fas fa-info-circle mr-2"></i>
                    Informasi Layanan
                </a>
            </div>
        </div>
    </div>
</section>

<div class="min-h-screen bg-gray-50 py-20" id="features">
    <div class="container mx-auto px-6">
        <!-- Welcome Section -->
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Dashboard Pengaduan</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Kelola semua pengaduan dan konsultasi Anda dalam satu platform terpadu.
            </p>
        </div>

        <!-- Features Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
            <!-- Feature 1 -->
            <a href="{{ route('pengaduan.create') }}" class="block bg-white rounded-xl shadow-lg p-8 text-center hover:shadow-xl transition transform hover:scale-105 cursor-pointer">
                <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-plus-circle text-blue-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-3">Buat Pengaduan</h3>
                <p class="text-gray-600">Sampaikan keluhan atau konsultasi baru dengan formulir yang mudah digunakan.</p>
            </a>

            <!-- Feature 2 -->
            <a href="{{ route('pengaduan.index') }}" class="block bg-white rounded-xl shadow-lg p-8 text-center hover:shadow-xl transition transform hover:scale-105 cursor-pointer">
                <div class="bg-purple-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-history text-purple-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-3">Riwayat</h3>
                <p class="text-gray-600">Lihat semua pengaduan yang pernah Anda buat dan statusnya.</p>
            </a>

            <!-- Feature 3 -->
            <div class="bg-white rounded-xl shadow-lg p-8 text-center hover:shadow-xl transition">
                <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-eye text-green-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-3">Tracking Real-time</h3>
                <p class="text-gray-600">Monitor status pengaduan Anda secara real-time dan transparan.</p>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl p-12 text-center text-white">
            <h3 class="text-3xl font-bold mb-4">Butuh Bantuan?</h3>
            <p class="text-xl mb-8 opacity-90">
                Tim kami siap membantu menindaklanjuti setiap pengaduan dengan profesional.
            </p>
            <a href="{{ route('pengaduan.create') }}" 
               class="bg-white text-blue-600 hover:bg-gray-100 font-semibold px-8 py-4 rounded-lg shadow-lg transition transform hover:scale-105">
                <i class="fas fa-plus-circle mr-2"></i>
                Buat Pengaduan Baru
            </a>
        </div>
    </div>
</div>

    <!-- User Info Section -->
    <div class="relative z-10 bg-white rounded-t-3xl -mt-20 p-8 shadow-xl">
        <h2 class="text-2xl font-bold text-center mb-6">Informasi Akun</h2>
        <div class="grid md:grid-cols-3 gap-6 text-center">
            <div class="p-4 border rounded-lg hover:shadow-lg transition">
                <h3 class="font-semibold text-lg mb-2">Nama</h3>
                <p>{{ Auth::user()->name }}</p>
            </div>
            <div class="p-4 border rounded-lg hover:shadow-lg transition">
                <h3 class="font-semibold text-lg mb-2">Email</h3>
                <p>{{ Auth::user()->email }}</p>
            </div>
            <div class="p-4 border rounded-lg hover:shadow-lg transition">
                <h3 class="font-semibold text-lg mb-2">Status</h3>
                <p><span class="bg-green-100 text-green-700 px-3 py-1 rounded-xl text-xs font-semibold">Aktif</span></p>
            </div>
        </div>
    </div>
</div>
@endsection
