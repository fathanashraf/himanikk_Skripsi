<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Masukkan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class MasukkanAdminController extends Controller
{
    

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Masukkan::with('user')
            ->latest()
            ->select('id', 'user_id', 'tipe', 'created_at');

        // Filter by tipe
        if ($request->filled('tipe')) {
            $query->where('tipe', $request->tipe);
        }

        // Search by user name or email
        if ($request->filled('search')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $masukkans = $query->paginate(15)->appends($request->query());

        $stats = [
            'total' => Masukkan::count(),
            'kritik' => Masukkan::kritik()->count(),
            'saran' => Masukkan::saran()->count(),
            'like' => Masukkan::like()->count(),
            'dislike' => Masukkan::dislike()->count(),
        ];

        return view('admin.masukan.index', compact('masukkans', 'stats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'tipe' => 'required|in:kritik,saran,like,dislike',
        ]);

        $masukkan = Masukkan::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Masukkan berhasil ditambahkan!',
            'data' => $masukkan->load('user')
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Masukkan $masukkan): View
    {
        $masukkan->load('user');

        return view('admin.masukkans.show', compact('masukkan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Masukkan $masukkan): JsonResponse
    {
        $validated = $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'tipe' => 'required|in:kritik,saran,like,dislike',
        ]);

        $masukkan->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Masukkan berhasil diupdate!',
            'data' => $masukkan->fresh()->load('user')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Masukkan $masukkan): JsonResponse
    {
        $masukkan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Masukkan berhasil dihapus!'
        ]);
    }
}
