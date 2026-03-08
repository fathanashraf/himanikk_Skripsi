<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Masukkan;
use App\Models\User;
use App\Models\Like;
use App\Models\Bookmark;
use App\Models\Comment;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class MasukkanController extends Controller
{

    /**
     * Display listing of masukkan with filters & stats
     */
    public function index(Request $request)
    {
        $stats = [
            'total' => Masukkan::count(),
            'pending' => Masukkan::where('status', 'pending')->count(),
            'approved' => Masukkan::where('status', 'approved')->count(),
            'rejected' => Masukkan::where('status', 'rejected')->count(),
            'user_total' => Auth::user()->masukkans()->count(),
        ];

        $query = Masukkan::with(['user', 'likes', 'bookmarks'])
            ->withCount(['likes', 'bookmarks', 'comments'])
            ->latest();

        // Filters
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $masukkans = $query->paginate(12);

        return view('user.masukkan.index', compact('stats', 'masukkans'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        return view('user.masukkan.create');
    }

    /**
     * Store new masukkan - PRODUCTION READY
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:5000',
            'category' => 'required|in:saran,keluhan,ide,pujian',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'status' => 'in:pending,approved,rejected',
        ]);

        $data = array_merge($validated, [
            'user_id' => Auth::id(),
            'status' => 'pending', // Default status
        ]);

        // File upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('masukkan/images', 'public');
        }

        $masukkan = Masukkan::create($data);

        return response()->json([
            'success' => true,
            'message' => '✅ Masukkan berhasil dikirim dan menunggu persetujuan!',
            'data' => $masukkan->load('user'),
            'redirect' => route('user.masukkan.index')
        ]);
    }

    /**
     * Display specific masukkan
     */
    public function show(Masukkan $masukkan)
    {
        $masukkan->loadCount(['likes', 'bookmarks', 'comments']);
        $masukkan->load(['user', 'comments.user.parent', 'likes.user', 'bookmarks.user']);
        
        return view('user.masukkan.show', compact('masukkan'));
    }

    /**
     * Show edit form (owner only)
     */
    public function edit(Masukkan $masukkan)
    {
        if ($masukkan->user_id !== Auth::id()) {
            abort(403, 'Hanya pembuat yang bisa edit');
        }
        
        return view('user.masukkan.edit', compact('masukkan'));
    }

    /**
     * Update masukkan
     */
    public function update(Request $request, Masukkan $masukkan)
    {
        if ($masukkan->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:5000',
            'category' => 'required|in:saran,keluhan,ide,pujian',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        // Delete old image
        if ($request->hasFile('image') && $masukkan->image) {
            Storage::disk('public')->delete($masukkan->image);
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('masukkan/images', 'public');
        }

        $masukkan->update($validated);

        return redirect()->route('user.masukkan.show', $masukkan)
            ->with('success', 'Masukkan berhasil diupdate!');
    }

    /**
     * Delete masukkan
     */
    public function destroy(Masukkan $masukkan)
    {
        if ($masukkan->user_id !== Auth::id()) {
            abort(403);
        }

        if ($masukkan->image) {
            Storage::disk('public')->delete($masukkan->image);
        }

        $masukkan->delete();

        return redirect()->route('user.masukkan.index')
            ->with('success', 'Masukkan berhasil dihapus!');
    }

    // === INTERACTIONS ===

    /**
     * Toggle like/unlike
     */
    public function like(Masukkan $masukkan)
    {
        $existing = $masukkan->likes()->where('user_id', Auth::id())->first();

        if ($existing) {
            $existing->delete();
            $count = $masukkan->likes()->count();
            return response()->json(['action' => 'unlike', 'count' => $count]);
        }

        $masukkan->likes()->create(['user_id' => Auth::id()]);
        $count = $masukkan->likes()->count();
        
        return response()->json(['action' => 'like', 'count' => $count]);
    }

    /**
     * Toggle bookmark
     */
    public function bookmark(Masukkan $masukkan)
    {
        $existing = $masukkan->bookmarks()->where('user_id', Auth::id())->first();

        if ($existing) {
            $existing->delete();
            return response()->json(['action' => 'unbookmark', 'count' => $masukkan->bookmarks()->count()]);
        }

        $masukkan->bookmarks()->create(['user_id' => Auth::id()]);
        return response()->json(['action' => 'bookmark', 'count' => $masukkan->bookmarks()->count()]);
    }

    /**
     * Store comment
     */
    public function comment(Request $request, Masukkan $masukkan)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:1000|min:3',
        ]);

        $comment = $masukkan->comments()->create([
            'user_id' => Auth::id(),
            'content' => $validated['content'],
        ]);

        return response()->json([
            'success' => true,
            'comment' => $comment->load('user'),
            'count' => $masukkan->comments()->count()
        ]);
    }

    /**
     * Store reply to comment
     */
    public function reply(Request $request, Masukkan $masukkan, $commentId)
    {
        $comment = $masukkan->comments()->findOrFail($commentId);

        $validated = $request->validate([
            'content' => 'required|string|max:1000|min:3',
        ]);

        $reply = $comment->replies()->create([
            'user_id' => Auth::id(),
            'content' => $validated['content'],
        ]);

        return response()->json([
            'success' => true,
            'reply' => $reply->load('user'),
            'count' => $masukkan->comments()->count()
        ]);
    }

    /**
     * Report masukkan
     */
    public function report(Request $request, Masukkan $masukkan)
    {
        $validated = $request->validate([
            'reason' => 'required|string|max:500',
            'type' => 'required|in:spam,tidak_sopan,duplikat,lainnya',
        ]);

        // Prevent duplicate reports
        $exists = Report::where('reportable_id', $masukkan->id)
            ->where('reportable_type', Masukkan::class)
            ->where('user_id', Auth::id())
            ->exists();

        if ($exists) {
            return response()->json(['error' => 'Anda sudah melaporkan ini'], 422);
        }

        Report::create([
            'reportable_id' => $masukkan->id,
            'reportable_type' => Masukkan::class,
            'user_id' => Auth::id(),
            'reason' => $validated['reason'],
            'type' => $validated['type'],
        ]);

        return response()->json(['success' => true, 'message' => 'Laporan berhasil dikirim!']);
    }

    /**
     * Share masukkan
     */
    public function share(Masukkan $masukkan)
    {
        $masukkan->increment('share_count');

        return response()->json([
            'success' => true,
            'share_url' => route('user.masukkan.show', $masukkan),
            'share_count' => $masukkan->fresh()->share_count
        ]);
    }

    /**
     * User's masukkan only
     */
    public function myMasukkan()
    {
        $stats = [
            'total' => Auth::user()->masukkans()->count(),
            'pending' => Auth::user()->masukkans()->where('status', 'pending')->count(),
            'approved' => Auth::user()->masukkans()->where('status', 'approved')->count(),
        ];

        $masukkans = Auth::user()->masukkans()
            ->withCount(['likes', 'comments'])
            ->with(['likes', 'comments.user'])
            ->latest()
            ->paginate(10);

        return view('user.masukkan.my', compact('stats', 'masukkans'));
    }
}
