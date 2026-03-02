<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name_role' => 'Super Admin',
            'code_role' => 'superadmin',
        ]);

        Role::create([
            'name_role' => 'Admin',
            'code_role' => 'admin',
        ]);

        Role::create([
            'name_role' => 'pengunjung',
            'code_role' => 'pengunjung',
        ]);
    }
}
