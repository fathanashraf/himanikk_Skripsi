<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\User;
use App\Models\Kegiatan;
use App\Models\Event;
use App\Models\Acara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PendaftaranAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $status = $request->get('status');
        $jenisPendaftaran = $request->get('jenis_pendaftaran');

        $query = Pendaftaran::with(['user', 'kegiatan', 'events', 'acara'])
            ->latest('created_at');

        // ✅ FIX 1: Search scope (implement manual)
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('keterangan', 'like', "%{$search}%");
            })
            ->orWhereHas('user', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // ✅ FIX 2: Status filter
        if ($status && in_array($status, ['proses', 'diterima', 'ditolak'])) {
            $query->where('status', $status);
        }

        // ✅ FIX 3: Jenis pendaftaran filter
        if ($jenisPendaftaran && in_array($jenisPendaftaran, ['acara', 'kegiatan', 'events'])) {
            if ($jenisPendaftaran === 'acara') {
                $query->whereNotNull('acara_id');
            } elseif ($jenisPendaftaran === 'kegiatan') {
                $query->whereNotNull('kegiatan_id');
            } elseif ($jenisPendaftaran === 'events') {
                $query->whereNotNull('event_id');
            }
        }

        $pendaftarans = $query->paginate(15)->appends($request->only(['search', 'status', 'jenis_pendaftaran']));

        // ✅ FIX 4: Statistik (gunakan query builder)
        $stats = [
            'total' => Pendaftaran::count(),
            'proses' => Pendaftaran::where('status', 'proses')->count(),
            'diterima' => Pendaftaran::where('status', 'diterima')->count(),
            'ditolak' => Pendaftaran::where('status', 'ditolak')->count(),
            'dengan_bukti' => Pendaftaran::whereNotNull('bukti')->count(),
        ];

        // ✅ Data untuk modals (optimized dengan limit)
        $users = User::select('id', 'name', 'email')
            ->orderBy('name')
            ->limit(100) // Hindari loading terlalu banyak
            ->get();

        $acaras = Acara::select('id', 'name')
            ->orderBy('name')
            ->get();

        $kegiatans = Kegiatan::select('id', 'name')
            ->orderBy('name')
            ->get();

        $events = Event::select('id', 'name')
            ->orderBy('name')
            ->get();

        return view('admin.pendaftaran.index', compact(
            'pendaftarans',
            'stats',
            'search',
            'status',
            'jenisPendaftaran',
            'users',
            'acaras',
            'kegiatans',
            'events'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'status' => ['required', Rule::in(['proses', 'diterima', 'ditolak'])],
            'user_id' => 'nullable|exists:users,id',
            'kegiatan_id' => 'nullable|exists:kegiatans,id',
            'event_id' => 'nullable|exists:events,id',
            'acara_id' => 'nullable|exists:acaras,id',
            'image' => 'nullable|image|max:5120', // 5MB
            'bukti' => 'nullable|mimes:jpg,jpeg,png,pdf|max:5120',
            'link' => 'nullable|url|max:500',
            'keterangan' => 'nullable|string|max:500',
        ]);

        // Handle file uploads
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('pendaftaran/images', 'public');
        }

        if ($request->hasFile('bukti')) {
            $validated['bukti'] = $request->file('bukti')->store('pendaftaran/bukti', 'public');
        }

        Pendaftaran::create($validated);

        return response()->json([
            'message' => 'Pendaftaran berhasil ditambahkan!',
            'success' => true
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pendaftaran $pendaftaran)
    {
        $pendaftaran->load(['user', 'kegiatan', 'event', 'acara']);
        return response()->json($pendaftaran);
    }

    /**
     * Update the specified resource in storage (AJAX).
     */
    public function update(Request $request, Pendaftaran $pendaftaran)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'status' => ['required', Rule::in(['proses', 'diterima', 'ditolak'])],
            'user_id' => 'nullable|exists:users,id',
            'kegiatan_id' => 'nullable|exists:kegiatans,id',
            'event_id' => 'nullable|exists:events,id',
            'acara_id' => 'nullable|exists:acaras,id',
            'image' => 'nullable|image|max:5120',
            'bukti' => 'nullable|mimes:jpg,jpeg,png,pdf|max:5120',
            'link' => 'nullable|url|max:500',
            'keterangan' => 'nullable|string|max:500',
        ]);

        // Handle file uploads (replace existing)
        if ($request->hasFile('image')) {
            // Delete old image
            if ($pendaftaran->image) {
                Storage::disk('public')->delete($pendaftaran->image);
            }
            $validated['image'] = $request->file('image')->store('pendaftaran/images', 'public');
        }

        if ($request->hasFile('bukti')) {
            // Delete old bukti
            if ($pendaftaran->bukti) {
                Storage::disk('public')->delete($pendaftaran->bukti);
            }
            $validated['bukti'] = $request->file('bukti')->store('pendaftaran/bukti', 'public');
        }

        $pendaftaran->update($validated);

        return response()->json([
            'message' => 'Pendaftaran berhasil diupdate!',
            'success' => true
        ]);
    }

    /**
     * Remove the specified resource from storage (AJAX).
     */
    public function destroy(Pendaftaran $pendaftaran)
    {
        // Delete associated files
        if ($pendaftaran->image) {
            Storage::disk('public')->delete($pendaftaran->image);
        }
        if ($pendaftaran->bukti) {
            Storage::disk('public')->delete($pendaftaran->bukti);
        }

        $pendaftaran->delete();

        return response()->json([
            'message' => 'Pendaftaran berhasil dihapus!',
            'success' => true
        ]);
    }

    /**
     * Bulk update status (bonus feature)
     */
    public function bulkUpdateStatus(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:pendaftarans,id',
            'status' => ['required', Rule::in(['proses', 'diterima', 'ditolak'])],
        ]);

        Pendaftaran::whereIn('id', $validated['ids'])
            ->update(['status' => $validated['status']]);

        $statusLabel = match($validated['status']) {
            'diterima' => 'diterima',
            'ditolak' => 'ditolak',
            default => 'diproses'
        };

        return response()->json([
            'message' => "Berhasil update " . count($validated['ids']) . " pendaftaran menjadi {$statusLabel}!",
            'success' => true
        ]);
    }

    /**
     * Export data (bonus)
     */
    public function export(Request $request)
    {
        $query = Pendaftaran::with(['user', 'kegiatan', 'event', 'acara']);

        // Apply same filters as index
        if ($request->search) {
            $query->search($request->search);
        }
        if ($request->status) {
            $query->status($request->status);
        }

        $pendaftarans = $query->get();

        // Generate CSV or Excel
        $csv = fopen('php://temp', 'r+');
        fputcsv($csv, ['Nama', 'Email', 'Phone', 'Status', 'Jenis', 'Created At']);

        foreach ($pendaftarans as $p) {
            fputcsv($csv, [
                $p->name,
                $p->email,
                $p->phone,
                $p->status_label,
                $p->jenis_label,
                $p->created_at->format('d/m/Y H:i')
            ]);
        }

        rewind($csv);
        $content = stream_get_contents($csv);

        return response($content, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="pendaftaran_' . now()->format('Y-m-d') . '.csv"'
        ]);
    }
}
