<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = [
        'key', 'value', 'type', 'group', 'description', 'is_public', 'sort_order'
    ];

    protected $casts = [
        'value' => 'array',
        'is_public' => 'boolean',
        'sort_order' => 'integer',
    ];

    public static function get($key, $default = null)
    {
        return Cache::rememberForever("settings.{$key}", function () use ($key, $default) {
            $setting = static::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        });
    }

    public function scopeGroup($query, $group)
    {
        return $query->where('group', $group);
    }
}
