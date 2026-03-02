@extends('user.layouts.app')

@section('title', 'HIMANIKA - Landing Page Promosi')

@section('content')
{{-- Hero Section --}}
<section class="relative min-h-[85vh] md:min-h-[88vh] lg:min-h-[90vh] pt-16 pb-24 overflow-hidden 
    bg-gradient-to-br from-slate-900 via-purple-900 to-indigo-900 
    dark:from-slate-100 dark:via-indigo-100 dark:to-purple-100">
    <div class="absolute inset-0 bg-black/30 dark:bg-white/30 backdrop-blur-sm"></div>
    
    <div class="absolute inset-0 opacity-20 
        bg-[linear-gradient(rgba(255,255,255,0.08)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.08)_1px,transparent_1px)]
        dark:bg-[linear-gradient(rgba(148,163,184,0.08)_1px,transparent_1px),linear-gradient(90deg,rgba(148,163,184,0.08)_1px,transparent_1px)]
        [background-size:40px_40px]"></div>

    <div class="max-w-6xl mx-auto px-6 lg:px-12 relative z-10 h-full flex flex-col justify-center">
        <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-20 py-12 lg:py-16">
            {{-- Left Content --}}
            <div class="lg:w-1/2 text-center lg:text-left space-y-8">
                {{-- Badge --}}
                <div class="inline-flex items-center gap-3 px-6 py-3 
                    bg-white/15 dark:bg-slate-900/40 backdrop-blur-xl 
                    border border-white/20 dark:border-slate-800/40 
                    rounded-2xl shadow-xl hover:shadow-emerald-400/30 
                    hover:-translate-y-1 transition-all duration-300 mx-auto lg:mx-0 max-w-max">
                    <div class="w-3 h-3 bg-emerald-400 dark:bg-emerald-500 rounded-full shadow-md animate-ping"></div>
                    <span class="text-sm font-bold text-white dark:text-slate-900 drop-shadow">{{ $profils->name ?? 'HIMANIKA' }}</span>
                </div>

                {{-- Title --}}
                <div class="space-y-4">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-black leading-tight">
                        <span class="block bg-gradient-to-r from-white to-emerald-100 
                            dark:from-slate-900 dark:to-emerald-400 bg-clip-text text-transparent 
                            drop-shadow-xl mb-3">HIMANIKKA</span>
                        <span class="text-lg md:text-xl lg:text-2xl font-normal bg-gradient-to-r 
                            from-emerald-400 to-cyan-400 dark:from-emerald-500 dark:to-cyan-500 
                            bg-clip-text text-transparent drop-shadow tracking-wide">{{ $profils->sejarah ?? 'Himpunan Mahasiswa Informatika Unggul' }}</span>
                    </h1>
                    <p class="text-base md:text-lg lg:text-xl font-light max-w-lg mx-auto lg:mx-0 
                        text-white/90 dark:text-slate-800/90 drop-shadow 
                        bg-white/10 dark:bg-slate-900/20 backdrop-blur px-6 py-3 
                        rounded-xl border border-white/15 dark:border-slate-800/30">
                        {{ $profils->fungsi ?? 'Membangun generasi IT visioner melalui event dan workshop berkualitas' }}
                    </p>
                </div>

                {{-- CTAs --}}
                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start max-w-xl mx-auto lg:mx-0">
                    <a href="#profil" class="group flex items-center gap-3 px-8 py-4 
                        bg-gradient-to-r from-emerald-500 to-cyan-500 
                        dark:from-emerald-600 dark:to-cyan-600 text-white font-bold 
                        rounded-2xl shadow-xl hover:shadow-emerald-400/40 hover:shadow-2xl 
                        hover:-translate-y-2 hover:scale-105 transition-all duration-300 
                        border border-emerald-400/40 flex-1 justify-center text-sm md:text-base">
                        <i class="fas fa-info-circle text-xl group-hover:rotate-12"></i>
                        <span class="drop-shadow">Profil</span>
                    </a>
                    <a href="#event" class="group flex items-center gap-3 px-8 py-4 
                        bg-white/10 dark:bg-slate-200/80 backdrop-blur border-2 
                        border-white/20 dark:border-slate-700/50 text-white 
                        dark:text-slate-900 font-bold rounded-2xl hover:bg-white/25 
                        dark:hover:bg-slate-200/95 hover:shadow-xl hover:-translate-y-1 
                        transition-all duration-300 flex-1 justify-center text-sm md:text-base shadow-lg">
                        <i class="fas fa-rocket text-xl group-hover:animate-bounce"></i>
                        <span class="drop-shadow">Event</span>
                    </a>
                </div>

                {{-- Stats --}}
                <div class="flex gap-8 justify-center lg:justify-start pt-8 border-t border-white/20 dark:border-slate-700/40 pb-4">
                    <div class="text-center">
                        <div class="text-2xl md:text-3xl lg:text-4xl font-black 
                            bg-gradient-to-r from-emerald-400 to-cyan-400 
                            dark:from-emerald-500 dark:to-cyan-500 bg-clip-text 
                            text-transparent drop-shadow-xl mb-1">{{ $stats['total_users'] ?? '250' }}+</div>
                        <div class="text-xs font-bold uppercase tracking-wider 
                            text-white/80 dark:text-slate-800/80 drop-shadow">Anggota</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl md:text-3xl lg:text-4xl font-black 
                            bg-gradient-to-r from-emerald-400 to-cyan-400 
                            dark:from-emerald-500 dark:to-cyan-500 bg-clip-text 
                            text-transparent drop-shadow-xl mb-1">{{ $stats['total_events'] ?? '150' }}+</div>
                        <div class="text-xs font-bold uppercase tracking-wider 
                            text-white/80 dark:text-slate-800/80 drop-shadow">Event</div>
                    </div>
                </div>
            </div>

            {{-- Right Visual --}}
            <div class="lg:w-1/2 flex justify-center lg:justify-end">
                <div class="relative w-56 h-56 lg:w-72 lg:h-72 
                    bg-white/15 dark:bg-slate-900/40 backdrop-blur-xl 
                    rounded-2xl border-2 border-white/30 dark:border-slate-700/60 
                    shadow-2xl p-8 flex items-center justify-center 
                    group hover:shadow-emerald-400/50 hover:shadow-xl 
                    hover:-translate-y-3 hover:scale-105 transition-all duration-500">
                    <div class="relative w-24 h-24 lg:w-28 lg:h-28 
    bg-white/25 dark:bg-slate-900/50 backdrop-blur-xl 
    rounded-xl border-2 border-white/50 dark:border-slate-700/70 
    shadow-xl flex items-center justify-center 
    group-hover:scale-110 transition-all duration-500 overflow-hidden">

    {{-- Logo Container --}}
    <div class="relative w-full h-full flex flex-col items-center justify-center p-2">
        
        {{-- Logo Image --}}
        @if($profils->logo)
            <img src= "{{ $profils->logo }}" 
                 alt="{{ $profils->name ?? 'Logo HIMANIKA' }}" 
                 class="w-16 h-16 lg:w-20 lg:h-20 object-contain rounded-lg shadow-lg 
                        group-hover:shadow-emerald-400/50 group-hover:scale-105 
                        transition-all duration-300 mx-auto drop-shadow-md"
                 loading="lazy">
            
            {{-- Logo Name (below image) --}}
            <p class="mt-1 text-xs lg:text-sm font-bold text-white/90 dark:text-slate-200/90 
                     truncate max-w-[90%] text-center leading-tight px-1 
                     group-hover:text-emerald-100 transition-colors">
                {{ $profils->name ?? 'HIMANIKA' }}
            </p>
        @else
            {{-- Default SVG Icon --}}
            <div class="w-16 h-16 lg:w-20 lg:h-20 bg-white/40 dark:bg-slate-800/60 
                       backdrop-blur rounded-lg flex items-center justify-center 
                       border border-white/60 dark:border-slate-700/70 shadow-md 
                       group-hover:bg-white/60 dark:group-hover:bg-slate-700/80 
                       transition-all duration-300">
                <svg class="w-10 h-10 lg:w-12 lg:h-12 text-white dark:text-slate-200 stroke-[2] drop-shadow-md" 
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" 
                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            
            {{-- Fallback Text --}}
            <p class="mt-1 text-xs lg:text-sm font-bold text-white/90 dark:text-slate-200/90 
                     truncate max-w-[90%] text-center leading-tight px-1">
                HIMANIKA
            </p>
        @endif

        {{-- Animated Border Effect --}}
        <div class="absolute inset-0 rounded-xl 
                    border-2 border-emerald-400/60 dark:border-emerald-500/70 
                    opacity-0 group-hover:opacity-100 
                    transition-all duration-500 animate-ping-slow"></div>
        
        {{-- Inner Glow Effect --}}
        <div class="absolute inset-0 bg-gradient-to-r from-emerald-400/20 to-cyan-400/20 
                    opacity-0 group-hover:opacity-100 rounded-xl 
                    transition-opacity duration-500 blur-sm"></div>
    </div>
</div>

                </div>
            </div>
        </div>

        {{-- Scroll Indicator --}}
        <div class="flex flex-col items-center gap-2 mt-12 opacity-85">
            <span class="text-xs font-semibold uppercase tracking-wider 
                text-white/70 dark:text-slate-800/70 drop-shadow">Scroll</span>
            <div class="w-5 h-10 border-2 border-white/40 dark:border-slate-800/60 
                rounded-full flex items-center justify-center p-1 shadow-lg backdrop-blur">
                <div class="w-2 h-2 bg-white dark:bg-slate-900 rounded-full animate-bounce" style="animation-direction: alternate;"></div>
            </div>
        </div>
    </div>
</section>

{{-- Profil Section --}}
<section id="profil" class="py-16 bg-white dark:bg-slate-900">
    <div class="max-w-5xl mx-auto px-4 lg:px-8">
        <div class="text-center mb-16">
            <span class="inline-block px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 text-white text-sm font-bold rounded-full mb-4 shadow-lg">
                Himpunan Mahasiswa Teknik Informatika
            </span>
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold bg-gradient-to-r from-gray-900 to-indigo-900 dark:from-slate-100 dark:to-indigo-300 bg-clip-text text-transparent mb-4">
                {{ $profils->name ?? 'HIMANIKA' }}
            </h2>
            <p class="text-lg text-gray-600 dark:text-slate-300 max-w-2xl mx-auto">
                {{ $profils->fungsi ?? 'Berkomitmen membangun ekosistem IT mahasiswa yang unggul dan visioner' }}
            </p>
        </div>

        <div class="grid lg:grid-cols-2 gap-8 mb-16">
            {{-- Left Column --}}
            <div class="space-y-6">
                <div class="p-6 lg:p-8 bg-gradient-to-r from-indigo-50/80 to-purple-50/80 dark:from-slate-800/50 dark:to-slate-700/50 rounded-2xl shadow-xl border border-indigo-100/50 backdrop-blur-sm">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-slate-100 mb-4 flex items-center">
                        <i class="fas fa-building text-2xl text-indigo-600 dark:text-indigo-400 mr-3"></i>Identitas Organisasi
                    </h3>
                    <div class="grid md:grid-cols-2 gap-6 text-base">
                        <div>
                            <div class="flex items-center mb-3">
                                <i class="fas fa-map-marker-alt text-emerald-500 dark:text-emerald-400 mr-3 text-lg"></i>
                                <span class="font-semibold text-gray-900 dark:text-slate-100">{{ $profils->alamat ?? 'Kampus Utama, Universitas Riau' }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-phone text-blue-500 dark:text-blue-400 mr-3 text-lg"></i>
                                <span class="font-semibold text-gray-900 dark:text-slate-100">{{ $profils->telepon ?? '(0761) 123456' }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-envelope text-pink-500 dark:text-pink-400 mr-3 text-lg"></i>
                                <a href="mailto:{{ $profils->email ?? 'info@himanika.ac.id' }}" class="font-bold text-indigo-700 dark:text-indigo-400 hover:text-indigo-900">{{ $profils->email ?? 'info@himanika.ac.id' }}</a>
                            </div>
                        </div>
                        @if($profils->motto)
                        <div class="md:col-span-2 pt-4 border-t border-indigo-200/50 dark:border-slate-700/50">
                            <blockquote class="text-lg italic text-gray-800 dark:text-slate-200 font-semibold border-l-4 border-indigo-500 dark:border-indigo-400 pl-4">
                                "{{ $profils->motto }}"
                            </blockquote>
                        </div>
                        @endif
                    </div>
                </div>

                @if($profils->sejarah)
                <div class="p-6 lg:p-8 bg-white/80 dark:bg-slate-800/80 rounded-2xl shadow-xl border border-gray-200/50 dark:border-slate-700/50 backdrop-blur-sm">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-slate-100 mb-4 flex items-center">
                        <i class="fas fa-history text-2xl text-emerald-500 dark:text-emerald-400 mr-3"></i>Sejarah Singkat
                    </h3>
                    <div class="prose prose-lg dark:prose-invert max-w-none text-gray-700 dark:text-slate-300 leading-relaxed text-base">
                        {!! nl2br(e($profils->sejarah)) !!}
                    </div>
                </div>
                @endif
            </div>

            {{-- Right Column --}}
            <div class="space-y-6">
                <div class="grid md:grid-cols-2 gap-4">
                    @if($profils->visi)
                    <div class="p-6 bg-gradient-to-br from-emerald-50/80 to-teal-50/80 dark:from-emerald-900/20 dark:to-teal-900/20 rounded-xl shadow-lg border border-emerald-200/50 text-center hover:shadow-xl transition-all backdrop-blur-sm">
                        <div class="w-12 h-12 bg-emerald-500 dark:bg-emerald-600 rounded-xl flex items-center justify-center mx-auto mb-3 text-white shadow-lg">
                            <i class="fas fa-eye text-lg"></i>
                        </div>
                        <h4 class="text-lg font-bold text-gray-900 dark:text-slate-100 mb-2">Visi</h4>
                        <p class="text-gray-700 dark:text-slate-300 font-medium text-sm leading-relaxed">{{ $profils->visi }}</p>
                    </div>
                    @endif

                    @if($profils->misi)
                    <div class="p-6 bg-gradient-to-br from-purple-50/80 to-pink-50/80 dark:from-purple-900/20 dark:to-pink-900/20 rounded-xl shadow-lg border border-purple-200/50 hover:shadow-xl transition-all backdrop-blur-sm">
                        <div class="w-12 h-12 bg-purple-500 dark:bg-purple-600 rounded-xl flex items-center justify-center mx-auto mb-3 text-white shadow-lg">
                            <i class="fas fa-bullseye text-lg"></i>
                        </div>
                        <h4 class="text-lg font-bold text-gray-900 dark:text-slate-100 mb-2">Misi</h4>
                        <p class="text-gray-700 dark:text-slate-300 text-sm leading-relaxed">{!! nl2br(e($profils->misi)) !!}</p>
                    </div>
                    @endif
                </div>

                <div class="space-y-6">
                    <div class="p-6 lg:p-8 bg-gradient-to-br from-orange-50/80 to-amber-50/80 dark:from-orange-900/20 dark:to-amber-900/20 rounded-2xl shadow-xl border border-orange-200/50 backdrop-blur-sm hover:shadow-2xl hover:-translate-y-1 transition-all">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-slate-100 mb-4 flex items-center">
                            <i class="fas fa-target text-2xl text-orange-500 dark:text-orange-400 mr-3"></i>Tujuan Organisasi
                        </h3>
                        <p class="text-base text-gray-700 dark:text-slate-300 leading-relaxed font-medium">
                            {{ $profils->tujuan ?? 'Membangun generasi IT unggul melalui pendidikan, kompetisi, dan kolaborasi industri' }}
                        </p>
                    </div>

                    @if($profils->lagu)
                    <div class="group cursor-pointer p-6 lg:p-8 bg-gradient-to-r from-indigo-50/80 to-blue-50/80 dark:from-indigo-900/30 dark:to-blue-900/30 rounded-2xl shadow-xl border border-indigo-200/50 backdrop-blur-sm hover:shadow-2xl hover:-translate-y-1 transition-all" 
                         onclick="window.open('{{ asset('storage/' . $profils->lagu) }}', '_blank')">
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-indigo-500 dark:bg-indigo-600 rounded-xl flex items-center justify-center mr-4 text-white shadow-lg flex-shrink-0 mt-1 group-hover:scale-110 transition-transform">
                                <i class="fas fa-music text-xl"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="font-semibold text-gray-900 dark:text-slate-100 mb-1 text-lg group-hover:text-indigo-700 transition-colors">Lagu Mars HIMANIKA</h4>
                                <p class="text-indigo-800 dark:text-indigo-200 text-base leading-relaxed truncate">{{ $profils->lagu ?? 'Mars HIMANIKA' }}</p>
                                <p class="text-xs text-indigo-600 dark:text-indigo-400 mt-1 opacity-0 group-hover:opacity-100 transition-all">Klik untuk download</p>
                            </div>
                            <div class="ml-3 opacity-0 group-hover:opacity-100 transition-all">
                                <i class="fas fa-download text-indigo-500 text-lg"></i>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($profils->instrumen)
                    <div class="group cursor-pointer p-6 lg:p-8 bg-gradient-to-r from-emerald-50/80 to-teal-50/80 dark:from-emerald-900/30 dark:to-teal-900/30 rounded-2xl shadow-xl border border-emerald-200/50 backdrop-blur-sm hover:shadow-2xl hover:-translate-y-1 transition-all" 
                         onclick="window.open('{{ asset('storage/' . $profils->instrumen) }}', '_blank')">
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-emerald-500 dark:bg-emerald-600 rounded-xl flex items-center justify-center mr-4 text-white shadow-lg flex-shrink-0 mt-1 group-hover:scale-110 transition-transform">
                                <i class="fas fa-drum text-xl"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="font-semibold text-gray-900 dark:text-slate-100 mb-1 text-lg group-hover:text-emerald-700 transition-colors">Instrumen Musik</h4>
                                <p class="text-emerald-800 dark:text-emerald-200 text-base leading-relaxed truncate">{{ $profils->instrumen ?? 'Mars HIMANIKA Instrumental' }}</p>
                                <p class="text-xs text-emerald-600 dark:text-emerald-400 mt-1 opacity-0 group-hover:opacity-100 transition-all">Klik untuk download</p>
                            </div>
                            <div class="ml-3 opacity-0 group-hover:opacity-100 transition-all">
                                <i class="fas fa-download text-emerald-500 text-lg"></i>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Stats --}}
        <div class="grid md:grid-cols-3 gap-6 pt-8 border-t border-gray-200/50 dark:border-slate-700/50">
            <div class="text-center p-6 bg-gradient-to-r from-indigo-500 to-blue-600 text-white rounded-2xl shadow-xl hover:shadow-2xl hover:-translate-y-1 transition-all">
                <i class="fas fa-users text-2xl mb-3 opacity-90"></i>
                <div class="text-3xl font-bold mb-1">{{ $stats['total_users'] ?? '250' }}</div>
                <div class="text-sm font-semibold">Anggota Aktif</div>
            </div>
            <div class="text-center p-6 bg-gradient-to-r from-emerald-500 to-teal-600 text-white rounded-2xl shadow-xl hover:shadow-2xl hover:-translate-y-1 transition-all">
                <i class="fas fa-calendar-days text-2xl mb-3 opacity-90"></i>
                <div class="text-3xl font-bold mb-1">{{ $stats['total_events'] ?? '150' }}</div>
                <div class="text-sm font-semibold">Event/Tahun</div>
            </div>
            <div class="text-center p-6 bg-gradient-to-r from-purple-500 to-pink-600 text-white rounded-2xl shadow-xl hover:shadow-2xl hover:-translate-y-1 transition-all">
                <i class="fas fa-calendar-check text-2xl mb-3 opacity-90"></i>
                <div class="text-3xl font-bold mb-1">{{ $stats['total_kegiatan'] ?? '75' }}</div>
                <div class="text-sm font-semibold">Kegiatan</div>
            </div>
        </div>
    </div>
</section>

{{-- Struktur Organisasi Section --}}
<!-- Ganti background section ini saja -->
<!-- Light mode background -->
<section id="struktur" class="py-16 bg-gradient-to-b from-gray-50 to-white dark:from-slate-900 dark:to-slate-950">

    <div class="max-w-6xl mx-auto px-4 lg:px-8">
    {{-- Header --}}
    <div class="text-center mb-16">
        <h2 class="text-4xl md:text-5xl lg:text-6xl font-black bg-gradient-to-r from-emerald-400 via-teal-400 to-emerald-500 bg-clip-text text-transparent mb-6 tracking-tight drop-shadow-2xl">
            STRUKTUR ORGANISASI
        </h2>
        <p class="text-xl font-semibold max-w-3xl mx-auto leading-tight text-gray-700 dark:text-slate-200">
            HIERARKI KEPIMPINAN DAN DIVISI HIMANIKA
        </p>
    </div>

    {{-- Flowchart Container --}}
    <div class="overflow-x-auto">
        <div class="flowchart-container min-w-[1000px] mx-auto">
            
            {{-- LEVEL 1: KAHIM --}}
            <div class="flex justify-center mb-14">
                <div class="struktur-node bg-gradient-to-br from-emerald-500 to-emerald-700 text-white p-8 rounded-2xl shadow-2xl max-w-sm mx-auto border-4 border-emerald-400/50 backdrop-blur-xl relative overflow-hidden group hover:shadow-emerald-500/25">
                    @php $kahim = $strukturs->where('jabatan', 'kahim')->first(); @endphp
                    
                    @if($kahim)
                        <div class="avatar-container w-28 h-28 mx-auto mb-6 relative z-10 overflow-hidden rounded-2xl shadow-2xl ring-4 ring-white/50">
                            @if($kahim->avatar && Storage::disk('public')->exists($kahim->avatar))
                                <img src="{{ Storage::url($kahim->avatar) }}" alt="{{ $kahim->user->name }}" class="w-full h-full object-cover hover:scale-105 transition-all duration-300">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-emerald-400/80 to-teal-400/80 flex items-center justify-center backdrop-blur-md">
                                    <i class="fas fa-crown text-4xl text-white shadow-xl"></i>
                                </div>
                            @endif
                        </div>
                        <h3 class="text-3xl font-black mb-3 tracking-tight z-10">KAHIM</h3>
                        <p class="text-xl font-bold mb-4 z-10">{{ $kahim->user->name }}</p>
                        <div class="bg-white/20 px-4 py-2 rounded-xl backdrop-blur-xl border-2 border-white/40 z-10">
                            <span class="text-base font-black tracking-widest">2025-2026</span>
                        </div>
                    @else
                        <div class="w-28 h-28 mx-auto mb-6 bg-gradient-to-br from-slate-500/40 to-slate-600/40 rounded-2xl flex items-center justify-center border-2 border-dashed border-white/30 backdrop-blur-xl">
                            <i class="fas fa-crown text-4xl text-white/70"></i>
                        </div>
                        <h3 class="text-3xl font-black mb-4 tracking-tight text-white/80">KAHIM</h3>
                        <p class="text-xl font-bold text-white/60">BELUM DIISI</p>
                    @endif
                </div>
            </div>

            {{-- LEVEL 2: Wakil & Staf Utama --}}
            <div class="flex justify-center items-end gap-8 mb-16 relative">
                <div class="absolute inset-0 flex items-end justify-center">
                    <div class="w-px h-20 bg-gradient-to-t from-emerald-400 via-teal-400 to-transparent shadow-md"></div>
                </div>

                {{-- Wakil Ketua --}}
                <div class="struktur-node bg-gradient-to-br from-purple-500 to-purple-700 text-white p-6 rounded-2xl shadow-2xl max-w-xs border-4 border-purple-400/50 backdrop-blur-xl hover:scale-105 transition-all duration-300 relative group hover:shadow-purple-500/25">
                    @php $wakahim = $strukturs->where('jabatan', 'wakahim')->first(); @endphp
                    @if($wakahim)
                        <div class="w-20 h-20 mx-auto mb-4 relative overflow-hidden rounded-xl shadow-xl ring-4 ring-white/50">
                            @if(Storage::disk('public')->exists($wakahim->avatar))
                                <img src="{{ Storage::url($wakahim->avatar) }}" alt="{{ $wakahim->user->name }}" class="w-full h-full object-cover hover:scale-105">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-purple-400/80 to-pink-400/80 flex items-center justify-center backdrop-blur-md">
                                    <i class="fas fa-user-tie text-xl text-white"></i>
                                </div>
                            @endif
                        </div>
                        <h4 class="text-2xl font-black mb-2 tracking-tight">WAKAHIM</h4>
                        <p class="text-lg font-bold mb-2">{{ $wakahim->user->name }}</p>
                        <div class="text-sm font-bold bg-white/20 px-3 py-1.5 rounded-lg border-2 border-white/40">
                            {{ $wakahim->posisi ?? 'KOORDINATOR' }}
                        </div>
                    @else
                        <h4 class="text-2xl font-black mb-4 tracking-tight text-white/80">WAKAHIM</h4>
                        <p class="text-lg text-white/60 font-bold">BELUM DIISI</p>
                    @endif
                </div>

                {{-- SEKRETARIS --}}
                <div class="struktur-node bg-gradient-to-br from-indigo-500 to-indigo-700 text-white p-6 rounded-2xl shadow-2xl max-w-xs border-4 border-indigo-400/50 backdrop-blur-xl hover:scale-105 transition-all duration-300 relative group hover:shadow-indigo-500/25">
                    @php $sekretaris = $strukturs->where('jabatan', 'sekretaris')->first(); @endphp
                    @if($sekretaris)
                        <div class="w-20 h-20 mx-auto mb-4 relative overflow-hidden rounded-xl shadow-xl ring-4 ring-white/50">
                            @if(Storage::disk('public')->exists($sekretaris->avatar))
                                <img src="{{ Storage::url($sekretaris->avatar) }}" alt="{{ $sekretaris->user->name }}" class="w-full h-full object-cover hover:scale-105">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-blue-400/80 to-indigo-400/80 flex items-center justify-center backdrop-blur-md">
                                    <i class="fas fa-file-signature text-xl text-white"></i>
                                </div>
                            @endif
                        </div>
                        <h4 class="text-2xl font-black mb-2 tracking-tight">SEKRETARIS</h4>
                        <p class="text-lg font-bold mb-2">{{ $sekretaris->user->name }}</p>
                        <div class="text-sm font-bold bg-white/20 px-3 py-1.5 rounded-lg border-2 border-white/40">
                            {{ $sekretaris->posisi ?? 'KOORDINATOR' }}
                        </div>
                    @else
                        <h4 class="text-2xl font-black mb-4 tracking-tight text-white/80">SEKRETARIS</h4>
                        <p class="text-lg text-white/60 font-bold">BELUM DIISI</p>
                    @endif
                </div>

                {{-- BENDAHARA --}}
                <div class="struktur-node bg-gradient-to-br from-rose-500 to-rose-700 text-white p-6 rounded-2xl shadow-2xl max-w-xs border-4 border-rose-400/50 backdrop-blur-xl hover:scale-105 transition-all duration-300 relative group hover:shadow-rose-500/25">
                    @php $bendahara = $strukturs->where('jabatan', 'bendahara')->first(); @endphp
                    @if($bendahara)
                        <div class="w-20 h-20 mx-auto mb-4 relative overflow-hidden rounded-xl shadow-xl ring-4 ring-white/50">
                            @if(Storage::disk('public')->exists($bendahara->avatar))
                                <img src="{{ Storage::url($bendahara->avatar) }}" alt="{{ $bendahara->user->name }}" class="w-full h-full object-cover hover:scale-105">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-red-400/80 to-rose-400/80 flex items-center justify-center backdrop-blur-md">
                                    <i class="fas fa-wallet text-xl text-white"></i>
                                </div>
                            @endif
                        </div>
                        <h4 class="text-2xl font-black mb-2 tracking-tight">BENDAHARA</h4>
                        <p class="text-lg font-bold mb-2">{{ $bendahara->user->name }}</p>
                        <div class="text-sm font-bold bg-white/20 px-3 py-1.5 rounded-lg border-2 border-white/40">
                            {{ $bendahara->posisi ?? 'KOORDINATOR' }}
                        </div>
                    @else
                        <h4 class="text-2xl font-black mb-4 tracking-tight text-white/80">BENDAHARA</h4>
                        <p class="text-lg text-white/60 font-bold">BELUM DIISI</p>
                    @endif
                </div>
            </div>

            {{-- LEVEL 3: DEPARTEMEN --}}
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-10">
                @php
                    $departemen = ['kwu', 'minatbakat', 'pemberdaya_wanita', 'humas'];
                    $colors = ['indigo', 'emerald', 'yellow', 'orange'];
                @endphp
                @foreach($departemen as $index => $dep)
                    <div class="struktur-dept bg-gradient-to-br from-{{ $colors[$index] }}-500 to-{{ $colors[$index] }}-700 text-white p-6 rounded-2xl shadow-2xl border-4 border-{{ $colors[$index] }}-400/50 min-h-[220px] hover:scale-105 transition-all duration-300 relative group hover:shadow-{{ $colors[$index] }}-500/25">
                        <h5 class="text-xl font-black mb-6 text-center uppercase tracking-widest text-white drop-shadow-lg">
                            {{ strtoupper($dep) }}
                        </h5>
                        <div class="space-y-3">
                            @foreach($strukturs->where('departemen', $dep)->take(3) as $anggota)
                                <div class="flex items-center space-x-3 p-3 bg-white/15 backdrop-blur-xl rounded-xl hover:bg-white/25 transition-all group-hover:translate-y-[-1px]">
                                    @if(Storage::disk('public')->exists($anggota->avatar))
                                        <img src="{{ Storage::url($anggota->avatar) }}" alt="{{ $anggota->user->name }}" class="w-12 h-12 rounded-xl object-cover ring-2 ring-white/50 shadow-lg">
                                    @else
                                        <div class="w-12 h-12 bg-gradient-to-br from-{{ $colors[$index] }}-400/90 to-{{ $colors[$index] }}-500/90 rounded-xl flex items-center justify-center text-xs font-black text-white shadow-lg">
                                            {{ substr($anggota->user->name, 0, 2) }}
                                        </div>
                                    @endif
                                    <div class="flex-1 min-w-0">
                                        <p class="text-base font-bold truncate text-white drop-shadow-md">{{ $anggota->user->name }}</p>
                                        <p class="text-xs font-semibold text-white/95 drop-shadow-sm">{{ $anggota->posisi ?? 'ANGGOTA' }}</p>
                                    </div>
                                </div>
                            @endforeach
                            @if($strukturs->where('departemen', $dep)->count() === 0)
                                <div class="flex flex-col items-center justify-center h-32 text-center">
                                    <i class="fas fa-users text-3xl text-white/50 mb-3"></i>
                                    <p class="text-lg font-bold text-white/70 drop-shadow-md">BELUM ADA ANGGOTA</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- LEGEND --}}
    <div class="mt-16 grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
        <div class="flex items-center justify-center space-x-3 p-3 bg-white/20 dark:bg-slate-800/60 backdrop-blur-xl rounded-xl border border-white/30">
            <div class="w-4 h-4 bg-gradient-to-r from-emerald-400 to-teal-400 rounded-full shadow-lg border-2 border-white/50"></div>
            <span class="text-lg font-bold text-white tracking-wide drop-shadow-sm">KETUA</span>
        </div>
        <div class="flex items-center justify-center space-x-3 p-3 bg-white/20 dark:bg-slate-800/60 backdrop-blur-xl rounded-xl border border-white/30">
            <div class="w-4 h-4 bg-gradient-to-r from-purple-400 to-pink-400 rounded-full shadow-lg border-2 border-white/50"></div>
            <span class="text-lg font-bold text-white tracking-wide drop-shadow-sm">WAKIL & STAFF</span>
        </div>
        <div class="flex items-center justify-center space-x-3 p-3 bg-white/20 dark:bg-slate-800/60 backdrop-blur-xl rounded-xl border border-white/30">
            <div class="w-4 h-4 bg-gradient-to-r from-indigo-400 to-blue-400 rounded-full shadow-lg border-2 border-white/50"></div>
            <span class="text-lg font-bold text-white tracking-wide drop-shadow-sm">KOORDINATOR</span>
        </div>
        <div class="flex items-center justify-center space-x-3 p-3 bg-white/20 dark:bg-slate-800/60 backdrop-blur-xl rounded-xl border border-white/30">
            <div class="w-4 h-4 bg-gradient-to-r from-slate-400 to-slate-500 rounded-full shadow-lg border-2 border-white/50"></div>
            <span class="text-lg font-bold text-white tracking-wide drop-shadow-sm">ANGGOTA</span>
        </div>
    </div>
</div>

</section>



{{-- Legalitas Section --}}
<!-- <section id="legalitas" class="py-16 bg-gradient-to-r from-slate-50/80 to-indigo-50/80 dark:from-slate-900/50 dark:to-indigo-900/30">
    <div class="max-w-5xl mx-auto px-4 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 dark:from-slate-200 dark:to-slate-400 bg-clip-text text-transparent mb-4">Legalitas HIMANIKA</h2>
            <p class="text-lg text-gray-600 dark:text-slate-300 max-w-2xl mx-auto">Terdaftar resmi dan diakui oleh universitas serta instansi terkait</p>
        </div>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach([
                ['file-contract', 'indigo', 'SK Rektor', 'No. 123/UN/X/2024', 'Surat Keputusan Rektor Universitas Riau'],
                ['stamp', 'emerald', 'SK Dekan', 'No. 456/FIKOM/2024', 'Pengesahan Fakultas Ilmu Komputer'],
                ['certificate', 'purple', 'SK BEM', 'No. 789/BEM/2024', 'Pengakuan Badan Eksekutif Mahasiswa'],
                ['award', 'orange', 'NPWP', '12.345.678.9-123.000', 'Terdaftar Kemenkumham'],
                ['shield-alt', 'blue', 'IZI', 'No. 321/IZI/2024', 'Sertifikasi Internal Zakat Infaq'],
                ['medal', 'pink', 'AD/ART', 'Versi 5.0/2024', 'Anggaran Dasar & Rumah Tangga']
            ] as $index => $legal)
            <div class="group bg-white/95 dark:bg-slate-800/95 p-8 lg:p-10 rounded-2xl shadow-xl hover:shadow-2xl hover:-translate-y-3 transition-all duration-700 border border-gray-100/50 dark:border-slate-700/50 backdrop-blur-sm text-center">
                <div class="w-20 h-20 bg-{{ $legal[1] }}-100/80 dark:bg-{{ $legal[1] }}-900/40 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-xl group-hover:bg-{{ $legal[1] }}-200/80 dark:group-hover:bg-{{ $legal[1] }}-800/30 transition-all">
                    <i class="fas fa-{{ $legal[0] }} text-3xl text-{{ $legal[1] }}-600 dark:text-{{ $legal[1] }}-400"></i>
                </div>
                <h3 class="text-2xl font-black text-gray-900 dark:text-slate-100 mb-3">{{ $legal[2] }}</h3>
                <p class="text-gray-600 dark:text-slate-400 mb-4 font-bold text-lg bg-gradient-to-r from-gray-100 to-gray-200 dark:from-slate-800 dark:to-slate-700 px-4 py-2 rounded-xl">{{ $legal[3] }}</p>
                <div class="bg-gradient-to-r from-{{ $legal[1] }}-50/80 to-{{ $legal[1] }}-100/80 dark:from-{{ $legal[1] }}-900/30 dark:to-{{ $legal[1] }}-800/20 p-4 rounded-xl backdrop-blur-sm">
                    <p class="text-{{ $legal[1] }}-800 dark:text-{{ $legal[1] }}-200 font-semibold text-sm">{{ $legal[4] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section> -->

{{-- Kegiatan Section LENGKAP --}}
<section id="kegiatan" class="py-16 bg-gradient-to-r from-indigo-50/80 to-purple-50/80 dark:from-slate-800/50 dark:to-slate-700/50">
    <div class="max-w-5xl mx-auto px-4 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold bg-gradient-to-r from-indigo-600 to-blue-600 dark:from-indigo-400 dark:to-blue-400 bg-clip-text text-transparent mb-4">Kegiatan Unggulan</h2>
            <p class="text-lg text-gray-700 dark:text-slate-300 max-w-2xl mx-auto">Program unggulan HIMANIKA berdasarkan database kegiatan</p>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($kegiatans->where('status', 1)->take(6) as $kegiatan)
                <div class="group bg-white/95 dark:bg-slate-800/95 rounded-2xl shadow-xl hover:shadow-2xl hover:-translate-y-3 transition-all duration-700 overflow-hidden border border-gray-200/50 dark:border-slate-700/50 backdrop-blur-sm">
                    {{-- Header Image/Icon --}}
                    <div class="h-48 lg:h-56 relative group-hover:scale-105 transition-transform duration-700 overflow-hidden">
                        @if($kegiatan->image && Storage::disk('public')->exists($kegiatan->image))
                            <img src="{{ Storage::url($kegiatan->image) }}" alt="{{ $kegiatan->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                        @else
                            @php 
                                $colors = ['indigo', 'emerald', 'purple', 'blue', 'orange', 'pink'];
                                $colorIndex = $loop->index % count($colors);
                            @endphp
                            <div class="w-full h-full bg-gradient-to-r from-{{ $colors[$colorIndex] }}-500 to-{{ $colors[$colorIndex] }}-600 dark:from-{{ $colors[$colorIndex] }}-600 dark:to-{{ $colors[$colorIndex] }}-700 absolute inset-0">
                                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                    @switch(strtolower($kegiatan->name))
                                        @case(str_contains(strtolower($kegiatan->name), 'workshop') || str_contains(strtolower($kegiatan->name), 'training'))
                                            <i class="fas fa-laptop-code text-5xl text-white opacity-0 group-hover:opacity-100 transition-all duration-700 animate-pulse"></i>
                                            @break
                                        @case(str_contains(strtolower($kegiatan->name), 'lomba') || str_contains(strtolower($kegiatan->name), 'competition') || str_contains(strtolower($kegiatan->name), 'champion'))
                                            <i class="fas fa-trophy text-5xl text-white opacity-0 group-hover:opacity-100 transition-all duration-700 animate-pulse"></i>
                                            @break
                                        @case(str_contains(strtolower($kegiatan->name), 'study') || str_contains(strtolower($kegiatan->name), 'group') || str_contains(strtolower($kegiatan->name), 'grup'))
                                            <i class="fas fa-users text-5xl text-white opacity-0 group-hover:opacity-100 transition-all duration-700 animate-pulse"></i>
                                            @break
                                        @default
                                            <i class="fas fa-rocket text-5xl text-white opacity-0 group-hover:opacity-100 transition-all duration-700 animate-pulse"></i>
                                    @endswitch
                                </div>
                            </div>
                        @endif
                    </div>
                    
                    <div class="p-8">
                        <h3 class="text-2xl font-black text-gray-900 dark:text-slate-100 mb-4 line-clamp-2">{{ $kegiatan->name }}</h3>
                        <p class="text-gray-600 dark:text-slate-400 mb-6 text-base leading-relaxed line-clamp-3">{{ $kegiatan->description }}</p>
                        
                        {{-- Status Badge --}}
                        <div class="flex items-center font-bold mb-6 text-lg">
                            @if($kegiatan->status == 1)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-emerald-100 dark:bg-emerald-900/50 text-emerald-700 dark:text-emerald-300">
                                    <i class="fas fa-check-circle mr-2"></i>Aktif
                                </span>
                            @elseif($kegiatan->status == 0)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-orange-100 dark:bg-orange-900/50 text-orange-700 dark:text-orange-300">
                                    <i class="fas fa-clock mr-2"></i>Sedang Disiapkan
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-gray-100 dark:bg-slate-700/50 text-gray-700 dark:text-slate-300">
                                    <i class="fas fa-check-double mr-2"></i>Selesai
                                </span>
                            @endif
                        </div>

                        {{-- BUTTONS --}}
                        @if($kegiatan->link)
                            <a href="{{ $kegiatan->link }}" target="_blank" class="group/btn inline-flex items-center font-black text-lg bg-gradient-to-r from-indigo-500 to-blue-600 dark:from-indigo-600 dark:to-blue-700 hover:from-indigo-600 hover:to-blue-700 text-white px-6 py-3 rounded-xl hover:shadow-lg hover:-translate-y-1 transition-all duration-300 w-full justify-center">
                                Lihat Detail
                                <i class="fas fa-arrow-right ml-2 group-hover/btn:translate-x-1 transition-transform"></i>
                            </a>
                        @else
                            {{-- FEEDBACK BUTTONS PER KEGIATAN --}}
                            <div class="flex flex-wrap gap-2">
                                {{-- Like --}}
                                <form action="{{ route('masukkan.store') }}" method="POST" class="inline-flex flex-1 min-w-[100px]">
                                    @csrf
                                    <input type="hidden" name="tipe" value="like">
                                    <input type="hidden" name="kegiatan_id" value="{{ $kegiatan->id }}">
                                    <button type="submit" class="group/btn flex items-center justify-center px-4 py-2.5 bg-emerald-500/90 hover:bg-emerald-600 text-white font-bold text-sm rounded-lg shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200 flex-1">
                                        <i class="fas fa-thumbs-up mr-1 text-sm group-hover/btn:scale-110 transition-transform"></i>
                                        Like ({{ $masukkans->where('tipe', 'like')->where('kegiatan_id', $kegiatan->id)->count() }})
                                    </button>
                                </form>

                                {{-- Dislike --}}
                                <form action="{{ route('masukkan.store') }}" method="POST" class="inline-flex flex-1 min-w-[100px]">
                                    @csrf
                                    <input type="hidden" name="tipe" value="dislike">
                                    <input type="hidden" name="kegiatan_id" value="{{ $kegiatan->id }}">
                                    <button type="submit" class="group/btn flex items-center justify-center px-4 py-2.5 bg-red-500/90 hover:bg-red-600 text-white font-bold text-sm rounded-lg shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200 flex-1">
                                        <i class="fas fa-thumbs-down mr-1 text-sm group-hover/btn:scale-110 transition-transform"></i>
                                        Dislike ({{ $masukkans->where('tipe', 'dislike')->where('kegiatan_id', $kegiatan->id)->count() }})
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-24">
                    <i class="fas fa-calendar-times text-6xl text-gray-300 dark:text-slate-600 mb-6"></i>
                    <h3 class="text-2xl font-bold text-gray-500 dark:text-slate-400 mb-2">Belum Ada Kegiatan</h3>
                    <p class="text-gray-500 dark:text-slate-500">Kegiatan unggulan akan segera hadir</p>
                </div>
            @endforelse

            {{-- MASUKKAN FEEDBACK GLOBAL --}}
            <div class="md:col-span-2 lg:col-span-3 mt-12 bg-gradient-to-br from-slate-900/20 to-slate-800/20 dark:from-slate-800/40 dark:to-slate-900/40 border-2 border-indigo-200/30 dark:border-indigo-800/40 rounded-3xl p-8 backdrop-blur-xl shadow-2xl group hover:shadow-3xl hover:-translate-y-2 transition-all duration-500">
                <div class="text-center mb-8">
                    <div class="w-20 h-20 mx-auto mb-6 bg-gradient-to-r from-indigo-500 to-blue-600 dark:from-indigo-600 dark:to-blue-700 rounded-3xl flex items-center justify-center shadow-2xl group-hover:scale-105 transition-all duration-300">
                        <i class="fas fa-comment-dots text-2xl text-white"></i>
                    </div>
                    <h3 class="text-3xl font-black bg-gradient-to-r from-indigo-600 to-blue-600 dark:from-indigo-400 dark:to-blue-400 bg-clip-text text-transparent mb-3 tracking-tight">Total Masukan</h3>
                    <p class="text-lg text-gray-700 dark:text-slate-300 max-w-2xl mx-auto mb-6">Kritik, saran, atau penilaianmu sangat berarti untuk kami</p>
                </div>

                {{-- STATS 4 KOLOM --}}
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                    {{-- Likes --}}
                    <div class="group text-center p-6 bg-white/90 dark:bg-slate-800/90 backdrop-blur-xl rounded-2xl border border-indigo-200/50 dark:border-slate-700/50 hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                        <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-2xl flex items-center justify-center shadow-xl group-hover:scale-110 transition-all">
                            <i class="fas fa-thumbs-up text-2xl text-white"></i>
                        </div>
                        <p class="text-3xl font-black text-emerald-600 dark:text-emerald-400 mb-1">{{ $masukkans->where('tipe', 'like')->count() }}</p>
                        <span class="text-sm font-semibold text-gray-700 dark:text-slate-300">Likes</span>
                    </div>

                    {{-- Dislikes --}}
                    <div class="group text-center p-6 bg-white/90 dark:bg-slate-800/90 backdrop-blur-xl rounded-2xl border border-indigo-200/50 dark:border-slate-700/50 hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                        <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-r from-red-500 to-red-600 rounded-2xl flex items-center justify-center shadow-xl group-hover:scale-110 transition-all">
                            <i class="fas fa-thumbs-down text-2xl text-white"></i>
                        </div>
                        <p class="text-3xl font-black text-red-600 dark:text-red-400 mb-1">{{ $masukkans->where('tipe', 'dislike')->count() }}</p>
                        <span class="text-sm font-semibold text-gray-700 dark:text-slate-300">Dislikes</span>
                    </div>

                    {{-- Saran --}}
                    <div class="group text-center p-6 bg-white/90 dark:bg-slate-800/90 backdrop-blur-xl rounded-2xl border border-indigo-200/50 dark:border-slate-700/50 hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                        <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center shadow-xl group-hover:scale-110 transition-all">
                            <i class="fas fa-lightbulb text-2xl text-white"></i>
                        </div>
                        <p class="text-3xl font-black text-blue-600 dark:text-blue-400 mb-1">{{ $masukkans->where('tipe', 'saran')->count() }}</p>
                        <span class="text-sm font-semibold text-gray-700 dark:text-slate-300">Saran</span>
                    </div>

                    {{-- Kritik --}}
                    <div class="group text-center p-6 bg-white/90 dark:bg-slate-800/90 backdrop-blur-xl rounded-2xl border border-indigo-200/50 dark:border-slate-700/50 hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                        <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-r from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-xl group-hover:scale-110 transition-all">
                            <i class="fas fa-exclamation-triangle text-2xl text-white"></i>
                        </div>
                        <p class="text-3xl font-black text-purple-600 dark:text-purple-400 mb-1">{{ $masukkans->where('tipe', 'kritik')->count() }}</p>
                        <span class="text-sm font-semibold text-gray-700 dark:text-slate-300">Kritik</span>
                    </div>
                </div>

                {{-- GLOBAL FEEDBACK BUTTONS --}}
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 pt-4">
                    {{-- Like --}}
                    <form action="{{ route('masukkan.store') }}" method="POST" class="contents">
                        @csrf
                        <input type="hidden" name="tipe" value="like">
                        <button type="submit" class="group relative p-4 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                            <div class="flex items-center justify-center space-x-2">
                                <i class="fas fa-thumbs-up text-xl group-hover:scale-110 transition-transform"></i>
                                <span class="text-sm font-bold">Like</span>
                                <span class="absolute -top-2 -right-2 bg-white/20 text-xs px-2 py-1 rounded-full opacity-0 group-hover:opacity-100 transition-all">{{ $masukkans->where('tipe', 'like')->count() }}</span>
                            </div>
                            <div class="absolute inset-0 bg-white/20 scale-0 group-hover:scale-100 transition-transform origin-center duration-300"></div>
                        </button>
                    </form>

                    {{-- Dislike --}}
                    <form action="{{ route('masukkan.store') }}" method="POST" class="contents">
                        @csrf
                        <input type="hidden" name="tipe" value="dislike">
                        <button type="submit" class="group relative p-4 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                            <div class="flex items-center justify-center space-x-2">
                                <i class="fas fa-thumbs-down text-xl group-hover:scale-110 transition-transform"></i>
                                <span class="text-sm font-bold">Dislike</span>
                                <span class="absolute -top-2 -right-2 bg-white/20 text-xs px-2 py-1 rounded-full opacity-0 group-hover:opacity-100 transition-all">{{ $masukkans->where('tipe', 'dislike')->count() }}</span>
                            </div>
                            <div class="absolute inset-0 bg-white/20 scale-0 group-hover:scale-100 transition-transform origin-center duration-300"></div>
                        </button>
                    </form>

                    {{-- Saran --}}
                    <form action="{{ route('masukkan.store') }}" method="POST" class="md:col-span-2 contents">
                        @csrf
                        <input type="hidden" name="tipe" value="saran">
                        <button type="submit" class="group relative p-4 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden w-full">
                            <div class="flex items-center justify-center space-x-2">
                                <i class="fas fa-lightbulb text-xl group-hover:scale-110 transition-transform"></i>
                                <span class="text-sm font-bold">Saran</span>
                                <span class="absolute -top-2 -right-2 bg-white/20 text-xs px-2 py-1 rounded-full opacity-0 group-hover:opacity-100 transition-all">{{ $masukkans->where('tipe', 'saran')->count() }}</span>
                            </div>
                            <div class="absolute inset-0 bg-white/20 scale-0 group-hover:scale-100 transition-transform origin-center duration-300"></div>
                        </button>
                    </form>

                    {{-- Kritik --}}
                    <form action="{{ route('masukkan.store') }}" method="POST" class="contents">
                        @csrf
                        <input type="hidden" name="tipe" value="kritik">
                        <button type="submit" class="group relative p-4 bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                            <div class="flex items-center justify-center space-x-2">
                                <i class="fas fa-exclamation-triangle text-xl group-hover:scale-110 transition-transform"></i>
                                <span class="text-sm font-bold">Kritik</span>
                                <span class="absolute -top-2 -right-2 bg-white/20 text-xs px-2 py-1 rounded-full opacity-0 group-hover:opacity-100 transition-all">{{ $masukkans->where('tipe', 'kritik')->count() }}</span>
                            </div>
                            <div class="absolute inset-0 bg-white/20 scale-0 group-hover:scale-100 transition-transform origin-center duration-300"></div>
                        </button>
                    </form>
                </div>

                <p class="text-center mt-6 text-sm text-gray-500 dark:text-slate-500">
                    Masukan Anda akan disimpan secara anonim
                </p>
            </div>
        </div>
    </div>
</section>

<!-- acara -->
 <section id="acara" class="py-16 bg-white/80 dark:bg-slate-900/80">
    <div class="max-w-5xl mx-auto px-4 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold bg-gradient-to-r from-pink-600 to-orange-600 dark:from-pink-400 dark:to-orange-400 bg-clip-text text-transparent mb-4">
                Acara & Kegiatan Terkini
            </h2>
            <p class="text-lg text-gray-700 dark:text-slate-300 max-w-2xl mx-auto">
                Jangan Lewatkan Acara Menarik dari HIMANIKKA Berikutnya!!!
            </p>
        </div>

        <!-- Acara Cards -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
            @forelse($acaras->take(6) as $acara)
                <div class="group bg-white/70 dark:bg-slate-800/70 backdrop-blur-xl rounded-3xl p-8 shadow-xl hover:shadow-2xl border border-white/50 dark:border-slate-700/50 hover:-translate-y-3 transition-all duration-500 hover:border-pink-500/50">
                    <!-- Acara Image -->
                    <div class="mb-6 rounded-2xl overflow-hidden shadow-lg group-hover:scale-[1.02] transition-transform duration-300">
                        @if($acara->image)
                            <img src="{{ Storage::url($acara->image) }}" 
                                 alt="{{ $acara->name }}" 
                                 class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-gray-200 to-gray-300 dark:from-slate-700 dark:to-slate-600 flex items-center justify-center">
                                <i class="fas fa-calendar-alt text-4xl text-gray-400"></i>
                            </div>
                        @endif
                    </div>

                    <!-- Acara Date Badge -->
                    <div class="flex items-center mb-4">
                        <span class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-pink-500 to-orange-500 text-white text-sm font-bold rounded-full shadow-lg">
                            <i class="fas fa-calendar-day mr-2"></i>
                            {{ $acara->tanggal?->format('d M Y') ?? 'Tanggal TBD' }}
                        </span>
                    </div>

                    <!-- Acara Title -->
                    <h3 class="text-2xl font-bold text-slate-900 dark:text-white group-hover:text-pink-500 transition-colors duration-300">
                        {{ $acara->name }}
                    </h3>

                    <!-- Acara Description -->
                    <p class="text-gray-700 dark:text-slate-300 group-hover:text-pink-500 transition-colors duration-300">
                        {{ Str::limit($acara->description, 100) }}
                    </p>
                </div>
            @empty
                <div class="col-span-full text-center py-24">
                    <i class="fas fa-calendar-times text-6xl text-gray-300 dark:text-slate-600 mb-6"></i>
                    <h3 class="text-2xl font-bold text-gray-500 dark:text-slate-400 mb-2">Belum Ada Acara</h3>
                    <p class="text-gray-500 dark:text-slate-500">Acara menarik akan segera hadir</p>
                </div>
            @endforelse
        </div>

        <div class="text-center">
            <a href="{{ route('acaras.index') }}" class="inline-flex items-center font-bold text-lg bg-gradient-to-r from-pink-500 to-orange-600 dark:from-pink-400 dark:to-orange-400 text-white px-6 py-3 rounded-xl hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                Lihat Semua Acara
                <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</section>

{{-- Event Section --}}
<section id="event" class="py-16 bg-white/80 dark:bg-slate-900/80">
    <div class="max-w-5xl mx-auto px-4 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold bg-gradient-to-r from-pink-600 to-orange-600 dark:from-pink-400 dark:to-orange-400 bg-clip-text text-transparent mb-4">
                Event & Acara Terkini
            </h2>
            <p class="text-lg text-gray-700 dark:text-slate-300 max-w-2xl mx-auto">
                Jangan Lewatkan Event Menarik dari HIMANIKKA Berikutnya!!!
            </p>
        </div>

        <!-- Event Cards -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
            @forelse($events->take(6) as $event)
                <div class="group bg-white/70 dark:bg-slate-800/70 backdrop-blur-xl rounded-3xl p-8 shadow-xl hover:shadow-2xl border border-white/50 dark:border-slate-700/50 hover:-translate-y-3 transition-all duration-500 hover:border-pink-500/50">
                    <!-- Event Image -->
                    <div class="mb-6 rounded-2xl overflow-hidden shadow-lg group-hover:scale-[1.02] transition-transform duration-300">
                        @if($event->image)
                            <img src="{{ Storage::url($event->image) }}" 
                                 alt="{{ $event->name }}" 
                                 class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-gray-200 to-gray-300 dark:from-slate-700 dark:to-slate-600 flex items-center justify-center">
                                <i class="fas fa-calendar-alt text-4xl text-gray-400"></i>
                            </div>
                        @endif
                    </div>

                    <!-- Event Date Badge -->
                   <!-- Event Date Badge -->
<div class="flex items-center mb-4">
    <span class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-pink-500 to-orange-500 text-white text-sm font-bold rounded-full shadow-lg">
        <i class="fas fa-calendar-day mr-2"></i>
        {{ $event->tanggal?->format('d M Y') ?? 'Tanggal TBD' }}
    </span>
</div>


                    <!-- Event Title -->
                    <h3 class="text-xl md:text-2xl font-black text-slate-900 dark:text-white mb-3 line-clamp-2 group-hover:text-pink-600 dark:group-hover:text-pink-400 transition-colors">
                        {{ $event->name }}
                    </h3>

                    <!-- Event Location & Time -->
                    <div class="space-y-2 mb-6">
                        <div class="flex items-center text-sm text-gray-600 dark:text-slate-300">
                            <i class="fas fa-map-marker-alt w-5 mr-2 text-pink-500"></i>
                            {{ $event->lokasi ?? 'Online' }}
                        </div>
                        <div class="flex items-center text-sm text-gray-600 dark:text-slate-300">
                            <i class="fas fa-clock w-5 mr-2 text-orange-500"></i>
                            {{ $event->waktu_mulai }} - {{ $event->waktu_selesai }}
                        </div>
                    </div>

                    <!-- Event Status Badge -->
                    <div class="flex items-center justify-between mb-6">
                        @if($event->status === 'terjadwal')
                            <span class="px-4 py-2 bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-200 text-xs font-bold rounded-full">
                                <i class="fas fa-clock mr-1"></i>Terjadwal
                            </span>
                        @elseif($event->status === 'berlangsung')
                            <span class="px-4 py-2 bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-200 text-xs font-bold rounded-full animate-pulse">
                                <i class="fas fa-play mr-1"></i>Berlangsung
                            </span>
                        @else
                            <span class="px-4 py-2 bg-gray-100 dark:bg-slate-700 text-gray-800 dark:text-slate-200 text-xs font-bold rounded-full">
                                <i class="fas fa-check mr-1"></i>Selesai
                            </span>
                        @endif

                        <!-- Pendaftar Count -->
                        <span class="text-sm font-bold text-pink-600 dark:text-pink-400">
                            {{ $event->pendaftarans_count ?? 0 }} Peserta
                        </span>
                    </div>

                    <!-- Action Button -->
                    <div class="flex gap-3">
                        <a href="{{ route('events.show', $event) }}" 
                           class="flex-1 bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-center py-3 px-6 rounded-2xl font-bold hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                            <i class="fas fa-eye mr-2"></i>Lihat Detail
                        </a>
                        @if($event->status === 'terjadwal')
                            <a href="{{ route('events.daftar', $event) }}" 
                               class="px-6 py-3 bg-gradient-to-r from-pink-500 to-orange-500 text-white font-bold rounded-2xl hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                                <i class="fas fa-sign-in-alt"></i>
                            </a>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20">
                    <i class="fas fa-calendar-times text-6xl text-gray-300 dark:text-slate-600 mb-6"></i>
                    <h3 class="text-2xl font-bold text-gray-500 dark:text-slate-400 mb-2">Belum Ada Event</h3>
                    <p class="text-gray-400 dark:text-slate-500">Event akan diumumkan segera...</p>
                </div>
            @endforelse
        </div>

        <!-- View All Button -->
        <div class="text-center">
            <a href="{{ route('events.index') }}" 
               class="inline-flex items-center bg-gradient-to-r from-indigo-600 to-purple-600 dark:from-indigo-500 dark:to-purple-500 text-white px-10 py-5 rounded-2xl font-black text-xl shadow-2xl hover:shadow-3xl hover:-translate-y-2 transition-all duration-300 group">
                <i class="fas fa-calendar-week mr-3 text-2xl group-hover:animate-bounce"></i>
                Lihat Semua Event
                <i class="fas fa-arrow-right ml-3 text-xl group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>
    </div>
</section>


{{-- Testimoni Section --}}
<section id="masukkan" class="py-16 bg-gradient-to-br from-slate-50/80 to-indigo-50/80 dark:from-slate-900/50 dark:to-indigo-900/30">
    <div class="max-w-5xl mx-auto px-4 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold bg-gradient-to-r from-gray-900 to-emerald-600 dark:from-slate-100 dark:to-emerald-400 bg-clip-text text-transparent mb-4">
                Masukkan & Kritik
            </h2>
            <p class="text-lg text-gray-600 dark:text-slate-300 max-w-2xl mx-auto">
                Suara anggota HIMANIKA untuk perbaikan organisasi
            </p>
        </div>

        <!-- Masukkan Cards -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($masukkans->take(6) as $masukkan)
                <div class="group bg-white/95 dark:bg-slate-800/95 p-8 rounded-2xl shadow-xl hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 border border-gray-100/50 dark:border-slate-700/50 backdrop-blur-sm">
                    <!-- Status Badge -->
                    <div class="flex items-center mb-4">
                        @if($masukkan->status === 'dibaca')
                            <span class="inline-flex items-center px-3 py-1 bg-emerald-100 dark:bg-emerald-900/50 text-emerald-800 dark:text-emerald-200 text-xs font-bold rounded-full">
                                <i class="fas fa-check mr-1"></i>{{ ucfirst($masukkan->status) }}
                            </span>
                        @elseif($masukkan->status === 'menunggu')
                            <span class="inline-flex items-center px-3 py-1 bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-200 text-xs font-bold rounded-full animate-pulse">
                                <i class="fas fa-clock mr-1"></i>Menunggu
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 bg-gray-100 dark:bg-slate-700 text-gray-800 dark:text-slate-200 text-xs font-bold rounded-full">
                                <i class="fas fa-eye-slash mr-1"></i>Belum Dibaca
                            </span>
                        @endif
                    </div>

                    <!-- Masukkan Text -->
                    <p class="text-gray-700 dark:text-slate-300 mb-6 leading-relaxed font-medium text-base line-clamp-4 group-hover:line-clamp-none transition-all">
                        "{{ $masukkan->pesan }}"
                    </p>

                    <!-- User Info -->
                    <div class="flex items-center">
                        @if($masukkan->user && $masukkan->user->profil && $masukkan->user->profil->foto)
                            <img src="{{ Storage::url($masukkan->user->profil->foto) }}" 
                                 alt="{{ $masukkan->user->name }}" 
                                 class="w-14 h-14 rounded-2xl object-cover shadow-lg mr-4">
                        @else
                            <div class="w-14 h-14 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-2xl flex items-center justify-center text-white font-bold text-lg mr-4 shadow-lg">
                                {{ substr($masukkan->user->name ?? 'Anonim', 0, 1) }}
                            </div>
                        @endif
                        
                        <div class="min-w-0 flex-1">
                            <h4 class="font-bold text-gray-900 dark:text-slate-100 truncate">
                                {{ $masukkan->user->name ?? 'Anonim' }}
                            </h4>
                            <p class="text-sm text-gray-500 dark:text-slate-400 truncate">
                                #{{ str_pad($masukkan->id, 4, '0', STR_PAD_LEFT) }} • 
                                {{ $masukkan->kategori ?? 'Umum' }}
                            </p>
                            <p class="text-xs text-emerald-600 dark:text-emerald-400 font-medium">
                                {{ $masukkan->created_at?->diffForHumans() }}
                            </p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20">
                    <i class="fas fa-comment-dots text-6xl text-gray-300 dark:text-slate-600 mb-6 opacity-50"></i>
                    <h3 class="text-2xl font-bold text-gray-500 dark:text-slate-400 mb-4">Belum Ada Masukkan</h3>
                    <p class="text-gray-400 dark:text-slate-500">Berikan masukkan Anda untuk HIMANIKA!</p>
                </div>
            @endforelse
        </div>

        <!-- Action Button -->
        <div class="text-center mt-12">
            <a href="{{ route('masukkan.create') }}" 
               class="inline-flex items-center bg-gradient-to-r from-emerald-600 to-teal-600 dark:from-emerald-500 dark:to-teal-500 text-white px-10 py-5 rounded-2xl font-black text-xl shadow-2xl hover:shadow-3xl hover:-translate-y-2 transition-all duration-300 group">
                <i class="fas fa-comment-medical mr-3 text-2xl group-hover:animate-bounce"></i>
                Berikan Masukkan
                <i class="fas fa-arrow-right ml-3 text-xl group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>
    </div>
</section>




{{-- Final CTA --}}
<section class="py-24 bg-gradient-to-r from-indigo-600 via-purple-600 to-emerald-600 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900 text-white relative overflow-hidden">
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-white/10 to-transparent"></div>
    <div class="max-w-4xl mx-auto px-4 lg:px-8 text-center relative z-10">
        <div class="inline-flex items-center gap-3 px-6 py-3 mb-8 
            bg-white/20 dark:bg-white/10 backdrop-blur-xl 
            border border-white/30 rounded-2xl shadow-2xl animate-pulse">
            <div class="w-3 h-3 bg-emerald-400 rounded-full shadow-md animate-ping"></div>
            <span class="text-lg font-bold drop-shadow-lg">🚀 Bergabunglah dengan 250+ mahasiswa IT visioner!</span>
        </div>
        
        <h2 class="text-4xl md:text-5xl lg:text-6xl font-black mb-6 drop-shadow-2xl bg-gradient-to-r from-white via-indigo-100 to-emerald-100 bg-clip-text text-transparent leading-tight">Siap Wujudkan Masa Depan IT?</h2>
        <p class="text-xl md:text-2xl mb-12 text-indigo-100 max-w-2xl mx-auto leading-relaxed drop-shadow-lg">Jadilah bagian dari komunitas IT mahasiswa terdepan di Riau</p>
        
        <div class="flex flex-col lg:flex-row gap-6 justify-center items-center mb-12">
            <a href="{{ route('auth.register') }}" class="group bg-white text-indigo-700 px-12 py-6 rounded-2xl font-black text-xl shadow-2xl hover:shadow-3xl hover:-translate-y-3 hover:scale-105 transition-all duration-500 flex items-center gap-3 mx-auto lg:mx-0 backdrop-blur-xl border border-white/20">
                <i class="fas fa-user-plus text-2xl group-hover:animate-bounce"></i>
                <span>Daftar Gratis Sekarang</span>
            </a>
            <a href="https://wa.me/6282253140987?text=Halo%20HIMANIKA!%20Saya%20ingin%20bergabung%20dengan%20komunitas%20IT%20terbaik%20di%20kampus!" class="group inline-flex items-center gap-3 border-2 border-white/40 text-white px-12 py-6 rounded-2xl font-black text-xl hover:bg-white/20 backdrop-blur-xl transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl shadow-xl hover:scale-105" target="_blank">
                <i class="fab fa-whatsapp text-2xl text-green-400 group-hover:animate-bounce"></i>
                <span>Chat WhatsApp</span>
            </a>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8 pt-12 border-t border-white/20">
            <div class="text-center">
                <div class="text-3xl lg:text-4xl font-black bg-gradient-to-r from-emerald-300 to-cyan-300 bg-clip-text text-transparent drop-shadow-xl mb-2">{{ $stats['totalUsers'] ?? '250' }}+</div>
                <div class="text-sm font-bold uppercase tracking-wider text-indigo-200">Pengguna</div>
            </div>
            <div class="text-center">
                <div class="text-3xl lg:text-4xl font-black bg-gradient-to-r from-emerald-300 to-cyan-300 bg-clip-text text-transparent drop-shadow-xl mb-2">{{ $stats['totalEvents'] ?? '150' }}+</div>
                <div class="text-sm font-bold uppercase tracking-wider text-indigo-200">Event</div>
            </div>
            <div class="text-center">
                <div class="text-3xl lg:text-4xl font-black bg-gradient-to-r from-emerald-300 to-cyan-300 bg-clip-text text-transparent drop-shadow-xl mb-2">{{ $stats['totalAcara'] ?? '100' }}+</div>
                <div class="text-sm font-bold uppercase tracking-wider text-indigo-200">Acara & Kegiatan</div>
            </div>
        </div>
    </div>
</section>

{{-- Back to Top --}}
<div class="fixed bottom-8 right-8 z-50">
    <a href="#" class="group p-4 bg-gradient-to-r from-emerald-500 to-cyan-500 dark:from-emerald-600 dark:to-cyan-600 text-white rounded-2xl shadow-xl hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 w-16 h-16 flex items-center justify-center backdrop-blur-sm border border-white/20" onclick="window.scrollTo({top: 0, behavior: 'smooth'}); return false;">
        <i class="fas fa-arrow-up text-xl group-hover:rotate-180 transition-transform"></i>
    </a>
</div>
@endsection
