<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - BAPPERIDA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-slate-50 to-gray-100 min-h-screen">

<div class="flex">

<!-- SIDEBAR -->
<aside id="sidebar" class="w-72 bg-gradient-to-b from-slate-900 to-slate-800 text-white min-h-screen shadow-2xl border-r border-slate-700 fixed left-0 top-0 z-10 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">

    <!-- Logo Section -->
    <div class="p-6 border-b border-slate-700 flex items-center justify-between">
        <div class="flex items-center space-x-3">
            <div class="bg-gradient-to-br from-blue-500 to-indigo-600 p-2 rounded-xl shadow-lg">
                <i class="fas fa-shield-alt text-white text-xl"></i>
            </div>
            <div>
                <h1 class="text-xl font-bold text-white">Admin Portal</h1>
                <p class="text-xs text-slate-400">BAPPERIDA Management</p>
            </div>
        </div>
        <button onclick="toggleSidebar()" class="lg:hidden text-slate-400 hover:text-white">
            <i class="fas fa-times text-xl"></i>
        </button>
    </div>

    <!-- Navigation -->
    <nav class="p-6 space-y-2">
        <div class="mb-6">
            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-3">Main Menu</p>
        </div>

        <a href="{{ route('admin.dashboard') }}" 
           class="flex items-center space-x-3 px-4 py-3 rounded-xl hover:bg-slate-700 transition-all duration-200 group {{ request()->routeIs('admin.dashboard') ? 'bg-slate-700 border-l-4 border-blue-500' : '' }}">
            <i class="fas fa-tachometer-alt text-slate-400 group-hover:text-blue-400 w-5"></i>
            <span class="font-medium">Dashboard</span>
        </a>

        <a href="{{ route('admin.pengaduan.index') }}" 
           class="flex items-center space-x-3 px-4 py-3 rounded-xl hover:bg-slate-700 transition-all duration-200 group {{ request()->routeIs('admin.pengaduan.*') ? 'bg-slate-700 border-l-4 border-blue-500' : '' }}">
            <i class="fas fa-clipboard-list text-slate-400 group-hover:text-blue-400 w-5"></i>
            <span class="font-medium">Manajemen Pengaduan</span>
        </a>

        <a href="{{ route('admin.petugas.index') }}" 
           class="flex items-center space-x-3 px-4 py-3 rounded-xl hover:bg-slate-700 transition-all duration-200 group {{ request()->routeIs('admin.petugas.*') ? 'bg-slate-700 border-l-4 border-blue-500' : '' }}">
            <i class="fas fa-users text-slate-400 group-hover:text-blue-400 w-5"></i>
            <span class="font-medium">Manajemen Petugas</span>
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

    <!-- Page Content -->
    <div class="flex-1 lg:ml-72">
        <!-- Mobile Header -->
        <header class="lg:hidden bg-white shadow-sm border-b border-gray-200 p-4">
            <div class="flex items-center justify-between">
                <button onclick="toggleSidebar()" class="text-gray-600 hover:text-gray-900">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <div class="flex items-center space-x-3">
                    <div class="bg-gradient-to-br from-blue-500 to-indigo-600 p-2 rounded-xl shadow-lg">
                        <i class="fas fa-shield-alt text-white text-sm"></i>
                    </div>
                    <div>
                        <h1 class="text-sm font-bold text-gray-800">Admin Portal</h1>
                        <p class="text-xs text-gray-500">BAPPERIDA Management</p>
                    </div>
                </div>
            </div>
        </header>
        
        <!-- Main Content -->
        <main class="p-4 lg:p-8">
            @yield('content')
        </main>
    </div>

</div>

<!-- Mobile Sidebar Overlay -->
<div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-0 lg:hidden hidden" onclick="toggleSidebar()"></div>

<script>
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    
    sidebar.classList.toggle('-translate-x-full');
    overlay.classList.toggle('hidden');
}

// Close sidebar when clicking outside on mobile
document.addEventListener('click', function(event) {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const toggleButton = event.target.closest('[onclick*="toggleSidebar"]');
    
    if (!sidebar.contains(event.target) && !toggleButton && !sidebar.classList.contains('-translate-x-full')) {
        toggleSidebar();
    }
});
</script>

</body>
</html>
