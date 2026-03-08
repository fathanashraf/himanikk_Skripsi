<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class KegiatanUserController extends Controller
{
    public function index(Request $request)
{
    $search = $request->get('search');
    $status = $request->get('status');
    $dateFrom = $request->get('dateFrom');
    $dateTo = $request->get('dateTo');

    $kegiatans = Kegiatan::with(['user'])
        ->withCount('pendaftars as pendaftars_count') // ✅ FIX ERROR
        ->when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                         ->orWhere('description', 'like', "%{$search}%");
        })
        ->when($status, fn($q, $s) => $q->where('status', $status))
        ->when($dateFrom, fn($q, $d) => $q->whereDate('tanggal', '>=', $d))
        ->when($dateTo, fn($q, $d) => $q->whereDate('tanggal', '<=', $d))
        ->latest('tanggal')
        ->paginate(12);

    return view('user.kegiatan.index', compact('kegiatans', 'search', 'status', 'dateFrom', 'dateTo'));
}

    public function show(Kegiatan $kegiatan)
        {
    // EAGER LOAD otomatis ambil user
            $kegiatan->load('user');
            return view('user.kegiatan.show', compact('kegiatan'));
        }

    public function pendaftaran(Kegiatan $kegiatan)
    {
        $kegiatan->load('user');
        return view('user.kegiatan.pendaftaran',$kegiatan , compact('kegiatan'));
    }

    public function storePendaftaran(Request $request, Kegiatan $kegiatan)
    {
        $kegiatan->pendaftars()->create($request->all());
        return redirect()->route('user.kegiatan.index')->with('success', 'Pendaftaran berhasil!');
    }
}
