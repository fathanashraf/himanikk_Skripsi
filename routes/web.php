<?php

use App\Http\Controllers\Admin\AcaraAdminController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\KegiatanAdminController;
use App\Http\Controllers\Admin\KeuanganAdminController;
use App\Http\Controllers\Admin\LaporanAdminController;
use App\Http\Controllers\Admin\LegalitasAdminController;
use App\Http\Controllers\Admin\MasukkanAdminController;
use App\Http\Controllers\Admin\PendaftaranAdminController;
use App\Http\Controllers\Admin\EventAdminController;
use App\Http\Controllers\Admin\StatsController;
use App\Http\Controllers\Admin\StrukturAdminController;
use App\Http\Controllers\Admin\TentangController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\User\DashboardUserController;
use App\Http\Controllers\User\PendaftaranController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LandingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

/*
|--------------------------------------------------------------------------
| Auth Routes (Guest Only)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('auth.login');
    Route::post('/login', [LoginController::class, 'store']);
    Route::get('/register', [RegisterController::class, 'index'])->name('auth.register');
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login/google', [LoginController::class, 'redirectToGoogle'])->name('google.redirect');
});

Route::middleware('guest')->group(function () {
    Route::get('/', [LandingController::class, 'index'])->name('landing');
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('auth.logout');
    
    // Profile
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::put('/', [ProfileController::class, 'update'])->name('update');
    });
    
    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    
    // Notifications
    Route::patch('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])
        ->name('notifications.mark-read');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Admin Dashboard
    Route::get('/admin/dashboard', [DashboardAdminController::class, 'index'])->name('admin.dashboard.index');
    
    // Stats
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/stats/{type}', [StatsController::class, 'getStatsDetail'])->name('stats.detail');
    });
    
    // ========================================
    // Admin Resources (Resource Controllers)
    // ========================================
    
    // Kegiatan
    Route::prefix('admin/kegiatan')->name('admin.kegiatan.')->group(function () {
        Route::get('/', [KegiatanAdminController::class, 'index'])->name('index');
        Route::post('/', [KegiatanAdminController::class, 'store'])->name('store');
        Route::get('/data', [KegiatanAdminController::class, 'data'])->name('data');
        Route::post('/{kegiatan}/status', [KegiatanAdminController::class, 'toggleStatus'])->name('toggleStatus');
    });
    Route::put('admin/kegiatan/{kegiatan}', [KegiatanAdminController::class, 'update'])->name('admin.kegiatan.update');
    Route::delete('admin/kegiatan/{kegiatan}', [KegiatanAdminController::class, 'destroy'])->name('admin.kegiatan.destroy');
    
    // Acara
    Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('acara', [AcaraAdminController::class, 'index'])->name('acara.index');
    Route::post('acara', [AcaraAdminController::class, 'store'])->name('acara.store');
    Route::put('acara/{acara}', [AcaraAdminController::class, 'update'])->name('acara.update');
    Route::post('acara/{acara}/toggle-status', [AcaraAdminController::class, 'toggleStatus'])->name('acara.toggle-status');
    Route::delete('acara/{acara}', [AcaraAdminController::class, 'destroy'])->name('acara.destroy');
    Route::post('/acara/data', [AcaraAdminController::class, 'data'])->name('acara.data');
});

    
    // Events
    Route::prefix('admin/events')->name('admin.events.')->group(function () {
        Route::get('/', [EventAdminController::class, 'index'])->name('index');
        Route::post('/', [EventAdminController::class, 'store'])->name('store');
        Route::get('/data', [EventAdminController::class, 'data'])->name('data');
    });
    Route::put('admin/events/{event}', [EventAdminController::class, 'update'])->name('admin.events.update');
    Route::delete('admin/events/{event}', [EventAdminController::class, 'destroy'])->name('admin.events.destroy');
    
    // Laporan
    Route::prefix('admin/laporan')->name('admin.laporan.')->group(function () {
        Route::get('/', [LaporanAdminController::class, 'index'])->name('index');
        Route::post('/', [LaporanAdminController::class, 'store'])->name('store');
        Route::get('/data', [LaporanAdminController::class, 'data'])->name('data');
        Route::get('/{laporan}/download', [LaporanAdminController::class, 'download'])->name('download');
    });
    Route::put('admin/laporan/{laporan}', [LaporanAdminController::class, 'update'])->name('admin.laporan.update');
    Route::delete('admin/laporan/{laporan}', [LaporanAdminController::class, 'destroy'])->name('admin.laporan.destroy');
    
    // Keuangan
    Route::prefix('admin/keuangan')->name('admin.keuangan.')->group(function () {
        Route::get('/', [KeuanganAdminController::class, 'index'])->name('index');
        Route::get('/create', [KeuanganAdminController::class, 'create'])->name('create');
        Route::post('/', [KeuanganAdminController::class, 'store'])->name('store');
        Route::get('/{keuangan}', [KeuanganAdminController::class, 'show'])->name('show');
        Route::get('/{keuangan}/edit', [KeuanganAdminController::class, 'edit'])->name('edit');
        Route::post('/{keuangan}/status', [KeuanganAdminController::class, 'toggleStatus'])->name('toggleStatus');
        Route::get('/{keuangan}/download', [KeuanganAdminController::class, 'download'])->name('download');
        Route::get('/data', [KeuanganAdminController::class, 'data'])->name('data');
        Route::delete('/keuangan/{keuangan}', [KeuanganAdminController::class, 'destroy'])->name('destroy');
    });
    Route::put('admin/keuangan/{keuangan}', [KeuanganAdminController::class, 'update'])->name('admin.keuangan.update');
    Route::delete('admin/keuangan/{keuangan}', [KeuanganAdminController::class, 'destroy'])->name('admin.keuangan.destroy');
    // export keuangan
    Route::get('/admin/keuangan/export/{format}', [KeuanganAdminController::class, 'export'])->name('admin.keuangan.export');
    
    // ========================================
    // Admin Single Pages
    // ========================================
    
    // Tentang (Single)
    Route::prefix('admin/tentang')->name('admin.tentang.')->group(function () {
        Route::get('/', [TentangController::class, 'index'])->name('index');
        Route::post('/', [TentangController::class, 'store'])->name('store');
        Route::get('/edit', [TentangController::class, 'edit'])->name('edit');
        Route::put('/', [TentangController::class, 'update'])->name('update');
        Route::delete('/', [TentangController::class, 'destroy'])->name('destroy');
    });
    
    // Struktur
    Route::prefix('admin/struktur')->name('admin.struktur.')->group(function () {
        Route::get('/', [StrukturAdminController::class, 'index'])->name('index');
        Route::post('/', [StrukturAdminController::class, 'store'])->name('store');
        Route::get('/users', [StrukturAdminController::class, 'availableusers'])->name('users');
    });
    Route::put('admin/struktur/{struktur}', [StrukturAdminController::class, 'update'])->name('admin.struktur.update');
    Route::delete('admin/struktur/{struktur}', [StrukturAdminController::class, 'destroy'])->name('admin.struktur.destroy');
    
    // Legalitas
    Route::get('/admin/legalitas', [LegalitasAdminController::class, 'legalitas'])->name('admin.legalitas.index');
    
    // Pendaftaran
    Route::get('/admin/pendaftaran', [PendaftaranAdminController::class, 'index'])->name('admin.pendaftaran.index');
    Route::get('/admin/pendaftaran/create', [PendaftaranAdminController::class, 'create'])->name('admin.pendaftaran.create');
    Route::post('/admin/pendaftaran', [PendaftaranAdminController::class, 'store'])->name('admin.pendaftaran.store');
    Route::get('/admin/pendaftaran/{pendaftaran}', [PendaftaranAdminController::class, 'show'])->name('admin.pendaftaran.show');
    Route::post('/admin/pendaftaran/{pendaftaran}/status', [PendaftaranAdminController::class, 'toggleStatus'])->name('admin.pendaftaran.toggleStatus');
    Route::put('/admin/pendaftaran/{pendaftaran}', [PendaftaranAdminController::class, 'update'])->name('admin.pendaftaran.update');
    Route::delete('/admin/pendaftaran/{pendaftaran}', [PendaftaranAdminController::class, 'destroy'])->name('admin.pendaftaran.destroy');
    // download bukti
    Route::get('/admin/pendaftaran/{pendaftaran}/download', [PendaftaranAdminController::class, 'download'])->name('admin.pendaftaran.download-bukti');
    
    // Masukan
    Route::prefix('admin/masukan')->name('admin.masukan.')->group(function () {
        Route::get('/', [MasukkanAdminController::class, 'index'])->name('index');
        Route::post('/', [MasukkanAdminController::class, 'store'])->name('store');
        Route::get('/{masukan}', [MasukkanAdminController::class, 'show'])->name('show');
    });
    Route::put('admin/masukan/{masukan}', [MasukkanAdminController::class, 'update'])->name('admin.masukan.update');
    Route::delete('admin/masukan/{masukan}', [MasukkanAdminController::class, 'destroy'])->name('admin.masukan.destroy');
});

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [DashboardUserController::class, 'index'])->name('user.dashboard.index');
    
    // Masukan
    Route::get('/masukan/create', [DashboardUserController::class, 'create'])->name('masukkan.create');
    Route::post('/masukan', [DashboardUserController::class, 'store'])->name('masukkan.store');
    Route::get('/masukan', [DashboardUserController::class, 'index'])->name('masukkan.index');

    // Acara
    Route::get('/acara', [DashboardUserController::class, 'acara'])->name('acaras.index');
    Route::get('/acara/{acara}', [DashboardUserController::class, 'acara'])->name('acaras.show');

    // pendaftaran
    Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftarans.create');
    Route::post('/pendaftaran', [PendaftaranController::class, 'pendaftaranStore'])->name('pendaftarans.store');
    
    // Event
    Route::get('/events', [DashboardUserController::class, 'event'])->name('events.index');
    Route::get('/events/{event}', [DashboardUserController::class, 'event'])->name('events.show');
});

// superadmin routes
Route::middleware(['auth', 'role:superadmin'])->group(function () {
    Route::get('/superadmin/dashboard', [DashboardAdminController::class, 'index'])->name('superadmin.dashboard.index');

    Route::prefix('superadmin/tentang')->name('superadmin.tentang.')->group(function () {
        Route::get('/', [TentangController::class, 'index'])->name('index');
        Route::post('/', [TentangController::class, 'store'])->name('store');
        Route::get('/edit', [TentangController::class, 'edit'])->name('edit');
        Route::put('/', [TentangController::class, 'update'])->name('update');
        Route::delete('/', [TentangController::class, 'destroy'])->name('destroy');
    });
})
;


Route::post('/deploy', function() {
    if ($_SERVER['HTTP_X_GITHUB_EVENT'] !== 'push') abort(403);
    
    shell_exec('cd /app && git pull origin main && composer install --no-dev --optimize-autoloader && npm ci && npm run build && php artisan config:cache && php artisan route:cache');
    return 'Deployed!';
});
