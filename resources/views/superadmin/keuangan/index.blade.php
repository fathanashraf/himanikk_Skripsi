@extends('admin.layouts.app')

@section('content')
<!-- Page Header -->
<div class="mb-8">
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-4xl font-bold bg-gradient-to-r from-slate-900 to-slate-700 bg-clip-text text-transparent dark:from-slate-100 dark:to-slate-300">Keuangan HIMANIKKA</h1>
            <p class="mt-2 text-lg text-slate-600 dark:text-slate-400">Kelola data keuangan kegiatan dan acara organisasi</p>
        </div>
        <button onclick="openCreateModal()" 
                class="inline-flex items-center gap-3 px-8 py-4 text-lg font-bold text-white bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 focus:ring-4 focus:ring-emerald-200 rounded-2xl transition-all duration-300 shadow-xl hover:shadow-2xl hover:-translate-y-1">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Transaksi
        </button>
    </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
    <div class="group bg-white dark:bg-slate-800 rounded-3xl p-8 border border-slate-200/50 dark:border-slate-700/50 shadow-xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-semibold text-slate-600 dark:text-slate-400 mb-2">Total Transaksi</p>
                <p class="text-3xl font-bold bg-gradient-to-r from-emerald-600 to-emerald-500 bg-clip-text text-transparent">
                    {{ $keuangans->count() }}
                </p>
            </div>
            <div class="p-4 bg-emerald-100 dark:bg-emerald-900/30 rounded-2xl group-hover:scale-110 transition-transform duration-300">
                <svg class="w-8 h-8 text-emerald-600 dark:text-emerald-400" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="group bg-white dark:bg-slate-800 rounded-3xl p-8 border border-slate-200/50 dark:border-slate-700/50 shadow-xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-semibold text-slate-600 dark:text-slate-400 mb-2">Pendapatan</p>
                <p class="text-3xl font-bold bg-gradient-to-r from-emerald-600 to-emerald-500 bg-clip-text text-transparent">
                    {{ $keuangans->where('jenis', 'pendapatan')->count() }}
                </p>
            </div>
            <div class="p-4 bg-emerald-100 dark:bg-emerald-900/30 rounded-2xl group-hover:scale-110 transition-transform duration-300">
                <svg class="w-8 h-8 text-emerald-600 dark:text-emerald-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="group bg-white dark:bg-slate-800 rounded-3xl p-8 border border-slate-200/50 dark:border-slate-700/50 shadow-xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-semibold text-slate-600 dark:text-slate-400 mb-2">Pengeluaran</p>
                <p class="text-3xl font-bold bg-gradient-to-r from-red-600 to-red-500 bg-clip-text text-transparent">
                    {{ $keuangans->where('jenis', 'pengeluaran')->count() }}
                </p>
            </div>
            <div class="p-4 bg-red-100 dark:bg-red-900/30 rounded-2xl group-hover:scale-110 transition-transform duration-300">
                <svg class="w-8 h-8 text-red-600 dark:text-red-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="group bg-white dark:bg-slate-800 rounded-3xl p-8 border border-slate-200/50 dark:border-slate-700/50 shadow-xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-semibold text-slate-600 dark:text-slate-400 mb-2">Kegiatan</p>
                <p class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-blue-500 bg-clip-text text-transparent">
                    {{ $keuangans->where('type', 'kegiatan')->count() }}
                </p>
            </div>
            <div class="p-4 bg-blue-100 dark:bg-blue-900/30 rounded-2xl group-hover:scale-110 transition-transform duration-300">
                <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Data Table -->
<div class="bg-white dark:bg-slate-800 rounded-3xl border border-slate-200/50 dark:border-slate-700/50 shadow-2xl overflow-hidden">
    <div class="border-b border-slate-200/50 dark:border-slate-700/50 px-8 py-6">
        <div class="flex items-center justify-between">
            <h3 class="text-2xl font-bold text-slate-900 dark:text-white">Daftar Transaksi Keuangan</h3>
            <div class="flex items-center gap-3">
                <div class="flex items-center gap-2 text-sm text-slate-600 dark:text-slate-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-2 2v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    {{ $keuangans->total() }} Transaksi
                </div>
            </div>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-slate-50/50 dark:bg-slate-700/50">
                <tr>
                    <th class="px-8 py-6 text-left text-xs font-bold uppercase tracking-wider text-slate-600 dark:text-slate-400">Nama</th>
                    <th class="px-8 py-6 text-left text-xs font-bold uppercase tracking-wider text-slate-600 dark:text-slate-400">Nominal</th>
                    <th class="px-8 py-6 text-left text-xs font-bold uppercase tracking-wider text-slate-600 dark:text-slate-400">Jenis</th>
                    <th class="px-8 py-6 text-left text-xs font-bold uppercase tracking-wider text-slate-600 dark:text-slate-400">Tipe</th>
                    <th class="px-8 py-6 text-left text-xs font-bold uppercase tracking-wider text-slate-600 dark:text-slate-400">Total</th>
                    <th class="px-8 py-6 text-right text-xs font-bold uppercase tracking-wider text-slate-600 dark:text-slate-400">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200/50 dark:divide-slate-700/50">
                @forelse($keuangans as $keuangan)
                <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-700/50 transition-colors duration-200 group" 
                    data-keuangan-id="{{ $keuangan->id }}"
                    data-keuangan-data="{{ json_encode($keuangan) }}">
                    <td class="px-8 py-8">
                        <div class="flex items-center gap-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br {{ $keuangan->jenis === 'pendapatan' ? 'from-emerald-500 to-teal-600' : 'from-red-500 to-orange-600' }} rounded-2xl flex items-center justify-center shadow-lg">
                                <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-900 dark:text-white text-lg group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">{{ $keuangan->name }}</h4>
                                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Dibuat {{ $keuangan->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-8">
                        <p class="text-2xl font-bold text-slate-900 dark:text-white">Rp {{ number_format($keuangan->nominal, 0, ',', '.') }}</p>
                    </td>
                    <td class="px-8 py-8">
                        <span class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r {{ $keuangan->jenis === 'pendapatan' ? 'from-emerald-100 to-emerald-200 dark:from-emerald-900/30 dark:to-emerald-800/30 text-emerald-800' : 'from-red-100 to-red-200 dark:from-red-900/30 dark:to-red-800/30 text-red-800' }} rounded-full text-sm font-semibold">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                @if($keuangan->jenis === 'pendapatan')
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                @else
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                @endif
                            </svg>
                            {{ ucfirst($keuangan->jenis) }}
                        </span>
                    </td>
                    <td class="px-8 py-8">
                        <span class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-100 to-blue-200 dark:from-blue-900/30 dark:to-blue-800/30 text-blue-800 rounded-full text-sm font-semibold">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/>
                            </svg>
                            {{ ucfirst($keuangan->type) }}
                        </span>
                    </td>
                    <td class="px-8 py-8">
                        <p class="text-lg font-bold {{ $keuangan->jenis === 'pendapatan' ? 'text-emerald-600' : 'text-red-600' }}">
                            Rp {{ number_format($keuangan->total, 0, ',', '.') }}
                        </p>
                        @if($keuangan->keterangan)
                        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">{{ Str::limit($keuangan->keterangan, 50) }}</p>
                        @endif
                    </td>
                    <td class="px-8 py-8 text-right">
                        <div class="flex items-center gap-2 justify-end">
                            <button onclick="openEditModalFromRow(this)" 
                                    class="p-3 text-emerald-600 hover:text-emerald-700 hover:bg-emerald-100 dark:hover:bg-emerald-900/30 rounded-2xl transition-all duration-200 group">
                                <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.5h3m1.5-3l-3-3m2 4.5H9m3.5-3l3-3m2 4.5H19m-4.5-3l3-3"/>
                                </svg>
                            </button>
                            <button onclick="openDeleteModal('{{ $keuangan->id }}', '{{ $keuangan->name }}')" 
                                    class="p-3 text-red-600 hover:text-red-700 hover:bg-red-100 dark:hover:bg-red-900/30 rounded-2xl transition-all duration-200 group">
                                <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-8 py-20 text-center">
                        <div class="max-w-md mx-auto">
                            <div class="w-24 h-24 bg-slate-100 dark:bg-slate-700 rounded-3xl flex items-center justify-center mx-auto mb-6">
                                <svg class="w-12 h-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">Belum ada transaksi keuangan</h3>
                            <p class="text-slate-600 dark:text-slate-400 mb-8">Mulai dengan menambahkan transaksi keuangan pertama Anda.</p>
                            <button onclick="openCreateModal()" 
                                    class="inline-flex items-center gap-3 px-8 py-4 text-lg font-bold text-white bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 focus:ring-4 focus:ring-emerald-200 rounded-2xl transition-all duration-300 shadow-xl hover:shadow-2xl hover:-translate-y-1 mx-auto">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Tambah Transaksi Pertama
                            </button>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($keuangans->hasPages())
    <div class="border-t border-slate-200/50 dark:border-slate-700/50 px-8 py-6">
        <div class="flex items-center justify-between">
            <div class="text-sm text-slate-600 dark:text-slate-400">
                Menampilkan {{ $keuangans->firstItem() }} sampai {{ $keuangans->lastItem() }} dari {{ $keuangans->total() }} transaksi
            </div>
            <div>
                {{ $keuangans->links('vendor.pagination.custom') }}
            </div>
        </div>
    </div>
    @endif
</div>

{{-- PASTE SEMUA MODAL DAN SCRIPT ANDA DI SINI --}}
@include('admin.keuangan.modals')

@endsection
