@extends(
    (auth()->user()?->role === 'admin') 
        ? 'admin.layouts.app'
        : 'layouts.app'
)

@section('title', 'Legalitas HIMANIKKA')

@section('content')
<div x-data="app()" class="min-h-screen space-y-8 p-6">

    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-4xl font-bold bg-gradient-to-r from-slate-900 to-slate-700 bg-clip-text text-transparent dark:from-white dark:to-slate-200">
                Legalitas HIMANIKKA
            </h1>
            <p class="text-slate-600 dark:text-slate-400 mt-2 text-lg">Kelengkapan Dokumen Resmi & Identitas Organisasi</p>
        </div>
        
        {{-- Admin Edit Button --}}
       
    </div>

    {{-- ✅ FIXED STATS - FULL REACTIVE --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
        {{-- Dokumen Count --}}
        <div class="bg-white/70 dark:bg-slate-800/70 backdrop-blur-xl p-8 rounded-3xl border border-slate-200/50 shadow-xl group hover:shadow-2xl transition-all">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 bg-gradient-to-br from-emerald-400 to-emerald-500 rounded-2xl flex items-center justify-center text-white font-bold text-2xl group-hover:scale-110 transition-all duration-300">
                    <i class="fas fa-certificate"></i>
                </div>
                <div>
                    <p class="text-3xl font-bold text-slate-900 dark:text-white" x-text="dokumenCount"></p>
                    <p class="text-slate-600 dark:text-slate-400 font-semibold">Dokumen Lengkap</p>
                    <span class="inline-block w-3 h-3 bg-emerald-400 rounded-full animate-pulse" x-show="dokumenCount > 0"></span>
                </div>
            </div>
        </div>

        {{-- Organization Name --}}
        <div class="bg-white/70 dark:bg-slate-800/70 backdrop-blur-xl p-8 rounded-3xl border border-slate-200/50 shadow-xl group hover:shadow-2xl transition-all">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-blue-500 rounded-2xl flex items-center justify-center text-white font-bold text-2xl group-hover:scale-110 transition-all duration-300">
                     <img src="{{ asset('assets/logohima-.png') }}" class="w-12 h-12 object-contain" alt="Logo HIMANIKKA" loading="lazy">
                </div>
                <div>
                    <p class="text-3xl font-bold text-slate-900 dark:text-white" x-text="namaOrganisasi"></p>
                    <p class="text-slate-600 dark:text-slate-400 font-semibold text-sm">{{ $profil->singkatan }}</p>
                </div>
            </div>
        </div>

        {{-- Total Elements - FIXED ANIMATION --}}
        <div class="bg-white/70 dark:bg-slate-800/70 backdrop-blur-xl p-8 rounded-3xl border border-slate-200/50 shadow-xl group hover:shadow-2xl transition-all">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 bg-gradient-to-br from-purple-400 to-purple-500 rounded-2xl flex items-center justify-center text-white font-bold text-2xl group-hover:scale-110 transition-all duration-300">
                    🎵
                </div>
                <div>
                    <p class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-purple-600 via-purple-400 to-pink-500 bg-clip-text text-transparent" 
                       x-text="totalElemen"></p>
                    <p class="text-slate-600 dark:text-slate-400 font-semibold">Elemen Identitas</p>
                    <span class="text-xs bg-purple-100 text-purple-800 px-3 py-1 rounded-full font-medium mt-2 inline-flex items-center gap-1">
                        <i class="fas fa-check-circle text-emerald-500"></i> Lengkap
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- ✅ LOGO --}}
    @if($profil->logo)
    <div class="bg-white/70 dark:bg-slate-800/70 backdrop-blur-xl rounded-3xl p-8 border border-slate-200/50 shadow-2xl">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Logo Resmi HIMANIKKA</h2>
            <button @click="openViewer('{{ asset('storage/' . $profil->logo) }}', 'image', '{{ basename($profil->logo) }}')" 
                    class="px-6 py-3 bg-emerald-500 hover:bg-emerald-600 text-white font-bold rounded-2xl shadow-xl hover:shadow-2xl transition-all">
                <i class="fas fa-expand mr-2"></i>Lihat Full
            </button>
        </div>
        <div @click="openViewer('{{ asset('storage/' . $profil->logo) }}', 'image', '{{ basename($profil->logo) }}')" 
             class="cursor-pointer max-w-sm mx-auto p-4 hover:bg-emerald-50 rounded-2xl transition-all group">
             @if($profil->logo)
            <img src="{{ $profil->logo }}" 
                 class="w-72 h-72 object-contain rounded-xl shadow-2xl hover:shadow-3xl hover:scale-105 transition-all mx-auto group-hover:opacity-90"
                 alt="Logo HIMANIKKA" loading="lazy">
            <p class="mt-4 text-center font-semibold text-slate-700 dark:text-slate-300">{{ basename($profil->logo) }}</p>
            @endif
        </div>
    </div>
    @endif

    {{-- ✅ PROFIL CARDS --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        {{-- Visi --}}
        <div class="bg-white/70 dark:bg-slate-800/70 backdrop-blur-xl p-8 rounded-3xl border border-slate-200/50 shadow-2xl">
            <div class="flex items-start gap-4 mb-6">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-400 to-blue-500 rounded-2xl flex items-center justify-center text-white font-bold text-lg mt-1">👁️</div>
                <div>
                    <h3 class="text-2xl font-bold text-slate-900 dark:text-white">Visi</h3>
                    <p class="text-emerald-600 font-semibold bg-emerald-100 px-3 py-1 rounded-full text-sm">Tujuan Jangka Panjang</p>
                </div>
            </div>
            <div class="text-lg leading-relaxed text-slate-700 dark:text-slate-300">
                {!! $profil->visi ?: '<i class="text-slate-400 italic block py-8 text-center">Belum diisi</i>' !!}
            </div>
        </div>

        {{-- Misi --}}
        <div class="bg-white/70 dark:bg-slate-800/70 backdrop-blur-xl p-8 rounded-3xl border border-slate-200/50 shadow-2xl">
            <div class="flex items-start gap-4 mb-6">
                <div class="w-12 h-12 bg-gradient-to-br from-green-400 to-green-500 rounded-2xl flex items-center justify-center text-white font-bold text-lg mt-1">🎯</div>
                <div>
                    <h3 class="text-2xl font-bold text-slate-900 dark:text-white">Misi</h3>
                    <p class="text-indigo-600 font-semibold bg-indigo-100 px-3 py-1 rounded-full text-sm">Langkah Strategis</p>
                </div>
            </div>
            <div class="text-lg leading-relaxed text-slate-700 dark:text-slate-300">
                {!! nl2br(e($profil->misi ?? '')) ?: '<i class="text-slate-400 italic block py-8 text-center">Belum diisi</i>' !!}
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        {{-- Moto - FIXED: $profil->moto (bukan motto) --}}
        <div class="lg:col-span-1 bg-gradient-to-br from-purple-50 to-pink-50 dark:from-purple-900/20 p-8 rounded-3xl border border-purple-200/50 shadow-2xl h-64 flex items-center justify-center">
            <div class="text-center max-w-md">
                <div class="w-20 h-20 bg-gradient-to-br from-purple-400 to-purple-500 rounded-3xl flex items-center justify-center text-white text-2xl mx-auto mb-6 shadow-2xl">💬</div>
                <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-4">Moto</h3>
                @if($profil->motto)
                <blockquote class="text-2xl font-bold italic text-slate-800 dark:text-slate-200 leading-tight">"{{ $profil->motto }}"</blockquote>
                @else
                <div class="text-slate-400 text-xl italic py-8">Moto belum diisi</div>
                @endif
            </div>
        </div>
        <!-- FIXED AD/ART -->
        @if($profil->{'AD/ART'})
<div class="bg-white/70 dark:bg-slate-800/70 backdrop-blur-xl p-8 rounded-3xl border border-slate-200/50 shadow-2xl">
    <div class="flex items-start gap-4 mb-6">
        <div class="w-12 h-12 bg-gradient-to-br from-pink-400 to-pink-500 rounded-2xl flex items-center justify-center text-white font-bold text-lg mt-1 shadow-lg">📑</div>
        <div>
            <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-1">AD/ART</h3>
            <p class="text-pink-600 font-semibold bg-pink-100/80 dark:bg-pink-900/30 px-3 py-1 rounded-full text-sm border border-pink-200/50">Dokumen Resmi</p>
        </div>
    </div>
    
    {{-- Download & Preview Buttons --}}
    <div class="flex flex-col sm:flex-row gap-4 items-start sm:items-center mb-6 p-4 bg-gradient-to-r from-pink-50/50 to-pink-100/50 dark:from-pink-900/20 dark:to-pink-800/20 rounded-2xl border border-pink-200/30">
        {{-- Download Button --}}
        <a href="{{ asset('storage/' . $profil->{'AD/ART'}) }}" 
           target="_blank" 
           download 
           class="group inline-flex items-center gap-3 px-6 py-3 bg-gradient-to-r from-pink-500 to-pink-600 text-white font-bold rounded-xl hover:from-pink-600 hover:to-pink-700 shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300 whitespace-nowrap flex-1 sm:flex-none">
            <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10l-5.5 5.5m0 0L7.5 20.5M7.5 14.5l5.5 5.5 5.5-5.5M19 10V6a2 2 0 00-2-2H5a2 2 0 00-2 2v4m14 0v8a2 2 0 01-2 2H5a2 2 0 01-2-2V10m14 0h2m-2 0h-2"/>
            </svg>
            <span>📥 Download AD/ART</span>
        </a>
        
        {{-- Preview Button --}}
        <a href="{{ asset('storage/' . $profil->{'AD/ART'}) }}" 
           target="_blank"
           class="inline-flex items-center gap-2 px-6 py-3 bg-white/80 dark:bg-slate-700/80 hover:bg-white dark:hover:bg-slate-600 border border-slate-200/50 dark:border-slate-600/50 text-slate-700 dark:text-slate-300 font-semibold rounded-xl hover:shadow-lg transition-all duration-200 flex-1 sm:flex-none">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
            </svg>
            Lihat Dokumen
        </a>
    </div>

    {{-- File Information --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm text-slate-600 dark:text-slate-400 p-4 bg-slate-50/50 dark:bg-slate-700/30 rounded-xl border border-slate-200/30">
        <div class="flex items-center gap-2">
            <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <span>Instrumen Sound</span>
        </div>
        <div class="flex items-center gap-2">
            <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            @php
                $filePath = storage_path('app/public/' . $profil->{'AD/ART'});
                $fileSize = file_exists($filePath) ? number_format(filesize($filePath) / 1024, 1) : 'N/A';
            @endphp
            <span>Ukuran: {{ $fileSize }} KB</span>
        </div>
        <div class="flex items-center gap-2">
            <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            <span>Terverifikasi</span>
        </div>
    </div>
</div>
@else
{{-- Empty State --}}
<div class="bg-gradient-to-br from-slate-50/50 to-slate-100/50 dark:from-slate-800/50 dark:to-slate-900/50 backdrop-blur-xl p-8 rounded-3xl border-2 border-dashed border-slate-300/50 dark:border-slate-600/50 text-center hover:border-emerald-400/70 transition-all duration-300 hover:shadow-lg cursor-pointer group" onclick="openEditModal({{ $profil->id }})">
    <div class="w-16 h-16 mx-auto mb-6 bg-gradient-to-br from-slate-200/70 to-slate-300/70 dark:from-slate-700/70 dark:to-slate-600/70 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
        <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
        </svg>
    </div>
    <h4 class="text-xl font-bold text-slate-700 dark:text-slate-300 mb-2 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">Belum ada AD/ART</h4>
    <p class="text-slate-500 dark:text-slate-400 mb-4 text-sm">Klik untuk upload dokumen AD/ART organisasi</p>
    <div class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-100/80 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300 text-xs font-semibold rounded-full border border-emerald-200/50">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
        </svg>
        Upload Sekarang
    </div>
</div>
@endif


        {{-- ✅ FIXED LAGU --}}
        @if($profil->lagu)
        <div class="bg-white/70 dark:bg-slate-800/70 backdrop-blur-xl p-8 rounded-3xl border border-slate-200/50 shadow-2xl text-center">
            <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-6">
                @if(str_ends_with(strtolower($profil->lagu), '.mp3'))
                    🎵 Mars HIMANIKKA
                @elseif(str_ends_with(strtolower($profil->lagu), '.mp4'))
                    🎬 Video HIMANIKKA
                @else
                    📁 Media HIMANIKKA
                @endif
            </h3>
            
            <div @click="openViewer('{{ asset('storage/' . $profil->lagu) }}', 
                                '{{ strtolower(pathinfo($profil->lagu, PATHINFO_EXTENSION)) }}', 
                                '{{ basename($profil->lagu) }}')" 
                 class="cursor-pointer inline-flex flex-col items-center p-12 mx-auto max-w-md
                        @if(str_ends_with(strtolower($profil->lagu), '.mp3'))
                            bg-gradient-to-br from-rose-500 to-rose-600 hover:from-rose-600 hover:to-rose-700 text-white
                        @elseif(str_ends_with(strtolower($profil->lagu), '.mp4'))
                            bg-gradient-to-br from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white
                        @else
                            bg-gradient-to-br from-gray-500 to-gray-600 hover:from-gray-600 hover:to-gray-700 text-white
                        @endif
                        rounded-3xl shadow-2xl hover:shadow-3xl hover:-translate-y-2 transition-all group">
                
                <div class="w-32 h-32 bg-white/20 backdrop-blur-sm rounded-3xl flex items-center justify-center mb-6 shadow-2xl group-hover:scale-110 transition-all">
                    @if(str_ends_with(strtolower($profil->lagu), '.mp3'))
                        <i class="fas fa-music text-5xl text-white"></i>
                    @elseif(str_ends_with(strtolower($profil->lagu), '.mp4'))
                        <i class="fas fa-video text-5xl text-white"></i>
                    @else
                        <i class="fas fa-file-audio text-5xl text-white"></i>
                    @endif
                </div>
                
                <div>
                    <h4 class="text-xl font-bold mb-2">
                        @if(str_ends_with(strtolower($profil->lagu), '.mp3')) Mars HIMANIKKA
                        @elseif(str_ends_with(strtolower($profil->lagu), '.mp4')) Video Resmi
                        @endif
                    </h4>
                    <p class="font-semibold text-lg opacity-90">{{ basename($profil->lagu) }}</p>
                </div>
            </div>
        </div>
        @else
        <div class="bg-gradient-to-r from-rose-50 to-rose-100 p-8 rounded-3xl border-l-4 border-rose-400">
            <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-4">Lagu Mars</h3>
            <pre class="whitespace-pre-wrap text-slate-800 dark:text-slate-200 text-lg leading-relaxed font-light">
                {!! $profil->lagu ?: 'Lirik lagu belum diisi' !!}
            </pre>
        </div>
        @endif
    </div>

    {{-- ✅ FIXED PDF --}}
    @if($profil->instrumen)
    <div class="bg-gradient-to-r from-orange-50 to-orange-100 dark:from-orange-900/20 p-8 rounded-3xl border-l-8 border-orange-500 shadow-2xl">
        <div class="flex items-center gap-4 mb-6">
            <div class="w-16 h-16 bg-gradient-to-br from-orange-400 to-orange-500 rounded-2xl flex items-center justify-center text-white font-bold text-xl">📄</div>
            <h3 class="text-2xl font-bold text-slate-900 dark:text-white flex-1">Lagu Instrumen</h3>
            <button @click="openViewer('{{ asset('storage/' . $profil->instrumen) }}', 'pdf', '{{ basename($profil->instrumen) }}')" 
                    class="px-8 py-3 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-bold rounded-2xl shadow-xl hover:shadow-2xl transition-all">
                <i class="fas fa-file-video mr-2"></i>Lihat Instrumen
            </button>
        </div>
    </div>
    @endif

    {{-- COMPLETE FILE VIEWER MODAL --}}
    <div x-show="isOpen" 
         class="fixed inset-0 bg-black/80 backdrop-blur-md z-[9999] flex items-center justify-center p-6"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @keyup.escape="closeViewer()"
         @click.away="closeViewer()"
         x-cloak>
        <div class="bg-white/95 dark:bg-slate-900/95 backdrop-blur-2xl rounded-3xl shadow-2xl max-w-6xl w-full max-h-[95vh] overflow-hidden border-4 border-white/20" @click.stop>
            <!-- Header -->
            <div class="p-8 border-b border-white/20 flex items-center justify-between sticky top-0 bg-white/80 dark:bg-slate-900/80 backdrop-blur-sm z-10">
                <div class="flex items-center gap-4">
                    <i x-show="viewerType === 'image'" class="fas fa-image text-3xl text-blue-500"></i>
                    <i x-show="viewerType === 'pdf'" class="fas fa-file-pdf text-3xl text-red-500"></i>
                    <i x-show="viewerType === 'mp3' || viewerType === 'audio'" class="fas fa-music text-3xl text-rose-500"></i>
                    <i x-show="viewerType === 'mp4' || viewerType === 'video'" class="fas fa-video text-3xl text-indigo-500"></i>
                    <div>
                        <h3 class="text-2xl font-bold text-slate-900 dark:text-white" 
                            x-text="viewerType ? viewerType.charAt(0).toUpperCase() + viewerType.slice(1) + ' Viewer' : 'File Viewer'"></h3>
                        <p class="text-slate-600 dark:text-slate-400 text-lg font-semibold" x-text="fileName || 'File'"></p>
                    </div>
                </div>
                <div class="flex gap-3">
                    <a :href="fileUrl" download 
                       class="p-4 bg-blue-500 hover:bg-blue-600 text-white rounded-2xl transition-all shadow-xl hover:shadow-2xl flex items-center justify-center">
                        <i class="fas fa-download text-xl"></i>
                    </a>
                    <button @click="closeViewer()" 
                            class="p-4 bg-slate-400/20 hover:bg-slate-400/40 text-white rounded-2xl transition-all shadow-xl hover:shadow-2xl flex items-center justify-center">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>

            <!-- Content -->
            <div class="p-8 max-h-[70vh] overflow-auto">
                <!-- Image -->
                <div x-show="viewerType === 'image' || viewerType === 'png' || viewerType === 'jpg' || viewerType === 'jpeg'" 
                     class="flex justify-center items-center bg-gradient-to-br from-slate-50 to-slate-100 dark:from-slate-900/50 p-16 min-h-[500px] rounded-2xl">
                    <img :src="fileUrl" :alt="fileName" class="max-w-full max-h-[60vh] object-contain rounded-2xl shadow-2xl" loading="lazy">
                </div>
                
                <!-- PDF -->
                <div x-show="viewerType === 'pdf'" class="w-full h-[60vh]">
                    <iframe :src="fileUrl" class="w-full h-full rounded-2xl shadow-2xl border-0 bg-white"></iframe>
                </div>
                
                <!-- Audio -->
                <div x-show="viewerType === 'mp3' || viewerType === 'audio'" 
                     class="flex flex-col items-center p-16 bg-gradient-to-b from-slate-50 to-slate-100 dark:from-slate-900/50 rounded-2xl">
                    <div class="w-64 h-64 bg-gradient-to-br from-rose-400 to-rose-500 rounded-3xl flex items-center justify-center text-white text-6xl mb-12 shadow-2xl">
                        <i class="fas fa-music"></i>
                    </div>
                    <audio :src="fileUrl" controls class="w-full max-w-lg mx-auto rounded-3xl shadow-2xl mb-8 bg-white"></audio>
                    <p class="text-center text-xl font-bold text-slate-700 dark:text-slate-300">Mars HIMANIKKA</p>
                </div>
                
                <!-- Video -->
                <div x-show="viewerType === 'mp4' || viewerType === 'video'" 
                     class="flex justify-center items-center bg-gradient-to-br from-slate-50 to-slate-100 dark:from-slate-900/50 p-8 min-h-[500px] rounded-2xl">
                    <video :src="fileUrl" controls class="max-w-4xl max-h-[60vh] w-auto rounded-3xl shadow-3xl mx-auto bg-black">
                        Browser tidak mendukung video.
                    </video>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function app() {
    return {
        // Stats data
        dokumenCount: {{ ($profil->logo ? 1 : 0) + ($profil->lagu ? 1 : 0) + ($profil->instrumen ? 1 : 0) }},
        namaOrganisasi: '{{ $profil->name ?? "HIMANIKKA" }}',
        totalElemen: 6,
        
        // File viewer
        isOpen: false,
        fileUrl: '',
        viewerType: '',
        fileName: '',
        
        init() {
            console.log('Legalitas page loaded');
        },
        
        openViewer(url, type, name) {
            this.isOpen = true;
            this.fileUrl = url;
            this.viewerType = type.toLowerCase();
            this.fileName = name;
            document.body.style.overflow = 'hidden';
            document.documentElement.style.overflow = 'hidden';
        },
        
        closeViewer() {
            this.isOpen = false;
            this.fileUrl = '';
            this.viewerType = '';
            this.fileName = '';
            document.body.style.overflow = '';
            document.documentElement.style.overflow = '';
        }
    }
}
</script>

<style>
[x-cloak] { display: none !important; }
</style>
@endsection
