<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kode Verifikasi OTP - BAPPERIDA</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-bottom: 20px;
        }
        .logo img {
            height: 40px;
        }
        .otp-code {
            background-color: #f0f9ff;
            border: 2px solid #3b82f6;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            font-size: 32px;
            font-weight: bold;
            color: #1e40af;
            letter-spacing: 5px;
            margin: 20px 0;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            color: #6b7280;
            font-size: 14px;
        }
        .warning {
            background-color: #fef3c7;
            border-left: 4px solid #f59e0b;
            padding: 15px;
            margin: 20px 0;
            color: #92400e;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <img src="{{ asset('bapperida.png') }}" alt="BAPPERIDA Logo">
                <img src="{{ asset('logo-kanan.jpg') }}" alt="BAPPERIDA Logo">
            </div>
            <h1 style="color: #1f2937; margin: 0;">Verifikasi Email Anda</h1>
            <p style="color: #6b7280; margin: 10px 0;">Pusat Bantuan BAPPERIDA</p>
        </div>

        <div style="text-align: center; margin: 30px 0;">
            <h2 style="color: #374151;">Kode Verifikasi OTP</h2>
            <p style="color: #6b7280;">Gunakan kode berikut untuk verifikasi email Anda:</p>
        </div>

        <div class="otp-code">
            {{ $otp }}
        </div>

        <div class="warning">
            <strong>⚠️ Penting:</strong> Kode OTP ini akan kadaluarsa dalam 15 menit pada {{ $expiresAt->format('H:i') }} WIB.
            <br>Jangan bagikan kode ini kepada siapapun.
        </div>

        <div style="margin: 30px 0; text-align: center;">
            <p style="color: #6b7280;">
                Jika Anda tidak meminta verifikasi ini, abaikan email ini.
            </p>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} Pusat Bantuan BAPPERIDA. All rights reserved.</p>
            <p style="margin-top: 10px;">
                Badan Pelayanan Perizinan Terpadu dan Penanaman Modal Daerah
            </p>
        </div>
    </div>
</body>
</html>
