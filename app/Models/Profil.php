<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Profil extends Model
{
    use HasFactory;

    protected $table = 'profils';

    protected $fillable = [
        'name', 'singkatan','sejarah', 'alamat', 'email', 'fungsi', 'tujuan', 
        'logo', 'visi', 'misi', 'motto', 'AD/ART', 'lagu', 'instrumen'
    ];

    protected $casts = [
        'sejarah' => 'array',
    ];

    // ✅ FIX: Handle NULL values dengan benar
    protected function logo(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                return $value ? asset('storage/' . $value) : null;
            },
        );
    }

    protected function email(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => filter_var($value, FILTER_VALIDATE_EMAIL) ? $value : null,
        );
    }

    // ✅ Method helper yang AMAN
    public static function firstOrDefault()
    {
        $profil = self::first();
        return $profil ?: self::make([
            'name' => 'HIMANIKKA',
            'alamat' => 'Universitas, Riau, Indonesia',
        ]);
    }
}
