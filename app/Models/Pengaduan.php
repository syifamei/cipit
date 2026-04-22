<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduans';

    protected $fillable = [
        'nama',
        'email',
        'no_hp',
        'jenis_layanan',
        'judul_pengaduan',
        'isi_pengaduan',
        'lampiran',
        'status',
        'tanggal_pengaduan',
        'catatan_petugas',
        'tanggal_balasan'
    ];

    protected $casts = [
        'tanggal_pengaduan' => 'date',
        'tanggal_balasan' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Get the created_at timestamp in WIB timezone
     */
    public function getCreatedAtWibAttribute()
    {
        return $this->created_at ? $this->created_at->setTimezone('Asia/Jakarta') : null;
    }

    /**
     * Get the updated_at timestamp in WIB timezone
     */
    public function getUpdatedAtWibAttribute()
    {
        return $this->updated_at ? $this->updated_at->setTimezone('Asia/Jakarta') : null;
    }

    /**
     * Get the tanggal_balasan timestamp in WIB timezone
     */
    public function getTanggalBalasanWibAttribute()
    {
        return $this->tanggal_balasan ? $this->tanggal_balasan->setTimezone('Asia/Jakarta') : null;
    }

    /**
     * Format created_at for display in Indonesian format with WIB timezone
     */
    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at_wib ? $this->created_at_wib->format('d M Y H:i') : null;
    }

    /**
     * Format tanggal_balasan for display in Indonesian format with WIB timezone
     */
    public function getFormattedTanggalBalasanAttribute()
    {
        return $this->tanggal_balasan_wib ? $this->tanggal_balasan_wib->format('d M Y H:i') : null;
    }

    /**
     * Boot the model and set timezone for timestamps
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Ensure created_at and updated_at are in WIB when creating
            $now = Carbon::now('Asia/Jakarta');
            $model->created_at = $now;
            $model->updated_at = $now;
        });

        static::updating(function ($model) {
            // Ensure updated_at is in WIB when updating
            $model->updated_at = Carbon::now('Asia/Jakarta');
        });
    }
}
