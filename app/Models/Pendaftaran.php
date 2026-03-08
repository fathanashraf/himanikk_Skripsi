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
    ];

    // ========== SCOPES ==========
    
    /**
     * Scope untuk filter status
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope untuk filter berdasarkan target
     */
    public function scopeKegiatan($query, $id)
    {
        return $query->where('kegiatan_id', $id);
    }

    public function scopeAcara($query, $id)
    {
        return $query->where('acara_id', $id);
    }

    public function scopeEvents($query, $id)
    {
        return $query->where('event_id', $id);
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
     * Scope pendaftaran dengan bukti
     */
    public function scopeDenganBukti($query)
    {
        return $query->whereNotNull('bukti');
    }

    // ========== ACCESSORS ==========
    
    /**
     * Get target utama (prioritas: kegiatan > acara > event)
     */
    public function getTargetAttribute()
    {
        if ($this->kegiatan_id && $this->kegiatan) return $this->kegiatan;
        if ($this->acara_id && $this->acara) return $this->acara;
        if ($this->event_id && $this->event) return $this->event;
        return null;
    }

    /**
     * Get jenis pendaftaran otomatis
     */
    public function getJenisPendaftaranAttribute(): ?string
    {
        if ($this->kegiatan_id) return 'kegiatan';
        if ($this->acara_id) return 'acara';
        if ($this->event_id) return 'event';
        return null;
    }

    /**
     * Status badge class untuk Tailwind
     */
    protected function statusBadge(): Attribute
    {
        return Attribute::make(
            get: fn () => match($this->status) {
                'diterima' => 'bg-emerald-100 text-emerald-800 border-emerald-200',
                'ditolak' => 'bg-red-100 text-red-800 border-red-200',
                'proses' => 'bg-amber-100 text-amber-800 border-amber-200',
                default => 'bg-slate-100 text-slate-800 border-slate-200'
            }
        );
    }

    /**
     * Jenis badge class untuk Tailwind
     */
    protected function jenisBadge(): Attribute
    {
        return Attribute::make(
            get: fn () => match($this->jenis_pendaftaran) {
                'kegiatan' => 'bg-purple-100 text-purple-800 border-purple-200',
                'acara' => 'bg-orange-100 text-orange-800 border-orange-200',
                'event' => 'bg-blue-100 text-blue-800 border-blue-200',
                default => 'bg-slate-100 text-slate-800 border-slate-200'
            }
        );
    }

    /**
     * Status label untuk display
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
     * Jenis label untuk display
     */
    public function getJenisLabelAttribute(): string
    {
        return match($this->jenis_pendaftaran) {
            'kegiatan' => 'Kegiatan ⚡',
            'acara' => 'Acara 🎉',
            'event' => 'Event 🎪',
            default => 'Lainnya ❓'
        };
    }

    /**
     * Check apakah sudah upload bukti
     */
    public function getHasBuktiAttribute(): bool
    {
        return !empty($this->bukti);
    }

    // ========== RELATIONSHIPS ==========
    
    /**
     * Relasi ke User (nullable)
     */
    public function user(): BelongsTo
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
    public function events(): BelongsTo
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
}
