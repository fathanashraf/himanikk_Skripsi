<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Profil;
use App\Models\Struktur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TentangUserController extends Controller
{

    public function index()
    {
        // Cache profil utama (1 jam)
        $profil = Cache::remember('profil.tentang', 3600, function () {
            $profil = Profil::first();
            
            
            return $profil ?? (object) [
                'name' => 'Himpunan Mahasiswa Nikah Khitbah & Keluarga',
                'singkatan' => 'HIMANIKKA',
                'visi' => 'Menjadi himpunan mahasiswa yang unggul dalam pengembangan karakter nikah khitbah & keluarga Islami.',
                'misi' => "1. Mengembangkan potensi mahasiswa dalam bidang nikah khitbah & keluarga\n2. Menciptakan komunitas Islami yang harmonis dan berkelanjutan\n3. Memberikan edukasi pernikahan berkualitas untuk generasi muda",
                'instagram' => 'https://instagram.com/himanikka_official',
                'website' => null,
                'logo' => null,
            ];
        });
        
        $profils = Profil::first();
        // Struktur statistics (30 menit) - FIXED SYNTAX
        $stats = Cache::remember('struktur.stats.global', 1800, function () {
            return [
                'total_departemen' => Struktur::whereNotNull('departemen')->distinct()->count('departemen'),
                'total_koordinator' => Struktur::whereIn('posisi', ['koordinator', 'ketua'])->count(),
                'total_anggota' => Struktur::where('posisi', 'anggota')->count(),
                'total_kepengurusan' => Struktur::count()
            ];
        });

        // Timeline kepengurusan (1 jam)
        $timeline = Cache::remember('timeline.tentang', 3600, function () {
            return collect([
                (object) [
                    'tahun' => '2025-2026', 
                    'judul' => 'Kepengurusan Saat Ini', 
                    'deskripsi' => 'Masa bakti aktif dengan visi baru dan program unggulan.'
                ],
                (object) [
                    'tahun' => '2024', 
                    'judul' => 'Pelepasan & Pelantikan', 
                    'deskripsi' => 'Serah terima jabatan secara resmi kepengurusan periode 2025-2026.'
                ],
                (object) [
                    'tahun' => '2023', 
                    'judul' => 'Seminar Nikah Khitbah', 
                    'deskripsi' => 'Mengundang 500+ peserta dari berbagai kampus untuk edukasi pernikahan Islami.'
                ],
            ]);
        });

        return view('user.tentang.index', compact('profil','profils', 'stats', 'timeline'));
    }
}
