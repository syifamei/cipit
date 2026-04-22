<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Mail\PengaduanBalasanMail;
use Illuminate\Support\Facades\Mail;

class PengaduanController extends Controller
{

   public function dashboard()
    {
        $total = Pengaduan::count();
        
        $baru = Pengaduan::where('status','baru')->count();
        $menunggu = Pengaduan::where('status','menunggu')->count();
        $selesai = Pengaduan::where('status','selesai')->count();
        $diproses = Pengaduan::where('status','diproses')->count();
        $ditolak = Pengaduan::where('status','ditolak')->count();

        return view('petugas.dashboard', compact(
            'total',
            'baru',
            'menunggu',
            'selesai',
            'diproses',
            'ditolak'
        ));
    }


    public function index()
    {
        $pengaduans = Pengaduan::latest()->get();

        return view('petugas.pengaduan.index', compact('pengaduans'));
    }


    public function show($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        return view('petugas.pengaduan.show', compact('pengaduan'));
    }


    public function edit($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        return view('petugas.pengaduan.edit', compact('pengaduan'));
    }


    public function update(Request $request, $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        $updateData = [
            'status' => $request->status
        ];

        // Jika ada catatan petugas, simpan dan set tanggal balasan
        if ($request->catatan_petugas) {
            $updateData['catatan_petugas'] = $request->catatan_petugas;
            $updateData['tanggal_balasan'] = now();

            // Kirim email notifikasi ke user
            try {
                Mail::to($pengaduan->email)->send(new PengaduanBalasanMail($pengaduan, $request->catatan_petugas));
            } catch (\Exception $e) {
                \Log::error('Gagal mengirim email: ' . $e->getMessage());
            }
        }

        $pengaduan->update($updateData);

        return redirect()->route('petugas.pengaduan.index')
                         ->with('success','Status dan catatan pengaduan berhasil diupdate' . ($request->catatan_petugas ? ' dan notifikasi email telah dikirim' : ''));
    }

    // Export Excel
    public function exportExcel()
    {
        $pengaduans = Pengaduan::latest()->get();
        
        $data = $pengaduans->map(function($pengaduan) {
            return [
                'ID' => $pengaduan->id,
                'Nama' => $pengaduan->nama,
                'No. HP' => $pengaduan->no_hp ?? '-',
                'Jenis Layanan' => ucfirst($pengaduan->jenis_layanan),
                'Judul Pengaduan' => $pengaduan->judul_pengaduan,
                'Isi Pengaduan' => strip_tags($pengaduan->isi_pengaduan),
                'Status' => ucfirst($pengaduan->status),
                'Tanggal Dibuat' => \Carbon\Carbon::parse($pengaduan->created_at)->format('d/m/Y H:i'),
                'Tanggal Diperbarui' => $pengaduan->updated_at ? \Carbon\Carbon::parse($pengaduan->updated_at)->format('d/m/Y H:i') : '-',
            ];
        });

        $filename = 'Laporan_Pengaduan_' . date('Y-m-d_H-i-s') . '.xlsx';
        
        return Excel::download(new class($data) implements \Maatwebsite\Excel\Concerns\FromCollection, \Maatwebsite\Excel\Concerns\WithHeadings {
            public function __construct($data)
            {
                $this->data = $data;
            }

            public function collection()
            {
                return $this->data;
            }

            public function headings(): array
            {
                return [
                    'ID',
                    'Nama',
                    'No. HP',
                    'Jenis Layanan',
                    'Judul Pengaduan',
                    'Isi Pengaduan',
                    'Status',
                    'Tanggal Dibuat',
                    'Tanggal Diperbarui'
                ];
            }
        }, $filename);
    }

    // Export PDF
    public function exportPDF()
    {
        $pengaduans = Pengaduan::latest()->get();
        
        $data = [
            'title' => 'Laporan Pengaduan',
            'date' => date('d F Y H:i:s'),
            'pengaduans' => $pengaduans
        ];

        $pdf = Pdf::loadView('petugas.pengaduan.pdf', $data)
                 ->setPaper('a4', 'landscape')
                 ->setOption('defaultFont', 'sans-serif');

        $filename = 'Laporan_Pengaduan_' . date('Y-m-d_H-i-s') . '.pdf';
        
        return $pdf->download($filename);
    }

}
