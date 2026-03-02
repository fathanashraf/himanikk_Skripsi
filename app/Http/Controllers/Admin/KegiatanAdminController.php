<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kegiatan;
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
            'published_kegiatan' => Kegiatan::where('status', Kegiatan::STATUS_PUBLISHED)->count(),
            'draft_kegiatan' => Kegiatan::where('status', Kegiatan::STATUS_DRAFT)->count(),
            'archived_kegiatan' => Kegiatan::where('status', Kegiatan::STATUS_ARCHIVED)->count(),
            'total_likes' => Kegiatan::withCount(['masukkans as total_likes' => fn($q) => $q->where('tipe', 'like')])->get()->sum('total_likes'),
            'total_dislikes' => Kegiatan::withCount(['masukkans as total_dislikes' => fn($q) => $q->where('tipe', 'dislike')])->get()->sum('total_dislikes'),
            'total_saran' => Kegiatan::withCount(['masukkans as total_saran' => fn($q) => $q->where('tipe', 'saran')])->get()->sum('total_saran'),
            'total_kritik' => Kegiatan::withCount(['masukkans as total_kritik' => fn($q) => $q->where('tipe', 'kritik')])->get()->sum('total_kritik'),
        ];

        return view('admin.kegiatan.index', compact('kegiatans', 'stats'));
    }


    public function create()
    {
        return view('admin.kegiatan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'status' => 'required|in:0,1,2',
            'image' => 'nullable|image|max:2048',
            'link' => 'nullable|url|max:255',
        ]);

        $data = $request->all();

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
            'name' => 'required|max:255',
            'description' => 'required',
            'status' => 'required|in:0,1,2',
            'image' => 'nullable|image|max:2048',
            'link' => 'nullable|url|max:255',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Delete old image
            if ($kegiatan->image) {
                Storage::disk('public')->delete($kegiatan->image);
            }
            $data['image'] = $request->file('image')->store('kegiatan', 'public');
        }

        $kegiatan->update($data);

        return redirect()->route('admin.kegiatan.index')
            ->with('success', 'Kegiatan berhasil diupdate!');
    }

    public function destroy(Kegiatan $kegiatan)
    {
        if ($kegiatan->image) {
            Storage::disk('public')->delete($kegiatan->image);
        }
        
        $kegiatan->delete();

        return redirect()->route('admin.kegiatan.index')
            ->with('success', 'Kegiatan berhasil dihapus!');
    }

    public function status(Kegiatan $kegiatan)
    {
        $kegiatan->status = $kegiatan->status === Kegiatan::STATUS_PUBLISHED 
            ? Kegiatan::STATUS_DRAFT 
            : Kegiatan::STATUS_PUBLISHED;
            
        $kegiatan->save();

        return response()->json([
            'success' => true,
            'status' => $kegiatan->status_label,
            'color' => Kegiatan::getStatusColors()[$kegiatan->status]
        ]);
    }
}
