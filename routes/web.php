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
use App\Http\Controllers\User\KegiatanUserController;
use App\Http\Controllers\User\MasukkanController;
use App\Http\Controllers\User\PendaftaranUserController;
use App\Http\Controllers\User\StrukturController;
use App\Http\Controllers\User\TentangUserController;
use App\Http\Controllers\User\EventUserController;
use App\Http\Controllers\User\AcaraUserController;
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
        Route::post('/avatar', [ProfileController::class, 'uploadAvatar'])->name('avatar.upload');
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
    // Admin Resources - RESOURCEFUL & CONSISTENT
    // ========================================

    // Kegiatan (Resourceful)
    Route::resource('admin/kegiatan', KegiatanAdminController::class, [
        'names' => 'admin.kegiatan',
        'parameters' => ['kegiatan' => 'kegiatan']
    ])->except(['show', 'edit', 'create']);
    Route::prefix('admin/kegiatan')->name('admin.kegiatan.')->group(function () {
        Route::get('/data', [KegiatanAdminController::class, 'data'])->name('data');
        Route::post('/{kegiatan}/status', [KegiatanAdminController::class, 'toggleStatus'])->name('toggleStatus');
    });

    // Acara (Resourceful)
    Route::resource('admin/acara', AcaraAdminController::class, [
        'names' => 'admin.acara', 
        'parameters' => ['acara' => 'acara']
    ])->except(['show', 'edit', 'create']);
    Route::prefix('admin/acara')->name('admin.acara.')->group(function () {
        Route::post('/data', [AcaraAdminController::class, 'data'])->name('data');
    });

    // Events (Resourceful)
    Route::resource('admin/events', EventAdminController::class, [
        'names' => 'admin.events',
        'parameters' => ['event' => 'event']
    ])->except(['show', 'edit', 'create']);
    Route::prefix('admin/events')->name('admin.events.')->group(function () {
        Route::get('/data', [EventAdminController::class, 'data'])->name('data');
    });

    // Laporan (Resourceful)
    Route::resource('admin/laporan', LaporanAdminController::class, [
        'names' => 'admin.laporan',
        'parameters' => ['laporan' => 'laporan']
    ])->except(['show', 'edit', 'create']);
    Route::prefix('admin/laporan')->name('admin.laporan.')->group(function () {
        Route::get('/data', [LaporanAdminController::class, 'data'])->name('data');
        Route::get('/{laporan}/download', [LaporanAdminController::class, 'download'])->name('download');
    });

    // Keuangan (Resourceful)
    Route::resource('admin/keuangan', KeuanganAdminController::class, [
        'names' => 'admin.keuangan',
        'parameters' => ['keuangan' => 'keuangan']
    ])->except(['show', 'edit', 'create']);
    Route::prefix('admin/keuangan')->name('admin.keuangan.')->group(function () {
        Route::get('/data', [KeuanganAdminController::class, 'data'])->name('data');
        Route::post('/{keuangan}/status', [KeuanganAdminController::class, 'toggleStatus'])->name('toggleStatus');
        Route::get('/{keuangan}/download', [KeuanganAdminController::class, 'download'])->name('download');
        Route::get('/export/{format}', [KeuanganAdminController::class, 'export'])->name('export');
    });

    // TENTANG - FIXED FOR MODAL (Resourceful)
    Route::resource('admin/tentang', TentangController::class, [
        'names' => 'admin.tentang',
        'parameters' => ['tentang' => 'profil']
    ])->only(['index','edit', 'store', 'update', 'destroy']);

    // Struktur (Resourceful)
    Route::resource('admin/struktur', StrukturAdminController::class, [
        'names' => 'admin.struktur',
        'parameters' => ['struktur' => 'struktur']
    ])->except(['show', 'edit', 'create']);
    Route::prefix('admin/struktur')->name('admin.struktur.')->group(function () {
        Route::get('/users', [StrukturAdminController::class, 'availableusers'])->name('users');
    });

    // Legalitas
    Route::get('/admin/legalitas', [LegalitasAdminController::class, 'legalitas'])->name('admin.legalitas.index');

    // Pendaftaran (Resourceful)
    Route::resource('admin/pendaftaran', PendaftaranAdminController::class, [
        'names' => 'admin.pendaftaran',
        'parameters' => ['pendaftaran' => 'pendaftaran']
    ])->except(['edit', 'create']);
    Route::prefix('admin/pendaftaran')->name('admin.pendaftaran.')->group(function () {
        Route::get('/download', [PendaftaranAdminController::class, 'download'])->name('download-bukti');
        Route::post('/{pendaftaran}/status', [PendaftaranAdminController::class, 'toggleStatus'])->name('toggleStatus');
    });

    // Masukan (Resourceful)
    Route::resource('admin/masukan', MasukkanAdminController::class, [
        'names' => 'admin.masukan',
        'parameters' => ['masukan' => 'masukan']
    ])->except(['edit', 'create']);
});

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [DashboardUserController::class, 'index'])->name('user.dashboard.index');

    // tentang
    Route::prefix('user')->name('user.')->group(function () {
       Route::get('tentang', [TentangUserController::class, 'index'])->name('tentang.index'); 
    });
    // struktur
    // ❌ WRONG - Sintaks resource rusak
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('struktur', [StrukturController::class, 'index'])->name('struktur.index');
        Route::get('struktur/{struktur}', [StrukturController::class, 'show'])->name('struktur.show');
        Route::get('struktur/departemen/{departemen}', [StrukturController::class, 'departemen'])
            ->name('struktur.departemen'); // Fixed: hapus prefix 'user.' duplikat
    });

    // kegiatan
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('kegiatan', [KegiatanUserController::class, 'index'])->name('kegiatan.index');
        Route::get('kegiatan/{kegiatan}', [KegiatanUserController::class, 'show'])->name('kegiatan.show');
        Route::get('kegiatan/departemen/{departemen}', [KegiatanUserController::class, 'departemen'])
            ->name('kegiatan.departemen'); // Fixed: hapus prefix 'user.' duplikat
        Route::get('kegiatan/pendaftaran/{kegiatan}', [KegiatanUserController::class, 'pendaftaran'])->name('pendaftaran.kegiatan');
        Route::post('kegiatan/pendaftaran/{kegiatan}', [KegiatanUserController::class, 'storePendaftaran'])->name('pendaftaran.store');
    });

    // acara
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('acara', [AcaraUserController::class, 'index'])->name('acara.index');
        Route::get('acara/{acara}', [AcaraUserController::class, 'show'])->name('acara.show');
        Route::get('acara/pendaftaran/{acara}', [AcaraUserController::class, 'pendaftaran'])->name('acara.pendaftaran');
        Route::post('acara/pendaftaran/{acara}', [AcaraUserController::class, 'storePendaftaran'])->name('store.pendaftaran');
    });

    // events
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('events', [EventUserController::class, 'index'])->name('events.index');
        Route::get('events/{events}', [EventUserController::class, 'show'])->name('events.show');
        Route::get('events/pendaftaran/{event}', [EventUserController::class, 'pendaftaran'])->name('events.pendaftaran');
        Route::post('events/pendaftaran/{event}', [EventUserController::class, 'storePendaftaran'])->name('events.store');
    });

    // masukkan
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('masukan', [DashboardUserController::class, 'index'])->name('masukkan.index');
        Route::get('masukan/{masukan}', [DashboardUserController::class, 'show'])->name('masukan.show');
    });

    // Masukan
    Route::prefix('masukan')->name('masukan.')->group(function () {
        Route::get('/', [DashboardUserController::class, 'index'])->name('index');
        Route::get('/create', [DashboardUserController::class, 'create'])->name('create');
        Route::post('/', [DashboardUserController::class, 'store'])->name('store');
    });
    // Events
    Route::prefix('events')->name('events.')->group(function () {
        Route::get('/', [DashboardUserController::class, 'event'])->name('index');
        Route::get('/{event}', [DashboardUserController::class, 'event'])->name('show');
    });

    Route::prefix('user')->name('user.')->group(function () {
        Route::get('pendaftaran', [PendaftaranUserController::class, 'index'])->name('pendaftaran.index');
        Route::get('pendaftaran/create', [PendaftaranUserController::class, 'create'])->name('pendaftaran.create');
        Route::get('pendaftaran/{pendaftaran}', [PendaftaranUserController::class, 'show'])->name('pendaftaran.show');
        Route::get('pendaftaran/kegiatan/{pendaftaran}', [PendaftaranUserController::class, 'pendaftaranKegiatan'])->name('pendaftaran.kegiatan');
    });

    // masukkan
    Route::prefix('masukkan')->name('masukkan.')->group(function () {
        Route::get('/', [MasukkanController::class, 'masukkan'])->name('index');
        Route::get('/create', [MasukkanController::class, 'create'])->name('create');
        Route::get('/{masukkan}', [MasukkanController::class, 'masukkan'])->name('show');
        Route::post('/', [MasukkanController::class, 'masukkanStore'])->name('store');
    });
});

/*
|--------------------------------------------------------------------------
| Superadmin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:superadmin'])->group(function () {
    Route::get('/superadmin/dashboard', [DashboardAdminController::class, 'index'])->name('superadmin.dashboard.index');
});
