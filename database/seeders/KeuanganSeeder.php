<?php

namespace Database\Seeders;

use App\Models\Keuangan;
use App\Models\User;
use App\Models\Kegiatan;
use App\Models\Event;
use App\Models\Acara;
use App\Models\Pendaftaran;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class KeuanganSeeder extends Seeder
{
    public function run()
    {
        // Pastikan ada data terkait dulu
        $this->seedDependencies();
        
        $users = User::pluck('id')->toArray();
        $kegiatans = Kegiatan::pluck('id')->toArray();
        $events = Event::pluck('id')->toArray();
        $acaras = Acara::pluck('id')->toArray();
        $pendaftarans = Pendaftaran::pluck('id')->toArray();

        // Tambah beberapa transaksi manual HIMANIKKA
        Keuangan::create([
            'name' => 'Iuran Anggota HIMANIKKA 2026',
            'nominal' => '500000',
            'tanggal' => '2026-01-15',
            'user_id' => $users[0] ?? 1,
            'kegiatan_id' => $kegiatans[0] ?? 1,
            'event_id' => null,
            'acara_id' => null,
            'pendaftaran_id' => null,
            'jenis' => 'pendapatan',
            'total' => '500000',
            'keterangan' => 'Iuran 50 anggota x Rp10.000'
        ]);

        Keuangan::create([
            'name' => 'Pembelian Banner Welcome HIMANIKKA',
            'nominal' => '350000',
            'tanggal' => '2026-01-20',
            'user_id' => $users[0] ?? 1,
            'kegiatan_id' => $kegiatans[0] ?? 1,
            'event_id' => null,
            'acara_id' => null,
            'pendaftaran_id' => null,
            'jenis' => 'pengeluaran',
            'total' => '350000',
            'keterangan' => 'Cetak banner 3x6m'
        ]);

        // Generate 50 transaksi random
        $transaksiData = [
            // PENDAPATAN
            ['Pendaftaran Workshop Laravel', 'pendapatan', 250000],
            ['Sponsor Logo HIMANIKKA', 'pendapatan', 2000000],
            ['Jual Merchandise Kaos', 'pendapatan', 75000],
            ['Donasi Event TechTalk', 'pendapatan', 150000],
            ['Biaya Seminar Cloud', 'pendapatan', 100000],

            // PENGELUARAN
            ['Snack Meeting Pengurus', 'pengeluaran', 125000],
            ['Sewa LCD Proyektor', 'pengeluaran', 300000],
            ['Printing Materi Workshop', 'pengeluaran', 180000],
            ['Kopi & Makan Rapat', 'pengeluaran', 85000],
            ['Pembelian Domain himanikka.id', 'pengeluaran', 150000]
        ];

        foreach ($transaksiData as $index => [$namaBase, $jenis, $baseNominal]) {
            for ($i = 0; $i < 4; $i++) { // 4x setiap transaksi = 50+
                Keuangan::create([
                    'name' => $namaBase . ' #' . ($index + 1) . '-' . ($i + 1),
                    'nominal' => (string) ($baseNominal + rand(-50000, 100000)),
                    'tanggal' => Carbon::now()->subDays(rand(0, 90))->format('Y-m-d'),
                    'user_id' => $users[array_rand($users)],
                    'kegiatan_id' => $kegiatans[array_rand($kegiatans)] ?? 1,
                    'event_id' => $events[array_rand($events)] ?? null,
                    'acara_id' => $acaras[array_rand($acaras)] ?? null,
                    'pendaftaran_id' => $pendaftarans[array_rand($pendaftarans)] ?? null,
                    'jenis' => $jenis,
                    'total' => (string) ($baseNominal + rand(-50000, 100000)),
                    'keterangan' => fake()->sentence(6)
                ]);
            }
        }
    }

    private function seedDependencies()
    {
        // Buat minimal 5 users jika belum ada
        if (User::count() < 5) {
            User::factory(5)->create([
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'email_verified_at' => now(),
                'password' => bcrypt('password')
            ]);
        }

        // Buat minimal 3 record untuk setiap foreign key
        if (Kegiatan::count() < 3) {
            Kegiatan::create(['name' => 'Rapat Pengurus HIMANIKKA']);
            Kegiatan::create(['name' => 'Workshop Pengembangan Web']);
            Kegiatan::create(['name' => 'TechTalk AI 2026']);
        }

        if (Event::count() < 3) {
            Event::create(['name' => 'HIMANIKKA Expo 2026']);
            Event::create(['name' => 'Laravel Conference Riau']);
            Event::create(['name' => 'Hackathon HIMANI']);
        }

        if (Acara::count() < 3) {
            Acara::create(['name' => 'Workshop Tailwind CSS']);
            Acara::create(['name' => 'Live Coding Alpine.js']);
            Acara::create(['name' => 'Best Practice Laravel']);
        }

        if (Pendaftaran::count() < 3) {
            Pendaftaran::create(['name' => 'Pendaftaran Workshop Laravel']);
            Pendaftaran::create(['name' => 'Pendaftaran Hackathon']);
            Pendaftaran::create(['name' => 'Iuran Anggota Baru']);
        }
    }
}
