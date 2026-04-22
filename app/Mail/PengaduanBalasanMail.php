<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PengaduanBalasanMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pengaduan;
    public $catatanPetugas;

    public function __construct($pengaduan, $catatanPetugas)
    {
        $this->pengaduan = $pengaduan;
        $this->catatanPetugas = $catatanPetugas;
    }

    public function envelope()
    {
        return new Envelope(
            subject: 'Balasan Pengaduan - ' . $this->pengaduan->judul_pengaduan,
        );
    }

    public function content()
    {
        return new Content(
            view: 'emails.pengaduan_balasan',
            with: [
                'pengaduan' => $this->pengaduan,
                'catatanPetugas' => $this->catatanPetugas,
            ]
        );
    }

    public function attachments()
    {
        return [];
    }
}
