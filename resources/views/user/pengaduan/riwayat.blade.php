@extends('layout.user')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">Riwayat Pengaduan Saya</h1>
                    <p class="text-base sm:text-lg text-gray-600">
                        Pantau status dan perkembangan pengaduan yang telah Anda ajukan
                    </p>
                </div>
                <a href="{{ route('pengaduan.create') }}" 
                   class="bg-blue-600 hover:bg-blue-700 text-white px-4 sm:px-6 py-2 sm:py-3 rounded-lg transition flex items-center justify-center">
                    <i class="fas fa-plus mr-2"></i>
                    <span class="hidden sm:inline">Buat Pengaduan Baru</span>
                    <span class="sm:hidden">Buat Baru</span>
                </a>
            </div>
        </div>

        <!-- Success Message -->
        @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4 flex items-center">
            <div class="bg-green-100 rounded-full p-2 mr-3">
                <i class="fas fa-check-circle text-green-600"></i>
            </div>
            <div class="flex-1">
                <p class="text-green-800 font-medium">{{ session('success') }}</p>
            </div>
            <button onclick="this.parentElement.remove()" class="text-green-600 hover:text-green-800">
                <i class="fas fa-times"></i>
            </button>
        </div>
        @endif

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Pengaduan</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $pengaduans->count() }}</p>
                    </div>
                    <div class="bg-blue-100 rounded-full p-3">
                        <i class="fas fa-inbox text-blue-600"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Baru</p>
                        <p class="text-2xl font-bold text-blue-500">{{ $pengaduans->where('status', 'baru')->count() }}</p>
                    </div>
                    <div class="bg-blue-100 rounded-full p-3">
                        <i class="fas fa-clock text-blue-500"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Diproses</p>
                        <p class="text-2xl font-bold text-yellow-500">{{ $pengaduans->where('status', 'diproses')->count() }}</p>
                    </div>
                    <div class="bg-yellow-100 rounded-full p-3">
                        <i class="fas fa-spinner text-yellow-500"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Selesai</p>
                        <p class="text-2xl font-bold text-green-600">{{ $pengaduans->where('status', 'selesai')->count() }}</p>
                    </div>
                    <div class="bg-green-100 rounded-full p-3">
                        <i class="fas fa-check-circle text-green-600"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        @if($pengaduans->isEmpty())
        <!-- Empty State -->
        <div class="bg-white rounded-lg shadow-sm p-12 text-center">
            <div class="text-gray-400 mb-4">
                <i class="fas fa-inbox text-6xl"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Pengaduan</h3>
            <p class="text-gray-500 mb-6">Anda belum membuat pengaduan apa pun. Mulai buat pengaduan pertama Anda.</p>
            <a href="{{ route('pengaduan.create') }}" 
               class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition">
                <i class="fas fa-plus mr-2"></i>
                Buat Pengaduan Pertama
            </a>
        </div>
        @else
        <!-- Pengaduan List -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Detail Pengaduan
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Jenis Layanan
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal
                            </th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($pengaduans as $pengaduan)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0">
                                        <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                            <i class="fas fa-file-alt text-blue-600 text-sm"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $pengaduan->judul_pengaduan }}</div>
                                        <div class="text-sm text-gray-500 line-clamp-2">{{ Str::limit($pengaduan->isi_pengaduan, 100) }}</div>
                                        <div class="text-xs text-gray-400 mt-1">{{ $pengaduan->nama }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @if(strtolower($pengaduan->jenis_layanan) == 'pengaduan')
                                    <span class="bg-pink-100 text-pink-700 px-2 py-1 rounded-full text-xs font-semibold">
                                        <i class="fas fa-exclamation-triangle mr-1"></i>Pengaduan
                                    </span>
                                @elseif(strtolower($pengaduan->jenis_layanan) == 'konsultasi')
                                    <span class="bg-purple-100 text-purple-700 px-2 py-1 rounded-full text-xs font-semibold">
                                        <i class="fas fa-comments mr-1"></i>Konsultasi
                                    </span>
                                @else
                                    <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded-full text-xs font-semibold">
                                        {{ $pengaduan->jenis_layanan }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if(strtolower($pengaduan->status) == 'baru')
                                    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-semibold">
                                        <i class="fas fa-clock mr-1"></i>Baru
                                    </span>
                                @elseif(strtolower($pengaduan->status) == 'menunggu')
                                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-semibold">
                                        <i class="fas fa-hourglass-half mr-1"></i>Menunggu
                                    </span>
                                @elseif(strtolower($pengaduan->status) == 'diproses')
                                    <span class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full text-xs font-semibold">
                                        <i class="fas fa-spinner mr-1"></i>Diproses
                                    </span>
                                @elseif(strtolower($pengaduan->status) == 'selesai')
                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                                        <i class="fas fa-check-circle mr-1"></i>Selesai
                                    </span>
                                @elseif(strtolower($pengaduan->status) == 'ditolak')
                                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-semibold">
                                        <i class="fas fa-times-circle mr-1"></i>Ditolak
                                    </span>
                                @else
                                    <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs font-semibold">
                                        {{ $pengaduan->status }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">
                                    {{ $pengaduan->formatted_created_at }}
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center space-x-2">
                                    <!-- View Detail Button -->
                                    <a href="{{ route('pengaduan.show', $pengaduan->id) }}" 
                                       class="text-blue-600 hover:text-blue-800 transition p-1"
                                       title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>

    <!-- Detail Modal -->
    <div id="detailModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="bg-white rounded-lg max-w-2xl w-full max-h-screen overflow-y-auto">
                <div class="bg-blue-600 text-white px-6 py-4 rounded-t-lg">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold">Detail Pengaduan</h3>
                        <button onclick="closeModal()" class="text-white hover:text-gray-200">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div id="modalContent" class="p-6">
                    <!-- Content will be loaded here -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Pengaduan data for modal
const pengaduanData = @json($pengaduans);

function showDetail(id) {
    const pengaduan = pengaduanData.find(p => p.id === id);
    if (!pengaduan) return;

    const content = `
        <div class="space-y-6">
            <!-- Informasi Pelapor -->
            <div>
                <h4 class="text-sm font-semibold text-gray-900 mb-3">Informasi Pelapor</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-xs font-medium text-gray-500">Nama</label>
                        <p class="text-sm text-gray-900">${pengaduan.nama}</p>
                    </div>
                    <div>
                        <label class="text-xs font-medium text-gray-500">Email</label>
                        <p class="text-sm text-gray-900">${pengaduan.email}</p>
                    </div>
                    <div>
                        <label class="text-xs font-medium text-gray-500">No. Telepon</label>
                        <p class="text-sm text-gray-900">${pengaduan.no_hp}</p>
                    </div>
                    <div>
                        <label class="text-xs font-medium text-gray-500">Jenis Layanan</label>
                        <p class="text-sm text-gray-900">${pengaduan.jenis_layanan}</p>
                    </div>
                </div>
            </div>

            <!-- Detail Pengaduan -->
            <div>
                <h4 class="text-sm font-semibold text-gray-900 mb-3">Detail Pengaduan</h4>
                <div class="space-y-3">
                    <div>
                        <label class="text-xs font-medium text-gray-500">Judul</label>
                        <p class="text-sm text-gray-900 font-medium">${pengaduan.judul_pengaduan}</p>
                    </div>
                    <div>
                        <label class="text-xs font-medium text-gray-500">Isi Pengaduan</label>
                        <p class="text-sm text-gray-900 whitespace-pre-wrap">${pengaduan.isi_pengaduan}</p>
                    </div>
                </div>
            </div>

            <!-- Status dan Tanggal -->
            <div>
                <h4 class="text-sm font-semibold text-gray-900 mb-3">Status & Tanggal</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-xs font-medium text-gray-500">Status</label>
                        <div class="mt-1">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold
                                ${getStatusColor(pengaduan.status)}">
                                ${getStatusLabel(pengaduan.status)}
                            </span>
                        </div>
                    </div>
                    <div>
                        <label class="text-xs font-medium text-gray-500">Tanggal Pengaduan</label>
                        <p class="text-sm text-gray-900">${formatDate(pengaduan.tanggal_pengaduan)}</p>
                    </div>
                </div>
            </div>

            <!-- Lampiran -->
            ${pengaduan.lampiran ? `
            <div>
                <h4 class="text-sm font-semibold text-gray-900 mb-3">Lampiran</h4>
                <a href="/storage/${pengaduan.lampiran}" 
                   target="_blank"
                   class="inline-flex items-center text-blue-600 hover:text-blue-800 text-sm">
                    <i class="fas fa-download mr-2"></i>
                    Download Lampiran
                </a>
            </div>
            ` : ''}
        </div>
    `;

    document.getElementById('modalContent').innerHTML = content;
    document.getElementById('detailModal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('detailModal').classList.add('hidden');
}

function getStatusColor(status) {
    const colors = {
        'baru': 'bg-blue-100 text-blue-700',
        'menunggu': 'bg-yellow-100 text-yellow-700',
        'diproses': 'bg-orange-100 text-orange-700',
        'selesai': 'bg-green-100 text-green-700',
        'ditolak': 'bg-red-100 text-red-700'
    };
    return colors[status] || 'bg-gray-100 text-gray-700';
}

function getStatusLabel(status) {
    const labels = {
        'baru': 'Baru',
        'menunggu': 'Menunggu',
        'diproses': 'Diproses',
        'selesai': 'Selesai',
        'ditolak': 'Ditolak'
    };
    return labels[status] || status;
}

function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('id-ID', {
        day: 'numeric',
        month: 'long',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
}

// Close modal when clicking outside
document.getElementById('detailModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});
</script>
@endsection
