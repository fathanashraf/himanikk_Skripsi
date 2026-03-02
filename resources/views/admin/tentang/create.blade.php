@extends('admin.layouts.app')

@section('title', 'Tambah Profil')

@section('content')
<div class="p-6 max-w-4xl mx-auto">
    <div class="bg-white/95 dark:bg-slate-800/95 backdrop-blur-sm rounded-3xl p-8 shadow-2xl border 
        border-slate-200/50 dark:border-slate-700/50">
        
        <h1 class="text-4xl font-bold text-slate-900 dark:text-slate-50 mb-8">Tambah Profil Organisasi</h1>

        @if($errors->any())
        <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 rounded-2xl">
            <ul class="space-y-1">
                @foreach($errors->all() as $error)
                    <li class="text-red-700 dark:text-red-300 text-sm">• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.tentang.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <!-- Row 1: Nama & Logo -->
            <div class="grid md:grid-cols-2 gap-8">
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Nama Organisasi *</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                           class="w-full p-4 border border-slate-300 dark:border-slate-600 rounded-2xl bg-white/50 
                           dark:bg-slate-700/50 focus:ring-2 focus:ring-emerald-500 focus:border-transparent 
                           transition-all duration-300 @error('name') border-red-400 @enderror">
                    @error('name')
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Logo</label>
                    <input type="file" name="logo" accept="image/*"
                           class="w-full p-4 border border-slate-300 dark:border-slate-600 rounded-2xl bg-white/50 
                           dark:bg-slate-700/50 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 
                           file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 
                           hover:file:bg-emerald-100 transition-all duration-300 @error('logo') border-red-400 @enderror">
                    <p class="text-xs text-slate-500 mt-1">Max 2MB (JPG, PNG, GIF)</p>
                    @error('logo')
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Row 2: Email & Alamat -->
            <div class="grid md:grid-cols-2 gap-8">
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                           class="w-full p-4 border border-slate-300 dark:border-slate-600 rounded-2xl bg-white/50 
                           dark:bg-slate-700/50 focus:ring-2 focus:ring-emerald-500 focus:border-transparent 
                           transition-all duration-300 @error('email') border-red-400 @enderror">
                    @error('email')
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Alamat *</label>
                    <textarea name="alamat" rows="3" required 
                              class="w-full p-4 border border-slate-300 dark:border-slate-600 rounded-2xl bg-white/50 
                              dark:bg-slate-700/50 focus:ring-2 focus:ring-emerald-500 focus:border-transparent 
                              transition-all duration-300 resize-vertical @error('alamat') border-red-400 @enderror">{{ old('alamat') }}</textarea>
                    @error('alamat')
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Row 3: Fungsi & Tujuan -->
            <div class="grid md:grid-cols-2 gap-8">
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Fungsi *</label>
                    <textarea name="fungsi" rows="4" required 
                              class="w-full p-4 border border-slate-300 dark:border-slate-600 rounded-2xl bg-white/50 
                              dark:bg-slate-700/50 focus:ring-2 focus:ring-emerald-500 focus:border-transparent 
                              transition-all duration-300 resize-vertical @error('fungsi') border-red-400 @enderror">{{ old('fungsi') }}</textarea>
                    @error('fungsi')
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Tujuan *</label>
                    <textarea name="tujuan" rows="4" required 
                              class="w-full p-4 border border-slate-300 dark:border-slate-600 rounded-2xl bg-white/50 
                              dark:bg-slate-700/50 focus:ring-2 focus:ring-emerald-500 focus:border-transparent 
                              transition-all duration-300 resize-vertical @error('tujuan') border-red-400 @enderror">{{ old('tujuan') }}</textarea>
                    @error('tujuan')
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Row 4: Visi & Misi -->
            <div class="grid md:grid-cols-2 gap-8">
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Visi</label>
                    <textarea name="visi" rows="3" 
                              class="w-full p-4 border border-slate-300 dark:border-slate-600 rounded-2xl bg-white/50 
                              dark:bg-slate-700/50 focus:ring-2 focus:ring-emerald-500 focus:border-transparent 
                              transition-all duration-300 resize-vertical @error('visi') border-red-400 @enderror">{{ old('visi') }}</textarea>
                    @error('visi')
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Misi</label>
                    <textarea name="misi" rows="3" 
                              class="w-full p-4 border border-slate-300 dark:border-slate-600 rounded-2xl bg-white/50 
                              dark:bg-slate-700/50 focus:ring-2 focus:ring-emerald-500 focus:border-transparent 
                              transition-all duration-300 resize-vertical @error('misi') border-red-400 @enderror">{{ old('misi') }}</textarea>
                    @error('misi')
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Row 5: Lagu Mars & Instrumen (FILE UPLOAD) -->
            <div class="grid md:grid-cols-2 gap-8">
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Lagu Mars *</label>
                    <input type="file" name="lagu" accept="audio/*,video/*"
                           class="w-full p-4 border border-slate-300 dark:border-slate-600 rounded-2xl bg-white/50 
                           dark:bg-slate-700/50 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 
                           file:text-sm file:font-semibold file:bg-amber-50 file:text-amber-700 
                           hover:file:bg-amber-100 transition-all duration-300 @error('lagu') border-red-400 @enderror">
                    <p class="text-xs text-slate-500 mt-1">MP3, WAV, OGG (Max 10MB)</p>
                    @error('lagu')
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Instrumen (Video/Audio) *</label>
                    <input type="file" name="instrumen" accept="audio/*,video/*"
                           class="w-full p-4 border border-slate-300 dark:border-slate-600 rounded-2xl bg-white/50 
                           dark:bg-slate-700/50 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 
                           file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 
                           hover:file:bg-purple-100 transition-all duration-300 @error('instrumen') border-red-400 @enderror">
                    <p class="text-xs text-slate-500 mt-1">MP4, MP3, AVI (Max 50MB)</p>
                    @error('instrumen')
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Motto (Full Width) -->
            <div>
                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Motto</label>
                <input type="text" name="motto" value="{{ old('motto') }}"
                       class="w-full p-4 border border-slate-300 dark:border-slate-600 rounded-2xl bg-white/50 
                       dark:bg-slate-700/50 focus:ring-2 focus:ring-emerald-500 focus:border-transparent 
                       transition-all duration-300 @error('motto') border-red-400 @enderror"
                       placeholder="Contoh: 'Informatika Berprestasi'">
                @error('motto')
                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- Sejarah (Full Width) -->
            <div>
                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Sejarah Organisasi</label>
                <textarea name="sejarah" rows="6" 
                          class="w-full p-4 border border-slate-300 dark:border-slate-600 rounded-2xl bg-white/50 
                          dark:bg-slate-700/50 focus:ring-2 focus:ring-emerald-500 focus:border-transparent 
                          transition-all duration-300 resize-vertical @error('sejarah') border-red-400 @enderror"
                          placeholder="Ceritakan sejarah singkat organisasi...">{{ old('sejarah') }}</textarea>
                @error('sejarah')
                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 pt-6">
                <button type="submit" 
                        class="flex-1 px-8 py-4 bg-gradient-to-r from-emerald-600 to-emerald-700 
                        hover:from-emerald-700 hover:to-emerald-800 text-white font-bold text-lg 
                        rounded-2xl shadow-xl hover:shadow-2xl hover:-translate-y-1 transition-all 
                        duration-300 focus:ring-4 focus:ring-emerald-500">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Simpan Profil Lengkap
                </button>
                
                <a href="{{ route('admin.tentang.index') }}" 
                   class="px-8 py-4 border-2 border-slate-300 dark:border-slate-600 text-slate-700 
                   dark:text-slate-300 font-bold text-lg rounded-2xl hover:shadow-xl hover:-translate-y-1 
                   hover:bg-slate-50 dark:hover:bg-slate-700 transition-all duration-300 flex items-center 
                   justify-center h-16">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
