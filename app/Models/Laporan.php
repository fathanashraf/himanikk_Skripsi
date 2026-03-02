<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'laporans';

    protected $fillable = [
        'nama',
        'tipe',
        'file',
        'status', // ✅ NEW FIELD
    ];

    protected $casts = [
        'tipe' => 'string',
        'status' => 'string',
    ];

    /**
     * Get tipe label
     */
    protected function tipeLabel(): Attribute
    {
        return Attribute::make(
            get: fn () => match($this->tipe) {
                'proposal' => 'Proposal',
                'lpj' => 'LPJ',
                default => ucfirst($this->tipe)
            }
        );
    }

    /**
     * Get status label & color
     */
    protected function statusLabel(): Attribute
    {
        return Attribute::make(
            get: fn () => match($this->status) {
                'pending' => 'Menunggu',
                'approved' => 'Disetujui',
                'rejected' => 'Ditolak',
                default => 'Menunggu'
            }
        );
    }

    protected function statusColor(): Attribute
    {
        return Attribute::make(
            get: fn () => match($this->status) {
                'pending' => 'bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-200 border-yellow-200 dark:border-yellow-800',
                'approved' => 'bg-emerald-100 dark:bg-emerald-900/30 text-emerald-800 dark:text-emerald-200 border-emerald-200 dark:border-emerald-800',
                'rejected' => 'bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-200 border-red-200 dark:border-red-800',
                default => 'bg-gray-100 dark:bg-gray-900/30 text-gray-800 dark:text-gray-200 border-gray-200 dark:border-gray-800'
            }
        );
    }

    /**
     * Get file URL
     */
    protected function fileUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->file 
                ? asset('storage/' . $this->file) 
                : '#'
        );
    }

    /**
     * Scopes
     */
    public function scopeTipe($query, $tipe): static
    {
        return $tipe ? $query->where('tipe', $tipe) : $query;
    }

    public function scopeStatus($query, $status): static
    {
        return $status ? $query->where('status', $status) : $query;
    }

    public function scopeSearch($query, $search): static
    {
        if (!$search) return $query;
        return $query->where('nama', 'like', "%{$search}%");
    }
}
