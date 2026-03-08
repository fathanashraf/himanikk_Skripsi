<!DOCTYPE html>
<html lang="id" 
      :class="{ 'dark': darkMode }" 
      x-data="{ 
        darkMode: localStorage.theme === 'dark' || 
                  (!localStorage.theme && window.matchMedia('(prefers-color-scheme: dark)').matches),
        init() {
          // Prevent FOUC - Set theme immediately
          document.documentElement.classList.toggle('dark', this.darkMode)
          this.$watch('darkMode', (value) => {
            document.documentElement.classList.toggle('dark', value)
            localStorage.theme = value ? 'dark' : 'light'
          })
        },
        toggleDarkMode() {
          this.darkMode = !this.darkMode
        }
      }"
      x-init="init()">
      
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    {{-- FontAwesome - HANYA 1 VERSI --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @vite([
        'resources/css/app.css', 
        'resources/js/app.js', 
        'resources/js/settings.js', 
        'resources/js/components/modal.js', 
        'resources/js/components/upload.js', 
        'resources/js/dashboard.js'
    ])
    
    <title>@yield('title', 'HIMANIKKA - Himpunan Mahasiswa Informatika')</title>
</head>

<body class="min-h-screen antialiased transition-colors duration-500 bg-gradient-to-br from-slate-50 via-blue-50/30 to-indigo-50 dark:from-slate-900 dark:via-slate-900/80 dark:to-slate-950">
    {{-- Mobile Header --}}
    @include('partials.header')
    
    {{-- Flash Messages --}}
    @if (session('success'))
    <div x-data="{ show: true }" x-show="show" x-init="
        setTimeout(() => show = false, 4000)
    " class="fixed top-20 right-6 z-50 transform transition-all duration-300 translate-x-96" 
         :class="show ? 'translate-x-0' : 'translate-x-96'" role="alert">
        <div class="bg-emerald-500 text-white px-8 py-4 rounded-3xl shadow-2xl backdrop-blur-sm border border-emerald-400/30 max-w-sm">
            <div class="flex items-center gap-3">
                <i class="fas fa-check-circle text-xl"></i>
                <span class="font-semibold">{{ session('success') }}</span>
            </div>
        </div>
    </div>
    @endif

    <main class="min-h-[calc(100vh-8rem)] lg:min-h-screen pt-4 lg:pt-0">
        @yield('content')
    </main>

    @include('partials.footer')

    {{-- Preload Critical Resources --}}
    <link rel="preload" href="/fonts/inter.woff2" as="font" type="font/woff2" crossorigin>
    
    @stack('scripts')
</body>
</html>
