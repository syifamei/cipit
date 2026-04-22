# Email Configuration Setup

## Konfigurasi Email untuk Notifikasi Pengaduan

Untuk mengaktifkan fitur notifikasi email otomatis saat admin/petugas membalas pengaduan, ikuti langkah-langkah berikut:

### 1. Update File .env

Edit file `.env` di root project dan tambahkan konfigurasi email sesuai provider yang Anda gunakan:

#### Untuk Gmail (SMTP):
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="BAPPERIDA Kota Bogor"
```

#### Untuk Mailtrap (Development):
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your-mailtrap-username
MAIL_PASSWORD=your-mailtrap-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@bapperida-bogor.go.id"
MAIL_FROM_NAME="BAPPERIDA Kota Bogor"
```

### 2. Generate App Key (jika belum)
```bash
php artisan key:generate
```

### 3. Clear Cache
```bash
php artisan config:cache
php artisan cache:clear
```

### 4. Testing Email
Untuk testing email, Anda bisa menggunakan route sementara:

```php
// Tambahkan di routes/web.php untuk testing
Route::get('/test-email', function() {
    $pengaduan = \App\Models\Pengaduan::first();
    $mail = new \App\Mail\PengaduanBalasanMail($pengaduan, 'Test balasan pengaduan');
    
    try {
        \Illuminate\Support\Facades\Mail::to('test@example.com')->send($mail);
        return 'Email berhasil dikirim!';
    } catch (\Exception $e) {
        return 'Gagal mengirim email: ' . $e->getMessage();
    }
});
```

### 5. Penting untuk Gmail

Jika menggunakan Gmail, pastikan:
1. Enable 2-Factor Authentication
2. Generate App Password (bukan password biasa)
3. Go to: Google Account → Security → App Passwords
4. Generate new app password untuk "Mail"

### 6. Production Notes

Untuk production environment, disarankan menggunakan:
- SendGrid
- Mailgun  
- Amazon SES
- Atau SMTP server yang terpercaya

### 7. Troubleshooting

Jika email tidak terkirim:
1. Cek log Laravel: `storage/logs/laravel.log`
2. Pastikan konfigurasi SMTP benar
3. Cek firewall/blocking port
4. Verify email credentials
