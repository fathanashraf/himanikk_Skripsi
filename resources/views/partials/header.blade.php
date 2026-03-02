<nav class="bg-white/80 dark:bg-slate-900/90 backdrop-blur shadow-lg border-b border-slate-200 dark:border-slate-700 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            {{-- Logo --}}
            <a href="/" class="flex items-center gap-3">
                <img src="{{ asset('assets/logohima-.png') }}" alt="HIMANIKKA" class="w-10 h-10">
                <span class="text-xl font-bold text-slate-900 dark:text-white">HIMANIKKA</span>
            </a>

            {{-- Mobile button --}}
            <button x-data="{ open: false }" @click="open = !open" 
                    class="lg:hidden p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                <i class="fas fa-bars text-xl text-slate-700 dark:text-slate-300"></i>
            </button>

            {{-- Desktop menu --}}
            <div class="hidden lg:flex items-center gap-8">
                <a href="{{ route('user.dashboard.index') }}" class="px-3 py-2 text-slate-700 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 font-medium rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 transition-all">Dashboard</a>
                
                {{-- Dropdown 1 --}}
                <div class="relative group">
                    <button class="px-3 py-2 text-slate-700 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 font-medium rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 flex items-center gap-1 transition-all">
                        Tentang Kami <i class="fas fa-chevron-down text-sm"></i>
                    </button>
                    <div class="absolute top-full left-0 mt-1 w-48 bg-white dark:bg-slate-800 shadow-lg rounded-lg border border-slate-200 dark:border-slate-700 py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-50">
                        <a href="#profil" class="flex items-center px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700"><i class="fas fa-users mr-3 text-blue-500"></i>HIMANIKKA</a>
                        <a href="#struktur" class="flex items-center px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700"><i class="fas fa-sitemap mr-3 text-blue-500"></i>Struktur</a>
                        <a href="/legalitas" class="flex items-center px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700"><i class="fas fa-file mr-3 text-blue-500"></i>Legalitas</a>
                    </div>
                </div>

                {{-- Dropdown 2 --}}
                <div class="relative group">
                    <button class="px-3 py-2 text-slate-700 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 font-medium rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 flex items-center gap-1 transition-all">
                        Informasi <i class="fas fa-chevron-down text-sm"></i>
                    </button>
                    <div class="absolute top-full left-0 mt-1 w-48 bg-white dark:bg-slate-800 shadow-lg rounded-lg border border-slate-200 dark:border-slate-700 py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-50">
                        <a href="#kegiatan" class="flex items-center px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700"><i class="fas fa-calendar mr-3 text-blue-500"></i>Kegiatan</a>
                        <a href="#acara" class="flex items-center px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700"><i class="fas fa-megaphone mr-3 text-blue-500"></i>Acara</a>
                        <a href="#event" class="flex items-center px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700"><i class="fas fa-ticket mr-3 text-blue-500"></i>Event</a>
                    </div>
                </div>

                <a href="#masukkan" class="px-3 py-2 text-slate-700 dark:text-slate-300 hover:text-blue-600 dark:hover:text-blue-400 font-medium rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 transition-all">Masukan</a>
            </div>

            {{-- Right side --}}
            <div class="flex items-center gap-2">
                {{-- Search --}}
                <div class="hidden md:block relative">
                    <input type="text" placeholder="Search..." class="w-64 pl-10 pr-3 h-10 rounded-lg border border-slate-200 dark:border-slate-600 bg-white/50 dark:bg-slate-800/50 text-slate-900 dark:text-slate-200 placeholder-slate-400 dark:placeholder-slate-500 focus:border-blue-500 dark:focus:border-blue-400 focus:outline-none transition-all">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 dark:text-slate-500"></i>
                </div>

                {{-- Notifications --}}
                <button class="p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 relative transition-colors">
                    <i class="fas fa-bell text-xl text-slate-700 dark:text-slate-300"></i>
                    @auth
                        @if(auth()->user()->unreadNotifications->count())
                            <span class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 dark:bg-red-400 text-white text-xs rounded-full flex items-center justify-center">!</span>
                        @endif
                    @endauth
                </button>

                {{-- Dark toggle --}}
                <button @click="document.documentElement.classList.toggle('dark')" class="p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors" title="Toggle dark mode">
                    <i class="fas fa-sun text-xl text-yellow-500 dark:hidden"></i>
                    <i class="fas fa-moon text-xl text-slate-400 hidden dark:block"></i>
                </button>

                {{-- Auth --}}
                @auth
                    <div class="ml-2 relative group">
                        <div class="w-9 h-9 bg-gradient-to-r from-blue-500 to-purple-600 dark:from-blue-600 dark:to-purple-700 rounded-full flex items-center justify-center text-white font-bold text-sm cursor-pointer hover:scale-105 transition-transform">
                            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                        </div>
                        {{-- User dropdown --}}
                        <div class="absolute top-full right-0 mt-2 w-48 bg-white dark:bg-slate-800 shadow-lg rounded-lg border border-slate-200 dark:border-slate-700 py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-50">
                            <a href="{{ route('profile.index') }}" class="flex items-center px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700">
                                <i class="fas fa-user mr-3"></i>Profile
                            </a>
                            <a href="{{ route('settings.index') }}" class="flex items-center px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700">
                                <i class="fas fa-cog mr-3"></i>Settings
                            </a>
                            <form method="POST" action="{{ route('auth.logout') }}" class="px-4 py-2">
                                @csrf
                                <button type="submit" class="w-full text-left text-sm text-slate-700 dark:text-slate-300 hover:bg-red-50 dark:hover:bg-red-900/50">
                                    <i class="fas fa-sign-out-alt mr-3"></i>Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="hidden lg:flex gap-2 ml-2">
                        <a href="{{ route('auth.login') }}" class="px-4 py-2 text-sm text-slate-700 dark:text-slate-300 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">Login</a>
                        <a href="{{ route('auth.register') }}" class="px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 dark:from-blue-600 dark:to-blue-700 text-white text-sm rounded-lg shadow hover:shadow-lg transform hover:-translate-y-0.5 transition-all">Daftar</a>
                    </div>
                @endauth
            </div>
        </div>
    </div>

    {{-- Mobile menu --}}
    <div x-show="open" x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="lg:hidden bg-white dark:bg-slate-900 border-t border-slate-200 dark:border-slate-700 shadow-lg" @click.away="open = false">
        <div class="p-6 space-y-1">
            {{-- Main links --}}
            <a href="{{ route('user.dashboard.index') }}" class="flex items-center py-3 px-4 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-300 transition-colors">
                <i class="fas fa-tachometer-alt mr-3 text-blue-500"></i><span class="font-medium">Dashboard</span>
            </a>

            {{-- Tentang Kami --}}
            <div class="pt-2">
                <div class="flex items-center py-3 px-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Tentang Kami</div>
                <a href="#profil" class="flex items-center py-2 px-6 ml-4 text-sm rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-300 transition-colors">
                    <i class="fas fa-users mr-3 text-blue-500"></i>HIMANIKKA
                </a>
                <a href="#struktur" class="flex items-center py-2 px-6 ml-4 text-sm rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-300 transition-colors">
                    <i class="fas fa-sitemap mr-3 text-blue-500"></i>Struktur
                </a>
                <a href="/legalitas" class="flex items-center py-2 px-6 ml-4 text-sm rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-300 transition-colors">
                    <i class="fas fa-file mr-3 text-blue-500"></i>Legalitas
                </a>
            </div>

            {{-- Informasi --}}
            <div class="pt-2">
                <div class="flex items-center py-3 px-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Informasi</div>
                <a href="#kegiatan" class="flex items-center py-2 px-6 ml-4 text-sm rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-300 transition-colors">
                    <i class="fas fa-calendar mr-3 text-blue-500"></i>Kegiatan
                </a>
                <a href="#acara" class="flex items-center py-2 px-6 ml-4 text-sm rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-300 transition-colors">
                    <i class="fas fa-chalkboard-teacher mr-3 text-blue-500"></i>Acara
                </a>
                <a href="#event" class="flex items-center py-2 px-6 ml-4 text-sm rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-300 transition-colors">
                    <i class="fas fa-ticket mr-3 text-blue-500"></i>Event
                </a>
            </div>

            <a href="#masukkan" class="flex items-center py-3 px-4 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-300 transition-colors">
                <i class="fas fa-comment mr-3 text-blue-500"></i><span class="font-medium">Masukan</span>
            </a>

            {{-- Divider --}}
            <div class="border-t border-slate-200 dark:border-slate-700 mx-4"></div>

            {{-- Right side mobile --}}
            <div class="pt-4 space-y-3">
                @auth
                    <a href="{{ route('profile.index') }}" class="flex items-center py-3 px-4 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800">
                        <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-xs mr-3">
                            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                        </div>
                        <div>
                            <div class="font-medium text-slate-900 dark:text-white">{{ auth()->user()->name }}</div>
                            <div class="text-xs text-slate-500 dark:text-slate-400">{{ auth()->user()->email }}</div>
                        </div>
                    </a>
                @endauth

                <div class="flex gap-2 p-2">
                    <button @click="document.documentElement.classList.toggle('dark')" class="flex-1 p-3 rounded-xl border border-slate-200 dark:border-slate-700 text-center hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                        <i class="fas fa-sun text-lg text-yellow-500 dark:hidden"></i>
                        <i class="fas fa-moon text-lg text-slate-400 hidden dark:block"></i>
                        <span class="text-xs text-slate-500 dark:text-slate-400 block mt-1">Mode</span>
                    </button>
                    @guest
                        <a href="{{ route('auth.login') }}" class="flex-1 px-4 py-3 bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 rounded-xl text-center hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors">
                            <i class="fas fa-sign-in-alt text-lg mb-1 block"></i>
                            <span class="text-xs font-medium block">Login</span>
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</nav>
