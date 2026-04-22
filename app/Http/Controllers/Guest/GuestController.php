<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengaduan;

class GuestController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DASHBOARD GUEST
    |--------------------------------------------------------------------------
    | Menampilkan halaman utama (landing page)
    */
    public function dashboard()
    {
        return view('guest.dashboard');
    }


    /*
    |--------------------------------------------------------------------------
    | FORM BUAT PENGADUAN
    |--------------------------------------------------------------------------
    | Menampilkan form input pengaduan untuk guest
    */
    public function create()
    {
        return view('guest.create');
    }


    /*
    |--------------------------------------------------------------------------
    | SIMPAN DATA PENGADUAN
    |--------------------------------------------------------------------------
    | Menyimpan data pengaduan dari guest ke database
    */
    public function store(Request $request)
    {
        // =========================
        // VALIDASI INPUT
        // =========================
        $request->validate([
            'nama'              => 'required|string|max:255',
            'email'             => 'required|email',
            'no_hp'             => 'required',
            'jenis_layanan'     => 'required|in:pengaduan,konsultasi',
            'judul_pengaduan'   => 'required|string|max:255',
            'isi_pengaduan'     => 'required',
            'lampiran'          => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // =========================
        // HANDLE UPLOAD FILE
        // =========================
        $fileName = null;

        if ($request->hasFile('lampiran')) {
            $fileName = time() . '.' . $request->lampiran->extension();
            $request->lampiran->move(public_path('uploads'), $fileName);
        }

        // =========================
        // SIMPAN KE DATABASE
        // =========================
        Pengaduan::create([
            'nama'              => $request->nama,
            'email'             => $request->email,
            'no_hp'             => $request->no_hp,
            'jenis_layanan'     => $request->jenis_layanan,
            'judul_pengaduan'   => $request->judul_pengaduan,
            'isi_pengaduan'     => $request->isi_pengaduan,
            'lampiran'          => $fileName,
            'status'            => 'baru',
            'tanggal_pengaduan' => now(),
        ]);

        // =========================
        // REDIRECT + NOTIF
        // =========================
        return redirect()->route('home')
            ->with('success', 'Pengaduan berhasil dikirim!');
    }
}
