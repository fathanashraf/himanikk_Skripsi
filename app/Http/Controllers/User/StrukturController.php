<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Struktur;
use App\Models\Profil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class StrukturController extends Controller
{
    public function index()
    {
        // Cache profil untuk performa
        $profils = Cache::remember('struktur.profil', 3600, function () {
            return Profil::first() ?? (object) [
                'singkatan' => 'HIMANIKKA',
                'name' => 'Himpunan Mahasiswa Teknik Informatika'
            ];
        });

        // Struktur dengan urutan jabatan yang tepat + avatar
        $strukturs = Cache::remember('struktur.data', 1800, function () {
            return Struktur::with(['user:id,name,nim,email,avatar'])
                        ->select('id', 'user_id', 'jabatan', 'departemen', 'posisi', 'avatar')
                        ->orderByRaw("
                            CASE jabatan 
                                WHEN 'kahim' THEN 1
                                WHEN 'wakahim' THEN 2
                                WHEN 'sekretaris' THEN 3
                                WHEN 'bendahara' THEN 4
                                ELSE 5 
                            END, 
                            CASE WHEN departemen IS NULL THEN 0 ELSE 1 END,
                            departemen
                        ")
                        ->get();
        });

        // ✅ FIXED STATS - NO MORE distinct() ERROR!
        $stats = Cache::remember('struktur.stats', 1800, function () use ($strukturs) {
            return [
                'total_anggota' => $strukturs->whereIn('posisi', ['anggota', null])->count(),
                'total_koordinator' => $strukturs->where('posisi', 'koordinator')->count(),
                'total_kahim' => $strukturs->where('jabatan', 'kahim')->count(),
                'total_wakahim' => $strukturs->where('jabatan', 'wakahim')->count(),
                'total_staff' => $strukturs->whereIn('jabatan', ['sekretaris', 'bendahara'])->count(),
                // ✅ FIXED: Gunakan ->pluck('departemen')->filter()->values()->unique()->count()
                'total_departemen' => $strukturs->pluck('departemen')->filter()->values()->unique()->count(),
                'departemen_counts' => $strukturs->whereNotNull('departemen')
                                              ->groupBy('departemen')
                                              ->map->count()
            ];
        });

        return view('user.struktur.index', compact('profils', 'strukturs', 'stats'));
    }

    public function show(Struktur $struktur)
{
    $struktur->load(['user:id,name,nim,email,avatar']);
    
    if (!$struktur->user) {
        abort(404, 'Struktur tidak ditemukan');
    }

    // ✅ TAMBAHKAN STATS UNTUK SHOW PAGE
    $stats = Cache::remember('struktur.stats', 1800, function () {
        $strukturs = Struktur::with(['user:id,name,nim'])->get();
        return [
            'total_anggota' => $strukturs->whereIn('posisi', ['anggota', null])->count(),
            'total_koordinator' => $strukturs->where('posisi', 'koordinator')->count(),
            'total_kahim' => $strukturs->where('jabatan', 'kahim')->count(),
            'total_wakahim' => $strukturs->where('jabatan', 'wakahim')->count(),
            'total_staff' => $strukturs->whereIn('jabatan', ['sekretaris', 'bendahara'])->count(),
            'total_departemen' => $strukturs->pluck('departemen')->filter()->values()->unique()->count(),
            'departemen_counts' => $strukturs->whereNotNull('departemen')->groupBy('departemen')->map->count()
        ];
    });

    // Load profil juga
    $profils = Cache::remember('struktur.profil', 3600, function () {
        return Profil::first() ?? (object) [
            'singkatan' => 'HIMANIKKA',
            'name' => 'Himpunan Mahasiswa Teknik Informatika'
        ];
    });

    return view('user.struktur.show', compact('struktur', 'stats', 'profils'));
}


    public function departemen($departemen)
{
    $data = Cache::remember("struktur.dept.{$departemen}", 1800, function () use ($departemen) {
        return Struktur::with(['user:id,name,nim,avatar'])
                     ->where('departemen', $departemen)
                     ->orderByRaw("
                        CASE posisi 
                            WHEN 'ketua' THEN 1
                            WHEN 'koordinator' THEN 2
                            WHEN 'anggota' THEN 3
                            ELSE 4
                        END
                     ")
                     ->get(['id', 'posisi', 'user_id', 'departemen', 'avatar']);
    });

    // Return Blade view instead of JSON
    return view('user.struktur.partials.departemen', compact('data', 'departemen'));
}


    public function clearCache()
    {
        Cache::forget('struktur.profil');
        Cache::forget('struktur.data');
        Cache::forget('struktur.stats');
        
        return redirect()->back()->with('success', 'Cache struktur dibersihkan!');
    }
}
