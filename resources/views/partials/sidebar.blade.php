{{-- SIDEBAR - FIXED & RESPONSIVE --}}
<aside class="fixed inset-y-0 left-0 z-50 w-64 
              bg-white/95 dark:bg-slate-900/95 
              backdrop-blur-xl 
              shadow-2xl 
              border-r border-slate-200/50 dark:border-slate-800/50 
              transform -translate-x-full lg:translate-x-0 
              transition-transform duration-300 ease-in-out lg:static"
     x-data="{ mobileOpen: false }"
     x-init="$watch('mobileOpen', value => $dispatch('sidebar-toggle', value))"
     x-on:sidebar-toggle.window="mobileOpen = $event.detail"
     x-show="mobileOpen || window.innerWidth >= 1024"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="-translate-x-full"
     x-transition:enter-end="translate-x-0"
     @keydown.escape.window="mobileOpen = false"
     @click.away="mobileOpen = false">

    {{-- Sidebar Content --}}
    <div class="h-full flex flex-col">
        <!-- Header -->
        <div class="p-6 border-b border-slate-200/50 dark:border-slate-800/50 
                    sticky top-0 
                    bg-white/90 dark:bg-slate-900/90 
                    backdrop-blur-sm z-20">
            <div class="flex items-center justify-between">
                <a href="#" class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-primary-500 rounded-xl flex items-center justify-center shadow-lg border-2 border-primary-500/30">
                        <img src="{{ asset('assets/logohima-.png') }}" alt="HIMANIKKA" class="w-10 h-10 object-contain">
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-slate-900 dark:text-slate-100">HIMANIKKA</h1>
                        <span class="text-xs font-medium text-slate-500 dark:text-slate-400">Dashboard</span>
                    </div>
                </a>
                <button @click="mobileOpen = false" class="lg:hidden p-2 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                    <i class="fas fa-times text-xl text-slate-600 dark:text-slate-300"></i>
                </button>
            </div>
        </div>

        <!-- Scrollable Navigation -->
        <div class="flex-1 overflow-y-auto py-6 px-4 space-y-4">
            <!-- Search -->
            <div class="relative">
                <input type="text" placeholder="Cari..." 
                       class="w-full pl-11 pr-4 h-12 
                              bg-white/50 dark:bg-slate-800/50 
                              border border-slate-200/50 dark:border-slate-700/50 
                              text-slate-900 dark:text-slate-100 
                              placeholder-slate-500 dark:placeholder-slate-400
                              rounded-xl focus:ring-2 focus:ring-primary-500/20 
                              focus:border-primary-500/50
                              transition-all">
                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 
                         text-slate-500 dark:text-slate-400"></i>
            </div>

            <!-- Navigation Menu -->
            <nav class="space-y-2">
                <!-- Active Dashboard -->
                <a href="{{ route('admin.dashboard.index') }}" 
   class="flex items-center p-3 rounded-xl 
          bg-blue-50 dark:bg-blue-900/20 
          text-blue-800 dark:text-blue-200 
          font-semibold 
          hover:bg-blue-500 hover:text-white 
          hover:shadow-md
          transition-all">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
  <path d="M11.47 3.841a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 0 1.06-1.061l-8.689-8.69a2.25 2.25 0 0 0-3.182 0l-8.69 8.69a.75.75 0 1 0 1.061 1.06l8.69-8.689Z" />
  <path d="m12 5.432 8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 0 1-.75-.75v-4.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75V21a.75.75 0 0 1-.75.75H5.625a1.875 1.875 0 0 1-1.875-1.875v-6.198a2.29 2.29 0 0 0 .091-.086L12 5.432Z" />
</svg>
 
    <span class="ml-3">Dashboard</span>
</a>


                <!-- Section Headers -->
                <div class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider p-2">Tentang HIMANIKKA</div>
                
                <!-- Nav Items -->
                <a href="{{route('admin.tentang.index')}}" class="flex items-center p-3 rounded-xl 
                                                             hover:bg-slate-100 dark:hover:bg-slate-800/50 
                                                             hover:text-slate-900 dark:hover:text-slate-100
                                                             hover:shadow-sm
                                                             group transition-all
                                                             text-slate-700 dark:text-slate-200">
                    <i class="fas fa-users w-5 mr-3 text-slate-500 dark:text-slate-400 group-hover:text-slate-600 dark:group-hover:text-slate-200"></i> 
                    HIMANIKKA
                </a>
                <a href="{{route('admin.struktur.index')}}" class="flex items-center p-3 rounded-xl 
                                                                 hover:bg-slate-100 dark:hover:bg-slate-800/50 
                                                                 hover:text-slate-900 dark:hover:text-slate-100
                                                                 hover:shadow-sm
                                                                 group transition-all
                                                                 text-slate-700 dark:text-slate-200">
                    <i class="fas fa-shield-alt w-5 mr-3 text-slate-500 dark:text-slate-400 group-hover:text-slate-600 dark:group-hover:text-slate-200"></i> 
                    Struktur
                </a>
                <a href="{{route('admin.legalitas.index')}}" class="flex items-center p-3 rounded-xl 
                                                                  hover:bg-slate-100 dark:hover:bg-slate-800/50 
                                                                  hover:text-slate-900 dark:hover:text-slate-100
                                                                  hover:shadow-sm
                                                                  group transition-all
                                                                  text-slate-700 dark:text-slate-200">
                    <i class="fas fa-newspaper w-5 mr-3 text-slate-500 dark:text-slate-400 group-hover:text-slate-600 dark:group-hover:text-slate-200"></i> 
                    Legalitas
                </a>

                <div class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider p-2">Informasi</div>
                <a href="{{ route('admin.kegiatan.index') }}" class="flex items-center p-3 rounded-xl 
                                                                   hover:bg-slate-100 dark:hover:bg-slate-800/50 
                                                                   hover:text-slate-900 dark:hover:text-slate-100
                                                                   hover:shadow-sm
                                                                   group transition-all
                                                                   text-slate-700 dark:text-slate-200">
                    <i class="fas fa-calendar w-5 mr-3 text-slate-500 dark:text-slate-400 group-hover:text-slate-600 dark:group-hover:text-slate-200"></i> 
                    Kegiatan
                </a>
                <a href="{{ route('admin.acara.index') }}" class="flex items-center p-3 rounded-xl 
                                                                 hover:bg-slate-100 dark:hover:bg-slate-800/50 
                                                                 hover:text-slate-900 dark:hover:text-slate-100
                                                                 hover:shadow-sm
                                                                 group transition-all
                                                                 text-slate-700 dark:text-slate-200">
                    <i class="fas fa-newspaper w-5 mr-3 text-slate-500 dark:text-slate-400 group-hover:text-slate-600 dark:group-hover:text-slate-200"></i> 
                    Acara
                </a>
                <a href="{{ route('admin.events.index') }}" class="flex items-center p-3 rounded-xl 
                                                                 hover:bg-slate-100 dark:hover:bg-slate-800/50 
                                                                 hover:text-slate-900 dark:hover:text-slate-100
                                                                 hover:shadow-sm
                                                                 group transition-all
                                                                 text-slate-700 dark:text-slate-200">
                    <i class="fas fa-calendar w-5 mr-3 text-slate-500 dark:text-slate-400 group-hover:text-slate-600 dark:group-hover:text-slate-200"></i> 
                    Events
                </a>

                <div class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider p-2">Laporan</div>
                <a href="{{ route('admin.laporan.index') }}" class="flex items-center p-3 rounded-xl 
                                         hover:bg-slate-100 dark:hover:bg-slate-800/50 
                                         hover:text-slate-900 dark:hover:text-slate-100
                                         hover:shadow-sm
                                         group transition-all
                                         text-slate-700 dark:text-slate-200">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path fill-rule="evenodd" d="M7.502 6h7.128A3.375 3.375 0 0 1 18 9.375v9.375a3 3 0 0 0 3-3V6.108c0-1.505-1.125-2.811-2.664-2.94a48.972 48.972 0 0 0-.673-.05A3 3 0 0 0 15 1.5h-1.5a3 3 0 0 0-2.663 1.618c-.225.015-.45.032-.673.05C8.662 3.295 7.554 4.542 7.502 6ZM13.5 3A1.5 1.5 0 0 0 12 4.5h4.5A1.5 1.5 0 0 0 15 3h-1.5Z" clip-rule="evenodd" />
                        <path fill-rule="evenodd" d="M3 9.375C3 8.339 3.84 7.5 4.875 7.5h9.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 0 1 3 20.625V9.375ZM6 12a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H6.75a.75.75 0 0 1-.75-.75V12Zm2.25 0a.75.75 0 0 1 .75-.75h3.75a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1-.75-.75ZM6 15a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H6.75a.75.75 0 0 1-.75-.75V15Zm2.25 0a.75.75 0 0 1 .75-.75h3.75a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1-.75-.75ZM6 18a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H6.75a.75.75 0 0 1-.75-.75V18Zm2.25 0a.75.75 0 0 1 .75-.75h3.75a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                    </svg>
                    <span class="ml-3">Laporan</span>
                </a>

                <div class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider p-2">Keuangan</div>
                <a href="{{ route('admin.keuangan.index') }}" class="flex items-center p-3 rounded-xl 
                                          hover:bg-slate-100 dark:hover:bg-slate-800/50 
                                          hover:text-slate-900 dark:hover:text-slate-100
                                          hover:shadow-sm
                                          group transition-all
                                          text-slate-700 dark:text-slate-200">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
  <path d="M10.464 8.746c.227-.18.497-.311.786-.394v2.795a2.252 2.252 0 0 1-.786-.393c-.394-.313-.546-.681-.546-1.004 0-.323.152-.691.546-1.004ZM12.75 15.662v-2.824c.347.085.664.228.921.421.427.32.579.686.579.991 0 .305-.152.671-.579.991a2.534 2.534 0 0 1-.921.42Z" />
  <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 6a.75.75 0 0 0-1.5 0v.816a3.836 3.836 0 0 0-1.72.756c-.712.566-1.112 1.35-1.112 2.178 0 .829.4 1.612 1.113 2.178.502.4 1.102.647 1.719.756v2.978a2.536 2.536 0 0 1-.921-.421l-.879-.66a.75.75 0 0 0-.9 1.2l.879.66c.533.4 1.169.645 1.821.75V18a.75.75 0 0 0 1.5 0v-.81a4.124 4.124 0 0 0 1.821-.749c.745-.559 1.179-1.344 1.179-2.191 0-.847-.434-1.632-1.179-2.191a4.122 4.122 0 0 0-1.821-.75V8.354c.29.082.559.213.786.393l.415.33a.75.75 0 0 0 .933-1.175l-.415-.33a3.836 3.836 0 0 0-1.719-.755V6Z" clip-rule="evenodd" />
</svg>

                    <span class="ml-3">Keuangan</span>
                </a>

                <div class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider p-2">Pendaftaran</div>
                <a href="{{ route('admin.pendaftaran.index') }}" class="flex items-center p-3 rounded-xl 
                                             hover:bg-slate-100 dark:hover:bg-slate-800/50 
                                             hover:text-slate-900 dark:hover:text-slate-100
                                             hover:shadow-sm
                                             group transition-all
                                             text-slate-700 dark:text-slate-200">
                    <i class="fas fa-user-plus w-5 mr-3 text-slate-500 dark:text-slate-400 group-hover:text-slate-600 dark:group-hover:text-slate-200"></i> 
                    Pendaftaran
                </a>

                <div class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider p-2">Masukkan</div>
                <a href="{{ route('admin.masukan.index') }}" class="flex items-center p-3 rounded-xl 
                                          hover:bg-slate-100 dark:hover:bg-slate-800/50 
                                          hover:text-slate-900 dark:hover:text-slate-100
                                          hover:shadow-sm
                                          group transition-all
                                          text-slate-700 dark:text-slate-200">
                   <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
  <path fill-rule="evenodd" d="M4.848 2.771A49.144 49.144 0 0 1 12 2.25c2.43 0 4.817.178 7.152.52 1.978.292 3.348 2.024 3.348 3.97v6.02c0 1.946-1.37 3.678-3.348 3.97-1.94.284-3.916.455-5.922.505a.39.39 0 0 0-.266.112L8.78 21.53A.75.75 0 0 1 7.5 21v-3.955a48.842 48.842 0 0 1-2.652-.316c-1.978-.29-3.348-2.024-3.348-3.97V6.741c0-1.946 1.37-3.68 3.348-3.97Z" clip-rule="evenodd" />
</svg>

                    <span class="ml-3">Masukan</span>   
                </a>
            </nav>
        </div>

        <!-- User Footer - FIXED COLOR HIERARCHY -->
        @auth
        <div class="p-4 border-t border-slate-200/50 dark:border-slate-800/50 
                    bg-gradient-to-t from-slate-50/80 via-white/90 dark:from-slate-900/80 dark:via-slate-900/90 
                    backdrop-blur-sm sticky bottom-0 z-20">
            
            <div x-data="{ profileOpen: false }" @click.outside="profileOpen = false" class="relative">
                
                <!-- Profile Button -->
                <button @click="profileOpen = !profileOpen"
                        class="w-full flex items-center gap-4 p-4 rounded-2xl 
                               hover:bg-slate-100/50 dark:hover:bg-slate-800/50 
                               transition-all group duration-200 
                               border border-slate-200/30 dark:border-slate-700/30 
                               hover:border-slate-300/50 dark:hover:border-slate-600/50 
                               hover:shadow-md">
                    
                    <!-- Avatar -->
                    <div class="relative flex-shrink-0">
                        @if(auth()->user()->avatar)
                            <img src="{{ asset('storage/' . auth()->user()->avatar) }}" 
                                 alt="{{ auth()->user()->name }}" 
                                 class="w-12 h-12 rounded-2xl object-cover ring-2 ring-white/50 shadow-lg 
                                        group-hover:scale-105 transition-transform duration-200 
                                        border-4 border-white/20 dark:border-slate-900/50" 
                                 loading="lazy" />
                        @else
                            <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-primary-500 via-primary-500/90 to-primary-600 
                                        flex items-center justify-center text-white font-bold text-lg shadow-lg 
                                        ring-2 ring-white/50 group-hover:scale-105 transition-transform duration-200 
                                        border-4 border-white/20 dark:border-slate-900/50">
                                {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                            </div>
                        @endif
                        
                        <!-- Online Status -->
                        <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-emerald-400 border-3 border-white/90 dark:border-slate-900 rounded-full shadow-lg ring-2 ring-white/50 animate-pulse"></div>
                    </div>
                    
                    <!-- User Info - FIXED COLORS -->
                    <div class="min-w-0 flex-1 text-left">
                        <p class="font-semibold text-sm text-slate-900 dark:text-slate-100 truncate group-hover:text-primary-600 transition-colors">
                            {{ auth()->user()->name }}
                        </p>
                        <p class="text-xs font-medium text-emerald-600 dark:text-emerald-400 truncate 
                                 bg-emerald-100/50 dark:bg-emerald-900/30 px-2 py-0.5 rounded-full">
                            {{ ucfirst(auth()->user()->role->name_role ?? 'Admin') }}
                        </p>
                        @if(auth()->user()->email_verified_at)
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5 flex items-center gap-1">
                                <i class="fas fa-check-circle text-emerald-400 text-xs"></i>
                                Verified
                            </p>
                        @endif
                    </div>
                    
                    <!-- Chevron -->
                    <i class="fas fa-chevron-down text-slate-500 dark:text-slate-400 
                             group-hover:text-slate-700 dark:group-hover:text-slate-200 
                             ml-auto transition-transform duration-200 
                             transition-colors" 
                       :class="{ 'rotate-180': profileOpen }"></i>
                </button>
                
                <!-- Profile Dropdown -->
                <div x-show="profileOpen"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 translate-y-1 -scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                     x-transition:leave-end="opacity-0 translate-y-1 scale-95"
                     x-cloak
                     class="absolute bottom-full left-0 mb-2 w-72 
                            bg-white/95 dark:bg-slate-900/95 
                            backdrop-blur-xl shadow-2xl rounded-2xl 
                            border border-slate-200/50 dark:border-slate-700/50 
                            py-2 z-50 overflow-hidden">
                    
                    <!-- Profile Header -->
                    <div class="px-5 py-4 border-b border-slate-200/30 dark:border-slate-700/50 
                                bg-gradient-to-r from-slate-50/80 to-transparent dark:from-slate-900/50">
                        <div class="flex items-center gap-3">
                            <div class="w-14 h-14 rounded-2xl ring-2 ring-white/30 shadow-lg 
                                        bg-gradient-to-br from-primary-500 to-primary-600 
                                        flex items-center justify-center flex-shrink-0">
                                @if(auth()->user()->avatar)
                                    <img src="{{ asset('storage/' . auth()->user()->avatar) }}" 
                                         class="w-14 h-14 rounded-2xl object-cover" />
                                @else
                                    <span class="text-white font-bold text-xl leading-none">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</span>
                                @endif
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="font-bold text-slate-900 dark:text-slate-100 truncate text-base">{{ auth()->user()->name }}</p>
                                <p class="text-sm text-slate-500 dark:text-slate-400 truncate">{{ auth()->user()->email }}</p>
                                <p class="text-xs font-semibold text-emerald-600 dark:text-emerald-400">
                                    {{ ucfirst(auth()->user()->role->name_role ?? 'Admin') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Quick Actions -->
                    <div class="space-y-1 p-2 grid grid-cols-1 gap-1">
                        <a href="{{ route('profile.index') }}" 
                           class="group flex items-center w-full px-4 py-3 text-sm rounded-xl font-medium 
                                  text-slate-700 dark:text-slate-200 
                                  hover:bg-slate-100 dark:hover:bg-slate-800/50 
                                  hover:text-slate-900 dark:hover:text-slate-100 
                                  transition-all duration-200">
                            <i class="fas fa-user w-5 mr-3 text-slate-500 dark:text-slate-400 
                                     group-hover:text-primary-500 transition-colors"></i>
                            Profile
                        </a>
                        
                        <a href="{{ route('settings.index') }}" 
                           class="group flex items-center w-full px-4 py-3 text-sm rounded-xl font-medium 
                                  text-slate-700 dark:text-slate-200 
                                  hover:bg-slate-100 dark:hover:bg-slate-800/50 
                                  hover:text-slate-900 dark:hover:text-slate-100 
                                  transition-all duration-200">
                            <i class="fas fa-cog w-5 mr-3 text-slate-500 dark:text-slate-400 
                                     group-hover:text-primary-500 transition-colors"></i>
                            Settings
                        </a>
                        
                        {{-- Notifications Button --}}
<a href="#" 
   class="group flex items-center w-full px-4 py-3 text-sm rounded-xl font-medium 
          text-slate-700 dark:text-slate-200 
          hover:bg-slate-100 dark:hover:bg-slate-800/50 
          hover:text-slate-900 dark:hover:text-slate-100 
          transition-all duration-200 relative"
   onclick="openNotificationsModal(); return false;">
    
    <i class="fas fa-bell w-5 mr-3 text-slate-500 dark:text-slate-400 
              group-hover:text-blue-500 transition-colors"></i>
    Notifications
    
    {{-- Badge --}}
    @php $unreadCount = auth()->user()->unreadNotifications()->count(); @endphp
    @if($unreadCount > 0)
        <span class="ml-auto px-2 py-1 bg-red-500 dark:bg-red-600 text-white text-xs rounded-full font-bold shadow-sm min-w-[1.5rem] h-6 flex items-center justify-center animate-pulse">
            {{ $unreadCount > 99 ? '99+' : $unreadCount }}
        </span>
    @endif
</a>

{{-- Notification Modal --}}
<div id="notifications-modal" class="fixed inset-0 bg-black/50 dark:bg-black/60 backdrop-blur-sm z-50 hidden items-center justify-center p-4" 
     onclick="this.style.display='none'">
    
    <div class="bg-white/95 dark:bg-slate-900/95 backdrop-blur-xl rounded-3xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-hidden border border-slate-200/50 dark:border-slate-700/50 mx-4"
         onclick="event.stopPropagation()">
        
        {{-- Header --}}
        <div class="p-6 border-b border-slate-200/50 dark:border-slate-700/50 sticky top-0 bg-white/90 dark:bg-slate-900/90 z-10">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-2xl font-bold text-slate-900 dark:text-slate-100 flex items-center gap-3">
                        <i class="fas fa-bell text-blue-500"></i>
                        Notifikasi
                    </h3>
                    <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                        {{ $unreadCount }} notifikasi belum dibaca
                    </p>
                </div>
                <div class="flex items-center gap-2">
                    <button onclick="fetchNotifications()" 
                            class="p-2 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-xl transition-all"
                            title="Refresh">
                        <i class="fas fa-arrow-rotate-right text-slate-400 hover:text-slate-600 dark:hover:text-slate-300"></i>
                    </button>
                    <button onclick="closeNotificationsModal()" 
                            class="p-3 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-2xl transition-all ml-2"
                            title="Tutup">
                        <i class="fas fa-times text-xl text-slate-500 dark:text-slate-400"></i>
                    </button>
                </div>
            </div>
        </div>
        
        {{-- Content --}}
        <div class="p-6 max-h-[60vh] overflow-y-auto">
            <div id="modal-notification-list" class="space-y-4">
                {{-- Loading --}}
                <div id="notification-loading" class="text-center py-12">
                    <div class="w-20 h-20 bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-xl">
                        <i class="fas fa-spinner fa-spin text-2xl text-white"></i>
                    </div>
                    <p class="text-lg font-semibold text-slate-700 dark:text-slate-200">Memuat notifikasi...</p>
                </div>
            </div>
        </div>
        
        {{-- Footer --}}
        <div class="p-6 border-t border-slate-200/50 dark:border-slate-700/50 bg-gradient-to-t from-slate-50/80 dark:from-slate-900/80">
            <div class="flex items-center justify-between gap-3 text-sm">
                <span class="text-slate-500 dark:text-slate-400">Tandai semua sebagai dibaca</span>
                <div class="flex items-center gap-2">
                    <a href="#" 
                       class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-400 text-white font-semibold rounded-2xl shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all duration-200 whitespace-nowrap">
                        Lihat Semua
                    </a>
                    <button onclick="markAllAsRead()" 
                            class="px-4 py-2.5 bg-emerald-100 dark:bg-emerald-900/50 hover:bg-emerald-200 dark:hover:bg-emerald-800/50 text-emerald-700 dark:text-emerald-300 font-semibold rounded-xl shadow-sm hover:shadow-md transition-all duration-200 border border-emerald-200 dark:border-emerald-800/50">
                        <i class="fas fa-check-double mr-1"></i> Tandai Selesai
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>



                        <!-- Dark Mode Toggle - FIXED -->
                        <div x-data="{ darkMode: localStorage.theme === 'dark' }" 
                             class="group flex items-center w-full px-4 py-3 text-sm rounded-xl font-medium cursor-pointer select-none 
                                    text-slate-700 dark:text-slate-200 
                                    hover:bg-slate-100 dark:hover:bg-slate-800/50 
                                    hover:text-slate-900 dark:hover:text-slate-100 
                                    transition-all duration-200 relative"
                             @click="
                                document.documentElement.classList.toggle('dark');
                                const isDark = document.documentElement.classList.contains('dark');
                                localStorage.theme = isDark ? 'dark' : 'light';
                                $dispatch('dark-mode-toggled', isDark);
                                darkMode = isDark;
                             ">
                            <div class="relative flex items-center w-5 h-5 mr-3 flex-shrink-0">
                                <i class="fas fa-sun text-lg text-amber-400 dark:hidden absolute inset-0 transition-all duration-300"></i>
                                <i class="fas fa-moon text-lg text-slate-400 hidden dark:block absolute inset-0 transition-all duration-300"></i>
                                <div class="absolute w-4 h-4 bg-white/80 dark:bg-slate-900/80 rounded-full shadow-sm 
                                            ring-1 ring-slate-300/50 dark:ring-slate-700/50 transform transition-all duration-300"
                                     :class="{
                                        '-translate-x-0.5 translate-y-0.5 rotate-0 scale-100 opacity-100': !darkMode,
                                        'translate-x-4 -translate-y-0.5 rotate-180 scale-75 opacity-0': darkMode
                                     }">
                                </div>
                            </div>
                            <div class="flex items-center justify-between flex-1">
                                <div>
                                    <span class="font-medium">Mode</span>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5 opacity-75">Toggle light/dark mode</p>
                                </div>
                            </div>
                        </div>
                        
                        <hr class="border-slate-200/50 dark:border-slate-700/50 mx-3 my-2">
                        
                        <form method="POST" action="{{ route('auth.logout') }}" class="w-full">
                            @csrf
                            <button type="submit"
                                    class="group flex items-center w-full px-4 py-3 text-sm rounded-xl font-medium 
                                           text-red-600 dark:text-red-400 
                                           hover:bg-red-50 dark:hover:bg-red-900/30 
                                           hover:text-red-700 dark:hover:text-red-300 
                                           transition-all duration-200">
                                <i class="fas fa-sign-out-alt w-5 mr-3 text-red-400 dark:text-red-500 
                                         group-hover:text-red-500 dark:group-hover:text-red-400 transition-colors"></i>
                                Sign Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endauth
    </div>
</aside>
<script>
let notificationsData = [];

// Buka modal
function openNotificationsModal() {
    document.getElementById('notifications-modal').style.display = 'flex';
    fetchNotifications();
}

// Tutup modal  
function closeNotificationsModal() {
    document.getElementById('notifications-modal').style.display = 'none';
}

// Fetch notifications
function fetchNotifications() {
    const container = document.getElementById('modal-notification-list');
    const loading = document.getElementById('notification-loading');
    
    loading.style.display = 'block';
    container.innerHTML = '';
    
    fetch('/api/notifications', {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        loading.style.display = 'none';
        notificationsData = data.notifications || [];
        renderNotifications(notificationsData);
    })
    .catch(error => {
        loading.style.display = 'none';
        container.innerHTML = `
            <div class="text-center py-12">
                <i class="fas fa-exclamation-triangle text-4xl text-red-500 mb-4"></i>
                <p class="text-lg font-semibold text-slate-700 dark:text-slate-200 mb-2">Gagal memuat notifikasi</p>
                <p class="text-sm text-slate-500 dark:text-slate-400">Cek koneksi internet dan coba lagi</p>
            </div>
        `;
        console.error('Error:', error);
    });
}

// Render notifications
function renderNotifications(notifications) {
    const container = document.getElementById('modal-notification-list');
    
    if (!notifications.length) {
        container.innerHTML = `
            <div class="text-center py-16">
                <div class="w-24 h-24 bg-slate-100 dark:bg-slate-800 rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                    <i class="fas fa-bell-slash text-3xl text-slate-400"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 dark:text-slate-100 mb-2">Tidak ada notifikasi</h3>
                <p class="text-slate-500 dark:text-slate-400">Semua notifikasi sudah dibaca</p>
            </div>
        `;
        return;
    }
    
    container.innerHTML = notifications.map(notification => {
        const isUnread = !notification.read_at;
        const data = notification.data;
        const time = new Date(notification.created_at).toLocaleString('id-ID', {
            day: 'numeric',
            month: 'short',
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
        
        return `
            <div class="group p-5 rounded-2xl border transition-all cursor-pointer 
                       ${isUnread ? 'bg-gradient-to-r from-blue-50/60 to-indigo-50/60 dark:from-blue-500/10 dark:to-indigo-500/10 border-blue-200/50 dark:border-blue-500/30 shadow-sm ring-2 ring-blue-100/50 dark:ring-blue-500/30' : 'bg-white/50 dark:bg-slate-800/30 border-slate-200/50 dark:border-slate-700/50 hover:bg-slate-50 dark:hover:bg-slate-700/50 hover:shadow-md'}"
                onclick="${isUnread ? `markNotificationAsRead(${notification.id}, this)` : data.action_url ? `window.open('${data.action_url}', '_blank')` : ''}">
                
                <div class="flex items-start gap-4">
                    <!-- Icon -->
                    <div class="flex-shrink-0 w-14 h-14 rounded-2xl shadow-lg ring-2 ring-white/50 flex items-center justify-center
                               ${isUnread ? 'bg-gradient-to-r from-blue-500 to-blue-600 shadow-blue-300/50' : 'bg-gradient-to-br from-emerald-100 to-blue-100 dark:from-emerald-900/30 dark:to-blue-900/30 shadow-emerald-200/50'}">
                        ${data.user_avatar ? 
                            `<img src="${data.user_avatar}" alt="${data.user_name}" class="w-11 h-11 rounded-xl object-cover">` : 
                            `<i class="fas fa-user-plus text-xl text-white ${isUnread ? '' : 'text-emerald-500'}"></i>`
                        }
                    </div>
                    
                    <!-- Content -->
                    <div class="flex-1 min-w-0 py-1">
                        <div class="flex items-start justify-between mb-2">
                            <div>
                                <h4 class="font-bold text-sm text-slate-900 dark:text-slate-100 line-clamp-1 group-hover:text-slate-800 dark:group-hover:text-slate-200 mb-1">
                                    ${data.title || 'Notifikasi Baru'}
                                </h4>
                                <p class="text-xs text-slate-500 dark:text-slate-400 line-clamp-2 leading-relaxed">
                                    ${data.message || 'Anda memiliki notifikasi baru'}
                                </p>
                            </div>
                            ${isUnread ? '<span class="px-2.5 py-1 bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-200 text-xs rounded-full font-bold shadow-sm ml-auto flex-shrink-0">BARU</span>' : ''}
                        </div>
                        
                        <!-- Action & Time -->
                        <div class="flex items-center justify-between pt-2 border-t border-slate-200/30 dark:border-slate-700/50">
                            ${data.action_url ? `<a href="${data.action_url}" target="_blank" class="text-xs font-semibold text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 flex items-center gap-1 group-hover:translate-x-1 transition-all">
                                <i class="fas fa-external-link-alt"></i> Lihat Detail
                            </a>` : ''}
                            <span class="text-xs text-slate-400 dark:text-slate-500">${time}</span>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }).join('');
}

// Mark single notification as read
function markNotificationAsRead(id, element) {
    fetch(`/notifications/${id}`, {
        method: 'PATCH',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            element.classList.remove('bg-gradient-to-r', 'from-blue-50/60', 'to-indigo-50/60', 'dark:from-blue-500/10', 'dark:to-indigo-500/10');
            element.classList.add('bg-white/50', 'dark:bg-slate-800/30');
            // Remove unread badge
            const badge = element.querySelector('.bg-blue-100, .dark\\:bg-blue-900\\/50');
            if (badge) badge.remove();
        }
    })
    .catch(error => console.error('Error:', error));
}

// Mark all as read
function markAllAsRead() {
    fetch('/api/notifications/mark-all-read', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            notificationsData.forEach(n => n.read_at = new Date().toISOString());
            renderNotifications(notificationsData);
            // Update sidebar badge
            const badge = document.querySelector('.notification-badge');
            if (badge) badge.remove();
        }
    });
}
</script>
