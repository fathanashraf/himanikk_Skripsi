<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Masukkan extends Model
{
    use HasFactory;

    protected $table = 'masukkans';

    protected $fillable = [
        'user_id',
        'tipe',
    ];

    protected $casts = [
        'tipe' => 'string',
    ];

    /**
     * Get the user that owns the masukkan.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope for specific tipe
     */
    public function scopeKritik($query)
    {
        return $query->where('tipe', 'kritik');
    }

    public function scopeSaran($query)
    {
        return $query->where('tipe', 'saran');
    }

    public function scopeLike($query)
    {
        return $query->where('tipe', 'like');
    }

    public function scopeDislike($query)
    {
        return $query->where('tipe', 'dislike');
    }

    /**
     * Get tipe label
     */
    public function getTipeLabelAttribute(): string
    {
        return match($this->tipe) {
            'kritik' => 'Kritik',
            'saran' => 'Saran',
            'like' => 'Like 👍',
            'dislike' => 'Dislike 👎',
            default => 'Saran'
        };
    }

    /**
     * Get tipe color class
     */
    public function getTipeColorAttribute(): string
    {
        return match($this->tipe) {
            'kritik' => 'text-red-600 bg-red-100',
            'saran' => 'text-blue-600 bg-blue-100',
            'like' => 'text-emerald-600 bg-emerald-100',
            'dislike' => 'text-amber-600 bg-amber-100',
            default => 'text-blue-600 bg-blue-100'
        };
    }

    // kegiatan relationship
    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }
}
