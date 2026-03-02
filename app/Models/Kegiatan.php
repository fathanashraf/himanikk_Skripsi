<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Kegiatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status',
        'image',
        'link',
    ];

    protected $casts = [
        'status' => 'integer',
    ];

    // Status constants
    const STATUS_DRAFT = 0;
    const STATUS_PUBLISHED = 1;
    const STATUS_ARCHIVED = 2;

    // Status labels
    public static function getStatusLabels(): array
    {
        return [
            self::STATUS_DRAFT => 'Draft',
            self::STATUS_PUBLISHED => 'Published',
            self::STATUS_ARCHIVED => 'Archived',
        ];
    }

    // Status badge colors
    public static function getStatusColors(): array
    {
        return [
            self::STATUS_DRAFT => 'bg-yellow-100 text-yellow-800',
            self::STATUS_PUBLISHED => 'bg-emerald-100 text-emerald-800',
            self::STATUS_ARCHIVED => 'bg-gray-100 text-gray-800',
        ];
    }

    // Scope for published activities
    public function scopePublished($query)
    {
        return $query->where('status', self::STATUS_PUBLISHED);
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

    // masukkan relationship
    public function masukkans()
    {
        return $this->hasMany(Masukkan::class);
    }
}
