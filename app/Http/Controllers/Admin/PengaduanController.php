<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use App\Mail\PengaduanBalasanMail;
use Illuminate\Support\Facades\Mail;

class PengaduanController extends Controller
{

    // =============================
    // HALAMAN DATA PENGADUAN
    // =============================
    public function index(Request $request)
    {
        $query = Pengaduan::query();

        // FILTER JENIS LAYANAN
        if ($request->jenis_layanan) {
            $query->where('jenis_layanan', $request->jenis_layanan);
        }

        // SEARCH
        if ($request->search) {
            $query->where(function($q) use ($request){
                $q->where('nama','like','%'.$request->search.'%')
                  ->orWhere('judul_pengaduan','like','%'.$request->search.'%')
                  ->orWhere('isi_pengaduan','like','%'.$request->search.'%')
                  ->orWhere('status','like','%'.$request->search.'%')
                  ->orWhere('jenis_layanan','like','%'.$request->search.'%');
            });
        }

        $pengaduans = $query->latest()->paginate(10);

        // STATISTIK
        $total = Pengaduan::count();
$baru = Pengaduan::where('status','baru')->count();
$diproses = Pengaduan::where('status','diproses')->count();
$selesai = Pengaduan::where('status','selesai')->count();
$ditolak = Pengaduan::where('status','ditolak')->count();

        return view('admin.pengaduan.index', compact(
            'pengaduans',
            'total',
            'baru',
            'diproses',
            'selesai',
            'ditolak'
        ));
    }

    // =============================
    // DETAIL PENGADUAN
    // =============================
    public function show($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        return view('admin.pengaduan.show', compact('pengaduan'));
    }

    // =============================
    // EDIT STATUS
    // =============================
    public function edit($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        return view('admin.pengaduan.edit', compact('pengaduan'));
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

        return redirect()->route('admin.pengaduan.index')
            ->with('success','Status dan catatan berhasil diupdate' . ($request->catatan_petugas ? ' dan notifikasi email telah dikirim' : ''));
    }

    // =============================
    // HAPUS PENGADUAN
    // =============================
    public function destroy($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        $pengaduan->delete();

        return redirect()->route('admin.pengaduan.index')
            ->with('success','Pengaduan berhasil dihapus');
    }

    // =============================
    // EXPORT EXCEL TANPA PACKAGE
    // =============================
    public function exportExcel()
    {
        $pengaduan = Pengaduan::all();

        $filename = "data_pengaduan.xls";

        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=$filename");

        echo "<table border='1'>";
        echo "<tr>
                <th>No</th>
                <th>Nama</th>
                <th>Jenis Layanan</th>
                <th>Judul</th>
                <th>Isi Pengaduan</th>
                <th>Status</th>
              </tr>";

        foreach ($pengaduan as $index => $p) {
            echo "<tr>
                    <td>".($index+1)."</td>
                    <td>".$p->nama."</td>
                    <td>".$p->jenis_layanan."</td>
                    <td>".$p->judul_pengaduan."</td>
                    <td>".$p->isi_pengaduan."</td>
                    <td>".$p->status."</td>
                  </tr>";
        }

        echo "</table>";
    }

    // ======================================
    // EXPORT DATA PENGADUAN KE PDF
    // ======================================

public function exportPDF()
{
    $pengaduan = \App\Models\Pengaduan::all();

    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView(
        'admin.pengaduan.pdf',
        compact('pengaduan')
    )->setOptions(['isRemoteEnabled' => true]);

    return $pdf->download('data_pengaduan.pdf');
}
}
