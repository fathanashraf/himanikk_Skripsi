<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Keuangan;
use Illuminate\Http\Request;

class KeuanganAdminController extends Controller
{
    public function index(Request $request)
{
    $search = $request->get('search');
    $jenis = $request->get('jenis');
    $type = $request->get('type');
    $tanggal = $request->get('tanggal');

    $query = Keuangan::with(['user', 'kegiatan', 'event', 'acara', 'pendaftaran'])
        ->latest('tanggal'); // Urutkan berdasarkan tanggal terbaru

    // 🔍 Filter Pencarian (nama & nominal)
    if ($search) {
        $query->where(function($q) use ($search) {
            $q->where('name', 'LIKE', "%{$search}%")
              ->orWhere('nominal', 'LIKE', "%{$search}%")
              ->orWhere('total', 'LIKE', "%{$search}%");
        });
    }

    // 🎯 Filter Jenis (pendapatan/pengeluaran)
    if ($jenis && in_array($jenis, ['pendapatan', 'pengeluaran'])) {
        $query->where('jenis', $jenis);
    }

    // 📋 Filter Type (pendapatan/bantuan/lainnya)
    if ($type && in_array($type, ['pendapatan', 'bantuan', 'lainnya'])) {
        $query->where('type', $type);
    }

    // 📅 Filter Tanggal (exact match)
    if ($tanggal) {
        $query->whereDate('tanggal', $tanggal);
    }

    // Pagination dengan preserve query string
    $keuangans = $query->paginate(10)->appends($request->only(['search', 'jenis', 'type', 'tanggal']));

    // 💰 Total Pendapatan & Pengeluaran (dengan filter yang sama)
    $totalPendapatan = (clone $query)->where('jenis', 'pendapatan')->sum('total');
    $totalPengeluaran = (clone $query)->where('jenis', 'pengeluaran')->sum('total');

    return view('admin.keuangan.index', compact(
        'keuangans', 
        'totalPendapatan', 
        'totalPengeluaran',
        'search',
        'jenis', 
        'type', 
        'tanggal'
    ));
}


    public function create()
    {
        return view('admin.keuangan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nominal' => 'required|numeric',
            'tanggal' => 'required|date',
            'type' => 'required|in:pendaftaran,bantuan,lainnya',
            'user_id' => 'required|exists:users,id',
            'kegiatan_id' => 'nullable|exists:kegiatans,id',
            'event_id' => 'nullable|exists:events,id',
            'acara_id' => 'nullable|exists:acaras,id',
            'pendaftaran_id' => 'nullable|exists:pendaftarans,id',
            'jenis' => 'required|in:pendapatan,pengeluaran',
            'total' => 'required|numeric',
            'keterangan' => 'nullable|string',
        ]);

        Keuangan::create($request->all());

        return redirect()->route('admin.keuangan.index')
            ->with('success', 'Data keuangan berhasil ditambahkan.');
    }

    public function show(Keuangan $keuangan)
    {
        return view('admin.keuangan.show', compact('keuangan'));
    }

    public function edit(Keuangan $keuangan)
    {
        return view('admin.keuangan.edit', compact('keuangan'));
    }

    public function update(Request $request, Keuangan $keuangan)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nominal' => 'required|numeric',
            'tanggal' => 'required|date',
            'user_id' => 'required|exists:users,id',
            'kegiatan_id' => 'nullable|exists:kegiatans,id',
            'event_id' => 'nullable|exists:events,id',
            'acara_id' => 'nullable|exists:acaras,id',
            'pendaftaran_id' => 'nullable|exists:pendaftarans,id',
            'jenis' => 'required|in:pendapatan,pengeluaran',
            'total' => 'required|numeric',
            'keterangan' => 'nullable|string',
        ]);

        $keuangan->update($request->all());

        return redirect()->route('admin.keuangan.index')
            ->with('success', 'Data keuangan berhasil diperbarui.');
    }

    // app/Http/Controllers/Admin/KeuanganController.php
public function destroy(Keuangan $keuangan)
{
    $keuangan->delete();
    
    return response()->json([
        'message' => 'Transaksi berhasil dihapus!'
    ]);
}

}
