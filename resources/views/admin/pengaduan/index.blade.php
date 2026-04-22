@extends('layout.admin')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header Section -->
    <div class="bg-white rounded-lg shadow-sm p-4 sm:p-6 mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Manajemen Pengaduan</h1>
                <p class="text-gray-600 mt-1 text-sm sm:text-base">Kelola semua pengaduan masuk ke sistem</p>
            </div>
            
            <!-- Export Buttons - Mobile First -->
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3 sm:gap-4">
                <!-- Export Buttons -->
                <div class="flex items-center space-x-2">
                    <a href="{{ route('admin.pengaduan.exportExcel') }}" 
                       class="bg-green-600 hover:bg-green-700 text-white px-3 sm:px-4 py-2 rounded-lg transition flex items-center text-sm">
                        <i class="fas fa-file-excel mr-1 sm:mr-2"></i>
                        <span class="hidden sm:inline">Export Excel</span>
                        <span class="sm:hidden">Excel</span>
                    </a>
                    <a href="{{ route('admin.pengaduan.exportPDF') }}" 
                       class="bg-red-600 hover:bg-red-700 text-white px-3 sm:px-4 py-2 rounded-lg transition flex items-center text-sm">
                        <i class="fas fa-file-pdf mr-1 sm:mr-2"></i>
                        <span class="hidden sm:inline">Export PDF</span>
                        <span class="sm:hidden">PDF</span>
                    </a>
                </div>
                
                <!-- Quick Stats -->
                <div class="flex items-center space-x-2 sm:space-x-4 border-l border-gray-200 pl-2 sm:pl-4">
                    <div class="text-center">
                        <div class="text-lg sm:text-2xl font-bold text-blue-600">{{ $pengaduans->count() }}</div>
                        <div class="text-xs text-gray-500">Total</div>
                    </div>
                    <div class="text-center">
                        <div class="text-lg sm:text-2xl font-bold text-yellow-600">{{ $pengaduans->where('status', 'baru')->count() }}</div>
                        <div class="text-xs text-gray-500">Baru</div>
                    </div>
                    <div class="text-center">
                        <div class="text-lg sm:text-2xl font-bold text-orange-600">{{ $pengaduans->where('status', 'diproses')->count() }}</div>
                        <div class="text-xs text-gray-500">Diproses</div>
                    </div>
                    <div class="text-center">
                        <div class="text-lg sm:text-2xl font-bold text-green-600">{{ $pengaduans->where('status', 'selesai')->count() }}</div>
                        <div class="text-xs text-gray-500">Selesai</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <!-- Filter & Search Section -->
    <div class="bg-white rounded-lg shadow-sm p-3 sm:p-4 mb-6">
        <form method="GET" class="space-y-4">
            <!-- Search -->
            <div class="flex-1">
                <div class="relative">
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Cari berdasarkan nama, email, atau subjek..." 
                           class="w-full pl-10 pr-4 py-2 sm:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                </div>
            </div>
            
            <!-- Filters Row -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                <!-- Filter Jenis Layanan -->
                <select name="jenis_layanan" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                    <option value="">Semua Layanan</option>
                    <option value="pengaduan" {{ request('jenis_layanan') == 'pengaduan' ? 'selected' : '' }}>Pengaduan</option>
                    <option value="konsultasi" {{ request('jenis_layanan') == 'konsultasi' ? 'selected' : '' }}>Konsultasi</option>
                </select>
                
                <!-- Filter Status -->
                <select name="status" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                    <option value="">Semua Status</option>
                    <option value="baru" {{ request('status') == 'baru' ? 'selected' : '' }}>Baru</option>
                    <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                    <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
                
                <!-- Buttons -->
                <div class="flex items-center space-x-2">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition flex items-center text-sm">
                        <i class="fas fa-filter mr-2"></i>
                        Filter
                    </button>
                    <a href="{{ route('admin.pengaduan.index') }}" 
                       class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition flex items-center text-sm">
                        <i class="fas fa-redo mr-2"></i>
                        Reset
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- Main Table -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <span class="hidden sm:inline">Informasi Pelapor</span>
                            <span class="sm:hidden">Pelapor</span>
                        </th>
                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Layanan
                        </th>
                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th class="hidden sm:table-cell px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tanggal
                        </th>
                        <th class="px-4 sm:px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="pengaduanTableBody">
                    @foreach($pengaduans as $pengaduan)
                    <tr class="hover:bg-gray-50 transition-colors pengaduan-row" 
                        data-search="{{ strtolower($pengaduan->nama . ' ' . $pengaduan->email . ' ' . $pengaduan->subjek) }}"
                        data-status="{{ $pengaduan->status }}"
                        data-layanan="{{ $pengaduan->jenis_layanan }}">
                        <td class="px-4 sm:px-6 py-4">
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    <div class="h-8 w-8 sm:h-10 sm:w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                        <i class="fas fa-user text-blue-600 text-xs sm:text-sm"></i>
                                    </div>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <div class="text-sm font-medium text-gray-900 truncate">{{ $pengaduan->nama }}</div>
                                    <div class="text-sm text-gray-500 truncate">{{ $pengaduan->email }}</div>
                                    @if($pengaduan->no_hp)
                                    <div class="text-xs text-gray-400 hidden sm:block">{{ $pengaduan->no_hp }}</div>
                                    @endif
                                    <!-- Mobile date display -->
                                    <div class="text-xs text-gray-400 sm:hidden mt-1">
                                        {{ $pengaduan->formatted_created_at }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 sm:px-6 py-4">
                            <div>
                                @if(strtolower($pengaduan->jenis_layanan) == 'pengaduan')
                                    <span class="bg-pink-100 text-pink-700 px-2 py-1 rounded-full text-xs font-semibold">
                                        <i class="fas fa-exclamation-triangle mr-1"></i>Pengaduan
                                    </span>
                                @elseif(strtolower($pengaduan->jenis_layanan) == 'konsultasi')
                                    <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded-full text-xs font-semibold">
                                        <i class="fas fa-comments mr-1"></i>Konsultasi
                                    </span>
                                @else
                                    <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded-full text-xs font-semibold">
                                        <i class="fas fa-question-circle mr-1"></i>{{ ucfirst($pengaduan->jenis_layanan) }}
                                    </span>
                                @endif
                                <div class="text-sm text-gray-900 font-medium mt-1 truncate">{{ $pengaduan->subjek }}</div>
                                <div class="text-xs text-gray-500 mt-1 line-clamp-2">{{ Str::limit($pengaduan->isi_pengaduan ?? '', 80) }}</div>
                            </div>
                        </td>
                        <td class="px-4 sm:px-6 py-4">
                            @switch(strtolower($pengaduan->status))
                                @case('baru')
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-800">
                                        <i class="fas fa-clock mr-1"></i> Baru
                                    </span>
                                    @break
                                @case('diproses')
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-bold bg-orange-100 text-orange-800">
                                        <i class="fas fa-spinner mr-1"></i> Diproses
                                    </span>
                                    @break
                                @case('selesai')
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-1"></i> Selesai
                                    </span>
                                    @break
                                @case('ditolak')
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-bold bg-red-100 text-red-800">
                                        <i class="fas fa-times-circle mr-1"></i> Ditolak
                                    </span>
                                    @break
                                @default
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-800">
                                        <i class="fas fa-question-circle mr-1"></i> {{ $pengaduan->status }}
                                    </span>
                            @endswitch
                        </td>
                        <td class="hidden sm:table-cell px-4 sm:px-6 py-4 text-sm text-gray-900">
                            {{ $pengaduan->formatted_created_at }}
                        </td>
                        <td class="px-4 sm:px-6 py-4 text-center">
                            <div class="flex justify-center items-center space-x-1 sm:space-x-2">
                                <a href="{{ route('admin.pengaduan.show', $pengaduan->id) }}" 
                                   class="bg-blue-600 hover:bg-blue-700 text-white px-2 py-1 sm:px-3 sm:py-2 rounded-lg transition flex items-center text-xs sm:text-sm"
                                   title="Lihat Detail">
                                    <i class="fas fa-eye mr-1"></i>
                                    <span class="hidden sm:inline">Detail</span>
                                </a>
                                <a href="{{ route('admin.pengaduan.edit', $pengaduan->id) }}" 
                                   class="bg-yellow-500 hover:bg-yellow-600 text-white px-2 py-1 sm:px-3 sm:py-2 rounded-lg transition flex items-center text-xs sm:text-sm"
                                   title="Edit Pengaduan">
                                    <i class="fas fa-edit mr-1"></i>
                                    <span class="hidden sm:inline">Edit</span>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $pengaduans->links() }}
    </div>

    <!-- Empty State -->
    @if($pengaduans->isEmpty())
    <div class="bg-white rounded-lg shadow-sm p-12 text-center">
        <div class="text-gray-400 mb-4">
            <i class="fas fa-inbox text-6xl"></i>
        </div>
        <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada pengaduan</h3>
        <p class="text-gray-500">Pengaduan yang masuk akan tampil di sini</p>
    </div>
    @endif
</div>

<!-- JavaScript untuk Filter & Search -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.querySelector('input[name="search"]');
    const statusFilter = document.querySelector('select[name="status"]');
    const layananFilter = document.querySelector('select[name="jenis_layanan"]');
    const rows = document.querySelectorAll('.pengaduan-row');
    const selectAllCheckbox = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('.pengaduan-checkbox');

    // Search functionality
    function filterTable() {
        const searchTerm = searchInput.value.toLowerCase();
        const statusValue = statusFilter.value.toLowerCase();
        const layananValue = layananFilter.value.toLowerCase();

        rows.forEach(row => {
            const matchesSearch = row.dataset.search.includes(searchTerm);
            const matchesStatus = !statusValue || row.dataset.status === statusValue;
            const matchesLayanan = !layananValue || row.dataset.layanan === layananValue;

            if (matchesSearch && matchesStatus && matchesLayanan) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // Event listeners
    searchInput.addEventListener('input', filterTable);
    statusFilter.addEventListener('change', filterTable);
    layananFilter.addEventListener('change', filterTable);

    // Select all functionality
    selectAllCheckbox.addEventListener('change', function() {
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });
});
</script>
@endsection
