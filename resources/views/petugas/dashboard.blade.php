@extends('layout.petugas')

@section('content')

<!-- Dashboard Header -->
<div class="mb-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Petugas Dashboard</h1>
            <p class="text-gray-600">Monitor dan kelola pengaduan yang ditugaskan kepada Anda</p>
        </div>
        <div class="flex items-center space-x-3">
            <div class="bg-blue-50 px-4 py-2 rounded-lg">
                <p class="text-sm text-blue-600 font-medium">Petugas Status</p>
                <p class="text-xs text-blue-500">Online & Active</p>
            </div>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
    
    <!-- Total Pengaduan -->
    <div class="bg-gradient-to-br from-blue-50 to-blue-100 border border-blue-200 rounded-xl p-6 hover:shadow-lg transition-all duration-300">
        <div class="flex items-center justify-between mb-4">
            <div class="bg-blue-500 p-3 rounded-lg shadow-lg">
                <i class="fas fa-clipboard-list text-white text-xl"></i>
            </div>
            <div class="bg-blue-100 px-2 py-1 rounded-full">
                <span class="text-xs text-blue-600 font-semibold">All Time</span>
            </div>
        </div>
        <h3 class="text-gray-700 font-semibold mb-1">Total Pengaduan</h3>
        <p class="text-3xl font-bold text-blue-600">{{ $total ?? 0 }}</p>
        <div class="mt-3 flex items-center text-sm text-blue-600">
            <i class="fas fa-chart-line mr-1"></i>
            <span>Semua pengaduan</span>
        </div>
    </div>

    <!-- Pengaduan Baru -->
    <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 border border-yellow-200 rounded-xl p-6 hover:shadow-lg transition-all duration-300">
        <div class="flex items-center justify-between mb-4">
            <div class="bg-yellow-500 p-3 rounded-lg shadow-lg">
                <i class="fas fa-plus-circle text-white text-xl"></i>
            </div>
            <div class="bg-yellow-100 px-2 py-1 rounded-full">
                <span class="text-xs text-yellow-600 font-semibold">New</span>
            </div>
        </div>
        <h3 class="text-gray-700 font-semibold mb-1">Pengaduan Baru</h3>
        <p class="text-3xl font-bold text-yellow-600">{{ $baru ?? 0 }}</p>
        <div class="mt-3 flex items-center text-sm text-yellow-600">
            <i class="fas fa-clock mr-1"></i>
            <span>Menunggu proses</span>
        </div>
    </div>

    <!-- Pengaduan Diproses -->
    <div class="bg-gradient-to-br from-purple-50 to-purple-100 border border-purple-200 rounded-xl p-6 hover:shadow-lg transition-all duration-300">
        <div class="flex items-center justify-between mb-4">
            <div class="bg-purple-500 p-3 rounded-lg shadow-lg">
                <i class="fas fa-spinner text-white text-xl"></i>
            </div>
            <div class="bg-purple-100 px-2 py-1 rounded-full">
                <span class="text-xs text-purple-600 font-semibold">Processing</span>
            </div>
        </div>
        <h3 class="text-gray-700 font-semibold mb-1">Sedang Diproses</h3>
        <p class="text-3xl font-bold text-purple-600">{{ $diproses ?? 0 }}</p>
        <div class="mt-3 flex items-center text-sm text-purple-600">
            <i class="fas fa-cog mr-1"></i>
            <span>Dalam penanganan</span>
        </div>
    </div>

    <!-- Pengaduan Selesai -->
    <div class="bg-gradient-to-br from-green-50 to-green-100 border border-green-200 rounded-xl p-6 hover:shadow-lg transition-all duration-300">
        <div class="flex items-center justify-between mb-4">
            <div class="bg-green-500 p-3 rounded-lg shadow-lg">
                <i class="fas fa-check-circle text-white text-xl"></i>
            </div>
            <div class="bg-green-100 px-2 py-1 rounded-full">
                <span class="text-xs text-green-600 font-semibold">Completed</span>
            </div>
        </div>
        <h3 class="text-gray-700 font-semibold mb-1">Selesai</h3>
        <p class="text-3xl font-bold text-green-600">{{ $selesai ?? 0 }}</p>
        <div class="mt-3 flex items-center text-sm text-green-600">
            <i class="fas fa-check mr-1"></i>
            <span>Telah diselesaikan</span>
        </div>
    </div>

    <!-- Pengaduan Ditolak -->
    <div class="bg-gradient-to-br from-red-50 to-red-100 border border-red-200 rounded-xl p-6 hover:shadow-lg transition-all duration-300">
        <div class="flex items-center justify-between mb-4">
            <div class="bg-red-500 p-3 rounded-lg shadow-lg">
                <i class="fas fa-times-circle text-white text-xl"></i>
            </div>
            <div class="bg-red-100 px-2 py-1 rounded-full">
                <span class="text-xs text-red-600 font-semibold">Rejected</span>
            </div>
        </div>
        <h3 class="text-gray-700 font-semibold mb-1">Ditolak</h3>
        <p class="text-3xl font-bold text-red-600">{{ $ditolak ?? 0 }}</p>
        <div class="mt-3 flex items-center text-sm text-red-600">
            <i class="fas fa-ban mr-1"></i>
            <span>Tidak disetujui</span>
        </div>
    </div>

</div>

<!-- Quick Actions & Recent Activity -->


</div>

@endsection
