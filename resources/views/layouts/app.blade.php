<!DOCTYPE html>
<html lang="en" 
      :class="{ 'dark': $store.darkMode.on }" 
      x-data=""
      x-init="
        // Apply initial theme
        $el.classList.toggle('dark', $store.darkMode.on)
      "
      x-on:darkmode-toggle.window="$store.darkMode.toggle()">
      
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    {{-- FontAwesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/settings.js', 'resources/js/components/modal.js', 'resources/js/components/upload.js', 'resources/js/dashboard.js'])
    <title>@yield('title', 'HIMANIKKA - Admin Dashboard')</title>
</head>

<body class="min-h-screen antialiased transition-colors duration-300 bg-white dark:bg-slate-900">
    @include('partials.header')
    
    <main class="min-h-[calc(100vh-6rem)]">
        @yield('content')
    </main>

    {{-- ✅ FOUC Prevention - Pakai JS Store --}}
    <script>
        // Prevent flash - RUN BEFORE Alpine loads
        (function() {
            const isDark = localStorage.getItem('theme') === 'dark' || 
                          (!localStorage.getItem('theme') && 
                           window.matchMedia('(prefers-color-scheme: dark)').matches)
            
            if (isDark) {
                document.documentElement.classList.add('dark')
            }
        })()
    </script>
</body>
</html>
