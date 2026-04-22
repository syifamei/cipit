@extends('layout.admin')

@section('content')
<div class="min-h-screen bg-gray-50 flex items-center justify-center px-4 py-8">
    <div class="bg-white shadow-xl rounded-2xl p-8 w-full max-w-lg">
        <div class="mb-6">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-2">Tambah Petugas</h1>
            <p class="text-gray-600 text-sm sm:text-base mb-6">Masukkan data petugas admin atau operator helpdesk.</p>
        </div>
        <form action="{{ route('admin.petugas.store') }}" method="POST">
            @csrf
            <div class="mb-5">
                <label class="block font-semibold mb-2 text-gray-700">Nama</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-user text-gray-400"></i>
                    </div>
                    <input type="text" name="name" class="w-full border border-gray-300 rounded-lg pl-10 pr-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm transition" placeholder="Masukkan nama" required>
                </div>
            </div>
            <div class="mb-5">
                <label class="block font-semibold mb-2 text-gray-700">Email</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-envelope text-gray-400"></i>
                    </div>
                    <input type="email" name="email" class="w-full border border-gray-300 rounded-lg pl-10 pr-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm transition" placeholder="Masukkan email" required autocomplete="off">
                </div>
            </div>
            <div class="mb-5">
                <label class="block font-semibold mb-2 text-gray-700">Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-lock text-gray-400"></i>
                    </div>
                    <input type="password" name="password" id="password" class="w-full border border-gray-300 rounded-lg pl-10 pr-12 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm transition" placeholder="Masukkan password" required autocomplete="new-password">
                    <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                        <i id="passwordToggle" class="fas fa-eye-slash"></i>
                    </button>
                </div>
            </div>
            <div class="mb-6">
                <label class="block font-semibold mb-2 text-gray-700">Role</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-shield-alt text-gray-400"></i>
                    </div>
                    <select name="role" class="w-full border border-gray-300 rounded-lg pl-10 pr-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm transition appearance-none">
                        <option value="admin">Admin</option>
                        <option value="petugas">Petugas</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                        <i class="fas fa-chevron-down text-gray-400"></i>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg shadow-lg transition-all duration-300 transform hover:scale-105 flex items-center gap-2">
                    <i class="fas fa-save"></i>
                    Simpan
                </button>
                <a href="{{ route('admin.petugas.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg shadow-lg transition-all duration-300 transform hover:scale-105 flex items-center gap-2">
                    <i class="fas fa-times"></i>
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const passwordToggle = document.getElementById('passwordToggle');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        passwordToggle.classList.remove('fa-eye-slash');
        passwordToggle.classList.add('fa-eye');
    } else {
        passwordInput.type = 'password';
        passwordToggle.classList.remove('fa-eye');
        passwordToggle.classList.add('fa-eye-slash');
    }
}
</script>
@endsection
