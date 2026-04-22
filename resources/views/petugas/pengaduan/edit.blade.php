@extends('layout.petugas')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Edit Pengaduan</h1>
                <p class="text-gray-600 mt-1">Perbarui status dan informasi pengaduan</p>
            </div>
            <a href="{{ route('petugas.pengaduan.index') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>
    </div>

    <!-- Form Edit -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <form action="{{ route('petugas.pengaduan.update', $pengaduan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Kolom Kiri -->
                <div class="space-y-6">
                    <!-- Informasi Pelapor -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-user-circle mr-2 text-blue-600"></i>
                            Informasi Pelapor
                        </h3>
                        
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                <p class="text-gray-900 font-medium">{{ $pengaduan->nama }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">No. HP</label>
                                <p class="text-gray-900 font-medium">{{ $pengaduan->no_hp }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Detail Pengaduan -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-file-alt mr-2 text-green-600"></i>
                            Detail Pengaduan
                        </h3>
                        
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Layanan</label>
                                <div class="flex items-center">
                                    @if(strtolower($pengaduan->jenis_layanan) == 'pengaduan')
                                        <span class="bg-pink-100 text-pink-700 px-3 py-1 rounded-xl text-xs font-semibold">
                                            <i class="fas fa-exclamation-triangle mr-1"></i>Pengaduan
                                        </span>
                                    @elseif(strtolower($pengaduan->jenis_layanan) == 'konsultasi')
                                        <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-xl text-xs font-semibold">
                                            <i class="fas fa-comments mr-1"></i>Konsultasi
                                        </span>
                                    @else
                                        <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-xl text-xs font-semibold">
                                            {{ $pengaduan->jenis_layanan }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Judul Pengaduan</label>
                                <p class="text-gray-900 font-medium">{{ $pengaduan->judul_pengaduan }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Isi Pengaduan</label>
                                <div class="bg-white p-3 rounded border border-gray-200 max-h-40 overflow-y-auto">
                                    <p class="text-gray-900 whitespace-pre-wrap">{{ $pengaduan->isi_pengaduan }}</p>
                                </div>
                            </div>
                            
                            @if($pengaduan->lampiran)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Lampiran</label>
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-paperclip text-gray-500"></i>
                                    <a href="{{ asset('storage/' . $pengaduan->lampiran) }}" 
                                       target="_blank"
                                       class="text-blue-600 hover:text-blue-800 underline">
                                        {{ $pengaduan->lampiran }}
                                    </a>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="space-y-6">
                    <!-- Status & Tanggal -->
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-cog mr-2 text-blue-600"></i>
                            Status & Waktu
                        </h3>
                        
                        <div class="space-y-4">
                            <!-- Status Pengaduan -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-flag mr-1"></i>
                                    Status Pengaduan
                                    <span class="text-red-500">*</span>
                                </label>
                                <select name="status" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                    <option value="baru" {{ $pengaduan->status == 'baru' ? 'selected' : '' }}>
                                        Baru
                                    </option>
                                    <option value="diproses" {{ $pengaduan->status == 'diproses' ? 'selected' : '' }}>
                                        Diproses
                                    </option>
                                    <option value="selesai" {{ $pengaduan->status == 'selesai' ? 'selected' : '' }}>
                                        Selesai
                                    </option>
                                    <option value="ditolak" {{ $pengaduan->status == 'ditolak' ? 'selected' : '' }}>
                                        Ditolak
                                    </option>
                                </select>
                            </div>

                            <!-- Status Badge -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Status Saat Ini</label>
                                <div class="flex items-center">
                                    @if(strtolower($pengaduan->status) == 'baru')
                                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-xl text-xs font-semibold">
                                            <i class="fas fa-clock mr-1"></i>Baru
                                        </span>
                                    @elseif(strtolower($pengaduan->status) == 'menunggu')
                                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-xl text-xs font-semibold">
                                            <i class="fas fa-hourglass-half mr-1"></i>Menunggu
                                        </span>
                                    @elseif(strtolower($pengaduan->status) == 'diproses')
                                        <span class="bg-orange-100 text-orange-700 px-3 py-1 rounded-xl text-xs font-semibold">
                                            <i class="fas fa-spinner mr-1"></i>Diproses
                                        </span>
                                    @elseif(strtolower($pengaduan->status) == 'selesai')
                                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-xl text-xs font-semibold">
                                            <i class="fas fa-check-circle mr-1"></i>Selesai
                                        </span>
                                    @elseif(strtolower($pengaduan->status) == 'ditolak')
                                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-xl text-xs font-semibold">
                                            <i class="fas fa-times-circle mr-1"></i>Ditolak
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Tanggal -->
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        <i class="fas fa-calendar-plus mr-1"></i>
                                        Dibuat
                                    </label>
                                    <p class="text-gray-900 font-medium">
                                        {{ \Carbon\Carbon::parse($pengaduan->created_at)->format('d M Y, H:i') }}
                                    </p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        <i class="fas fa-calendar-check mr-1"></i>
                                        Diperbarui
                                    </label>
                                    <p class="text-gray-900 font-medium">
                                        {{ $pengaduan->updated_at ? \Carbon\Carbon::parse($pengaduan->updated_at)->format('d M Y, H:i') : '-' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Catatan Petugas -->
                    <div class="bg-yellow-50 p-4 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-sticky-note mr-2 text-yellow-600"></i>
                            Catatan Petugas
                        </h3>
                        
                        <textarea name="catatan_petugas" 
                                  rows="4" 
                                  placeholder="Tambahkan catatan atau tanggapan untuk pengaduan ini..."
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition">{{ old('catatan_petugas', $pengaduan->catatan_petugas) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-3 mt-6 pt-6 border-t border-gray-200">
                <a href="{{ route('petugas.pengaduan.index') }}" 
                   class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                    <i class="fas fa-times mr-2"></i>
                    Batal
                </a>
                <button type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition flex items-center">
                    <i class="fas fa-save mr-2"></i>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection