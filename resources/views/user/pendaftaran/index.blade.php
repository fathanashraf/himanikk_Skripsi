@extends('user.layouts.app')

@section('title', 'Pendaftaran HIMANIKKA')

@section('content')
<div class="space-y-6">
    <!-- Header + Search/Filter -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
        <div class="flex flex-col sm:flex-row sm:items-center gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white">
                    Pendaftaran HIMANIKKA
                </h1>
                <p class="text-gray-600 dark:text-gray-400 mt-1">
                    Kelola semua pendaftaran Anda di sini ({{ $pendaftarans->total() }})
                </p>
            </div>
            
            <!-- Search -->
            <div class="relative">
                <input type="text" 
                       wire:model.live.debounce.500ms="search" 
                       placeholder="Cari nama event atau ID..." 
                       class="w-64 pl-12 pr-4 py-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 
                              rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent 
                              shadow-sm transition-all duration-200">
                <svg class="w-5 h-5 text-gray-400 absolute left-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
        </div>

        <!-- Filter + Button -->
        <div class="flex flex-col sm:flex-row gap-3">
            <select wire:model.live="status" class="px-4 py-2.5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-sm font-medium focus:ring-2 focus:ring-blue-500 shadow-sm min-w-[140px]">
                <option value="">Semua Status</option>
                <option value="pending">Pending</option>
                <option value="approved">Disetujui</option>
                <option value="rejected">Ditolak</option>
                <option value="cancelled">Dibatalkan</option>
            </select>
            <a href="{{ route('user.pendaftaran.create') }}" 
               class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 
                      text-white font-medium rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 
                      w-full sm:w-auto text-center whitespace-nowrap">
                + Daftar Event Baru
            </a>
        </div>
    </div>

    <!-- Loading State -->
    <div wire:loading wire:target="search,status" class="flex items-center justify-center py-12">
        <div class="flex items-center gap-3 text-blue-600">
            <div class="w-6 h-6 border-2 border-blue-600 border-t-transparent rounded-full animate-spin"></div>
            <span class="font-medium">Mencari pendaftaran...</span>
        </div>
    </div>

    <!-- Cards -->
    @forelse($pendaftarans as $pendaftaran)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($pendaftarans as $pendaftarans)
                @php $statusColor = match($pendaftarans->status) {
                    'approved' => 'bg-emerald-100 dark:bg-emerald-900 text-emerald-800 dark:text-emerald-200',
                    'rejected' => 'bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200',
                    'cancelled' => 'bg-orange-100 dark:bg-orange-900 text-orange-800 dark:text-orange-200',
                    default => 'bg-amber-100 dark:bg-amber-900 text-amber-800 dark:text-amber-200'
                }; @endphp

                <div class="group bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-2xl shadow-xl hover:shadow-2xl 
                           border border-white/50 dark:border-gray-700/50 p-6 hover:-translate-y-2 hover:rotate-1 
                           transition-all duration-500 overflow-hidden relative">
                    <!-- Gradient Background -->
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-50/50 to-indigo-50/50 dark:from-slate-900/30 dark:to-gray-800/30 -z-10"></div>
                    
                    <!-- Header Card -->
                    <div class="flex items-start justify-between mb-5 relative z-10">
                        <div class="flex items-center gap-3">
                            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-{{ $pendaftarans->status == 'approved' ? 'emerald' : 'blue' }}-500 to-indigo-600 
                                      flex items-center justify-center shadow-xl ring-2 ring-white/30">
                                <svg class="w-7 h-7 text-white drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    @if($pendaftarans->status == 'approved')
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    @else
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    @endif
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-xl text-gray-900 dark:text-white group-hover:text-blue-600 
                                           line-clamp-1 pr-2">
                                    {{ $pendaftarans->event->name ?? $pendaftarans->id ?? 'Event' }}
                                </h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400 font-medium">
                                    {{ $pendaftarans->event->status ?? 'Pendaftaran Umum' }}
                                </p>
                            </div>
                        </div>
                        <span class="px-3 py-1.5 {{ $statusColor }} text-xs font-bold rounded-full shadow-sm 
                                    ring-1 ring-white/30 backdrop-blur-sm">
                            {{ ucfirst(str_replace('_', ' ', $pendaftarans->status ?? 'pending')) }}
                        </span>
                    </div>

                    <!-- Detail -->
                    <div class="space-y-3 mb-6 relative z-10">
                        <div class="flex justify-between items-center py-3 px-1 rounded-lg hover:bg-gray-50/50 dark:hover:bg-gray-700/50 transition-colors">
                            <span class="text-sm text-gray-500 dark:text-gray-400">Didaftar</span>
                            <span class="font-semibold text-gray-900 dark:text-white text-base">
                                {{ $pendaftarans->created_at?->format('d M Y') ?? '-' }}
                            </span>
                        </div>
                        <div class="flex justify-between items-center py-3 px-1 rounded-lg hover:bg-gray-50/50 dark:hover:bg-gray-700/50 transition-colors">
                            <span class="text-sm text-gray-500 dark:text-gray-400">No. Pendaftaran</span>
                            <span class="font-mono text-sm bg-gradient-to-r from-blue-100 to-indigo-100 dark:from-blue-900/50 dark:to-indigo-900/50 
                                       px-3 py-1.5 rounded-xl font-bold text-blue-800 dark:text-blue-200 shadow-sm">
                                {{ $pendaftarans->id ?? '#' . $pendaftarans->id }}
                            </span>
                        </div>
                        @if($pendaftarans->event->status == 'umum')
                        <div class="flex justify-between items-center py-3 px-1 rounded-lg hover:bg-gray-50/50 dark:hover:bg-gray-700/50 transition-colors">
                            <span class="text-sm text-gray-500 dark:text-gray-400">Event Date</span>
                            <span class="font-semibold text-emerald-700 dark:text-emerald-300">
                                {{ \Carbon\Carbon::parse($pendaftarans->event->status)->format('d M Y') }}
                            </span>
                        </div>
                        @endif
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-2 pt-4 border-t border-white/30 dark:border-gray-700/50 relative z-10">
                        <a href="{{ route('user.pendaftaran.show', $pendaftarans) }}" 
                           class="flex-1 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 
                                  text-white text-sm font-bold py-3 px-4 rounded-xl text-center transition-all duration-300 
                                  shadow-lg hover:shadow-xl hover:-translate-y-0.5 backdrop-blur-sm">
                            <span class="block group-hover:hidden">Detail</span>
                            <span class="hidden group-hover:block">Lihat Dokumen</span>
                        </a>
                        @if(in_array($pendaftarans->status, ['pending', 'rejected']))
                        <button onclick="editPendaftaran({{ $pendaftarans->id }})" 
                                class="flex-1 bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 
                                       text-white text-sm font-bold py-3 px-4 rounded-xl text-center transition-all duration-300 
                                       shadow-lg hover:shadow-xl hover:-translate-y-0.5 backdrop-blur-sm">
                                {{ $pendaftarans->status == 'rejected' ? 'Update Data' : 'Edit' }}
                        </button>
                        @endif
                        @if($pendaftarans->status == 'cancelled')
                        <span class="flex-1 bg-gradient-to-r from-gray-400 to-gray-500 text-white text-sm font-bold py-3 px-4 
                                    rounded-xl text-center shadow-lg cursor-not-allowed opacity-75">
                            Dibatal
                        </span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="text-sm text-gray-700 dark:text-gray-300">
                Menampilkan {{ $pendaftarans->firstItem() ?? 0 }} - {{ $pendaftarans->lastItem() ?? 0 }} 
                dari {{ $pendaftarans->total() }} pendaftaran
            </div>
            @if($pendaftarans->hasPages())
            <div class="flex items-center gap-2">
                {{ $pendaftarans->links('pagination::tailwind') }}
            </div>
            @endif
        </div>
    @empty
        <div class="text-center py-20 px-6">
            <div class="w-28 h-28 mx-auto mb-8 bg-gradient-to-br from-gray-100 via-gray-200 to-white 
                       dark:from-slate-800 dark:via-gray-700 dark:to-gray-600 rounded-3xl flex items-center justify-center 
                       shadow-2xl ring-1 ring-gray-200/50 dark:ring-gray-600/50 backdrop-blur-sm">
                <svg class="w-16 h-16 text-gray-400 drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                          d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                </svg>
            </div>
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-3">Belum ada pendaftaran</h2>
            <p class="text-gray-500 dark:text-gray-400 mb-8 max-w-md mx-auto leading-relaxed">
                Daftarkan diri Anda ke event-event seru HIMANIKKA. 
                Kelola semua pendaftaran dengan mudah dari satu tempat.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="{{ route('user.pendaftaran.create') }}" 
                   class="group inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 
                          hover:from-blue-700 hover:to-indigo-700 text-white font-bold rounded-2xl shadow-2xl 
                          hover:shadow-3xl hover:-translate-y-1 transition-all duration-500 ring-2 ring-blue-500/30 
                          backdrop-blur-sm">
                    <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Daftar Event Pertama
                </a>
                <a href="{{ route('events.index') }}" 
                   class="text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 font-medium 
                          transition-colors duration-200 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Lihat Event Tersedia
                </a>
            </div>
        </div>
    @endforelse
</div>

<!-- Edit Modal Trigger Script -->
<script>
function editPendaftaran(id) {
    // Dispatch event untuk Livewire/Alpine
    Livewire.dispatch('openEditModal', { id: id });
}
</script>
@endsection
