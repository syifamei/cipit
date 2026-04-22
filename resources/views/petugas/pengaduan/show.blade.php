@extends('layout.petugas')

@section('content')
<div class="max-w-5xl mx-auto">
    <!-- Header -->
    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Detail Pengaduan</h1>
                <p class="text-gray-600 mt-1">Informasi lengkap pengaduan #{{ $pengaduan->id }}</p>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('petugas.pengaduan.edit', $pengaduan->id) }}" 
                   class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition flex items-center">
                    <i class="fas fa-edit mr-2"></i>
                    Edit Status
                </a>
                <a href="{{ route('petugas.pengaduan.index') }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Kolom Kiri - Informasi Pelapor -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Informasi Pelapor -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center mb-4">
                    <div class="bg-blue-100 p-3 rounded-full mr-3">
                        <i class="fas fa-user text-blue-600 text-lg"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800">Informasi Pelapor</h2>
                        <p class="text-sm text-gray-500">Data diri pengirim pengaduan</p>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <div class="flex items-center">
                            <i class="fas fa-user-circle text-gray-400 mr-2"></i>
                            <span class="text-gray-900 font-medium">{{ $pengaduan->nama }}</span>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">No. HP</label>
                        <div class="flex items-center">
                            <i class="fas fa-phone text-gray-400 mr-2"></i>
                            <a href="tel:{{ $pengaduan->no_hp }}" 
                               class="text-green-600 hover:text-green-800 font-medium">
                                {{ $pengaduan->no_hp }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detail Pengaduan -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center mb-4">
                    <div class="bg-green-100 p-3 rounded-full mr-3">
                        <i class="fas fa-file-alt text-green-600 text-lg"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800">Detail Pengaduan</h2>
                        <p class="text-sm text-gray-500">Isi lengkap pengaduan</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Layanan</label>
                        <div class="flex items-center">
                            @if(strtolower($pengaduan->jenis_layanan) == 'pengaduan')
                                <span class="bg-pink-100 text-pink-700 px-3 py-1 rounded-full text-xs font-semibold">
                                    <i class="fas fa-exclamation-triangle mr-1"></i>Pengaduan
                                </span>
                            @elseif(strtolower($pengaduan->jenis_layanan) == 'konsultasi')
                                <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-xs font-semibold">
                                    <i class="fas fa-comments mr-1"></i>Konsultasi
                                </span>
                            @else
                                <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs font-semibold">
                                    {{ $pengaduan->jenis_layanan }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Judul Pengaduan</label>
                        <div class="bg-gray-50 p-3 rounded-lg border border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">{{ $pengaduan->judul_pengaduan }}</h3>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Isi Pengaduan</label>
                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 max-h-64 overflow-y-auto">
                            <p class="text-gray-900 whitespace-pre-wrap leading-relaxed">{{ $pengaduan->isi_pengaduan }}</p>
                        </div>
                    </div>

                    @if($pengaduan->lampiran)
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Lampiran</label>
                        <div class="bg-blue-50 p-3 rounded-lg border border-blue-200">
                            <div class="flex items-center">
                                <i class="fas fa-paperclip text-blue-600 mr-3"></i>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $pengaduan->lampiran }}</p>
                                    <p class="text-xs text-gray-500">File lampiran pengaduan</p>
                                </div>
                            </div>
                            <a href="{{ asset('storage/' . $pengaduan->lampiran) }}" 
                               target="_blank"
                               class="mt-3 inline-flex items-center text-blue-600 hover:text-blue-800 text-sm font-medium">
                                <i class="fas fa-eye mr-1"></i>
                                Lihat File
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Kolom Kanan - Status & Timeline -->
        <div class="space-y-6">
            <!-- Status Pengaduan -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center mb-4">
                    <div class="bg-orange-100 p-3 rounded-full mr-3">
                        <i class="fas fa-flag text-orange-600 text-lg"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800">Status</h2>
                        <p class="text-sm text-gray-500">Status terkini pengaduan</p>
                    </div>
                </div>

                <div class="text-center mb-4">
                    @if(strtolower($pengaduan->status) == 'baru')
                        <span class="bg-blue-100 text-blue-700 px-4 py-2 rounded-full text-sm font-semibold">
                            <i class="fas fa-clock mr-2"></i>Baru
                        </span>
                    @elseif(strtolower($pengaduan->status) == 'menunggu')
                        <span class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full text-sm font-semibold">
                            <i class="fas fa-hourglass-half mr-2"></i>Menunggu
                        </span>
                    @elseif(strtolower($pengaduan->status) == 'diproses')
                        <span class="bg-orange-100 text-orange-700 px-4 py-2 rounded-full text-sm font-semibold">
                            <i class="fas fa-spinner mr-2"></i>Diproses
                        </span>
                    @elseif(strtolower($pengaduan->status) == 'selesai')
                        <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-semibold">
                            <i class="fas fa-check-circle mr-2"></i>Selesai
                        </span>
                    @elseif(strtolower($pengaduan->status) == 'ditolak')
                        <span class="bg-red-100 text-red-700 px-4 py-2 rounded-full text-sm font-semibold">
                            <i class="fas fa-times-circle mr-2"></i>Ditolak
                        </span>
                    @endif
                </div>

                <!-- Quick Action -->
                <a href="{{ route('petugas.pengaduan.edit', $pengaduan->id) }}" 
                   class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition flex items-center justify-center">
                    <i class="fas fa-edit mr-2"></i>
                    Update Status
                </a>
            </div>

            <!-- Timeline & Waktu -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center mb-4">
                    <div class="bg-purple-100 p-3 rounded-full mr-3">
                        <i class="fas fa-clock text-purple-600 text-lg"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800">Timeline</h2>
                        <p class="text-sm text-gray-500">Riwayat waktu pengaduan</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="flex items-start">
                        <div class="bg-blue-100 p-2 rounded-full mr-3 mt-1">
                            <i class="fas fa-calendar-plus text-blue-600 text-xs"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900">Dibuat</p>
                            <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($pengaduan->created_at)->format('d M Y, H:i:s') }}</p>
                        </div>
                    </div>

                    @if($pengaduan->updated_at && $pengaduan->updated_at != $pengaduan->created_at)
                    <div class="flex items-start">
                        <div class="bg-green-100 p-2 rounded-full mr-3 mt-1">
                            <i class="fas fa-calendar-check text-green-600 text-xs"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900">Diperbarui</p>
                            <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($pengaduan->updated_at)->format('d M Y, H:i:s') }}</p>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Catatan Petugas -->
                @if($pengaduan->catatan_petugas)
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-sticky-note mr-1"></i>
                        Catatan Petugas
                    </label>
                    <div class="bg-yellow-50 p-3 rounded-lg border border-yellow-200">
                        <p class="text-sm text-gray-900">{{ $pengaduan->catatan_petugas }}</p>
                    </div>
                </div>
                @endif
            </div>

            <!-- Info Tambahan -->
            <div class="bg-gradient-to-br from-blue-50 to-purple-50 rounded-lg p-6 border border-blue-200">
                <h3 class="text-sm font-semibold text-gray-800 mb-3">
                    <i class="fas fa-info-circle mr-2"></i>Informasi Tambahan
                </h3>
                <div class="space-y-2 text-xs text-gray-600">
                    <p><strong>ID Pengaduan:</strong> #{{ $pengaduan->id }}</p>
                    <p><strong>Status:</strong> {{ ucfirst($pengaduan->status) }}</p>
                    <p><strong>Layanan:</strong> {{ ucfirst($pengaduan->jenis_layanan) }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
