<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\Masukkan;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;
use App\Models\Acara;
use App\Models\Profil;
use App\Models\Struktur;
use App\Models\Pendaftaran; 
use Illuminate\Validation\Rule;

class DashboardUserController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_events' => Event::count(),
            'total_acara' => Acara::count(),
            'total_kegiatan' => Acara::count(), // Asumsikan kegiatan sama dengan acara
            'unread_notifications' => auth()->user()->unreadNotifications()->count(),
        ];

        $profils = Profil::first();
        $strukturs = Struktur::with('user')->orderBy('jabatan')->get();
        $kegiatans = Kegiatan::where('status', 1)->orderBy('created_at', 'desc')->get();
        $masukkans = Masukkan::with('user')->orderBy('created_at', 'desc')->limit(100)->get();
        $events = Event::latest()->get();
        $acaras = Acara::latest()->get();
        return view('user.dashboard.index', compact('stats', 'profils', 'strukturs', 'kegiatans', 'masukkans', 'events', 'acaras'));
    }

// app/Http/Controllers/NotificationController.php
    public function markRead($notificationId)
    {
        $notification = auth()->user()->notifications()->findOrFail($notificationId);
        $notification->markAsRead();
        
        return back()->with('success', 'Notifikasi dibaca');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipe' => 'required|in:kritik,saran,like,dislike',
        ]);

        Masukkan::create([
            'user_id' => auth()->id(),
            'tipe' => $request->tipe,
        ]);

        return back()->with('success', 'Masukan berhasil dikirim');
    }

    public function event(Event $event)
    {
        return view('user.events.show', compact('event'));
    }

    
}
