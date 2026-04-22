@extends('layout.admin')

@section('content')

<!-- Header Section -->
<div class="mb-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Detail Pengaduan</h1>
            <p class="text-gray-600">Informasi lengkap pengaduan dari pelapor</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.pengaduan.edit', $pengaduan->id) }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition flex items-center space-x-2">
                <i class="fas fa-edit"></i>
                <span>Edit Status</span>
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

    <!-- Informasi Pelapor -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center space-x-3 mb-4">
                <div class="bg-blue-100 p-3 rounded-lg">
                    <i class="fas fa-user text-blue-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Data Pelapor</h3>
                    <p class="text-sm text-gray-500">Identitas pengirim</p>
                </div>
            </div>
            
            <div class="space-y-4">
                <div class="border-l-4 border-blue-500 pl-4">
                    <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Nama Lengkap</label>
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
            </div>
        </div>
    </div>

    <!-- Detail Pengaduan -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center space-x-3 mb-6">
                <div class="bg-purple-100 p-3 rounded-lg">
                    <i class="fas fa-clipboard-list text-purple-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Detail Pengaduan</h3>
                    <p class="text-sm text-gray-500">Isi lengkap pengaduan</p>
                </div>
            </div>
            
            <div class="space-y-6">
                <!-- Status Badge -->
                <div class="flex items-center justify-between">
                    <div>
                        <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Status Saat Ini</label>
                        <div class="mt-2">
                            @switch($pengaduan->status)
                                @case('baru')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-clock mr-1"></i>
                                        Baru
                                    </span>
                                @case('diproses')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        <i class="fas fa-spinner mr-1"></i>
                                        Diproses
                                    </span>
                                @case('selesai')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-1"></i>
                                        Selesai
                                    </span>
                                @case('ditolak')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        <i class="fas fa-times-circle mr-1"></i>
                                        Ditolak
                                    </span>
                                @default
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        <i class="fas fa-question-circle mr-1"></i>
                                        {{ $pengaduan->status }}
                                    </span>
                            @endswitch
                        </div>
                    </div>
                    <div class="text-right">
                        <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">ID Pengaduan</label>
                        <p class="text-2xl font-bold text-gray-800">#{{ $pengaduan->id }}</p>
                    </div>
                </div>

                <!-- Jenis Layanan -->
                <div class="border-l-4 border-purple-500 pl-4">
                    <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Jenis Layanan</label>
                    <p class="text-gray-800 font-medium">{{ ucfirst($pengaduan->jenis_layanan) }}</p>
                </div>

                <!-- Judul Pengaduan -->
                <div class="border-l-4 border-purple-500 pl-4">
                    <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Judul Pengaduan</label>
                    <p class="text-gray-800 font-medium text-lg">{{ $pengaduan->judul_pengaduan }}</p>
                </div>

                <!-- Isi Pengaduan -->
                <div class="border-l-4 border-purple-500 pl-4">
                    <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Isi Pengaduan</label>
                    <div class="mt-2 p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <p class="text-gray-800 leading-relaxed">{{ $pengaduan->isi_pengaduan }}</p>
                    </div>
                </div>

                <!-- Lampiran Section -->
                <div class="border-l-4 border-purple-500 pl-4">
                    <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Lampiran</label>
                    @if($pengaduan->lampiran)
                        <div class="mt-3">
                            <!-- Image Preview -->
                            @if(in_array(strtolower(pathinfo($pengaduan->lampiran, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif']))
                                <div class="relative group">
                                    <img src="{{ asset('storage/'.$pengaduan->lampiran) }}" 
                                         alt="Lampiran" 
                                         class="w-full max-h-96 object-cover rounded-lg shadow-lg cursor-pointer"
                                         onclick="openFullscreen('{{ asset('storage/'.$pengaduan->lampiran) }}')">
                                    <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <button onclick="event.stopPropagation(); openFullscreen('{{ asset('storage/'.$pengaduan->lampiran) }}')" 
                                                class="bg-white/90 backdrop-blur-sm rounded-lg p-2 shadow-md text-gray-700 hover:text-gray-900">
                                            <i class="fas fa-expand"></i>
                                        </button>
                                    </div>
                                </div>
                            @else
                                <!-- File Info for non-image files -->
                                <div class="flex items-center justify-between p-4 bg-blue-50 rounded-lg border border-blue-200">
                                    <div class="flex items-center space-x-3">
                                        <div class="bg-blue-100 p-2 rounded-lg">
                                            <i class="fas fa-file text-blue-600"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-blue-800">File Terlampir</p>
                                            <p class="text-xs text-blue-600">{{ basename($pengaduan->lampiran) }}</p>
                                        </div>
                                    </div>
                                    
                                    <!-- Download Button -->
                                    <a href="{{ asset('storage/'.$pengaduan->lampiran) }}" 
                                       target="_blank" 
                                       class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition">
                                        <i class="fas fa-download mr-2"></i>
                                        <span>Download</span>
                                    </a>
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="mt-3 p-4 bg-gray-100 rounded-lg border border-gray-200">
                            <div class="flex items-center space-x-3">
                                <div class="bg-gray-100 p-2 rounded-lg">
                                    <i class="fas fa-inbox text-gray-600"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-800">Tidak Ada Lampiran</p>
                                    <p class="text-xs text-gray-600">Pelapor tidak mengupload file</p>
                                </div>
                            </div>
                    @endif
                </div>

                <!-- Catatan Petugas (jika ada) -->
                @if($pengaduan->catatan_petugas)
                <div class="border-l-4 border-green-500 pl-4">
                    <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Balasan dari Admin/Petugas</label>
                    <div class="mt-2 p-4 bg-green-50 rounded-lg border border-green-200">
                        <p class="text-gray-800 leading-relaxed">{{ $pengaduan->catatan_petugas }}</p>
                        @if($pengaduan->tanggal_balasan)
                        <p class="text-xs text-gray-500 mt-3">
                            <i class="fas fa-clock mr-1"></i>
                            Dibalas pada: {{ $pengaduan->formatted_tanggal_balasan }}
                        </p>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

</div>

<!-- Timeline Section -->
<div class="mt-8 bg-white rounded-xl shadow-sm border border-gray-200 p-6">
    <div class="flex items-center space-x-3 mb-6">
        <div class="bg-green-100 p-3 rounded-lg">
            <i class="fas fa-history text-green-600 text-xl"></i>
        </div>
        <div>
            <h3 class="text-lg font-semibold text-gray-800">Timeline Aktivitas</h3>
            <p class="text-sm text-gray-500">Riwayat perubahan status</p>
        </div>
    </div>
    
    <div class="space-y-4">
        <div class="flex items-start space-x-4">
            <div class="flex-shrink-0 w-10 h-10 bg-green-500 rounded-full flex items-center justify-center">
                <i class="fas fa-plus text-white text-sm"></i>
            </div>
            <div class="flex-1">
                <div class="bg-green-50 rounded-lg p-4 border border-green-200">
                    <div class="flex items-center justify-between">
                        <p class="font-medium text-green-800">Pengaduan Dibuat</p>
                        <p class="text-sm text-green-600">{{ $pengaduan->formatted_created_at }}</p>
                    </div>
                    <p class="text-sm text-gray-600 mt-1">Pengaduan berhasil diajukan oleh pelapor</p>
                </div>
            </div>
        </div>

        @if($pengaduan->tanggal_balasan && $pengaduan->catatan_petugas)
        <div class="flex items-start space-x-4">
            <div class="flex-shrink-0 w-10 h-10 bg-green-500 rounded-full flex items-center justify-center">
                <i class="fas fa-reply text-white text-sm"></i>
            </div>
            <div class="flex-1">
                <div class="bg-green-50 rounded-lg p-4 border border-green-200">
                    <div class="flex items-center justify-between">
                        <p class="font-medium text-green-800">Balasan Dikirim</p>
                        <p class="text-sm text-green-600">{{ $pengaduan->formatted_tanggal_balasan }}</p>
                    </div>
                    <p class="text-sm text-gray-600 mt-1">Admin/petugas telah membalas pengaduan</p>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

@endsection

<script>
function openFullscreen(imageSrc) {
    // Create fullscreen overlay
    const overlay = document.createElement('div');
    overlay.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.95);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        cursor: pointer;
    `;
    
    // Create image element
    const img = document.createElement('img');
    img.src = imageSrc;
    img.style.cssText = `
        max-width: 90%;
        max-height: 90%;
        object-fit: contain;
        cursor: default;
    `;
    
    // Create close button
    const closeBtn = document.createElement('button');
    closeBtn.innerHTML = '<i class="fas fa-times"></i>';
    closeBtn.style.cssText = `
        position: absolute;
        top: 20px;
        right: 20px;
        background: white;
        border: none;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        cursor: pointer;
        font-size: 18px;
        color: #333;
        transition: all 0.3s ease;
    `;
    closeBtn.onmouseover = () => closeBtn.style.background = '#f3f4f6';
    closeBtn.onmouseout = () => closeBtn.style.background = 'white';
    
    // Add elements to overlay
    overlay.appendChild(img);
    overlay.appendChild(closeBtn);
    
    // Close functions
    const closeFullscreen = () => {
        document.body.removeChild(overlay);
        document.removeEventListener('keydown', handleEscape);
    };
    
    const handleEscape = (e) => {
        if (e.key === 'Escape') closeFullscreen();
    };
    
    // Event listeners
    overlay.addEventListener('click', (e) => {
        if (e.target === overlay) closeFullscreen();
    });
    closeBtn.addEventListener('click', closeFullscreen);
    document.addEventListener('keydown', handleEscape);
    
    // Add to body
    document.body.appendChild(overlay);
}
</script>
