<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description', 
        'status',
        'image',
        'link'
    ];

    protected $casts = [
        'status' => 'integer'
    ];

    public function getImageUrlAttribute()
    {
        return $this->image ? Storage::url($this->image) : null;
    }

    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            0 => 'Draft',
            1 => 'Dipublikasikan',
            2 => 'Arsip',
            default => 'Unknown'
        };
    }

    public const DRAFT = 0;
    public const PUBLISHED = 1;
    public const ARCHIVED = 2;

    public function getStatusBadgeAttribute()
    {
        $badges = [
            self::DRAFT => ['bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-400', 'Draft'],
            self::PUBLISHED => ['bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-400', 'Published'],
            self::ARCHIVED => ['bg-slate-100 text-slate-800 dark:bg-slate-700/50 dark:text-slate-400', 'Archived'],
        ];

        return $badges[$this->status] ?? $badges[self::DRAFT];
    }
    
}
