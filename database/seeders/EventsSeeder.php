<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class EventsSeeder extends Seeder
{
    public function run()
    {
        // ✅ FIX: Disable foreign key checks
        Schema::disableForeignKeyConstraints();
        
        // Hapus data events
        Event::truncate();
        
        // Re-enable foreign key checks
        Schema::enableForeignKeyConstraints();

        $events = [
            // Published (status: 1)
            [
                'name' => 'Workshop Laravel 11 & Alpine.js HIMANIKKA 2026',
                'description' => 'Pelatihan intensif Laravel 11 terbaru dengan Alpine.js untuk admin dashboard HIMANIKKA.',
                'status' => 1,
                'link' => 'https://himanikka.com/events/workshop-laravel',
                'image' => null,
            ],
            [
                'name' => 'Seminar Cloud & DevOps HIMANIKKA',
                'description' => 'AWS, Docker, CI/CD pipeline untuk aplikasi HIMANIKKA. Speaker industri + sertifikat.',
                'status' => 1,
                'link' => 'https://himanikka.com/events/cloud-devops',
                'image' => null,
            ],
            
            // Draft (status: 0)
            [
                'name' => 'Lomba Web Development HIMANIKKA Awards 2026',
                'description' => 'Kompetisi Laravel + Tailwind CSS. Hadiah 5 juta + magang.',
                'status' => 0,
                'link' => null,
                'image' => null,
            ],
            
            // Archived (status: 2)
            [
                'name' => 'Kickoff HIMANIKKA 2025',
                'description' => 'Pembukaan tahun ajaran 2025/2026 + pengenalan kepengurusan baru.',
                'status' => 2,
                'link' => 'https://himanikka.com/events/kickoff-2025',
                'image' => null,
            ],
            [
                'name' => 'Study Tour Jakarta-Bandung 2025',
                'description' => 'Kunjungan startup unicorn + sharing developer senior.',
                'status' => 2,
                'link' => 'https://himanikka.com/events/study-tour',
                'image' => null,
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }

        echo "✅ EventSeeder selesai! Total: " . Event::count() . " events\n";
        echo "✅ Published: " . Event::where('status', 1)->count() . "\n";
        echo "📝 Draft: " . Event::where('status', 0)->count() . "\n";
        echo "📦 Archived: " . Event::where('status', 2)->count() . "\n";
    }
}
