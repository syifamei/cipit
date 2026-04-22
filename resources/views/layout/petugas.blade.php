<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petugas Portal - BAPPERIDA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Custom styles for sidebar transitions */
        .sidebar-transition {
            transition: transform 0.3s ease-in-out;
        }
        
        .sidebar-hidden {
            transform: translateX(-100%);
        }
        
        @media (min-width: 768px) {
            .sidebar-hidden {
                transform: translateX(0);
            }
        }
        
        .overlay-transition {
            transition: opacity 0.3s ease-in-out;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-50 to-gray-100 min-h-screen">

<!-- Mobile Overlay -->
<div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden md:hidden overlay-transition"></div>

<div class="flex">

<!-- SIDEBAR -->
<aside id="sidebar" class="w-72 bg-gradient-to-b from-slate-900 to-slate-800 text-white min-h-screen shadow-2xl border-r border-slate-700 fixed left-0 top-0 z-50 sidebar-transition md:translate-x-0 -translate-x-full">

    <!-- Logo Section -->
    <div class="p-6 border-b border-slate-700">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="bg-blue-600 p-2 rounded-xl shadow-lg">
                    <i class="fas fa-user-tie text-white text-xl"></i>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-white">Petugas Portal</h1>
                    <p class="text-xs text-slate-400">BAPPERIDA Staff</p>
                </div>
            </div>
            <!-- Mobile Close Button -->
            <button id="closeSidebar" class="md:hidden text-slate-400 hover:text-white transition-colors">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="p-6 space-y-2">
        <div class="mb-6">
            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-3">Petugas Menu</p>
        </div>

        <a href="{{ route('petugas.dashboard') }}" 
           class="flex items-center space-x-3 px-4 py-3 rounded-xl hover:bg-slate-700 transition-all duration-200 group {{ request()->routeIs('petugas.dashboard') ? 'bg-slate-700 border-l-4 border-blue-500' : '' }}">
            <i class="fas fa-tachometer-alt text-slate-400 group-hover:text-blue-400 w-5"></i>
            <span class="font-medium">Dashboard</span>
        </a>

        <a href="{{ route('petugas.pengaduan.index') }}" 
           class="flex items-center space-x-3 px-4 py-3 rounded-xl hover:bg-slate-700 transition-all duration-200 group {{ request()->routeIs('petugas.pengaduan.*') ? 'bg-slate-700 border-l-4 border-blue-500' : '' }}">
            <i class="fas fa-clipboard-list text-slate-400 group-hover:text-blue-400 w-5"></i>
            <span class="font-medium">Data Pengaduan</span>
        </a>
    </nav>

    <!-- User Profile Section -->
    <div class="mt-auto p-6 border-t border-slate-700">
        <div class="flex items-center space-x-3 mb-4">
            <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center">
                <i class="fas fa-user text-white text-sm"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-white">{{ Auth::guard('admin')->user()->name ?? 'Petugas' }}</p>
                <p class="text-xs text-slate-400">{{ Auth::guard('admin')->user()->role ?? 'Petugas' }}</p>
            </div>
        </div>
        
        <!-- Logout Button -->
        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center space-x-2 px-4 py-2 rounded-lg bg-red-500/20 hover:bg-red-500/30 text-red-400 hover:text-red-300 transition-all duration-200">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </button>
        </form>
    </div>

</aside>

<!-- CONTENT -->
<main class="flex-1 flex flex-col">

    <!-- Mobile Header -->
    <header class="bg-white shadow-sm border-b border-gray-200 px-4 py-3 md:hidden">
        <div class="flex items-center justify-between">
            <button id="openSidebar" class="text-slate-600 hover:text-slate-900 transition-colors">
                <i class="fas fa-bars text-xl"></i>
            </button>
            <div class="flex items-center space-x-2">
                <div class="bg-blue-600 p-1.5 rounded-lg">
                    <i class="fas fa-user-tie text-white text-sm"></i>
                </div>
                <span class="text-sm font-semibold text-slate-800">Petugas Portal</span>
            </div>
            <div class="w-6"></div>
        </div>
    </header>

    <!-- Page Content -->
    <div class="flex-1 p-4 md:p-8 md:ml-72">
        {{-- ALERT SUCCESS --}}
        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 p-4 rounded-lg flex items-center">
                <i class="fas fa-check-circle mr-3"></i>
                {{ session('success') }}
            </div>
        @endif

        {{-- ALERT ERROR --}}
        @if(session('error'))
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 p-4 rounded-lg flex items-center">
                <i class="fas fa-exclamation-circle mr-3"></i>
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </div>

</main>

</div>

<!-- JavaScript for Sidebar Toggle -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const openButton = document.getElementById('openSidebar');
    const closeButton = document.getElementById('closeSidebar');
    
    function openSidebar() {
        sidebar.classList.remove('-translate-x-full');
        sidebar.classList.add('translate-x-0');
        overlay.classList.remove('hidden');
        document.body.style.overflow = 'hidden'; // Prevent background scroll
    }
    
    function closeSidebar() {
        sidebar.classList.add('-translate-x-full');
        sidebar.classList.remove('translate-x-0');
        overlay.classList.add('hidden');
        document.body.style.overflow = ''; // Restore background scroll
    }
    
    // Event listeners
    openButton.addEventListener('click', openSidebar);
    closeButton.addEventListener('click', closeSidebar);
    overlay.addEventListener('click', closeSidebar);
    
    // Close sidebar on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !sidebar.classList.contains('-translate-x-full')) {
            closeSidebar();
        }
    });
    
    // Handle window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 768) {
            // Reset sidebar state on desktop
            sidebar.classList.remove('-translate-x-full');
            sidebar.classList.add('translate-x-0');
            overlay.classList.add('hidden');
            document.body.style.overflow = '';
        }
    });
});
</script>

</body>
</html>
