<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Dimas Nugraha',
            'email' => 'rHvPw@example.com',
            'status' => 'dosen',
            'password' => Hash::make('password'),
            'role_id' => Role::where('code_role', 'superadmin')->first()->id
        ]);

        User::create([
            'name' => 'Salsari',
            'email' => 'o2R9y@example.com',
            'status' => 'demisioner',
            'password' => Hash::make('password'),
            'role_id' => Role::where('code_role', 'admin')->first()->id
        ]);

        User::create([
            'name' => 'Ahmad Nurdiansyah',
            'email' => 'Tm9yP@example.com',
            'status' => 'pengunjung',
            'password' => Hash::make('password'),
            'role_id' => Role::where('code_role', 'pengunjung')->first()->id
        ]);
    }
}
