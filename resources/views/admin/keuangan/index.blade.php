@extends('admin.layouts.app')

@section('title', 'Kelola Keuangan')

@section('content')
<div class="p-6 space-y-6">
    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-900 dark:text-white tracking-tight">Kelola Keuangan</h1>
            <p class="text-slate-600 dark:text-slate-400 mt-1">Data pendapatan & pengeluaran HIMANIKKA</p>
        </div>
        <div class="flex gap-3">
            <button onclick="openCreateModal()" class="px-6 py-3 bg-emerald-600 text-white font-semibold rounded-xl hover:bg-emerald-700 transition-all shadow-lg flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Tambah Transaksi
            </button>
        </div>
    </div>

    {{-- Financial Summary --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Total Summary --}}
        <div class="bg-gradient-to-br from-emerald-50 to-emerald-100 dark:from-emerald-900/30 dark:to-emerald-800/30 rounded-3xl p-8 shadow-xl border border-emerald-200/50">
            <h3 class="text-2xl font-bold text-emerald-900 dark:text-emerald-100 mb-6 flex items-center gap-3">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Ringkasan Keuangan
            </h3>
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <p class="text-sm font-medium text-emerald-700 dark:text-emerald-300 uppercase tracking-wide mb-2">Total Pendapatan</p>
                    <p class="text-3xl font-bold text-emerald-900 dark:text-emerald-100">Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-red-600 dark:text-red-400 uppercase tracking-wide mb-2">Total Pengeluaran</p>
                    <p class="text-3xl font-bold text-red-600 dark:text-red-400">Rp {{ number_format($totalPengeluaran ?? 0, 0, ',', '.') }}</p>
                </div>
            </div>
            <div class="mt-8 pt-6 border-t border-emerald-200/50">
                <p class="text-xl font-bold text-slate-900 dark:text-white">
                    Saldo: <span class="{{ ($totalPendapatan ?? 0) - ($totalPengeluaran ?? 0) >= 0 ? 'text-emerald-600' : 'text-red-600' }}">Rp {{ number_format(($totalPendapatan ?? 0) - ($totalPengeluaran ?? 0), 0, ',', '.') }}</span>
                </p>
            </div>
        </div>

        {{-- Chart Placeholder --}}
        <div class="bg-white dark:bg-slate-800 rounded-3xl p-8 shadow-xl border border-slate-200/50 dark:border-slate-700/50">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-2xl font-bold text-slate-900 dark:text-white">Grafik Bulanan</h3>
        <select id="monthSelect" class="px-4 py-2 text-sm bg-white dark:bg-slate-700 border border-slate-200 dark:border-slate-600 rounded-xl text-slate-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
            <option value="2026-03">Maret 2026</option>
            <option value="2026-02">Februari 2026</option>
            <option value="2026-01">Januari 2026</option>
        </select>
    </div>
    
    <div class="relative h-80 bg-gradient-to-r from-slate-50/50 to-slate-100/50 dark:from-slate-700/50 dark:to-slate-600/50 rounded-2xl border-2 border-slate-200/50 dark:border-slate-600/50 p-6">
        <!-- Loading State -->
        <div id="chartLoading" class="absolute inset-0 flex items-center justify-center bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl z-10">
            <div class="text-center">
                <div class="w-12 h-12 border-4 border-emerald-200 border-t-emerald-500 rounded-full animate-spin mx-auto mb-4"></div>
                <p class="text-slate-500 dark:text-slate-400 font-medium">Memuat grafik...</p>
            </div>
        </div>
        
        <!-- Chart Container -->
        <canvas id="financeChart" class="w-full h-full"></canvas>
        
        <!-- Legend -->
        <div id="chartLegend" class="absolute bottom-4 left-4 flex gap-4 bg-white/90 dark:bg-slate-800/90 backdrop-blur-sm px-4 py-2 rounded-xl border border-slate-200/50 dark:border-slate-700/50 shadow-lg hidden">
            <div class="flex items-center gap-2">
                <div class="w-3 h-3 bg-emerald-500 rounded-full shadow-sm"></div>
                <span class="text-xs font-medium text-slate-700 dark:text-slate-300">Pendapatan</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-3 h-3 bg-red-500 rounded-full shadow-sm"></div>
                <span class="text-xs font-medium text-slate-700 dark:text-slate-300">Pengeluaran</span>
            </div>
        </div>
    </div>
</div>

    </div>

    {{-- Filters & Table --}}
    <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-2xl border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">
        <div class="p-6 border-b border-slate-200/50 dark:border-slate-700/50">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-slate-100 dark:bg-slate-700 rounded-xl">
                        <svg class="w-6 h-6 text-slate-600 dark:text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white">Riwayat Transaksi</h3>
                        <p class="text-sm text-slate-500 dark:text-slate-400">{{ $keuangans->total() }} transaksi</p>
                    </div>
                </div>
                
                {{-- Filters --}}
                <form method="GET" class="flex flex-wrap gap-3 items-center">
                    <div class="relative">
                        <input type="text" name="search" placeholder="Cari nama/nominal..." 
                               value="{{ request('search') }}" 
                               class="pl-12 pr-4 py-3 bg-slate-100/50 dark:bg-slate-700/50 border border-slate-200/50 rounded-xl focus:ring-2 focus:ring-emerald-500 text-sm w-64">
                        <svg class="w-5 h-5 absolute left-4 top-1/2 -translate-y-1/2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <select name="jenis" class="px-4 py-3 bg-slate-100/50 dark:bg-slate-700/50 border border-slate-200/50 rounded-xl focus:ring-2 focus:ring-emerald-500 text-sm">
                        <option value="">Semua Jenis</option>
                        <option value="pendapatan" {{ request('jenis') == 'pendapatan' ? 'selected' : '' }}>Pendapatan</option>
                        <option value="pengeluaran" {{ request('jenis') == 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
                    </select>
                    <select name="type" class="px-4 py-3 bg-slate-100/50 dark:bg-slate-700/50 border border-slate-200/50 rounded-xl focus:ring-2 focus:ring-emerald-500 text-sm">
                        <option value="">Semua Tipe</option>
                        <option value="pendapatan" {{ request('type') == 'pendapatan' ? 'selected' : '' }}>Pendapatan</option>
                        <option value="bantuan" {{ request('type') == 'bantuan' ? 'selected' : '' }}>Bantuan</option>
                        <option value="lainnya" {{ request('type') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                    <input type="date" name="tanggal" value="{{ request('tanggal') }}" 
                           class="px-4 py-3 bg-slate-100/50 dark:bg-slate-700/50 border border-slate-200/50 rounded-xl focus:ring-2 focus:ring-emerald-500 text-sm">
                    <button type="submit" class="px-6 py-3 bg-emerald-600 text-white font-semibold rounded-xl hover:bg-emerald-700 transition-all">
                        Filter
                    </button>
                </form>
            </div>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50/50 dark:bg-slate-700/50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider w-48">Nama Transaksi</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider w-24">Type</th>
                        <th class="px-6 py-4 text-right text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider w-32">Nominal</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider w-28">Jenis</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider w-32">User</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Referensi</th>
                        <th class="px-6 py-4 text-right text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider w-28">Total</th>
                        <th class="px-6 py-4 text-right text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider w-20">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200/50 dark:divide-slate-700/50">
                    @forelse($keuangans as $keuangan)
                    <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-700/50 group transition-colors"
                        data-keuangan-id="{{ $keuangan->id }}"
                        data-keuangan-data='{{ json_encode([
                            "id" => $keuangan->id,
                            "name" => $keuangan->name,
                            "nominal" => $keuangan->nominal,
                            "tanggal" => $keuangan->tanggal->format('Y-m-d'),
                            "type" => $keuangan->type,
                            "jenis" => $keuangan->jenis,
                            "total" => $keuangan->total,
                            "keterangan" => $keuangan->keterangan,
                            "kegiatan_id" => $keuangan->kegiatan_id,
                            "event_id" => $keuangan->event_id,
                            "acara_id" => $keuangan->acara_id,
                            "pendaftaran_id" => $keuangan->pendaftaran_id,
                            "user_id" => $keuangan->user_id
                        ]) }}'>
                        
                        {{-- Tanggal --}}
                        <td class="px-6 py-4">
                            <div class="font-semibold text-slate-900 dark:text-white">
                                {{ $keuangan->tanggal->format('d M Y') }}
                            </div>
                            <div class="text-xs text-slate-500 dark:text-slate-400">
                                {{ $keuangan->created_at->format('H:i') }}
                            </div>
                        </td>

                        {{-- Nama Transaksi --}}
                        <td class="px-6 py-4">
                            <div class="font-semibold text-slate-900 dark:text-white line-clamp-2 max-w-[200px]">
                                {{ $keuangan->name }}
                            </div>
                            @if($keuangan->keterangan)
                                <div class="text-xs text-slate-500 dark:text-slate-400 mt-1 line-clamp-1">
                                    {{ $keuangan->keterangan }}
                                </div>
                            @endif
                        </td>

                        {{-- Type ✅ FIXED: sesuai schema ['pendapatan', 'bantuan', 'lainnya'] --}}
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide
                                {{ $keuangan->type === 'pendapatan' ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-300' : 
                                   ($keuangan->type === 'bantuan' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300' : 
                                   'bg-gray-100 text-gray-800 dark:bg-gray-800/50 dark:text-gray-300') }}">
                                {{ ucfirst($keuangan->type) }}
                            </span>
                        </td>
                        
                        {{-- Nominal --}}
                        <td class="px-6 py-4 text-right">
                            <div class="text-xl font-bold {{ $keuangan->jenis === 'pendapatan' ? 'text-emerald-600 dark:text-emerald-400' : 'text-red-600 dark:text-red-400' }}">
                                {{ $keuangan->jenis === 'pendapatan' ? '+' : '-' }}Rp {{ number_format($keuangan->nominal, 0, ',', '.') }}
                            </div>
                        </td>

                        {{-- Jenis --}}
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide
                                {{ $keuangan->jenis === 'pendapatan' ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-300' : 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300' }}">
                                {{ ucfirst($keuangan->jenis) }}
                            </span>
                        </td>

                        {{-- User --}}
                        <td class="px-6 py-4">
                            @if($keuangan->user)
                                <div class="font-medium text-slate-900 dark:text-white text-sm">
                                    {{ $keuangan->user->name }}
                                </div>
                                <div class="text-xs text-slate-500 dark:text-slate-400">
                                    {{ $keuangan->user->email }}
                                </div>
                            @else
                                <div class="text-sm text-slate-500 dark:text-slate-400 italic">Tanpa user</div>
                            @endif
                        </td>

                        {{-- Referensi (Foreign Keys) --}}
                        <td class="px-6 py-4 text-sm">
                            <div class="space-y-1 max-w-[180px]">
                                @if($keuangan->pendaftaran)
                                    <span class="inline-flex items-center gap-1 text-xs bg-indigo-100 dark:bg-indigo-900/30 text-indigo-800 dark:text-indigo-300 px-2 py-1 rounded-full font-medium">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ \Illuminate\Support\Str::limit($keuangan->pendaftaran->name ?? 'Pendaftaran #' . $keuangan->pendaftaran_id, 25) }}
                                    </span>
                                @elseif($keuangan->event)
                                    <span class="inline-flex items-center gap-1 text-xs bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300 px-2 py-1 rounded-full font-medium">
                                        🎪 {{ \Illuminate\Support\Str::limit($keuangan->event->name ?? 'Event #' . $keuangan->event_id, 25) }}
                                    </span>
                                @elseif($keuangan->kegiatan)
                                    <span class="inline-flex items-center gap-1 text-xs bg-purple-100 dark:bg-purple-900/30 text-purple-800 dark:text-purple-300 px-2 py-1 rounded-full font-medium">
                                        ⚡ {{ \Illuminate\Support\Str::limit($keuangan->kegiatan->name ?? 'Kegiatan #' . $keuangan->kegiatan_id, 25) }}
                                    </span>
                                @elseif($keuangan->acara)
                                    <span class="inline-flex items-center gap-1 text-xs bg-orange-100 dark:bg-orange-900/30 text-orange-800 dark:text-orange-300 px-2 py-1 rounded-full font-medium">
                                        🎉 {{ \Illuminate\Support\Str::limit($keuangan->acara->name ?? 'Acara #' . $keuangan->acara_id, 25) }}
                                    </span>
                                @else
                                    <span class="text-xs text-slate-500 dark:text-slate-400 italic">Tanpa referensi</span>
                                @endif
                            </div>
                        </td>

                        {{-- Total --}}
                        <td class="px-6 py-4 text-right">
                            <div class="text-lg font-bold text-slate-900 dark:text-white">
                                Rp {{ number_format($keuangan->total, 0, ',', '.') }}
                            </div>
                        </td>

                        {{-- Aksi --}}
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center gap-1 justify-end">
                                <button onclick="openEditModalFromRow(this)" 
                                        class="p-2 text-emerald-600 hover:bg-emerald-100 dark:hover:bg-emerald-900/50 rounded-xl group-hover:scale-105 transition-all duration-200" 
                                        title="Edit Transaksi">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.5h3m1-6l4 4 6-6 4-4"/>
                                    </svg>
                                </button>
                                <button onclick="openDeleteModal({{ $keuangan->id }}, '{{ addslashes($keuangan->name) }}')" 
                                        class="p-2 text-red-600 hover:bg-red-100 dark:hover:bg-red-900/50 rounded-xl group-hover:scale-105 transition-all duration-200" 
                                        title="Hapus Transaksi">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="px-6 py-20 text-center">
                            <div class="flex flex-col items-center gap-4">
                                <div class="w-20 h-20 bg-slate-100 dark:bg-slate-700 rounded-2xl flex items-center justify-center">
                                    <svg class="w-12 h-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-1">Belum ada transaksi</h3>
                                    <p class="text-slate-500 dark:text-slate-400">Tambahkan transaksi keuangan pertama Anda</p>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="px-6 py-4 bg-slate-50/50 dark:bg-slate-700/50 border-t border-slate-200/50">
            {{ $keuangans->appends(request()->query())->links() }}
        </div>
    </div>
</div>

{{-- MODALS & JAVASCRIPT --}}
@include('admin.keuangan.modals')
@endsection


{{-- ✅ SCRIPT DI PUSH KE LAYOUT --}}
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Chart check:', typeof Chart);
    
    if (typeof Chart === 'undefined') {
        console.error('❌ Chart.js GAGAL load!');
        return;
    }

    console.log('✅ Chart.js OK, init chart...');
    let financeChart = null;
    
    const sampleData = {
        '2026-03': { labels: ['1', '8', '15', '22', '29'], income: [1200000, 1500000, 1800000, 1400000, 2200000], expenses: [800000, 950000, 1100000, 900000, 1300000] },
        '2026-02': { labels: ['1', '8', '15', '22'], income: [1100000, 1300000, 1600000, 1900000], expenses: [700000, 850000, 1000000, 1200000] },
        '2026-01': { labels: ['5', '12', '19', '26'], income: [900000, 1400000, 1700000, 2000000], expenses: [600000, 800000, 950000, 1100000] }
    };

    function initChart(data) {
        const canvas = document.getElementById('financeChart');
        if (!canvas) return console.error('❌ Canvas tidak ada');

        const ctx = canvas.getContext('2d');
        if (financeChart) financeChart.destroy();

        financeChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: data.labels,
                datasets: [
                    {
                        label: 'Pendapatan',
                        data: data.income,
                        borderColor: '#10b981',
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        borderWidth: 4, fill: true, tension: 0.4,
                        pointBackgroundColor: '#10b981', pointBorderColor: '#fff',
                        pointBorderWidth: 3, pointRadius: 8
                    },
                    {
                        label: 'Pengeluaran',
                        data: data.expenses,
                        borderColor: '#ef4444',
                        backgroundColor: 'rgba(239, 68, 68, 0.1)',
                        borderWidth: 4, fill: true, tension: 0.4,
                        pointBackgroundColor: '#ef4444', pointBorderColor: '#fff',
                        pointBorderWidth: 3, pointRadius: 8
                    }
                ]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { callback: v => 'Rp ' + v.toLocaleString('id-ID') }
                    }
                },
                animation: { duration: 1200 }
            }
        });

        document.getElementById('chartLoading').style.display = 'none';
        document.getElementById('chartLegend')?.classList.remove('hidden');
    }

    // Load awal
    setTimeout(() => initChart(sampleData['2026-03']), 200);

    // Month change
    document.getElementById('monthSelect')?.addEventListener('change', e => {
        document.getElementById('chartLoading').style.display = 'flex';
        document.getElementById('chartLegend')?.classList.add('hidden');
        setTimeout(() => initChart(sampleData[e.target.value] || sampleData['2026-03']), 300);
    });
});
</script>
@endpush

