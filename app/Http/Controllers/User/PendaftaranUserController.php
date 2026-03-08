<?php

namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use App\Models\Acara;
use App\Models\Kegiatan;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use App\Models\Event;

class PendaftaranUserController extends Controller
{
        public function index(Request $request)
    {
        $pendaftarans = Pendaftaran::query()
            ->where('user_id', Auth::id())
            ->with(['event', 'status'])
            ->with(['acara','status'])
            ->with(['kegiatan', 'status']) // Eager load relationships
            ->latest()
            ->paginate(9); // 3x3 grid per page

        return view('user.pendaftaran.index', compact('pendaftarans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Kegiatan $kegiatan, Event $event, Acara $acara)
    {
        $events = Event::where('status', true)
            ->where('created_at', '<=', now())
            ->orderBy('name')
            ->get();

        return view('user.pendaftaran.create', compact('events'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_id' => ['required', 'exists:events,id'],
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'no_telepon' => ['required', 'string', 'max:20'],
            'nim' => ['required', 'string', 'max:20'],
            'prodi' => ['required', 'string', 'max:100'],
            'angkatan' => ['required', 'integer', 'min:2010', 'max:' . (now()->year + 1)],
            'alamat' => ['nullable', 'string'],
            'ukuran_seragam' => ['nullable', Rule::in(['S', 'M', 'L', 'XL', 'XXL'])],
        ]);

        // Check if already registered for this event
        if (Pendaftaran::where('event_id', $validated['event_id'])
                ->where('user_id', Auth::id())
                ->exists()) {
            return back()->withErrors(['event_id' => 'Anda sudah terdaftar di event ini!'])->onlyInput();
        }

        $pendaftaran = Pendaftaran::create(array_merge($validated, [
            'user_id' => Auth::id(),
            'status' => 'pending',
            'nomor_pendaftaran' => 'HIMANI-' . now()->format('Ymd') . '-' . strtoupper(substr(Auth::user()->name, 0, 3)) . rand(100, 999),
        ]));

        // Kirim notifikasi (Opsional)
        // Notification::send(Auth::user(), new PendaftaranCreated($pendaftaran));

        return redirect()->route('user.pendaftaran.index')
            ->with('success', 'Pendaftaran berhasil dibuat! Tunggu konfirmasi admin dalam 24 jam.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pendaftaran $pendaftaran)
    {
        Gate::authorize('view', $pendaftaran);

        $pendaftaran->load(['event', 'user', 'status']);

        return view('user.pendaftaran.show', compact('pendaftaran'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pendaftaran $pendaftaran)
    {
        Gate::authorize('update', $pendaftaran);

        return view('user.pendaftaran.edit', compact('pendaftaran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pendaftaran $pendaftaran)
    {
        Gate::authorize('update', $pendaftaran);

        $validated = $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'no_telepon' => ['required', 'string', 'max:20'],
            'nim' => ['required', 'string', 'max:20'],
            'prodi' => ['required', 'string', 'max:100'],
            'angkatan' => ['required', 'integer', 'min:2010', 'max:' . (now()->year + 1)],
            'alamat' => ['nullable', 'string'],
            'ukuran_seragam' => ['nullable', Rule::in(['S', 'M', 'L', 'XL', 'XXL'])],
        ]);

        $pendaftaran->update($validated);

        return redirect()->route('user.pendaftaran.show', $pendaftaran)
            ->with('success', 'Data pendaftaran berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pendaftaran $pendaftaran)
    {
        Gate::authorize('delete', $pendaftaran);

        $pendaftaran->delete();

        return redirect()->route('user.pendaftaran.index')
            ->with('success', 'Pendaftaran berhasil dihapus!');
    }

    /**
     * Cancel pendaftaran (soft delete atau status cancelled)
     */
    public function cancel(Pendaftaran $pendaftaran)
    {
        Gate::authorize('update', $pendaftaran);

        if (in_array($pendaftaran->status, ['approved', 'completed'])) {
            return back()->withErrors(['status' => 'Tidak bisa dibatalkan setelah disetujui!']);
        }

        $pendaftaran->update(['status' => 'cancelled']);

        return redirect()->route('user.pendaftaran.index')
            ->with('success', 'Pendaftaran berhasil dibatalkan.');
    }
}
