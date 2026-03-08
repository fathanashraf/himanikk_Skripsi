{{-- resources/views/user/struktur/show.blade.php --}}
@extends('user.layouts.app')

@section('title', ($struktur->jabatan === 'kahim' ? 'Ketua Himpunan' : $struktur->user->name ?? 'Profil Struktur'))

@section('content')
<section class="py-16 lg:py-24 bg-gradient-to-br from-slate-50 via-white to-emerald-50 dark:from-slate-900 dark:to-slate-950 min-h-screen">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- HEADER --}}
        <div class="text-center mb-20 lg:mb-28">
            @if($struktur->jabatan === 'kahim')
                {{-- KAHIM HERO HEADER --}}
                <div class="relative overflow-hidden mb-16">
                    <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/5 via-teal-500/5 to-emerald-600/5"></div>
                    <div class="relative z-10">
                        <div class="inline-flex items-center gap-3 px-6 py-3 bg-emerald-600/90 backdrop-blur-xl 
                                   text-white font-semibold text-lg rounded-full shadow-xl border border-emerald-400/50 mb-8">
                            <i class="fas fa-crown text-xl"></i>
                            Ketua Himpunan
                        </div>
                        <h1 class="text-5xl md:text-7xl lg:text-8xl font-black bg-gradient-to-r from-slate-900 via-emerald-600 to-teal-600 
                                  bg-clip-text text-transparent mb-6 tracking-tight">
                            {{ $profils->singkatan ?? 'HIMANIKKA' }}
                        </h1>
                    </div>
                </div>
            @endif

            {{-- NAME & POSITION --}}
            <div class="max-w-2xl mx-auto">
                <h2 class="text-4xl lg:text-5xl xl:text-6xl font-bold text-slate-900 dark:text-white mb-6 leading-tight tracking-tight">
                    {{ $struktur->user->name }}
                </h2>
                @if($struktur->jabatan === 'kahim')
                    <div class="flex flex-wrap items-center justify-center gap-6 text-lg lg:text-xl">
                        <span class="px-6 py-2 bg-emerald-100 text-emerald-800 font-semibold rounded-lg">
                            2025-2026
                        </span>
                    </div>
                @else
                    <div class="text-xl lg:text-2xl text-slate-600 dark:text-slate-400 font-medium flex flex-wrap items-center justify-center gap-4 mb-8">
                        {{ $struktur->jabatan ? strtoupper($struktur->jabatan) : 'ANGGOTA' }}
                        @if($struktur->departemen)
                            • {{ strtoupper($struktur->departemen) }}
                        @endif
                        @if($struktur->posisi)
                            • {{ ucwords($struktur->posisi) }}
                        @endif
                    </div>
                @endif
            </div>
        </div>

        {{-- MAIN CONTENT GRID --}}
        <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 items-start mb-20">
            {{-- LEFT COLUMN: AVATAR & ACTIONS --}}
            <div class="lg:order-1">
                {{-- PROFILE CARD --}}
                <div class="bg-white/70 dark:bg-slate-800/70 backdrop-blur-xl rounded-3xl p-8 lg:p-10 xl:p-12 border border-slate-200/50 
                           shadow-xl hover:shadow-2xl transition-all duration-500 group">
                    
                    {{-- BACKGROUND ACCENT --}}
                    <div class="absolute inset-0 bg-gradient-to-br {{ $struktur->jabatan === 'kahim' ? 'from-emerald-500/3 to-teal-500/3' : 'from-slate-200/20 to-slate-300/10' }} rounded-3xl -z-10"></div>
                    
                    {{-- AVATAR --}}
                    <div class="text-center mb-8 relative">
                        @if($struktur->avatar)
                            <div class="relative inline-block group/profile">
                                <img src="{{ asset('storage/' . $struktur->avatar) }}" 
                                     alt="{{ $struktur->user->name }}" 
                                     class="w-48 h-48 lg:w-56 lg:h-56 xl:w-64 xl:h-64 rounded-2xl object-cover shadow-2xl 
                                            ring-4 {{ $struktur->jabatan === 'kahim' ? 'ring-emerald-200/50' : 'ring-slate-200/50' }} 
                                            hover:scale-105 transition-all duration-500 mx-auto">
                                
                                {{-- POSITION BADGE --}}
                                @if($struktur->jabatan !== 'kahim')
                                    <div class="absolute -bottom-2 -right-2 w-14 h-14 bg-white shadow-xl rounded-2xl flex items-center justify-center border-4 border-slate-100/80 group-hover/profile:scale-110 transition-all duration-300">
                                        @if($struktur->posisi === 'koordinator' || $struktur->posisi === 'ketua')
                                            <i class="fas fa-star text-yellow-500 text-lg"></i>
                                        @elseif($struktur->jabatan === 'wakahim')
                                            <i class="fas fa-user-tie text-slate-700 text-lg"></i>
                                        @else
                                            <i class="fas fa-check text-emerald-500 text-lg"></i>
                                        @endif
                                    </div>
                                @else
                                    {{-- KAHIM CROWN --}}
                                    <div class="absolute -top-4 left-1/2 -translate-x-1/2 w-16 h-16 bg-gradient-to-r from-yellow-400 to-orange-400 
                                               rounded-2xl flex items-center justify-center shadow-2xl border-4 border-white/70">
                                        <i class="fas fa-crown text-yellow-900 text-lg font-bold"></i>
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="w-48 h-48 lg:w-56 lg:h-56 xl:w-64 xl:h-64 mx-auto flex items-center justify-center 
                                       bg-gradient-to-br {{ $struktur->jabatan === 'kahim' ? 'from-emerald-400 via-teal-500 to-emerald-500' : 'from-slate-300 to-slate-400' }}
                                       rounded-2xl shadow-2xl border-4 {{ $struktur->jabatan === 'kahim' ? 'border-emerald-200/60' : 'border-slate-200/60' }}
                                       text-4xl lg:text-5xl xl:text-6xl font-bold text-white">
                                {{ strtoupper(substr($struktur->user->name, 0, 2)) }}
                            </div>
                        @endif

                        {{-- POSITION TITLE --}}
                        @if($struktur->jabatan)
                            <div class="mt-6 px-6 py-3 bg-gradient-to-r {{ $struktur->jabatan === 'kahim' ? 'from-emerald-600 to-teal-600' : 'from-slate-600 to-slate-700' }}
                                       text-white font-semibold text-lg lg:text-xl rounded-xl shadow-lg border {{ $struktur->jabatan === 'kahim' ? 'border-emerald-400/50' : 'border-slate-400/50' }}
                                       hover:-translate-y-1 transition-all duration-300 mx-4">
                                <div class="flex items-center justify-center gap-2">
                                    @if($struktur->jabatan === 'kahim')
                                        <i class="fas fa-crown text-lg"></i>
                                    @elseif($struktur->jabatan === 'wakahim')
                                        <i class="fas fa-user-tie text-lg"></i>
                                    @elseif($struktur->jabatan === 'sekretaris')
                                        <i class="fas fa-file-signature text-lg"></i>
                                    @else
                                        <i class="fas fa-briefcase text-lg"></i>
                                    @endif
                                    {{ strtoupper($struktur->jabatan) }}
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- STATS (KAHIM ONLY) --}}
                    @if($struktur->jabatan === 'kahim' && isset($stats))
                        <div class="grid grid-cols-3 gap-4 mb-8">
                            <div class="p-4 bg-gradient-to-br from-emerald-50 to-teal-50 rounded-xl border border-emerald-200/50 text-center group-hover:bg-emerald-100 transition-all">
                                <div class="text-2xl lg:text-3xl font-bold text-emerald-700 mb-1">{{ $stats['total_departemen'] }}</div>
                                <div class="text-sm font-medium text-emerald-600 uppercase tracking-wide">Departemen</div>
                            </div>
                            <div class="p-4 bg-gradient-to-br from-yellow-50 to-orange-50 rounded-xl border border-yellow-200/50 text-center group-hover:bg-yellow-100 transition-all">
                                <div class="text-2xl lg:text-3xl font-bold text-yellow-700 mb-1">{{ $stats['total_koordinator'] }}</div>
                                <div class="text-sm font-medium text-yellow-600 uppercase tracking-wide">Koordinator</div>
                            </div>
                            <div class="p-4 bg-gradient-to-br from-slate-50 to-slate-100 rounded-xl border border-slate-200/50 text-center group-hover:bg-slate-100 transition-all">
                                <div class="text-2xl lg:text-3xl font-bold text-slate-700 mb-1">{{ $stats['total_anggota'] }}</div>
                                <div class="text-sm font-medium text-slate-600 uppercase tracking-wide">Anggota</div>
                            </div>
                        </div>
                    @endif

                    {{-- ACTION BUTTONS --}}
                    <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-slate-200/50">
                        <a href="{{ route('user.struktur.index') }}" 
                           class="flex items-center justify-center gap-3 flex-1 px-6 py-3 bg-slate-900 hover:bg-slate-800 text-white font-semibold rounded-xl 
                                  shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300 text-sm lg:text-base">
                            <i class="fas fa-arrow-left"></i>
                            Kembali
                        </a>
                        @if($struktur->user->email)
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $struktur->user->phone ?? '') }}?text=Halo%20{{ urlencode($struktur->user->name) }}%2C%20saya%20ingin%20berkontak%20mengenai..." 
                            target="_blank" rel="noopener noreferrer"
                            class="flex items-center justify-center gap-3 flex-1 px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-700 
                                    hover:from-green-700 hover:to-emerald-800 text-white font-bold rounded-xl shadow-lg 
                                    hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300 text-sm lg:text-base">
                                
                                <span>WhatsApp</span>
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            {{-- RIGHT COLUMN: DETAILS --}}
            <div class="lg:sticky lg:top-8 lg:order-2">
                <div class="bg-white/70 dark:bg-slate-800/70 backdrop-blur-xl rounded-3xl p-8 lg:p-10 xl:p-12 border border-slate-200/50 shadow-xl">
                    
                    {{-- NIM --}}
                    @if($struktur->user->nim)
                        <div class="text-center mb-8 p-6 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-2xl border border-emerald-200/50">
                            <div class="flex items-center justify-center gap-3 text-emerald-700 font-semibold">
                                <i class="fas fa-id-card text-lg"></i>
                                <span class="text-xl lg:text-2xl tracking-wide">{{ $struktur->user->nim }}</span>
                            </div>
                        </div>
                    @endif

                    {{-- CONTACT --}}
                    @if($struktur->user->email)
                        <div class="mb-8">
                            <h4 class="font-bold text-xl text-slate-900 dark:text-white mb-4 flex items-center gap-3">
                                <i class="fas fa-envelope text-emerald-500 text-lg"></i>
                                Kontak
                            </h4>
                            <div class="p-6 bg-gradient-to-r from-slate-50 to-slate-100 dark:from-slate-800 dark:to-slate-700 rounded-2xl border border-slate-200/50 hover:bg-slate-100 dark:hover:bg-slate-700 transition-all">
                                <a href="mailto:{{ $struktur->user->email }}" 
                                   class="block text-xl lg:text-2xl font-semibold text-slate-800 dark:text-slate-200 hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors font-mono break-all">
                                    {{ $struktur->user->email }}
                                </a>
                            </div>
                        </div>
                    @endif

                    {{-- POSITION DETAILS --}}
                    <div class="mb-12">
                        <h4 class="font-bold text-xl text-slate-900 dark:text-white mb-6 flex items-center gap-3">
                            <i class="fas fa-briefcase text-emerald-500 text-lg"></i>
                            Posisi & Departemen
                        </h4>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 p-8 bg-gradient-to-r from-slate-50 to-slate-100 dark:from-slate-800 dark:to-slate-700 rounded-2xl border border-slate-200/50">
                            <div>
                                <span class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 block">Jabatan</span>
                                <p class="text-2xl lg:text-3xl font-bold text-slate-900 dark:text-white">
                                    {{ $struktur->jabatan === 'kahim' ? 'Ketua Himpunan' : ucwords(str_replace('_', ' ', $struktur->jabatan ?? 'N/A')) }}
                                </p>
                            </div>
                            <div>
                                <span class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 block">Posisi</span>
                                <p class="text-2xl lg:text-3xl font-bold text-slate-900 dark:text-white">
                                    {{ ucwords($struktur->posisi ?? 'Anggota') }}
                                </p>
                            </div>
                            @if($struktur->departemen)
                            <div>
                                <span class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 block">Departemen</span>
                                <p class="text-2xl lg:text-3xl font-bold text-slate-900 dark:text-white">
                                    {{ strtoupper($struktur->departemen) }}
                                </p>
                            </div>
                            @endif
                            <div>
                                <span class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 block">Masa Jabatan</span>
                                <p class="text-2xl lg:text-3xl font-bold text-slate-900 dark:text-white">
                                    2025-2026
                                </p>
                            </div>
                        </div>

                        {{-- KAHIM RESPONSIBILITIES --}}
                        @if($struktur->jabatan === 'kahim')
                            <div class="mt-8 pt-8 border-t border-emerald-200/30">
                                <h5 class="font-bold text-lg text-slate-900 mb-6 flex items-center gap-2">
                                    <i class="fas fa-list-check text-emerald-500"></i>
                                    Tanggung Jawab Utama
                                </h5>
                                <div class="space-y-3">
                                    <div class="flex items-start gap-3 p-4 bg-white/50 hover:bg-white rounded-xl border-l-4 border-emerald-300 hover:shadow-md transition-all">
                                        <div class="w-2 h-2 bg-emerald-500 rounded-full mt-3 flex-shrink-0"></div>
                                        <span class="text-base text-slate-700 leading-relaxed">Membawahi seluruh kepengurusan himpunan dan departemen</span>
                                    </div>
                                    <div class="flex items-start gap-3 p-4 bg-white/50 hover:bg-white rounded-xl border-l-4 border-emerald-300 hover:shadow-md transition-all">
                                        <div class="w-2 h-2 bg-emerald-500 rounded-full mt-3 flex-shrink-0"></div>
                                        <span class="text-base text-slate-700 leading-relaxed">Mewakili himpunan dalam rapat dan acara eksternal</span>
                                    </div>
                                    <div class="flex items-start gap-3 p-4 bg-white/50 hover:bg-white rounded-xl border-l-4 border-emerald-300 hover:shadow-md transition-all">
                                        <div class="w-2 h-2 bg-emerald-500 rounded-full mt-3 flex-shrink-0"></div>
                                        <span class="text-base text-slate-700 leading-relaxed">Membuat keputusan strategis organisasi</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- STATUS --}}
                    <div class="text-center pt-8 border-t border-slate-200/50">
                        <div class="inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-emerald-600 to-teal-600 
                                   text-white font-semibold text-lg rounded-2xl shadow-xl border border-emerald-400/50 hover:shadow-2xl transition-all">
                            <div class="w-3 h-3 bg-white rounded-full animate-ping"></div>
                            <span>{{ $struktur->jabatan === 'kahim' ? 'KETUA AKTIF' : 'AKTIF' }}</span>
                            <div class="w-2 h-2 bg-white/80 rounded-full"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- BACK TO TOP --}}
        <div class="text-center">
            <a href="{{ route('user.struktur.index') }}" 
               class="inline-flex items-center gap-3 px-8 py-4 bg-white dark:bg-slate-800 backdrop-blur-xl hover:bg-slate-50 dark:hover:bg-slate-700 
                      text-slate-900 dark:text-white font-semibold text-lg rounded-2xl shadow-2xl hover:shadow-3xl hover:-translate-y-1 transition-all duration-300 
                      border border-slate-200/60 hover:border-emerald-300">
                <i class="fas fa-arrow-left text-base"></i>
                <span>Kembali ke Struktur Organisasi</span>
            </a>
        </div>
    </div>
</section>
@endsection
