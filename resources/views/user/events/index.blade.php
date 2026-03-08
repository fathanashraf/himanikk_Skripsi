@extends('user.layouts.app')

@section('title', 'event HIMANIKKA')

@section('content')
<section id="event" class="py-20 lg:py-32 relative overflow-hidden">
    <!-- Animated Background -->
    <div class="absolute inset-0 bg-gradient-to-br from-indigo-50/50 via-purple-50/30 to-pink-50/50 dark:from-slate-900/40 dark:via-indigo-900/20 dark:to-slate-900/40">
        <div class="absolute top-20 right-20 w-72 h-72 bg-gradient-to-r from-indigo-400/20 to-purple-400/20 rounded-full blur-3xl animate-pulse" style="animation-delay: 0s"></div>
        <div class="absolute bottom-20 left-20 w-96 h-96 bg-gradient-to-r from-purple-400/20 to-pink-400/20 rounded-full blur-3xl animate-pulse" style="animation-delay: 2s"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-gradient-to-r from-emerald-400/10 to-blue-400/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 4s"></div>
    </div>

    <div class="container mx-auto px-4 relative z-20">
        <!-- Header Section -->
        <div class="text-center mb-24 max-w-5xl mx-auto">
            <div class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-indigo-500 via-purple-600 to-emerald-600 text-white font-bold text-xl mb-8 shadow-2xl hover:shadow-3xl hover:-translate-y-1 transition-all duration-500 rounded-3xl backdrop-blur-sm border border-white/20 group">
                <svg class="w-6 h-6 mr-3 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9.97 9.97 0 00-.933 6.743l-.505 2.124c-.179.795-.793 1.383-1.527 1.383H16.5"/>
                </svg>
                event Terbaru HIMANIKKA
            </div>
            <h1 class="text-5xl lg:text-7xl font-black bg-gradient-to-r from-slate-900 via-indigo-900 to-purple-900 bg-clip-text text-transparent dark:from-white dark:via-indigo-100 dark:to-purple-100 mb-8 leading-tight">
                Aktivitas & event
            </h1>
            <p class="text-xl lg:text-2xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto leading-relaxed font-medium">
                Ikuti berbagai event menarik dan bermanfaat dari HIMANIKKA untuk pengembangan diri dan networking
            </p>
        </div>

        <!-- Search & Filter Section -->
        <div class="max-w-3xl mx-auto mb-20" x-data="{ search: @entangle('search').live, showFilters: false }">
            <!-- Enhanced Search -->
            <div class="relative mb-6">
                <svg class="absolute left-5 top-1/2 -translate-y-1/2 w-6 h-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.601 10.601z"/>
                </svg>
                <input 
                    type="text" 
                    wire:model.live="search"
                    placeholder="🔍 Cari event, seminar, workshop, atau nama penyelenggara..." 
                    class="w-full pl-16 pr-16 py-4 rounded-3xl bg-white/95 dark:bg-slate-800/95 backdrop-blur-xl border-2 border-gray-200/60 dark:border-slate-700/60 focus:ring-4 focus:ring-indigo-500/40 focus:border-indigo-500/60 transition-all duration-400 text-lg placeholder-gray-500 shadow-xl hover:shadow-2xl">
                @if(strlen($search ?? '') > 0)
                <button wire:click="$set('search', '')" 
                        class="absolute right-5 top-1/2 -translate-y-1/2 p-2 hover:bg-indigo-500/20 hover:text-indigo-600 dark:hover:text-indigo-400 rounded-2xl transition-all duration-300 hover:scale-110">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
                @endif
            </div>

            <!-- Filter Toggle -->
            <div class="flex flex-wrap gap-3 justify-center mb-8">
                <button 
                    @click="showFilters = !showFilters"
                    class="group px-10 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-bold text-lg rounded-3xl shadow-2xl hover:shadow-3xl transition-all duration-400 flex items-center gap-3 hover:-translate-y-1">
                    <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    Filter event 
                    <div class="w-3 h-3 bg-white/90 rounded-full flex items-center justify-center transition-transform" :class="showFilters ? 'rotate-180' : ''">
                        <svg class="w-2 h-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                </button>
            </div>

            <!-- Filter Panel -->
            <div x-show="showFilters" x-transition:enter="transition ease-out duration-500" 
                 x-transition:enter-start="opacity-0 translate-y-4" 
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="p-8 bg-white/95 dark:bg-slate-800/95 backdrop-blur-2xl rounded-3xl shadow-2xl border border-gray-200/50 dark:border-slate-700/50 max-w-4xl mx-auto mb-16 animate-in slide-in-from-top-4">
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Status event</label>
                        <select wire:model.live="status" class="w-full px-4 py-3 rounded-2xl border-2 border-gray-200/50 dark:border-slate-700/50 focus:ring-3 focus:ring-indigo-500/50 bg-white/80 dark:bg-slate-800/80 transition-all duration-300 text-lg">
                            <option value="">Semua Status</option>
                            <option value="segera">🔴 Segera Dimulai</option>
                            <option value="berlangsung">🟡 Berlangsung</option>
                            <option value="selesai">🟢 Selesai</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Tanggal Mulai</label>
                        <input wire:model.live="dateFrom" type="date" 
                               class="w-full px-4 py-3 rounded-2xl border-2 border-gray-200/50 dark:border-slate-700/50 focus:ring-3 focus:ring-indigo-500/50 bg-white/80 dark:bg-slate-800/80 transition-all duration-300 text-lg">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Tanggal Selesai</label>
                        <input wire:model.live="dateTo" type="date" 
                               class="w-full px-4 py-3 rounded-2xl border-2 border-gray-200/50 dark:border-slate-700/50 focus:ring-3 focus:ring-indigo-500/50 bg-white/80 dark:bg-slate-800/80 transition-all duration-300 text-lg">
                    </div>
                    <div class="flex items-end">
                        <button wire:click="$set('status', ''); $set('dateFrom', ''); $set('dateTo', '')" 
                                class="w-full px-6 py-3 bg-gradient-to-r from-gray-500 to-gray-600 hover:from-gray-600 hover:to-gray-700 text-white font-semibold rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 text-lg">
                            Reset Filter
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- event Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-8">
            @forelse($events as $event)
            <article class="group relative bg-white/90 dark:bg-slate-800/90 backdrop-blur-xl rounded-3xl shadow-2xl hover:shadow-3xl border border-white/60 dark:border-slate-700/60 overflow-hidden transition-all duration-700 hover:-translate-y-3 hover:scale-[1.02] hover:border-indigo-500/50">
                <!-- Image Section -->
                <div class="relative h-56 lg:h-64 overflow-hidden bg-gradient-to-br from-gray-50/50 to-gray-100/50 dark:from-slate-700/70 dark:to-slate-800/70">
                    @if($event->image)
                    <img src="{{ asset('storage/' . $event->image) }}" 
                         alt="{{ $event->name }}" 
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000"
                         loading="lazy">
                    @else
                    <div class="w-full h-full bg-gradient-to-br from-indigo-500 via-purple-600 to-emerald-500 flex items-center justify-center relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-r from-white/10 to-transparent animate-shimmer"></div>
                        <svg class="w-20 h-20 text-white/95 relative z-10" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    @endif
                    
                    <!-- Status Badge -->
                    <div class="absolute top-4 right-4 z-20">
                        @php
                            $statusConfig = [
                                'segera' => ['label' => 'Segera Dimulai', 'color' => 'red', 'bg' => 'bg-gradient-to-r from-red-500 to-red-600', 'icon' => '⚡'],
                                'berlangsung' => ['label' => 'Berlangsung', 'color' => 'yellow', 'bg' => 'bg-gradient-to-r from-yellow-500 to-orange-500', 'icon' => '🔥'],
                                'selesai' => ['label' => 'Selesai', 'color' => 'emerald', 'bg' => 'bg-gradient-to-r from-emerald-500 to-teal-500', 'icon' => '✅'],
                            ];
                            $status = $statusConfig[$event->status] ?? ['label' => 'Draft', 'color' => 'gray', 'bg' => 'bg-gradient-to-r from-gray-500 to-gray-600', 'icon' => '📝'];
                        @endphp
                        <span class="{{ $status['bg'] }} text-white text-sm lg:text-base font-bold px-4 py-2 lg:py-2.5 rounded-2xl shadow-2xl backdrop-blur-sm border border-{{ $status['color'] }}-400/30 flex items-center gap-1.5 animate-pulse">
                            {{ $status['icon'] }} {{ $status['label'] }}
                        </span>
                    </div>

                    <!-- Quick Actions - FIXED: Hanya tampil jika ada gambar -->
                    @if($event->image)
                    <div class="absolute bottom-3 left-3 right-3 opacity-0 group-hover:opacity-100 transition-all duration-500 flex gap-2 backdrop-blur-sm bg-white/95 dark:bg-slate-900/95 rounded-2xl p-2 border border-white/50 shadow-2xl">
                        <a href="{{ asset('storage/' . $event->image) }}" target="_blank" 
                           class="flex-1 bg-gradient-to-r from-indigo-500/90 to-purple-600/90 p-3 rounded-xl text-white font-semibold text-xs shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300 text-center flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.638 19.5 12 19.5s-8.573-3.007-9.963-7.178z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Lihat Gambar
                        </a>
                        <button onclick="shareevent({{ $event->id }})" 
                                class="p-3 bg-gradient-to-r from-emerald-500/90 to-teal-600/90 hover:from-emerald-600 hover:to-teal-700 text-white rounded-xl shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12a2 2 0 01-2 2H9a2 2 0 01-2-2v-12m6 0h.01M13 7h4a1 1 0 001-1V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                            </svg>
                        </button>
                    </div>
                    @endif
                </div>

                <!-- Content Section -->
                <div class="p-8 lg:p-10">
                    <!-- Date & Time -->
                    <div class="flex items-center gap-3 mb-6 pb-6 border-b border-gray-100/50 dark:border-slate-700/50">
                        <div class="w-3 h-3 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full animate-pulse"></div>
                        <div class="flex items-center gap-4 text-sm font-semibold text-gray-600 dark:text-gray-300">
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ $event->tanggal?->format('d M Y') ?? 'TBD' }}
                            </span>
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $event->waktu?->format('H:i') ?? '-' }}
                            </span>
                        </div>
                    </div>

                    <!-- Title -->
                    <h3 class="text-2xl lg:text-3xl font-black mb-6 leading-tight group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-all duration-500 line-clamp-2 bg-gradient-to-r from-gray-900 to-slate-900 bg-clip-text text-transparent dark:from-white">
                        {{ $event->name }}
                    </h3>

                    <!-- Description -->
                    <p class="text-gray-600 dark:text-gray-300 mb-8 leading-relaxed line-clamp-3 lg:line-clamp-4 text-base lg:text-lg font-medium">
                        {{ \Illuminate\Support\Str::limit($event->description, 140) }}
                    </p>

                    <!-- Meta Info - ✅ FIXED -->
                    <div class="flex flex-wrap items-center justify-between gap-4 mb-8 text-sm lg:text-base">
                        <div class="flex items-center gap-4 flex-wrap">
                            <!-- Location -->
                            <div class="flex items-center gap-2 px-4 py-2 bg-indigo-50/50 dark:bg-indigo-900/30 rounded-2xl border border-indigo-200/50 dark:border-indigo-800/50">
                                <svg class="w-5 h-5 text-indigo-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span class="font-semibold text-gray-900 dark:text-white truncate max-w-[160px]">{{ \Illuminate\Support\Str::limit($event->tempat ?? 'Online', 30) }}</span>
                            </div>
                            
                            <!-- Organizer - ✅ FIXED -->
                            @if($event->user)
                            <div class="flex items-center gap-2 px-4 py-2 bg-emerald-50/50 dark:bg-emerald-900/30 rounded-2xl border border-emerald-200/50 dark:border-emerald-800/50">
                                <div class="w-8 h-8 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-2xl flex items-center justify-center flex-shrink-0 shadow-lg">
                                    <span class="text-sm font-bold text-white">{{ \Illuminate\Support\Str::substr($event->user->name ?? '', 0, 2) }}</span>
                                </div>
                                <span class="font-semibold text-gray-900 dark:text-white truncate max-w-[140px]">{{ \Illuminate\Support\Str::limit($event->user->name ?? 'HIMANIKKA Team', 20) }}</span>
                            </div>
                            @endif
                        </div>
                        
                        <!-- Registration Count - ✅ FIXED -->
                        <div class="flex items-center gap-1 px-4 py-2 bg-gradient-to-r from-purple-500/20 to-indigo-500/20 text-purple-700 dark:text-purple-300 font-semibold rounded-2xl border border-purple-300/50">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            {{ $event->pendaftarans_count ?? 0 }} Pendaftar
                        </div>
                    </div>

                    <!-- Action Buttons -->
                                        <!-- Action Buttons -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-3 pt-8 border-t-2 border-gray-100/50 dark:border-slate-700/50">
                        {{-- Di list event --}}
                        <a href="{{ route('user.events.pendaftaran', $event->id) }}"
                            class="group bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white font-bold py-4 px-6 lg:py-3 rounded-2xl shadow-2xl hover:shadow-3xl transition-all duration-500 text-center flex items-center justify-center gap-2 hover:-translate-y-1 hover:scale-[1.02] focus:outline-none focus:ring-4 focus:ring-purple-500/50"
                            title="Daftar {{ $event->name }}">
                            <svg class="w-5 h-5 group-hover:scale-110 transition-transform flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364a4.5 4.5 0 006.364-6.364L21.5 9a4.5 4.5 0 00-6.364-6.364L12 3.636a4.5 4.5 0 00-6.364 6.364z"/>
                            </svg>
                            <span class="lg:hidden">Daftar</span>
                            <span class="hidden lg:inline">Daftar {{ $event->name }}</span>
                        </a>

                        
                        <a href="{{ route('user.masukkan.index')}}"
                           class="group bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-bold py-4 px-6 lg:py-3 rounded-2xl shadow-2xl hover:shadow-3xl transition-all duration-500 text-center flex items-center justify-center gap-2 hover:-translate-y-1 hover:scale-[1.02]">
                            <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                            <span>Beri Masukkan</span>
                        </a>
                        
                        <div class="lg:flex gap-2 hidden">
                            <a href="{{ route('user.events.show', $event->id) }}" 
                               class="flex-1 group bg-gradient-to-r from-slate-600 to-gray-700 hover:from-slate-700 hover:to-gray-800 text-white font-bold py-3 px-4 rounded-2xl shadow-2xl hover:shadow-3xl transition-all duration-500 text-center flex items-center justify-center gap-2 hover:-translate-y-1">
                                <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                Detail
                            </a>
                        </div>
                    </div>
                </div>
            </article>
            @empty
            <div class="col-span-full text-center py-32 lg:py-48">
                <div class="max-w-lg mx-auto">
                    <div class="w-40 h-40 lg:w-48 lg:h-48 bg-gradient-to-br from-indigo-400/20 via-purple-400/20 to-emerald-400/20 rounded-4xl flex items-center justify-center mx-auto mb-12 backdrop-blur-xl border-4 border-white/30 dark:border-slate-800/50 shadow-2xl">
                        <svg class="w-20 h-20 lg:w-24 lg:h-24 text-indigo-400/80" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-4xl lg:text-5xl font-black text-gray-900 dark:text-white mb-6 bg-gradient-to-r from-gray-900 to-slate-900 bg-clip-text text-transparent dark:from-white">
                        Belum Ada event
                    </h3>
                    <p class="text-2xl text-gray-500 dark:text-gray-400 mb-10 leading-relaxed font-medium">
                        event seru akan segera hadir. Pantau terus untuk update terbaru!
                    </p>
                    <div class="text-lg text-gray-400 dark:text-gray-500 font-semibold flex items-center justify-center gap-2">
                        <div class="w-2 h-2 bg-indigo-400 rounded-full animate-pulse"></div>
                        Segera Hadir • HIMANIKKA 2026
                    </div>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>

<style>
@keyframes shimmer {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}
.animate-shimmer {
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
    animation: shimmer 2s infinite;
}
.line-clamp-2, .line-clamp-3, .line-clamp-4 {
    display: -webkit-box;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.line-clamp-2 { -webkit-line-clamp: 2; }
.line-clamp-3 { -webkit-line-clamp: 3; }
.line-clamp-4 { -webkit-line-clamp: 4; }
</style>

<script>
function shareevent(id) {
    if (navigator.share) {
        navigator.share({
            title: 'event HIMANIKKA',
            text: 'Cek event menarik ini!',
            url: window.location.origin + '/user/event/' + id
        });
    } else {
        navigator.clipboard.writeText(window.location.origin + '/user/event/' + id);
        alert('Link event sudah dicopy!');
    }
}
</script>
@endsection
