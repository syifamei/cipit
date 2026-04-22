<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pusat Bantuan BAPPERIDA</title>

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

                <!-- User Menu -->
                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{ route('user.dashboard') }}" class="{{ request()->routeIs('user.dashboard') ? 'text-blue-600' : 'text-gray-700' }} hover:text-blue-600 font-medium transition relative group">
                        <span class="relative z-10">Dashboard</span>
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-blue-600 transform {{ request()->routeIs('user.dashboard') ? 'scale-x-100' : 'scale-x-0' }} group-hover:scale-x-100 transition-transform"></span>
                    </a>
                    <a href="{{ route('pengaduan.index') }}" class="{{ request()->routeIs('pengaduan.index') ? 'text-blue-600' : 'text-gray-700' }} hover:text-blue-600 font-medium transition relative group">
                        <span class="relative z-10">Riwayat</span>
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-blue-600 transform {{ request()->routeIs('pengaduan.index') ? 'scale-x-100' : 'scale-x-0' }} group-hover:scale-x-100 transition-transform"></span>
                    </a>
                    
                    <!-- User Dropdown -->
                    <div class="relative group">
                        <button class="flex items-center space-x-2 text-gray-700 hover:text-blue-600 font-medium transition">
                            <i class="fas fa-user-circle text-xl"></i>
                            <span>{{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                            <div class="p-2">
                                <div class="px-4 py-2 border-b">
                                    <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-gray-600">{{ Auth::user()->email }}</p>
                                </div>
                                <form action="{{ route('user.logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 rounded transition">
                                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mobile Menu Button -->
                <button class="md:hidden text-gray-700" onclick="toggleMobileMenu()">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div id="mobileMenu" class="hidden md:hidden mt-4 pb-4">
                <a href="{{ route('user.dashboard') }}" class="block py-2 {{ request()->routeIs('user.dashboard') ? 'text-blue-600 font-medium border-l-4 border-blue-600 pl-4 bg-blue-50' : 'text-gray-700 hover:text-blue-600 font-medium pl-4 hover:bg-gray-50' }}">
                    <i class="fas fa-home mr-2"></i> Dashboard
                </a>
                <a href="{{ route('pengaduan.create') }}" class="block py-2 text-gray-700 hover:text-blue-600 font-medium pl-4 hover:bg-gray-50">
                    <i class="fas fa-plus-circle mr-2"></i> Buat Pengaduan
                </a>
                <a href="{{ route('pengaduan.index') }}" class="block py-2 {{ request()->routeIs('pengaduan.index') ? 'text-blue-600 font-medium border-l-4 border-blue-600 pl-4 bg-blue-50' : 'text-gray-700 hover:text-blue-600 font-medium pl-4 hover:bg-gray-50' }}">
                    <i class="fas fa-list mr-2"></i> Riwayat
                </a>
                <div class="border-t pt-2 mt-2">
                    <div class="px-4 py-2">
                        <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-600">{{ Auth::user()->email }}</p>
                    </div>
                    <form action="{{ route('user.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- =========================
         CONTENT
    ========================== -->
    <main class="pt-20">
        {{-- ALERT SUCCESS --}}
        @if(session('success'))
            <div id="successNotification" class="fixed top-24 right-6 z-50 transform translate-x-full transition-transform duration-300 ease-in-out">
                <div class="bg-green-500 text-white px-6 py-4 rounded-lg shadow-2xl flex items-center space-x-3 min-w-[300px]">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle text-2xl"></i>
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold">Login berhasil!</p>
                    </div>
                    <button onclick="hideNotification('successNotification')" class="flex-shrink-0 text-white hover:text-gray-200 transition">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        @endif

        {{-- ALERT ERROR --}}
        @if(session('error'))
            <div id="errorNotification" class="fixed top-24 right-6 z-50 transform translate-x-full transition-transform duration-300 ease-in-out">
                <div class="bg-red-500 text-white px-6 py-4 rounded-lg shadow-2xl flex items-center space-x-3 min-w-[300px]">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-circle text-2xl"></i>
                    </div>
                    <div class="flex-1">
                        <p class="font-semibold">{{ session('error') }}</p>
                    </div>
                    <button onclick="hideNotification('errorNotification')" class="flex-shrink-0 text-white hover:text-gray-200 transition">
                        <i class="fas fa-times"></i>
                    </button>
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
                        <a href="{{ route('pengaduan.create') }}" class="block text-gray-400 hover:text-white transition">
                            <i class="fas fa-plus-circle mr-2"></i> Buat Pengaduan
                        </a>
                        <a href="{{ route('pengaduan.index') }}" class="block text-gray-400 hover:text-white transition">
                            <i class="fas fa-list mr-2"></i> Riwayat Pengaduan
                        </a>
                        <form action="{{ route('user.logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-400 hover:text-white transition">
                                <i class="fas fa-sign-out-alt mr-2"></i> Logout
                            </button>
                        </form>
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

        function hideNotification(notificationId) {
            const notification = document.getElementById(notificationId);
            if (notification) {
                notification.classList.add('translate-x-full');
                setTimeout(() => {
                    notification.remove();
                }, 300);
            }
        }

        function showNotification(notificationId) {
            const notification = document.getElementById(notificationId);
            if (notification) {
                setTimeout(() => {
                    notification.classList.remove('translate-x-full');
                    notification.classList.add('translate-x-0');
                }, 100);
                
                setTimeout(() => {
                    hideNotification(notificationId);
                }, 3000);
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const successNotification = document.getElementById('successNotification');
            const errorNotification = document.getElementById('errorNotification');
            
            if (successNotification) {
                showNotification('successNotification');
            }
            
            if (errorNotification) {
                showNotification('errorNotification');
            }
        });
    </script>

</body>
</html>