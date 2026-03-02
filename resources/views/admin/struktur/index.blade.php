@extends('admin.layouts.app')

@section('title', 'Struktur Pengurus HIMANIKKA')

@section('content')
<!-- Header Section -->
<div class="mb-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-4xl font-bold bg-gradient-to-r from-slate-900 to-slate-700 bg-clip-text text-transparent dark:from-slate-100 dark:to-slate-300 mb-2">
                Struktur Pengurus
            </h1>
            <p class="text-slate-600 dark:text-slate-400 text-lg">Kelola struktur organisasi HIMANIKKA periode saat ini</p>
        </div>
        <button onclick="openCreateModal()" 
                class="px-8 py-4 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white font-semibold rounded-xl 
                       shadow-lg hover:shadow-xl hover:-translate-y-0.5 hover:from-emerald-600 hover:to-emerald-700 
                       transition-all duration-300 flex items-center gap-3 whitespace-nowrap">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Tambah Pengurus
        </button>
    </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl rounded-3xl p-8 border border-slate-200/50 dark:border-slate-700/50 shadow-2xl hover:shadow-3xl transition-all duration-300 hover:-translate-y-1">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-slate-600 dark:text-slate-400 uppercase tracking-wide">Total Pengurus</p>
                <p class="text-3xl font-bold bg-gradient-to-r from-emerald-500 to-emerald-600 bg-clip-text text-transparent mt-1">
                    {{ $strukturs->count() }}
                </p>
            </div>
            <div class="p-4 bg-emerald-100 dark:bg-emerald-900/20 rounded-2xl">
                <svg class="w-8 h-8 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
        </div>
    </div>
    
    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl rounded-3xl p-8 border border-slate-200/50 dark:border-slate-700/50 shadow-2xl hover:shadow-3xl transition-all duration-300 hover:-translate-y-1">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-slate-600 dark:text-slate-400 uppercase tracking-wide">Ketua Umum</p>
                <p class="text-3xl font-bold bg-gradient-to-r from-purple-500 to-purple-600 bg-clip-text text-transparent mt-1">
                    {{ $strukturs->where('jabatan', 'kahim')->count() }}
                </p>
            </div>
            <div class="p-4 bg-purple-100 dark:bg-purple-900/20 rounded-2xl">
                <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
        </div>
    </div>
    
    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl rounded-3xl p-8 border border-slate-200/50 dark:border-slate-700/50 shadow-2xl hover:shadow-3xl transition-all duration-300 hover:-translate-y-1">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-slate-600 dark:text-slate-400 uppercase tracking-wide">Departemen</p>
                <p class="text-3xl font-bold bg-gradient-to-r from-amber-500 to-amber-600 bg-clip-text text-transparent mt-1">
                    {{ $strukturs->whereNotNull('departemen')->unique('departemen')->count() }}
                </p>
            </div>
            <div class="p-4 bg-amber-100 dark:bg-amber-900/20 rounded-2xl">
                <svg class="w-8 h-8 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
            </div>
        </div>
    </div>
    
    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl rounded-3xl p-8 border border-slate-200/50 dark:border-slate-700/50 shadow-2xl hover:shadow-3xl transition-all duration-300 hover:-translate-y-1">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-slate-600 dark:text-slate-400 uppercase tracking-wide">Foto Profil</p>
                <p class="text-3xl font-bold bg-gradient-to-r from-blue-500 to-blue-600 bg-clip-text text-transparent mt-1">
                    {{ $strukturs->whereNotNull('avatar')->count() }}
                </p>
            </div>
            <div class="p-4 bg-blue-100 dark:bg-blue-900/20 rounded-2xl">
                <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl rounded-3xl border border-slate-200/50 dark:border-slate-700/50 shadow-2xl overflow-hidden">
    <!-- Table Header -->
    <div class="px-8 py-6 border-b border-slate-200/50 dark:border-slate-700/50 bg-gradient-to-r from-slate-50/50 to-slate-100/50 dark:from-slate-900/30 dark:to-slate-800/30">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-bold text-slate-900 dark:text-white">Daftar Pengurus HIMANIKKA</h2>
            <div class="flex items-center gap-2">
                <div class="flex items-center gap-1 text-sm text-slate-500 dark:text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ $strukturs->count() }} pengurus
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b border-slate-200/50 dark:border-slate-700/50">
                    <th class="px-8 py-6 text-left text-sm font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Foto</th>
                    <th class="px-8 py-6 text-left text-sm font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Pengurus</th>
                    <th class="px-8 py-6 text-left text-sm font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider hidden md:table-cell">Jabatan</th>
                    <th class="px-8 py-6 text-left text-sm font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider hidden lg:table-cell">Posisi</th>
                    <th class="px-8 py-6 text-left text-sm font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider hidden xl:table-cell">Departemen</th>
                    <th class="px-8 py-6 text-right text-sm font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200/50 dark:divide-slate-700/50">
                @forelse($strukturs as $struktur)
                <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-all duration-200 group"
                    data-struktur-id="{{ $struktur->id }}"
                    data-struktur-data='{{ json_encode([
                        "user_id" => $struktur->user_id,
                        "jabatan" => $struktur->jabatan,
                        "posisi" => $struktur->posisi,
                        "departemen" => $struktur->departemen,
                        "avatar" => $struktur->avatar
                    ]) }}'>
                    
                    <!-- Avatar -->
                    <td class="px-8 py-6">
                        <div class="w-12 h-12 rounded-2xl overflow-hidden bg-gradient-to-br from-slate-100 to-slate-200 dark:from-slate-700 dark:to-slate-800 shadow-lg group-hover:shadow-xl transition-all duration-200">
                            @if($struktur->avatar)
                                <img src="{{ asset('storage/' . $struktur->avatar) }}" 
                                     alt="{{ $struktur->user->name }}" 
                                     class="w-full h-full object-cover">
                            @elseif($struktur->user->avatar)
                                <img src="{{ asset('storage/' . $struktur->user->avatar) }}" 
                                     alt="{{ $struktur->user->name }}" 
                                     class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-slate-200 to-slate-300 dark:from-slate-600 dark:to-slate-700">
                                    <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>
                    </td>

                    <!-- Name & Email -->
                    <td class="px-8 py-6 max-w-md">
                        <div>
                            <h3 class="font-semibold text-slate-900 dark:text-white text-lg group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors duration-200">
                                {{ $struktur->user->name }}
                            </h3>
                            <p class="text-sm text-slate-500 dark:text-slate-400 truncate max-w-[250px]">{{ $struktur->user->email }}</p>
                        </div>
                    </td>

                    <!-- Jabatan Badge -->
                    <td class="px-8 py-6 hidden md:table-cell">
                        @php
                            $jabatanLabels = [
                                'kahim' => ['KAHIM', 'bg-gradient-to-r from-purple-500 to-purple-700 text-white px-4 py-2 rounded-full shadow-lg'],
                                'wakahim' => ['WAKAHIM', 'bg-gradient-to-r from-indigo-500 to-indigo-700 text-white px-4 py-2 rounded-full shadow-lg'],
                                'sekretaris' => ['Sekretaris', 'bg-gradient-to-r from-emerald-500 to-emerald-700 text-white px-4 py-2 rounded-full shadow-lg'],
                                'bendahara' => ['Bendahara', 'bg-gradient-to-r from-amber-500 to-amber-700 text-white px-4 py-2 rounded-full shadow-lg']
                            ];
                            $jabatan = $jabatanLabels[$struktur->jabatan] ?? ['Jabatan', 'bg-slate-500 text-white px-4 py-2 rounded-full shadow-lg'];
                        @endphp
                        <span class="inline-flex text-sm font-semibold tracking-wide {{ $jabatan[1] }}">
                            {{ $jabatan[0] }}
                        </span>
                    </td>

                    <!-- Posisi -->
                    <td class="px-8 py-6 hidden lg:table-cell">
                        @if($struktur->posisi)
                            <span class="inline-flex px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white text-sm font-semibold rounded-full shadow-lg">
                                {{ ucfirst(str_replace('koordinator', 'Koordinator', $struktur->posisi)) }}
                            </span>
                        @else
                            <span class="px-4 py-2 bg-slate-100 dark:bg-slate-700 text-slate-500 dark:text-slate-400 text-sm font-medium rounded-full">—</span>
                        @endif
                    </td>

                    <!-- Departemen -->
                    <td class="px-8 py-6 hidden xl:table-cell">
                        @if($struktur->departemen)
                            @php
                                $deptLabels = [
                                    'kwu' => 'KWU',
                                    'minatbakat' => 'Minat Bakat',
                                    'pemberdaya_wanita' => 'Pemberdaya Wanita',
                                    'humas' => 'Humas'
                                ];
                            @endphp
                            <span class="inline-flex px-4 py-2 bg-gradient-to-r from-orange-500 to-orange-600 text-white text-sm font-semibold rounded-full shadow-lg">
                                {{ $deptLabels[$struktur->departemen] ?? ucwords(str_replace('_', ' ', $struktur->departemen)) }}
                            </span>
                        @else
                            <span class="px-4 py-2 bg-slate-100 dark:bg-slate-700 text-slate-500 dark:text-slate-400 text-sm font-medium rounded-full">—</span>
                        @endif
                    </td>

                    <!-- Actions - FIXED ✅ -->
                    <td class="px-8 py-6 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <button onclick="openEditModalFromRow(this)"
                                    class="p-3 text-emerald-600 hover:text-emerald-700 hover:bg-emerald-50 dark:hover:bg-emerald-900/20 rounded-2xl transition-all duration-200 shadow-md hover:shadow-lg group/edit"
                                    title="Edit Pengurus">
                                <svg class="w-5 h-5 group-hover/edit:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.5h3m1 0H21.5V8.5h-8.5V21.5z"/>
                                </svg>
                            </button>
                            <button onclick="openDeleteModal({{ $struktur->id }}, '{{ addslashes($struktur->user->name) }}')"
                                    class="p-3 text-red-600 hover:text-red-700 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-2xl transition-all duration-200 shadow-md hover:shadow-lg group/delete"
                                    title="Hapus Pengurus">
                                <svg class="w-5 h-5 group-hover/delete:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-8 py-20 text-center">
                        <div class="flex flex-col items-center gap-4">
                            <div class="w-24 h-24 bg-gradient-to-br from-slate-100 to-slate-200 dark:from-slate-700 dark:to-slate-800 rounded-3xl flex items-center justify-center shadow-xl">
                                <svg class="w-12 h-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">Belum ada pengurus</h3>
                                <p class="text-slate-600 dark:text-slate-400 max-w-md mx-auto">Tambahkan pengurus pertama untuk struktur organisasi HIMANIKKA Anda.</p>
                            </div>
                            <button onclick="openCreateModal()" 
                                    class="px-8 py-3 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white font-semibold rounded-xl 
                                           shadow-lg hover:shadow-xl hover:-translate-y-0.5 hover:from-emerald-600 hover:to-emerald-700 
                                           transition-all duration-300">
                                Tambah Pengurus Pertama
                            </button>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@include('admin.struktur.modal')
@endsection
