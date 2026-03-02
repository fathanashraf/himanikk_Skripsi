@extends (
    (auth()->user()?->role === 'admin') 
        ? 'admin.layouts.app'
        : 'superadmin.layouts.app'
)

@section('title', 'Dashboard HIMANIKKA')

@section('content')
{{-- Stats Modal --}}
<div id="statsModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden">
    <div class="relative top-20 mx-auto w-11/12 md:w-96 p-6 bg-white dark:bg-slate-800 rounded-xl shadow-2xl max-h-[80vh] overflow-y-auto">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-semibold text-slate-900 dark:text-white" id="modalTitle">Detail Statistik</h3>
            <button id="closeModal" class="p-2 hover:bg-slate-200 dark:hover:bg-slate-700 rounded-lg">
                <iconify-icon icon="mdi:close" class="text-lg"></iconify-icon>
            </button>
        </div>
        <div id="modalContent" class="space-y-3 text-sm text-slate-600 dark:text-slate-300"></div>
    </div>
</div>

{{-- Activity Modal --}}
<div id="activityModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden">
    <div class="relative top-16 mx-auto w-11/12 md:w-4/5 lg:w-3/5 max-h-[85vh] p-6 bg-white dark:bg-slate-800 rounded-2xl shadow-2xl overflow-hidden">
        <div class="flex justify-between items-center mb-6 pb-4 border-b border-slate-200 dark:border-slate-700">
            <h3 class="text-xl font-bold text-slate-900 dark:text-white">Recent Activity</h3>
            <button id="closeActivityModal" class="p-2 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-xl">
                <iconify-icon icon="mdi:close" class="text-xl"></iconify-icon>
            </button>
        </div>
        <div id="activityModalContent" class="max-h-[65vh] overflow-y-auto custom-scrollbar space-y-3"></div>
    </div>
</div>

{{-- Stats Grid - Compact --}}
<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-8">
    {{-- 1. USERS --}}
    <div class="group cursor-pointer p-5 bg-gradient-to-br from-emerald-50 to-teal-50 dark:from-slate-800/80 dark:to-slate-700/80 backdrop-blur rounded-2xl border border-slate-200/50 hover:shadow-2xl hover:-translate-y-2 hover:border-emerald-400/80 transition-all duration-500" data-modal="users">
        <div class="w-14 h-14 bg-emerald-100 dark:bg-emerald-900/60 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
            <svg class="w-8 h-8 text-emerald-600 drop-shadow-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
            </svg>
        </div>
        <h3 class="text-xs font-bold uppercase text-slate-700 dark:text-slate-300 mb-3 tracking-wider">Users</h3>
        <p class="text-3xl font-black text-emerald-600 dark:text-emerald-400 drop-shadow-md">{{ number_format($stats['total_users'] ?? 0) }}</p>
        <span class="text-xs text-emerald-600 font-medium mt-1 block">+{{ number_format($stats['active_monthly'] ?? 0) }} bulan ini</span>
    </div>

    {{-- 2. STRUKTUR --}}
    <div class="group cursor-pointer p-5 bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-slate-800/80 dark:to-slate-700/80 backdrop-blur rounded-2xl border border-slate-200/50 hover:shadow-2xl hover:-translate-y-2 hover:border-blue-400/80 transition-all duration-500" data-modal="strukturs">
        <div class="w-14 h-14 bg-blue-100 dark:bg-blue-900/60 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
            <svg class="w-8 h-8 text-blue-600 drop-shadow-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
        </div>
        <h3 class="text-xs font-bold uppercase text-slate-700 dark:text-slate-300 mb-3 tracking-wider">Struktur</h3>
        <p class="text-3xl font-black text-blue-600 dark:text-blue-400 drop-shadow-md">{{ number_format($stats['total_struktur'] ?? 0) }}</p>
        <span class="text-xs text-blue-600 font-medium mt-1 block">{{ $stats['total_struktur'] ?? 0 }} Ketua</span>
    </div>

    {{-- 3. EVENTS --}}
    <div class="group cursor-pointer p-5 bg-gradient-to-br from-purple-50 to-violet-50 dark:from-slate-800/80 dark:to-slate-700/80 backdrop-blur rounded-2xl border border-slate-200/50 hover:shadow-2xl hover:-translate-y-2 hover:border-purple-400/80 transition-all duration-500" data-modal="events">
        <div class="w-14 h-14 bg-purple-100 dark:bg-purple-900/60 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
            <svg class="w-8 h-8 text-purple-600 drop-shadow-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
        </div>
        <h3 class="text-xs font-bold uppercase text-slate-700 dark:text-slate-300 mb-3 tracking-wider">Events</h3>
        <p class="text-3xl font-black text-purple-600 dark:text-purple-400 drop-shadow-md">{{ number_format($stats['total_events'] ?? 0) }}</p>
        <span class="text-xs text-purple-600 font-medium mt-1 block">Semua event</span>
    </div>

    {{-- 4. ACARA --}}
    <div class="group cursor-pointer p-5 bg-gradient-to-br from-orange-50 to-amber-50 dark:from-slate-800/80 dark:to-slate-700/80 backdrop-blur rounded-2xl border border-slate-200/50 hover:shadow-2xl hover:-translate-y-2 hover:border-orange-400/80 transition-all duration-500" data-modal="acara">
        <div class="w-14 h-14 bg-orange-100 dark:bg-orange-900/60 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
            <svg class="w-8 h-8 text-orange-600 drop-shadow-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1"/>
            </svg>
        </div>
        <h3 class="text-xs font-bold uppercase text-slate-700 dark:text-slate-300 mb-3 tracking-wider">Acara</h3>
        <p class="text-3xl font-black text-orange-600 dark:text-orange-400 drop-shadow-md">{{ number_format($stats['total_acara'] ?? 0) }}</p>
        <span class="text-xs text-orange-600 font-medium mt-1 block">Acara terjadwal</span>
    </div>

    {{-- 5. KEGIATAN --}}
    <div class="group cursor-pointer p-5 bg-gradient-to-br from-indigo-50 to-cyan-50 dark:from-slate-800/80 dark:to-slate-700/80 backdrop-blur rounded-2xl border border-slate-200/50 hover:shadow-2xl hover:-translate-y-2 hover:border-indigo-400/80 transition-all duration-500" data-modal="kegiatan">
        <div class="w-14 h-14 bg-indigo-100 dark:bg-indigo-900/60 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
            <svg class="w-8 h-8 text-indigo-600 drop-shadow-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"/>
            </svg>
        </div>
        <h3 class="text-xs font-bold uppercase text-slate-700 dark:text-slate-300 mb-3 tracking-wider">Kegiatan</h3>
        <p class="text-3xl font-black text-indigo-600 dark:text-indigo-400 drop-shadow-md">{{ number_format($stats['total_kegiatan'] ?? 0) }}</p>
        <span class="text-xs text-indigo-600 font-medium mt-1 block">{{ $stats['kegiatan_berlangsung'] ?? 0 }} aktif</span>
    </div>

    {{-- 6. PENDAFTARAN --}}
    <div class="group cursor-pointer p-5 bg-gradient-to-br from-rose-50 to-pink-50 dark:from-slate-800/80 dark:to-slate-700/80 backdrop-blur rounded-2xl border border-slate-200/50 hover:shadow-2xl hover:-translate-y-2 hover:border-rose-400/80 transition-all duration-500" data-modal="pendaftaran">
        <div class="w-14 h-14 bg-rose-100 dark:bg-rose-900/60 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
            <svg class="w-8 h-8 text-rose-600 drop-shadow-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <h3 class="text-xs font-bold uppercase text-slate-700 dark:text-slate-300 mb-3 tracking-wider">Pendaftaran</h3>
        <p class="text-3xl font-black text-rose-600 dark:text-rose-400 drop-shadow-md">{{ number_format($stats['total_Pendaftaran'] ?? 0) }}</p>
        <span class="text-xs text-rose-600 font-medium mt-1 block">{{ $stats['pendaftaran_menunggu'] ?? 0 }} pending</span>
    </div>
</div>

{{-- Charts - Smaller --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur p-6 rounded-2xl border border-slate-200/50 shadow-xl">
        <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Kegiatan per Bulan</h3>
        <div class="h-64">
            <canvas id="kegiatanChart"></canvas>
        </div>
    </div>
    
    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur p-6 rounded-2xl border border-slate-200/50 shadow-xl">
        <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Keuangan per Bulan</h3>
        <div class="h-64">
            <canvas id="keuanganChart"></canvas>
        </div>
    </div>
</div>

{{-- Recent Activity - Compact --}}
<div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur p-6 rounded-2xl border border-slate-200/50 shadow-xl" id="recentActivityCard">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Recent Activity</h3>
        <button id="openActivityModal" class="text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 font-medium text-sm flex items-center gap-1">
            Lihat Semua <iconify-icon icon="mdi:chevron-right" class="text-sm"></iconify-icon>
        </button>
    </div>
    <div class="max-h-64 overflow-y-auto custom-scrollbar space-y-3" id="recentActivityItems">
        <div class="flex items-center justify-center py-12 text-slate-500 dark:text-slate-400">
            <iconify-icon icon="mdi:loading" class="animate-spin text-xl mr-2"></iconify-icon>
            <span>Memuat aktivitas...</span>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
.custom-scrollbar::-webkit-scrollbar { 
    width: 4px; 
}
.custom-scrollbar::-webkit-scrollbar-track { 
    background: rgba(255,255,255,0.1); 
    border-radius: 2px; 
}
.custom-scrollbar::-webkit-scrollbar-thumb { 
    background: rgba(16,185,129,0.5); 
    border-radius: 2px; 
}
.custom-scrollbar::-webkit-scrollbar-thumb:hover { 
    background: rgba(16,185,129,0.8); 
}

/* Smooth Modal Transitions */
#statsModal, #activityModal {
    transition: opacity 0.3s ease-out, transform 0.3s ease-out;
    opacity: 0;
    transform: scale(0.95);
}
#statsModal:not(.hidden), #activityModal:not(.hidden) {
    opacity: 1;
    transform: scale(1);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const statsData = @json($stats ?? []);
    const recentActivities = @json($recentActivities ?? []);
    const chartData = @json($chartData ?? []);

    const renderActivityItem = (activity) => `
        <div class="flex items-start p-3 bg-white/50 dark:bg-slate-700/50 rounded-xl hover:bg-white dark:hover:bg-slate-700 transition-all">
            <div class="w-10 h-10 bg-${activity.color}-100 dark:bg-${activity.color}-900/50 rounded-lg flex items-center justify-center flex-shrink-0 mr-3">
                <iconify-icon icon="${activity.icon}" class="text-${activity.color}-600 text-lg"></iconify-icon>
            </div>
            <div class="flex-1 min-w-0">
                <p class="font-medium text-sm text-slate-900 dark:text-white">${activity.title}</p>
                <p class="text-xs text-slate-500 dark:text-slate-400">${activity.subtitle}</p>
                <div class="flex items-center justify-between mt-2 text-xs text-slate-500 dark:text-slate-400">
                    <span>${activity.time}</span>
                    <span class="px-2 py-1 bg-${activity.color}-100 dark:bg-${activity.color}-900/50 text-${activity.color}-700 rounded-full">${activity.status}</span>
                </div>
            </div>
        </div>
    `;

    // Modal Functions
    function openModal(modalId, contentCallback = null) {
        const modal = document.getElementById(modalId);
        modal.style.display = 'block';
        setTimeout(() => modal.classList.remove('hidden'), 10);
        
        const scrollbarWidth = window.innerWidth - document.documentElement.clientWidth;
        document.body.style.paddingRight = scrollbarWidth + 'px';
        document.body.style.overflow = 'hidden';
        
        if (contentCallback) contentCallback();
    }

    function closeAllModals() {
        document.querySelectorAll('#statsModal, #activityModal').forEach(modal => {
            modal.classList.add('hidden');
        });
        document.body.style.overflow = '';
        document.body.style.paddingRight = '';
    }

    // FIXED: Type-specific render functions
    const renderers = {
        users(data) {
            if (!data || data.length === 0) return this.emptyContent('users');
            
            let content = `
                <div class="mb-6 p-4 bg-emerald-50 dark:bg-emerald-900/30 rounded-2xl border border-emerald-200/50">
                    <div class="flex items-center justify-between">
                        <div>
                            <h4 class="text-sm font-semibold text-emerald-800 dark:text-emerald-200 uppercase tracking-wide">Total Users</h4>
                            <p class="text-2xl font-bold text-emerald-600 dark:text-emerald-400">${data.length}</p>
                        </div>
                        <iconify-icon icon="mdi:account-group" class="w-10 h-10 text-emerald-500"></iconify-icon>
                    </div>
                </div>
            `;
            
            data.slice(0, 10).forEach((item) => {
                const id = item.id || '#';
                const name = item.name || item.nama || 'N/A';
                const email = item.email || 'N/A';
                const date = item.created_at || item.updated_at || new Date().toISOString();
                const dateFormatted = new Date(date).toLocaleDateString('id-ID');
                
                content += `
                    <div class="group p-4 bg-white/60 dark:bg-slate-700/60 backdrop-blur-sm rounded-2xl border border-slate-200/50 hover:border-emerald-300/70 hover:shadow-lg transition-all mb-3">
                        <div class="flex items-start justify-between">
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-3 mb-1">
                                    <div class="w-8 h-8 bg-gradient-to-r from-emerald-400 to-teal-500 rounded-xl flex items-center justify-center flex-shrink-0">
                                        <span class="text-white font-bold text-sm">${id.toString().slice(-2)}</span>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-slate-900 dark:text-white truncate">${name}</p>
                                        ${email !== 'N/A' ? `<p class="text-xs text-slate-500 truncate">${email}</p>` : ''}
                                    </div>
                                </div>
                                <div class="flex items-center gap-3 text-xs text-slate-500 dark:text-slate-400">
                                    <span>${dateFormatted}</span>
                                </div>
                            </div>
                            <button class="p-2 opacity-0 group-hover:opacity-100 transition-all text-slate-400 hover:text-emerald-500">
                                <iconify-icon icon="mdi:dots-vertical"></iconify-icon>
                            </button>
                        </div>
                    </div>
                `;
            });
            return content;
        },

        strukturs(data) {
            if (!data || data.length === 0) return this.emptyContent('strukturs');
            
            let content = `
                <div class="mb-6 p-4 bg-blue-50 dark:bg-blue-900/30 rounded-2xl border border-blue-200/50">
                    <div class="flex items-center justify-between">
                        <div>
                            <h4 class="text-sm font-semibold text-blue-800 dark:text-blue-200 uppercase tracking-wide">Total Struktur</h4>
                            <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">${data.length}</p>
                        </div>
                        <iconify-icon icon="mdi:account-tree" class="w-10 h-10 text-blue-500"></iconify-icon>
                    </div>
                </div>
            `;
            
            data.slice(0, 10).forEach((item) => {
                const id = item.id || '#';
                const name = item.nama || item.name || 'N/A';
                const jabatan = item.jabatan || 'Anggota';
                const date = item.created_at || new Date().toISOString();
                const dateFormatted = new Date(date).toLocaleDateString('id-ID');
                
                content += `
                    <div class="group p-4 bg-white/60 dark:bg-slate-700/60 backdrop-blur-sm rounded-2xl border border-slate-200/50 hover:border-blue-300/70 hover:shadow-lg transition-all mb-3">
                        <div class="flex items-start justify-between">
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-3 mb-1">
                                    <div class="w-8 h-8 bg-gradient-to-r from-blue-400 to-indigo-500 rounded-xl flex items-center justify-center flex-shrink-0">
                                        <span class="text-white font-bold text-sm">${id.toString().slice(-2)}</span>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-slate-900 dark:text-white truncate">${name}</p>
                                        <p class="text-xs text-slate-500 truncate">${jabatan}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3 text-xs text-slate-500 dark:text-slate-400">
                                    <span>${dateFormatted}</span>
                                </div>
                            </div>
                            <button class="p-2 opacity-0 group-hover:opacity-100 transition-all text-slate-400 hover:text-blue-500">
                                <iconify-icon icon="mdi:dots-vertical"></iconify-icon>
                            </button>
                        </div>
                    </div>
                `;
            });
            return content;
        },

        events(data) {
            if (!data || data.length === 0) return this.emptyContent('events');
            // Similar structure for events...
            return `
                <div class="text-center py-12 text-purple-500">
                    <iconify-icon icon="mdi:calendar" class="w-16 h-16 mx-auto mb-4"></iconify-icon>
                    <h4 class="text-lg font-medium mb-2">Events Data</h4>
                    <p class="text-sm">Total: ${data.length || 0} events</p>
                </div>
            `;
        },

        acara(data) {
            if (!data || data.length === 0) return this.emptyContent('acara');
            return `
                <div class="text-center py-12 text-orange-500">
                    <iconify-icon icon="mdi:party-popper" class="w-16 h-16 mx-auto mb-4"></iconify-icon>
                    <h4 class="text-lg font-medium mb-2">Acara Data</h4>
                    <p class="text-sm">Total: ${data.length || 0} acara</p>
                </div>
            `;
        },

        kegiatan(data) {
            if (!data || data.length === 0) return this.emptyContent('kegiatan');
            return `
                <div class="text-center py-12 text-indigo-500">
                    <iconify-icon icon="mdi:lightning-bolt" class="w-16 h-16 mx-auto mb-4"></iconify-icon>
                    <h4 class="text-lg font-medium mb-2">Kegiatan Data</h4>
                    <p class="text-sm">Total: ${data.length || 0} kegiatan</p>
                </div>
            `;
        },

        pendaftaran(data) {
            if (!data || data.length === 0) return this.emptyContent('pendaftaran');
            return `
                <div class="text-center py-12 text-rose-500">
                    <iconify-icon icon="mdi:clipboard-list" class="w-16 h-16 mx-auto mb-4"></iconify-icon>
                    <h4 class="text-lg font-medium mb-2">Pendaftaran Data</h4>
                    <p class="text-sm">Total: ${data.length || 0} pendaftaran</p>
                </div>
            `;
        },

        emptyContent(type) {
            return `
                <div class="text-center py-12 text-slate-500 dark:text-slate-400">
                    <iconify-icon icon="mdi:inbox-outline" class="w-16 h-16 mx-auto mb-4 text-slate-300"></iconify-icon>
                    <h4 class="text-lg font-medium text-slate-900 dark:text-white mb-2">Belum ada data</h4>
                    <p class="text-sm">Data ${type} akan muncul di sini saat tersedia</p>
                </div>
            `;
        }
    };

    // Stats Modal Handlers - FIXED
    document.querySelectorAll('[data-modal]').forEach(card => {
        card.addEventListener('click', function() {
            const type = this.getAttribute('data-modal');
            const titles = {
                'users': '👥 Daftar Users',
                'strukturs': '👥 Pengurus HIMANIKKA',
                'events': '📅 Events Terbaru',
                'acara': '🎉 Acara Terjadwal',
                'kegiatan': '⚡ Kegiatan Aktif',
                'pendaftaran': '📋 Pendaftaran'
            };

            document.getElementById('modalTitle').textContent = titles[type] || `${type.toUpperCase()} Detail`;
            
            // Show loading
            document.getElementById('modalContent').innerHTML = `
                <div class="text-center py-12">
                    <iconify-icon icon="mdi:loading" class="animate-spin w-12 h-12 text-emerald-400 mx-auto mb-4"></iconify-icon>
                    <p class="text-slate-500 dark:text-slate-400 text-lg">Memuat data dari database...</p>
                    <p class="text-sm text-slate-400 mt-2">${type.toUpperCase()}</p>
                </div>
            `;

            openModal('statsModal');

            // Fetch data
            fetch(`/admin/stats/${type}`, {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                }
                return response.json();
            })
            .then(result => {
                console.log('Stats data:', result);
                if (result.success && result.data) {
                    const content = renderers[type] ? renderers[type](result.data) : renderers.emptyContent(type);
                    document.getElementById('modalContent').innerHTML = content;
                } else {
                    document.getElementById('modalContent').innerHTML = renderers.emptyContent(type);
                }
            })
            .catch(error => {
                console.error('AJAX Error:', error);
                document.getElementById('modalContent').innerHTML = `
                    <div class="text-center py-12 text-red-500">
                        <iconify-icon icon="mdi:server-off" class="w-16 h-16 mx-auto mb-4"></iconify-icon>
                        <h4 class="text-lg font-medium mb-2">Server Error</h4>
                        <p class="text-sm mb-2">Gagal memuat data</p>
                    </div>
                `;
            });
        });
    });

    // Recent Activities
    const recentActivityItems = document.getElementById('recentActivityItems');
    if (recentActivities?.length > 0) {
        recentActivityItems.innerHTML = recentActivities.slice(0, 5).map(renderActivityItem).join('');
    } else {
        recentActivityItems.innerHTML = `
            <div class="text-center py-12 text-slate-500 dark:text-slate-400">
                <iconify-icon icon="mdi:timeline-outline" class="w-12 h-12 mx-auto mb-3 opacity-50"></iconify-icon>
                <p>Belum ada aktivitas</p>
            </div>
        `;
    }

    // Charts
    const ctx1 = document.getElementById('kegiatanChart')?.getContext('2d');
    if (ctx1 && chartData.kegiatan_labels?.length) {
        new Chart(ctx1, {
            type: 'line',
            data: {
                labels: chartData.kegiatan_labels,
                datasets: [{ 
                    label: 'Kegiatan', 
                    data: chartData.kegiatan_data || [], 
                    borderColor: '#10B981', 
                    backgroundColor: 'rgba(16,185,129,0.1)', 
                    tension: 0.4, 
                    fill: true,
                    borderWidth: 3
                }]
            },
            options: { 
                responsive: true, 
                maintainAspectRatio: false, 
                scales: { y: { beginAtZero: true } }, 
                plugins: { legend: { display: false } },
                animation: { duration: 1500 }
            }
        });
    }

    const ctx2 = document.getElementById('keuanganChart')?.getContext('2d');
    if (ctx2 && chartData.keuangan_labels?.length) {
        new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: chartData.keuangan_labels,
                datasets: [
                    { label: 'Pendapatan', data: chartData.pendapatan_data || [], backgroundColor: 'rgba(16,185,129,0.8)' },
                    { label: 'Pengeluaran', data: chartData.pengeluaran_data || [], backgroundColor: 'rgba(239,68,68,0.8)' }
                ]
            },
            options: { 
                responsive: true, 
                maintainAspectRatio: false, 
                scales: { y: { beginAtZero: true } },
                animation: { duration: 1500 }
            }
        });
    }

    // Event Listeners
    document.getElementById('closeModal')?.addEventListener('click', closeAllModals);
    document.getElementById('closeActivityModal')?.addEventListener('click', closeAllModals);
    document.getElementById('openActivityModal')?.addEventListener('click', () => {
        document.getElementById('activityModalContent').innerHTML = recentActivities.map(renderActivityItem).join('');
        openModal('activityModal');
    });

    // Close on backdrop click
    document.getElementById('statsModal')?.addEventListener('click', (e) => {
        if (e.target.id === 'statsModal') closeAllModals();
    });
    document.getElementById('activityModal')?.addEventListener('click', (e) => {
        if (e.target.id === 'activityModal') closeAllModals();
    });

    // ESC key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeAllModals();
    });

    // Transition cleanup
    document.querySelectorAll('#statsModal, #activityModal').forEach(modal => {
        modal.addEventListener('transitionend', function() {
            if (this.classList.contains('hidden')) {
                this.style.display = 'none';
            }
        });
    });
});
</script>
@endpush
