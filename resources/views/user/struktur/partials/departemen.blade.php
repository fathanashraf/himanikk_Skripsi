@extends('user.layouts.app')

@section('title', 'Tim ' . ucwords(str_replace('_', ' ', $departemen)))

@section('content')
<div class="w-full max-w-4xl mx-auto">
    {{-- HEADER --}}
    <div class="text-center mb-12 pb-12 border-b-2 border-slate-200/50">
        <div class="inline-flex items-center gap-3 px-6 py-3 bg-gradient-to-r from-emerald-600 to-teal-600 
                   text-white font-semibold text-lg rounded-3xl shadow-xl mb-6 backdrop-blur-sm">
            <i class="fas fa-building text-xl"></i>
            <span>Tim {{ ucwords(str_replace('_', ' ', $departemen)) }}</span>
        </div>
        <div class="text-4xl lg:text-5xl font-black bg-gradient-to-r from-slate-900 via-emerald-600 to-teal-600 
                   bg-clip-text text-transparent tracking-tight">
            Anggota Departemen
        </div>
    </div>

    {{-- TEAM GRID --}}
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
        @forelse($data as $index => $struktur)
            <div class="group relative bg-gradient-to-br from-white/90 to-slate-50/70 dark:from-slate-800/90 dark:to-slate-900/70 
                       backdrop-blur-xl rounded-3xl p-8 border border-slate-200/40 hover:border-emerald-300/50 
                       shadow-lg hover:shadow-2xl hover:-translate-y-3 transition-all duration-500 overflow-hidden h-full">
                
                {{-- POSITION LINE --}}
                <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r {{ 
                    $struktur->posisi === 'koordinator' ? 'from-emerald-500 to-teal-500' : 
                    ($struktur->posisi === 'anggota' ? 'from-yellow-500 to-orange-500' : 'from-slate-400 to-slate-500') 
                }}"></div>
                
                {{-- SHINE EFFECT --}}
                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent opacity-0 group-hover:opacity-100 
                           transition-opacity duration-700 -skew-x-12 -translate-x-[100%] group-hover:translate-x-[100%]"></div>

                <div class="relative z-10">
                    {{-- AVATAR CONTAINER --}}
                    <div class="flex justify-center mb-6 relative">
                        <div class="relative">
                            @if($struktur->avatar)
                                <img src="{{ asset('storage/' . $struktur->avatar) }}" 
                                     alt="{{ $struktur->user->name }}" 
                                     class="w-24 h-24 lg:w-28 lg:h-28 rounded-3xl object-cover shadow-2xl 
                                            ring-4 {{ 
                                                $struktur->posisi === 'koordinator' ? 'ring-emerald-400/60' : 
                                                ($struktur->posisi === 'anggota' ? 'ring-yellow-400/60' : 'ring-slate-300/50') 
                                            }} group-hover:scale-110 transition-all duration-500 mx-auto">
                            @else
                                <div class="w-24 h-24 lg:w-28 lg:h-28 mx-auto flex items-center justify-center 
                                           rounded-3xl shadow-2xl text-2xl lg:text-3xl font-black 
                                           {{ 
                                               $struktur->posisi === 'koordinator' ? 'bg-gradient-to-br from-emerald-500 to-teal-600 ring-emerald-400/60' : 
                                               ($struktur->posisi === 'anggota' ? 'bg-gradient-to-br from-yellow-500 to-orange-500 ring-yellow-400/60' : 
                                               'bg-gradient-to-br from-slate-400 to-slate-500 ring-slate-300/50') 
                                           }}">
                                    {{ strtoupper(substr($struktur->user->name, 0, 2)) }}
                                </div>
                            @endif

                            {{-- POSITION BADGE --}}
                            <div class="absolute -bottom-3 left-1/2 -translate-x-1/2 translate-y-1/2 w-12 h-12 
                                       bg-white shadow-2xl rounded-3xl flex items-center justify-center border-4 border-slate-50 
                                       group-hover:scale-110 transition-all duration-300 z-20">
                                @if($struktur->posisi === 'koordinator')
                                    <div class="w-8 h-8 bg-gradient-to-r from-yellow-400 to-orange-400 rounded-2xl flex items-center justify-center shadow-lg">
                                        <i class="fas fa-crown text-yellow-900 text-sm font-bold"></i>
                                    </div>
                                @elseif($struktur->posisi === 'anggota')
                                    <div class="w-8 h-8 bg-gradient-to-r from-yellow-500 to-orange-400 rounded-2xl flex items-center justify-center shadow-lg">
                                        <i class="fas fa-star text-yellow-900 text-sm"></i>
                                    </div>
                                @else
                                    <div class="w-6 h-6 bg-slate-200 rounded-2xl flex items-center justify-center shadow-md">
                                        <i class="fas fa-check text-slate-600 text-xs"></i>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- NAME & NIM --}}
                    <div class="text-center mb-6">
                        <h4 class="text-xl lg:text-2xl font-bold bg-gradient-to-r from-slate-900 via-emerald-600 to-teal-600 
                                  bg-clip-text text-transparent group-hover:scale-[1.02] transition-all duration-300 line-clamp-2 mb-2 px-2">
                            {{ $struktur->user->name }}
                        </h4>
                        
                        @if($struktur->user->nim)
                            <div class="inline-flex items-center gap-2 px-3 py-1 bg-slate-100/80 dark:bg-slate-700/80 
                                       backdrop-blur-sm rounded-full text-xs font-mono text-slate-600 font-semibold tracking-wider border border-slate-200/50">
                                <i class="fas fa-id-card text-slate-500 text-xs"></i>
                                {{ $struktur->user->nim }}
                            </div>
                        @endif
                    </div>

                    {{-- POSITION LABEL --}}
                    <div class="text-center mb-8">
                        <div class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r {{ 
                            $struktur->posisi === 'koordinator' ? 'from-emerald-600/20 to-teal-600/20 text-emerald-800 border-emerald-300/50' : 
                            ($struktur->posisi === 'anggota' ? 'from-yellow-600/20 to-orange-600/20 text-yellow-800 border-yellow-300/50' : 
                            'from-slate-600/20 to-slate-700/20 text-slate-700 border-slate-300/50') 
                        }} font-semibold text-sm rounded-2xl backdrop-blur-xl border-2 uppercase tracking-wider 
                               group-hover:bg-opacity-30 transition-all duration-300">
                            <i class="{{ 
                                $struktur->posisi === 'koordinator' ? 'fas fa-crown' : 
                                ($struktur->posisi === 'anggota' ? 'fas fa-star' : 'fas fa-user') 
                            }} text-base"></i>
                            {{ ucwords(str_replace('_', ' ', $struktur->posisi)) }}
                        </div>
                    </div>

                    {{-- ACTION BUTTON --}}
                    <a href="{{ route('user.struktur.show', $struktur->id) }}" 
                       class="group/btn flex items-center justify-center gap-3 w-full px-6 py-3 
                              bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 
                              text-white font-semibold text-sm rounded-2xl shadow-xl hover:shadow-2xl 
                              hover:-translate-y-1 transition-all duration-300 backdrop-blur-sm border border-emerald-400/50">
                        <i class="fas fa-eye text-base group-hover/btn:rotate-12 transition-transform duration-300"></i>
                        <span>Lihat Profil</span>
                        <i class="fas fa-arrow-right text-sm opacity-0 group-hover/btn:opacity-100 
                                  group-hover/btn:translate-x-1 transition-all duration-300 ml-1"></i>
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-24 px-8">
                <div class="w-32 h-32 mx-auto mb-8 bg-gradient-to-br from-slate-100 to-slate-200 dark:from-slate-800 dark:to-slate-700 
                           rounded-3xl flex items-center justify-center shadow-2xl border-4 border-slate-200/50">
                    <i class="fas fa-users text-4xl text-slate-400"></i>
                </div>
                <h3 class="text-3xl font-bold text-slate-900 dark:text-white mb-4 tracking-tight">Belum Ada Anggota</h3>
                <p class="text-xl text-slate-500 dark:text-slate-400 max-w-md mx-auto leading-relaxed">
                    Departemen {{ ucwords(str_replace('_', ' ', $departemen)) }} sedang dalam tahap rekrutmen. 
                    Segera bergabung dan menjadi bagian dari tim hebat!
                </p>
                <div class="mt-8 h-px w-24 bg-gradient-to-r from-slate-300 to-transparent mx-auto"></div>
            </div>
        @endforelse
    </div>
</div>
@endsection