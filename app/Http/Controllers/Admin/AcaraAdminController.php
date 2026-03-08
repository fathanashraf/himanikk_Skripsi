<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Acara;
use App\Models\Kegiatan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AcaraAdminController extends Controller
{
    public function index()
    {
        $acaras = acara::withCount([
                'masukkans as like_count' => fn($q) => $q->where('tipe', 'like'),
                'masukkans as dislike_count' => fn($q) => $q->where('tipe', 'dislike'),
                'masukkans as saran_count' => fn($q) => $q->where('tipe', 'saran'),
                'masukkans as kritik_count' => fn($q) => $q->where('tipe', 'kritik'),
            ])
            ->latest()
            ->get();

        $stats = [
            'total_acara' => acara::count(),
            'published_acara' => acara::where('status', acara::STATUS_segera)->count(),
            'draft_acara' => acara::where('status', acara::STATUS_belum)->count(),
            'archived_acara' => acara::where('status', acara::STATUS_selesai)->count(),
            'total_likes' => acara::withCount(['masukkans as total_likes' => fn($q) => $q->where('tipe', 'like')])->get()->sum('total_likes'),
            'total_dislikes' => acara::withCount(['masukkans as total_dislikes' => fn($q) => $q->where('tipe', 'dislike')])->get()->sum('total_dislikes'),
            'total_saran' => acara::withCount(['masukkans as total_saran' => fn($q) => $q->where('tipe', 'saran')])->get()->sum('total_saran'),
            'total_kritik' => acara::withCount(['masukkans as total_kritik' => fn($q) => $q->where('tipe', 'kritik')])->get()->sum('total_kritik'),
        ];

        $users = User::first()->get();

        return view('admin.acara.index', compact('acaras', 'stats', 'users'));
    }


    public function create()
    {
        return view('admin.acara.create');
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
            $data['image'] = $request->file('image')->store('acara', 'public');
        }

        acara::create($data);

        return redirect()->route('admin.acara.index')
            ->with('success', 'acara berhasil ditambahkan!');
    }

    public function edit(acara $acara)
    {
        return view('admin.acara.edit', compact('acara'));
    }

    public function update(Request $request, acara $acara)
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
            if ($acara->image) {
                Storage::disk('public')->delete($acara->image);
            }
            $data['image'] = $request->file('image')->store('acara', 'public');
        }

        // Auto-set user_id jika kosong
        $data['user_id'] ??= Auth::id();

        $acara->update($data);

        return response()->json([
            'success' => true,
            'message' => 'acara berhasil diupdate!'
        ]);
    }

    public function destroy(acara $acara)
    {
        if ($acara->image) {
            Storage::disk('public')->delete($acara->image);
        }

        $acara->delete();

        return response()->json([
            'success' => true,
            'message' => 'acara berhasil dihapus!'
        ]);
    }

    public function status(acara $acara)
    {
        $statusMap = [
            'segera' => 'belum',
            'belum' => 'selesai', 
            'selesai' => 'segera'
        ];

        $newStatus = $statusMap[$acara->status] ?? 'belum';

        $acara->status = $newStatus;
        $acara->save();

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
