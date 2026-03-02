<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Struktur;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;

class StrukturAdminController extends Controller
{
    /**
     * Display a listing of the resource with search & filters.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $jabatan = $request->get('jabatan');
        $departemen = $request->get('departemen');

        $strukturs = Struktur::with('user')
            ->when($search, function ($query, $search) {
                return $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->when($jabatan, function ($query, $jabatan) {
                return $query->where('jabatan', $jabatan);
            })
            ->when($departemen, function ($query, $departemen) {
                return $query->where('departemen', $departemen);
            })
            ->latest()
            ->paginate(10); // ✅ Pagination untuk performa

        // Stats untuk cards
        $allStrukturs = Struktur::with('user')->get();
        $stats = [
            'total' => $allStrukturs->count(),
            'kahim' => $allStrukturs->where('jabatan', 'kahim')->count(),
            'departemen_count' => $allStrukturs->whereNotNull('departemen')->unique('departemen')->count(),
            'with_avatar' => $allStrukturs->whereNotNull('avatar')->count(),
        ];

        // Users yang BELUM punya struktur (untuk dropdown create)
        $users = User::whereDoesntHave('struktur')
                    ->orderBy('name')
                    ->get(['id', 'name', 'email']);

        return view('admin.struktur.index', compact('strukturs', 'stats', 'users', 'search', 'jabatan', 'departemen'));
    }

    /**
     * Store a newly created resource in storage (AJAX).
     */
    public function store(Request $request)
    {
        try {
            Log::info('Store struktur request', $request->all());

            $validated = $request->validate([
                'user_id' => [
                    'required',
                    'exists:users,id',
                    Rule::unique('strukturs')->where(function ($query) use ($request) {
                        return $query->where('user_id', $request->user_id);
                    })
                ],
                'jabatan' => ['required', Rule::in(['kahim', 'wakahim', 'sekretaris', 'bendahara'])],
                'posisi' => ['nullable', Rule::in(['koordinator', 'anggota'])],
                'departemen' => ['nullable', Rule::in(['kwu', 'minatbakat', 'pemberdaya_wanita', 'humas'])],
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            ]);

            // Upload avatar
            if ($request->hasFile('avatar')) {
                $validated['avatar'] = $request->file('avatar')->store('avatars/struktur', 'public');
            }

            Struktur::create($validated);

            Log::info('Struktur created successfully', $validated);

            return response()->json([
                'success' => true,
                'message' => 'Pengurus HIMANIKKA berhasil ditambahkan!'
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed', ['errors' => $e->errors()]);
            return response()->json([
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Store failed', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan server'
            ], 500);
        }
    }

    /**
     * Display the specified resource (AJAX untuk edit modal).
     */
    public function edit(Struktur $struktur)
    {
        $struktur->load('user');
        
        return response()->json([
            'id' => $struktur->id,
            'user_id' => $struktur->user_id,
            'jabatan' => $struktur->jabatan,
            'posisi' => $struktur->posisi,
            'departemen' => $struktur->departemen,
            'avatar' => $struktur->avatar,
            'user' => [
                'id' => $struktur->user->id ?? null,
                'name' => $struktur->user->name ?? '',
                'email' => $struktur->user->email ?? ''
            ]
        ]);
    }

    /**
     * Update the specified resource in storage (AJAX).
     */
    public function update(Request $request, Struktur $struktur)
    {
        try {
            $validated = $request->validate([
                'user_id' => [
                    'required',
                    'exists:users,id',
                    Rule::unique('strukturs', 'user_id')->ignore($struktur->id)
                ],
                'jabatan' => ['required', Rule::in(['kahim', 'wakahim', 'sekretaris', 'bendahara'])],
                'posisi' => ['nullable', Rule::in(['koordinator', 'anggota'])],
                'departemen' => ['nullable', Rule::in(['kwu', 'minatbakat', 'pemberdaya_wanita', 'humas'])],
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            ]);

            // Handle avatar update
            if ($request->hasFile('avatar')) {
                // Delete old avatar
                if ($struktur->avatar) {
                    Storage::disk('public')->delete($struktur->avatar);
                }
                $validated['avatar'] = $request->file('avatar')->store('avatars/struktur', 'public');
            }

            $struktur->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Data pengurus berhasil diperbarui!'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Update failed', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Update gagal: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage (AJAX).
     */
    public function destroy($id)
{
    try {
        // Pastikan struktur exists
        $struktur = Struktur::find($id);
        if (!$struktur) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        // Delete avatar jika ada
        if ($struktur->avatar) {
            if (Storage::disk('public')->exists($struktur->avatar)) {
                Storage::disk('public')->delete($struktur->avatar);
            }
        }

        // Delete struktur
        $struktur->delete();

        Log::info('Struktur deleted successfully', ['id' => $struktur->id]);

        return response()->json([
            'success' => true,
            'message' => 'Pengurus berhasil dihapus!'
        ]);

    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        Log::warning('Struktur not found', ['id' => request()->route('struktur')]);
        return response()->json([
            'success' => false,
            'message' => 'Data tidak ditemukan'
        ], 404);
        
    } catch (\Exception $e) {
        Log::error('Delete struktur failed', [
            'id' => $struktur->id ?? 'unknown',
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
        
        return response()->json([
            'success' => false,
            'message' => 'Gagal menghapus data'
        ], 500);
    }
}


    /**
     * Get available users for dropdown (AJAX).
     */
    public function availableUsers()
    {
        $users = User::whereDoesntHave('struktur')
                    ->select('id', 'name', 'email')
                    ->orderBy('name')
                    ->get();

        return response()->json($users);
    }
}
