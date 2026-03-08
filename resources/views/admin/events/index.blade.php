@extends('admin.layouts.app')

@section('title', 'Kelola event HIMANIKKA')

@section('content')
<div class="space-y-8">
    {{-- Header --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 lg:gap-8">
        {{-- Main Header --}}
        <div class="flex items-center gap-4">
            <div class="flex-shrink-0 p-3.5 bg-gradient-to-br from-indigo-500 via-purple-600 to-pink-500 rounded-2xl shadow-2xl border border-white/20 hover:border-white/40 active:border-white/60 backdrop-blur-sm hover:shadow-3xl hover:scale-[1.02] transition-all duration-300 group">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 text-white drop-shadow-2xl group-hover:scale-110 transition-transform duration-200">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9.97 9.97 0 00-.933 6.743l-.505 2.124c-.179.795-.793 1.383-1.527 1.383H16.5" />
                </svg>
            </div>
            <div class="min-w-0 flex-1">
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-black leading-tight tracking-tight mb-1.5 bg-gradient-to-r from-slate-900 via-gray-900 to-slate-900 bg-clip-text text-transparent dark:from-slate-100 via-white to-slate-200 drop-shadow-sm">
                    Kelola event
                </h1>
                <p class="text-lg md:text-xl text-gray-600 dark:text-gray-300 font-medium tracking-wide leading-relaxed max-w-2xl">
                    Kelola event HIMANIKKA dengan nama, deskripsi, status, dan dokumen pendukung
                </p>
            </div>
        </div>

        {{-- Filter & Actions --}}
        <div class="flex flex-col sm:flex-row gap-3">
            <!-- Filter Form -->
            <form method="GET" action="{{ route('admin.events.index') }}" class="flex flex-col sm:flex-row items-end gap-3 flex-1">
                <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                    <!-- Search -->
                    <div class="relative flex-1 min-w-0">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.601 10.601z"/>
                        </svg>
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ request('search', '') }}"
                            placeholder="Cari nama event..." 
                            class="w-full pl-11 pr-4 py-3 border border-gray-200 dark:border-gray-700 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 text-sm"
                        >
                    </div>
                    <!-- Status Filter -->
                    <select name="status" class="w-full sm:w-auto px-4 py-3 border border-gray-200 dark:border-gray-700 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 appearance-none">
                        <option value="">Semua Status</option>
                        <option value="segera" {{ request('status') == 'segera' ? 'selected' : '' }}>Segera</option>
                        <option value="belum" {{ request('status') == 'belum' ? 'selected' : '' }}>Sedang</option>
                        <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>
                <!-- Filter Button -->
                <button type="submit" 
                    class="px-8 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold rounded-xl shadow-lg transition-all duration-200 whitespace-nowrap flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.601 10.601z"/>
                    </svg>
                    Filter
                </button>
                @if(request()->hasAny(['search', 'status']))
                    <a href="{{ route('admin.event.index') }}" class="px-6 py-3 text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white font-medium transition-colors rounded-xl hover:bg-gray-100 dark:hover:bg-slate-800/50 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 15L11.25 15m0 0L13.5 15m-2.25 0l-.75 3.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Clear
                    </a>
                @endif
            </form>
            <!-- Add Button -->
            <button @click="openCreateModal()" 
                class="px-8 py-3 bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-700 hover:to-emerald-800 text-white font-semibold rounded-xl shadow-lg transition-all duration-200 flex items-center whitespace-nowrap">
                <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                </svg>
                Tambah event
            </button>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        {{-- Total event --}}
        <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-700 hover:shadow-md transition-all duration-200 group">
            <div class="flex items-center">
                <div class="p-3 bg-gradient-to-r from-slate-500 to-slate-600 rounded-xl shadow-lg group-hover:scale-105 transition-transform duration-200">
                    <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6.5A1.5 1.5 0 017.5 8h9A1.5 1.5 0 0118 6.5v2A1.5 1.5 0 0116.5 10h-9A1.5 1.5 0 016 8.5v-2zM6 13.5A1.5 1.5 0 017.5 12h9A1.5 1.5 0 0118 13.5v2A1.5 1.5 0 0116.5 17h-9A1.5 1.5 0 016 15.5v-2z"/>
                    </svg>
                </div>
                <div class="ml-5">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total event</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ number_format($stats['total_event'] ?? 0) }}</p>
                </div>
            </div>
        </div>

        {{-- Published --}}
        <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-700 hover:shadow-md transition-all duration-200 group">
            <div class="flex items-center">
                <div class="p-3 bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-xl shadow-lg text-white group-hover:scale-105 transition-transform duration-200">
                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="ml-5">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Selesai</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ number_format($stats['selesai_event'] ?? 0) }}</p>
                </div>
            </div>
        </div>

        {{-- Draft --}}
        <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-slate-700 hover:shadow-md transition-all duration-200 group">
            <div class="flex items-center">
                <div class="p-3 bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-xl shadow-lg text-white group-hover:scale-105 transition-transform duration-200">
                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="ml-5">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Segera</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ number_format($stats['segera_event'] ?? 0) }}</p>
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
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider w-64">Nama event</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider w-72">Deskripsi</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider w-32">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider w-40">Tanggal</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider w-32">Waktu</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider w-48">Tempat</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider w-48">Penyelenggara</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider w-40">Gambar</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider w-32">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-slate-700">
                    @forelse($events as $event)
                    <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50 transition-all duration-200 group" data-event-id="{{ $event->id }}" data-event-data="{{ json_encode($event->toArray()) }}">
                        <td class="px-6 py-5">
                            <div class="flex items-center space-x-3">
                                <div class="flex-shrink-0 w-10 h-10 rounded-2xl shadow-lg flex items-center justify-center overflow-hidden group relative">
    @if($event->image)
        <a href="{{ asset('storage/' . $event->image) }}" 
           target="_blank"
           class="w-full h-full bg-cover bg-center bg-no-repeat rounded-2xl transition-all duration-200 group-hover:scale-110 hover:shadow-2xl"
           style="background-image: url('{{ asset('storage/' . $event->image) }}')"
           title="Lihat gambar lengkap">
            <!-- Overlay untuk efek hover -->
            <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
            <svg class="w-5 h-5 text-white/90 opacity-0 group-hover:opacity-100 relative z-10 transition-all duration-200" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.638 19.5 12 19.5s-8.573-3.007-9.963-7.178z"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
        </a>
    @else
        <!-- Fallback icon jika tidak ada gambar -->
        <div class="w-full h-full bg-gradient-to-br from-gray-400 to-gray-500 flex items-center justify-center">
            <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5a1 1 0 01-1-1v-1.5a3.375 3.375 0 00-3.375-3.375H8"/>
            </svg>
        </div>
    @endif
</div>

                                <div class="min-w-0 flex-1">
                                    <div class="font-semibold text-gray-900 dark:text-white truncate max-w-md group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">{{ $event->name }}</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">{{ $event->created_at?->format('d M Y • H:i') ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <p class="text-sm text-gray-900 dark:text-gray-100 max-w-xs truncate line-clamp-2" title="{{ $event->description }}">{{ $event->description }}</p>
                        </td>
                        <td class="px-6 py-5">
                            @php
                                $statusConfig = [
                                    'segera' => ['label' => 'Segera', 'color' => 'red'],
                                    'belum' => ['label' => 'Sedang', 'color' => 'yellow'],
                                    'selesai' => ['label' => 'Selesai', 'color' => 'green'],
                                ];
                                $status = $statusConfig[$event->status] ?? ['label' => 'Unknown', 'color' => 'gray'];
                            @endphp
                            <span class="inline-flex px-3 py-1 bg-{{ $status['color'] }}-100 dark:bg-{{ $status['color'] }}-900/30 text-{{ $status['color'] }}-800 dark:text-{{ $status['color'] }}-200 border border-{{ $status['color'] }}-200 dark:border-{{ $status['color'] }}-800 rounded-full text-xs font-semibold shadow-sm">
                                {{ $status['label'] }}
                            </span>
                        </td>
                        <td class="px-6 py-5">
                            <p class="text-sm text-gray-900 dark:text-gray-100 font-mono">{{ $event->tanggal?->format('d M Y') ?? 'N/A' }}</p>
                        </td>
                        <td class="px-6 py-5">
                            <p class="text-sm text-gray-900 dark:text-gray-100 font-mono">{{ $event->waktu?->format('H:i') ?? 'N/A' }}</p>
                        </td>
                        <td class="px-6 py-5">
                            <p class="text-sm text-gray-900 dark:text-gray-100 max-w-xs truncate" title="{{ $event->tempat }}">{{ \Illuminate\Support\Str::limit($event->tempat ?? 'N/A', 30) }}</p>
                        </td>
                        <td class="px-6 py-5">
                            <p class="text-sm text-gray-900 dark:text-gray-100 max-w-xs truncate font-medium" title="{{ $event->user?->name ?? 'N/A' }}">{{ $event->user?->name ?? 'N/A' }}</p>
                        </td>
                        <td class="px-6 py-5">
                            @if($event->image)
<div class="flex items-center justify-center">
    <a href="{{ asset('storage/' . $event->image) }}" target="_blank" 
        class="inline-flex items-center p-2 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white text-xs font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 hover:scale-105"
        title="Lihat Gambar">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.638 19.5 12 19.5s-8.573-3.007-9.963-7.178z"/>
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
        </svg>
    </a>
</div>
@endif

                        </td>
                        <td class="px-6 py-5 text-center">
                            <div class="flex items-center justify-center gap-1">
                                <!-- Edit Button -->
                                <button onclick="openEditModalFromRow(this)"
                                    class="p-2.5 text-emerald-600 hover:text-emerald-800 hover:bg-emerald-100 dark:text-emerald-400 dark:hover:text-emerald-300 dark:hover:bg-emerald-900/30 rounded-xl transition-all duration-200 shadow-sm hover:shadow-md hover:scale-105"
                                    title="Edit event">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M16.862 4.487L19.5 7.125"/>
                                    </svg>
                                </button>
                                <!-- Delete Button -->
                                <button onclick="openDeleteModal({{ $event->id }}, @json($event->name))"
                                    class="p-2.5 text-red-600 hover:text-red-800 hover:bg-red-100 dark:text-red-400 dark:hover:text-red-300 dark:hover:bg-red-900/30 rounded-xl transition-all duration-200 shadow-sm hover:shadow-md hover:scale-105"
                                    title="Hapus event">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="px-6 py-20 text-center">
                            <div class="max-w-md mx-auto text-gray-500 dark:text-gray-400">
                                <div class="w-24 h-24 bg-gradient-to-br from-slate-100 to-slate-200 dark:from-slate-800 dark:to-slate-900 rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                                    <svg class="w-12 h-12 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75l3 3m0 0l3-3m-3 3v-7.5M8.25 21h7.5"/>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold mb-2 text-gray-900 dark:text-white">Belum ada event</h3>
                                <p class="text-lg mb-8">Mulai dengan menambahkan event HIMANIKKA pertama Anda</p>
                                <button @click="openCreateModal()" 
                                    class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-700 hover:to-emerald-800 text-white font-semibold rounded-xl shadow-lg transition-all duration-200">
                                    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                                    </svg>
                                    Tambah event Pertama
                                </button>
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
@include('admin.events.modals')
@endsection
