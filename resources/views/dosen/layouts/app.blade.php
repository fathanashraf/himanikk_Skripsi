<!DOCTYPE html>
<html lang="en" class="light" :class="darkMode ? 'dark' : ''" x-data="{ darkMode: false }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    {{-- FONTAWESOME CDN --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>@yield('title', 'HIMANIKKA - Admin Dashboard')</title>
</head>
<body class="min-h-screen bg-base-200 antialiased font-inter transition-all duration-300" 
      x-data="{ 
        darkMode: localStorage.theme === 'dark' || (!localStorage.theme && window.matchMedia('(prefers-color-scheme: dark)').matches),
        init() {
          this.$watch('darkMode', (value) => {
            document.documentElement.classList.toggle('dark', value);
            localStorage.theme = value ? 'dark' : 'light';
          });
          document.documentElement.classList.toggle('dark', this.darkMode);
        }
      }">
    
    @include('partials.header')
    
    {{-- MAIN CONTENT --}}
    <div class="drawer lg:drawer-open">
        <input id="sidebar-drawer" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content flex flex-col">
            @yield('breadcrumb-section')
            <main class="flex-1 p-6 lg:p-8" data-aos="fade-up">@yield('content')</main>
        </div>
        
        <div class="drawer-side">
            <label for="sidebar-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
            <ul class="menu p-4 w-64 min-h-full bg-base-100/95 backdrop-blur-xl text-base-content border-r border-base-200/50 shadow-2xl">
                <li class="menu-title font-bold text-lg mb-4">
                    <i class="fas fa-cogs mr-2 text-primary"></i>Settings
                </li>
                <li class="active"><a href="/dashboard"><i class="fas fa-chart-line mr-3"></i>Dashboard</a></li>
                <li><a href="/users"><i class="fas fa-users mr-3"></i>User Management</a></li>
                <li><a href="/roles"><i class="fas fa-shield-alt mr-3"></i>Roles & Permissions</a></li>
                <li><a href="/backup"><i class="fas fa-database mr-3"></i>Backup</a></li>
                <li class="menu-title font-bold text-lg mt-8 mb-4">
                    <i class="fas fa-plug mr-2 text-secondary"></i>Plugins
                </li>
                <li><a><i class="fas fa-paint-brush mr-3"></i>Appearance</a></li>
                <li><a><i class="fas fa-shield-alt mr-3"></i>Security</a></li>
            </ul>
        </div>
    </div>

    {{-- Ensure Tailwind processes dark: variants --}}
    <script>
        // Fallback for Tailwind dark mode
        if (localStorage.theme === 'dark' || (!localStorage.theme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>
</body>
</html>
