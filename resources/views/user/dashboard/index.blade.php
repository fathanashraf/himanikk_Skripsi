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
                            drop-shadow-xl mb-3">{{ $profils->singkatan ?? 'HIMANIKA' }}</span>
                    </h1>
                    <p class="text-lg md:text-xl lg:text-2xl font-semibold max-w-2xl mx-auto lg:mx-0 
          bg-gradient-to-r from-slate-50/90 to-white/80 dark:from-slate-800/90 dark:to-slate-900/80 
          text-slate-900 dark:text-slate-100 backdrop-blur-xl px-8 py-6 rounded-3xl 
          border border-slate-200/50 dark:border-slate-700/50 shadow-2xl 
          hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
          {{ $profils->moto ?? 'Membangun generasi IT visioner melalui event dan workshop berkualitas' }}

                    <p class="text-base md:text-lg lg:text-xl font-light max-w-lg mx-auto lg:mx-0 
                        text-white/90 dark:text-slate-800/90 drop-shadow 
                        bg-white/10 dark:bg-slate-900/20 backdrop-blur px-6 py-3 
                        rounded-xl border border-white/15 dark:border-slate-800/30">
                        {{ $profils->fungsi ?? 'Membangun generasi IT visioner melalui event dan workshop berkualitas' }}
                    </p>
                </div>

                {{-- CTAs --}}
                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start max-w-xl mx-auto lg:mx-0">
                    <a href="{{ route('user.tentang.index') }}" class="group flex items-center gap-3 px-8 py-4 
                        bg-gradient-to-r from-emerald-500 to-cyan-500 
                        dark:from-emerald-600 dark:to-cyan-600 text-white font-bold 
                        rounded-2xl shadow-xl hover:shadow-emerald-400/40 hover:shadow-2xl 
                        hover:-translate-y-2 hover:scale-105 transition-all duration-300 
                        border border-emerald-400/40 flex-1 justify-center text-sm md:text-base">
                        <i class="fas fa-info-circle text-xl group-hover:rotate-12"></i>
                        <span class="drop-shadow">Profil</span>
                    </a>
                    <a href="{{ route('user.events.index') }}" class="group flex items-center gap-3 px-8 py-4 
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
                    <div class="text-center">
                        <div class="text-2xl md:text-3xl lg:text-4xl font-black 
                            bg-gradient-to-r from-emerald-400 to-cyan-400 
                            dark:from-emerald-500 dark:to-cyan-500 bg-clip-text 
                            text-transparent drop-shadow-xl mb-1">{{ $stats['total_acara'] ?? '100' }}+</div>
                        <div class="text-xs font-bold uppercase tracking-wider 
                            text-white/80 dark:text-slate-800/80 drop-shadow">Acara</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl md:text-3xl lg:text-4xl font-black 
                            bg-gradient-to-r from-emerald-400 to-cyan-400 
                            dark:from-emerald-500 dark:to-cyan-500 bg-clip-text 
                            text-transparent drop-shadow-xl mb-1">{{ $stats['total_kegiatan'] ?? '75' }}+</div>
                        <div class="text-xs font-bold uppercase tracking-wider 
                            text-white/80 dark:text-slate-800/80 drop-shadow">Kegiatan</div>
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

@endsection
