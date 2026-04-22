<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;

class DashboardController extends Controller
{
    public function index()
    {
        $total = Pengaduan::count();
        $baru = Pengaduan::where('status','baru')->count();
        $diproses = Pengaduan::where('status','diproses')->count();
        $selesai = Pengaduan::where('status','selesai')->count();
        $ditolak = Pengaduan::where('status','ditolak')->count();

        // Get recent activities
        $recentActivities = Pengaduan::orderBy('tanggal_pengaduan', 'desc')
            ->take(5)
            ->get(['id', 'nama', 'status', 'tanggal_pengaduan']);

        return view('admin.dashboard', compact(
            'total',
            'baru',
            'diproses',
            'selesai',
            'ditolak',
            'recentActivities'
        ));
    }
}
