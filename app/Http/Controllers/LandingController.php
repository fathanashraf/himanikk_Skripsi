<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use App\Models\Struktur;
use App\Models\Kegiatan;
use App\Models\Masukkan;
use App\Models\Event;
use App\Models\Acara;
use App\Models\User;


class LandingController extends Controller
{
    public function index()
    {
        $profils = Profil::first();
        $strukturs = Struktur::with('user')->orderBy('jabatan')->get();
        $kegiatans = Kegiatan::where('status', 1)->orderBy('created_at', 'desc')->get();
        $masukkans = Masukkan::with('user')->orderBy('created_at', 'desc')->limit(100)->get();
        $events = Event::latest()->get();
        $acaras = Acara::latest()->get();

        $stats = [
            'totalUsers' => User::count(),
            'totalEvents' => Event::count(),
            'totalAcara' => Acara::count(),
            'totalKegiatan' => Kegiatan::count(),
        ];

        return view('welcome', compact('profils', 'strukturs', 'kegiatans', 'masukkans', 'events', 'acaras', 'stats'));
    }

    public function strukturs()
    {
        $profils = Profil::first();
        $strukturs = $profils ? $profils->strukturs()->orderBy('jabatan')->get() : collect();

        $strukturs = Struktur::with('user')->orderBy('jabatan')->get();

        return view('strukturs', compact('profils', 'strukturs'));
    }
        
}
