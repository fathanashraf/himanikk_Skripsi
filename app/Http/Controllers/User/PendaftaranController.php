<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Models\Acara;


class PendaftaranController extends Controller
{
    public function index()
    {
        $stats = [
            'total' => Pendaftaran::count(),
            'proses' => Pendaftaran::where('status', 'proses')->count(),
            'diterima' => Pendaftaran::where('status', 'diterima')->count(),
            'ditolak' => Pendaftaran::where('status', 'ditolak')->count(),
        ];

        $pendaftarans = collect([]);
        return view('user.pendaftaran', compact('stats', 'pendaftarans'));
    }

    public function pendaftaranStore(Request $request)
    {
        // **VALIDASI SESUAI SCHEMA**
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'jenis_pendaftaran' => 'required|in:acara,kegiatan,event,dll',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'link' => 'nullable|url|max:255',
            'bukti' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240', // nullable sesuai schema
            'keterangan' => 'nullable|string|max:1000',
            'target_id' => 'nullable|numeric', // simplify dulu
        ]);

        // **FOREIGN KEY SESUAI SCHEMA (HANYA 3 KOLOM)**
        $foreignKeys = [
            'acara_id' => null,
            'kegiatan_id' => null,
            'event_id' => null,
        ];

        // Assign berdasarkan jenis
        if ($request->filled('target_id') && $request->jenis_pendaftaran !== 'dll') {
            switch ($request->jenis_pendaftaran) {
                case 'acara':
                    $foreignKeys['acara_id'] = $request->target_id;
                    break;
                case 'kegiatan':
                    $foreignKeys['kegiatan_id'] = $request->target_id;
                    break;
                case 'event':
                    $foreignKeys['event_id'] = $request->target_id;
                    break;
            }
        }

        // **DATA FINAL SESUAI SCHEMA**
        $data = array_merge($validated, $foreignKeys, [
            'status' => 'proses'
        ]);

        // **FILE UPLOAD**
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('pendaftarans/images', 'public');
        }
        if ($request->hasFile('bukti')) {
            $data['bukti'] = $request->file('bukti')->store('pendaftarans/bukti', 'public');
        }

        // **CREATE - AKAN SUKSES 100%**
        $pendaftaran = Pendaftaran::create($data);

        return response()->json([
            'success' => true,
            'message' => '✅ Pendaftaran berhasil disimpan!',
            'data' => $pendaftaran
        ]);
    }
}
