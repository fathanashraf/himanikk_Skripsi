<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kegiatan;
use Illuminate\Support\Facades\Storage;

class KegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kegiatans = [
            [
                'name' => 'Workshop Laravel Advanced',
                'description' => 'Pelatihan mendalam tentang Laravel 11, Livewire, Inertia.js, dan best practices pengembangan aplikasi web modern',
                'status' => 1, // Aktif
                'image' => 'kegiatan/laravel-workshop.jpg',
                'link' => 'https://himanika.eventbrite.com',
            ],
            [
                'name' => 'Competitive Programming Championship',
                'description' => 'Lomba algoritma, problem solving, dan hackathon tingkat nasional dengan total hadiah Rp 15.000.000',
                'status' => 1, // Aktif
                'image' => 'kegiatan/competitive-programming.jpg',
                'link' => 'https://lomba.himanika.ac.id',
            ],
            [
                'name' => 'Study Group AI & Machine Learning',
                'description' => 'Diskusi mingguan tentang Artificial Intelligence, Deep Learning, TensorFlow, dan PyTorch bersama mentor expert',
                'status' => 1, // Aktif
                'image' => null,
                'link' => null,
            ],
            [
                'name' => 'Hackathon HIMANIKA 2026',
                'description' => 'Kompetisi 48 jam membangun aplikasi inovatif dengan tema Smart City menggunakan teknologi terkini',
                'status' => 0, // Sedang disiapkan
                'image' => 'kegiatan/hackathon-2026.jpg',
                'link' => null,
            ],
            [
                'name' => 'Training Tailwind CSS & Alpine.js',
                'description' => 'Pelatihan modern frontend development dengan Tailwind CSS v4 dan Alpine.js untuk rapid prototyping',
                'status' => 1, // Aktif
                'image' => null,
                'link' => 'https://tailwind.himanika.ac.id',
            ],
            [
                'name' => 'Cybersecurity Awareness',
                'description' => 'Workshop keamanan siber, ethical hacking, dan best practices cybersecurity untuk developer',
                'status' => 2, // Selesai
                'image' => 'kegiatan/cybersecurity.jpg',
                'link' => 'https://cyber.himanika.ac.id',
            ],
            [
                'name' => 'Vue.js Masterclass',
                'description' => 'Pelatihan Vue 3 Composition API, Nuxt 3, Pinia, dan Vue Router untuk aplikasi SPA enterprise',
                'status' => 0, // Sedang disiapkan
                'image' => null,
                'link' => null,
            ],
            [
                'name' => 'Database Optimization Workshop',
                'description' => 'Optimasi MySQL, PostgreSQL, Redis caching, dan database indexing untuk aplikasi high traffic',
                'status' => 1, // Aktif
                'image' => 'kegiatan/database-optimization.jpg',
                'link' => null,
            ],
        ];

        foreach ($kegiatans as $data) {
            Kegiatan::create($data);
        }
    }
}
