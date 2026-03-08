@extends('user.layouts.app')

@section('title', $events->name . ' - HIMANIKKA')

@section('content')
<!-- Hero Section -->
<section class="relative min-h-screen bg-gradient-to-br from-slate-50 to-indigo-50 dark:from-slate-900 dark:to-slate-800 overflow-hidden">
    <!-- Subtle Background Pattern -->
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_20%,rgba(120,119,198,0.1),transparent),radial-gradient(circle_at_80%_80%,rgba(120,119,198,0.1),transparent)] dark:bg-[radial-gradient(circle_at_30%_20%,rgba(147,51,234,0.15),transparent),radial-gradient(circle_at_80%_80%,rgba(147,51,234,0.15),transparent)]"></div>
    
    <div class="container mx-auto px-6 py-24 lg:py-32 relative z-10">
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-3 text-sm mb-12">
            <a href="{{ route('user.dashboard.index') }}" class="group inline-flex items-center gap-2 text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 font-medium transition-colors">
                <svg class="w-4 h-4 group-hover:-translate-x-px transition-transform" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Dashboard
            </a>
            <span class="w-2 h-2 bg-gray-300 dark:bg-gray-600 rounded-full"></span>
            <a href="{{ route('user.events.index') }}" class="text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 font-medium transition-colors">event</a>
            <span class="w-2 h-2 bg-gray-300 dark:bg-gray-600 rounded-full"></span>
            <span class="font-semibold text-gray-900 dark:text-white truncate max-w-xs" title="{{ $events->name }}">{{ \Illuminate\Support\Str::limit($events->name, 40) }}</span>
        </nav>

        <div class="grid lg:grid-cols-12 gap-8 lg:gap-12 items-start max-w-7xl mx-auto">
            <!-- Main Content (8/12) -->
            <article class="lg:col-span-8 space-y-8">
                <!-- Featured Image -->
                <div class="group relative rounded-3xl overflow-hidden shadow-xl ring-1 ring-gray-200/50 dark:ring-slate-700/50 hover:shadow-2xl hover:ring-indigo-200/70 dark:hover:ring-indigo-500/40 transition-all duration-500 bg-white/60 dark:bg-slate-800/40 backdrop-blur-sm">
                    @if($events->image)
                        <img src="{{ asset('storage/' . $events->image) }}" 
                             alt="{{ $events->name }}" 
                             class="w-full h-[28rem] lg:h-[36rem] object-cover transition-transform duration-700 group-hover:scale-[1.03]"
                             loading="lazy">
                        
                        <!-- Quick Actions -->
                        <div class="absolute top-6 right-6 flex flex-col gap-3 opacity-0 group-hover:opacity-100 transition-all duration-300 translate-y-2 group-hover:translate-y-0">
                            <a href="{{ asset('storage/' . $events->image) }}" 
                               target="_blank"
                               class="p-3 bg-white/95 dark:bg-slate-900/95 backdrop-blur-md rounded-2xl shadow-xl hover:shadow-2xl hover:scale-105 transition-all duration-200 border border-gray-100/50 dark:border-slate-700/50 w-12 h-12 flex items-center justify-center">
                                <svg class="w-5 h-5 text-gray-800 dark:text-slate-200" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4a2 2 0 002 2h12a2 2 0 002-2v-4m-6 0h6"/>
                                </svg>
                            </a>
                            <button class="p-3 bg-white/95 dark:bg-slate-900/95 backdrop-blur-md rounded-2xl shadow-xl hover:shadow-2xl hover:scale-105 transition-all duration-200 border border-gray-100/50 dark:border-slate-700/50 w-12 h-12 flex items-center justify-center"
                                    onclick="shareevent({{ $events->id }})">
                                <svg class="w-5 h-5 text-gray-800 dark:text-slate-200" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684z"/>
                                </svg>
                            </button>
                        </div>
                    @else
                        <div class="w-full h-[28rem] lg:h-[36rem] bg-gradient-to-br from-indigo-500 via-purple-600 to-slate-600 rounded-3xl flex items-center justify-center relative overflow-hidden">
                            <div class="absolute inset-0 bg-[radial-gradient(ellipse_50%_50%_at_50%_50%,rgba(255,255,255,0.1),transparent)] animate-pulse"></div>
                            <svg class="w-28 h-28 text-white/90 relative z-10" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    @endif
                </div>

                <!-- Content Card -->
                <div class="bg-white/70 dark:bg-slate-800/70 backdrop-blur-xl rounded-3xl p-10 lg:p-12 shadow-2xl border border-white/60 dark:border-slate-700/60 ring-1 ring-gray-200/50 dark:ring-slate-700/50">
                    <!-- Header with Status -->
                    <div class="flex flex-wrap items-center justify-between gap-6 mb-10 pb-8 border-b border-gray-200/50 dark:border-slate-700/50">
                        <!-- Status Badge -->
                                           <!-- Status Badge (lanjutan) -->
                    @php
                        $statusConfig = [
                            'segera' => ['label' => 'Segera Dimulai', 'color' => 'amber', 'icon' => '⏰'],
                            'belum' => ['label' => 'Sedang Berlangsung', 'color' => 'indigo', 'icon' => '🔴'],
                            'selesai' => ['label' => 'Selesai', 'color' => 'emerald', 'icon' => '✅'],
                        ];
                        $status = $statusConfig[$events->status] ?? ['label' => 'Draft', 'color' => 'gray', 'icon' => '📝'];
                    @endphp
                    
                    <span class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-{{ $status['color'] }}-500 to-{{ $status['color'] }}-600 text-white font-semibold rounded-2xl shadow-lg border border-{{ $status['color'] }}-600/30">
                        {{ $status['icon'] }} {{ $status['label'] }}
                    </span>

                    <!-- Event Date/Time -->
                    <div class="flex items-center gap-8 text-sm font-medium text-gray-700 dark:text-gray-300 ml-auto">
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 bg-indigo-500 rounded-full"></div>
                            <span>{{ $events->tanggal?->translatedFormat('d F Y') ?? 'TBD' }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 bg-purple-500 rounded-full"></div>
                            <span>{{ $events->waktu?->format('H:i') ?? '-' }}</span>
                        </div>
                    </div>
                    </div>

                    <!-- Main Description -->
                    <div class="prose prose-lg max-w-none dark:prose-invert mb-12">
                        <div class="text-lg leading-relaxed text-gray-800 dark:text-gray-200 space-y-6">
                            {!! nl2br(e($events->description)) !!}
                        </div>
                    </div>

                    <!-- Persyaratan Masuk Section -->
                    @if($events->masukkan)
                    <div class="pt-8 pb-6 border-t border-gray-200/50 dark:border-slate-700/50">
                        <div class="space-y-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gradient-to-r from-emerald-500 to-teal-600 rounded-2xl flex items-center justify-center shadow-lg">
                                    <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                </div>
                                <h3 class="text-2xl font-bold text-slate-900 dark:text-white">Persyaratan Masuk</h3>
                            </div>
                            <div class="pl-12 border-l-4 border-emerald-200/60 dark:border-emerald-700/60 py-6 space-y-3 bg-emerald-50/50 dark:bg-emerald-900/20 rounded-2xl">
                                @if(str_contains($events->masukkan, "\n") || str_contains($events->masukkan, ',') || str_contains($events->masukkan, '|'))
                                    @php
                                        $masukkanList = preg_split('/[\n,\|]/', trim($events->masukkan), -1, PREG_SPLIT_NO_EMPTY);
                                        $masukkanList = array_filter(array_map('trim', $masukkanList));
                                    @endphp
                                    @if(!empty($masukkanList))
                                        <ul class="space-y-3 text-slate-700 dark:text-slate-200">
                                            @foreach($masukkanList as $item)
                                                <li class="flex items-start gap-3 text-base">
                                                    <svg class="w-6 h-6 text-emerald-500 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                    </svg>
                                                    <span class="leading-relaxed">{{ $item }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                @else
                                    <p class="text-lg text-slate-700 dark:text-slate-200 leading-relaxed">
                                        {{ $events->masukkan }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </article>

            <!-- Sidebar (4/12) -->
            <aside class="lg:col-span-4 space-y-8 lg:sticky lg:top-28 self-start">
                <!-- Event Info Card -->
                <div class="bg-white/70 dark:bg-slate-800/70 backdrop-blur-xl rounded-3xl p-8 shadow-2xl border border-white/60 dark:border-slate-700/60 ring-1 ring-gray-200/50 dark:ring-slate-700/50">
                    <div class="flex items-center gap-4 mb-8 pb-6 border-b border-gray-200/50 dark:border-slate-700/50">
                        <div class="p-3 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-2xl shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Detail event</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Informasi lengkap event</p>
                        </div>
                    </div>

                    <!-- Location -->
                    <div class="mb-8">
                        <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-4 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Lokasi
                        </label>
                        <div class="p-5 bg-gradient-to-r from-indigo-50/50 to-purple-50/50 dark:from-slate-700/50 dark:to-indigo-900/20 rounded-2xl border border-indigo-200/50 dark:border-slate-600/50">
                            <p class="font-semibold text-lg text-gray-900 dark:text-white leading-relaxed">{{ $events->tempat ?? 'Online / Belum ditentukan' }}</p>
                        </div>
                    </div>

                    <!-- Organizer -->
                    @if($events->user)
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-4 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Penyelenggara
                        </label>
                        <div class="flex items-center gap-4 p-5 bg-gradient-to-r from-emerald-50/80 to-teal-50/80 dark:from-emerald-900/30 dark:to-teal-900/30 rounded-2xl border border-emerald-200/50 dark:border-emerald-700/50">
                            <div class="w-16 h-16 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-xl flex-shrink-0">
                                <span class="text-2xl font-bold text-white">{{ strtoupper(substr($events->user->name, 0, 2)) }}</span>
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="font-bold text-gray-900 dark:text-white text-lg truncate">{{ $events->user->name }}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $events->created_at?->format('d M Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- CTA Section -->
                               <!-- CTA Section (LANJUTAN) -->
                @php
                    $penanggungJawab = $events->user_id 
                        ? \App\Models\User::select('id', 'name', 'phone')->find($events->user_id) 
                        : null;
                    $phone = $penanggungJawab?->phone ?? null;
                    $waPhone = $phone ? preg_replace('/[^0-9]/', '', $phone) : '6281234567890';
                @endphp

                <div class="bg-gradient-to-r from-emerald-50 via-teal-50 to-emerald-50/0 dark:from-emerald-900/20 dark:via-teal-900/20 dark:to-slate-800/20 rounded-3xl p-8 shadow-2xl border border-emerald-200/50 dark:border-emerald-700/40 ring-1 ring-emerald-200/50 dark:ring-emerald-700/40">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-3">
                        <svg class="w-9 h-9 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                        Siap Ikut?
                    </h3>
                    
                    <div class="space-y-4">
                        <!-- WHATSAPP BUTTON -->
                        <a href="https://wa.me/{{ $waPhone }}?text={{ 
                            urlencode("Hi Admin HIMANIKKA,%0A%0ASaya tertarik event:%0A📅 " . 
                            ($events->tanggal?->format('d M Y') ?? 'TBD') . "%0A🕒 " . 
                            ($events->waktu?->format('H:i') ?? '-') . "%0A📍 " . 
                            ($events->tempat ?? 'TBD') . "%0A%0ANama: %0ANIM: %0AKelas: %0AMau tanya detailnya? 😊")
                        }}" 
                           target="_blank" rel="noopener noreferrer"
                           class="group relative w-full block bg-gradient-to-r from-emerald-600 via-emerald-700 to-teal-700 hover:from-emerald-700 hover:to-teal-800 text-white font-bold py-5 px-8 rounded-2xl shadow-2xl hover:shadow-3xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                            <div class="absolute inset-0 bg-white/20 rotate-[-60deg] scale-0 group-hover:scale-100 transition-transform duration-700 -z-10 opacity-0 group-hover:opacity-100"></div>
                            <div class="flex items-center justify-center gap-3 relative z-10">
                                <svg class="w-6 h-6 group-hover:scale-110 transition-transform duration-200" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.472.16 12.06a11.807 11.807 0 002.517 7.234l3.763-.922-.998 3.648.235.374a11.752 11.752 0 005.064 1.388 11.73 11.73 0 006.457-2.456c-.995-.574-.892-.283-1.79-.832l-3.741-.982z"/>
                                </svg>
                                <span class="text-lg">💬 Hubungi Penanggung Jawab</span>
                            </div>
                        </a>

                        <!-- SHARE BUTTON -->
                        <button onclick="shareevent({{ $events->id }})"
                                class="w-full bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-semibold py-4 px-6 rounded-2xl shadow-xl hover:shadow-2xl hover:-translate-y-px transition-all duration-300 flex items-center justify-center gap-3 text-lg group">
                            <svg class="w-5 h-5 group-hover:scale-110 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684z"/>
                            </svg>
                            <span>📱 Bagikan event</span>
                        </button>

                        <!-- SAVE BUTTON -->
                        <button onclick="saveevent({{ $events->id }})"
                                class="w-full bg-white dark:bg-slate-800 border-2 border-gray-200 dark:border-slate-700 hover:border-emerald-500 hover:bg-emerald-50 dark:hover:bg-emerald-900/20 hover:text-emerald-700 dark:hover:text-emerald-300 font-semibold py-4 px-6 rounded-2xl shadow-xl hover:shadow-2xl hover:-translate-y-px transition-all duration-300 flex items-center justify-center text-lg group">
                            <svg class="w-5 h-5 group-hover:scale-110 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                            </svg>
                            <span>Simpan event</span>
                        </button>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>

{{-- ✅ COMPLETE JAVASCRIPT - NO ERRORS --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. SHARE FUNCTION (Web Share API + Clipboard)
    window.shareevent = function(id) {
        if (navigator.share) {
            navigator.share({
                title: '{{ addslashes($events->name) }}',
                text: 'Cek event menarik "{{ addslashes($events->name) }}" dari HIMANIKKA! 📅 {{ $events->tanggal?->format("d M Y") ?? "TBD" }}',
                url: window.location.href
            }).catch(err => console.log('Error sharing', err));
        } else {
            navigator.clipboard.writeText(window.location.href).then(() => {
                showToast('✅ Link event sudah dicopy!', 'success');
            }).catch(() => {
                // Fallback untuk browser lama
                const textArea = document.createElement('textarea');
                textArea.value = window.location.href;
                document.body.appendChild(textArea);
                textArea.select();
                document.execCommand('copy');
                document.body.removeChild(textArea);
                showToast('✅ Link event sudah dicopy!', 'success');
            });
        }
    };

    // 2. TOAST NOTIFICATION
    window.showToast = function(message, type = 'success') {
        document.querySelectorAll('.custom-toast').forEach(t => t.remove());
        
        const toast = document.createElement('div');
        toast.className = `
            custom-toast fixed top-4 right-4 z-[9999] px-6 py-4 rounded-2xl shadow-2xl 
            backdrop-blur-xl border transform translate-x-full animate-in slide-in-from-right-2 fade-in duration-300
            ${type === 'success' ? 'bg-emerald-500/95 text-white border-emerald-400/50' : 'bg-red-500/95 text-white border-red-400/50'}
            max-w-sm font-medium
        `;
        
        toast.innerHTML = `
            <div class="flex items-center gap-3">
                <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    ${type === 'success' 
                        ? '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>' 
                        : '<path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>'
                    }
                </svg>
                <span>${message}</span>
            </div>
        `;
        
        document.body.appendChild(toast);
        requestAnimationFrame(() => toast.classList.remove('translate-x-full'));
        
        setTimeout(() => {
            toast.classList.add('animate-out', 'fade-out');
            setTimeout(() => toast.remove(), 300);
        }, 3500);
    };

    // 3. SAVE event (AJAX)
    window.saveevent = function(id) {
        const btn = event.target.closest('button');
        const originalHTML = btn.innerHTML;
        
        // Loading state
        btn.innerHTML = '<svg class="w-5 h-5 animate-spin" fill="none" cx="12" cy="12" r="10" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></svg> Menyimpan...';
        btn.disabled = true;
        
        fetch(`/user/event/${id}/save`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                btn.innerHTML = '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg> Tersimpan!';
                setTimeout(() => btn.innerHTML = originalHTML, 2000);
            } else {
                showToast('Gagal menyimpan event!', 'error');
                btn.innerHTML = originalHTML;
            }
        })
        .catch(() => {
            showToast('Error koneksi!', 'error');
            btn.innerHTML = originalHTML;
        })
        .finally(() => btn.disabled = false);
    };
});
</script>

@endsection
