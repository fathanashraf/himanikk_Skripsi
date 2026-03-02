<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keuangan extends Model
{
    use HasFactory;
    
    protected $table = 'keuangans';
    
    protected $fillable = [
        'name', 
        'nominal', 
        'tanggal', 
        'type',
        'user_id', 
        'kegiatan_id', 
        'event_id', 
        'acara_id', 
        'pendaftaran_id', 
        'jenis', 
        'total', 
        'keterangan'
    ];
    
    protected $casts = [
        'nominal' => 'decimal:2',
        'total' => 'decimal:2',
        'tanggal' => 'date',
    ];

    // ✅ ACCESSORS untuk format Rupiah
    public function getNominalFormattedAttribute()
    {
        return 'Rp ' . number_format($this->nominal, 0, ',', '.');
    }

    public function getTotalFormattedAttribute()
    {
        return 'Rp ' . number_format($this->total, 0, ',', '.');
    }

    // ✅ USER RELATIONSHIP
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ✅ KEGIATAN RELATIONSHIP
    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }

    // ✅ EVENT RELATIONSHIP
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // ✅ ACARA RELATIONSHIP
    public function acara()
    {
        return $this->belongsTo(Acara::class);
    }

    // ✅ PENDAFTARAN RELATIONSHIP
    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class);
    }

    // 🔍 HELPER METHOD - Dapatkan referensi utama
    public function getReferensiAttribute()
    {
        if ($this->pendaftaran) {
            return [
                'type' => 'pendaftaran',
                'name' => $this->pendaftaran->name ?? 'Pendaftaran #' . $this->pendaftaran_id,
                'description' => $this->pendaftaran->description ?? null
            ];
        }
        
        if ($this->kegiatan) {
            return [
                'type' => 'kegiatan',
                'name' => $this->kegiatan->name ?? 'Kegiatan #' . $this->kegiatan_id,
                'description' => $this->kegiatan->description ?? null
            ];
        }
        
        if ($this->event) {
            return [
                'type' => 'event',
                'name' => $this->event->name ?? 'Event #' . $this->event_id,
                'description' => $this->event->description ?? null
            ];
        }
        
        if ($this->acara) {
            return [
                'type' => 'acara',
                'name' => $this->acara->name ?? 'Acara #' . $this->acara_id,
                'description' => $this->acara->description ?? null
            ];
        }
        
        return [
            'type' => 'mandiri',
            'name' => 'Transaksi Mandiri',
            'description' => null
        ];
    }

    // 🔍 SCOPE untuk filter jenis
    public function scopePendapatan($query)
    {
        return $query->where('jenis', 'pendapatan');
    }

    public function scopePengeluaran($query)
    {
        return $query->where('jenis', 'pengeluaran');
    }

    // 🔍 SCOPE untuk search
    public function scopeSearch($query, $search)
    {
        return $query->where(function($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('keterangan', 'like', "%{$search}%")
              ->orWhere('nominal', 'like', "%{$search}%");
        });
    }

    // 🔍 SCOPE untuk filter tanggal
    public function scopeTanggal($query, $tanggal)
    {
        return $query->whereDate('tanggal', $tanggal);
    }
}
