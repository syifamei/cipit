<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    public function index()
    {
        // Debug: Check if user is logged in
        if (!auth()->check()) {
            \Log::error('User not authenticated!');
            return redirect()->route('user.login');
        }
        
        // Get pengaduan for current logged in user
        $userEmail = auth()->user()->email;
        $pengaduans = Pengaduan::where('email', $userEmail)
                               ->latest()
                               ->get();
        
        // Debug: Log untuk melihat data
        \Log::info('User email: ' . $userEmail);
        \Log::info('Pengaduan count: ' . $pengaduans->count());
        
        return view('user.pengaduan.riwayat', compact('pengaduans'));
    }

    public function create()
    {
        return view('user.pengaduan.create');
    }

    public function show($id)
    {
        $pengaduan = Pengaduan::where('id', $id)
                              ->where('email', auth()->user()->email)
                              ->firstOrFail();
        
        return view('user.pengaduan.show', compact('pengaduan'));
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'nama' => 'required|string|max:255',
                'no_hp' => 'required|string|max:20',
                'jenis_layanan' => 'required|in:pengaduan,konsultasi',
                'judul_pengaduan' => 'required|string|max:255',
                'isi_pengaduan' => 'required|string|min:20',
                'lampiran' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120'
            ]);

            // Set email from logged in user
            $data['email'] = auth()->user()->email;

            // Handle file upload
            if($request->hasFile('lampiran')){
                $file = $request->file('lampiran');
                $filename = time() . '_' . $file->getClientOriginalName();
                $data['lampiran'] = $file->storeAs('lampiran', $filename, 'public');
            }

            // Set additional fields
            $data['status'] = 'baru';
            $data['tanggal_pengaduan'] = now()->format('Y-m-d');

            // Create pengaduan
            $pengaduan = Pengaduan::create($data);
            
            // Debug: Log data yang tersimpan
            \Log::info('Pengaduan created: ' . json_encode($data));
            \Log::info('Pengaduan ID: ' . $pengaduan->id);

            return redirect()->route('pengaduan.index')
                             ->with('success', 'Pengaduan berhasil dikirim! Kami akan segera menindaklanjuti.');
                             
        } catch (\Exception $e) {
            \Log::error('Error creating pengaduan: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }
}   
