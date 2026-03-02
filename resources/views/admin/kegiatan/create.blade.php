@extends('admin.layouts.app')

@section('title', 'Tambah Kegiatan Baru - HIMANIKKA')

@section('content')
<div class="min-h-screen space-y-8 p-6">
    {{-- HEADER --}}
    <div class="flex items-center gap-6">
        <a href="{{ route('admin.kegiatan.index') }}" class="p-3 bg-white/70 dark:bg-slate-800/70 backdrop-blur-xl rounded-3xl border border-slate-200/50 shadow-xl hover:shadow-2xl transition-all hover:-translate-y-1">
            <i class="fas fa-arrow-left text-slate-600 dark:text-slate-400 text-xl"></i>
        </a>
        <div>
            <h1 class="text-4xl font-bold bg-gradient-to-r from-slate-900 to-slate-700 bg-clip-text text-transparent dark:from-white dark:to-slate-200">
                <i class="fas fa-plus-circle mr-3 text-emerald-500"></i>
                Tambah Kegiatan Baru
            </h1>
            <p class="text-slate-600 dark:text-slate-400 mt-2 text-lg">Isi detail kegiatan organisasi HIMANIKKA</p>
        </div>
    </div>

    {{-- MAIN FORM --}}
    <div class="bg-white/70 dark:bg-slate-800/70 backdrop-blur-xl rounded-3xl border border-slate-200/50 shadow-2xl overflow-hidden">
        <form action="{{ route('admin.kegiatan.store') }}" method="POST" enctype="multipart/form-data" class="p-8" id="kegiatanForm">
            @csrf
            
            {{-- IMAGE UPLOAD --}}
            <div class="mb-10">
                <label class="block text-lg font-bold text-slate-900 dark:text-white mb-6 flex items-center gap-3">
                    <i class="fas fa-image text-emerald-500 text-2xl"></i>
                    Gambar Kegiatan (Opsional)
                </label>
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
                    {{-- Upload Area --}}
                    <div class="lg:col-span-2">
                        <div x-data="{ dragOver: false }" 
                             @dragover="dragOver = true" 
                             @dragleave="dragOver = false"
                             @drop="dragOver = false"
                             class="border-4 border-dashed rounded-3xl p-12 text-center transition-all duration-300
                                    @if($errors->has('image')) border-red-400 bg-red-50/50 @elseif(old('image')) border-emerald-400 bg-emerald-50/50 @else border-slate-200/50 bg-slate-50/50 dark:bg-slate-900/50 @endif
                                    hover:border-emerald-400 hover:bg-emerald-50/30 cursor-pointer group">
                            <input type="file" name="image" id="image" 
                                   class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                   accept="image/*" />
                            
                            <div class="space-y-4">
                                <div class="w-20 h-20 mx-auto bg-gradient-to-br from-emerald-400 to-emerald-500 rounded-3xl flex items-center justify-center text-white text-2xl shadow-2xl group-hover:scale-110 transition-transform">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </div>
                                <div>
                                    <p class="text-xl font-bold text-slate-900 dark:text-white group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">
                                        {{ old('image') ? 'Gambar terpilih!' : 'Klik atau drag gambar ke sini' }}
                                    </p>
                                    <p class="text-slate-600 dark:text-slate-400 text-sm mt-1">
                                        @if(old('image'))
                                            File: <span class="font-semibold text-emerald-600">{{ old('image') }}</span>
                                        @else
                                            PNG, JPG, GIF hingga 2MB
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        @error('image')
                        <p class="mt-3 text-sm text-red-600 bg-red-100 p-3 rounded-2xl border-l-4 border-red-400">
                            <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                        </p>
                        @enderror
                    </div>

                    {{-- Preview --}}
                    <div class="bg-gradient-to-br from-slate-50 to-slate-100 dark:from-slate-900/50 p-6 rounded-3xl border border-slate-200/50 h-64 flex flex-col items-center justify-center">
                        <div class="w-32 h-32 bg-gradient-to-br from-gray-200 to-gray-300 dark:from-slate-700 dark:to-slate-800 rounded-2xl flex items-center justify-center text-gray-500 text-4xl mb-4 shadow-lg">
                            <i class="fas fa-image"></i>
                        </div>
                        <p class="text-center text-slate-600 dark:text-slate-400 font-medium">Preview gambar akan muncul di sini</p>
                        <p class="text-xs text-slate-500 mt-1">Ukuran ideal: 800x400px</p>
                    </div>
                </div>
            </div>

            {{-- FORM FIELDS --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                {{-- Nama Kegiatan --}}
                <div>
                    <label for="name" class="block text-lg font-bold text-slate-900 dark:text-white mb-4">
                        Nama Kegiatan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           name="name" 
                           id="name" 
                           value="{{ old('name') }}"
                           class="w-full px-6 py-4 border border-slate-200/70 dark:border-slate-700/70 rounded-2xl bg-white/50 dark:bg-slate-900/50 backdrop-blur-sm text-lg font-semibold focus:ring-3 focus:ring-emerald-500/50 focus:border-emerald-500 transition-all shadow-lg @error('name') border-red-400 bg-red-50/30 @enderror"
                           placeholder="Contoh: Workshop Laravel 12 HIMANIKKA"
                           required>
                    @error('name')
                    <p class="mt-2 text-sm text-red-600 flex items-center gap-2">
                        <i class="fas fa-exclamation-circle"></i>{{ $message }}
                    </p>
                    @enderror
                </div>

                {{-- Status --}}
                <div>
                    <label class="block text-lg font-bold text-slate-900 dark:text-white mb-4">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select name="status" 
                            id="status"
                            class="w-full px-6 py-4 border border-slate-200/70 dark:border-slate-700/70 rounded-2xl bg-white/50 dark:bg-slate-900/50 backdrop-blur-sm text-lg font-semibold focus:ring-3 focus:ring-emerald-500/50 focus:border-emerald-500 transition-all shadow-lg @error('status') border-red-400 bg-red-50/30 @enderror"
                            required>
                        <option value="">Pilih Status</option>
                        <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Draft</option>
                        <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Dipublikasikan</option>
                        <option value="2" {{ old('status') == 2 ? 'selected' : '' }}>Arsip</option>
                    </select>
                    @error('status')
                    <p class="mt-2 text-sm text-red-600 flex items-center gap-2">
                        <i class="fas fa-exclamation-circle"></i>{{ $message }}
                    </p>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div class="lg:col-span-2">
                    <label for="description" class="block text-lg font-bold text-slate-900 dark:text-white mb-4">
                        Deskripsi Kegiatan <span class="text-red-500">*</span>
                    </label>
                    <textarea name="description" 
                              id="description" 
                              rows="6"
                              class="w-full px-6 py-4 border border-slate-200/70 dark:border-slate-700/70 rounded-2xl bg-white/50 dark:bg-slate-900/50 backdrop-blur-sm text-lg font-medium focus:ring-3 focus:ring-emerald-500/50 focus:border-emerald-500 transition-all resize-vertical shadow-lg @error('description') border-red-400 bg-red-50/30 @enderror"
                              placeholder="Jelaskan detail kegiatan, tanggal, lokasi, dan informasi penting lainnya...">{{ old('description') }}</textarea>
                    @error('description')
                    <p class="mt-2 text-sm text-red-600 flex items-center gap-2">
                        <i class="fas fa-exclamation-circle"></i>{{ $message }}
                    </p>
                    @enderror
                </div>

                {{-- Link --}}
                <div>
                    <label for="link" class="block text-lg font-bold text-slate-900 dark:text-white mb-4">
                        Link Eksternal (Opsional)
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-link text-slate-400 text-xl"></i>
                        </div>
                        <input type="url" 
                               name="link" 
                               id="link" 
                               value="{{ old('link') }}"
                               class="w-full pl-12 pr-6 py-4 border border-slate-200/70 dark:border-slate-700/70 rounded-2xl bg-white/50 dark:bg-slate-900/50 backdrop-blur-sm text-lg font-semibold focus:ring-3 focus:ring-emerald-500/50 focus:border-emerald-500 transition-all shadow-lg @error('link') border-red-400 bg-red-50/30 @enderror"
                               placeholder="https://himanikka.com/kegiatan/workshop-laravel">
                    </div>
                    @error('link')
                    <p class="mt-2 text-sm text-red-600 flex items-center gap-2">
                        <i class="fas fa-exclamation-circle"></i>{{ $message }}
                    </p>
                    @enderror
                </div>
            </div>

            {{-- ACTION BUTTONS --}}
            <div class="flex flex-col sm:flex-row gap-4 pt-12 border-t border-slate-200/50 mt-12">
                <a href="{{ route('admin.kegiatan.index') }}" 
                   class="px-8 py-4 bg-slate-100 hover:bg-slate-200 dark:bg-slate-700 dark:hover:bg-slate-600 text-slate-800 dark:text-slate-200 font-bold rounded-2xl shadow-lg hover:shadow-xl transition-all flex-1 text-center">
                    <i class="fas fa-times mr-2"></i>Batal
                </a>
                <button type="submit" 
                        class="px-12 py-4 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white font-bold rounded-2xl shadow-2xl hover:shadow-3xl hover:-translate-y-1 transition-all flex-1 text-center text-lg flex items-center justify-center gap-3">
                    <i class="fas fa-save"></i>
                    Simpan Kegiatan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('image');
    const previewArea = document.querySelector('.preview-area'); // Tambahkan class ini jika ada
    
    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            // Preview gambar
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.querySelector('.preview-area') || document.querySelector('.h-64'); // Fallback
                if (preview) {
                    preview.innerHTML = `
                        <img src="${e.target.result}" class="w-full h-full object-cover rounded-2xl shadow-2xl">
                        <button type="button" onclick="this.parentElement.innerHTML='<div class=\"w-32 h-32 bg-gradient-to-br from-gray-200 to-gray-300 dark:from-slate-700 dark:to-slate-800 rounded-2xl flex items-center justify-center text-gray-500 text-4xl mb-4 shadow-lg\"><i class=\"fas fa-image\"></i></div><p class=\"text-center text-slate-600 dark:text-slate-400 font-medium\">Preview gambar akan muncul di sini</p><p class=\"text-xs text-slate-500 mt-1\">Ukuran ideal: 800x400px</p>'" class="absolute top-2 right-2 w-8 h-8 bg-red-500 hover:bg-red-600 text-white rounded-full flex items-center justify-center text-sm shadow-lg transition-all">
                            <i class="fas fa-times"></i>
                        </button>
                    `;
                }
            };
            reader.readAsDataURL(file);
        }
    });

    // Form validation
    const form = document.getElementById('kegiatanForm');
    form.addEventListener('submit', function(e) {
        const name = document.getElementById('name').value.trim();
        const description = document.getElementById('description').value.trim();
        
        if (!name || !description) {
            e.preventDefault();
            alert('Nama kegiatan dan deskripsi wajib diisi!');
            return false;
        }
    });
});
</script>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection
