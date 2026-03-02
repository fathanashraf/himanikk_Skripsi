@extends('admin.layouts.app')

@section('title', 'Kelola Pendaftaran')

@section('content')
<div class="space-y-8">
    {{-- Header --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 lg:gap-8">
        {{-- Main Header --}}
        <div class="flex items-center gap-4">
            <div class="flex-shrink-0 p-3.5 bg-gradient-to-br from-emerald-500 via-blue-600 to-purple-600 rounded-2xl shadow-2xl border border-white/20 hover:border-white/40 active:border-white/60 backdrop-blur-sm hover:shadow-3xl hover:scale-[1.02] transition-all duration-300 group">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 text-white drop-shadow-2xl group-hover:scale-110 transition-transform duration-200">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5a2.25 2.25 0 01-4.5 0v-.75a9 9 0 00-2.25-6m5.25 6v-.75a4.5 4.5 0 00-9 0v.75m5.25 0V18a2.25 2.25 0 01-2.25 2.25H9.75A2.25 2.25 0 017.5 18V7.5m5.25 0H9.75m4.5 0H9.75m4.5 0V18m-4.5 0v.75"/>
                </svg>
            </div>
            <div class="min-w-0 flex-1">
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-black leading-tight tracking-tight mb-1.5 bg-gradient-to-r from-slate-900 via-gray-900 to-slate-900 bg-clip-text text-transparent dark:from-slate-100 via-white to-slate-200 drop-shadow-sm">
                    Kelola Pendaftaran
                </h1>
                <p class="text-lg md:text-xl text-gray-600 dark:text-gray-300 font-medium tracking-wide leading-relaxed max-w-2xl">
                    Kelola pendaftaran acara, kegiatan, dan event HIMANIKKA
                </p>
            </div>
        </div>

        {{-- Filter & Actions --}}
        <div class="flex flex-col sm:flex-row gap-3">
            <form method="GET" action="{{ route('admin.pendaftaran.index') }}" class="flex flex-col sm:flex-row items-end gap-3 flex-1">
                <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                    {{-- Search --}}
                    <div class="relative flex-1 min-w-0">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400 pointer-events-none" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.601 10.601z"/>
                        </svg>
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ request('search', '') }}" 
                            placeholder="Cari nama, email, atau nomor HP..." 
                            class="w-full pl-11 pr-4 py-3 border border-gray-200 dark:border-gray-700 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 text-sm"
                        >
                    </div>

                    {{-- Status Filter --}}
                    <select name="status" class="w-full sm:w-auto px-4 py-3 border border-gray-200 dark:border-gray-700 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                        <option value="">Semua Status</option>
                        <option value="proses" {{ request('status') == 'proses' ? 'selected' : '' }}>Proses</option>
                        <option value="diterima" {{ request('status') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                        <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>

                <button type="submit" class="px-8 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold rounded-xl shadow-lg transition-all duration-200 whitespace-nowrap flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.601 10.601z"/>
                    </svg>
                    Filter
                </button>

                @if(request()->hasAny(['search', 'status']))
                    <a href="{{ route('admin.pendaftaran.index') }}" class="px-6 py-3 text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white font-medium transition-colors rounded-xl hover:bg-gray-100 dark:hover:bg-slate-800/50 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 15L11.25 15m0 0L13.5 15m-2.25 0l-.75 3.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Clear
                    </a>
                @endif
            </form>

            <button onclick="openCreatePendaftaranModal()" class="px-8 py-3 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white font-semibold rounded-xl shadow-lg transition-all duration-200 whitespace-nowrap flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Tambah Pendaftaran
            </button>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
        @php
            $stats = $stats ?? [
                'total' => 0,
                'proses' => 0,
                'diterima' => 0,
                'ditolak' => 0,
                'dengan_bukti' => 0
            ];
        @endphp

        {{-- Total --}}
        <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-700 hover:shadow-md transition-all duration-200 group">
            <div class="flex items-center">
                <div class="p-3 bg-gradient-to-r from-slate-500 to-slate-600 rounded-xl shadow-lg group-hover:scale-105 transition-transform duration-200">
                    <svg class="w-7 h-7 text-white" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2 2z"/>
                    </svg>
                </div>
                <div class="ml-5">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ number_format($stats['total']) }}</p>
                </div>
            </div>
        </div>

        {{-- Proses --}}
        <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-700 hover:shadow-md transition-all duration-200 group">
            <div class="flex items-center">
                <div class="p-3 bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-xl shadow-lg group-hover:scale-105 transition-transform duration-200">
                    <svg class="w-7 h-7 text-white" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="ml-5">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Proses</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ number_format($stats['proses']) }}</p>
                </div>
            </div>
        </div>

        {{-- Diterima --}}
        <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-700 hover:shadow-md transition-all duration-200 group">
            <div class="flex items-center">
                <div class="p-3 bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-xl shadow-lg group-hover:scale-105 transition-transform duration-200">
                    <svg class="w-7 h-7 text-white" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="ml-5">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Diterima</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ number_format($stats['diterima']) }}</p>
                </div>
            </div>
        </div>

        {{-- Ditolak --}}
        <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-700 hover:shadow-md transition-all duration-200 group">
            <div class="flex items-center">
                <div class="p-3 bg-gradient-to-r from-red-500 to-red-600 rounded-xl shadow-lg group-hover:scale-105 transition-transform duration-200">
                    <svg class="w-7 h-7 text-white" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 14.25v-.188a2.25 2.25 0 012.25-2.25h2.513a2.25 2.25 0 012.25 2.25v.188M10 14.25L12 17.25l2-3M10 14.25v-.188a2.25 2.25 0 012.25-2.25h2.513a2.25 2.25 0 012.25 2.25v.188"/>
                    </svg>
                </div>
                <div class="ml-5">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Ditolak</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ number_format($stats['ditolak']) }}</p>
                </div>
            </div>
        </div>

        {{-- Dengan Bukti --}}
        <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-700 hover:shadow-md transition-all duration-200 group">
            <div class="flex items-center">
                <div class="p-3 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl shadow-lg group-hover:scale-105 transition-transform duration-200">
                    <svg class="w-7 h-7 text-white" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m16.5-7.5V21a2.25 2.25 0 01-2.25 2.25H6.75A2.25 2.25 0 014.5 21V10.5"/>
                    </svg>
                </div>
                <div class="ml-5">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Bukti</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ number_format($stats['dengan_bukti']) }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Table --}}
    <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-sm border border-gray-100 dark:border-slate-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full divide-y divide-gray-200 dark:divide-slate-700">
                <thead class="bg-gradient-to-r from-slate-50 to-slate-100 dark:from-slate-800/60 dark:to-slate-900/60">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider w-64">Pendaftar</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Kontak</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Referensi</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider w-32">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider w-40">Dokumen</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider w-32">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-slate-700">
                    @forelse($pendaftarans ?? [] as $pendaftaran)
                    <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50 transition-all duration-200 group"
                        data-pendaftaran-id="{{ $pendaftaran->id }}"
                        data-pendaftaran-data="{{ json_encode([
                            'id' => $pendaftaran->id,
                            'name' => $pendaftaran->name,
                            'email' => $pendaftaran->email,
                            'phone' => $pendaftaran->phone,
                            'status' => $pendaftaran->status,
                            'image' => $pendaftaran->image,
                            'bukti' => $pendaftaran->bukti,
                            'keterangan' => $pendaftaran->keterangan,
                            'link' => $pendaftaran->link,
                            'user_id' => $pendaftaran->user_id,
                            'kegiatan_id' => $pendaftaran->kegiatan_id,
                            'event_id' => $pendaftaran->event_id,
                            'acara_id' => $pendaftaran->acara_id
                        ]) }}">

                        {{-- Pendaftar --}}
                        <td class="px-6 py-5">
                            <div class="flex items-center space-x-3">
                                @if($pendaftaran->image)
                                <img src="{{ Storage::url($pendaftaran->image) }}" 
                                     alt="{{ $pendaftaran->name }}" 
                                     class="flex-shrink-0 w-10 h-10 rounded-2xl object-cover shadow-lg" 
                                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
                                @endif
                                <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-emerald-500 to-blue-600 rounded-2xl shadow-lg flex items-center justify-center {{ $pendaftaran->image ? 'hidden' : '' }}">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.93 17.93 0 0112 21.75a17.93 17.93 0 01-2.499-.118z"/>
                                    </svg>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <div class="font-semibold text-gray-900 dark:text-white truncate max-w-md group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                                        {{ $pendaftaran->name }}
                                    </div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400 truncate max-w-xs">
                                        {{ $pendaftaran->email }}
                                    </div>
                                </div>
                            </div>
                        </td>

                        {{-- Kontak --}}
                        <td class="px-6 py-5">
                            <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $pendaftaran->phone }}</div>
                            @if($pendaftaran->link)
                            <a href="{{ $pendaftaran->link }}" target="_blank" 
                               class="text-xs text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 font-medium truncate max-w-xs">
                                🔗 {{ Str::limit($pendaftaran->link, 30) }}
                            </a>
                            @endif
                        </td>

                        {{-- Referensi --}}
                        <td class="px-6 py-5">
                            <div class="space-y-1 max-w-[200px]">
                                @if($pendaftaran->acara)
                                    <span class="inline-flex items-center gap-1 text-xs bg-orange-100 dark:bg-orange-900/30 text-orange-800 dark:text-orange-300 px-2 py-1 rounded-full font-medium">
                                        🎉 {{ Str::limit($pendaftaran->acara->name ?? 'Acara #' . $pendaftaran->acara_id, 25) }}
                                    </span>
                                @elseif($pendaftaran->event)
                                    <span class="inline-flex items-center gap-1 text-xs bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300 px-2 py-1 rounded-full font-medium">
                                        🎪 {{ Str::limit($pendaftaran->event->name ?? 'Event #' . $pendaftaran->event_id, 25) }}
                                    </span>
                                @elseif($pendaftaran->kegiatan)
                                    <span class="inline-flex items-center gap-1 text-xs bg-purple-100 dark:bg-purple-900/30 text-purple-800 dark:text-purple-300 px-2 py-1 rounded-full font-medium">
                                        ⚡ {{ Str::limit($pendaftaran->kegiatan->name ?? 'Kegiatan #' . $pendaftaran->kegiatan_id, 25) }}
                                    </span>
                                @else
                                    <span class="text-xs text-gray-500 dark:text-gray-400 italic">Tanpa referensi</span>
                                @endif
                            </div>
                        </td>

                        {{-- Status --}}
                        <td class="px-6 py-5">
                            @php
                                $statusClass = match($pendaftaran->status) {
                                    'diterima' => 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-300',
                                    'ditolak' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300',
                                    default => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300'
                                };
                                
                                $statusText = match($pendaftaran->status) {
                                    'diterima' => 'Diterima ✅',
                                    'ditolak' => 'Ditolak ❌',
                                    default => 'Diproses ⏳'
                                };
                            @endphp
                            <span class="inline-flex px-4 py-2 {{ $statusClass }} border rounded-full text-sm font-semibold shadow-sm">
                                {{ $statusText }}
                            </span>
                        </td>

                        {{-- Dokumen --}}
                        <td class="px-6 py-5">
                            <div class="flex flex-col gap-1">
                                @if($pendaftaran->bukti)
                                <div class="flex items-center gap-2">
                                    <a href="{{ Storage::url($pendaftaran->bukti) }}" target="_blank" 
                                       class="inline-flex items-center p-2 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white text-xs font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 hover:scale-105">
                                        <svg class="w-3 h-3" fill="none" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.638 19.5 12 19.5s-8.573-3.007-9.963-7.178z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    </a>
                                </div>
                                @else
                                <span class="px-3 py-1 bg-gray-100 dark:bg-gray-900/50 text-gray-500 dark:text-gray-400 text-xs font-medium rounded-lg flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Tidak ada bukti
                                </span>
                                @endif

                                @if($pendaftaran->keterangan)
                                <div class="text-xs text-gray-500 dark:text-gray-400 bg-gray-50 dark:bg-slate-800/50 px-2 py-1 rounded-lg truncate max-w-xs">
                                    {{ Str::limit($pendaftaran->keterangan, 50) }}
                                </div>
                                @endif
                            </div>
                        </td>

                        {{-- Aksi --}}
                        <td class="px-6 py-5 text-center">
                            <div class="flex items-center justify-center gap-1">
                                <button onclick="openEditPendaftaranModalFromRow(this)"
                                        class="p-2.5 text-emerald-600 hover:text-emerald-800 hover:bg-emerald-100 dark:text-emerald-400 dark:hover:text-emerald-300 dark:hover:bg-emerald-900/30 rounded-xl transition-all duration-200 shadow-sm hover:shadow-md hover:scale-105"
                                        title="Edit Pendaftaran">
                                    <svg class="w-4 h-4" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M16.862 4.487L19.5 7.125"/>
                                    </svg>
                                </button>
                                <button onclick="openDeletePendaftaranModal({{ $pendaftaran->id }}, '{{ addslashes($pendaftaran->name) }}')"
        class="p-2.5 text-red-600 hover:text-red-800 hover:bg-red-100 dark:text-red-400 dark:hover:text-red-300 dark:hover:bg-red-900/30 rounded-xl transition-all duration-200 shadow-sm hover:shadow-md hover:scale-105"
        title="Hapus Pendaftaran">
    <svg class="w-4 h-4" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
    </svg>
</button>

                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-20 text-center">
                            <div class="max-w-md mx-auto text-gray-500 dark:text-gray-400">
                                <div class="w-24 h-24 bg-gradient-to-br from-slate-100 to-slate-200 dark:from-slate-800 dark:to-slate-900 rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                                    <svg class="w-12 h-12 text-slate-400" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 15.582a2.25 2.25 0 01-1.897.597l-2.685.8a2.25 2.25 0 01-.597-1.897l.668-2.684a2.25 2.25 0 011.897-.597h.227c.636 0 1.25.138 1.803.395a11.519 11.519 0 006.486 1.846 11.519 11.519 0 006.486-1.846A1.25 1.25 0 0119.5 13.75v2.753"/>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold mb-2 text-gray-900 dark:text-white">Belum ada pendaftaran</h3>
                                <p class="text-lg mb-8">Belum ada pendaftaran untuk acara, kegiatan, atau event HIMANIKKA</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if(isset($pendaftarans) && $pendaftarans->hasPages())
        <div class="px-6 py-6 bg-gradient-to-r from-slate-50 to-slate-100 dark:from-slate-800/60 dark:to-slate-900/60 border-t border-gray-200 dark:border-slate-700">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div class="text-sm text-gray-700 dark:text-gray-400 mb-4 sm:mb-0">
                    Menampilkan <span class="font-semibold">{{ $pendaftarans->firstItem() ?? 0 }}</span> -
                    <span class="font-semibold">{{ $pendaftarans->lastItem() ?? 0 }}</span>
                    dari <span class="font-semibold">{{ $pendaftarans->total() }}</span> pendaftaran
                </div>
                {{ $pendaftarans->appends(request()->query())->links('vendor.pagination.tailwind') }}
            </div>
        </div>
        @endif
    </div>
</div>

{{-- Modals --}}
@include('admin.pendaftaran.modals')
@endsection
