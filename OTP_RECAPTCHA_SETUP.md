# 📋 Panduan Setup OTP dan reCAPTCHA

## 🔐 Fitur OTP untuk Registrasi

### Cara Kerja:
1. User register → OTP dikirim ke email
2. User input OTP → Email diverifikasi
3. Auto login setelah verifikasi
4. OTP berlaku 15 menit

### Setup Email:
```bash
# Edit .env file
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@bapperida.go.id
MAIL_FROM_NAME="BAPPERIDA"
```

## 🛡️ reCAPTCHA Setup

### 1. Dapatkan reCAPTCHA Keys:
1. Kunjungi: https://www.google.com/recaptcha/admin/create
2. Pilih "reCAPTCHA v2" → "I'm not a robot" Checkbox
3. Domain: localhost (untuk development) / domain-produksi.com
4. Copy Site Key dan Secret Key

### 2. Konfigurasi .env:
```env
RECAPTCHA_SITE_KEY=6LeIxAcTAAAAAJcZVRqyHh71UMIEbQfJYpqbDJbJ
RECAPTCHA_SECRET_KEY=6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe
```

### 3. Test reCAPTCHA:
- Test Site Key: `6LeIxAcTAAAAAJcZVRqyHh71UMIEbQfJYpqbDJbJ`
- Test Secret Key: `6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe`

## 📁 File yang Ditambahkan:

### Backend:
- `app/Services/OTPService.php` - Logic OTP generation & verification
- `app/Mail/OTPMail.php` - Email template untuk OTP
- `app/Rules/RecaptchaRule.php` - Custom validation rule untuk reCAPTCHA
- `database/migrations/add_otp_fields_to_users_table.php` - Migration untuk OTP fields

### Frontend:
- `resources/views/emails/otp.blade.php` - Email template HTML
- `resources/views/user/auth/otp-verify.blade.php` - OTP verification form

### Updated Files:
- `app/Models/User.php` - Tambah OTP fields
- `app/Http/Controllers/User/AuthController.php` - Logic OTP & reCAPTCHA
- `app/Http/Controllers/User/PengaduanController.php` - Tambah reCAPTCHA validation
- `resources/views/user/auth/login.blade.php` - Tambah reCAPTCHA
- `resources/views/user/auth/register.blade.php` - Tambah reCAPTCHA
- `resources/views/user/pengaduan/create.blade.php` - Tambah reCAPTCHA
- `config/services.php` - reCAPTCHA configuration
- `app/Providers/AppServiceProvider.php` - reCAPTCHA validation extension
- `routes/web.php` - OTP verification routes

## 🚀 Cara Testing:

### 1. Test OTP:
1. Register user baru
2. Check email (atau log untuk testing)
3. Input OTP yang diterima
4. Verifikasi berhasil → Auto login

### 2. Test reCAPTCHA:
1. Buka form login/register/pengaduan
2. Checkbox reCAPTCHA muncul
3. Submit tanpa checklist → Validasi gagal
4. Submit dengan checklist → Validasi berhasil

## 🔧 Troubleshooting:

### Email tidak terkirim:
- Check konfigurasi .env
- Pastikan Gmail App Password aktif
- Check log: `php artisan log:clear` lalu coba lagi

### reCAPTCHA tidak muncul:
- Check Site Key di .env
- Pastikan domain terdaftar di Google reCAPTCHA
- Check console error di browser

### OTP tidak valid:
- Check OTP expiration (15 menit)
- Pastikan OTP tidak terpotong di email
- Check database untuk OTP values

## 📝 Notes:
- OTP berlaku 15 menit
- reCAPTCHA menggunakan v2 Checkbox
- Email verification required untuk login
- Auto login setelah email verified
- All forms protected dengan reCAPTCHA
