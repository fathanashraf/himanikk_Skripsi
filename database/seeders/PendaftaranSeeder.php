<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PendaftaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan tabel acara, kegiatan, dan event sudah ada ID-nya
        $acaraIds = DB::table('acaras')->pluck('id')->toArray();
        $kegiatanIds = DB::table('kegiatans')->pluck('id')->toArray();
        $eventIds = DB::table('events')->pluck('id')->toArray();

        if (empty($acaraIds) || empty($kegiatanIds) || empty($eventIds)) {
            $this->command->warn('Seeder memerlukan data acaras, kegiatans, dan events terlebih dahulu!');
            return;
        }

        $pendaftarans = [
            // Workshop Laravel (diterima)
            [
                'name' => 'Fathan Al Ashraf',
                'email' => 'fathan.alashraf@email.com',
                'phone' => '081234567890',
                'status' => 'diterima',
                'image' => 'pendaftarans/fathan.jpg',
                'link' => null,
                'bukti' => 'pendaftarans/bukti-fathan.pdf',
                'keterangan' => 'Pendaftaran resmi workshop Laravel dengan pembayaran lunas',
                'acara_id' => $acaraIds[0] ?? 1,
                'kegiatan_id' => $kegiatanIds[0] ?? 1,
                'event_id' => $eventIds[0] ?? 1,
                'created_at' => Carbon::parse('2026-02-20 09:30:00'),
                'updated_at' => Carbon::parse('2026-02-22 14:15:00'),
            ],
            // Seminar IT (proses)
            [
                'name' => 'Rizki Pratama',
                'email' => 'rizki.pratama@univ.ac.id',
                'phone' => '085678912345',
                'status' => 'proses',
                'image' => 'pendaftarans/rizki.jpg',
                'link' => 'https://wa.me/6285678912345',
                'bukti' => null,
                'keterangan' => 'Menunggu konfirmasi pembayaran',
                'acara_id' => $acaraIds[0] ?? 1,
                'kegiatan_id' => $kegiatanIds[1] ?? 2,
                'event_id' => $eventIds[1] ?? 2,
                'created_at' => Carbon::parse('2026-02-25 11:20:00'),
                'updated_at' => Carbon::parse('2026-02-25 11:20:00'),
            ],
            // Lomba Programming (ditolak)
            [
                'name' => 'Siti Nurhaliza',
                'email' => 'siti.nurhaliza@gmail.com',
                'phone' => '087654321098',
                'status' => 'ditolak',
                'image' => null,
                'link' => null,
                'bukti' => 'pendaftarans/bukti-siti.pdf',
                'keterangan' => 'Ditolak karena melewati batas waktu pendaftaran',
                'acara_id' => $acaraIds[1] ?? 2,
                'kegiatan_id' => $kegiatanIds[0] ?? 1,
                'event_id' => $eventIds[2] ?? 3,
                'created_at' => Carbon::parse('2026-02-18 16:45:00'),
                'updated_at' => Carbon::parse('2026-02-20 10:00:00'),
            ],
            // Workshop UI/UX Design (diterima)
            [
                'name' => 'Ahmad Fauzi',
                'email' => 'ahmad.fauzi@himanikka.org',
                'phone' => '08111222333',
                'status' => 'diterima',
                'image' => 'pendaftarans/ahmad.jpg',
                'link' => null,
                'bukti' => 'pendaftarans/bukti-ahmad.pdf',
                'keterangan' => 'Anggota aktif HIMANIKKA - prioritas diterima',
                'acara_id' => $acaraIds[2] ?? 3,
                'kegiatan_id' => $kegiatanIds[2] ?? 3,
                'event_id' => $eventIds[0] ?? 1,
                'created_at' => Carbon::parse('2026-02-15 13:25:00'),
                'updated_at' => Carbon::parse('2026-02-16 09:30:00'),
            ],
            // Seminar Cyber Security (proses)
            [
                'name' => 'Dewi Sartika',
                'email' => 'dewi.sartika@student.ac.id',
                'phone' => '089999888777',
                'status' => 'proses',
                'image' => 'pendaftarans/dewi.jpg',
                'link' => null,
                'bukti' => null,
                'keterangan' => 'Pendaftaran baru - menunggu upload bukti transfer',
                'acara_id' => $acaraIds[0] ?? 1,
                'kegiatan_id' => $kegiatanIds[3] ?? 4,
                'event_id' => $eventIds[3] ?? 4,
                'created_at' => Carbon::parse('2026-02-27 08:45:00'),
                'updated_at' => Carbon::parse('2026-02-27 08:45:00'),
            ],
            // Volunteer Program (diterima)
            [
                'name' => 'Muhammad Iqbal',
                'email' => 'iqbal.volunteer@gmail.com',
                'phone' => '082334455667',
                'status' => 'diterima',
                'image' => null,
                'link' => 'https://github.com/iqbalhimanikka',
                'bukti' => null,
                'keterangan' => 'Relawan sukarela - tidak perlu bukti pembayaran',
                'acara_id' => $acaraIds[3] ?? 4,
                'kegiatan_id' => $kegiatanIds[0] ?? 1,
                'event_id' => $eventIds[1] ?? 2,
                'created_at' => Carbon::parse('2026-02-22 14:10:00'),
                'updated_at' => Carbon::parse('2026-02-23 10:20:00'),
            ],
        ];

        DB::table('pendaftarans')->insert($pendaftarans);

        $this->command->info('PendaftaranSeeder completed! 6 pendaftaran records inserted.');
        $this->command->table(
            ['Status', 'Jumlah'],
            [
                ['Proses', DB::table('pendaftarans')->where('status', 'proses')->count()],
                ['Diterima', DB::table('pendaftarans')->where('status', 'diterima')->count()],
                ['Ditolak', DB::table('pendaftarans')->where('status', 'ditolak')->count()],
            ]
        );
    }
}
