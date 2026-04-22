@extends('layout.admin')

@section('content')

<!-- Header Section -->
<div class="mb-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Edit Status Pengaduan</h1>
            <p class="text-gray-600">Perbarui status dan tambahkan catatan untuk pengaduan #{{ $pengaduan->id }}</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.pengaduan.show', $pengaduan->id) }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition flex items-center space-x-2">
                <i class="fas fa-eye"></i>
                <span>Lihat Detail</span>
            </a>
            <a href="{{ route('admin.pengaduan.index') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition flex items-center space-x-2">
                <i class="fas fa-arrow-left"></i>
                <span>Kembali</span>
            </a>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- Informasi Pengaduan (Read-only) -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center space-x-3 mb-6">
                <div class="bg-blue-100 p-3 rounded-lg">
                    <i class="fas fa-clipboard-list text-blue-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Informasi Pengaduan</h3>
                    <p class="text-sm text-gray-500">Data lengkap dari pelapor</p>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Data Pelapor -->
                <div class="space-y-4">
                    <div class="border-l-4 border-blue-500 pl-4">
                        <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Nama Pelapor</label>
                        <p class="text-gray-800 font-medium">{{ $pengaduan->nama }}</p>
                    </div>
                    
                    <div class="border-l-4 border-blue-500 pl-4">
                        <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Email</label>
                        <p class="text-gray-800 font-medium">{{ $pengaduan->email }}</p>
                    </div>
                    
                    <div class="border-l-4 border-blue-500 pl-4">
                        <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">No. Telepon</label>
                        <p class="text-gray-800 font-medium">{{ $pengaduan->no_hp ?? 'Tidak tersedia' }}</p>
                    </div>
                    
                    <div class="border-l-4 border-blue-500 pl-4">
                        <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Jenis Layanan</label>
                        <p class="text-gray-800 font-medium">{{ ucfirst($pengaduan->jenis_layanan) }}</p>
                    </div>
                </div>
                
                <!-- Detail Pengaduan -->
                <div class="space-y-4">
                    <div class="border-l-4 border-purple-500 pl-4">
                        <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Judul Pengaduan</label>
                        <p class="text-gray-800 font-medium text-lg">{{ $pengaduan->judul_pengaduan }}</p>
                    </div>
                    
                    <div class="border-l-4 border-purple-500 pl-4">
                        <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Tanggal Pengaduan</label>
                        <p class="text-gray-800 font-medium">{{ $pengaduan->tanggal_pengaduan }}</p>
                    </div>
                    
                    <div class="border-l-4 border-purple-500 pl-4">
                        <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Isi Pengaduan</label>
                        <div class="mt-2 p-4 bg-gray-50 rounded-lg border border-gray-200">
                            <p class="text-gray-800 leading-relaxed">{{ $pengaduan->isi_pengaduan }}</p>
                        </div>
                    </div>
                    
                    @if($pengaduan->lampiran)
                    <div class="border-l-4 border-purple-500 pl-4">
                        <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Lampiran</label>
                        <div class="mt-2">
                            <a href="{{ asset('storage/'.$pengaduan->lampiran) }}" 
                               target="_blank" 
                               class="inline-flex items-center px-3 py-2 bg-blue-50 hover:bg-blue-100 text-blue-600 rounded-lg transition">
                                <i class="fas fa-paperclip mr-2"></i>
                                Lihat Lampiran
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Form Update Status -->
    <div class="lg:col-span-1">
        <form action="{{ route('admin.pengaduan.update', $pengaduan->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <!-- Status Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="bg-green-100 p-3 rounded-lg">
                        <i class="fas fa-edit text-green-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Update Status</h3>
                        <p class="text-sm text-gray-500">Ubah status pengaduan</p>
                    </div>
                </div>
                
                
                <!-- Status Selection -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Pilih Status Baru</label>
                    <select name="status" id="status"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                        <option value="baru" {{ $pengaduan->status == 'baru' ? 'selected' : '' }}>
                            🕐 Baru
                        </option>
                        <option value="diproses" {{ $pengaduan->status == 'diproses' ? 'selected' : '' }}>
                            ⚙️ Diproses
                        </option>
                        <option value="selesai" {{ $pengaduan->status == 'selesai' ? 'selected' : '' }}>
                            ✅ Selesai
                        </option>
                        <option value="ditolak" {{ $pengaduan->status == 'ditolak' ? 'selected' : '' }}>
                            ❌ Ditolak
                        </option>
                    </select>
                </div>
            </div>
            
            <!-- Catatan Petugas Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="bg-orange-100 p-3 rounded-lg">
                        <i class="fas fa-sticky-note text-orange-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Catatan Petugas</h3>
                        <p class="text-sm text-gray-500">Tambahkan catatan (opsional)</p>
                    </div>
                </div>
                
                <div>
                    <label for="catatan_petugas" class="block text-sm font-medium text-gray-700 mb-2">Catatan</label>
                    <textarea name="catatan_petugas" id="catatan_petugas" rows="4" 
                              placeholder="Tambahkan catatan atau keterangan..."
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">{{ $pengaduan->catatan_petugas ?? '' }}</textarea>
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex gap-3">
                <button type="submit" 
                        class="flex-1 bg-green-600 hover:bg-green-700 text-white px-4 py-3 rounded-lg font-semibold transition transform hover:scale-[1.02] shadow-lg">
                    <i class="fas fa-save mr-2"></i>
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.pengaduan.index') }}" 
                   class="flex-1 bg-gray-500 hover:bg-gray-600 text-white px-4 py-3 rounded-lg font-semibold transition transform hover:scale-[1.02] shadow-lg text-center">
                    <i class="fas fa-times mr-2"></i>
                    Batal
                </a>
            </div>
        </form>
    </div>

</div>

@endsection
