<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

class Profil extends Model
{
    use HasFactory;

    protected $table = 'profils';

    /**
     * ✅ FIXED: Fillable SESUAI DATABASE SCHEMA
     */
    protected $fillable = [
        'name', 'singkatan', 'sejarah', 'alamat', 'email', 'fungsi', 'tujuan',
        'logo', 'visi', 'misi', 'motto', 'AD/ART', 'lagu', 'instrumen'
    ];

    /**
     * ✅ FIXED: Casts BENAR - sejarah = text, bukan array!
     */
    protected $casts = [
        'sejarah' => 'string',  // ← TEXT field, bukan array!
        'visi' => 'string',
        'misi' => 'string',
        'tujuan' => 'string',
        'fungsi' => 'string',
    ];

    /**
     * ✅ Logo accessor - Full URL otomatis
     */
    protected function logo(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                return $value && Storage::disk('public')->exists($value) 
                    ? asset('storage/' . $value) 
                    : null;
            },
        );
    }

    /**
     * ✅ Email validation + formatting
     */
    protected function email(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                return filter_var($value, FILTER_VALIDATE_EMAIL) ? $value : null;
            },
        );
    }

    /**
     * ✅ File existence checkers
     */
    public function hasLogo(): bool
    {
        return !empty($this->logo) && Storage::disk('public')->exists($this->getRawOriginal('logo'));
    }

    public function hasDokumen(): bool
    {
        return !empty($this->{'AD_ART'}) || !empty($this->lagu) || !empty($this->instrumen);
    }

    /**
     * ✅ Helper untuk table display
     */
    public function getLogoUrlAttribute(): ?string
    {
        return $this->logo;
    }

    /**
     * ✅ Scope untuk active profils
     */
    public function scopeActive($query)
    {
        return $query->whereNotNull('name');
    }

    /**
     * ✅ First or default untuk fallback
     */
    public static function firstOrDefault()
    {
        $profil = self::first();
        if (!$profil) {
            return self::make([
                'name' => 'HIMANIKKA Riau',
                'singkatan' => 'HIMANIKA',
                'alamat' => 'Universitas Islam Riau, Pekanbaru, Riau',
                'email' => 'info@himanikka.ac.id',
            ]);
        }
        return $profil;
    }

    /**
     * ✅ Get all file paths untuk cleanup
     */
    public function getFilePaths(): array
    {
        return array_filter([
            'logo' => $this->getRawOriginal('logo'),
            'AD/ART' => $this->getRawOriginal('AD/ART'),
            'lagu' => $this->getRawOriginal('lagu'),
            'instrumen' => $this->getRawOriginal('instrumen'),
        ]);
    }
}
