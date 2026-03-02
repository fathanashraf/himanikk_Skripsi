@extends('admin.layouts.app')

@section('title', 'Kelola Masukkan')

@section('content')
<div class="space-y-8">
    {{-- Header --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 lg:gap-8">
        {{-- Main Header --}}
        <div class="flex items-center gap-4">
            <div class="flex-shrink-0 p-3.5 bg-gradient-to-br from-purple-500 via-pink-500 to-orange-500 rounded-2xl shadow-2xl border border-white/20 hover:border-white/40 active:border-white/60 backdrop-blur-sm hover:shadow-3xl hover:scale-[1.02] transition-all duration-300 group">
                <!-- Heroicon: Chat Bubble Left Right -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 text-white drop-shadow-2xl group-hover:scale-110 transition-transform duration-200">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h9.75m-9.75 5.25H18M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>
                </svg>
            </div>
            <div class="min-w-0 flex-1">
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-black leading-tight tracking-tight mb-1.5 bg-gradient-to-r from-slate-900 via-gray-900 to-slate-900 bg-clip-text text-transparent dark:from-slate-100 via-white to-slate-200 drop-shadow-sm">
                    Kelola Masukkan
                </h1>
                <p class="text-lg md:text-xl text-gray-600 dark:text-gray-300 font-medium tracking-wide leading-relaxed max-w-2xl">
                    Kelola kritik, saran, like, dan dislike dari pengguna HIMANIKKA
                </p>
            </div>
        </div>

        {{-- Filter & Actions --}}
        <div class="flex flex-col sm:flex-row gap-3">
            <form method="GET" action="{{ route('admin.masukan.index') }}" class="flex flex-col sm:flex-row items-end gap-3 flex-1">
                <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                    <!-- Search -->
                    <div class="relative flex-1 min-w-0">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400 pointer-events-none" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.601 10.601z"/>
                        </svg>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama pengguna..." class="w-full pl-11 pr-4 py-3 border border-gray-200 dark:border-gray-700 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 text-sm">
                    </div>
                    <!-- Tipe Filter -->
                    <select name="tipe" class="w-full sm:w-auto px-4 py-3 border border-gray-200 dark:border-gray-700 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 appearance-none relative">
                        <option value="">Semua Tipe</option>
                        <option value="kritik" {{ request('tipe') == 'kritik' ? 'selected' : '' }}>Kritik</option>
                        <option value="saran" {{ request('tipe') == 'saran' ? 'selected' : '' }}>Saran</option>
                        <option value="like" {{ request('tipe') == 'like' ? 'selected' : '' }}>Like</option>
                        <option value="dislike" {{ request('tipe') == 'dislike' ? 'selected' : '' }}>Dislike</option>
                        <svg class="absolute right-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400 pointer-events-none" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                        </svg>
                    </select>
                </div>
                <button type="submit" class="px-8 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold rounded-xl shadow-lg transition-all duration-200 whitespace-nowrap flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.601 10.601z"/>
                    </svg>
                    Filter
                </button>
                @if(request()->hasAny(['search', 'tipe']))
                    <a href="{{ route('admin.masukan.index') }}" class="px-6 py-3 text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white font-medium transition-colors rounded-xl hover:bg-gray-100 dark:hover:bg-slate-800/50 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 15L11.25 15m0 0L13.5 15m-2.25 0l-.75 3.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Clear
                    </a>
                @endif
            </form>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
        {{-- Total --}}
        <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-700 hover:shadow-md transition-all duration-200 group">
            <div class="flex items-center">
                <div class="p-3 bg-gradient-to-r from-slate-500 to-slate-600 rounded-xl shadow-lg group-hover:scale-105 transition-transform duration-200">
                    <svg class="w-7 h-7 text-white" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6.5A1.5 1.5 0 017.5 8h9A1.5 1.5 0 0118 6.5v2A1.5 1.5 0 0116.5 10h-9A1.5 1.5 0 016 8.5v-2zM6 13.5A1.5 1.5 0 017.5 12h9A1.5 1.5 0 0118 13.5v2A1.5 1.5 0 0116.5 17h-9A1.5 1.5 0 016 15.5v-2z"/>
                    </svg>
                </div>
                <div class="ml-5">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Masukkan</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ number_format($stats['total']) }}</p>
                </div>
            </div>
        </div>

        {{-- Kritik --}}
        <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-700 hover:shadow-md transition-all duration-200 group">
            <div class="flex items-center">
                <div class="p-3 bg-gradient-to-r from-red-500 to-red-600 rounded-xl shadow-lg group-hover:scale-105 transition-transform duration-200">
                    <svg class="w-7 h-7 text-white" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126z"/>
                    </svg>
                </div>
                <div class="ml-5">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Kritik</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ number_format($stats['kritik']) }}</p>
                </div>
            </div>
        </div>

        {{-- Saran --}}
        <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-700 hover:shadow-md transition-all duration-200 group">
            <div class="flex items-center">
                <div class="p-3 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl shadow-lg group-hover:scale-105 transition-transform duration-200">
                    <svg class="w-7 h-7 text-white" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.53 16.122a3 3 0 00-5.78 1.128 2.25 2.25 0 01-2.4 2.245 4.5 4.5 0 008.4-.862c-.992-2.558-1.35-2.45-1.22-2.511z"/>
                    </svg>
                </div>
                <div class="ml-5">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Saran</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ number_format($stats['saran']) }}</p>
                </div>
            </div>
        </div>

        {{-- Like --}}
        <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-700 hover:shadow-md transition-all duration-200 group">
            <div class="flex items-center">
                <div class="p-3 bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-xl shadow-lg group-hover:scale-105 transition-transform duration-200">
                    <svg class="w-7 h-7 text-white" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                </div>
                <div class="ml-5">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Like</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ number_format($stats['like']) }}</p>
                </div>
            </div>
        </div>

        {{-- Dislike --}}
        <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-700 hover:shadow-md transition-all duration-200 group">
            <div class="flex items-center">
                <div class="p-3 bg-gradient-to-r from-amber-500 to-amber-600 rounded-xl shadow-lg group-hover:scale-105 transition-transform duration-200">
                    <svg class="w-7 h-7 text-white" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.682 9.318a4.5 4.5 0 00-6.364 0L12 16.364l-1.318-1.318a4.5 4.5 0 00-6.364 0"/>
                    </svg>
                </div>
                <div class="ml-5">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Dislike</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ number_format($stats['dislike']) }}</p>
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
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Pengguna</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider w-32">Tipe</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider w-40">Tanggal</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider w-32">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-slate-700">
                    @forelse($masukkans as $masukkan)
                    <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50 transition-all duration-200 group" data-masukkan-id="{{ $masukkan->id }}" data-masukkan-data="{{ json_encode($masukkan) }}">
                        <td class="px-6 py-5">
                            <div class="flex items-center space-x-3">
                                <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl shadow-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.93 17.93 0 0112 21.75a17.93 17.93 0 01-2.499-.118z"/>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-900 dark:text-white truncate max-w-md group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                                        {{ $masukkan->user->name ?? 'Pengguna Terhapus' }}
                                    </div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">{{ $masukkan->user->email ?? '-' }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <span class="inline-flex px-4 py-2 {{ $masukkan->tipe_color }} border rounded-full text-sm font-semibold shadow-sm">
                                {{ $masukkan->tipe_label }}
                            </span>
                        </td>
                        <td class="px-6 py-5">
                            <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $masukkan->created_at->format('d M Y') }}</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">{{ $masukkan->created_at->format('H:i') }}</div>
                        </td>
                        <td class="px-6 py-5 text-center">
                            <div class="flex items-center justify-center gap-1">
                                <!-- Edit Button -->
                                <button onclick="openEditModalFromRow(this)"
                                    class="p-2.5 text-emerald-600 hover:text-emerald-800 hover:bg-emerald-100 dark:text-emerald-400 dark:hover:text-emerald-300 dark:hover:bg-emerald-900/30 rounded-xl transition-all duration-200 shadow-sm hover:shadow-md hover:scale-105"
                                    title="Edit Masukkan">
                                    <svg class="w-4 h-4" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M16.862 4.487L19.5 7.125"/>
                                    </svg>
                                </button>
                                <!-- Delete Button -->
                                <button onclick="openDeleteModal({{ $masukkan->id }}, '{{ addslashes($masukkan->user->name ?? "Masukkan") }}')"
                                    class="p-2.5 text-red-600 hover:text-red-800 hover:bg-red-100 dark:text-red-400 dark:hover:text-red-300 dark:hover:bg-red-900/30 rounded-xl transition-all duration-200 shadow-sm hover:shadow-md hover:scale-105"
                                    title="Hapus Masukkan">
                                    <svg class="w-4 h-4" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-20 text-center">
                            <div class="max-w-md mx-auto text-gray-500 dark:text-gray-400">
                                <div class="w-24 h-24 bg-gradient-to-br from-slate-100 to-slate-200 dark:from-slate-800 dark:to-slate-900 rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                                    <svg class="w-12 h-12 text-slate-400" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75"/>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold mb-2 text-gray-900 dark:text-white">Belum ada masukkan</h3>
                                <p class="text-lg mb-8">Belum ada kritik, saran, like, atau dislike dari pengguna</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{-- Pagination --}}
        @if($masukkans->hasPages())
        <div class="px-6 py-6 bg-gradient-to-r from-slate-50 to-slate-100 dark:from-slate-800/60 dark:to-slate-900/60 border-t border-gray-200 dark:border-slate-700">
            {{ $masukkans->appends(request()->query())->links('vendor.pagination.tailwind') }}
        </div>
        @endif
    </div>
</div>

{{-- Modals --}}
@include('admin.masukan.modals')
@endsection
