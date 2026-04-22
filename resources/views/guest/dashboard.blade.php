@extends('layout.guest')

@section('content')
<!-- Hero Section -->
<section class="relative h-[400px] md:h-[500px] lg:h-[600px] flex items-center justify-center overflow-hidden">
    <!-- Background Image -->
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('images/bapperida-kota-bogor-profil.jpeg') }}" alt="BAPPERIDA Kota Bogor" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/60 to-black/80"></div>
    </div>

    <!-- Hero Content -->
    <div class="relative z-10 text-center text-white px-4 sm:px-6 lg:px-8 max-w-4xl lg:max-w-5xl mx-auto">
        <div class="space-y-4 sm:space-y-6">
            <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold leading-tight">
                Pusat Pengaduan<br>
                <span class="text-blue-400">BAPPERIDA</span>
            </h1>
            <p class="text-sm sm:text-base md:text-lg lg:text-xl leading-relaxed text-gray-200 max-w-3xl mx-auto">
                Pusat layanan pengaduan dan konsultasi terpadu<br>
                untuk melayani masyarakat dengan lebih baik
            </p>
            
            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-3 justify-center items-center pt-4 sm:pt-6">
                <a href="{{ route('user.register') }}" 
                   class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white px-5 sm:px-6 py-2 sm:py-3 rounded-lg font-semibold transition transform hover:scale-105 shadow-xl text-sm sm:text-base">
                    <i class="fas fa-edit mr-2"></i>
                    Buat Pengaduan
                </a>
                <a href="#features" 
                   class="w-full sm:w-auto bg-transparent border-2 border-white text-white hover:bg-white hover:text-gray-900 px-5 sm:px-6 py-2 sm:py-3 rounded-lg font-semibold transition transform hover:scale-105 text-sm sm:text-base">
                    <i class="fas fa-info-circle mr-2"></i>
                    Informasi Layanan
                </a>
            </div>
        </div>
    </div>
</section>

<div class="min-h-screen bg-gray-50 py-20" id="features">
    <div class="container mx-auto px-6">
        <!-- Welcome Section -->
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Layanan Pengaduan & Konsultasi</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Platform terpadu untuk menyampaikan keluhan, pertanyaan, atau konsultasi Anda secara mudah dan cepat.
            </p>
        </div>

        <!-- Features Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
            <!-- Feature 1 -->
            <div onclick="showFeatureModal('pengaduan')" class="bg-white rounded-xl shadow-lg p-8 text-center hover:shadow-xl transition cursor-pointer transform hover:scale-105">
                <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-file-alt text-blue-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-3">Pengaduan</h3>
                <p class="text-gray-600">Sampaikan keluhan atau masalah yang perlu ditindaklanjuti oleh pihak terkait.</p>
            </div>

            <!-- Feature 2 -->
            <div onclick="showFeatureModal('konsultasi')" class="bg-white rounded-xl shadow-lg p-8 text-center hover:shadow-xl transition cursor-pointer transform hover:scale-105">
                <div class="bg-purple-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-comments text-purple-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-3">Konsultasi</h3>
                <p class="text-gray-600">Dapatkan informasi dan bantuan konsultasi untuk berbagai layanan kami.</p>
            </div>

            <!-- Feature 3 -->
            <div onclick="showFeatureModal('tracking')" class="bg-white rounded-xl shadow-lg p-8 text-center hover:shadow-xl transition cursor-pointer transform hover:scale-105">
                <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-tachometer-alt text-green-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-3">Tracking</h3>
                <p class="text-gray-600">Monitor status pengaduan Anda secara real-time dan transparan.</p>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl p-8 sm:p-12 text-center text-white">
            <h3 class="text-2xl sm:text-3xl font-bold mb-4">Siap Membantu Anda</h3>
            <p class="text-base sm:text-xl mb-6 sm:mb-8 opacity-90">
                Tim kami siap melayani dan menindaklanjuti setiap pengaduan dengan profesional.
            </p>
            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                <a href="{{ route('user.register') }}" 
                   class="w-full sm:w-auto bg-white text-blue-600 hover:bg-gray-100 font-semibold px-6 sm:px-8 py-3 sm:py-4 rounded-lg shadow-lg transition transform hover:scale-105">
                    <i class="fas fa-plus-circle mr-2"></i>
                    Buat Pengaduan Sekarang
                </a>
            </div>
        </div>
    </div>
</div>

    <!-- Informasi / Fitur Section -->
    

<!-- Feature Modal -->
<div id="featureModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-lg max-w-lg w-full mx-4 p-6 relative transform transition-all">
        <button onclick="closeFeatureModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
            <i class="fas fa-times text-xl"></i>
        </button>
        
        <div id="modalContent" class="text-center">
            <!-- Content will be dynamically inserted here -->
        </div>
    </div>
</div>

<script>
function showFeatureModal(type) {
    const modal = document.getElementById('featureModal');
    const content = document.getElementById('modalContent');
    
    const features = {
        pengaduan: {
            icon: 'fas fa-file-alt text-blue-600',
            title: 'Layanan Pengaduan',
            description: 'Sampaikan keluhan atau masalah yang memerlukan penanganan segera dari pihak terkait.'
        },
        konsultasi: {
            icon: 'fas fa-comments text-purple-600',
            title: 'Layanan Konsultasi',
            description: 'Dapatkan informasi dan bantuan konsultasi untuk berbagai layanan perizinan dan investasi.'
        },
        tracking: {
            icon: 'fas fa-tachometer-alt text-green-600',
            title: 'Tracking Real-time',
            description: 'Monitor status pengaduan Anda secara real-time dan transparan untuk kemudahan tracking.'
        }
    };
    
    const feature = features[type];
    content.innerHTML = `
        <div class="mb-4">
            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="${feature.icon} text-2xl"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-3">${feature.title}</h3>
            <p class="text-gray-600 leading-relaxed">${feature.description}</p>
        </div>
        <button onclick="closeFeatureModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">
            Mengerti
        </button>
    `;
    
    modal.classList.remove('hidden');
    setTimeout(() => {
        modal.querySelector('.bg-white').classList.add('scale-100');
    }, 10);
}

function closeFeatureModal() {
    const modal = document.getElementById('featureModal');
    modal.querySelector('.bg-white').classList.remove('scale-100');
    setTimeout(() => {
        modal.classList.add('hidden');
    }, 300);
}

// Close modal when clicking outside
document.getElementById('featureModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeFeatureModal();
    }
});
</script>
@endsection
