<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // ========== SITE SETTINGS ==========
            [
                'key' => 'site.name',
                'value' => 'HIMANIKKA',
                'type' => 'string',
                'group' => 'site',
                'description' => 'Nama website/organisasi',
                'is_encrypted' => false,
                'extra' => ['public' => true]
            ],
            [
                'key' => 'site.title',
                'value' => 'Himpunan Mahasiswa Informatika dan Komputer',
                'type' => 'string',
                'group' => 'site',
                'description' => 'Judul halaman',
            ],
            [
                'key' => 'site.description',
                'value' => 'Website resmi HIMANIKKA - Himpunan Mahasiswa Informatika dan Komputer',
                'type' => 'string',
                'group' => 'site',
                'description' => 'Deskripsi website',
            ],
            [
                'key' => 'site.url',
                'value' => 'https://hima.univ.ac.id',
                'type' => 'string',
                'group' => 'site',
                'description' => 'URL website',
            ],
            [
                'key' => 'site.logo',
                'value' => 'assets/logohima-.png',
                'type' => 'string',
                'group' => 'site',
                'description' => 'Path logo website',
            ],

            // ========== THEME SETTINGS ==========
            [
                'key' => 'theme.primary_color',
                'value' => '#3B82F6',
                'type' => 'string',
                'group' => 'theme',
                'description' => 'Warna primary theme',
            ],
            [
                'key' => 'theme.enable_dark_mode',
                'value' => true,
                'type' => 'boolean',
                'group' => 'theme',
                'description' => 'Aktifkan dark mode toggle',
            ],
            [
                'key' => 'theme.default_mode',
                'value' => 'system',
                'type' => 'string',
                'group' => 'theme',
                'description' => 'Default theme mode (light/dark/system)',
            ],

            // ========== AUTH SETTINGS ==========
            [
                'key' => 'auth.enable_registration',
                'value' => true,
                'type' => 'boolean',
                'group' => 'auth',
                'description' => 'Izinkan pendaftaran user baru',
            ],
            [
                'key' => 'auth.google_client_id',
                'value' => env('GOOGLE_CLIENT_ID', ''),
                'type' => 'string',
                'group' => 'auth',
                'description' => 'Google OAuth Client ID',
                'is_encrypted' => true,
            ],
            [
                'key' => 'auth.max_login_attempts',
                'value' => 5,
                'type' => 'integer',
                'group' => 'auth',
                'description' => 'Maksimal percobaan login',
            ],

            // ========== SYSTEM SETTINGS ==========
            [
                'key' => 'system.maintenance_mode',
                'value' => false,
                'type' => 'boolean',
                'group' => 'system',
                'description' => 'Mode maintenance website',
            ],
            [
                'key' => 'system.items_per_page',
                'value' => 15,
                'type' => 'integer',
                'group' => 'system',
                'description' => 'Jumlah item per halaman',
            ],
            [
                'key' => 'system.enable_notifications',
                'value' => true,
                'type' => 'boolean',
                'group' => 'system',
                'description' => 'Aktifkan sistem notifikasi',
            ],

            // ========== UPLOAD SETTINGS ==========
            [
                'key' => 'upload.max_size',
                'value' => 5242880, // 5MB
                'type' => 'integer',
                'group' => 'upload',
                'description' => 'Ukuran maksimal upload (bytes)',
            ],
            [
                'key' => 'upload.allowed_types',
                'value' => json_encode(['jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx']),
                'type' => 'json',
                'group' => 'upload',
                'description' => 'Jenis file yang diizinkan',
            ],

            // ========== SOCIAL MEDIA ==========
            [
                'key' => 'social.instagram',
                'value' => 'hima.nikka',
                'type' => 'string',
                'group' => 'social',
                'description' => 'Username Instagram',
            ],
            [
                'key' => 'social.facebook',
                'value' => 'hima.nikka',
                'type' => 'string',
                'group' => 'social',
                'description' => 'Username Facebook',
            ],

            // ========== GLOBAL SETTINGS ==========
            [
                'key' => 'app.timezone',
                'value' => 'Asia/Jakarta',
                'type' => 'string',
                'group' => null,
                'description' => 'Default timezone aplikasi',
            ],
            [
                'key' => 'app.locale',
                'value' => 'id',
                'type' => 'string',
                'group' => null,
                'description' => 'Default language',
            ],
        ];

        DB::transaction(function () use ($settings) {
            foreach ($settings as $setting) {
                // Idempotent - tidak akan duplicate
                Setting::firstOrCreate(
                    ['key' => $setting['key']],
                    $setting
                );
            }
        });

        $this->command->info('✅ Settings seeded successfully! (' . count($settings) . ' records)');
    }
}
