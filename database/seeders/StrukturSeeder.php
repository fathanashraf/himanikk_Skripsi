<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class StrukturSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cek apakah users sudah ada
        $userIds = DB::table('users')->pluck('id')->toArray();
        
        if (empty($userIds)) {
            $this->command->warn('⚠️  Buat UserSeeder dulu! Jalankan: php artisan db:seed --class=UserSeeder');
            return;
        }

        $strukturs = [
            // Ketua Himpunan
            [
                'user_id' => $userIds[0] ?? 1,
                'jabatan' => 'kahim',
                'avatar' => 'strukturs/kahim.jpg',
                'posisi' => 'koordinator',
                'departemen' => 'kwu',
                'created_at' => Carbon::parse('2025-12-01 09:00:00'),
                'updated_at' => now(),
            ],
            
            // Wakil Ketua
            [
                'user_id' => $userIds[1] ?? 2,
                'jabatan' => 'wakahim',
                'avatar' => 'strukturs/wakahim.jpg',
                'posisi' => 'koordinator',
                'departemen' => 'kwu',
                'created_at' => Carbon::parse('2025-12-01 10:30:00'),
                'updated_at' => now(),
            ],
            
            // Sekretaris 1
            [
                'user_id' => $userIds[2] ?? 3,
                'jabatan' => 'sekretaris',
                'avatar' => 'strukturs/sekretaris1.jpg',
                'posisi' => 'koordinator',
                'departemen' => 'minatbakat',
                'created_at' => Carbon::parse('2025-12-02 14:20:00'),
                'updated_at' => now(),
            ],
            
            // Bendahara
            [
                'user_id' => $userIds[3] ?? 4,
                'jabatan' => 'bendahara',
                'avatar' => 'strukturs/bendahara.jpg',
                'posisi' => 'koordinator',
                'departemen' => 'humas',
                'created_at' => Carbon::parse('2025-12-03 11:15:00'),
                'updated_at' => now(),
            ],
            
            // Koordinator KWU
            [
                'user_id' => $userIds[4] ?? 5,
                'jabatan' => null,
                'avatar' => 'strukturs/koordinator-kwu.jpg',
                'posisi' => 'koordinator',
                'departemen' => 'kwu',
                'created_at' => Carbon::parse('2026-01-10 08:45:00'),
                'updated_at' => now(),
            ],
            
            // Anggota Minat Bakat
            [
                'user_id' => $userIds[5] ?? 6,
                'jabatan' => null,
                'avatar' => 'strukturs/anggota-minatbakat.jpg',
                'posisi' => 'anggota',
                'departemen' => 'minatbakat',
                'created_at' => Carbon::parse('2026-01-15 13:30:00'),
                'updated_at' => now(),
            ],
            
            // Koordinator Pemberdayaan Wanita
            [
                'user_id' => $userIds[6] ?? 7,
                'jabatan' => null,
                'avatar' => 'strukturs/koordinator-wanita.jpg',
                'posisi' => 'koordinator',
                'departemen' => 'pemberdaya_wanita',
                'created_at' => Carbon::parse('2026-01-20 16:20:00'),
                'updated_at' => now(),
            ],
            
            // Anggota HUMAS
            [
                'user_id' => $userIds[7] ?? 8,
                'jabatan' => null,
                'avatar' => 'strukturs/anggota-humas.jpg',
                'posisi' => 'anggota',
                'departemen' => 'humas',
                'created_at' => Carbon::parse('2026-02-01 10:10:00'),
                'updated_at' => now(),
            ],
        ];

        DB::table('strukturs')->insert($strukturs);

        $this->command->info('✅ StrukturSeeder completed! 8 struktur organisasi inserted.');

        // Statistik
        $this->command->table(
            ['Jabatan/Posisi', 'Jumlah'],
            [
                ['Ketua/Wakil/Sekretaris/Bendahara', DB::table('strukturs')->whereNotNull('jabatan')->count()],
                ['Koordinator', DB::table('strukturs')->where('posisi', 'koordinator')->count()],
                ['Anggota', DB::table('strukturs')->where('posisi', 'anggota')->count()],
                ['Total', DB::table('strukturs')->count()],
            ]
        );
    }
}
