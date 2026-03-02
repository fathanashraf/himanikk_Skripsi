<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profil;
use App\Models\Event;

class TentangController extends Controller
{
    /**
     * Display admin tentang page dengan stats
     */
    public function index()
{
    $stats = [
        'users' => User::count(),
        'events' => Event::count(),
        'profils' => Profil::count(),           // ← INI INTEGER (1)
        'profil' => Profil::first(),             // ← INI MODEL (object)
        'active_users' => User::where('created_at', '>=', now()->subDays(30))->count(),
        'admin_count' => User::where('role', 'admin')->count(),
        // ✅ TAMBAH INI - LIST SEMUA PROFIL UNTUK TABLE
        'profiles_list' => Profil::all(),        // ← INI ARRAY COLLECTION
    ];

    $profils = Profil::first();

    return view('admin.tentang.index', compact('stats', 'profils'));
}


    /**
     * Show form create profil organisasi
     */
    public function create()
    {
        $profil = Profil::first();
        return view('admin.tentang.create', compact('profil'));
    }

    /**
     * Store profil organisasi baru
     */
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'singkatan' => 'required|string|max:255',
        'sejarah' => 'nullable|string',
        'alamat' => 'required|string|max:500',
        'email' => 'nullable|email|max:255',
        'fungsi' => 'required|string|max:1000',
        'tujuan' => 'required|string|max:1000',
        'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'visi' => 'nullable|string|max:1000',
        'misi' => 'nullable|string|max:1000',
        'motto' => 'nullable|string|max:255',
        // ✅ FILE AUDIO/VIDEO
        'AD/ART' => 'nullable|file|mimes:pdf,doc,docx|max:5120', // 5MB    
        'lagu' => 'nullable|file|mimes:mp3,mp4,avi,mov,ogg|max:10240', // 10MB
        'instrumen' => 'nullable|file|mimes:mp3,mp4,avi,mov|max:51200', // 50MB
    ]);

    $data = $request->except(['logo', 'lagu', 'instrumen']);

    // Handle Logo
    if ($request->hasFile('logo')) {
        $data['logo'] = $request->file('logo')->store('profils/logos', 'public');
    }

    // Handle AD/ART
    if ($request->hasFile('AD/ART')) {
        $data['AD/ART'] = $request->file('AD/ART')->store('profils/AD/ART', 'public');
    }

    // Handle Lagu Mars
    if ($request->hasFile('lagu')) {
        $data['lagu'] = $request->file('lagu')->store('profils/lagu', 'public');
    }

    // Handle Instrumen
    if ($request->hasFile('instrumen')) {
        $data['instrumen'] = $request->file('instrumen')->store('profils/instrumen', 'public');
    }

    Profil::create($data);

    return redirect()->route('admin.tentang.index')
                    ->with('success', 'Profil organisasi berhasil dibuat!');
}


    /**
     * Show form edit profil organisasi
     */
    public function edit()
    {
        $profil = Profil::firstOrFail();
        return view('admin.tentang.edit', compact('profil'));
    }

    /**
     * Update profil organisasi
     */
    public function update(Request $request)
    {
        $profil = Profil::firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'singkatan' => 'required|string|max:255',
            'sejarah' => 'nullable|string',
            'alamat' => 'required|string|max:500',
            'email' => 'nullable|email|max:255',
            'fungsi' => 'required|string|max:1000',
            'tujuan' => 'required|string|max:1000',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'visi' => 'nullable|string|max:1000',
            'misi' => 'nullable|string|max:1000',
            'motto' => 'nullable|string|max:255',
            'AD/ART' => 'nullable|string|max:255',
            'lagu' => 'nullable|string|max:255',
            'instrumen' => 'nullable|string|max:255',
        ]);

        $data = $request->except('logo');

        if ($request->hasFile('logo')) {
            // Hapus logo lama
            if ($profil->logo) {
                \Storage::disk('public')->delete($profil->logo);
            }
            $data['logo'] = $request->file('logo')->store('profils', 'public');
        }

        $profil->update($data);

        return redirect()->route('admin.tentang.index')
                        ->with('success', 'Profil organisasi berhasil diperbarui!');
    }

    /**
     * Delete profil organisasi
     */
    public function destroy()
    {        $profils = Profil::firstOrFail();
        $profils->delete();
        return redirect()->route('admin.tentang.index')
                        ->with('success', 'Profil organisasi berhasil dihapus!');
    }
}
