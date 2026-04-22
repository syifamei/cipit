<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pengaduan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            color: #333;
            font-size: 24px;
        }
        .header p {
            margin: 5px 0 0 0;
            color: #666;
            font-size: 14px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .table th {
            background-color: #f5f5f5;
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            font-weight: bold;
            font-size: 11px;
        }
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            font-size: 10px;
        }
        .table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .status-badge {
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .status-baru { background-color: #e3f2fd; color: #1976d2; }
        .status-menunggu { background-color: #fff3cd; color: #856404; }
        .status-diproses { background-color: #fed7aa; color: #92400e; }
        .status-selesai { background-color: #d1fae5; color: #065f46; }
        .status-ditolak { background-color: #fee2e2; color: #991b1b; }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #666;
        }
        .text-wrap {
            max-width: 200px;
            word-wrap: break-word;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN PENGADUAN</h1>
        <p>BAPPERIDA - Badan Penelitian, Pengembangan dan Penerapan Teknologi Informasi</p>
        <p>Tanggal Cetak: {{ $date }}</p>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>No. Telepon</th>
                <th>Layanan</th>
                <th>Subjek</th>
                <th>Isi Pengaduan</th>
                <th>Status</th>
                <th>Tanggal Dibuat</th>
                <th>Tanggal Diperbarui</th>
                <th>Catatan Petugas</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengaduans as $pengaduan)
            <tr>
                <td>{{ $pengaduan->id }}</td>
                <td>{{ $pengaduan->nama }}</td>
                <td>{{ $pengaduan->email }}</td>
                <td>{{ $pengaduan->no_hp ?? '-' }}</td>
                <td>{{ ucfirst($pengaduan->jenis_layanan) }}</td>
                <td>{{ $pengaduan->subjek }}</td>
                <td class="text-wrap">{{ Str::limit(strip_tags($pengaduan->isi), 100) }}</td>
                <td>
                    <span class="status-badge status-{{ strtolower($pengaduan->status) }}">
                        {{ ucfirst($pengaduan->status) }}
                    </span>
                </td>
                <td>{{ \Carbon\Carbon::parse($pengaduan->created_at)->format('d/m/Y H:i') }}</td>
                <td>{{ $pengaduan->updated_at ? \Carbon\Carbon::parse($pengaduan->updated_at)->format('d/m/Y H:i') : '-' }}</td>
                <td>{{ $pengaduan->catatan_petugas ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Halaman ini dicetak secara otomatis dari sistem pengaduan BAPPERIDA</p>
        <p>Total Data: {{ $pengaduans->count() }} pengaduan</p>
    </div>
</body>
</html>
