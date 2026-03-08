@extends('user.layouts.app')

@section('title', 'Pendaftaran event HIMANIKKA')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-emerald-50 dark:from-slate-900 dark:via-slate-800 dark:to-emerald-900/30 py-12 px-4 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-4xl">
        {{-- Header --}}
        <div class="text-center mb-16">
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-black leading-tight tracking-tight mb-1.5 bg-gradient-to-r from-emerald-600 via-emerald-500 to-teal-600 bg-clip-text text-transparent drop-shadow-lg">
                Pendaftaran {{$event->name}}
            </h1>
            <p class="text-xl md:text-2xl text-gray-600 dark:text-gray-300 font-medium tracking-wide leading-relaxed max-w-2xl mx-auto">
                Isi formulir di bawah ini untuk mendaftar event HIMANIKKA
            </p>
        </div>

        {{-- Form Card --}}
        <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/30 dark:border-slate-700/50 p-8 md:p-12">
            <form action="{{ route('user.pendaftaran.store', $event) }}" method="POST" class="space-y-6" enctype="multipart/form-data">
                @csrf

                    <div class="md:col-span-3">
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" value="{{ old('name') }}" required
                               class="w-full px-4 py-3 border border-gray-300 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-200 bg-white dark:bg-slate-700"
                               placeholder="Masukkan nama lengkap Anda">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                

                {{-- Kontak --}}
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            No. WhatsApp <span class="text-red-500">*</span>
                        </label>
                        <input type="tel" name="phone" value="{{ old('phone') }}" required
                               class="w-full px-4 py-3 border border-gray-300 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-200 bg-white dark:bg-slate-700"
                               placeholder="081234567890">
                        @error('phone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            Email
                        </label>
                        <input type="email" name="email" value="{{ old('email') }}"
                               class="w-full px-4 py-3 border border-gray-300 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-200 bg-white dark:bg-slate-700"
                               placeholder="email@contoh.com">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Keterangan --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        Keterangan Tambahan
                    </label>
                    <textarea name="keterangan" rows="4" 
                              class="w-full px-4 py-3 border border-gray-300 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-200 bg-white dark:bg-slate-700 resize-vertical"
                              placeholder="Ukuran kaos, diet khusus, dll (opsional)">{{ old('keterangan') }}</textarea>
                    @error('keterangan')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Bukti Pembayaran --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        Bukti Transfer (Opsional)
                    </label>
                    <input type="file" name="bukti_pembayaran" accept="image/*,.pdf"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-200 bg-white dark:bg-slate-700 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Upload JPG, PNG, atau PDF (max 5MB)</p>
                </div>

                {{-- Submit --}}
                <div class="flex flex-col sm:flex-row gap-4 pt-4">
                    <button type="submit" 
                            class="flex-1 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-semibold py-4 px-8 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 text-lg">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                        Daftar event
                    </button>
                    
                    <a href="{{ route('user.events.index') }}" 
                       class="flex-1 text-center bg-gray-100 dark:bg-slate-700 hover:bg-gray-200 dark:hover:bg-slate-600 text-gray-800 dark:text-gray-200 font-semibold py-4 px-8 rounded-xl shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                        ← Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
