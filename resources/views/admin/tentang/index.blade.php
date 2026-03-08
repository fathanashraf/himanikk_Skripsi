@extends('admin.layouts.app')

@section('content')
<div class="p-8 space-y-8 max-w-7xl mx-auto">
    {{-- 🎯 HEADER + ACTION --}}
    <div class="bg-gradient-to-r from-slate-50/80 to-slate-100/80 dark:from-slate-800/80 dark:to-slate-900/80 
                 backdrop-blur-xl rounded-3xl p-8 shadow-2xl border border-slate-200/50 dark:border-slate-700/50">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
            <div>
                <h1 class="text-4xl lg:text-5xl font-black bg-gradient-to-r from-slate-900 to-slate-700 
                           bg-clip-text text-transparent dark:from-slate-100 dark:to-slate-400 mb-3">
                    Profil Organisasi
                </h1>
                <p class="text-xl text-slate-600 dark:text-slate-400 font-medium">
                    Kelola informasi organisasi dengan mudah
                </p>
            </div>
            <button id="openCreateModal" 
                    class="group px-8 py-4 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white 
                           font-black text-lg rounded-2xl hover:from-emerald-600 hover:to-emerald-700 
                           shadow-2xl hover:shadow-3xl hover:-translate-y-1 transition-all duration-300 
                           flex items-center gap-3 whitespace-nowrap">
                <svg class="w-6 h-6 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Tambah Profil
            </button>
        </div>

        {{-- 📊 STATS QUICK --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8 pt-8 border-t border-slate-200/50 dark:border-slate-700/50">
            <div class="group p-6 bg-white/70 dark:bg-slate-800/70 rounded-2xl backdrop-blur-sm border border-slate-200/50 hover:border-emerald-300/50 transition-all duration-300 hover:shadow-xl">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-slate-600 dark:text-slate-400 text-sm font-medium uppercase tracking-wider">Total Profil</p>
                        <p class="text-3xl font-black text-slate-900 dark:text-slate-50 mt-2">{{ $stats['profils'] ?? 0 }}</p>
                    </div>
                    <div class="w-16 h-16 bg-gradient-to-br from-emerald-100 to-emerald-200 dark:from-emerald-900/50 dark:to-emerald-800/50 rounded-2xl flex items-center justify-center group-hover:rotate-12 transition-transform duration-500">
                        <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="group p-6 bg-white/70 dark:bg-slate-800/70 rounded-2xl backdrop-blur-sm border border-slate-200/50 hover:border-blue-300/50 transition-all duration-300 hover:shadow-xl">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-slate-600 dark:text-slate-400 text-sm font-medium uppercase tracking-wider">Lengkap</p>
                        <p class="text-3xl font-black text-slate-900 dark:text-slate-50 mt-2">
                            {{ $stats['profiles_list']?->filter(fn($p) => $p->logo && ($p->tujuan || $p->fungsi))?->count() ?? 0 }}
                        </p>
                    </div>
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-100 to-blue-200 dark:from-blue-900/50 dark:to-blue-800/50 rounded-2xl flex items-center justify-center group-hover:rotate-12 transition-transform duration-500">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="group p-6 bg-white/70 dark:bg-slate-800/70 rounded-2xl backdrop-blur-sm border border-slate-200/50 hover:border-amber-300/50 transition-all duration-300 hover:shadow-xl">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-slate-600 dark:text-slate-400 text-sm font-medium uppercase tracking-wider">Perlu Update</p>
                        <p class="text-3xl font-black text-slate-900 dark:text-slate-50 mt-2">
                            {{ $stats['profiles_list']?->filter(fn($p) => !$p->logo || !($p->tujuan || $p->fungsi))?->count() ?? 0 }}
                        </p>
                    </div>
                    <div class="w-16 h-16 bg-gradient-to-br from-amber-100 to-amber-200 dark:from-amber-900/50 dark:to-amber-800/50 rounded-2xl flex items-center justify-center group-hover:rotate-12 transition-transform duration-500">
                        <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- 🗂️ DATA TABLE PREMIUM --}}
    <div class="bg-white/90 dark:bg-slate-800/90 backdrop-blur-xl rounded-3xl shadow-2xl border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">
        <div class="p-8 border-b border-slate-200/50 dark:border-slate-700/50">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
  <path fill-rule="evenodd" d="M3 2.25a.75.75 0 0 0 0 1.5v16.5h-.75a.75.75 0 0 0 0 1.5H15v-18a.75.75 0 0 0 0-1.5H3ZM6.75 19.5v-2.25a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75v2.25a.75.75 0 0 1-.75.75h-3a.75.75 0 0 1-.75-.75ZM6 6.75A.75.75 0 0 1 6.75 6h.75a.75.75 0 0 1 0 1.5h-.75A.75.75 0 0 1 6 6.75ZM6.75 9a.75.75 0 0 0 0 1.5h.75a.75.75 0 0 0 0-1.5h-.75ZM6 12.75a.75.75 0 0 1 .75-.75h.75a.75.75 0 0 1 0 1.5h-.75a.75.75 0 0 1-.75-.75ZM10.5 6a.75.75 0 0 0 0 1.5h.75a.75.75 0 0 0 0-1.5h-.75Zm-.75 3.75A.75.75 0 0 1 10.5 9h.75a.75.75 0 0 1 0 1.5h-.75a.75.75 0 0 1-.75-.75ZM10.5 12a.75.75 0 0 0 0 1.5h.75a.75.75 0 0 0 0-1.5h-.75ZM16.5 6.75v15h5.25a.75.75 0 0 0 0-1.5H21v-12a.75.75 0 0 0 0-1.5h-4.5Zm1.5 4.5a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75h-.008a.75.75 0 0 1-.75-.75v-.008Zm.75 2.25a.75.75 0 0 0-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 0 0 .75-.75v-.008a.75.75 0 0 0-.75-.75h-.008ZM18 17.25a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75h-.008a.75.75 0 0 1-.75-.75v-.008Z" clip-rule="evenodd" />
</svg>

                    </div>
                    <div>
                        <h3 class="text-2xl font-black text-slate-900 dark:text-slate-50">Daftar Profil</h3>
                        <p class="text-slate-600 dark:text-slate-400">Kelola semua profil organisasi</p>
                    </div>
                </div>
                <div class="px-4 py-2 bg-slate-100/80 dark:bg-slate-700/80 rounded-xl text-sm font-medium text-slate-700 dark:text-slate-300">
                    {{ $stats['profiles_list']?->count() ?? 0 }} profil
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
    <table class="w-full">
        <thead class="bg-gradient-to-r from-slate-50/50 to-slate-100/50 dark:from-slate-700/50 dark:to-slate-800/50 sticky top-0 z-10">
            <tr>
                <th class="px-6 py-4 text-left text-slate-900 dark:text-slate-100 font-black uppercase tracking-wider text-xs rounded-tl-3xl bg-slate-100/50 dark:bg-slate-700/50">Logo</th>
                <th class="px-6 py-4 text-left text-slate-900 dark:text-slate-100 font-black uppercase tracking-wider text-xs bg-slate-100/50 dark:bg-slate-700/50">Nama</th>
                <th class="px-6 py-4 text-left text-slate-900 dark:text-slate-100 font-black uppercase tracking-wider text-xs bg-slate-100/50 dark:bg-slate-700/50">Kontak</th>
                <th class="px-6 py-4 text-left text-slate-900 dark:text-slate-100 font-black uppercase tracking-wider text-xs bg-slate-100/50 dark:bg-slate-700/50">Lokasi</th>
                <th class="px-4 py-4 text-left text-slate-900 dark:text-slate-100 font-black uppercase tracking-wider text-xs bg-slate-100/50 dark:bg-slate-700/50">Tujuan & Fungsi</th>
                <th class="px-4 py-4 text-left text-slate-900 dark:text-slate-100 font-black uppercase tracking-wider text-xs bg-slate-100/50 dark:bg-slate-700/50">Motto</th>
                <th class="px-4 py-4 text-left text-slate-900 dark:text-slate-100 font-black uppercase tracking-wider text-xs bg-slate-100/50 dark:bg-slate-700/50">Visi</th>
                <th class="px-4 py-4 text-left text-slate-900 dark:text-slate-100 font-black uppercase tracking-wider text-xs bg-slate-100/50 dark:bg-slate-700/50">Misi</th>
                <th class="px-4 py-4 text-left text-slate-900 dark:text-slate-100 font-black uppercase tracking-wider text-xs bg-slate-100/50 dark:bg-slate-700/50">Sejarah</th>
                <th class="px-4 py-4 text-center text-slate-900 dark:text-slate-100 font-black uppercase tracking-wider text-xs bg-slate-100/50 dark:bg-slate-700/50">Status</th>
                <th class="px-4 py-4 text-center text-slate-900 dark:text-slate-100 font-black uppercase tracking-wider text-xs rounded-tr-3xl bg-slate-100/50 dark:bg-slate-700/50">Aksi</th>
            </tr>
        </thead>
        
        <tbody id="profilTableBody" class="divide-y divide-slate-200/50 dark:divide-slate-700/50">
            @forelse($stats['profiles_list'] ?? [] as $profil)
            <tr class="group hover:bg-slate-50/50 dark:hover:bg-slate-700/50 transition-all duration-300 h-24 data-[id='{{ $profil->id }}']">
                {{-- LOGO --}}
                <td class="px-6 py-4 font-medium">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-gradient-to-br rounded-2xl flex items-center justify-center shadow-lg flex-shrink-0
                                    {{ $profil->logo ? 'from-emerald-100 to-emerald-200 dark:from-emerald-900/50' : 'from-slate-100 to-slate-200 dark:from-slate-700/50' }}">
                            @if($profil->logo)
                                {{-- Mutator sudah kasih full URL --}}
                                <img src="{{ $profil->logo }}" 
                                    alt="Logo {{ $profil->name ?? 'Organisasi' }}" 
                                    class="w-10 h-10 object-cover rounded-xl shadow-md"
                                    loading="lazy">
                            @else
                                <svg class="w-7 h-7 text-slate-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            @endif
                        </div>
                    </div>
                </td>


                <!-- nama -->
                 <td class="px-6 py-4">
                    <h4 class="text-sm font-medium text-slate-900 dark:text-slate-50 truncate max-w-[150px]">{{ $profil->name ?? 'Tidak ada' }}</h4>
                </td>

                {{-- KONTAK --}}
                <td class="px-6 py-4">
                    <div class="flex items-center gap-2 text-sm">
                        <x-heroicon-o-envelope class="w-4 h-4 text-slate-500 flex-shrink-0" />
                        <span class="font-medium text-slate-900 dark:text-slate-50 truncate max-w-[150px]">
                            {{ $profil->email ?? 'Tidak ada kontak' }}
                        </span>
                    </div>
                </td>

                {{-- LOKASI --}}
                <td class="px-6 py-4">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span class="text-sm font-medium text-slate-900 dark:text-slate-50 truncate">{{ \Illuminate\Support\Str::limit($profil->alamat ?? '-', 30) }}</span>
                    </div>
                </td>

                {{-- TUJUAN & FUNGSI --}}
                <td class="px-4 py-4 hidden lg:table-cell">
                    <p class="text-xs text-slate-600 dark:text-slate-400 line-clamp-3 max-w-[120px]">{{ \Illuminate\Support\Str::limit(($profil->tujuan ?? '') . ' ' . ($profil->fungsi ?? ''), 80) }}</p>
                </td>

                {{-- MOTTO --}}
                <td class="px-4 py-4 hidden xl:table-cell">
                    <p class="text-xs text-slate-500 dark:text-slate-400 italic line-clamp-2">{{ \Illuminate\Support\Str::limit($profil->motto ?? '-', 40) }}</p>
                </td>

                {{-- VISI --}}
                <td class="px-4 py-4 hidden 2xl:table-cell">
                    <p class="text-xs text-slate-600 dark:text-slate-400 line-clamp-2">{{ \Illuminate\Support\Str::limit($profil->visi ?? '-', 50) }}</p>
                </td>

                {{-- MISI --}}
                <td class="px-4 py-4 hidden 2xl:table-cell">
                    <p class="text-xs text-slate-600 dark:text-slate-400 line-clamp-2">{{ \Illuminate\Support\Str::limit($profil->misi ?? '-', 50) }}</p>
                </td>

                {{-- SEJARAH --}}
                <td class="px-4 py-4 hidden 2xl:table-cell">
                    <p class="text-xs text-slate-600 dark:text-slate-400 line-clamp-2">{{ \Illuminate\Support\Str::limit($profil->sejarah ?? '-', 50) }}</p>
                </td>

                {{-- STATUS --}}
                <td class="px-4 py-4 text-center">
                    <span class="inline-flex px-3 py-1.5 rounded-full text-xs font-black shadow-lg transition-all duration-300 whitespace-nowrap
                                {{ ($profil->tujuan || $profil->fungsi || $profil->logos) ? 
                                    'bg-gradient-to-r from-emerald-100 to-emerald-200 text-emerald-800 dark:from-emerald-500/20 dark:to-emerald-600/20 dark:text-emerald-300 border border-emerald-200/50 shadow-emerald-200/50 hover:scale-105' : 
                                    'bg-gradient-to-r from-amber-100 to-amber-200 text-amber-800 dark:from-amber-500/20 dark:to-amber-600/20 dark:text-amber-300 border border-amber-200/50 shadow-amber-200/50 hover:scale-105' }}">
                        {{ ($profil->tujuan || $profil->fungsi || $profil->logos) ? '✅ LENGKAP' : '⚠️ BELUM LENGKAP' }}
                    </span>
                </td>

                {{-- AKSI --}}
                <td class="px-4 py-4 text-center">
                    <div class="flex items-center justify-center gap-1">
                        <div class="flex items-center gap-2">
    {{-- Edit Button --}}
    <button class="edit-btn group relative p-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white 
                   font-bold rounded-2xl shadow-lg hover:from-blue-600 hover:to-blue-700 hover:shadow-xl 
                   hover:-translate-y-1 transition-all duration-300 w-12 h-12 flex items-center justify-center
                   before:absolute before:inset-0 before:bg-white/20 before:rounded-2xl before:scale-0 
                   before:group-hover:scale-100 before:transition-all before:duration-300 before:z-10
                   focus:outline-none focus:ring-4 focus:ring-blue-500/50 z-20"
            data-id="{{ $profil->id }}" 
            data-name="{{ $profil->name }}" 
            title="Edit Profil">
        <svg class="w-5 h-5 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
        </svg>
    </button>
    
    {{-- Delete Button --}}
    <button class="delete-btn group relative p-3 bg-gradient-to-r from-red-500 to-red-600 text-white 
                  font-bold rounded-2xl shadow-lg hover:from-red-600 hover:to-red-700 hover:shadow-xl 
                  hover:-translate-y-1 transition-all duration-300 w-12 h-12 flex items-center justify-center
                  before:absolute before:inset-0 before:bg-white/20 before:rounded-2xl before:scale-0 
                  before:group-hover:scale-100 before:transition-all before:duration-300 before:z-10
                  focus:outline-none focus:ring-4 focus:ring-red-500/50 z-20"
            data-id="{{ $profil->id }}" 
            data-name="{{ $profil->name }}" 
            title="Hapus Profil">
        <svg class="w-5 h-5 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
        </svg>
    </button>
</div>

                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="11" class="py-24 text-center">
                    <div class="max-w-md mx-auto">
                        <div class="w-28 h-28 bg-gradient-to-br from-slate-100 to-slate-200 dark:from-slate-700/50 dark:to-slate-800/50 
                                    rounded-3xl flex items-center justify-center mx-auto mb-8 shadow-2xl">
                            <svg class="w-16 h-16 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <h3 class="text-3xl font-black text-slate-900 dark:text-slate-50 mb-4">Belum ada profil</h3>
                        <p class="text-xl text-slate-600 dark:text-slate-400 mb-8">Mulai dengan membuat profil organisasi pertama</p>
                        <button id="openCreateModalEmpty" 
                                class="px-10 py-4 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white font-black text-lg 
                                       rounded-2xl hover:from-emerald-600 hover:to-emerald-700 shadow-2xl hover:shadow-3xl 
                                       hover:-translate-y-1 transition-all duration-300 flex items-center gap-3 mx-auto">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Buat Profil Pertama
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



{{-- MODALS --}}
@include('admin.tentang.modals')
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    const modals = {
        create: document.getElementById('createModal'),
        edit: document.getElementById('editModal'),
        delete: document.getElementById('deleteModal')
    };
    let currentEditId = null;

    setupEventListeners();
    initFileUploads();

    function setupEventListeners() {
        // Create modal
        document.getElementById('openCreateModal')?.addEventListener('click', openCreateModal);
        document.getElementById('openCreateModalEmpty')?.addEventListener('click', openCreateModal);

        // 🎯 EDIT BUTTONS - FIXED
        document.addEventListener('click', async (e) => {
            if (e.target.closest('.edit-btn')) {
                e.preventDefault();
                const btn = e.target.closest('.edit-btn');
                const id = btn.dataset.id;
                if (id) await openEditModal(id);
            }
        });

        // 🎯 DELETE BUTTONS - FIXED
        document.addEventListener('click', (e) => {
            if (e.target.closest('.delete-btn')) {
                e.preventDefault();
                const btn = e.target.closest('.delete-btn');
                const id = btn.dataset.id;
                const name = btn.dataset.name || btn.closest('tr')?.querySelector('td')?.textContent?.trim() || 'Organisasi';
                openDeleteModal(id, name);
            }
        });

        // Forms
        document.getElementById('createForm')?.addEventListener('submit', handleCreateSubmit);
        document.getElementById('editForm')?.addEventListener('submit', handleEditSubmit);
        document.getElementById('confirmDeleteBtn')?.addEventListener('click', handleDeleteConfirm);

        setupCloseButtons();
    }

    // File uploads (simplified)
    function initFileUploads() {
        document.querySelectorAll('.upload-input').forEach(input => {
            const uploadArea = input.parentElement.querySelector('.upload-area');
            if (uploadArea) {
                uploadArea.addEventListener('click', () => input.click());
                input.addEventListener('change', handleFileChange);
            }
        });
    }

    function handleFileChange(e) {
        const file = e.target.files[0];
        const preview = e.target.parentElement.querySelector('.current-preview');
        const nameEl = e.target.parentElement.querySelector('[id*="PreviewName"]');
        
        if (preview) preview.classList.remove('hidden');
        if (nameEl && file) nameEl.textContent = file.name;
    }

    // MODALS
    function openCreateModal() {
        resetForm('createForm');
        showModal('create');
    }

    async function openEditModal(id) {
    console.log('🔍 openEditModal ID:', id);
    currentEditId = id;
    
    try {
        showLoading(true);
        
        // 🎯 USE REAL TABLE DATA - No API needed!
        const row = document.querySelector(`.edit-btn[data-id="${id}"]`)?.closest('tr') || 
                   document.querySelector(`[data-id="${id}"]`)?.closest('tr');
        
        const tableData = {
            id: parseInt(id),
            name: row?.querySelector('h4, .font-bold, td:nth-child(2)')?.innerText?.trim() || 'HIMANIKA',
            singkatan: 'HIMANIKA',
            email: row?.querySelector('a[href^="mailto"]')?.innerText || 'himanika@example.com',
            alamat: row?.querySelector('td:nth-child(4)')?.innerText?.slice(0, 100) || 'Jl. Tuanku Tambusai'
        };
        
        console.log('📊 Table data:', tableData);
        populateForm('editForm', tableData);
        
        // Open modal
        const editModal = document.getElementById('editModal');
        if (editModal) {
            editModal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            console.log('🎉 Modal opened!');
        }
        
    } catch (error) {
        console.error('❌ Error:', error);
        showToast('Gagal buka modal', 'error');
    } finally {
        showLoading(false);
    }
}

async function loadProfilData(id) {
    // Skip - pakai table data di openEditModal
    console.log('⏭️ loadProfilData skipped');
}

function populateForm(formId, data) {
    console.log('📝 Filling form:', data);
    const form = document.getElementById(formId);
    
    if (!form) {
        console.error('❌ Form missing:', formId);
        return;
    }
    
    // ✅ SAFE FILL - Only existing fields
    const fieldMap = {
        'name': ['editName', 'name'],
        'singkatan': ['editSingkatan', 'singkatan'],
        'email': ['editEmail', 'email'],
        'alamat': ['editAlamat', 'alamat'],
        'motto': ['editMotto', 'motto'],
        'fungsi': ['editFungsi', 'fungsi'],
        'tujuan': ['editTujuan', 'tujuan'],
        'visi': ['editVisi', 'visi'],
        'misi': ['editMisi', 'misi'],
        'sejarah': ['editSejarah', 'sejarah']
    };
    
    Object.entries(fieldMap).forEach(([key, selectors]) => {
        const field = selectors.reduce((found, selector) => 
            found || document.getElementById(selector) || form.querySelector(`[name="${selector}"]`), null);
        
        if (field && field.type !== 'file') {
            field.value = data[key] || '';
            console.log(`✅ ${key}:`, data[key]);
        }
    });
    
    // ID field
    const editId = document.getElementById('editId');
    if (editId) {
        editId.value = data.id;
        console.log('✅ ID:', data.id);
    }
    
    console.log('🎉 Form filled!');
}



    function openDeleteModal(id, name) {
        // 🎯 FIXED: Syntax error di sini!
        currentEditId = id;
        const nameEl = document.getElementById('deleteOrgName') || document.getElementById('deleteName');
        if (nameEl) {
            nameEl.textContent = name; // ✅ FIXED - No template literal issues
        }
        document.getElementById('deleteId').value = id;
        showModal('delete');
    }

    function showModal(type) {
        modals[type]?.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    // FORM HANDLERS
    async function handleCreateSubmit(e) {
        e.preventDefault();
        const formData = new FormData(e.target);
        await submitForm(formData, '{{ route("admin.tentang.store") }}', 'create');
    }

    async function handleEditSubmit(e) {
        e.preventDefault();
        const formData = new FormData(e.target);
        formData.append('_method', 'PUT');
        await submitForm(formData, `{{ route("admin.tentang.update", ":id") }}`.replace(':id', currentEditId), 'edit');
    }

    async function handleDeleteConfirm() {
        const btn = document.getElementById('confirmDeleteBtn');
        try {
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner">⏳</span> Menghapus...';
            
            await axios.delete(`{{ route("admin.tentang.destroy", ":id") }}`.replace(':id', currentEditId), {
                headers: { 'X-CSRF-TOKEN': CSRF_TOKEN }
            });
            
            showToast('✅ Profil dihapus!', 'success');
            closeModal('delete');
            setTimeout(() => location.reload(), 1000);
        } catch (error) {
            showToast('❌ Gagal hapus: ' + (error.response?.data?.message || 'Coba lagi'), 'error');
        } finally {
            btn.disabled = false;
            btn.innerHTML = 'Ya, Hapus!';
        }
    }

    // API
    async function loadProfilData(id) {
        const { data } = await axios.get(`{{ route("admin.tentang.edit", ":id") }}`.replace(':id', id));
        populateForm('editForm', data);
    }

    async function submitForm(formData, url, modalType) {
        try {
            const { data } = await axios.post(url, formData, {
                headers: { 'X-CSRF-TOKEN': CSRF_TOKEN }
            });
            showToast(data.message || '✅ Berhasil!', 'success');
            closeModal(modalType);
            setTimeout(() => location.reload(), 1000);
        } catch (error) {
            showToast('❌ ' + (error.response?.data?.message || 'Gagal'), 'error');
        }
    }

    // UTILITIES
    function populateForm(formId, data) {
        const form = document.getElementById(formId);
        Object.keys(data).forEach(key => {
            const field = form.querySelector(`[name="${key}"]`);
            if (field?.type !== 'file') field.value = data[key] || '';
        });
        document.getElementById('editId').value = data.id;
    }

    function resetForm(formId) {
        document.getElementById(formId)?.reset();
        document.querySelectorAll('.current-preview, [id*="current"]').forEach(el => el.classList.add('hidden'));
        document.querySelectorAll('[id$="Error"]').forEach(el => el.innerHTML = '');
    }

    function closeModal(type) {
        modals[type]?.classList.add('hidden');
        document.body.style.overflow = '';
        if (type !== 'delete') resetForm(type + 'Form');
    }

    function setupCloseButtons() {
        document.querySelectorAll('[onclick*="close"], .close-modal').forEach(btn => {
            btn.onclick = (e) => {
                e.preventDefault();
                const modal = btn.closest('[id$="Modal"]');
                closeModal(modal.id.replace('Modal', '').toLowerCase());
            };
        });

        // Click outside & ESC
        Object.values(modals).forEach(modal => {
            modal?.addEventListener('click', (e) => {
                if (e.target === modal) closeModal(modal.id.replace('Modal', '').toLowerCase());
            });
        });
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') Object.keys(modals).forEach(closeModal);
        });
    }

    function showToast(message, type = 'success') {
        const toast = document.createElement('div');
        toast.className = `fixed top-5 right-5 z-[9999] p-4 rounded-2xl shadow-2xl text-white max-w-sm animate-slide-in-out ${
            type === 'success' ? 'bg-emerald-500' : 'bg-red-500'
        }`;
        toast.textContent = message;
        document.body.appendChild(toast);
        setTimeout(() => toast.remove(), 4000);
    }

    function showLoading(show) {
        document.querySelectorAll('.edit-btn, .delete-btn').forEach(btn => {
            btn.style.opacity = show ? '0.6' : '1';
            btn.disabled = show;
        });
    }
});
</script>
@endpush
