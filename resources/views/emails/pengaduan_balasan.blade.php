<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balasan Pengaduan</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .content {
            background: #fff;
            padding: 30px;
            border: 1px solid #e5e7eb;
            border-top: none;
        }
        .pengaduan-info {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #667eea;
        }
        .balasan-info {
            background: #e8f5e8;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #28a745;
        }
        .footer {
            background: #f8f9fa;
            padding: 20px;
            text-align: center;
            border: 1px solid #e5e7eb;
            border-top: none;
            border-radius: 0 0 10px 10px;
            font-size: 12px;
            color: #6c757d;
        }
        .btn {
            display: inline-block;
            padding: 12px 24px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            margin: 20px 0;
            transition: background 0.3s;
        }
        .btn:hover {
            background: #5a6fd8;
        }
        .label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 5px;
        }
        .value {
            color: #212529;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>📬 Balasan Pengaduan Anda</h1>
        <p>Pengaduan Anda telah ditinjau dan dibalas oleh tim kami</p>
    </div>

    <div class="content">
        <p>Halo <strong>{{ $pengaduan->nama }}</strong>,</p>
        <p>Terima kasih telah mengajukan pengaduan kepada kami. Pengaduan Anda dengan judul <strong>"{{ $pengaduan->judul_pengaduan }}"</strong> telah kami tinjau dan berikut adalah balasan dari tim kami:</p>

        <!-- Informasi Pengaduan -->
        <div class="pengaduan-info">
            <h3>📋 Informasi Pengaduan</h3>
            <div class="label">Judul Pengaduan:</div>
            <div class="value">{{ $pengaduan->judul_pengaduan }}</div>
            
            <div class="label">Jenis Layanan:</div>
            <div class="value">{{ ucfirst($pengaduan->jenis_layanan) }}</div>
            
            <div class="label">Tanggal Pengaduan:</div>
            <div class="value">{{ \Carbon\Carbon::parse($pengaduan->tanggal_pengaduan)->format('d F Y H:i') }}</div>
            
            <div class="label">Status Saat Ini:</div>
            <div class="value">
                <span style="background: #28a745; color: white; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600;">
                    {{ ucfirst($pengaduan->status) }}
                </span>
            </div>
        </div>

        <!-- Balasan Petugas -->
        <div class="balasan-info">
            <h3>💬 Balasan dari Admin/Petugas</h3>
            <p style="white-space: pre-wrap; margin: 10px 0;">{{ $catatanPetugas }}</p>
            
            @if($pengaduan->tanggal_balasan)
            <p style="font-size: 12px; color: #6c757d; margin-top: 15px;">
                <i>Dibalas pada: {{ \Carbon\Carbon::parse($pengaduan->tanggal_balasan)->format('d F Y H:i') }}</i>
            </p>
            @endif
        </div>

        <!-- Call to Action -->
        <div style="text-align: center;">
            <a href="{{ url('/pengaduan/' . $pengaduan->id) }}" class="btn">
                Lihat Detail Pengaduan
            </a>
        </div>

        <p>Jika Anda memiliki pertanyaan lebih lanjut, jangan ragu untuk menghubungi kami kembali.</p>
    </div>

    <div class="footer">
        <p>© {{ date('Y') }} Sistem Pengaduan - BAPPERIDA Kota Bogor</p>
        <p>Email ini dikirimkan secara otomatis. Mohon tidak membalas email ini.</p>
    </div>
</body>
</html>
