<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class StatsController extends Controller
{
    public function getStatsDetail($type)
    {
        $data = match($type) {
            'users' => $this->getUsers(),
            'struktur' => $this->getStruktur(),
            'events' => $this->getEvents(),
            'acara' => $this->getAcara(),
            'kegiatan' => $this->getKegiatan(),
            'pendaftaran' => $this->getPendaftaran(),
            default => collect([])
        };

        return response()->json([
            'success' => true,
            'data' => $data,
            'count' => $data->count(),
            'type' => $type
        ]);
    }

    private function getUsers()
    {
        return User::select('id', 'name', 'email', 'created_at')
            ->latest()->take(10)->get()
            ->map(fn($u) => [
                'id' => $u->id,
                'name' => $u->name,
                'email' => $u->email,
                'jabatan' => $u->role ?? 'User',
                'created_at' => $u->created_at
            ]);
    }

    private function safeQuery($table, $select, $order = 'created_at')
    {
        try {
            return DB::table($table)
                ->select($select)
                ->orderBy($order, 'desc')
                ->take(10)
                ->get();
        } catch (\Exception $e) {
            return collect([]);
        }
    }

    private function getStruktur()
    {
        return $this->safeQuery('strukturs', [
            'id', 'nama as name', 'jabatan', 'email', 'created_at'
        ]);
    }

    private function getEvents()
    {
        return $this->safeQuery('events', [
            'id', 'nama_acara as name', 'lokasi as jabatan', 'tanggal_mulai as created_at'
        ]);
    }

    private function getAcara()
    {
        return $this->safeQuery('acaras', [
            'id', 'title as name', 'status as jabatan', 'tanggal as created_at'
        ]);
    }

    private function getKegiatan()
    {
        return $this->safeQuery('kegiatans', [
            'id', 'nama as name', 'status as jabatan', 'tanggal as created_at'
        ]);
    }

    private function getPendaftaran()
    {
        return $this->safeQuery('pendaftarans', [
            'id', 'nama as name', 'email', 'status as jabatan', 'created_at'
        ]);
    }
}
