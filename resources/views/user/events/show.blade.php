@extends('user.layouts.app')

@section('title', 'Detail Event - ' . ($event->name ?? $event->nama_acara ?? 'HIMANIKKA Event'))

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-emerald-50 dark:from-slate-900 dark:via-slate-800 dark:to-emerald-900/20">
    <div class="container mx-auto px-4 py-12 lg:py-16">
        {{-- 🏷️ BREADCRUMB --}}
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3 text-sm font-medium text-slate-500 dark:text-slate-400">
                <li class="inline-flex items-center">
                    <a href="{{ route('user.dashboard.index') }}" class="inline-flex items-center text-slate-700 hover:text-emerald-600 dark:text-slate-300 dark:hover:text-emerald-400">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-slate-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ route('events.index') }}" class="ml-1 text-slate-700 hover:text-emerald-600 dark:text-slate-300 dark:hover:text-emerald-400 md:ml-2">Events</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-slate-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-slate-900 font-semibold dark:text-white md:ml-2 capitalize-first">{{ Str::limit($event->name ?? $event->nama_acara ?? 'Event', 30) }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        {{-- 🎯 MAIN CONTENT --}}
        <div class="max-w-6xl mx-auto">
            <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl rounded-3xl shadow-2xl border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">
                {{-- HEADER --}}
                <div class="p-8 lg:p-12">
                    <div class="flex flex-col lg:flex-row lg:items-start gap-8">
                        {{-- POSTER --}}
                        <div class="lg:w-1/2 flex-shrink-0">
                            <div class="relative overflow-hidden rounded-2xl shadow-2xl group">
                                <img src="{{ asset('storage/' . ($event->poster ?? 'images/default-event-poster.jpg')) }}" 
                                     alt="{{ $event->name ?? $event->nama_acara ?? 'HIMANIKKA Event' }} Poster" 
                                     class="w-full h-96 lg:h-[500px] object-cover transition-transform duration-500 group-hover:scale-105"
                                     loading="lazy">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent"></div>
                            </div>
                            
                            {{-- EVENT TAGS --}}
                            <div class="flex flex-wrap gap-2 mt-6">
                                @if($event->kategori)
                                    <span class="px-4 py-2 bg-emerald-100/80 dark:bg-emerald-900/30 text-emerald-800 dark:text-emerald-200 text-sm font-semibold rounded-full border border-emerald-200/50">
                                        {{ $event->kategori }}
                                    </span>
                                @endif
                                @if($event->status)
                                    <span class="px-4 py-2 bg-{{ $event->status == 'aktif' ? 'emerald' : 'slate' }}-100/80 dark:bg-{{ $event->status == 'aktif' ? 'emerald' : 'slate' }}-900/30 text-{{ $event->status == 'aktif' ? 'emerald' : 'slate' }}-800 dark:text-{{ $event->status == 'aktif' ? 'emerald' : 'slate' }}-200 text-sm font-semibold rounded-full border border-{{ $event->status == 'aktif' ? 'emerald' : 'slate' }}-200/50 capitalize">
                                        {{ $event->status }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- DETAIL INFO --}}
                        <div class="lg:w-1/2 lg:pl-12 space-y-6">
                            <div>
                                <h1 class="text-4xl lg:text-5xl font-black bg-gradient-to-r from-slate-900 to-slate-700 bg-clip-text text-transparent dark:from-slate-100 dark:to-slate-400 mb-4 leading-tight">
                                    {{ $event->name ?? $event->nama_acara ?? 'Event HIMANIKKA' }}
                                </h1>
                                <p class="text-xl text-slate-600 dark:text-slate-400 leading-relaxed">{{ $event->deskripsi ?? $event->description ?? 'Deskripsi event akan ditampilkan di sini.' }}</p>
                            </div>

                            {{-- DETAIL LIST --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- JADWAL --}}
                                <div class="bg-gradient-to-br from-emerald-50/50 to-blue-50/50 dark:from-emerald-900/20 dark:to-blue-900/20 p-6 rounded-2xl border border-emerald-200/30">
                                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        Jadwal
                                    </h3>
                                    <div class="space-y-3 text-slate-700 dark:text-slate-300">
                                        <div class="flex items-center gap-3 p-3 bg-white/60 dark:bg-slate-700/50 rounded-xl">
                                            <div class="w-12 h-12 bg-gradient-to-br from-emerald-100 to-emerald-200 dark:from-emerald-900/50 rounded-xl flex items-center justify-center text-emerald-700 font-bold text-lg">
                                                🕒
                                            </div>
                                            <div>
                                                <p class="text-sm font-semibold text-slate-600 dark:text-slate-400 uppercase tracking-wide">Waktu Mulai</p>
                                                <p class="font-bold text-lg">{{ \Carbon\Carbon::parse($event->waktu ?? $event->tanggal ?? now())->translatedFormat('l, d F Y, H:i') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- LOKASI --}}
                                <div class="bg-gradient-to-br from-blue-50/50 to-indigo-50/50 dark:from-blue-900/20 dark:to-indigo-900/20 p-6 rounded-2xl border border-blue-200/30">
                                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        Lokasi
                                    </h3>
                                    <div class="text-slate-700 dark:text-slate-300">
                                        <div class="flex items-start gap-3 p-4 bg-white/60 dark:bg-slate-700/50 rounded-xl">
                                            <div class="w-12 h-12 bg-gradient-to-br from-blue-100 to-blue-200 dark:from-blue-900/50 rounded-xl flex items-center justify-center text-blue-700 font-bold text-lg mt-1 flex-shrink-0">
                                                📍
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="font-bold text-lg mb-1 leading-tight">{{ $event->lokasi ?? '-' }}</p>
                                                @if($event->alamat_lengkap)
                                                    <p class="text-sm text-slate-600 dark:text-slate-400">{{ Str::limit($event->alamat_lengkap, 80) }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- ACTION BUTTONS --}}
                            <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-slate-200/50 dark:border-slate-700/50">
                                @php
                                    $daftarLink = $event->link_pendaftaran ?? 
                                                 $event->linkpendaftaran ?? 
                                                 $event->link ?? 
                                                 $event->url ?? 
                                                 null;
                                @endphp

                                @if($daftarLink)
                                    {{-- DAFTAR ONLINE --}}
                                    <a href="{{ $daftarLink }}" 
                                       target="_blank"
                                       class="group flex-1 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white font-black py-4 px-8 rounded-2xl text-lg shadow-2xl hover:from-emerald-600 hover:to-emerald-700 hover:shadow-3xl hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-3">
                                        <svg class="w-6 h-6 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                        </svg>
                                        Daftar Sekarang
                                    </a>
                                @else
                                    {{-- WHATSAPP FALLBACK --}}
                                    <a href="https://wa.me/6281234567890?text=Saya%20mau%20daftar%20{{ urlencode($event->name ?? $event->nama_acara ?? '') }}" 
                                       target="_blank"
                                       class="group flex-1 bg-gradient-to-r from-green-500 to-green-600 text-white font-black py-4 px-8 rounded-2xl text-lg shadow-2xl hover:from-green-600 hover:to-green-700 hover:shadow-3xl hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-3">
                                        <svg class="w-6 h-6 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V7a2 2 0 012-2h10a2 2 0 012 2v5a2 2 0 01-2 2h-4l-1 1z"/>
                                        </svg>
                                        Chat WA Admin
                                    </a>
                                @endif

                                {{-- CETAK --}}
                                <button onclick="window.print()" 
                                        class="flex-1 bg-gradient-to-r from-slate-500 to-slate-600 text-white font-black py-4 px-8 rounded-2xl text-lg shadow-2xl hover:from-slate-600 hover:to-slate-700 hover:shadow-3xl hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v.01"/>
                                    </svg>
                                    Cetak
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
