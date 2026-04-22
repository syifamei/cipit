# 📬 Fitur Balasan Pengaduan - Dokumentasi Lengkap

## 🎯 **Overview**
Fitur balasan pengaduan memungkinkan admin/petugas untuk memberikan tanggapan atau balasan terhadap pengaduan yang diajukan oleh user/masyarakat. User dapat melihat riwayat lengkap pengaduan beserta balasannya.

## ✅ **Fitur yang Telah Diimplementasikan**

### **1. Backend Features**
- ✅ Database migration untuk kolom `catatan_petugas` dan `tanggal_balasan`
- ✅ Model `Pengaduan` dengan relasi dan casting yang tepat
- ✅ Controller logic untuk admin dan petugas
- ✅ Email notifikasi otomatis saat ada balasan
- ✅ Validation dan error handling

### **2. Frontend Features**
- ✅ Form balasan di halaman edit admin/petugas
- ✅ Detail pengaduan untuk user dengan balasan
- ✅ Riwayat pengaduan user yang lengkap
- ✅ Timeline aktivitas pengaduan
- ✅ Responsive design dengan Tailwind CSS

### **3. Email Features**
- ✅ Mail class `PengaduanBalasanMail`
- ✅ Template email HTML yang menarik
- ✅ Konfigurasi email setup guide
- ✅ Error handling untuk pengiriman email

## 🚀 **Cara Penggunaan**

### **Untuk Admin/Petugas:**
1. **Login** sebagai admin atau petugas
2. **Buka** menu "Pengaduan" di dashboard
3. **Pilih** pengaduan yang ingin dibalas
4. **Klik** tombol "Edit Status"
5. **Isi** field "Catatan Petugas" dengan balasan
6. **Update** status (opsional)
7. **Simpan** - email otomatis dikirim ke user

### **Untuk User/Masyarakat:**
1. **Login** sebagai user
2. **Buka** menu "Riwayat Pengaduan"
3. **Klik** icon mata (👁️) untuk lihat detail
4. **Lihat** balasan di section "Balasan dari Admin/Petugas"
5. **Cek** email untuk notifikasi balasan

## 📧 **Konfigurasi Email**

### **Quick Setup (Gmail):**
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

### **Untuk Development (Mailtrap):**
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your-mailtrap-username
MAIL_PASSWORD=your-mailtrap-password
MAIL_ENCRYPTION=tls
```

**📋 Panduan lengkap ada di file `config/email_setup.md`**

## 🗂️ **Struktur File yang Ditambahkan**

### **Database:**
- `database/migrations/2026_03_31_135500_add_catatan_petugas_to_pengaduans_table.php`

### **Models:**
- `app/Models/Pengaduan.php` (updated)

### **Controllers:**
- `app/Http/Controllers/Admin/PengaduanController.php` (updated)
- `app/Http/Controllers/Petugas/PengaduanController.php` (updated)
- `app/Http/Controllers/User/PengaduanController.php` (updated)

### **Mail:**
- `app/Mail/PengaduanBalasanMail.php`
- `resources/views/emails/pengaduan_balasan.blade.php`

### **Views:**
- `resources/views/user/pengaduan/show.blade.php` (baru)
- `resources/views/user/pengaduan/riwayat.blade.php` (updated)
- `resources/views/admin/pengaduan/show.blade.php` (updated)
- `resources/views/admin/pengaduan/edit.blade.php` (existing)
- `resources/views/petugas/pengaduan/edit.blade.php` (existing)

### **Routes:**
- `routes/web.php` (updated)

## 🔄 **Flow Proses Balasan**

```
User Ajukan Pengaduan 
    ↓
Admin/Petugas Review
    ↓
Admin/Petugas Balas (via form edit)
    ↓
System Simpan Balasan + Timestamp
    ↓
System Kirim Email Notifikasi
    ↓
User Lihat Balasan (web + email)
```

## 🎨 **UI/UX Features**

### **Admin/Petugas Interface:**
- Form balasan yang intuitif
- Status badge yang jelas
- Timeline aktivitas
- Preview pengaduan lengkap

### **User Interface:**
- Riwayat pengaduan terorganisir
- Detail view dengan balasan
- Status tracking real-time
- Responsive design

### **Email Template:**
- Design modern dan profesional
- Informasi lengkap
- Call-to-action button
- Mobile-friendly

## 🛠️ **Testing & Troubleshooting**

### **Test Email:**
```bash
# Tambahkan route testing sementara
Route::get('/test-email', function() {
    $pengaduan = \App\Models\Pengaduan::first();
    \Illuminate\Support\Facades\Mail::to('test@example.com')
        ->send(new \App\Mail\PengaduanBalasanMail($pengaduan, 'Test balasan'));
    return 'Email sent!';
});
```

### **Common Issues:**
1. **Email tidak terkirim**: Cek konfigurasi SMTP
2. **Migration gagal**: Pastikan database connected
3. **View error**: Clear cache dengan `php artisan view:clear`

## 📊 **Database Schema**

```sql
-- Kolom baru di tabel pengaduans
ALTER TABLE pengaduans ADD COLUMN catatan_petugas TEXT NULL;
ALTER TABLE pengaduans ADD COLUMN tanggal_balasan TIMESTAMP NULL;
```

## 🔔 **Notifikasi System**

### **Email Trigger:**
- ✅ Saat admin/petugas mengisi catatan_petugas
- ✅ Otomatis set timestamp
- ✅ Error handling jika gagal kirim

### **Future Enhancements:**
- 🔄 Push notification browser
- 📱 SMS notifikasi
- 🔔 In-app notification center

## 🎯 **Best Practices**

### **Untuk Admin/Petugas:**
- Berikan balasan yang jelas dan informatif
- Update status secara konsisten
- Gunakan bahasa yang profesional

### **Untuk User:**
- Periksa email secara berkala
- Lihat riwayat pengaduan untuk update
- Hubungi admin jika perlu klarifikasi

---

## 🎉 **Fitur Siap Digunakan!**

Semua komponen telah diimplementasikan dan siap untuk production. Pastikan konfigurasi email sudah diatur dengan benar untuk notifikasi otomatis.
