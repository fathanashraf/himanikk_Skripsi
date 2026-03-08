<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kegiatan;
use App\Models\User;
use App\Models\Masukkan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class KegiatanAdminController extends Controller
{
   public function index()
    {
        $kegiatans = Kegiatan::withCount([
                'masukkans as like_count' => fn($q) => $q->where('tipe', 'like'),
                'masukkans as dislike_count' => fn($q) => $q->where('tipe', 'dislike'),
                'masukkans as saran_count' => fn($q) => $q->where('tipe', 'saran'),
                'masukkans as kritik_count' => fn($q) => $q->where('tipe', 'kritik'),
            ])
            ->latest()
            ->get();

        $stats = [
            'total_kegiatan' => Kegiatan::count(),
            'published_kegiatan' => Kegiatan::where('status', Kegiatan::STATUS_segera)->count(),
            'draft_kegiatan' => Kegiatan::where('status', Kegiatan::STATUS_belum)->count(),
            'archived_kegiatan' => Kegiatan::where('status', Kegiatan::STATUS_selesai)->count(),
            'total_likes' => Kegiatan::withCount(['masukkans as total_likes' => fn($q) => $q->where('tipe', 'like')])->get()->sum('total_likes'),
            'total_dislikes' => Kegiatan::withCount(['masukkans as total_dislikes' => fn($q) => $q->where('tipe', 'dislike')])->get()->sum('total_dislikes'),
            'total_saran' => Kegiatan::withCount(['masukkans as total_saran' => fn($q) => $q->where('tipe', 'saran')])->get()->sum('total_saran'),
            'total_kritik' => Kegiatan::withCount(['masukkans as total_kritik' => fn($q) => $q->where('tipe', 'kritik')])->get()->sum('total_kritik'),
        ];

        $users = User::first()->get();

        return view('admin.kegiatan.index', compact('kegiatans', 'stats', 'users'));
    }


    public function create()
    {
        return view('admin.kegiatan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'status' => 'required|in:segera,belum,selesai',
        'tanggal' => 'required|date|after_or_equal:today',
        'waktu' => 'required',
        'tempat' => 'required|string|max:255',
        'user_id' => 'required|exists:users,id',
        'image' => 'nullable|image|max:5120',
        'link' => 'nullable|url|max:255',
    ]);

        $data = $request->all();

        if (empty($data['users_id'])) {
            $data['users_id'] = auth()->user()->id;
        }

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('kegiatan', 'public');
        }

        Kegiatan::create($data);

        return redirect()->route('admin.kegiatan.index')
            ->with('success', 'Kegiatan berhasil ditambahkan!');
    }

    public function edit(Kegiatan $kegiatan)
    {
        return view('admin.kegiatan.edit', compact('kegiatan'));
    }

    public function update(Request $request, Kegiatan $kegiatan)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:segera,belum,selesai',
            'tanggal' => 'required|date',
            'waktu' => 'required',
            'tempat' => 'required|string|max:255',
            'user_id' => 'sometimes|exists:users,id',
            'image' => 'nullable|image|max:5120',
            'link' => 'nullable|url|max:255',
        ]);

        // ✅ FIX: Pakai only() bukan validated()
        $data = $request->only([
            'name', 'description', 'status', 'tanggal', 
            'waktu', 'tempat', 'user_id', 'link'
        ]);

        // Handle image upload & delete old image
        if ($request->hasFile('image')) {
            if ($kegiatan->image) {
                Storage::disk('public')->delete($kegiatan->image);
            }
            $data['image'] = $request->file('image')->store('kegiatan', 'public');
        }

        // Auto-set user_id jika kosong
        $data['user_id'] ??= Auth::id();

        $kegiatan->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Kegiatan berhasil diupdate!'
        ]);
    }

    public function destroy(Kegiatan $kegiatan)
    {
        if ($kegiatan->image) {
            Storage::disk('public')->delete($kegiatan->image);
        }

        $kegiatan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Kegiatan berhasil dihapus!'
        ]);
    }

    public function status(Kegiatan $kegiatan)
    {
        $statusMap = [
            'segera' => 'belum',
            'belum' => 'selesai', 
            'selesai' => 'segera'
        ];

        $newStatus = $statusMap[$kegiatan->status] ?? 'belum';

        $kegiatan->status = $newStatus;
        $kegiatan->save();

        return response()->json([
            'success' => true,
            'status' => $newStatus,
            'status_label' => ucfirst($newStatus),
            'color' => match($newStatus) {
                'segera' => 'bg-red-100 text-red-800',
                'belum' => 'bg-yellow-100 text-yellow-800',
                'selesai' => 'bg-emerald-100 text-emerald-800',
                default => 'bg-gray-100 text-gray-800'
            }
        ]);
    }
}
