@extends('layout.user')

@section('content')
<div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-5xl mx-auto">
        <!-- Header -->
        <div class="mb-6 bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 mb-2">Detail Pengaduan</h1>
                    <p class="text-gray-600">Lihat detail dan balasan dari pengaduan Anda</p>
                </div>
                <a href="{{ route('pengaduan.index') }}" 
                   class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke Riwayat
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <!-- Header Info -->
            <div class="flex items-start justify-between mb-6 pb-6 border-b">
                <div>
                    <h2 class="text-xl font-semibold text-gray-900 mb-2">{{ $pengaduan->judul_pengaduan }}</h2>
                    <div class="flex items-center space-x-4 text-sm text-gray-500">
                        <span><i class="fas fa-calendar mr-1"></i>{{ $pengaduan->formatted_created_at }}</span>
                        <span><i class="fas fa-user mr-1"></i>{{ $pengaduan->nama }}</span>
                    </div>
                </div>
                <div>
                    @if(strtolower($pengaduan->status) == 'baru')
                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-semibold">
                            <i class="fas fa-clock mr-1"></i>Baru
                        </span>
                    @elseif(strtolower($pengaduan->status) == 'diproses')
                        <span class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full text-sm font-semibold">
                            <i class="fas fa-spinner mr-1"></i>Diproses
                        </span>
                    @elseif(strtolower($pengaduan->status) == 'selesai')
                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">
                            <i class="fas fa-check-circle mr-1"></i>Selesai
                        </span>
                    @elseif(strtolower($pengaduan->status) == 'ditolak')
                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-semibold">
                            <i class="fas fa-times-circle mr-1"></i>Ditolak
                        </span>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Informasi Pelapor -->
                <div>
                    <h3 class="text-sm font-semibold text-gray-900 mb-4">Informasi Pelapor</h3>
                    <div class="space-y-4">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="text-xs text-gray-500 mb-1">Nama</div>
                            <div class="text-sm text-gray-900 font-medium">{{ $pengaduan->nama }}</div>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="text-xs text-gray-500 mb-1">Email</div>
                            <div class="text-sm text-gray-900 font-medium">{{ $pengaduan->email }}</div>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="text-xs text-gray-500 mb-1">No. HP</div>
                            <div class="text-sm text-gray-900 font-medium">{{ $pengaduan->no_hp }}</div>
                        </div>
                    </div>
                </div>
                
                <!-- Informasi Layanan -->
                <div>
                    <h3 class="text-sm font-semibold text-gray-900 mb-4">Informasi Layanan</h3>
                    <div class="space-y-4">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="text-xs text-gray-500 mb-1">Jenis Layanan</div>
                            <div class="text-sm text-gray-900 font-medium">
                                @if(strtolower($pengaduan->jenis_layanan) == 'pengaduan')
                                    <span class="bg-pink-100 text-pink-700 px-2 py-1 rounded-full text-xs font-semibold">
                                        <i class="fas fa-exclamation-triangle mr-1"></i>Pengaduan
                                    </span>
                                @elseif(strtolower($pengaduan->jenis_layanan) == 'konsultasi')
                                    <span class="bg-purple-100 text-purple-700 px-2 py-1 rounded-full text-xs font-semibold">
                                        <i class="fas fa-comments mr-1"></i>Konsultasi
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="text-xs text-gray-500 mb-1">Status</div>
                            <div class="text-sm text-gray-900 font-medium">{{ $pengaduan->status }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Isi Pengaduan -->
            <div class="mt-6 pt-6 border-t">
                <h3 class="text-sm font-semibold text-gray-900 mb-3">Isi Pengaduan</h3>
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-sm text-gray-900 whitespace-pre-wrap">{{ $pengaduan->isi_pengaduan }}</p>
                </div>
            </div>

            <!-- Lampiran -->
            @if($pengaduan->lampiran)
            <div class="mt-6 pt-6 border-t">
                <h3 class="text-sm font-semibold text-gray-900 mb-3">Lampiran</h3>
                <a href="{{ asset('storage/' . $pengaduan->lampiran) }}" 
                   target="_blank"
                   class="inline-flex items-center text-blue-600 hover:text-blue-800 text-sm bg-blue-50 px-4 py-2 rounded-lg">
                    <i class="fas fa-download mr-2"></i>
                    Lihat Lampiran
                </a>
            </div>
            @endif
        </div>

        <!-- Balasan Admin/Petugas -->
        @if($pengaduan->catatan_petugas)
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center space-x-3 mb-4">
                <div class="bg-green-100 p-3 rounded-lg">
                    <i class="fas fa-reply text-green-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Balasan dari Admin/Petugas</h3>
                    <p class="text-sm text-gray-500">
                        @if($pengaduan->tanggal_balasan)
                            Dibalas pada {{ $pengaduan->formatted_tanggal_balasan }}
                        @endif
                    </p>
                </div>
            </div>
            
            <div class="bg-green-50 rounded-lg p-4">
                <p class="text-sm text-gray-900 whitespace-pre-wrap">{{ $pengaduan->catatan_petugas }}</p>
            </div>
        </div>
        @else
        <!-- Belum Ada Balasan -->
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6">
            <div class="flex items-center space-x-3">
                <div class="bg-yellow-100 p-3 rounded-lg">
                    <i class="fas fa-hourglass-half text-yellow-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-yellow-800">Belum Ada Balasan</h3>
                    <p class="text-sm text-yellow-700">Pengaduan Anda sedang dalam proses peninjauan. Silakan periksa kembali nanti.</p>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
