<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status',
        'tanggal',
        'waktu',
        'tempat',
        'user_id',
        'image',
        'link',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'waktu' => 'datetime:H:i',
    ];

    
    // Status constants
    const STATUS_segera = 0;
    const STATUS_belum = 1;
    const STATUS_selesai = 2;

    // Status labels
    public static function getStatusLabels(): array
    {
        return [
            self::STATUS_segera => 'segera',
            self::STATUS_belum => 'belum',
            self::STATUS_selesai => 'selesai',
        ];
    }

    // Status badge colors
    public static function getStatusColors(): array
    {
        return [
            self::STATUS_segera => 'bg-yellow-100 text-yellow-800',
            self::STATUS_belum => 'bg-emerald-100 text-emerald-800',
            self::STATUS_selesai => 'bg-gray-100 text-gray-800',
        ];
    }

    // Scope for belum activities
    public function scopebelum($query)
    {
        return $query->where('status', self::STATUS_belum);
    }

    // Accessor for status label
    protected function statusLabel(): Attribute
    {
        return Attribute::make(
            get: fn () => self::getStatusLabels()[$this->status] ?? 'Unknown'
        );
    }

    // Image URL
    protected function imageUrl(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->image ? asset('storage/' . $this->image) : null
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function masukkans()
    {
        return $this->hasMany(Masukkan::class, 'event_id');
    }

    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class, 'event_id');
    }

    public function getWaPenanggungJawabAttribute()
    {
        return $this->user?->phone;
    }
}
