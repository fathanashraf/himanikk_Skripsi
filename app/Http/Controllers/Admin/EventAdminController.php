<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Storage;

class EventAdminController extends Controller
{
    public function index()
    {
        $stats = [
            'total_events' => Event::count(),
            'published_events' => Event::where('status', Event::PUBLISHED)->count(),
            'draft_events' => Event::where('status', Event::DRAFT)->count(),
            
        ];
        $events = Event::latest()->get();
        return view('admin.events.index', compact('events', 'stats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|integer|in:0,1,2',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|url|max:255'
        ]);

        $data = $request->only(['name', 'description', 'status', 'link']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('events', 'public');
        }

        Event::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Acara berhasil ditambahkan!'
        ]);
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|integer|in:0,1,2',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|url|max:255'
        ]);

        $data = $request->only(['name', 'description', 'status', 'link']);

        if ($request->hasFile('image')) {
            // Hapus gambar lama
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            $data['image'] = $request->file('image')->store('events', 'public');
        }

        $event->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Acara berhasil diupdate!'
        ]);
    }

    public function destroy(Event $event)
    {
        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }
        $event->delete();

        return response()->json([
            'success' => true,
            'message' => 'Acara berhasil dihapus!'
        ]);
    }

    public function toggleStatus(Request $request, Event $event)
    {
        $request->validate([
            'status' => 'required|integer|in:0,1'
        ]);

        $event->update(['status' => $request->status]);

        $statusText = $request->status == 1 ? 'Dipublikasikan' : 'Draft';
        return response()->json([
            'success' => true,
            'message' => "Status berhasil diubah ke {$statusText}!"
        ]);
    }

    public function data()
    {
        $events = Event::latest()->get();
        return response()->json(['events' => $events]);
    }
}
