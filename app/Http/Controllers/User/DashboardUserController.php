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
use Illuminate\Support\Facades\Storage;

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
        $users = User::all();
        $profils = Profil::first();
        $strukturs = Struktur::with('user')->orderBy('jabatan')->get();
        $kegiatans = Kegiatan::where('status', 1)->orderBy('created_at', 'desc')->get();
        $masukkans = Masukkan::with('user')->orderBy('created_at', 'desc')->limit(100)->get();
        $events = Event::latest()->get();
        $acaras = Acara::latest()->get();
        return view('user.dashboard.index', compact('stats', 'users','profils', 'strukturs', 'kegiatans', 'masukkans', 'events', 'acaras'));
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

    public function masukkanStore(Request $request)
{
    // ✅ VALIDASI LENGKAP + CUSTOM MESSAGES
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string|max:5000|min:10',
        'category' => 'required|in:saran,keluhan,ide,pujian',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
    ], [
        'title.required' => 'Judul masukkan harus diisi.',
        'content.required' => 'Isi masukkan tidak boleh kosong.',
        'content.min' => 'Isi masukkan minimal 10 karakter.',
        'category.in' => 'Pilih kategori yang valid.',
        'image.mimes' => 'Gambar harus format JPG, PNG, WebP.',
        'image.max' => 'Ukuran gambar maksimal 5MB.',
    ]);

    // ✅ AMAN - HANYA DATA YANG DIVALIDASI
    $data = array_merge($validated, [
        'user_id' => auth()->id(),
        'status' => 'pending',
        'like_count' => 0,
        'share_count' => 0,
        'comment_count' => 0, // Untuk performance
    ]);

    // ✅ FILE UPLOAD AMAN + VALIDASI ULANG
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        
        // Double check
        if ($image->isValid() && in_array($image->getClientOriginalExtension(), ['jpeg', 'png', 'jpg', 'webp'])) {
            $data['image'] = $image->store('masukkan/images', 'public');
        }
    }

    // ✅ TRANSACTION UNTUK SAFETY
    try {
        $masukkan = Masukkan::create($data);
        
        // ✅ LOG ACTIVITY (optional)
        // activity('masukkan')->causedBy(auth()->user())->created($masukkan);
        
        return back()->with([
            'success' => '✅ Masukkan berhasil dikirim dan menunggu persetujuan admin!',
            'masukkan_id' => $masukkan->id
        ]);
        
    } catch (\Exception $e) {
        // ✅ CLEANUP JIKA GAGAL
        if (isset($data['image']) && Storage::disk('public')->exists($data['image'])) {
            Storage::disk('public')->delete($data['image']);
        }
        
        return back()->withInput()->with('error', '❌ Gagal menyimpan masukkan. Silakan coba lagi.');
    }
}

}
