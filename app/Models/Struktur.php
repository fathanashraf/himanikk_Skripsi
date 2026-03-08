<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Struktur extends Model
{
    use HasFactory;

    protected $table = 'strukturs';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'jabatan',
        'avatar',
        'posisi',
        'departemen',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'jabatan' => 'string',
        'posisi' => 'string',
        'departemen' => 'string',
    ];

    /**
     * Get the user that owns the struktur.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope untuk filter jabatan
     */
    public function scopeJabatan($query, $jabatan): static
    {
        return $jabatan ? $query->where('jabatan', $jabatan) : $query;
    }

    /**
     * Scope untuk filter departemen
     */
    public function scopeDepartemen($query, $departemen): static
    {
        return $departemen ? $query->where('departemen', $departemen) : $query;
    }

    /**
     * Scope untuk search nama user dan email
     */
    public function scopeSearch($query, $search): static
    {
        if (!$search) {
            return $query;
        }

        return $query->whereHas('user', function ($q) use ($search) {
            $q->where(function ($subQuery) use ($search) {
                $subQuery->where('name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%");
            });
        });
    }

    /**
     * Get jabatan label
     */
    protected function jabatanLabel(): Attribute
    {
        return Attribute::make(
            get: fn () => match($this->jabatan) {
                'kahim' => 'KAHIM (Ketua Umum)',
                'wakahim' => 'WAKAHIM (Wakil Ketua)',
                'sekretaris' => 'Sekretaris',
                'bendahara' => 'Bendahara',
                default => ucfirst($this->jabatan ?? 'Jabatan')
            }
        );
    }

    /**
     * Get departemen label
     */
    protected function departemenLabel(): Attribute
    {
        $labels = [
            'kwu' => 'KWU',
            'minatbakat' => 'Minat Bakat',
            'pemberdaya_wanita' => 'Pemberdayaan Wanita',
            'humas' => 'Humas',
            'kaderisasi' => 'Kaderisasi',
            'kominfo' => 'Kominfo',
            'sosial' => 'Sosial',
            'keagamaan' => 'Keagamaan'
        ];

        return Attribute::make(
            get: fn () => $labels[$this->departemen] ?? ($this->departemen ? ucwords(str_replace('_', ' ', $this->departemen)) : '')
        );
    }

    /**
     * Get posisi label
     */
    protected function posisiLabel(): Attribute
    {
        $labels = [
            'koordinator' => 'Koordinator',
            'anggota' => 'Anggota',
        ];

        return Attribute::make(
            get: fn () => $labels[$this->posisi] ?? ($this->posisi ? ucfirst($this->posisi) : '')
        );
    }

    /**
     * Get avatar URL dengan fallback yang aman
     */
    protected function avatarUrl(): Attribute
    {
        $defaultAvatar = $this->user?->avatar 
            ? Storage::url($this->user->avatar)
            : asset('images/default-avatar.png');

        return Attribute::make(
            get: fn () => $this->avatar 
                ? Storage::url($this->avatar)
                : $defaultAvatar
        );
    }

    /**
     * Scope untuk users yang belum punya struktur
     */
    public static function availableUsers()
    {
        return User::whereDoesntHave('struktur')->orderBy('name')->get(['id', 'name', 'email']);
    }

    /**
     * Check if user sudah punya struktur
     */
    public static function userHasStruktur($userId): bool
    {
        return static::where('user_id', $userId)->exists();
    }

    /**
     * Get jabatan color untuk badges
     */
    public function getJabatanColorAttribute(): string
    {
        return match($this->jabatan) {
            'kahim' => 'from-purple-500 to-purple-700',
            'wakahim' => 'from-indigo-500 to-indigo-700',
            'sekretaris' => 'from-emerald-500 to-emerald-700',
            'bendahara' => 'from-amber-500 to-amber-700',
            default => 'from-slate-500 to-slate-700'
        };
    }

    /**
     * Get departemen color untuk badges
     */
    public function getDepartemenColorAttribute(): string
    {
        return match($this->departemen) {
            'kwu' => 'from-blue-500 to-blue-600',
            'minatbakat' => 'from-green-500 to-green-600',
            'pemberdaya_wanita' => 'from-pink-500 to-pink-600',
            'humas' => 'from-orange-500 to-orange-600',
            'kaderisasi' => 'from-rose-500 to-rose-600',
            'kominfo' => 'from-sky-500 to-sky-600',
            'keagamaan' => 'from-teal-500 to-teal-600',
            'sosial' => 'from-lime-500 to-lime-600',
            default => 'from-slate-500 to-slate-600'
        };
    }

    /**
     * Accessors untuk badge classes
     */
    public function getJabatanBadgeAttribute(): string
    {
        return "bg-gradient-to-r {$this->jabatan_color} text-white px-4 py-2 rounded-full shadow-lg text-sm font-semibold";
    }

    public function getDepartemenBadgeAttribute(): string
    {
        return $this->departemen 
            ? "bg-gradient-to-r {$this->departemen_color} text-white px-4 py-2 rounded-full shadow-lg text-sm font-semibold"
            : "bg-slate-100 dark:bg-slate-700 text-slate-500 dark:text-slate-400 px-4 py-2 rounded-full text-sm font-medium";
    }
}
