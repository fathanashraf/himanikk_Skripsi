@extends('layouts.app')

@section('title', 'Login - HIMANIKKA')

@section('content')
<div class="min-h-screen flex items-center justify-center p-8 bg-gradient-to-br from-slate-50 to-blue-50 dark:from-slate-900 dark:to-slate-800">
    
    {{-- Background decoration --}}
    <div class="absolute inset-0 opacity-20">
        <div class="absolute top-1/4 left-1/4 w-72 h-72 bg-emerald-400 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-blue-400 rounded-full blur-3xl animate-pulse delay-1000"></div>
    </div>
    
    <div class="w-full max-w-md relative z-10">
        {{-- Logo --}}
        <div class="text-center mb-12">
            <div class="w-24 h-24 mx-auto mb-8 bg-gradient-to-br from-emerald-500 to-blue-600 rounded-3xl flex items-center justify-center shadow-2xl border-4 border-white/50">
                <img src="{{ asset('assets/logohima-.png') }}" alt="HIMANIKKA" class="w-16 h-16 object-contain">
            </div>
            <h1 class="text-4xl lg:text-5xl font-black bg-gradient-to-r from-slate-900 via-slate-700 to-emerald-800 
           dark:from-slate-50 dark:via-slate-200 dark:to-emerald-400 
           bg-clip-text text-transparent mb-6 leading-tight tracking-tight">
    <span>Terima Kasih</span><br class="sm:hidden">
    <span class="text-emerald-600 dark:text-emerald-400 block mt-2">Sudah Registrasi!</span>
</h1>

            <p class="text-lg text-slate-600 dark:text-slate-400 font-medium">Silahkan Masuk Untuk Mendapatkan Informasi Terbaru HIMANIKKA</p>
        </div>

        {{-- Messages --}}
        @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-100 border border-emerald-400 text-emerald-800 rounded-xl">
            {{ session('success') }}
        </div>
        @endif

        @if($errors->any())
        <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-800 rounded-xl">
            @foreach($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
        @endif

        {{-- Login Form --}}
        <div class="bg-white/90 dark:bg-slate-800/90 backdrop-blur-xl rounded-3xl p-8 border border-slate-200/50 shadow-2xl">
            <form method="POST" action="{{ route('auth.login') }}">
                @csrf
                
                {{-- Email --}}
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Email</label>
                    <div class="relative">
                        <input type="email" name="email" value="{{ old('email') }}" required
                            class="w-full h-12 px-4 pl-12 border-2 border-slate-200 dark:border-slate-600 rounded-2xl bg-white/50 dark:bg-slate-700/50 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-200/50 @error('email') border-red-400 @enderror
                            text-lg placeholder-slate-400 focus:outline-none transition-all duration-300"
                            placeholder="admin@himanikka.com">
                        <i class="fas fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                    </div>
                </div>

                {{-- Password --}}
                <div class="mb-8">
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Password</label>
                    <div class="relative">
                        <input type="password" name="password" required
                            class="w-full h-12 px-4 pl-12 border-2 border-slate-200 dark:border-slate-600 rounded-2xl bg-white/50 dark:bg-slate-700/50 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-200/50 @error('password') border-red-400 @enderror
                            text-lg placeholder-slate-400 focus:outline-none transition-all duration-300"
                            placeholder="••••••••">
                        <i class="fas fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                    </div>
                </div>

                {{-- Remember & Forgot --}}
                <div class="flex flex-wrap gap-4 mb-8">
                    <label class="flex items-center gap-2">
                        <input type="checkbox" name="remember" class="w-5 h-5 text-emerald-600 rounded" {{ old('remember') ? 'checked' : '' }}>
                        <span class="text-sm text-slate-700 dark:text-slate-300">Ingat saya</span>
                    </label>
                    <a href="#" class="text-sm font-semibold text-emerald-600 hover:text-emerald-700 ml-auto">Lupa Password?</a>
                </div>

                {{-- Submit --}}
                <button type="submit"
        class="group w-full h-16 bg-gradient-to-r from-emerald-500 via-emerald-600 to-blue-600 
               hover:from-emerald-600 hover:via-emerald-700 hover:to-blue-700 
               text-white font-black text-xl rounded-3xl shadow-2xl hover:shadow-3xl 
               hover:-translate-y-2 active:scale-95 active:shadow-xl
               transition-all duration-500 flex items-center justify-center gap-4 
               relative overflow-hidden border-0 focus:outline-none focus:ring-4 focus:ring-emerald-500/50
               disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none">
    
    <!-- Shimmer effect -->
    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent 
                -skew-x-12 transform -translate-x-full group-hover:translate-x-full 
                transition-transform duration-1000 h-full"></div>
    
    <!-- Loading spinner (hidden by default) -->
    <svg class="animate-spin -ml-1 mr-3 h-6 w-6 text-white opacity-0 group-disabled:opacity-100 transition-all duration-300" 
         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" 
              d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
    </svg>
    
    <!-- Icon & Text -->
    <div class="flex items-center gap-3 relative z-10">
        <i class="fas fa-sign-in-alt text-2xl group-hover:translate-x-1 transition-transform duration-300"></i>
        <span class="relative">Masuk Dashboard</span>
    </div>
</button>

            </form>

            {{-- Divider --}}
            <div class="my-8 relative">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-slate-200 dark:border-slate-700"></div>
                </div>
                
            </div>

            {{-- Register --}}
            <div class="mt-8 text-center">
                <p class="text-sm text-slate-600 mb-4">Belum punya akun?</p>
                <a href="{{ route('auth.register') }}" 
                   class="w-full block h-12 border-2 border-slate-200 dark:border-slate-600 hover:border-emerald-500 bg-slate-50 dark:bg-slate-700/50 hover:bg-emerald-50 dark:hover:bg-emerald-900/30 font-semibold text-emerald-700 dark:text-emerald-300 rounded-2xl hover:shadow-lg transition-all duration-300">
                    Buat Akun Admin
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
