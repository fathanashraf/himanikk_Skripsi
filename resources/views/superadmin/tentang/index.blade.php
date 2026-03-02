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
                        <span class="text-sm font-medium text-slate-900 dark:text-slate-50 truncate">{{ Str::limit($profil->alamat ?? '-', 30) }}</span>
                    </div>
                </td>

                {{-- TUJUAN & FUNGSI --}}
                <td class="px-4 py-4 hidden lg:table-cell">
                    <p class="text-xs text-slate-600 dark:text-slate-400 line-clamp-3 max-w-[120px]">{{ Str::limit(($profil->tujuan ?? '') . ' ' . ($profil->fungsi ?? ''), 80) }}</p>
                </td>

                {{-- MOTTO --}}
                <td class="px-4 py-4 hidden xl:table-cell">
                    <p class="text-xs text-slate-500 dark:text-slate-400 italic line-clamp-2">{{ Str::limit($profil->motto ?? '-', 40) }}</p>
                </td>

                {{-- VISI --}}
                <td class="px-4 py-4 hidden 2xl:table-cell">
                    <p class="text-xs text-slate-600 dark:text-slate-400 line-clamp-2">{{ Str::limit($profil->visi ?? '-', 50) }}</p>
                </td>

                {{-- MISI --}}
                <td class="px-4 py-4 hidden 2xl:table-cell">
                    <p class="text-xs text-slate-600 dark:text-slate-400 line-clamp-2">{{ Str::limit($profil->misi ?? '-', 50) }}</p>
                </td>

                {{-- SEJARAH --}}
                <td class="px-4 py-4 hidden 2xl:table-cell">
                    <p class="text-xs text-slate-600 dark:text-slate-400 line-clamp-2">{{ Str::limit($profil->sejarah ?? '-', 50) }}</p>
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
                        <button class="edit-btn group relative p-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white 
                                      font-bold rounded-xl shadow-lg hover:from-blue-600 hover:to-blue-700 hover:shadow-xl 
                                      hover:-translate-y-0.5 transition-all duration-300 w-10 h-10 flex items-center justify-center
                                      before:absolute before:inset-0 before:bg-white/20 before:rounded-xl before:scale-0 before:group-hover:scale-100 before:transition-transform before:duration-300"
                                data-id="{{ $profil->id }}" title="Edit">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </button>
                        <button class="delete-btn group relative p-2 bg-gradient-to-r from-red-500 to-red-600 text-white 
                                      font-bold rounded-xl shadow-lg hover:from-red-600 hover:to-red-700 hover:shadow-xl 
                                      hover:-translate-y-0.5 transition-all duration-300 w-10 h-10 flex items-center justify-center
                                      before:absolute before:inset-0 before:bg-white/20 before:rounded-xl before:scale-0 before:group-hover:scale-100 before:transition-transform before:duration-300"
                                data-id="{{ $profil->id }}" title="Hapus">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
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
    // Constants
    const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    const modals = {
        create: document.getElementById('createModal'),
        edit: document.getElementById('editModal'),
        delete: document.getElementById('deleteModal')
    };
    let currentEditId = null;

    // 🖱️ EVENT LISTENERS
    setupEventListeners();
    initFileUploads(); // 🔥 NEW: File Upload Handler

    function setupEventListeners() {
        // Open Create Modal
        document.getElementById('openCreateModal')?.addEventListener('click', openCreateModal);
        document.getElementById('openCreateModalEmpty')?.addEventListener('click', openCreateModal);

        // Edit buttons (Dynamic & Static)
        document.addEventListener('click', function(e) {
            if (e.target.closest('.edit-btn')) {
                const btn = e.target.closest('.edit-btn');
                openEditModal(btn.dataset.id);
            }
        });

        // Delete buttons (Dynamic & Static)
        document.addEventListener('click', function(e) {
            if (e.target.closest('.delete-btn')) {
                const btn = e.target.closest('.delete-btn');
                openDeleteModal(btn.dataset.id, btn);
            }
        });

        // Form submissions
        document.getElementById('createForm')?.addEventListener('submit', handleCreateSubmit);
        document.getElementById('editForm')?.addEventListener('submit', handleEditSubmit);
        document.getElementById('deleteForm')?.addEventListener('submit', handleDeleteSubmit);

        // Close buttons
        setupCloseButtons();
    }

    // 🔥 FILE UPLOAD HANDLERS
    function initFileUploads() {
        const uploadInputs = document.querySelectorAll('.upload-input');
        
        uploadInputs.forEach(input => {
            const previewId = input.id.replace('Upload', 'Preview');
            const previewNameId = previewId + 'Name';
            const previewSizeId = previewId + 'Size';
            const errorId = input.id.replace('Upload', 'Error');
            
            const preview = document.getElementById(previewId);
            const previewName = document.getElementById(previewNameId);
            const previewSize = document.getElementById(previewSizeId);
            const errorEl = document.getElementById(errorId);
            const uploadArea = input.parentElement.querySelector('.upload-area');
            
            if (!uploadArea) return;
            
            // Click to upload
            uploadArea.addEventListener('click', () => input.click());
            
            // Change handler
            input.addEventListener('change', (e) => handleFileSelect(e, preview, previewName, previewSize, errorEl, uploadArea));
            
            // Drag & Drop
            setupDragDrop(input, uploadArea, preview, previewName, previewSize, errorEl);
        });
    }

    function handleFileSelect(e, preview, nameEl, sizeEl, errorEl, uploadArea) {
        const file = e.target.files[0];
        processFile(file, e.target, preview, nameEl, sizeEl, errorEl, uploadArea);
    }

    function processFile(file, input, preview, nameEl, sizeEl, errorEl, uploadArea) {
        if (!file) return;
        
        const maxSize = parseInt(input.dataset.maxSize);
        
        // Validate size
        if (file.size > maxSize) {
            showFileError(errorEl, 'File terlalu besar! Maksimal 10MB');
            input.value = '';
            return;
        }
        
        // Validate type
        const allowedTypes = input.accept.split(',').map(t => t.replace('*', ''));
        if (!allowedTypes.some(type => file.type.includes(type.replace('*', '')))) {
            showFileError(errorEl, 'Format file tidak didukung!');
            input.value = '';
            return;
        }
        
        // Show preview
        preview.classList.remove('hidden');
        nameEl.textContent = file.name.length > 25 ? file.name.substring(0, 22) + '...' : file.name;
        sizeEl.textContent = formatFileSize(file.size);
        errorEl.innerHTML = '';
        uploadArea.style.opacity = '0.3';
    }

    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    function showFileError(errorEl, message) {
        errorEl.innerHTML = `
            <p class="text-red-500 text-xs flex items-center gap-1 animate-pulse">
                <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1 0z" clip-rule="evenodd"/>
                </svg>
                ${message}
            </p>
        `;
    }

    function setupDragDrop(input, dropZone, preview, nameEl, sizeEl, errorEl) {
        const events = ['dragenter', 'dragover', 'dragleave', 'drop'];
        
        events.forEach(event => dropZone.addEventListener(event, preventDefaults, false));
        
        ['dragenter', 'dragover'].forEach(event => {
            dropZone.addEventListener(event, () => {
                dropZone.classList.add('bg-opacity-100', 'ring-4');
                dropZone.classList.toggle('ring-amber-200/50', input.id.includes('lagu'));
                dropZone.classList.toggle('ring-purple-200/50', input.id.includes('instrumen'));
            }, false);
        });
        
        ['dragleave', 'drop'].forEach(event => {
            dropZone.addEventListener(event, () => {
                dropZone.classList.remove('bg-opacity-100', 'ring-4', 'ring-amber-200/50', 'ring-purple-200/50');
            }, false);
        });
        
        dropZone.addEventListener('drop', (e) => {
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                input.files = files;
                handleFileSelect({ target: input }, preview, nameEl, sizeEl, errorEl, dropZone.parentElement.querySelector('.upload-area'));
            }
        }, false);
        
        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }
    }

    // 📱 MODAL FUNCTIONS
    function openCreateModal() {
        resetForm('createForm');
        showModal('create');
    }

    async function openEditModal(id) {
        currentEditId = id;
        try {
            showLoading(true);
            await loadProfilData(id);
            showModal('edit');
        } catch (error) {
            showToast('Error loading data: ' + (error.response?.data?.message || 'Coba lagi'), 'error');
        } finally {
            showLoading(false);
        }
    }

    function openDeleteModal(id, btn) {
        currentEditId = id;
        const row = btn.closest('tr');
        const orgName = row.querySelector('h4').textContent;
        document.getElementById('deleteId').value = id;
        document.getElementById('deleteName').textContent = ` "${orgName}" ?`;
        showModal('delete');
    }

    function showModal(type) {
        modals[type]?.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    // 🚀 FORM HANDLERS
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

    async function handleDeleteSubmit(e) {
        e.preventDefault();
        try {
            await axios.delete(`{{ route("admin.tentang.destroy", ":id") }}`.replace(':id', currentEditId), {
                headers: { 'X-CSRF-TOKEN': CSRF_TOKEN }
            });
            showToast('Profil dihapus!', 'success');
            closeModal('delete');
            setTimeout(() => location.reload(), 500);
        } catch (error) {
            showToast('Error: ' + (error.response?.data?.message || 'Gagal hapus'), 'error');
        }
    }

    // 🔄 API FUNCTIONS
    async function loadProfilData(id) {
        const response = await axios.get(`{{ route("admin.tentang.edit", ":id") }}`.replace(':id', id));
        populateForm('editForm', response.data);
    }

    async function submitForm(formData, url, modalType) {
        try {
            const response = await axios.post(url, formData, {
                headers: {
                    'X-CSRF-TOKEN': CSRF_TOKEN,
                    'Content-Type': 'multipart/form-data'
                }
            });
            showToast(response.data.message || 'Berhasil disimpan!', 'success');
            closeModal(modalType);
            setTimeout(() => location.reload(), 500);
        } catch (error) {
            showToast('Error: ' + (error.response?.data?.message || 'Something went wrong'), 'error');
        }
    }

    // 🧹 UTILITY FUNCTIONS
    function populateForm(formId, data) {
        const form = document.getElementById(formId);
        Object.keys(data).forEach(key => {
            const field = form.querySelector(`[name="${key}"]`);
            if (field && field.type !== 'file') {
                field.value = data[key] || '';
            }
        });

        // Logo preview
        if (data.logo && formId === 'editForm') {
            const preview = document.getElementById('currentLogoPreview');
            const img = document.getElementById('logoPreviewImg');
            if (preview && img) {
                img.src = `/storage/${data.logo}`;
                preview.classList.remove('hidden');
            }
            document.getElementById('editId').value = data.id;
        }
    }

    function resetForm(formId) {
        const form = document.getElementById(formId);
        form?.reset();
        
        // Hide all previews
        document.getElementById('currentLogoPreview')?.classList.add('hidden');
        document.getElementById('currentLaguPreview')?.classList.add('hidden');
        document.getElementById('currentInstrumenPreview')?.classList.add('hidden');
        
        // Clear errors
        document.querySelectorAll('[id$="Error"]').forEach(el => el.innerHTML = '');
        
        // Reset upload areas
        document.querySelectorAll('.upload-area').forEach(area => {
            area.style.opacity = '1';
        });
    }

    function closeModal(type) {
        modals[type]?.classList.add('hidden');
        document.body.style.overflow = 'unset';
        if (type === 'create') resetForm('createForm');
        if (type === 'edit') resetForm('editForm');
    }

    function setupCloseButtons() {
        // Cancel buttons
        document.getElementById('cancelEditBtn')?.addEventListener('click', () => closeModal('edit'));
        
        // Close buttons (X)
        document.querySelectorAll('[onclick*="close"], #closeEditModal, #closeDeleteModal').forEach(btn => {
            btn.addEventListener('click', function() {
                const modalId = this.closest('[id$="Modal"]').id.toLowerCase().replace('modal', '');
                closeModal(modalId);
            });
        });

        // Click outside to close
        Object.values(modals).forEach(modal => {
            modal?.addEventListener('click', (e) => {
                if (e.target === modal) {
                    const modalId = modal.id.toLowerCase().replace('modal', '');
                    closeModal(modalId);
                }
            });
        });

        // ESC key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                Object.keys(modals).forEach(key => closeModal(key));
            }
        });
    }

    function showToast(message, type = 'success') {
        const toast = document.createElement('div');
        toast.className = `fixed top-4 right-4 z-[9999] p-4 rounded-xl shadow-2xl text-white max-w-sm ${
            type === 'success' ? 'bg-emerald-500' : 'bg-red-500'
        } transform translate-x-full transition-all duration-300`;
        toast.textContent = message;
        document.body.appendChild(toast);
        
        setTimeout(() => toast.classList.remove('translate-x-full'), 100);
        setTimeout(() => {
            toast.classList.add('translate-x-full');
            setTimeout(() => document.body.removeChild(toast), 300);
        }, 3000);
    }

    function showLoading(show = true) {
        const btns = document.querySelectorAll('.edit-btn');
        btns.forEach(btn => {
            btn.style.opacity = show ? '0.6' : '1';
            btn.disabled = show;
        });
    }
});
</script>
@endpush

