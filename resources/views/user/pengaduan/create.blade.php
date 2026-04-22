@extends('layout.user')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header Section -->
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mb-4">
                <i class="fas fa-edit text-blue-600 text-2xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Buat Pengaduan Baru</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Sampaikan pengaduan atau konsultasi Anda kepada tim BAPPERIDA. 
                Kami akan segera merespons dan menindaklanjuti setiap masukan Anda.
            </p>
        </div>

        <!-- Form Card -->
        <div class="bg-white shadow-xl rounded-2xl overflow-hidden">
            <!-- Form Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-8 py-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="bg-white/20 rounded-lg p-2">
                            <i class="fas fa-clipboard-list text-white text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-semibold text-white">Form Pengaduan</h2>
                            <p class="text-blue-100 text-sm">Isi data dengan lengkap dan benar</p>
                        </div>
                    </div>
                    <div class="hidden md:flex items-center space-x-2 text-blue-100">
                        <i class="fas fa-info-circle"></i>
                        <span class="text-sm">Wajib diisi *</span>
                    </div>
                </div>
            </div>

            <!-- Form Body -->
            <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data" class="p-8">
                @csrf
                
                <!-- Personal Information Section -->
                <div class="mb-8">
                    <div class="flex items-center mb-6">
                        <div class="bg-blue-50 rounded-lg p-2 mr-3">
                            <i class="fas fa-user text-blue-600"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Informasi Pribadi</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama Lengkap -->
                        <div>
                            <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="text" 
                                       id="nama"
                                       name="nama" 
                                       value="{{ Auth::user()->name ?? old('nama') }}"
                                       class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                       placeholder="Masukkan nama lengkap Anda"
                                       required>
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
                                    <i class="fas fa-user text-gray-400"></i>
                                </div>
                            </div>
                            @error('nama')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- No. HP -->
                        <div>
                            <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-2">
                                No. HP <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="tel" 
                                       id="no_hp"
                                       name="no_hp" 
                                       value=""
                                       maxlength="12"
                                       class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                       placeholder="081234567890"
                                       required>
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
                                    <i class="fas fa-phone text-gray-400"></i>
                                </div>
                            </div>
                            @error('no_hp')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jenis Layanan -->
                        <div>
                            <label for="jenis_layanan" class="block text-sm font-medium text-gray-700 mb-2">
                                Jenis Layanan <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <select id="jenis_layanan"
                                        name="jenis_layanan" 
                                        class="w-full pl-10 pr-10 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition appearance-none"
                                        required>
                                    <option value="">Pilih Jenis Layanan</option>
                                    <option value="pengaduan" {{ old('jenis_layanan') == 'pengaduan' ? 'selected' : '' }}>
                                        📝 Pengaduan
                                    </option>
                                    <option value="konsultasi" {{ old('jenis_layanan') == 'konsultasi' ? 'selected' : '' }}>
                                        💬 Konsultasi
                                    </option>
                                </select>
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
                                    <i class="fas fa-concierge-bell text-gray-400"></i>
                                </div>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <i class="fas fa-chevron-down text-gray-400"></i>
                                </div>
                            </div>
                            @error('jenis_layanan')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Pengaduan Details Section -->
                <div class="mb-8">
                    <div class="flex items-center mb-6">
                        <div class="bg-blue-50 rounded-lg p-2 mr-3">
                            <i class="fas fa-file-alt text-blue-600"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Detail Pengaduan</h3>
                    </div>

                    <!-- Judul Pengaduan -->
                    <div class="mb-6">
                        <label for="judul_pengaduan" class="block text-sm font-medium text-gray-700 mb-2">
                            Judul Pengaduan <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="text" 
                                   id="judul_pengaduan"
                                   name="judul_pengaduan" 
                                   value="{{ old('judul_pengaduan') }}"
                                   class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                   placeholder="Judul singkat yang jelas"
                                   required>
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
                                <i class="fas fa-heading text-gray-400"></i>
                            </div>
                        </div>
                        @error('judul_pengaduan')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Isi Pengaduan -->
                    <div class="mb-6">
                        <label for="isi_pengaduan" class="block text-sm font-medium text-gray-700 mb-2">
                            Isi Pengaduan <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <textarea id="isi_pengaduan"
                                      name="isi_pengaduan" 
                                      rows="6"
                                      class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition resize-none"
                                      placeholder="Jelaskan pengaduan atau konsultasi Anda secara detail..."
                                      required>{{ old('isi_pengaduan') }}</textarea>
                            <div class="absolute top-3 left-3">
                                <i class="fas fa-align-left text-gray-400"></i>
                            </div>
                        </div>
                        <div class="mt-2 text-sm text-gray-500">
                            <i class="fas fa-info-circle mr-1"></i>
                            Minimal 20 karakter. Jelaskan secara detail untuk memudahkan proses penanganan.
                        </div>
                        @error('isi_pengaduan')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Lampiran -->
                    <div class="mb-6">
                        <label for="lampiran" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-paperclip mr-1"></i>
                            Lampiran (Opsional)
                        </label>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-400 transition">
                            <div class="flex flex-col items-center">
                                <div class="bg-gray-100 rounded-full p-3 mb-3">
                                    <i class="fas fa-cloud-upload-alt text-gray-600 text-xl"></i>
                                </div>
                                <label for="lampiran" class="cursor-pointer">
                                    <span class="text-blue-600 hover:text-blue-700 font-medium">Pilih file</span>
                                    <span class="text-gray-500"> atau drag and drop</span>
                                </label>
                                <input type="file" 
                                       id="lampiran"
                                       name="lampiran" 
                                       class="hidden"
                                       accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                                <p class="text-xs text-gray-500 mt-2">
                                    PDF, DOC, DOCX, JPG, PNG (Max. 5MB)
                                </p>
                            </div>
                            <div id="filePreview" class="hidden mt-4">
                                <div id="imagePreviewContainer" class="mb-3 hidden">
                                    <img id="imagePreview" src="" alt="Preview" class="max-w-full max-h-48 mx-auto rounded-lg shadow-sm">
                                </div>
                                <div class="flex items-center justify-between bg-gray-50 rounded-lg p-3">
                                    <div class="flex items-center">
                                        <i class="fas fa-file text-blue-600 mr-2"></i>
                                        <span id="fileName" class="text-sm text-gray-700"></span>
                                    </div>
                                    <button type="button" onclick="removeFile()" class="text-red-500 hover:text-red-700">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        @error('lampiran')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>


                <!-- Form Actions -->
                <div class="flex flex-col sm:flex-row gap-4 justify-between items-center pt-6 border-t border-gray-200">
                    <div class="text-sm text-gray-500">
                        <i class="fas fa-lock mr-1"></i>
                        Data Anda aman dan terlindungi
                    </div>
                    <div class="flex gap-4">
                        <a href="{{ route('user.dashboard') }}" 
                           class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition flex items-center">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Batal
                        </a>
                        <button type="submit" 
                                class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition flex items-center font-medium">
                            <i class="fas fa-paper-plane mr-2"></i>
                            Kirim Pengaduan
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Help Section -->
        <div class="mt-8 bg-blue-50 rounded-xl p-6">
            <div class="flex items-start space-x-4">
                <div class="bg-blue-100 rounded-lg p-2 flex-shrink-0">
                    <i class="fas fa-question-circle text-blue-600"></i>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-900 mb-2">Butuh Bantuan?</h3>
                    <p class="text-gray-600 text-sm mb-3">
                        Jika Anda mengalami kesulitan dalam mengisi form, jangan ragu untuk menghubungi tim kami.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="tel:0251-8338052" class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                            <i class="fas fa-phone mr-1"></i>
                            0251-8338052
                        </a>
                        <a href="mailto:bapperida@kotabogor.go.id" class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                            <i class="fas fa-envelope mr-1"></i>
                            bapperida@kotabogor.go.id
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // File upload preview
    const fileInput = document.getElementById('lampiran');
    const filePreview = document.getElementById('filePreview');
    const fileName = document.getElementById('fileName');

    fileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            // Validate file size (5MB max)
            if (file.size > 5 * 1024 * 1024) {
                alert('File terlalu besar. Maksimal 5MB.');
                this.value = '';
                return;
            }
            
            // Validate file type
            const allowedTypes = ['pdf', 'doc', 'docx', 'jpg', 'jpeg', 'png'];
            const fileExtension = file.name.split('.').pop().toLowerCase();
            
            if (!allowedTypes.includes(fileExtension)) {
                alert('Tipe file tidak diizinkan. Hanya PDF, DOC, DOCX, JPG, JPEG, PNG.');
                this.value = '';
                return;
            }
            
            fileName.textContent = file.name;
            filePreview.classList.remove('hidden');
            
            // Show image preview for image files
            const imageTypes = ['jpg', 'jpeg', 'png'];
            const imagePreviewContainer = document.getElementById('imagePreviewContainer');
            const imagePreview = document.getElementById('imagePreview');
            
            if (imageTypes.includes(fileExtension)) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreviewContainer.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                imagePreviewContainer.classList.add('hidden');
            }
        }
    });

    // Character counter for textarea
    const textarea = document.getElementById('isi_pengaduan');
    const charCounter = document.createElement('div');
    charCounter.className = 'text-xs text-gray-500 mt-1 text-right';
    charCounter.textContent = '0 / 1000 karakter';
    textarea.parentNode.appendChild(charCounter);

    textarea.addEventListener('input', function() {
        const length = this.value.length;
        charCounter.textContent = `${length} / 1000 karakter`;
        
        if (length > 1000) {
            this.value = this.value.substring(0, 1000);
            charCounter.textContent = '1000 / 1000 karakter';
        }
        
        // Update character counter color based on length
        if (length < 20) {
            charCounter.classList.add('text-red-500');
            charCounter.classList.remove('text-gray-500', 'text-green-500');
        } else if (length > 900) {
            charCounter.classList.add('text-orange-500');
            charCounter.classList.remove('text-gray-500', 'text-red-500', 'text-green-500');
        } else {
            charCounter.classList.add('text-green-500');
            charCounter.classList.remove('text-gray-500', 'text-red-500', 'text-orange-500');
        }
    });

    // Form validation
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        const isiPengaduan = document.getElementById('isi_pengaduan').value;
        const jenisLayanan = document.getElementById('jenis_layanan').value;
        
        // Validate minimum characters
        if (isiPengaduan.length < 20) {
            e.preventDefault();
            alert('Isi pengaduan minimal 20 karakter');
            document.getElementById('isi_pengaduan').focus();
            return;
        }
        
        // Validate jenis layanan
        if (!jenisLayanan) {
            e.preventDefault();
            alert('Silakan pilih jenis layanan');
            document.getElementById('jenis_layanan').focus();
            return;
        }
        
        // Show loading state
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Mengirim...';
        submitBtn.disabled = true;
        
        // Reset button after 5 seconds (fallback)
        setTimeout(() => {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }, 5000);
    });

    // Auto-resize textarea
    function autoResize() {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
    }
    
    textarea.addEventListener('input', autoResize);
    textarea.addEventListener('focus', autoResize);
    
    // Initialize
    autoResize.call(textarea);
    
    // Phone number validation
    const phoneInput = document.getElementById('no_hp');
    phoneInput.addEventListener('input', function(e) {
        // Remove non-numeric characters
        let value = this.value.replace(/\D/g, '');
        
        // Limit to 12 digits
        if (value.length > 12) {
            value = value.substring(0, 12);
        }
        
        this.value = value;
    });
});

function removeFile() {
    document.getElementById('lampiran').value = '';
    document.getElementById('filePreview').classList.add('hidden');
    document.getElementById('imagePreviewContainer').classList.add('hidden');
    document.getElementById('imagePreview').src = '';
}
</script>
@endsection
