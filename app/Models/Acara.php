<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Acara extends Model
{
    use HasFactory;

    protected $table = 'acaras';

    protected $fillable = [
        'name',
        'description', 
        'status',
        'image',
        'link'
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
            self::STATUS_PUBLISHED => 'Dipublikasikan',
            self::STATUS_ARCHIVED => 'Arsip'
        ];
    }

    // Status colors for frontend
    public static function getStatusClasses(): array
    {
        return [
            self::STATUS_DRAFT => 'bg-yellow-100 text-yellow-800',
            self::STATUS_PUBLISHED => 'bg-emerald-100 text-emerald-800',
            self::STATUS_ARCHIVED => 'bg-gray-100 text-gray-800'
        ];
    }

    // Accessors
    protected function status(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => (int) $value,
        );
    }

    // Scope untuk filtering berdasarkan status
    public function scopePublished($query)
    {
        return $query->where('status', self::STATUS_PUBLISHED);
    }

    public function scopeDraft($query)
    {
        return $query->where('status', self::STATUS_DRAFT);
    }

    public function scopeArchived($query)
    {
        return $query->where('status', self::STATUS_ARCHIVED);
    }

    // Helper methods
    public function isPublished(): bool
    {
        return $this->status === self::STATUS_PUBLISHED;
    }

    public function isDraft(): bool
    {
        return $this->status === self::STATUS_DRAFT;
    }

    public function isArchived(): bool
    {
        return $this->status === self::STATUS_ARCHIVED;
    }

    // Get image URL
    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image) {
            return null;
        }
        
        return asset('storage/' . $this->image);
    }

    // Get status label
    public function getStatusLabelAttribute(): string
    {
        return self::getStatusLabels()[$this->status] ?? 'Unknown';
    }

    // Get status class
    public function getStatusClassAttribute(): string
    {
        return self::getStatusClasses()[$this->status] ?? 'bg-gray-100 text-gray-800';
    }
}
