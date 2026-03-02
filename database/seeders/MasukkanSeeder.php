<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MasukkanSeeder extends Seeder
{
    public function run(): void
    {
        // Cek dependencies
        $userIds = DB::table('users')->pluck('id')->toArray();
        $kegiatanIds = DB::table('kegiatans')->pluck('id')->toArray();
        $eventIds = DB::table('events')->pluck('id')->toArray();
        $acaraIds = DB::table('acaras')->pluck('id')->toArray();

        if (empty($userIds)) {
            $this->command->warn('⚠️  UserSeeder harus dijalankan dulu!');
            return;
        }

        if (empty($kegiatanIds) || empty($eventIds) || empty($acaraIds)) {
            $this->command->warn('⚠️  Jalankan AcaraSeeder, KegiatanSeeder, EventSeeder dulu!');
            return;
        }

        $masukkans = [
            // 👍 POSITIF - Workshop Laravel
            [
                'user_id' => $userIds[0] ?? 1,  // Fathan (Ketua)
                'tipe' => 'like',
                'kegiatan_id' => $kegiatanIds[0] ?? 1,  // Workshop Technical
                'event_id' => $eventIds[0] ?? 1,        // Workshop Laravel
                'acara_id' => $acaraIds[0] ?? 1,        // Workshop Laravel
                'created_at' => Carbon::parse('2026-02-25 14:30:00'),
                'updated_at' => Carbon::parse('2026-02-25 14:30:00'),
            ],
            
            // 👎 KRITIK - Lomba Programming
            [
                'user_id' => $userIds[2] ?? 3,  // Siti
                'tipe' => 'kritik',
                'kegiatan_id' => $kegiatanIds[2] ?? 3,  // Lomba Programming
                'event_id' => $eventIds[1] ?? 2,        // Lomba Coding
                'acara_id' => $acaraIds[1] ?? 2,        // Lomba Programming
                'created_at' => Carbon::parse('2026-02-26 16:45:00'),
                'updated_at' => Carbon::parse('2026-02-26 16:45:00'),
            ],
            
            // 💡 SARAN - Seminar UI/UX
            [
                'user_id' => $userIds[5] ?? 6,  // Muhammad Iqbal
                'tipe' => 'saran',
                'kegiatan_id' => $kegiatanIds[1] ?? 2,  // Seminar Non-technical
                'event_id' => $eventIds[2] ?? 3,        // Seminar UI/UX
                'acara_id' => $acaraIds[2] ?? 3,        // Seminar UI/UX
                'created_at' => Carbon::parse('2026-02-27 10:15:00'),
                'updated_at' => Carbon::parse('2026-02-27 10:15:00'),
            ],
            
            // 👍 LIKE - Volunteer Program
            [
                'user_id' => $userIds[6] ?? 7,  // Putri Ayu
                'tipe' => 'like',
                'kegiatan_id' => $kegiatanIds[3] ?? 4,  // Volunteer Program
                'event_id' => $eventIds[3] ?? 4,        // Volunteer HIMANIKKA
                'acara_id' => $acaraIds[3] ?? 4,        // Volunteer Training
                'created_at' => Carbon::parse('2026-02-28 09:20:00'),
                'updated_at' => Carbon::parse('2026-02-28 09:20:00'),
            ],
            
            // 👎 DISLIKE - Cyber Security Talk
            [
                'user_id' => $userIds[7] ?? 8,  // Budi Santoso
                'tipe' => 'dislike',
                'kegiatan_id' => $kegiatanIds[1] ?? 2,  // Seminar
                'event_id' => $eventIds[4] ?? 5,        // Cyber Security Talk
                'acara_id' => null,
                'created_at' => Carbon::parse('2026-02-28 15:10:00'),
                'updated_at' => Carbon::parse('2026-02-28 15:10:00'),
            ],
            
            // 💡 SARAN Umum (tanpa event/acara spesifik)
            [
                'user_id' => $userIds[4] ?? 5,  // Dewi Sartika
                'tipe' => 'saran',
                'kegiatan_id' => null,
                'event_id' => null,
                'acara_id' => null,
                'created_at' => Carbon::parse('2026-02-28 17:45:00'),
                'updated_at' => Carbon::parse('2026-02-28 17:45:00'),
            ],
            
            // 👍 LIKE - Workshop (anggota biasa)
            [
                'user_id' => $userIds[1] ?? 2,  // Rizki (Wakil Ketua)
                'tipe' => 'like',
                'kegiatan_id' => $kegiatanIds[0] ?? 1,
                'event_id' => null,
                'acara_id' => $acaraIds[0] ?? 1,
                'created_at' => Carbon::parse('2026-02-28 11:30:00'),
                'updated_at' => Carbon::parse('2026-02-28 11:30:00'),
            ],
            
            // 👎 KRITIK - Lomba
            [
                'user_id' => $userIds[3] ?? 4,  // Ahmad Fauzi (Bendahara)
                'tipe' => 'kritik',
                'kegiatan_id' => null,
                'event_id' => $eventIds[1] ?? 2,
                'acara_id' => $acaraIds[1] ?? 2,
                'created_at' => Carbon::parse('2026-02-28 13:20:00'),
                'updated_at' => Carbon::parse('2026-02-28 13:20:00'),
            ],
        ];

        DB::table('masukkans')->insert($masukkans);

        $this->command->info('✅ MasukkanSeeder completed! 8 feedback records inserted.');

        // Statistik feedback
        $this->command->table(
            ['Tipe Feedback', 'Jumlah'],
            [
                ['👍 Like', DB::table('masukkans')->where('tipe', 'like')->count()],
                ['👎 Dislike', DB::table('masukkans')->where('tipe', 'dislike')->count()],
                ['💡 Saran', DB::table('masukkans')->where('tipe', 'saran')->count()],
                ['⚠️ Kritik', DB::table('masukkans')->where('tipe', 'kritik')->count()],
                ['Total', DB::table('masukkans')->count()],
            ]
        );
    }
}
