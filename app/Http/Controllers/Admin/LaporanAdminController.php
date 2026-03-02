<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;

class LaporanAdminController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $tipe = $request->get('tipe');
        $status = $request->get('status'); // ✅ NEW FILTER

        $laporans = Laporan::query()
            ->when($search, fn($q) => $q->search($search))
            ->when($tipe, fn($q) => $q->tipe($tipe))
            ->when($status, fn($q) => $q->status($status)) // ✅ NEW
            ->latest()
            ->paginate(10);

        $stats = [
            'total' => Laporan::count(),
            'proposal' => Laporan::where('tipe', 'proposal')->count(),
            'lpj' => Laporan::where('tipe', 'lpj')->count(),
            'pending' => Laporan::where('status', 'pending')->count(),
            'approved' => Laporan::where('status', 'approved')->count(),
            'rejected' => Laporan::where('status', 'rejected')->count(),
        ];

        return view('admin.laporan.index', compact(
            'laporans', 'stats', 'search', 'tipe', 'status'
        ));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nama' => 'required|string|max:255',
                'tipe' => ['required', Rule::in(['proposal', 'lpj'])],
                'status' => ['required', Rule::in(['pending', 'approved', 'rejected'])], // ✅ NEW
                'file' => 'required|file|mimes:pdf,doc,docx|max:5120',
            ]);

            if ($request->hasFile('file')) {
                $validated['file'] = $request->file('file')->store('laporans', 'public');
            }

            Laporan::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Laporan berhasil ditambahkan!'
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Store laporan failed', ['error' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'Server error'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $laporan = Laporan::findOrFail($id);

            $validated = $request->validate([
                'nama' => 'required|string|max:255',
                'tipe' => ['required', Rule::in(['proposal', 'lpj'])],
                'status' => ['required', Rule::in(['pending', 'approved', 'rejected'])], // ✅ NEW
                'file' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            ]);

            if ($request->hasFile('file')) {
                if ($laporan->file) {
                    Storage::disk('public')->delete($laporan->file);
                }
                $validated['file'] = $request->file('file')->store('laporans', 'public');
            }

            $laporan->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Laporan berhasil diperbarui!'
            ]);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Update gagal'], 500);
        }
    }

        public function destroy($id)
        {
            try {
                $laporan = Laporan::findOrFail($id);
    
                if ($laporan->file) {
                    Storage::disk('public')->delete($laporan->file);
                }
    
                $laporan->delete();
    
                return response()->json([
                    'success' => true,
                    'message' => 'Laporan berhasil dihapus!'
                ]);
    
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'message' => 'Delete gagal'], 500);
            }
        }

    public function download(Laporan $laporan)
    {
        if ($laporan->file) {
            return Storage::disk('public')->download($laporan->file);
        } else {
            return response()->json(['message' => 'Laporan tidak memiliki file'], 404);
        }
    }
}
