<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Role;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'google_id',
        'google_token',
        'is_active',
        'last_login_at',
        'email_verified_at',
        'password',
        'password_confirmation',
        'avatar',
        'phone',
        'role',
        'status',
        'address',
        'gender',
        'birth_date',
        'nidn',
        'nim',
        'remember_token',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isSuperAdmin()
    {
        return $this->role === 'superadmin';
    }

    public function isUser()
    {
        return $this->role === 'user';
    }

    public function struktur()
    {
        return $this->hasOne(Struktur::class, 'user_id');
    }

    public function kegiatan()
    {
        return $this->hasMany(Kegiatan::class, 'user_id');
    }

    public function masukkans()
    {
        return $this->hasMany(Masukkan::class, 'user_id');
    }

    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'user_id');
    }

    public function acara()
    {
        return $this->hasMany(Acara::class, 'user_id');
    }

    public function event()
    {
        return $this->hasMany(Event::class, 'user_id');
    }

}
