@extends('user.layouts.app')

@section('title', 'Struktur Himpunan')

@section('content')
<section id="struktur" class="py-20 lg:py-28 bg-gradient-to-br from-slate-50 via-white to-emerald-50 dark:from-slate-900 dark:to-slate-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- HERO HEADER --}}
        <div class="text-center mb-20 lg:mb-28">
            <div class="inline-flex items-center gap-3 px-6 py-3 bg-gradient-to-r from-emerald-600 to-teal-600 
                       text-white font-semibold text-lg rounded-2xl shadow-xl mb-8 backdrop-blur-sm">
                <i class="fas fa-sitemap text-xl"></i>
                Struktur Organisasi 2025-2026
            </div>
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-black bg-gradient-to-r from-slate-900 via-emerald-600 to-teal-600 
                      bg-clip-text text-transparent mb-6 tracking-tight leading-tight">
                HIMANIKKA
            </h1>
            <p class="text-xl lg:text-2xl text-slate-600 dark:text-slate-300 font-medium max-w-2xl mx-auto leading-relaxed">
                Struktur lengkap kepengurusan {{ $profils->name }} untuk tahun 2025-2026
            </p>
        </div>

        {{-- ORGANIZATION FLOW --}}
        <div class="space-y-24 lg:space-y-32 mb-24">
            {{-- LEVEL 1: KETUA HIMPUNAN --}}
            @php $kahim = $strukturs->where('jabatan', 'kahim')->first(); @endphp
            <div class="flex justify-center">
                @include('user.struktur.partials.jabatan', [
                    'jabatan' => $kahim,
                    'jabatan_nama' => 'KETUA HIMPUNAN',
                    'level' => 'primary',
                    'icon' => 'fas fa-crown'
                ])
            </div>

            {{-- LEVEL 2: CORE TEAM --}}
            <div class="flex justify-center gap-8 lg:gap-16">
                @php 
                    $core_team = [
                        'wakahim' => ['name' => 'WAKIL KETUA', 'icon' => 'fas fa-user-tie'],
                        'sekretaris' => ['name' => 'SEKRETARIS', 'icon' => 'fas fa-file-signature'],
                        'bendahara' => ['name' => 'BENDAHARA', 'icon' => 'fas fa-wallet']
                    ];
                @endphp
                @foreach($core_team as $jabatan_key => $info)
                    @php $person = $strukturs->where('jabatan', $jabatan_key)->first(); @endphp
                    @include('user.struktur.partials.jabatan', [
                        'jabatan' => $person,
                        'jabatan_nama' => $info['name'],
                        'level' => 'secondary',
                        'icon' => $info['icon']
                    ])
                @endforeach
            </div>

            {{-- LEVEL 3: DEPARTEMEN --}}
            <div>
                @php
                    $departemen = [
                        'kwu' => ['name' => 'KWU', 'color' => 'indigo', 'icon' => 'fas fa-store'],
                        'minatbakat' => ['name' => 'MINATBAKAT', 'color' => 'emerald', 'icon' => 'fas fa-brain'],
                        'pemberdaya_wanita' => ['name' => 'PEMBERDAYA WANITA', 'color' => 'rose', 'icon' => 'fas fa-venus'],
                        'humas' => ['name' => 'HUMAS', 'color' => 'orange', 'icon' => 'fas fa-bullhorn'],
                        'kaderisasi' => ['name' => 'KADERISASI', 'color' => 'yellow', 'icon' => 'fas fa-users'],
                        'kominfo' => ['name' => 'KOMINFO', 'color' => 'blue', 'icon' => 'fas fa-laptop-code'],
                        'keagamaan' => ['name' => 'KEAGAMAAN', 'color' => 'red', 'icon' => 'fas fa-praying-hands'],
                        'sosial' => ['name' => 'SOSIAL', 'color' => 'green', 'icon' => 'fas fa-hands-helping'],
                    ];
                @endphp

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
                    @foreach($departemen as $dep => $info)
                        @php 
                            $koordinators = $strukturs->where('departemen', $dep)
                                                   ->whereIn('posisi', ['koordinator'])
                                                   ->take(1);
                            $anggotas = $strukturs->where('departemen', $dep)
                                               ->where('posisi', 'anggota')
                                               ->take(3);
                            $total_count = $strukturs->where('departemen', $dep)->count();
                        @endphp
                        
                        <div class="group relative bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl rounded-3xl p-8 lg:p-10 
                                   border border-slate-200/50 hover:border-emerald-300/50 shadow-xl hover:shadow-2xl 
                                   hover:-translate-y-2 transition-all duration-500 h-full overflow-hidden">
                            
                            {{-- Gradient Header --}}
                            <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-{{ $info['color'] }}-500 to-{{ $info['color'] }}-600"></div>
                            
                            {{-- Decorative Shine --}}
                            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/5 to-transparent 
                                       opacity-0 group-hover:opacity-100 transition-opacity duration-700 
                                       -skew-x-12 -translate-x-[100%] group-hover:translate-x-[100%] pointer-events-none"></div>

                            <div class="relative z-10 h-full flex flex-col">
                                {{-- HEADER --}}
                                <div class="text-center mb-8 flex-1">
                                    <div class="w-16 h-16 lg:w-20 lg:h-20 mx-auto mb-6 bg-gradient-to-r from-{{ $info['color'] }}-500 to-{{ $info['color'] }}-600 
                                               rounded-2xl flex items-center justify-center shadow-2xl group-hover:scale-110 transition-all duration-500 border-4 border-white/20">
                                        <i class="{{ $info['icon'] }} text-2xl lg:text-3xl text-white font-bold drop-shadow-lg"></i>
                                    </div>
                                    <h3 class="text-2xl lg:text-3xl font-bold text-slate-900 dark:text-white tracking-tight uppercase mb-2">
                                        {{ $info['name'] }}
                                    </h3>
                                </div>

                                {{-- MEMBERS PREVIEW --}}
                                <div class="space-y-4 mb-8 flex-2">
                                    {{-- Koordinator --}}
                                    @forelse($koordinators as $koordinator)
                                        @if($koordinator->user)
                                            <div class="flex items-center gap-4 p-4 bg-gradient-to-r from-yellow-500/10 to-orange-500/10 
                                                       rounded-2xl border-2 border-yellow-200/50 backdrop-blur-xl group/koor hover:shadow-lg transition-all">
                                                <div class="relative flex-shrink-0">
                                                    @if($koordinator->avatar)
                                                        <img src="{{ asset('storage/' . $koordinator->avatar) }}" 
                                                             alt="{{ $koordinator->user->name }}" 
                                                             class="w-14 h-14 lg:w-16 lg:h-16 rounded-2xl object-cover shadow-xl ring-2 ring-white/50">
                                                    @else
                                                        <div class="w-14 h-14 lg:w-16 lg:h-16 bg-gradient-to-br from-slate-300 to-slate-400 
                                                                    rounded-2xl flex items-center justify-center text-xl font-bold text-white shadow-xl ring-2 ring-white/50">
                                                            {{ strtoupper(substr($koordinator->user->name, 0, 2)) }}
                                                        </div>
                                                    @endif
                                                    <div class="absolute -top-1 -right-1 w-7 h-7 bg-gradient-to-r from-yellow-400 to-orange-500 
                                                               rounded-xl flex items-center justify-center shadow-lg border-2 border-white">
                                                        <i class="fas fa-star text-xs text-yellow-900 font-bold"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <p class="font-bold text-lg text-slate-900 dark:text-white truncate leading-tight">
                                                        {{ $koordinator->user->name }}
                                                    </p>
                                                    <p class="text-sm font-semibold text-yellow-700 uppercase tracking-wide">
                                                        {{ strtoupper($koordinator->posisi ?? 'Koordinator') }}
                                                    </p>
                                                </div>
                                            </div>
                                        @endif
                                    @empty
                                    @endforelse

                                    {{-- Anggota Sample --}}
                                    @forelse($anggotas as $anggota)
                                        @if($anggota->user)
                                            <div class="flex items-center gap-3 p-4 bg-white/60 dark:bg-slate-700/60 rounded-xl 
                                                       border border-slate-200/50 hover:bg-white hover:shadow-md transition-all hover:gap-4">
                                                @if($anggota->avatar)
                                                    <img src="{{ asset('storage/' . $anggota->avatar) }}" 
                                                         alt="{{ $anggota->user->name }}" 
                                                         class="w-12 h-12 lg:w-14 lg:h-14 rounded-xl object-cover shadow-lg ring-2 ring-white/60 hover:scale-105">
                                                @else
                                                    <div class="w-12 h-12 lg:w-14 lg:h-14 bg-gradient-to-br from-slate-300 to-slate-400 
                                                               rounded-xl flex items-center justify-center text-lg font-bold text-white shadow-lg">
                                                        {{ strtoupper(substr($anggota->user->name, 0, 2)) }}
                                                    </div>
                                                @endif
                                                <div class="flex-1 min-w-0">
                                                    <p class="font-semibold text-base text-slate-900 dark:text-white truncate">
                                                        {{ $anggota->user->name }}
                                                    </p>
                                                    <p class="text-xs font-medium text-slate-600 uppercase">Anggota</p>
                                                </div>
                                            </div>
                                        @endif
                                    @empty
                                    @endforelse

                                    {{-- Empty State --}}
                                    @if($total_count == 0)
                                        <div class="flex flex-col items-center justify-center text-center py-12 opacity-60">
                                            <div class="w-16 h-16 bg-slate-100 dark:bg-slate-800 rounded-2xl border-2 border-dashed border-slate-300 
                                                       flex items-center justify-center mb-4">
                                                <i class="fas fa-users text-xl text-slate-400"></i>
                                            </div>
                                            <p class="text-lg font-semibold text-slate-700 dark:text-slate-300">Belum Ada Anggota</p>
                                            <p class="text-sm text-slate-500">Dalam proses rekrutmen</p>
                                        </div>
                                    @endif
                                </div>

                                {{-- STATS & CTA --}}
                                <div class="pt-6 border-t border-slate-200/50 space-y-4">
                                    <div class="flex items-center justify-between text-sm">
                                        <span class="font-bold text-slate-700 dark:text-slate-300 tracking-wide">
                                            {{ $total_count }} Anggota
                                            @if($koordinators->count() > 0)
                                                <span class="ml-2 px-2 py-1 bg-yellow-100 text-yellow-800 text-xs rounded-full font-semibold">
                                                    +{{ $koordinators->count() }} Koor.
                                                </span>
                                            @endif
                                        </span>
                                        <span class="px-3 py-1 bg-emerald-100 text-emerald-800 font-semibold rounded-full text-sm tracking-wide">
                                            AKTIF
                                        </span>
                                    </div>
                                    
                                    <a href="{{ route('user.struktur.departemen', $dep) }}" 
                                       class="w-full group relative bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 
                                              text-white font-semibold py-3 px-6 rounded-2xl shadow-xl hover:shadow-2xl hover:-translate-y-1 
                                              transition-all duration-300 text-center inline-flex items-center justify-center gap-3 h-14">
                                        <i class="fas fa-users text-xl group-hover:rotate-3 transition-transform"></i>
                                        <span>Lihat Tim Lengkap ({{ $total_count ?? 0 }})</span>
                                        <i class="fas fa-arrow-right text-base ml-auto opacity-0 group-hover:opacity-100 
                                                  group-hover:translate-x-2 transition-all duration-300"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- LEGEND --}}
        <div class="grid grid-cols-2 md:grid-cols-3 gap-6 item-center text-center mb-20">
            <div class="flex items-center justify-center gap-4 p-6 bg-gradient-to-r from-yellow-500/10 to-orange-500/10 
                       backdrop-blur-xl rounded-2xl border-2 border-yellow-200/50">
                <div class="w-6 h-6 bg-gradient-to-r from-yellow-500 to-orange-500 rounded-full shadow-lg"></div>
                <span class="font-bold text-lg text-slate-900 dark:text-white tracking-wide">KOORDINATOR</span>
            </div>
            <div class="flex items-center justify-center gap-4 p-6 bg-gradient-to-r from-slate-400/20 to-slate-500/20 
                       backdrop-blur-xl rounded-2xl border-2 border-slate-200/50">
                <div class="w-6 h-6 bg-gradient-to-r from-slate-400 to-slate-500 rounded-full shadow-lg"></div>
                <span class="font-bold text-lg text-slate-900 dark:text-white tracking-wide">ANGGOTA</span>
            </div>
        </div>

        {{-- STATS CARDS --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 lg:gap-8">
            <div class="group p-8 lg:p-10 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-3xl text-white 
                       shadow-2xl hover:shadow-3xl hover:-translate-y-2 transition-all duration-500 text-center">
                <div class="text-4xl lg:text-5xl font-black mb-3 group-hover:scale-110 transition-transform">{{ $stats['total_anggota'] }}</div>
                <div class="text-lg lg:text-xl font-semibold tracking-wide opacity-95">Anggota</div>
            </div>
            <div class="group p-8 lg:p-10 bg-gradient-to-br from-yellow-500 to-orange-600 rounded-3xl text-white 
                       shadow-2xl hover:shadow-3xl hover:-translate-y-2 transition-all duration-500 text-center">
                <div class="text-4xl lg:text-5xl font-black mb-3 group-hover:scale-110 transition-transform">{{ $stats['total_koordinator'] }}</div>
                <div class="text-lg lg:text-xl font-semibold tracking-wide opacity-95">Koordinator</div>
            </div>
            <div class="group p-8 lg:p-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-3xl text-white 
                       shadow-2xl hover:shadow-3xl hover:-translate-y-2 transition-all duration-500 text-center">
                <div class="text-4xl lg:text-5xl font-black mb-3 group-hover:scale-110 transition-transform">{{ $stats['total_departemen'] }}</div>
                <div class="text-lg lg:text-xl font-semibold tracking-wide opacity-95">Departemen</div>
            </div>
            <div class="group p-8 lg:p-10 bg-gradient-to-br from-slate-500 to-slate-700 rounded-3xl text-white 
                       shadow-2xl hover:shadow-3xl hover:-translate-y-2 transition-all duration-500 text-center">
                <div class="text-4xl lg:text-5xl font-black mb-3 group-hover:scale-110 transition-transform">
                    {{ $stats['total_anggota'] + $stats['total_koordinator'] }}
                </div>
                <div class="text-lg lg:text-xl font-semibold tracking-wide opacity-95">Total Tim</div>
            </div>
        </div>
    </div>
</section>
@endsection
