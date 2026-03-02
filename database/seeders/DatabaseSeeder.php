<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->command->info('🔄 Starting HIMANIKKA Database Seeding...');
        
        // ===============================
        // 1. BASIC TABLES (No Foreign Key)
        // ===============================
        

        // ===============================
        // 2. USERS & AUTH (Depend on Roles)
        // ===============================
        $this->command->info('👥 Seeding Users...');
        $this->call([
            UserSeeder::class,           // Fathan, Admin HIMANIKKA, Bendahara
        ]);

        // ===============================
        // 3. BUSINESS DATA (No Foreign Key)
        // ===============================
        $this->command->info('🏢 Seeding Business Data...');
        $this->call([
            KegiatanSeeder::class,       // Workshop Laravel, Rapat Pengurus
            EventsSeeder::class,          // HIMANIKKA Expo, Hackathon
            AcaraSeeder::class,          // Live Coding, TechTalk
            PendaftaranSeeder::class,    // Workshop, Hackathon Registration
        ]);

        // ===============================
        // 4. MAIN DATA (Depend on Everything)
        // ===============================
        $this->command->info('💰 Seeding Keuangan Transactions...');
        $this->call([
            KeuanganSeeder::class,       // 60+ transaksi pendapatan/pengeluaran
        ]);

        $this->command->info('✅ HIMANIKKA Database Seeding Complete!');
        $this->command->info('📊 Check your dashboard: /admin/keuangan');
    }
}
