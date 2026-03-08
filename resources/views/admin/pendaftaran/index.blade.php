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
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Keterangan</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider w-32">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider w-40">Dokumen</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider w-32">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-slate-700">
                    @forelse($pendaftarans as $pendaftaran)
                    <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50 transition-all duration-200 group"
                        data-modal-toggle="pendaftaran-modal-{{ $pendaftaran->id }}">
                        <input type="hidden" name="id" value="{{ $pendaftaran->id }}">

                        {{-- Pendaftar --}}
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
    <div class="flex items-center space-x-3">
        {{-- Avatar --}}
        @if($pendaftaran->image)
            <img src="{{ asset('storage/' . $pendaftaran->image) }}" 
                 alt="{{ $pendaftaran->name }}" 
                 class="w-12 h-12 object-cover rounded-2xl shadow-lg ring-2 ring-white/50 hover:ring-white/80 transition-all duration-200"
                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
        @endif
        
        {{-- Default Avatar --}}
        <div class="flex-shrink-0 w-12 h-12 {{ $pendaftaran->image ? 'hidden' : '' }} bg-gradient-to-br from-emerald-500 to-blue-600 rounded-2xl shadow-lg flex items-center justify-center hover:scale-105 transition-all duration-200">
            <svg class="w-6 h-6 text-white" fill="none" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.93 17.93 0 0112 21.75a17.93 17.93 0 01-2.499-.118z"/>
            </svg>
        </div>
        
        {{-- Name --}}
        <div class="min-w-0 flex-1">
            <span class="font-bold text-gray-900 dark:text-white text-base truncate hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                {{ $pendaftaran->name }}
            </span>
            <p class="text-sm text-gray-500 dark:text-gray-400 truncate">{{ $pendaftaran->created_at }}</p>
        </div>
    </div>
</td>


                        {{-- Kontak --}}
                        <td class="px-6 py-5">
                            @if ($pendaftaran->email)
                                <span class="text-sm text-gray-900 dark:text-white">{{ $pendaftaran->phone }}</span>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $pendaftaran->email }}</p>
                            @endif
                        </td>

                        {{-- Referensi --}}
                        <td class="px-6 py-5">
    @if($pendaftaran->acara_id && $pendaftaran->acara)
        {{-- ACARA - Prioritas 1 --}}
        <div class="space-y-1">
            <div class="flex items-center gap-2">
                <div class="w-2 h-2 bg-purple-500 rounded-full"></div>
                <span class="font-semibold text-gray-900 dark:text-white text-sm truncate max-w-xs">🎭 {{ $pendaftaran->acara->name }}</span>
            </div>
            @if($pendaftaran->acara->tanggal)
                <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ \Illuminate\Support\Carbon::parse($pendaftaran->acara->tanggal)->format('d M Y') }}</p>
            @endif
        </div>
    @elseif($pendaftaran->kegiatan_id && $pendaftaran->kegiatan)
        {{-- KEGIATAN - Prioritas 2 --}}
        <div class="space-y-1">
            <div class="flex items-center gap-2">
                <div class="w-2 h-2 bg-indigo-500 rounded-full"></div>
                <span class="font-semibold text-indigo-600 dark:text-indigo-400 text-sm truncate max-w-xs">🔧 {{ $pendaftaran->kegiatan->name }}</span>
            </div>
            @if($pendaftaran->kegiatan->tanggal)
                <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ \Illuminate\Support\Carbon::parse($pendaftaran->kegiatan->tanggal)->format('d M Y') }}</p>
            @endif
        </div>
    @elseif($pendaftaran->event_id && $pendaftaran->event)
        {{-- EVENT - Prioritas 3 --}}
        <div class="space-y-1">
            <div class="flex items-center gap-2">
                <div class="w-2 h-2 bg-emerald-500 rounded-full"></div>
                <span class="font-semibold text-emerald-600 dark:text-emerald-400 text-sm truncate max-w-xs">🎉 {{ $pendaftaran->event->name }}</span>
            </div>
            @if($pendaftaran->event->tanggal)
                <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ \Illuminate\Support\Carbon::parse($pendaftaran->event->tanggal)->format('d M Y') }}</p>
            @endif
        </div>
    @else
        {{-- Pendaftaran Umum --}}
        <div class="flex items-center gap-2 text-gray-400 dark:text-gray-500 italic text-sm">
            <svg class="w-4 h-4" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Pendaftaran Umum
        </div>
    @endif
</td>

<td class="px-6 py-5">
    @if ($pendaftaran->keterangan)
        <span class="text-sm text-gray-900 dark:text-white">{{ $pendaftaran->keterangan }}</span>
    @endif
</td>


                        {{-- Status --}}
                        <td class="px-5 py-5 items-center">
                            @if ($pendaftaran->status_label)
                                <span class="text-sm text-gray-900 dark:text-gray-100 font-mono">
                                    {{ $pendaftaran->status_label }}
                                </span>
                            @endif
                        </td>

                        {{-- Dokumen --}}
                        <td class="px-6 py-5">
    @if($pendaftaran->bukti)
        <div class="flex items-center gap-2">
            {{-- View Button --}}
            <a href="{{ asset('storage/' . $pendaftaran->bukti) }}" 
               target="_blank" 
               class="p-2.5 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white rounded-xl shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-200 tooltip"
               title="Lihat Dokumen">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
  <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
  <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z" clip-rule="evenodd" />
</svg>

            </a>

            {{-- Download Button --}}
            <a href="{{ asset('storage/' . $pendaftaran->bukti) }}" 
               download 
               class="p-2.5 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white rounded-xl shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-200 tooltip"
               title="Download Dokumen">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
  <path d="M3.375 3C2.339 3 1.5 3.84 1.5 4.875v.75c0 1.036.84 1.875 1.875 1.875h17.25c1.035 0 1.875-.84 1.875-1.875v-.75C22.5 3.839 21.66 3 20.625 3H3.375Z" />
  <path fill-rule="evenodd" d="m3.087 9 .54 9.176A3 3 0 0 0 6.62 21h10.757a3 3 0 0 0 2.995-2.824L20.913 9H3.087ZM12 10.5a.75.75 0 0 1 .75.75v4.94l1.72-1.72a.75.75 0 1 1 1.06 1.06l-3 3a.75.75 0 0 1-1.06 0l-3-3a.75.75 0 1 1 1.06-1.06l1.72 1.72v-4.94a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
</svg>

            </a>
        </div>
    @else
        <div class="flex items-center gap-1 px-3 py-2 bg-gray-100 dark:bg-gray-900/50 text-gray-500 dark:text-gray-400 text-xs font-medium rounded-xl">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
  <path d="M3.375 3C2.339 3 1.5 3.84 1.5 4.875v.75c0 1.036.84 1.875 1.875 1.875h17.25c1.035 0 1.875-.84 1.875-1.875v-.75C22.5 3.839 21.66 3 20.625 3H3.375Z" />
  <path fill-rule="evenodd" d="m3.087 9 .54 9.176A3 3 0 0 0 6.62 21h10.757a3 3 0 0 0 2.995-2.824L20.913 9H3.087ZM12 10.5a.75.75 0 0 1 .75.75v4.94l1.72-1.72a.75.75 0 1 1 1.06 1.06l-3 3a.75.75 0 0 1-1.06 0l-3-3a.75.75 0 1 1 1.06-1.06l1.72 1.72v-4.94a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
</svg>

            Tidak ada bukti
        </div>
    @endif
</td>


                        {{-- Aksi --}}
                        <td class="px-6 py-5 text-center">
                            <div class="flex items-center justify-center gap-1">
                                <button onclick="openEditPendaftaranModal({{$pendaftaran->id}})"
                                        class="p-2.5 text-emerald-600 hover:text-emerald-800 hover:bg-emerald-100 dark:text-emerald-400 dark:hover:text-emerald-300 dark:hover:bg-emerald-900/30 rounded-xl transition-all duration-200 shadow-sm hover:shadow-md hover:scale-105"
                                        title="Edit Pendaftaran">
                                   <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
  <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
  <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
</svg>

                                </button>
                                <button onclick="openDeletePendaftaranModal({{ $pendaftaran->id }}, '{{ addslashes($pendaftaran->name) }}')"
        class="p-2.5 text-red-600 hover:text-red-800 hover:bg-red-100 dark:text-red-400 dark:hover:text-red-300 dark:hover:bg-red-900/30 rounded-xl transition-all duration-200 shadow-sm hover:shadow-md hover:scale-105"
        title="Hapus Pendaftaran">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
  <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
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
    </div>
</div>

{{-- Modals --}}
@include('admin.pendaftaran.modals')
@endsection
