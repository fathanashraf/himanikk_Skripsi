@extends (
    (auth()->user()?->role === 'admin') 
        ? 'admin.layouts.app'
        : 'layouts.app'
)

@section('title', 'Profile Anda - HIMANIKKA')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    {{-- Profile Header --}}
    <div class="text-center mb-12">
        <div class="max-w-md mx-auto">
            <div class="relative mb-8" x-data="profile()">
                {{-- Profile Picture --}}
                <div class="w-32 h-32 mx-auto rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 
                            flex items-center justify-center shadow-2xl border-4 border-white dark:border-slate-800 
                            ring-4 ring-blue-500/20 group hover:scale-105 transition-all duration-300 overflow-hidden">
                    
                    @php
                        $avatarPath = auth()->user()->avatar && auth()->user()->avatar !== 'default-avatar.png' 
                                    ? Storage::disk('public')->exists(auth()->user()->avatar) 
                                        ? Storage::url(auth()->user()->avatar) 
                                        : null 
                                    : null;
                    @endphp

                    @if($avatarPath)
                        <img x-ref="profileImg" 
                             src="{{ $avatarPath }}?t={{ time() }}" 
                             alt="{{ auth()->user()->name }}" 
                             class="w-full h-full rounded-full object-cover shadow-2xl"
                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'"
                             loading="lazy" />
                    @elseif(isset(auth()->user()->is_google_user) && auth()->user()->is_google_user)
                        <img x-ref="profileImg" 
                             src="{{ auth()->user()->avatar_url }}" 
                             alt="{{ auth()->user()->name }}" 
                             class="w-full h-full rounded-full object-cover shadow-2xl" />
                    @else
                        <span class="text-3xl font-bold text-white tracking-wider drop-shadow-2xl flex items-center justify-center h-full">
                            {{ strtoupper(substr(auth()->user()->name ?? 'User', 0, 2)) }}
                        </span>
                    @endif
                </div>
                
                {{-- Avatar Upload --}}
                <label for="avatar-upload" class="absolute -bottom-4 left-1/2 -translate-x-1/2 z-20 block cursor-pointer group/edit">
                    <input 
                        type="file" 
                        id="avatar-upload"
                        name="avatar"
                        accept="image/jpeg,image/png,image/gif,image/webp"
                        class="absolute inset-0 opacity-0 w-full h-full cursor-pointer z-30 peer sr-only"
                        @change="uploadAvatar($event)"
                        aria-label="Upload foto profil"
                        title="Klik untuk upload foto profil baru">

                    <div class="bg-white/95 dark:bg-slate-800/95 backdrop-blur-xl p-4 rounded-full shadow-2xl 
                                border-4 border-white/80 dark:border-slate-800/80 ring-4 ring-white/60 
                                hover:shadow-3xl hover:scale-110 active:scale-95 transition-all duration-300
                                hover:bg-gradient-to-br hover:from-blue-50 hover:to-white 
                                dark:hover:from-slate-900 hover:to-slate-800 peer-focus:ring-blue-500/50">
                        <i :class="uploading ? 'fas fa-spinner fa-spin text-blue-600' : 'fas fa-camera text-slate-600 dark:text-slate-300 group-hover/edit:text-blue-600'" 
                           class="text-xl transition-all duration-200"></i>
                    </div>
                </label>
            </div>
            
            {{-- Profile Info --}}
            <div class="space-y-3">
                <h1 class="text-4xl lg:text-5xl font-bold bg-gradient-to-r from-slate-900 via-slate-800 to-slate-900 
                           dark:from-white dark:to-slate-100 bg-clip-text text-transparent leading-tight">
                    {{ auth()->user()->name ?? 'User' }}
                </h1>
                <div class="flex flex-wrap gap-3 justify-center items-center">
                    <span class="px-6 py-3 bg-emerald-100 dark:bg-emerald-900/60 text-emerald-800 dark:text-emerald-200 
                                text-xl font-bold rounded-3xl shadow-xl border border-emerald-200/50">
                        {{ ucfirst(auth()->user()->role ?? 'User') }}
                    </span>
                    <span class="px-5 py-2 bg-slate-100 dark:bg-slate-700/60 text-slate-700 dark:text-slate-300 
                                font-semibold rounded-2xl shadow-lg border border-slate-200/50">
                        {{ ucfirst(auth()->user()->status ?? 'Aktif') }}
                    </span>
                </div>
                @if(auth()->user()->nim)
                    <p class="text-xl font-mono text-slate-600 dark:text-slate-400 tracking-wide">
                        {{ auth()->user()->nim }}
                    </p>
                @endif
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        {{-- Main Content --}}
        <div class="lg:col-span-2 space-y-8">
            {{-- Personal Info Card --}}
            <div class="bg-white/90 dark:bg-slate-800/95 backdrop-blur-3xl shadow-2xl rounded-3xl 
                        border border-slate-200/50 dark:border-slate-700/50 p-10 hover:shadow-3xl transition-all duration-300 overflow-hidden relative">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-500/5 to-transparent pointer-events-none"></div>
                <div class="relative">
                    <div class="flex items-center justify-between mb-8">
                        <h2 class="text-3xl font-bold text-slate-900 dark:text-white flex items-center gap-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center shadow-xl">
                                <i class="fas fa-user text-white text-xl"></i>
                            </div>
                            Informasi Pribadi
                        </h2>
                        <a href="{{ route('profile.edit') }}" 
                           class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 
                                   hover:from-blue-600 hover:to-indigo-700 text-white font-semibold rounded-2xl 
                                   shadow-xl hover:shadow-2xl transition-all duration-300">
                            <i class="fas fa-edit"></i> Edit Data
                        </a>
                    </div>
                    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        {{-- Left Column --}}
                        <div class="space-y-6">
                            @if(auth()->user()->nim)
                            <div class="group">
                                <label class="block text-lg font-bold text-slate-700 dark:text-slate-200 mb-4 flex items-center gap-2">
                                    <i class="fas fa-id-card text-blue-500 w-5"></i> NIM Mahasiswa
                                </label>
                                <div class="p-8 bg-gradient-to-br from-slate-50/70 to-slate-100/50 dark:from-slate-700/40 dark:to-slate-800/20 
                                            rounded-3xl border-2 border-slate-200/40 shadow-xl backdrop-blur-sm 
                                            group-hover:shadow-2xl transition-all">
                                    <span class="font-mono text-3xl font-black text-slate-900 dark:text-white tracking-wider">
                                        {{ auth()->user()->nim }}
                                    </span>
                                </div>
                            </div>
                            @endif
                            <div>
                                <label class="block text-lg font-bold text-slate-700 dark:text-slate-200 mb-4 flex items-center gap-2">
                                    <i class="fas fa-info-circle text-emerald-500 w-5"></i> Status Pengguna
                                </label>
                                <div class="p-8 bg-gradient-to-br from-emerald-50/70 to-emerald-100/50 
                                            dark:from-emerald-900/30 dark:to-emerald-800/20 rounded-3xl border-2 
                                            border-emerald-200/40 shadow-xl backdrop-blur-sm">
                                    <span class="text-2xl font-bold text-emerald-800 dark:text-emerald-200 tracking-wide">
                                        {{ ucfirst(auth()->user()->status ?? 'Aktif') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        {{-- Right Column --}}
                        <div class="space-y-6">
                            <div>
                                <label class="block text-lg font-bold text-slate-700 dark:text-slate-200 mb-4 flex items-center gap-2">
                                    <i class="fas fa-envelope text-blue-500 w-5"></i> Email
                                </label>
                                <div class="p-8 bg-gradient-to-br from-blue-50/70 to-blue-100/50 
                                            dark:from-blue-900/30 dark:to-blue-800/20 rounded-3xl border-2 
                                            border-blue-200/40 shadow-xl backdrop-blur-sm">
                                    <span class="text-xl font-semibold text-slate-900 dark:text-white break-all">
                                        {{ auth()->user()->email }}
                                    </span>
                                </div>
                            </div>
                            <div>
                                <label class="block text-lg font-bold text-slate-700 dark:text-slate-200 mb-4 flex items-center gap-2">
                                    <i class="fas fa-calendar-check text-purple-500 w-5"></i> Bergabung Sejak
                                </label>
                                <div class="p-8 bg-gradient-to-br from-purple-50/70 to-purple-100/50 
                                            dark:from-purple-900/30 dark:to-purple-800/20 rounded-3xl border-2 
                                            border-purple-200/40 shadow-xl backdrop-blur-sm">
                                    <div class="flex flex-col lg:flex-row gap-4 items-start lg:items-center">
                                        <span class="text-3xl font-mono font-bold text-purple-700 dark:text-purple-300 tracking-wide">
                                            {{ auth()->user()->created_at->format('d M Y') }}
                                        </span>
                                        <span class="text-lg text-slate-600 dark:text-slate-400 font-medium">
                                            {{ auth()->user()->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Last Login --}}
            @if(auth()->user()->last_login_at)
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 
                        border border-green-200/50 dark:border-emerald-800/50 rounded-3xl p-10 shadow-xl">
                <div class="flex items-center gap-6">
                    <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl 
                                flex items-center justify-center shadow-2xl flex-shrink-0">
                        <i class="fas fa-sign-in-alt text-white text-2xl"></i>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-2xl font-bold text-green-900 dark:text-green-100 mb-2">Login Terakhir</h3>
                        <p class="text-xl font-mono text-green-800 dark:text-green-200 mb-1">
                            {{ auth()->user()->last_login_at->format('d M Y, H:i') }}
                        </p>
                        <p class="text-green-700 dark:text-green-300 text-lg">
                            {{ auth()->user()->last_login_at->diffForHumans() }}
                        </p>
                    </div>
                </div>
            </div>
            @endif
        </div>

        {{-- Quick Actions Sidebar --}}
        <div class="space-y-6 lg:sticky lg:top-24 self-start">
            {{-- Edit Profile --}}
            <a href="{{ route('profile.edit') }}" 
               class="group relative bg-gradient-to-br from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 
                      text-white p-10 rounded-3xl shadow-2xl hover:shadow-3xl hover:-translate-y-3 active:scale-[0.98] 
                      transition-all duration-500 overflow-hidden block">
                <div class="absolute inset-0 bg-white/20 backdrop-blur-sm opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <div class="w-20 h-20 bg-white/40 backdrop-blur-sm rounded-3xl flex items-center justify-center mx-auto mb-6 
                           group-hover:scale-125 transition-all duration-500 relative z-10">
                    <i class="fas fa-user-edit text-2xl"></i>
                </div>
                <h3 class="font-black text-2xl mb-4 relative z-10">Edit Profile</h3>
                <p class="opacity-90 mb-8 relative z-10 leading-relaxed">Update nama, NIM, dan informasi pribadi lainnya</p>
                <div class="inline-flex items-center gap-3 px-8 py-4 bg-white/40 backdrop-blur-xl rounded-3xl 
                           font-bold text-lg relative z-10 hover:bg-white/60 transition-all group-hover:scale-105">
                    <i class="fas fa-pencil-alt"></i> Ubah Data
                </div>
            </a>

            {{-- Change Password --}}
            <a href="#" 
               class="group relative bg-gradient-to-br from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 
                      text-white p-10 rounded-3xl shadow-2xl hover:shadow-3xl hover:-translate-y-3 active:scale-[0.98] 
                      transition-all duration-500 overflow-hidden block">
                <div class="absolute inset-0 bg-white/20 backdrop-blur-sm opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <div class="w-20 h-20 bg-white/40 backdrop-blur-sm rounded-3xl flex items-center justify-center mx-auto mb-6 
                           group-hover:scale-125 transition-all duration-500 relative z-10">
                    <i class="fas fa-lock text-2xl"></i>
                </div>
                <h3 class="font-black text-2xl mb-4 relative z-10">Ubah Password</h3>
                <p class="opacity-90 mb-8 relative z-10 leading-relaxed">Tingkatkan keamanan akun Anda</p>
                <div class="inline-flex items-center gap-3 px-8 py-4 bg-white/40 backdrop-blur-xl rounded-3xl 
                           font-bold text-lg relative z-10 hover:bg-white/60 transition-all group-hover:scale-105">
                    <i class="fas fa-key"></i> Ganti Password
                </div>
            </a>

            {{-- Settings --}}
            @can('view-settings')
            <a href="{{ route('settings.index') }}" 
               class="group relative bg-gradient-to-br from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 
                      text-white p-10 rounded-3xl shadow-2xl hover:shadow-3xl hover:-translate-y-3 active:scale-[0.98] 
                      transition-all duration-500 overflow-hidden block">
                <div class="absolute inset-0 bg-white/20 backdrop-blur-sm opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <div class="w-20 h-20 bg-white/40 backdrop-blur-sm rounded-3xl flex items-center justify-center mx-auto mb-6 
                           group-hover:scale-125 transition-all duration-500 relative z-10">
                    <i class="fas fa-cog text-2xl"></i>
                </div>
                <h3 class="font-black text-2xl mb-4 relative z-10">Pengaturan</h3>
                <p class="opacity-90 mb-6 relative z-10 leading-relaxed">Kelola pengaturan aplikasi</p>
                <div class="flex items-center justify-center gap-3">
                    <div class="w-3 h-3 bg-emerald-400 rounded-full animate-ping relative z-10"></div>
                    <span class="font-bold text-lg relative z-10">Kelola</span>
                </div>
            </a>
            @endcan
        </div>
    </div>
</div>

{{-- Avatar Upload Script --}}
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('profile', () => ({
        uploading: false,
        
        uploadAvatar(event) {
            const file = event.target.files[0];
            if (!file) return;

            // Validate file type
            if (!file.type.startsWith('image/')) {
                this.$dispatch('notify', { type: 'error', message: 'Harap pilih file gambar!' });
                return;
            }

            // Validate file size (5MB)
            if (file.size > 5 * 1024 * 1024) {
                this.$dispatch('notify', { type: 'error', message: 'Ukuran file maksimal 5MB!' });
                return;
            }

            this.uploading = true;
            const formData = new FormData();
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
            formData.append('avatar', file);

            // ✅ FIXED: Use actual route
            fetch('#', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update avatar preview with cache busting
                    if (this.$refs.profileImg) {
                        this.$refs.profileImg.src = data.avatar_url + '?t=' + new Date().getTime();
                    }
                    this.$dispatch('notify', { type: 'success', message: 'Avatar berhasil diupload!' });
                } else {
                    this.$dispatch('notify', { type: 'error', message: data.message || 'Upload gagal!' });
                }
            })
            .catch(error => {
                console.error('Upload error:', error);
                this.$dispatch('notify', { type: 'error', message: 'Terjadi kesalahan saat upload' });
            })
            .finally(() => {
                this.uploading = false;
                event.target.value = ''; // Reset input
            });
        }
    }));
});
</script>

<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
