<!DOCTYPE html>
<html lang="id" :class="{ 'dark': $store.darkMode.on }" x-data>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'HIMANIKKA - Admin')</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/favicon.png') }}">
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body class="min-h-screen antialiased bg-gradient-to-br from-slate-50/80 via-white to-slate-50/80 dark:from-slate-900/80 dark:to-slate-800 transition-colors duration-300 scrollbar-thin scrollbar-thumb-slate-300/50 dark:scrollbar-thumb-slate-600/50">
    
    {{-- Mobile Menu Toggle --}}
    <div class="lg:hidden fixed top-4 left-4 z-[99]" x-data="{ open: false }" @click.outside="open = false">
        <button 
            @click="open = !open; $dispatch('sidebar-toggle', open)"
            aria-label="Toggle menu"
            class="p-2.5 rounded-xl bg-white/95 dark:bg-slate-900/95 backdrop-blur-xl shadow-xl border border-slate-200/50 dark:border-slate-800/50 text-slate-700 dark:text-slate-300 hover:bg-white dark:hover:bg-slate-900 hover:shadow-2xl transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <i class="fas fa-bars text-lg"></i>
        </button>
    </div>

    {{-- Mobile Overlay --}}
    <div x-data="{ open: false }" 
         x-show="open" 
         x-transition:enter="transition ease-out duration-200" 
         x-transition:enter-start="opacity-0" 
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         @click="open = false" 
         class="fixed inset-0 bg-black/40 backdrop-blur-sm z-40 lg:hidden"
         x-cloak
         aria-hidden="true"></div>

    {{-- Main Layout --}}
    <div class="flex h-screen overflow-hidden">
        @include('partials.sidebar')
        
        <div class="flex-1 flex flex-col overflow-hidden lg:ml-0 transition-all duration-300">
            <main class="flex-1 overflow-y-auto p-5 lg:p-7" id="main-content">
                
                {{-- Header --}}
                <header class="mb-8 pb-6 border-b border-slate-200/40 dark:border-slate-700/60">
                    <nav class="flex mb-5" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center gap-1.5 text-xs font-medium text-slate-500 dark:text-slate-400 bg-white/70 dark:bg-slate-900/70 px-4 py-2 rounded-xl backdrop-blur-xl border border-slate-200/40 dark:border-slate-700/40 shadow-sm">
                            <li>
                                <a href="{{ route('admin.dashboard.index') }}" 
                                   class="flex items-center p-2 rounded-lg hover:text-blue-600 hover:bg-blue-50/60 dark:hover:bg-blue-900/30 transition-all duration-200">
                                    <i class="fas fa-home w-4 h-4 mr-2" aria-hidden="true"></i>
                                    Dashboard
                                </a>
                            </li>
                            <li><i class="fas fa-chevron-right text-slate-400 w-4 h-4 mx-1.5" aria-hidden="true"></i></li>
                            <li aria-current="page">
                                <span class="font-semibold text-slate-900 dark:text-slate-100 px-3 py-2 rounded-lg bg-gradient-to-r from-blue-500/10 to-blue-600/10 border border-blue-200/40 dark:border-blue-800/40">
                                    @yield('title', 'Dashboard')
                                </span>
                            </li>
                        </ol>
                    </nav>

                    <div class="grid grid-cols-1 lg:grid-cols-5 gap-6 items-start lg:items-center">
                        <div class="lg:col-span-3 space-y-3">
                            <h1 class="text-3xl lg:text-4xl font-black bg-gradient-to-r from-slate-900 via-slate-700 to-slate-900 dark:from-white dark:via-slate-200 dark:to-white bg-clip-text text-transparent leading-tight">
                                @yield('title', 'Dashboard HIMANIKKA')
                            </h1>
                            @if (auth()->user()->role === 'Super Admin')
                            @else
                                <p class="text-lg text-slate-600 dark:text-slate-400 font-medium">
                                    Selamat datang kembali, <strong class="text-slate-900 dark:text-white">{{ ucfirst(auth()->user()->name ?? 'Admin') }}</strong>
                                </p>
                            @endif
                        </div>

                        <div class="lg:col-span-1 text-right bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl p-5 rounded-2xl border border-slate-200/50 dark:border-slate-700/50 shadow-lg" 
                             aria-label="Jam dan tanggal saat ini">
                            <div class="text-2xl font-black text-slate-900 dark:text-white tracking-wider mb-1" 
                                 x-text="$store?.clock?.time || '00:00'"
                                 aria-live="polite"></div>
                            <div class="text-sm text-slate-500 dark:text-slate-400 font-mono tracking-wide flex items-center justify-end gap-1">
                                <i class="fas fa-calendar-day text-xs" aria-hidden="true"></i>
                                <span x-text="$store?.clock?.date || 'Jan 1, 2026'" aria-live="polite"></span>
                            </div>
                        </div>

                        {{-- USER STATUS - FIXED! --}}
                        <div class="lg:col-span-1 text-right">
                            <div class="w-14 h-14 mx-auto lg:mx-0 rounded-2xl bg-gradient-to-br from-emerald-500 via-emerald-600 to-teal-600 shadow-xl flex items-center justify-center mb-3 lg:mb-0 border-4 border-white/30 dark:border-slate-900/50" 
                                 role="img" 
                                 aria-label="Avatar {{ auth()->user()->name }}">
                                @if(auth()->user()->avatar)
                                    <picture>
                                        <img src="{{ asset('storage/' . auth()->user()->avatar) }}" 
                                             alt="Foto profil {{ auth()->user()->name }}" 
                                             class="w-full h-full rounded-xl object-cover shadow-2xl"
                                             loading="lazy"
                                             onerror="this.style.display='none'; this.parentElement.querySelector('.fallback-avatar').style.display='flex'">
                                        <div class="fallback-avatar w-full h-full bg-white/20 backdrop-blur-sm flex items-center justify-center rounded-xl hidden absolute inset-0">
                                            <span class="text-lg font-black text-white tracking-wider">
                                                {{ strtoupper(substr(auth()->user()->name ?? 'ADMIN', 0, 2)) }}
                                            </span>
                                        </div>
                                    </picture>
                                @else
                                    <span class="text-lg font-black text-white tracking-wider">
                                        {{ strtoupper(substr(auth()->user()->name ?? 'ADMIN', 0, 2)) }}
                                    </span>
                                @endif
                            </div>
                            <div class="space-y-1">
                                <div class="text-xs font-bold text-emerald-600 dark:text-emerald-400 uppercase tracking-wide flex items-center justify-end lg:justify-start gap-1">
                                    <div class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse" aria-hidden="true"></div>
                                    {{ ucfirst(auth()->user()->role ?? 'Super Admin') }}
                                </div>
                                <div class="text-sm font-semibold text-slate-900 dark:text-white truncate max-w-[140px]">
                                    {{ substr(auth()->user()->name ?? 'Admin', 0, 16) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </header>

                @yield('content')
            </main>
        </div>
    </div>

    {{-- Scroll to Top --}}
    <button id="scroll-top-btn"
            class="fixed bottom-6 right-6 w-12 h-12 bg-gradient-to-r from-blue-600 to-emerald-600 
                   hover:from-blue-700 hover:to-emerald-700 text-white rounded-2xl shadow-2xl 
                   hover:shadow-3xl flex items-center justify-center text-xl transition-all duration-300 
                   z-[99] hidden sm:flex hover:scale-110 active:scale-95 opacity-0 translate-y-10 
                   dark:from-blue-500 dark:to-emerald-500"
            aria-label="Kembali ke atas">
        <i class="fas fa-chevron-up" aria-hidden="true"></i>
    </button>

    {{-- GLOBAL MODAL --}}
    <div x-data x-show="$store?.modal?.isOpen || false"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 backdrop-blur-none scale-105"
         x-transition:enter-end="opacity-100 backdrop-blur-sm scale-100"
         @keydown.escape.window="$store?.modal?.close()"
         class="fixed inset-0 z-[9999] flex items-center justify-center p-4"
         x-cloak
         role="dialog"
         aria-modal="true">
        
        <div x-show="$store?.modal?.isOpen"
             x-transition:enter="transition ease-out duration-200"
             class="absolute inset-0 bg-black/60 backdrop-blur-sm"
             @click="$store.modal.close()"
             aria-hidden="true"></div>
        
        <div x-show="$store?.modal?.isOpen"
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="opacity-0 scale-105 translate-y-8"
             class="relative bg-white/98 dark:bg-slate-900/98 backdrop-blur-2xl rounded-3xl shadow-2xl 
                    border border-slate-200/60 dark:border-slate-700/60 w-full max-w-4xl max-h-[90vh] 
                    overflow-hidden mx-4">
            <div x-html="$store.modal.content" 
                 class="p-6 md:p-8 h-[70vh] overflow-y-auto scrollbar-thin scrollbar-thumb-slate-300/50 dark:scrollbar-thumb-slate-600/50"></div>
        </div>
    </div>

    {{-- Custom Styles --}}
    <style>
        .scrollbar-thin::-webkit-scrollbar { width: 6px; height: 6px; }
        .scrollbar-thin::-webkit-scrollbar-track { background: transparent; }
        .scrollbar-thin::-webkit-scrollbar-thumb { 
            background: rgba(148, 163, 184, 0.6); border-radius: 3px; 
        }
        .scrollbar-thin::-webkit-scrollbar-thumb:hover { background: rgba(148, 163, 184, 0.9); }
        @keyframes spin { to { transform: rotate(360deg); } }
        .fa-spin { animation: spin 1s linear infinite; }
        [x-cloak] { display: none !important; }
    </style>

    {{-- Alpine Stores --}}
    <script defer>
    document.addEventListener('alpine:init', () => {
        Alpine.store('modal', {
            isOpen: false, content: '', loading: false,
            open(content) { this.content = content; this.isOpen = true; },
            close() { this.isOpen = false; this.content = ''; }
        });

        if (!Alpine.store('clock')) {
            Alpine.store('clock', {
                time: '00:00', date: 'Jan 1, 2026',
                init() {
                    this.update();
                    setInterval(() => this.update(), 1000);
                },
                update() {
                    const now = new Date();
                    this.time = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', hour12: false });
                    this.date = now.toLocaleDateString('id-ID', { weekday: 'short', year: 'numeric', month: 'short', day: 'numeric' });
                }
            });
            Alpine.store('clock').init();
        }

        if (!Alpine.store('darkMode')) {
            Alpine.store('darkMode', {
                on: localStorage.getItem('darkMode') === 'true',
                init() {
                    if (localStorage.getItem('darkMode') === null) {
                        this.on = window.matchMedia('(prefers-color-scheme: dark)').matches;
                    }
                    document.documentElement.classList.toggle('dark', this.on);
                },
                toggle() {
                    this.on = !this.on;
                    localStorage.setItem('darkMode', this.on);
                    document.documentElement.classList.toggle('dark', this.on);
                }
            });
            Alpine.store('darkMode').init();
        }

        // Scroll to top
        const scrollBtn = document.getElementById('scroll-top-btn');
        if (scrollBtn) {
            window.addEventListener('scroll', () => {
                scrollBtn.classList.toggle('opacity-100', window.scrollY > 300);
                scrollBtn.classList.toggle('opacity-0', window.scrollY <= 300);
            });
            scrollBtn.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
        }

        console.log('✅ Alpine Stores LOADED - NO ERRORS!');
    });
    </script>

    <script>window.Laravel = { csrfToken: document.querySelector('meta[name="csrf-token"]').content };</script>
    @stack('scripts')
</body>
</html>
