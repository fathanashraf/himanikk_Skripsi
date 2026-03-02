<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\Profil;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;
use App\Models\Acara;
use App\Models\Kegiatan;
use App\Models\Struktur;
use App\Models\Laporan;
use App\Models\Pembayaran;
use App\Models\Keuangan;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class DashboardAdminController extends Controller
{
    public function index()
    {
        // 📊 STATS LENGKAP DARI DATABASE
        $stats = [
            // Stats utama untuk cards
            'total_users' => User::count(),
            'total_events' => Event::count(),
            'total_acara' => Acara::count(),
            'total_struktur' => Struktur::whereNotNull('id')->count(),
            'total_kegiatan' => Kegiatan::whereNotNull('name')->count(),
            'total_Pendaftaran' => Pendaftaran::count(),
            
            // Stats tambahan untuk detail
            'admin_count' => User::where('role', 'admin')->count(),
            'struktur_count' => Struktur::where('jabatan', 'like', '%Pengurus%')->count(),
            'anggota_count' => User::where('role', 'anggota')->count(),
            'active_monthly' => User::where('created_at', '>=', now()->subMonth())->count(),
            'ketua_count' => Struktur::where('jabatan', 'like', '%Ketua%')->count(),
            'sekretaris_count' => Struktur::where('jabatan', 'like', '%Sekretaris%')->count(),
            'bendahara_count' => Struktur::where('jabatan', 'like', '%Bendahara%')->count(),
            'program_count' => Struktur::where('jabatan', 'like', '%Program%')->count(),
            'kegiatan_jadwal' => Kegiatan::where('status', 'terjadwal')->count(),
            'kegiatan_berlangsung' => Kegiatan::where('status', 'berlangsung')->count(),
            'kegiatan_selesai' => Kegiatan::where('status', 'selesai')->count(),
            'pendaftaran_verifikasi' => Pendaftaran::where('status', 'terverifikasi')->count(),
            'pendaftaran_menunggu' => Pendaftaran::where('status', 'menunggu')->count(),
            'pendaftaran_batal' => Pendaftaran::where('status', 'dibatalkan')->count(),
        ];

        // 🔥 RECENT ACTIVITIES - SORTED & LIMITED
        $recentActivities = collect();

        // 1. USER baru
        $recentUsers = User::latest('created_at')->limit(2)->get()->map(function ($user) {
            return [
                'id' => "user_{$user->id}",
                'icon' => 'mdi:account-plus',
                'color' => 'emerald',
                'title' => "{$user->name} bergabung",
                'subtitle' => 'Pendaftaran anggota baru',
                'time' => $user->created_at->diffForHumans(),
                'status' => 'Baru',
                'details' => 'User terdaftar melalui form online',
                'created_at' => $user->created_at
            ];
        });
        $recentActivities = $recentActivities->concat($recentUsers);

        // 2. KEUANGAN terbaru
        $recentKeuangan = Keuangan::latest('created_at')->limit(2)->get()->map(function ($k) {
            return [
                'id' => "keuangan_{$k->id}",
                'icon' => $k->tipe === 'proposal' ? 'mdi:file-document' : 'mdi:clipboard-check',
                'color' => $k->status === 'approved' ? 'emerald' : 'amber',
                'title' => $k->nama,
                'subtitle' => ucfirst($k->tipe),
                'time' => $k->created_at->diffForHumans(),
                'status' => ucfirst($k->status),
                'details' => "Dokumen {$k->tipe} keuangan",
                'created_at' => $k->created_at
            ];
        });
        $recentActivities = $recentActivities->concat($recentKeuangan);

        // 3. EVENT
        $recentEvents = Event::latest('created_at')->limit(1)->get()->map(function ($event) {
            return [
                'id' => "event_{$event->id}",
                'icon' => 'mdi:calendar-check',
                'color' => 'blue',
                'title' => $event->title ?? $event->name ?? 'Event baru',
                'subtitle' => 'Event',
                'time' => $event->created_at->diffForHumans(),
                'status' => 'Dijadwalkan',
                'details' => Str::limit($event->description ?? 'Kegiatan organisasi HIMANIKKA', 40),
                'created_at' => $event->created_at
            ];
        });
        $recentActivities = $recentActivities->concat($recentEvents);

        // 4. ACARA
        $recentAcara = Acara::latest('created_at')->limit(1)->get()->map(function ($acara) {
            return [
                'id' => "acara_{$acara->id}",
                'icon' => 'mdi:party-popper',
                'color' => 'purple',
                'title' => $acara->nama_acara ?? 'Acara baru',
                'subtitle' => 'Acara',
                'time' => $acara->created_at->diffForHumans(),
                'status' => 'Terjadwal',
                'details' => Str::limit($acara->deskripsi ?? '', 40),
                'created_at' => $acara->created_at
            ];
        });
        $recentActivities = $recentActivities->concat($recentAcara);

        // 5. KEGIATAN
        $recentKegiatan = Kegiatan::latest('created_at')->limit(1)->get()->map(function ($kegiatan) {
            return [
                'id' => "kegiatan_{$kegiatan->id}",
                'icon' => 'mdi:flash',
                'color' => 'indigo',
                'title' => $kegiatan->name ?? 'Kegiatan baru',
                'subtitle' => 'Kegiatan',
                'time' => $kegiatan->created_at->diffForHumans(),
                'status' => ucfirst($kegiatan->status ?? 'draft'),
                'details' => Str::limit($kegiatan->description ?? '', 40),
                'created_at' => $kegiatan->created_at
            ];
        });
        $recentActivities = $recentActivities->concat($recentKegiatan);

        // 6. LAPORAN
        $recentLaporan = Laporan::latest('created_at')->limit(1)->get()->map(function ($l) {
            return [
                'id' => "laporan_{$l->id}",
                'icon' => 'mdi:file-document',
                'color' => 'purple',
                'title' => $l->title ?? 'Laporan kegiatan',
                'subtitle' => 'Laporan resmi',
                'time' => $l->created_at->diffForHumans(),
                'status' => 'Diajukan',
                'details' => 'Laporan kegiatan organisasi',
                'created_at' => $l->created_at
            ];
        });
        $recentActivities = $recentActivities->concat($recentLaporan);

        // 7. PEMBAYARAN
        $recentPembayaran = Pembayaran::latest('created_at')->with('user')->limit(2)->get()->map(function ($p) {
            return [
                'id' => "pembayaran_{$p->id}",
                'icon' => 'mdi:credit-card-check',
                'color' => 'green',
                'title' => 'Pembayaran iuran ' . ($p->user?->name ?? 'anggota'),
                'subtitle' => 'Iuran bulanan',
                'time' => $p->created_at->diffForHumans(),
                'status' => 'Lunas',
                'details' => 'Pembayaran berhasil diproses',
                'created_at' => $p->created_at
            ];
        });
        $recentActivities = $recentActivities->concat($recentPembayaran);

        // 8. PENDAFTARAN
        $recentPendaftaran = Pendaftaran::latest('created_at')->with('users')->limit(2)->get()->map(function ($p) {
            return [
                'id' => "pendaftaran_{$p->id}",
                'icon' => 'mdi:clipboard-list',
                'color' => 'orange',
                'title' => ($p->user?->name ?? $p->nama ?? 'Anggota') . ' mendaftar kegiatan',
                'subtitle' => 'Pendaftaran event',
                'time' => $p->created_at->diffForHumans(),
                'status' => ucfirst($p->status ?? 'pending'),
                'details' => 'Peserta baru terdaftar',
                'created_at' => $p->created_at
            ];
        });
        $recentActivities = $recentActivities->concat($recentPendaftaran);

        // 9. STRUKTUR ORGANISASI
        $recentStruktur = Struktur::latest('created_at')->limit(1)->get()->map(function ($s) {
            return [
                'id' => "struktur_{$s->id}",
                'icon' => 'mdi:account-group',
                'color' => 'red',
                'title' => "{$s->nama} ditambahkan",
                'subtitle' => $s->jabatan ?? 'Struktur organisasi',
                'time' => $s->created_at->diffForHumans(),
                'status' => 'Aktif',
                'details' => 'Struktur organisasi baru',
                'created_at' => $s->created_at
            ];
        });
        $recentActivities = $recentActivities->concat($recentStruktur);

        // 10. PROFIL
        $recentProfil = Profil::latest('updated_at')->limit(1)->get()->map(function ($p) {
            return [
                'id' => "profil_{$p->id}",
                'icon' => 'mdi:account-edit',
                'color' => 'teal',
                'title' => 'Profil organisasi diperbarui',
                'subtitle' => 'Profil HIMANIKKA',
                'time' => $p->updated_at->diffForHumans(),
                'status' => 'Diperbarui',
                'details' => 'Informasi profil organisasi diperbarui',
                'created_at' => $p->updated_at
            ];
        });
        $recentActivities = $recentActivities->concat($recentProfil);

        // 🔥 SORTING & LIMIT 10 TERAKHIR
        $recentActivities = $recentActivities
            ->sortByDesc('created_at')
            ->take(10)
            ->values()
            ->toArray();

        // 📈 CHART DATA REAL DARI DATABASE
        $chartData = [
            'kegiatan_labels' => [],
            'kegiatan_data' => [],
            'keuangan_labels' => [],
            'pendapatan_data' => [],
            'pengeluaran_data' => []
        ];

        // Kegiatan 7 bulan terakhir
        $kegiatanMonthly = Kegiatan::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
        foreach ($months as $month) {
            $monthNum = array_search($month, $months) + 1;
            $chartData['kegiatan_labels'][] = $month;
            $chartData['kegiatan_data'][] = $kegiatanMonthly[$monthNum] ?? 0;
        }

        // Keuangan per bulan
        $keuanganMonthly = Keuangan::selectRaw('
                MONTH(created_at) as month, 
                SUM(CASE WHEN jenis="pendapatan" THEN nominal ELSE 0 END) as pendapatan, 
                SUM(CASE WHEN jenis="pengeluaran" THEN nominal ELSE 0 END) as pengeluaran
            ')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        foreach ($months as $month) {
            $monthNum = array_search($month, $months) + 1;
            $keuangan = $keuanganMonthly->where('month', $monthNum)->first();
            $chartData['keuangan_labels'][] = $month;
            $chartData['pendapatan_data'][] = $keuangan->pendapatan ?? 0;
            $chartData['pengeluaran_data'][] = $keuangan->pengeluaran ?? 0;
        }

        return view('admin.dashboard.index', compact('stats', 'recentActivities', 'chartData'));
    }

    /**
     * 🔥 MODAL STATS API - SESUAI DENGAN FRONTEND
     */
    public function getStatsDetail($type)
    {
        try {
            $limit = 12;
            $data = match(strtolower($type)) {
                'users' => User::select('id', 'name', 'email', 'created_at', 'role')->latest()->limit($limit)->get(),
                'strukturs' => Struktur::select('id', 'nama', 'jabatan', 'email', 'created_at')->latest()->limit($limit)->get(),
                'events' => Event::select('id', 'title', 'description', 'status', 'start_date', 'created_at')->latest()->limit($limit)->get(),
                'acara' => Acara::select('id', 'nama_acara', 'deskripsi', 'tanggal_mulai', 'status', 'created_at')->latest()->limit($limit)->get(),
                'kegiatan' => Kegiatan::select('id', 'name', 'description', 'status', 'created_at')->where('status', 'berlangsung')->latest()->limit($limit)->get(),
                'pendaftaran' => Pendaftaran::select('id', 'nama', 'email', 'status', 'created_at')->where('status', 'menunggu')->latest()->limit($limit)->get(),
                default => collect([])
            };

            return response()->json([
                'success' => true,
                'data' => $data,
                'total' => $data->count()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Notifikasi handler (jika diperlukan)
     */
    public function markRead($notificationId)
    {
        try {
            $notification = auth()->user()->notifications()->findOrFail($notificationId);
            $notification->markAsRead();
            
            return response()->json([
                'success' => true,
                'message' => 'Notifikasi dibaca'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal membaca notifikasi'
            ], 404);
        }
    }
}
