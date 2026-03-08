@extends('layouts.app')

@section('title', 'Register - Himanikka')

@section('content')
<div class="min-h-screen flex items-center justify-center p-6 sm:p-8 
    bg-gradient-to-br from-indigo-50 via-white to-slate-50 dark:from-slate-900/95 dark:to-slate-900/95 
    backdrop-blur-sm relative overflow-hidden">
    
    {{-- Background Decorations --}}
    <div class="absolute inset-0 opacity-20 pointer-events-none">
        <div class="absolute top-20 left-20 w-72 h-72 bg-indigo-500/20 rounded-full mix-blend-multiply blur-xl animate-blob"></div>
        <div class="absolute top-40 right-20 w-72 h-72 bg-purple-500/20 rounded-full mix-blend-multiply blur-xl animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-8 left-1/4 w-72 h-72 bg-slate-500/10 rounded-full mix-blend-multiply blur-xl animate-blob animation-delay-4000"></div>
    </div>
    
    <div class="w-full max-w-md relative z-10">
        {{-- Logo & Hero --}}
        <div class="text-center mb-12 px-4">
            <div class="w-24 h-24 sm:w-20 sm:h-20 mx-auto mb-8 
                bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-3xl flex items-center justify-center 
                shadow-2xl ring-4 ring-white/50 backdrop-blur-md border border-white/40 
                hover:scale-105 transition-all duration-300 group">
                <img src="{{ asset('assets/logohima-.png') }}" alt="HIMANIKKA" 
                     class="w-16 h-16 sm:w-14 sm:h-14 object-contain drop-shadow-2xl group-hover:scale-110 transition-transform duration-300">
            </div>
            <h1 class="text-4xl sm:text-5xl font-bold bg-gradient-to-r from-slate-900 via-indigo-900 to-slate-900 dark:from-white dark:to-slate-200 bg-clip-text text-transparent mb-4 leading-tight">
                Daftar Akun Baru
            </h1>
            <p class="text-slate-600 dark:text-slate-400 text-lg sm:text-xl font-semibold max-w-[22rem] mx-auto leading-relaxed">
                <span class="text-indigo-600 dark:text-indigo-400">Silahkan</span> Buat Akun Untuk Bergabung dengan HIMANIKKA untuk Mendapatkan Informasi Terbaru Seputar HIMANIKKA
            </p>
        </div>

        {{-- Register Form Card --}}
        <div class="bg-white/90 dark:bg-slate-800/95 backdrop-blur-3xl shadow-2xl 
            rounded-3xl overflow-hidden max-w-md mx-auto border border-slate-200/50 dark:border-slate-700/50
            transform transition-all duration-500 hover:shadow-3xl hover:-translate-y-1">
            <div class="p-8 sm:p-10 space-y-8">
                {{-- Success Alert --}}
                @if(session('success'))
                    <div class="animate-in slide-in-from-top-2 duration-300 bg-green-50/90 dark:bg-green-900/30 border border-green-200/50 dark:border-green-700/50 
                        backdrop-blur-md rounded-2xl p-5 shadow-xl ring-1 ring-green-200/50 dark:ring-green-700/50">
                        <div class="flex items-start gap-3">
                            <i class="fas fa-check-circle text-green-500 text-xl mt-0.5 flex-shrink-0 animate-pulse"></i>
                            <div>
                                <h3 class="font-bold text-lg text-green-900 dark:text-green-100 mb-1">Success!</h3>
                                <p class="text-green-800 dark:text-green-200 text-sm">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Error Alert --}}
                @if($errors->any())
                    <div class="animate-in slide-in-from-top-2 duration-300 bg-red-50/90 dark:bg-red-900/30 border border-red-200/50 dark:border-red-700/50 
                        backdrop-blur-md rounded-2xl p-5 shadow-xl ring-1 ring-red-200/50 dark:ring-red-700/50">
                        <div class="flex items-start gap-3">
                            <i class="fas fa-exclamation-triangle text-red-500 text-xl mt-0.5 flex-shrink-0 animate-pulse"></i>
                            <div>
                                <h3 class="font-bold text-lg text-red-900 dark:text-red-100 mb-1">Registration Error</h3>
                                <ul class="text-red-800 dark:text-red-200 text-sm space-y-1 mt-2 max-h-32 overflow-y-auto">
                                    @foreach($errors->all() as $error)
                                        <li><i class="fas fa-circle mr-2 text-xs opacity-75"></i>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Registration Form --}}
                <form method="POST" action="{{ route('auth.register') }}" class="space-y-6">
                    @csrf

                    {{-- Full Name --}}
                    <div class="space-y-2">
                        <label class="flex items-center gap-4 p-3 bg-slate-50/80 dark:bg-slate-800/60 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
                            <div class="w-10 h-10 bg-gradient-to-br from-indigo-100 to-indigo-200 dark:from-indigo-900/50 dark:to-indigo-800/50 rounded-xl flex items-center justify-center 
                                shadow-md border border-indigo-200/50 flex-shrink-0">
                                <i class="fas fa-user text-indigo-600 text-lg dark:text-indigo-400"></i>
                            </div>
                            <span class="text-lg font-semibold text-slate-800 dark:text-slate-200">Full Name</span>
                        </label>
                        
                        <div class="relative">
                            <input 
                                id="name" 
                                type="text" 
                                name="name" 
                                class="w-full h-14 pl-12 pr-4 text-lg peer border-2 border-slate-200/70 dark:border-slate-700/70 
                                       rounded-xl bg-white/70 dark:bg-slate-800/70 backdrop-blur-sm focus:border-indigo-500 
                                       focus:ring-4 focus:ring-indigo-500/20 focus:outline-none transition-all duration-200 shadow-sm
                                       @error('name') border-red-400 bg-red-50/70 dark:bg-red-900/30 shadow-red-200/50 @enderror"
                                placeholder="Enter your full name"
                                value="{{ old('name') }}"
                                required 
                                autofocus />
                            <div class="absolute left-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400 peer-focus:text-indigo-500 transition-colors">
                                <i class="fas fa-user text-lg"></i>
                            </div>
                        </div>
                        
                        @error('name')
                            <div class="flex items-center gap-2 p-3 bg-red-50/95 dark:bg-red-900/50 rounded-lg 
                                border border-red-200/70 shadow-sm animate-pulse">
                                <i class="fas fa-circle-exclamation text-red-500 flex-shrink-0"></i>
                                <span class="text-sm text-red-900 dark:text-red-200 font-medium">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    {{-- NIM / Student ID --}}
                    <div class="space-y-2">
                        <label class="flex items-center gap-4 p-3 bg-slate-50/80 dark:bg-slate-800/60 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
                            <div class="w-10 h-10 bg-gradient-to-br from-indigo-100 to-indigo-200 dark:from-indigo-900/50 dark:to-indigo-800/50 rounded-xl flex items-center justify-center 
                                shadow-md border border-indigo-200/50 flex-shrink-0">
                                <i class="fas fa-id-card text-indigo-600 text-lg dark:text-indigo-400"></i>
                            </div>
                            <span class="text-lg font-semibold text-slate-800 dark:text-slate-200">NIM / Student ID</span>
                        </label>
                        
                        <div class="relative">
                            <input 
                                id="nim" 
                                type="text" 
                                name="nim" 
                                class="w-full h-14 pl-12 pr-4 text-lg peer border-2 border-slate-200/70 dark:border-slate-700/70 
                                       rounded-xl bg-white/70 dark:bg-slate-800/70 backdrop-blur-sm focus:border-indigo-500 
                                       focus:ring-4 focus:ring-indigo-500/20 focus:outline-none transition-all duration-200 shadow-sm
                                       @error('nim') border-red-400 bg-red-50/70 dark:bg-red-900/30 shadow-red-200/50 @enderror"
                                placeholder="Enter your student ID"
                                value="{{ old('nim') }}"
                                nullable
                                maxlength="20" />
                            <div class="absolute left-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400 peer-focus:text-indigo-500 transition-colors">
                                <i class="fas fa-id-card text-lg"></i>
                            </div>
                        </div>
                        
                        @error('nim')
                            <div class="flex items-center gap-2 p-3 bg-red-50/95 dark:bg-red-900/50 rounded-lg 
                                border border-red-200/70 shadow-sm animate-pulse">
                                <i class="fas fa-circle-exclamation text-red-500 flex-shrink-0"></i>
                                <span class="text-sm text-red-900 dark:text-red-200 font-medium">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="space-y-2">
                        <label class="flex items-center gap-4 p-3 bg-slate-50/80 dark:bg-slate-800/60 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
                            <div class="w-10 h-10 bg-gradient-to-br from-indigo-100 to-indigo-200 dark:from-indigo-900/50 dark:to-indigo-800/50 rounded-xl flex items-center justify-center 
                                shadow-md border border-indigo-200/50 flex-shrink-0">
                                <i class="fas fa-envelope text-indigo-600 text-lg dark:text-indigo-400"></i>
                            </div>
                            <span class="text-lg font-semibold text-slate-800 dark:text-slate-200">Email Address</span>
                        </label>
                        
                        <div class="relative">
                            <input 
                                id="email" 
                                type="email" 
                                name="email" 
                                class="w-full h-14 pl-12 pr-4 text-lg peer border-2 border-slate-200/70 dark:border-slate-700/70 
                                       rounded-xl bg-white/70 dark:bg-slate-800/70 backdrop-blur-sm focus:border-indigo-500 
                                       focus:ring-4 focus:ring-indigo-500/20 focus:outline-none transition-all duration-200 shadow-sm
                                       @error('email') border-red-400 bg-red-50/70 dark:bg-red-900/30 shadow-red-200/50 @enderror"
                                placeholder="student@himanikka.com"
                                value="{{ old('email') }}"
                                required 
                                autocomplete="email" />
                            <div class="absolute left-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400 peer-focus:text-indigo-500 transition-colors">
                                <i class="fas fa-envelope text-lg"></i>
                            </div>
                        </div>
                        
                        @error('email')
                            <div class="flex items-center gap-2 p-3 bg-red-50/95 dark:bg-red-900/50 rounded-lg 
                                border border-red-200/70 shadow-sm animate-pulse">
                                <i class="fas fa-circle-exclamation text-red-500 flex-shrink-0"></i>
                                <span class="text-sm text-red-900 dark:text-red-200 font-medium">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="space-y-2">
                        <label class="flex items-center gap-4 p-3 bg-slate-50/80 dark:bg-slate-800/60 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
                            <div class="w-10 h-10 bg-gradient-to-br from-indigo-100 to-indigo-200 dark:from-indigo-900/50 dark:to-indigo-800/50 rounded-xl flex items-center justify-center 
                                shadow-md border border-indigo-200/50 flex-shrink-0">
                                <i class="fas fa-lock text-indigo-600 text-lg dark:text-indigo-400"></i>
                            </div>
                            <span class="text-lg font-semibold text-slate-800 dark:text-slate-200">Password</span>
                        </label>
                        
                        <div class="relative">
                            <input 
                                id="password" 
                                type="password" 
                                name="password" 
                                class="w-full h-14 pl-12 pr-4 text-lg peer border-2 border-slate-200/70 dark:border-slate-700/70 
                                       rounded-xl bg-white/70 dark:bg-slate-800/70 backdrop-blur-sm focus:border-indigo-500 
                                       focus:ring-4 focus:ring-indigo-500/20 focus:outline-none transition-all duration-200 shadow-sm
                                       @error('password') border-red-400 bg-red-50/70 dark:bg-red-900/30 shadow-red-200/50 @enderror"
                                placeholder="Minimum 6 characters"
                                required 
                                autocomplete="new-password"
                                minlength="6" />
                            <div class="absolute left-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400 peer-focus:text-indigo-500 transition-colors">
                                <i class="fas fa-lock text-lg"></i>
                            </div>
                        </div>
                        
                        @error('password')
                            <div class="flex items-center gap-2 p-3 bg-red-50/95 dark:bg-red-900/50 rounded-lg 
                                border border-red-200/70 shadow-sm animate-pulse">
                                <i class="fas fa-circle-exclamation text-red-500 flex-shrink-0"></i>
                                <span class="text-sm text-red-900 dark:text-red-200 font-medium">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!-- confirmasi password -->
                     <div class="space-y-2">
                        <label class="flex items-center gap-4 p-3 bg-slate-50/80 dark:bg-slate-800/60 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
                            <div class="w-10 h-10 bg-gradient-to-br from-indigo-100 to-indigo-200 dark:from-indigo-900/50 dark:to-indigo-800/50 rounded-xl flex items-center justify-center 
                                shadow-md border border-indigo-200/50 flex-shrink-0">
                                <i class="fas fa-lock text-indigo-600 text-lg dark:text-indigo-400"></i>
                            </div>
                            <span class="text-lg font-semibold text-slate-800 dark:text-slate-200">Password Confirmation</span>
                        </label>
                        
                        <div class="relative">
                            <input 
                                id="password_confirmation" 
                                type="password_confirmation" 
                                name="password_confirmation" 
                                class="w-full h-14 pl-12 pr-4 text-lg peer border-2 border-slate-200/70 dark:border-slate-700/70 
                                       rounded-xl bg-white/70 dark:bg-slate-800/70 backdrop-blur-sm focus:border-indigo-500 
                                       focus:ring-4 focus:ring-indigo-500/20 focus:outline-none transition-all duration-200 shadow-sm
                                       @error('password') border-red-400 bg-red-50/70 dark:bg-red-900/30 shadow-red-200/50 @enderror"
                                placeholder="konfirmasi password"
                                required 
                                autocomplete="new-password"
                                minlength="6" />
                            <div class="absolute left-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400 peer-focus:text-indigo-500 transition-colors">
                                <i class="fas fa-lock text-lg"></i>
                            </div>
                        </div>
                        
                        @error('password_confirmation')
                            <div class="flex items-center gap-2 p-3 bg-red-50/95 dark:bg-red-900/50 rounded-lg 
                                border border-red-200/70 shadow-sm animate-pulse">
                                <i class="fas fa-circle-exclamation text-red-500 flex-shrink-0"></i>
                                <span class="text-sm text-red-900 dark:text-red-200 font-medium">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit" 
                            class="group relative w-full h-16 bg-gradient-to-r from-indigo-500 to-indigo-600 hover:from-indigo-600 hover:to-indigo-700 text-white text-lg font-bold 
                                   shadow-2xl hover:shadow-3xl rounded-2xl transition-all duration-300 
                                   hover:scale-[1.02] active:scale-[0.98] ring-4 ring-indigo-500/30 
                                   flex items-center justify-center gap-3 backdrop-blur-sm overflow-hidden">
                        <i class="fas fa-user-plus text-xl group-hover:scale-110 transition-transform duration-300"></i>
                        <span>Create My Account</span>
                        <div class="absolute inset-0 bg-white/20 scale-0 group-hover:scale-100 rounded-2xl transition-transform origin-center duration-300"></div>
                    </button>
                </form>

                

                {{-- Login Link --}}
                <div class="pt-8 text-center">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-slate-200/70"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-8 bg-white/90 dark:bg-slate-800/95 text-slate-600 dark:text-slate-400 backdrop-blur-sm rounded-full py-1">
                               Sudah punya akun? Login di sini
                            </span>
                        </div>
                    </div>
                    <a href="{{ route('auth.login') }}" 
                       class="mt-6 block w-full h-14 px-6 border-2 border-slate-200/80 dark:border-slate-700/60 
                              hover:border-indigo-500 hover:bg-indigo-50/70 dark:hover:bg-indigo-900/40 
                              font-semibold text-base text-slate-800 dark:text-slate-200 hover:text-indigo-600 
                              transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-1 
                              rounded-2xl flex items-center justify-center group">
                        <i class="fas fa-sign-in-alt mr-3 text-lg group-hover:scale-110 transition-transform duration-300"></i>
                        Login ke Akun Saya
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@keyframes blob {
    0% { transform: translate(0px, 0px) scale(1); }
    33% { transform: translate(30px, -50px) scale(1.1); }
    66% { transform: translate(-20px, 20px) scale(0.9); }
    100% { transform: translate(0px, 0px) scale(1); }
}
.animate-blob {
    animation: blob 7s infinite;
}
.animation-delay-2000 { animation-delay: 2s; }
.animation-delay-4000 { animation-delay: 4s; }
</style>
@endsection
