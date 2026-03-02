<?php
// database/seeders/UserSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    public function run(): void
{
    $users = [
        // Ketua Himpunan
        [
            'name' => 'Fathan Al Ashraf',
            'email' => 'fathan@himanikka.org',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'birth_date' => '2002-05-15',
            'created_at' => now()->subDays(30),  // ✅ Tambah ini!
            'updated_at' => now()->subDays(7),   // ✅ Dan ini!
        ],
        // Wakil Ketua
        [
            'name' => 'Rizki Pratama',
            'email' => 'rizki@himanikka.org',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'birth_date' => '2003-03-22',
            'created_at' => now()->subDays(25),
            'updated_at' => now()->subDays(5),
        ],
        // Sekretaris
        [
            'name' => 'Siti Nurhaliza',
            'email' => 'siti@himanikka.org',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'birth_date' => '2002-08-10',
            'created_at' => now()->subDays(20),
            'updated_at' => now()->subDays(3),
        ],
        // Bendahara
        [
            'name' => 'Ahmad Fauzi',
            'email' => 'fauzi@himanikka.org',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'birth_date' => '2001-12-05',
            'created_at' => now()->subDays(15),
            'updated_at' => now()->subDays(2),
        ],
        // Koordinator lainnya...
        [
            'name' => 'Dewi Sartika',
            'email' => 'dewi@himanikka.org',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'birth_date' => '2003-07-18',
            'created_at' => now()->subDays(10),
            'updated_at' => now()->subDay(),
        ],
        [
            'name' => 'Muhammad Iqbal',
            'email' => 'iqbal@himanikka.org',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'birth_date' => '2002-11-30',
            'created_at' => now()->subDays(8),
            'updated_at' => now(),
        ],
        [
            'name' => 'Putri Ayu',
            'email' => 'putri@himanikka.org',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'birth_date' => '2003-01-25',
            'created_at' => now()->subDays(5),
            'updated_at' => now(),
        ],
        [
            'name' => 'Budi Santoso',
            'email' => 'budi@himanikka.org',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'birth_date' => '2002-09-12',
            'created_at' => now(),
            'updated_at' => now(),
        ],
    ];

    DB::table('users')->insert($users);
    $this->command->info('✅ 8 users inserted for struktur with timestamps!');
}

}
