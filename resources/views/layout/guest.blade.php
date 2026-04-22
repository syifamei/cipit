<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pusat Bantuan BAPPERIDA - Pengaduan & Konsultasi</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .hero-overlay {
            background: linear-gradient(135deg, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.4) 100%);
        }
    </style>
</head>
<body class="bg-gray-50">

    <!-- =========================
         NAVBAR
    ========================== -->
    <nav class="bg-white shadow-lg fixed w-full z-50">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <!-- Logo / Judul -->
                <div class="flex items-center space-x-3">
                    <div class="bg-transparent p-2 rounded-lg flex items-center">
                        <img src="{{ asset('bapperida.png') }}" alt="BAPPERIDA Logo" class="w-12 h-12 object-contain">
                        <img src="{{ asset('logo-kanan.jpg') }}" alt="BAPPERIDA Logo" class="w-12 h-12 object-contain ml-3">
                    </div>
                    <div>
                        <h1 class="font-bold text-xl text-gray-800">BAPPERIDA</h1>
                        <p class="text-xs text-gray-600">Layanan Bantuan</p>
                    </div>
                </div>

                <!-- Menu -->
                <div class="hidden md:flex items-center space-x-6">

                    <a href="{{ route('user.login') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition shadow-md">
                        <i class="fas fa-sign-in-alt mr-2"></i> Login
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <button class="md:hidden text-gray-700" onclick="toggleMobileMenu()">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div id="mobileMenu" class="hidden md:hidden mt-4 pb-4">
                <a href="{{ route('user.login') }}" class="block py-2 bg-blue-600 text-white px-4 rounded-lg hover:bg-blue-700 transition">
                    <i class="fas fa-sign-in-alt mr-2"></i> Login
                </a>
            </div>
        </div>
    </nav>

    <!-- =========================
         CONTENT
    ========================== -->
    <main class="pt-20">
        {{-- ALERT SUCCESS --}}
        @if(session('success'))
            <div class="max-w-4xl mx-auto mt-6 px-6">
                <div class="bg-green-500 text-white p-4 rounded-lg shadow-lg flex items-center">
                    <i class="fas fa-check-circle mr-3"></i>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- =========================
         FOOTER
    ========================== -->
    <footer class="bg-gray-900 text-white">
        <div class="container mx-auto px-6 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- About Section -->
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="bg-transparent p-2 rounded-lg flex items-center">
                            <img src="{{ asset('bapperida.png') }}" alt="BAPPERIDA Logo" class="w-10 h-10 object-contain">
                            <img src="{{ asset('logo-kanan.jpg') }}" alt="BAPPERIDA Logo" class="w-9 h-9 object-contain ml-3">
                        </div>
                        <h3 class="font-bold text-xl">BAPPERIDA</h3>
                    </div>
                    <p class="text-gray-400">
                        Badan Perencanaan Pembangunan Riset dan Inovasi Daerah - Layanan Bantuan
Melayani dengan hati, membangun untuk masa depan
                    </p>
                </div>

                <!-- Contact Section -->
                <div>
                    <h4 class="font-semibold text-lg mb-4">Hubungi Kami</h4>
                    <div class="space-y-2 text-gray-400">
                        <p><i class="fas fa-phone mr-2"></i> 0251-8338052</p>
                        <p><i class="fas fa-envelope mr-2"></i> bapperida@kotabogor.go.id</p>
                        <p><i class="fas fa-clock mr-2"></i> 
                            Senin - Kamis	:	07.30 - 16.00
                            Jam Istirahat	:	12.00 - 13.00
                            Jum'at	:	07.30 - 16.30
                            Jam Istirahat	:	11.30 - 13.00
                        </p>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="font-semibold text-lg mb-4">Layanan Cepat</h4>
                    <div class="space-y-2">
                        <a href="{{ route('user.register') }}" class="block text-gray-400 hover:text-white transition">
                            <i class="fas fa-plus-circle mr-2"></i> Buat Pengaduan
                        </a>
                        <a href="{{ route('user.login') }}" class="block text-gray-400 hover:text-white transition">
                            <i class="fas fa-sign-in-alt mr-2"></i> Login
                        </a>
                        <a href="#" class="block text-gray-400 hover:text-white transition">
                            <i class="fas fa-question-circle mr-2"></i> Panduan Layanan
                        </a>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} Helpdesk Pengaduan BAPPERIDA. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        }

        // Add fade-in animation
        document.addEventListener('DOMContentLoaded', function() {
            const heroContent = document.querySelector('.animate-fade-in');
            if (heroContent) {
                heroContent.style.opacity = '0';
                heroContent.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    heroContent.style.transition = 'all 1s ease-out';
                    heroContent.style.opacity = '1';
                    heroContent.style.transform = 'translateY(0)';
                }, 100);
            }
        });
    </script>

</body>
</html>
