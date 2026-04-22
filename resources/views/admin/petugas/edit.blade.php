@extends('layout.admin')

@section('content')
<div class="min-h-screen bg-gray-50 flex items-center justify-center px-4 py-8">
    <div class="bg-white shadow-xl rounded-2xl p-8 w-full max-w-lg">
        <div class="mb-6">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-2">Edit Petugas</h1>
            <p class="text-gray-600 text-sm sm:text-base mb-6">Perbarui data petugas admin atau operator helpdesk.</p>
        </div>
        <form action="{{ route('admin.petugas.update',$petugas->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-5">
                <label class="block font-semibold mb-2 text-gray-700">Nama</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-user text-gray-400"></i>
                    </div>
                    <input type="text" name="name" value="{{ $petugas->name }}" class="w-full border border-gray-300 rounded-lg pl-10 pr-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm transition" placeholder="Masukkan nama" required>
                </div>
            </div>
            <div class="mb-5">
                <label class="block font-semibold mb-2 text-gray-700">Email</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-envelope text-gray-400"></i>
                    </div>
                    <input type="email" name="email" value="{{ $petugas->email }}" class="w-full border border-gray-300 rounded-lg pl-10 pr-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm transition" placeholder="Masukkan email" required>
                </div>
            </div>
            <div class="mb-6">
                <label class="block font-semibold mb-2 text-gray-700">Role</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-shield-alt text-gray-400"></i>
                    </div>
                    <select name="role" class="w-full border border-gray-300 rounded-lg pl-10 pr-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm transition appearance-none">
                        <option value="admin" {{ $petugas->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="petugas" {{ $petugas->role == 'petugas' ? 'selected' : '' }}>Petugas</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                        <i class="fas fa-chevron-down text-gray-400"></i>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg shadow-lg transition-all duration-300 transform hover:scale-105 flex items-center gap-2">
                    <i class="fas fa-save"></i>
                    Update
                </button>
                <a href="{{ route('admin.petugas.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg shadow-lg transition-all duration-300 transform hover:scale-105 flex items-center gap-2">
                    <i class="fas fa-times"></i>
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
