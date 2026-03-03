<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Pendaftaran extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'pendaftarans';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'status',
        'image',
        'link',
        'bukti',
        'keterangan',
        'user_id',
        'kegiatan_id',
        'event_id',
        'acara_id',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'status' => 'string',
        'jenis_pendaftaran' => 'string',
    ];

    /**
     * Scope untuk filter status
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope untuk filter jenis pendaftaran
     */
    public function scopeJenisPendaftaran($query, $jenis)
    {
        return $query->where('jenis_pendaftaran', $jenis);
    }

    /**
     * Scope untuk search
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('name', 'LIKE', "%{$search}%")
              ->orWhere('email', 'LIKE', "%{$search}%")
              ->orWhere('phone', 'LIKE', "%{$search}%");
        });
    }

    /**
     * Accessor untuk status badge color
     */
    protected function statusBadge(): Attribute
    {
        return Attribute::make(
            get: fn () => match($this->status) {
                'diterima' => 'bg-emerald-100 text-emerald-800',
                'ditolak' => 'bg-red-100 text-red-800',
                'proses' => 'bg-yellow-100 text-yellow-800',
                default => 'bg-slate-100 text-slate-800'
            }
        );
    }

    /**
     * Accessor untuk jenis badge color
     */
    protected function jenisBadge(): Attribute
    {
        return Attribute::make(
            get: fn () => match($this->jenis_pendaftaran) {
                'acara' => 'bg-orange-100 text-orange-800',
                'kegiatan' => 'bg-purple-100 text-purple-800',
                'event' => 'bg-blue-100 text-blue-800',
                'dll' => 'bg-gray-100 text-gray-800',
                default => 'bg-slate-100 text-slate-800'
            }
        );
    }

    // ========== RELATIONSHIPS ==========

    /**
     * Relasi ke User (nullable)
     */
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Kegiatan (nullable)
     */
    public function kegiatan(): BelongsTo
    {
        return $this->belongsTo(Kegiatan::class);
    }

    /**
     * Relasi ke Event (nullable)
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Relasi ke Acara (nullable)
     */
    public function acara(): BelongsTo
    {
        return $this->belongsTo(Acara::class);
    }

    /**
     * Get primary reference (satu referensi utama)
     */
    public function getPrimaryReferenceAttribute()
    {
        if ($this->acara) return $this->acara;
        if ($this->event) return $this->event;
        if ($this->kegiatan) return $this->kegiatan;
        return null;
    }

    /**
     * Check apakah sudah upload bukti
     */
    public function getHasBuktiAttribute(): bool
    {
        return !empty($this->bukti);
    }

    /**
     * Get status label untuk display
     */
    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'diterima' => 'Diterima ✅',
            'ditolak' => 'Ditolak ❌',
            'proses' => 'Diproses ⏳',
            default => 'Proses'
        };
    }

    /**
     * Get jenis label untuk display
     */
    public function getJenisLabelAttribute(): string
    {
        return match($this->jenis_pendaftaran) {
            'acara' => 'Acara 🎉',
            'kegiatan' => 'Kegiatan ⚡',
            'event' => 'Event 🎪',
            default => 'Lainnya'
        };
    }

    /**
     * Scope untuk pendaftaran dengan bukti
     */
    public function scopeDenganBukti($query)
    {
        return $query->whereNotNull('bukti');
    }

    /**
     * Scope untuk pendaftaran tanpa bukti
     */
    public function scopeTanpaBukti($query)
    {
        return $query->whereNull('bukti');
    }
}
