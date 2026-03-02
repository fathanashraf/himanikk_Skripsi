<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AcaraSeeder extends Seeder
{
    public function run()
    {
        DB::table('acaras')->insert([
            [
                'name'        => 'Acara Pengenalan HIMANIKKA',
                'description' => 'Acara pengenalan organisasi himpunan mahasiswa kepada seluruh anggota baru.',
                'status'      => 1, // misal: 1 = aktif, 0 = nonaktif
                'image'       => 'acara1.jpg',
                'link'        => 'https://example.com/acara-1',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'Workshop Laravel Basic',
                'description' => 'Workshop pembelajaran dasar Laravel untuk mahasiswa tingkat pemula.',
                'status'      => 1,
                'image'       => 'acara2.jpg',
                'link'        => 'https://example.com/acara-2',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'Kegiatan Bakti Sosial',
                'description' => 'Kegiatan bakti sosial yang diselenggarakan bersama komunitas lokal.',
                'status'      => 0,
                'image'       => null,
                'link'        => null,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);
    }
}
