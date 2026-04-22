@extends('layout.admin')

@section('content')
<div class="min-h-screen bg-gray-50 px-4 py-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header Card -->
        <div class="bg-white shadow-xl rounded-2xl flex flex-col sm:flex-row sm:items-center sm:justify-between px-4 sm:px-6 py-4 sm:py-6 mb-8">
            <div>
                <h2 class="text-xl sm:text-2xl sm:text-3xl font-bold text-gray-800 mb-2">Manajemen Petugas</h2>
                <p class="text-sm sm:text-base text-gray-600">Kelola data petugas sistem pengaduan</p>
            </div>
            <a href="{{ route('admin.petugas.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-3 sm:px-4 sm:px-6 py-2 sm:py-3 rounded-xl shadow-lg transition-all duration-300 transform hover:scale-105 flex items-center gap-2 text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span class="hidden sm:inline">Tambah Petugas</span>
                <span class="sm:hidden">Tambah</span>
            </a>
        </div>
        
        <!-- Card Tabel -->
        <div class="bg-white shadow-xl rounded-2xl p-3 sm:p-4 sm:p-8">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="py-3 sm:py-4 px-3 sm:px-6 text-left font-bold text-gray-800">No</th>
                            <th class="py-3 sm:py-4 px-3 sm:px-6 text-left font-bold text-gray-800">
                                <span class="hidden sm:inline">Nama</span>
                                <span class="sm:hidden">Info</span>
                            </th>
                            <th class="hidden sm:table-cell py-3 sm:py-4 px-3 sm:px-6 text-left font-bold text-gray-800">Email</th>
                            <th class="py-3 sm:py-4 px-3 sm:px-6 text-left font-bold text-gray-800">Role</th>
                            <th class="py-3 sm:py-4 px-3 sm:px-6 text-center font-bold text-gray-800">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($petugas as $p)
                        <tr class="hover:bg-gray-50 transition-all duration-200">
                            <td class="py-3 sm:py-4 px-3 sm:px-6 font-medium text-gray-900">{{ $loop->iteration }}</td>
                            <td class="py-3 sm:py-4 px-3 sm:px-6">
                                <div class="flex items-center space-x-2">
                                    <div class="w-6 h-6 sm:w-8 sm:h-8 bg-gray-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-user text-gray-600 text-xs"></i>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <span class="font-medium text-gray-900 block truncate">{{ $p->name }}</span>
                                        <span class="text-xs text-gray-500 sm:hidden block truncate">{{ $p->email }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="hidden sm:table-cell py-3 sm:py-4 px-3 sm:px-6">
                                <div class="flex items-center space-x-2">
                                    <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-envelope text-gray-600 text-xs"></i>
                                    </div>
                                    <span class="text-gray-900 truncate">{{ $p->email }}</span>
                                </div>
                            </td>
                            <td class="py-3 sm:py-4 px-3 sm:px-6">
                                @if(strtolower($p->role) == 'admin')
                                    <span class="inline-flex items-center px-2 sm:px-3 py-1 rounded-full text-xs font-bold bg-blue-600 text-white">
                                        <i class="fas fa-crown mr-1"></i> Admin
                                    </span>
                                @elseif(strtolower($p->role) == 'petugas')
                                    <span class="inline-flex items-center px-2 sm:px-3 py-1 rounded-full text-xs font-bold bg-green-600 text-white">
                                        <i class="fas fa-user-check mr-1"></i> Petugas
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 sm:px-3 py-1 rounded-full text-xs font-bold bg-gray-600 text-white">
                                        <i class="fas fa-user mr-1"></i> {{ $p->role }}
                                    </span>
                                @endif
                            </td>
                            <td class="py-3 sm:py-4 px-3 sm:px-6">
                                <div class="flex justify-center items-center space-x-1 sm:space-x-2">
                                    <a href="{{ route('admin.petugas.edit',$p->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white rounded-full p-1.5 sm:p-2 shadow-md transition-all duration-300 transform hover:scale-110" title="Edit">
                                        <!-- Edit Icon -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 sm:h-4 sm:w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4h2M6 7h12M6 17h12M6 7v10M18 7v10" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 11l6.293-6.293a1 1 0 011.414 0l2.586 2.586a1 1 0 010 1.414L13 15l-4 1 1-4z" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.petugas.destroy',$p->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="bg-red-500 hover:bg-red-600 text-white rounded-full p-1.5 sm:p-2 shadow-md transition-all duration-300 transform hover:scale-110" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus petugas ini?')">
                                            <!-- Trash Icon -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 sm:h-4 sm:w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M1 7h22M10 4h4m-4 0a1 1 0 00-1 1v1h6V5a1 1 0 00-1-1m-4 0h4" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
