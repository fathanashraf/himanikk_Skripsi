@extends('user.layouts.app')

@section('title', 'Daftar Pendaftaran HIMANIKKA')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-emerald-50 via-white to-slate-50 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        {{-- Hero Section --}}
        <div class="text-center mb-16">
            <div class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white rounded-full text-lg font-bold mb-4 shadow-xl">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                Daftar Sekarang
            </div>
            <h1 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-slate-900 to-slate-700 dark:from-white dark:to-slate-200 bg-clip-text text-transparent mb-6">
                Bergabunglah dengan HIMANIKKA
            </h1>
            <p class="text-xl text-slate-600 dark:text-slate-400 max-w-2xl mx-auto leading-relaxed">
                Daftarkan diri Anda untuk acara, kegiatan, atau event HIMANIKKA. Lengkapi data dan unggah bukti pendaftaran.
            </p>
        </div>

        {{-- Form Container --}}
        <div class="bg-white/80 dark:bg-slate-800/90 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/50 dark:border-slate-700/50 p-8 md:p-12">
            <form id="pendaftaranForm" enctype="multipart/form-data" class="space-y-8 max-w-2xl mx-auto">
                {{-- Success/Error Messages --}}
                <div id="formMessages" class="space-y-3 hidden"></div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Nama Lengkap --}}
                    <div>
                        <label for="name" class="block text-sm font-bold text-slate-900 dark:text-white mb-3">Nama Lengkap *</label>
                        <input type="text" id="name" name="name" required 
                            class="w-full p-4 border-2 border-slate-200/60 dark:border-slate-600/60 rounded-2xl focus:ring-4 focus:ring-emerald-500/30 focus:border-emerald-500 bg-white/50 dark:bg-slate-700/50 backdrop-blur-sm transition-all duration-300 text-lg placeholder-slate-400"
                            placeholder="Masukkan nama lengkap Anda">
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-bold text-slate-900 dark:text-white mb-3">Email *</label>
                        <input type="email" id="email" name="email" required 
                            class="w-full p-4 border-2 border-slate-200/60 dark:border-slate-600/60 rounded-2xl focus:ring-4 focus:ring-emerald-500/30 focus:border-emerald-500 bg-white/50 dark:bg-slate-700/50 backdrop-blur-sm transition-all duration-300 text-lg placeholder-slate-400"
                            placeholder="example@email.com">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- No. Telepon --}}
                    <div>
                        <label for="phone" class="block text-sm font-bold text-slate-900 dark:text-white mb-3">No. WhatsApp *</label>
                        <input type="tel" id="phone" name="phone" required 
                            class="w-full p-4 border-2 border-slate-200/60 dark:border-slate-600/60 rounded-2xl focus:ring-4 focus:ring-emerald-500/30 focus:border-emerald-500 bg-white/50 dark:bg-slate-700/50 backdrop-blur-sm transition-all duration-300 text-lg placeholder-slate-400"
                            placeholder="081234567890">
                    </div>

                    {{-- Jenis Pendaftaran --}}
                    <div>
                        <label for="jenis_pendaftaran" class="block text-sm font-bold text-slate-900 dark:text-white mb-3">Jenis Pendaftaran *</label>
                        <div class="relative">
                            <select id="jenis_pendaftaran" name="jenis_pendaftaran" required 
                                class="w-full p-4 pl-12 pr-10 border-2 border-slate-200/60 dark:border-slate-600/60 rounded-2xl focus:ring-4 focus:ring-emerald-500/30 focus:border-emerald-500 bg-white/50 dark:bg-slate-700/50 backdrop-blur-sm transition-all duration-300 text-lg appearance-none">
                                <option value="">Pilih Jenis Pendaftaran</option>
                                <option value="acara">📅 Acara</option>
                                <option value="kegiatan">🎯 Kegiatan</option>
                                <option value="event">✨ Event</option>
                                <option value="dll">📋 Lainnya</option>
                            </select>
                            <svg class="w-6 h-6 text-slate-400 absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Pilihan Acara/Event/Kegiatan (Conditional) --}}
                <div id="targetSection" class="grid grid-cols-1 md:grid-cols-2 gap-6 hidden">
                    <div>
                        <label id="targetLabel" class="block text-sm font-bold text-slate-900 dark:text-white mb-3">Pilih {{ ucfirst('target') }} *</label>
                        <select id="target_id" name="target_id" class="w-full p-4 pl-12 pr-10 border-2 border-slate-200/60 dark:border-slate-600/60 rounded-2xl focus:ring-4 focus:ring-emerald-500/30 focus:border-emerald-500 bg-white/50 dark:bg-slate-700/50 backdrop-blur-sm transition-all duration-300 text-lg appearance-none">
                            <option value="">Loading...</option>
                        </select>
                    </div>
                </div>

                {{-- File Uploads --}}
                <div class="space-y-6">
                    {{-- Foto Profil --}}
                    <div>
                        <label for="image" class="block text-sm font-bold text-slate-900 dark:text-white mb-3">Foto Profil (Opsional)</label>
                        <div class="border-2 border-dashed border-slate-200/60 dark:border-slate-600/60 rounded-2xl p-8 text-center hover:border-emerald-400 transition-all duration-300 hover:bg-emerald-50/30 dark:hover:bg-emerald-900/20">
                            <input type="file" id="image" name="image" accept="image/*" class="hidden" onchange="previewImage(this)">
                            <label for="image" class="cursor-pointer inline-flex flex-col items-center gap-3">
                                <div class="w-16 h-16 bg-gradient-to-br from-emerald-400 to-emerald-500 rounded-2xl flex items-center justify-center text-white shadow-lg">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-lg font-semibold text-slate-900 dark:text-white">Klik untuk upload foto</p>
                                    <p class="text-sm text-slate-500 dark:text-slate-400">JPG, PNG, WebP (Max 5MB)</p>
                                </div>
                            </label>
                            <div id="imagePreview" class="mt-4 hidden">
                                <img id="previewImg" class="w-24 h-24 object-cover rounded-2xl shadow-lg mx-auto">
                                <button type="button" onclick="clearImage()" class="mt-2 text-red-500 hover:text-red-700 text-sm font-medium">Hapus</button>
                            </div>
                        </div>
                    </div>

                    {{-- Bukti Pendaftaran --}}
                    <div>
                        <label for="bukti" class="block text-sm font-bold text-slate-900 dark:text-white mb-3">Bukti Pendaftaran (Wajib untuk beberapa event) *</label>
                        <div class="border-2 border-dashed border-slate-200/60 dark:border-slate-600/60 rounded-2xl p-8 text-center hover:border-orange-400 transition-all duration-300 hover:bg-orange-50/30 dark:hover:bg-orange-900/20">
                            <input type="file" id="bukti" name="bukti" accept="image/*,application/pdf" required class="hidden" onchange="previewBukti(this)">
                            <label for="bukti" class="cursor-pointer inline-flex flex-col items-center gap-3">
                                <div class="w-16 h-16 bg-gradient-to-br from-orange-400 to-orange-500 rounded-2xl flex items-center justify-center text-white shadow-lg">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-lg font-semibold text-slate-900 dark:text-white">Upload bukti pembayaran/transfer</p>
                                    <p class="text-sm text-slate-500 dark:text-slate-400">PDF, JPG, PNG (Max 10MB)</p>
                                </div>
                            </label>
                            <div id="buktiPreview" class="mt-4 hidden p-4 bg-slate-50 dark:bg-slate-700/50 rounded-xl">
                                <div id="previewBuktiContent"></div>
                                <button type="button" onclick="clearBukti()" class="mt-2 text-red-500 hover:text-red-700 text-sm font-medium">Hapus</button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Keterangan --}}
                <div>
                    <label for="keterangan" class="block text-sm font-bold text-slate-900 dark:text-white mb-3">Keterangan Tambahan (Opsional)</label>
                    <textarea id="keterangan" name="keterangan" rows="4" 
                        class="w-full p-4 border-2 border-slate-200/60 dark:border-slate-600/60 rounded-2xl focus:ring-4 focus:ring-emerald-500/30 focus:border-emerald-500 bg-white/50 dark:bg-slate-700/50 backdrop-blur-sm transition-all duration-300 resize-vertical text-lg placeholder-slate-400"
                        placeholder="Catatan khusus, nomor rekening tujuan, dll..."></textarea>
                </div>

                {{-- Submit Button --}}
                <div class="pt-8">
                    <button type="submit" id="submitBtn"
                        class="w-full px-8 py-6 text-xl font-bold text-white bg-gradient-to-r from-emerald-500 via-emerald-600 to-emerald-700 
                               rounded-3xl shadow-2xl hover:shadow-3xl hover:from-emerald-600 hover:to-emerald-800 focus:ring-4 focus:ring-emerald-500/50 
                               transition-all duration-500 hover:-translate-y-1 flex items-center justify-center gap-3 text-shadow-lg">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span>Daftar Sekarang</span>
                    </button>
                </div>
            </form>
        </div>

        {{-- Info Section --}}
        <div class="mt-20 text-center">
            <div class="max-w-2xl mx-auto space-y-6">
                <h3 className="text-2xl font-bold text-slate-900 dark:text-white">Informasi Penting</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
                    <div class="p-6 bg-emerald-50/50 dark:bg-emerald-900/20 rounded-2xl border border-emerald-200/50">
                        <div class="w-12 h-12 bg-emerald-500 rounded-2xl flex items-center justify-center mx-auto mb-4 text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h4 class="font-semibold text-slate-900 dark:text-white mb-2">Verifikasi Cepat</h4>
                        <p class="text-sm text-slate-600 dark:text-slate-400">Pendaftaran akan diproses dalam 24 jam</p>
                    </div>
                    <div class="p-6 bg-blue-50/50 dark:bg-blue-900/20 rounded-2xl border border-blue-200/50">
                        <div class="w-12 h-12 bg-blue-500 rounded-2xl flex items-center justify-center mx-auto mb-4 text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.27 7.27c.883.883 2.317.883 3.2 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <h4 class="font-semibold text-slate-900 dark:text-white mb-2">Gratis</h4>
                        <p class="text-sm text-slate-600 dark:text-slate-400">Tidak ada biaya pendaftaran</p>
                    </div>
                    <div class="p-6 bg-orange-50/50 dark:bg-orange-900/20 rounded-2xl border border-orange-200/50">
                        <div class="w-12 h-12 bg-orange-500 rounded-2xl flex items-center justify-center mx-auto mb-4 text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <h4 class="font-semibold text-slate-900 dark:text-white mb-2">Segera</h4>
                        <p class="text-sm text-slate-600 dark:text-slate-400">Kuota terbatas, daftar sekarang!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
(function() {
    'use strict';

    let currentTargets = {};

    // Load targets berdasarkan jenis
    async function loadTargets(jenis) {
        const targetSection = document.getElementById('targetSection');
        const targetSelect = document.getElementById('target_id');
        const targetLabel = document.getElementById('targetLabel');
        
        if (!jenis || !currentTargets[jenis]) {
            targetSection.classList.add('hidden');
            return;
        }

        targetLabel.textContent = `Pilih ${jenis.charAt(0).toUpperCase() + jenis.slice(1)}`;
        targetSelect.innerHTML = '<option value="">Loading...</option>';

        try {
            const response = await fetch(`/api/pendaftaran/targets/${jenis}`);
            const data = await response.json();
            currentTargets[jenis] = data;
            
            targetSelect.innerHTML = '<option value="">Pilih ' + jenis + '</option>';
            data.forEach(item => {
                targetSelect.innerHTML += `<option value="${item.id}">${item.name}</option>`;
            });
        } catch (error) {
            console.error('Error loading targets:', error);
        }
        
        targetSection.classList.remove('hidden');
    }

    // Event Listeners
    document.getElementById('jenis_pendaftaran').addEventListener('change', function() {
        loadTargets(this.value);
        document.getElementById('target_id').required = this.value !== '';
    });

    // Image Preview
    function previewImage(input) {
        const preview = document.getElementById('imagePreview');
        const previewImg = document.getElementById('previewImg');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                preview.classList.remove('hidden');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function clearImage() {
        document.getElementById('image').value = '';
        document.getElementById('imagePreview').classList.add('hidden');
    }

    // Bukti Preview
    function previewBukti(input) {
        const preview = document.getElementById('buktiPreview');
        const previewContent = document.getElementById('previewBuktiContent');
        
        if (input.files && input.files[0]) {
            const file = input.files[0];
            const isImage = file.type.startsWith('image/');
            
            if (isImage) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewContent.innerHTML = `<img src="${e.target.result}" class="w-32 h-32 object-cover rounded-xl shadow-lg mx-auto">`;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                previewContent.innerHTML = `
                    <div class="text-center">
                        <div class="w-32 h-32 bg-slate-100 dark:bg-slate-700 rounded-xl flex items-center justify-center mx-auto mb-3">
                            <svg class="w-12 h-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-slate-900 dark:text-white">${file.name}</p>
                        <p class="text-xs text-slate-500">${(file.size / 1024 / 1024).toFixed(2)} MB</p>
                    </div>
                `;
                preview.classList.remove('hidden');
            }
        }
    }

    function clearBukti() {
        document.getElementById('bukti').value = '';
        document.getElementById('buktiPreview').classList.add('hidden');
    }

    // Form Submission
    document.getElementById('pendaftaranForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        const submitBtn = document.getElementById('submitBtn');
        const formData = new FormData(this);
        const messagesDiv = document.getElementById('formMessages');
        
        // Loading state
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = `
            <svg class="w-8 h-8 animate-spin mr-3" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/>
            </svg>
            Memproses...
        `;
        submitBtn.disabled = true;
        messagesDiv.classList.add('hidden');

        try {
            const response = await fetch('{{ route("pendaftarans.store") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });

            const result = await response.json();

            if (response.ok) {
                messagesDiv.innerHTML = `
                    <div class="p-6 bg-emerald-100 dark:bg-emerald-900/30 border border-emerald-200 dark:border-emerald-800 rounded-2xl text-emerald-800 dark:text-emerald-300">
                        <div class="flex items-center gap-3">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <div>
                                <h3 class="text-xl font-bold mb-1">${result.message}</h3>
                                <p>Status: <span class="font-semibold">Proses</span></p>
                                <p>Kami akan menghubungi Anda melalui ${formData.get('phone')}</p>
                            </div>
                        </div>
                    </div>
                `;
                this.reset();
                clearImage();
                clearBukti();
                document.getElementById('targetSection').classList.add('hidden');
            } else {
                throw new Error(result.message || 'Terjadi kesalahan');
            }
        } catch (error) {
            messagesDiv.innerHTML = `
                <div class="p-6 bg-red-100 dark:bg-red-900/30 border border-red-200 dark:border-red-800 rounded-2xl text-red-800 dark:text-red-300">
                    <div class="flex items-center gap-3">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        <div>${error.message}</div>
                    </div>
                </div>
            `;
        } finally {
            messagesDiv.classList.remove('hidden');
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }
    });

})();
</script>
@endpush
@endsection
