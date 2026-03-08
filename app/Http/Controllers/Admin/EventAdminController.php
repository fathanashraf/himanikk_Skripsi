<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Masukkan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventAdminController extends Controller
{
    public function index()
    {
        $events = event::withCount([
                'masukkans as like_count' => fn($q) => $q->where('tipe', 'like'),
                'masukkans as dislike_count' => fn($q) => $q->where('tipe', 'dislike'),
                'masukkans as saran_count' => fn($q) => $q->where('tipe', 'saran'),
                'masukkans as kritik_count' => fn($q) => $q->where('tipe', 'kritik'),
            ])
            ->latest()
            ->get();

        $stats = [
            'total_event' => event::count(),
            'published_event' => event::where('status', event::STATUS_segera)->count(),
            'draft_event' => event::where('status', event::STATUS_belum)->count(),
            'archived_event' => event::where('status', event::STATUS_selesai)->count(),
            'total_likes' => event::withCount(['masukkans as total_likes' => fn($q) => $q->where('tipe', 'like')])->get()->sum('total_likes'),
            'total_dislikes' => event::withCount(['masukkans as total_dislikes' => fn($q) => $q->where('tipe', 'dislike')])->get()->sum('total_dislikes'),
            'total_saran' => event::withCount(['masukkans as total_saran' => fn($q) => $q->where('tipe', 'saran')])->get()->sum('total_saran'),
            'total_kritik' => event::withCount(['masukkans as total_kritik' => fn($q) => $q->where('tipe', 'kritik')])->get()->sum('total_kritik'),
        ];

        $users = User::first()->get();

        return view('admin.events.index', compact('events', 'stats', 'users'));
    }


    public function create()
    {
        return view('admin.events.create');
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
            $data['image'] = $request->file('image')->store('event', 'public');
        }

        event::create($data);

        return redirect()->route('admin.events.index')
            ->with('success', 'event berhasil ditambahkan!');
    }

    public function edit(event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, event $event)
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
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            $data['image'] = $request->file('image')->store('event', 'public');
        }

        // Auto-set user_id jika kosong
        $data['user_id'] ??= Auth::id();

        $event->update($data);

        return response()->json([
            'success' => true,
            'message' => 'event berhasil diupdate!'
        ]);
    }

    public function destroy(event $event)
    {
        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }

        $event->delete();

        return response()->json([
            'success' => true,
            'message' => 'event berhasil dihapus!'
        ]);
    }

    public function status(event $event)
    {
        $statusMap = [
            'segera' => 'belum',
            'belum' => 'selesai', 
            'selesai' => 'segera'
        ];

        $newStatus = $statusMap[$event->status] ?? 'belum';

        $event->status = $newStatus;
        $event->save();

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
