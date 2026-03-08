{{-- CREATE MODAL --}}
<div id="createModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 z-50 hidden overflow-y-auto">
    <div class="relative top-20 mx-auto p-6 w-11/12 md:w-3/4 lg:w-1/2 max-h-[90vh] overflow-y-auto">
        <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-2xl">
            <div class="p-8 border-b border-slate-200 dark:border-slate-700 flex justify-between items-center">
                <h3 class="text-2xl font-bold text-slate-900 dark:text-white">Tambah Profil Baru</h3>
                <button onclick="closeCreateModal()" class="p-2 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-xl transition-colors">
                    <svg class="w-6 h-6 text-slate-500 hover:text-slate-900 dark:hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <form id="createForm" enctype="multipart/form-data" class="p-8 space-y-8">
    {{-- BASIC INFO --}}
    <div class="bg-gradient-to-r from-emerald-50/50 to-emerald-100/50 dark:from-slate-800/50 dark:to-slate-700/50 
                 rounded-3xl p-8 border border-emerald-200/50 dark:border-slate-600/50">
        <h3 class="text-xl font-bold text-slate-800 dark:text-slate-200 mb-6 flex items-center gap-3">
            <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
            </svg>
            Informasi Dasar
        </h3>

        <div class="grid lg:grid-cols-2 gap-8">
            {{-- Nama Organisasi --}}
            <div>
                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3">Nama Organisasi *</label>
                <input type="text" name="name" required 
                       class="w-full p-5 border border-slate-200 dark:border-slate-600 rounded-2xl 
                              focus:ring-4 focus:ring-emerald-500/30 focus:border-emerald-500 
                              dark:bg-slate-700/80 dark:text-white transition-all duration-300
                              bg-gradient-to-r from-white/80 to-slate-50/80">
            </div>
            {{-- Singkatan --}}
            <div>
                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3">Singkatan *</label>
                <input type="text" name="singkatan" required 
                       class="w-full p-5 border border-slate-200 dark:border-slate-600 rounded-2xl 
                              focus:ring-4 focus:ring-emerald-500/30 focus:border-emerald-500 
                              dark:bg-slate-700/80 dark:text-white transition-all duration-300
                              bg-gradient-to-r from-white/80 to-slate-50/80">
            </div>

            <div class="lg:col-span-2 grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3">Email</label>
                    <input type="email" name="email" 
                           class="w-full p-5 border border-slate-200 dark:border-slate-600 rounded-2xl 
                                  focus:ring-4 focus:ring-emerald-500/30 focus:border-emerald-500 
                                  dark:bg-slate-700/80 dark:text-white transition-all duration-300">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3">Logo</label>
                    <input type="file" name="logo" accept="image/*" 
                           class="w-full p-5 border-2 border-dashed border-slate-200 dark:border-slate-600 
                                  rounded-2xl dark:bg-slate-700/50 dark:text-white file:mr-4 file:py-3 
                                  file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold 
                                  file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 
                                  focus:ring-4 focus:ring-emerald-500/30 focus:border-emerald-500 cursor-pointer">
                </div>
            </div>
        </div>
    </div>
    <!-- AD/ART FILES -->
    <div class="bg-gradient-to-r from-blue-50/60 to-indigo-50/60 dark:from-slate-800/50 dark:to-slate-700/50 
                 rounded-3xl p-8 border border-blue-200/50 dark:border-slate-600/50">
        <h3 class="text-xl font-bold text-slate-800 dark:text-slate-200 mb-6 flex items-center gap-3">
            <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            AD/ART Organisasi
        </h3>
        <input type="file" name="AD/ART" accept=".pdf,.doc,.docx" 
               class="w-full p-5 border-2 border-dashed border-blue-200 
                      dark:border-slate-600 rounded-2xl dark:bg-slate-700/50 
                      dark:text-white file:mr-4 file:py-3 file:px-4 file:rounded-xl 
                      file:border-0 file:text-sm file:font-semibold file:bg-blue-50 
                      file:text-blue-700 hover:file:bg-blue-100 focus:ring-4 
                      focus:ring-blue-500/30 focus:border-blue-500 cursor-pointer">
    </div>

    {{-- AUDIO FILES --}}
    <div class="grid lg:grid-cols-2 gap-8">
    {{-- Lagu Mars --}}
    <div class="bg-gradient-to-br from-amber-50/70 to-orange-50/70 dark:from-amber-900/20 dark:to-orange-900/20 
                 rounded-3xl p-8 border-2 border-amber-200/50 dark:border-amber-400/30">
        <label class="block text-lg font-bold text-slate-800 dark:text-slate-200 mb-6 flex items-center gap-3">
            <svg class="w-8 h-8 text-amber-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
            </svg>
            Lagu Mars
        </label>

        <div class="relative">
            <input type="file" name="lagu" id="laguUpload" accept="audio/*,video/*" 
                   class="upload-input peer w-full h-28 p-6 border-2 border-dashed border-amber-200 
                          dark:border-amber-400 rounded-3xl focus:ring-4 focus:ring-amber-500/40 
                          focus:border-amber-500 dark:bg-slate-800/60 cursor-pointer transition-all 
                          duration-300 hover:border-amber-300 hover:bg-amber-50/60 file:hidden">

            <div class="upload-area absolute inset-0 flex flex-col items-center justify-center rounded-3xl 
                       bg-gradient-to-br from-amber-50/90 to-orange-50/90 dark:from-amber-900/30 
                       dark:to-orange-900/30 border-2 border-dashed border-amber-200 
                       dark:border-amber-400/60 pointer-events-none peer-focus:border-amber-400 
                       peer-hover:border-amber-300 transition-all duration-400">
                <svg class="w-14 h-14 text-amber-500 mb-4 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 4 0 1115.9 6L16 6a5 4 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                </svg>
                <p class="text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">Drop file atau klik</p>
                <p class="text-xs text-slate-500 dark:text-slate-400">MP3, WAV, MP4</p>
            </div>

            <div id="currentLaguPreview" class="current-preview hidden absolute inset-0 
                      bg-gradient-to-r from-amber-500/15 to-orange-500/15 rounded-3xl 
                      border-2 border-amber-300 pointer-events-none">
                <div class="flex flex-col items-center justify-center h-full p-6 text-center">
                    <svg class="w-14 h-14 text-amber-500 mb-3" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 9V5l-3 3 3 3v-4z"/>
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 102 0v-4z" clip-rule="evenodd"/>
                    </svg>
                    <div id="laguPreviewName" class="font-semibold text-sm text-amber-800 dark:text-amber-200 
                            truncate max-w-[220px]"></div>
                </div>
            </div>
        </div>
        <div id="laguError" class="mt-4 min-h-[20px]"></div>
    </div>

    {{-- Instrumen --}}
    <div class="bg-gradient-to-br from-purple-50/70 to-indigo-50/70 dark:from-purple-900/20 dark:to-indigo-900/20 
             rounded-3xl p-8 border-2 border-purple-200/50 dark:border-purple-400/30">
    <label class="block text-lg font-bold text-slate-800 dark:text-slate-200 mb-6 flex items-center gap-3">
        <svg class="w-8 h-8 text-purple-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                  d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
        </svg>
        Instrumen
    </label>

    <div class="relative">
        <input type="file" 
               name="instrumen" 
               id="instrumenUpload" 
               accept="audio/*,video/*"
               class="upload-input peer w-full h-28 p-6 border-2 border-dashed border-purple-200 
                      dark:border-purple-400 rounded-3xl focus:ring-4 focus:ring-purple-500/40 
                      focus:border-purple-500 dark:bg-slate-800/60 cursor-pointer transition-all 
                      duration-300 hover:border-purple-300 hover:bg-purple-50/60 file:hidden">

        <!-- Drag & Drop Area -->
        <div class="upload-area absolute inset-0 flex flex-col items-center justify-center rounded-3xl 
                   bg-gradient-to-br from-purple-50/90 to-indigo-50/90 dark:from-purple-900/30 
                   dark:to-indigo-900/30 border-2 border-dashed border-purple-200 
                   dark:border-purple-400/60 pointer-events-none peer-focus:border-purple-400 
                   peer-hover:border-purple-300 transition-all duration-400">
            <svg class="w-14 h-14 text-purple-500 mb-4 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 4 0 1115.9 6L16 6a5 4 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
            </svg>
            <p class="text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">Drop file atau klik</p>
            <p class="text-xs text-slate-500 dark:text-slate-400">MP3, MP4, WAV, OGG</p>
        </div>

        <!-- MP3 Audio Preview -->
        <div id="currentInstrumenPreview" class="current-preview hidden absolute inset-0 
                      bg-gradient-to-r from-purple-500/15 to-indigo-500/15 rounded-3xl 
                      border-2 border-purple-300 pointer-events-none">
            <div class="flex flex-col items-center justify-center h-full p-6 text-center">
                <svg class="w-14 h-14 text-purple-500 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                </svg>
                <div id="instrumenPreviewName" class="font-semibold text-sm text-purple-800 
                        dark:text-purple-200 truncate max-w-[220px]"></div>
            </div>
        </div>
    </div>
    <div id="instrumenError" class="mt-4 min-h-[20px]"></div>
</div>

</div>


    {{-- DESKRIPSI --}}
    <div class="space-y-6">
        <div class="bg-gradient-to-r from-blue-50/60 to-indigo-50/60 dark:from-slate-800/50 dark:to-slate-700/50 
                     rounded-3xl p-8 border border-blue-200/50 dark:border-slate-600/50">
            <h3 class="text-xl font-bold text-slate-800 dark:text-slate-200 mb-6 flex items-center gap-3">
                <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Deskripsi Lengkap
            </h3>
            
            <div class="grid lg:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3">Alamat</label>
                    <textarea name="alamat" rows="3" 
                              class="w-full p-5 border border-slate-200 dark:border-slate-600 rounded-2xl 
                                     focus:ring-4 focus:ring-blue-500/30 focus:border-blue-500 
                                     dark:bg-slate-700/80 dark:text-white resize-vertical transition-all duration-300"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3">Motto</label>
                    <textarea name="motto" rows="2" 
                              class="w-full p-5 border border-slate-200 dark:border-slate-600 rounded-2xl 
                                     focus:ring-4 focus:ring-blue-500/30 focus:border-blue-500 
                                     dark:bg-slate-700/80 dark:text-white resize-vertical transition-all duration-300"></textarea>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-6 pt-2">
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3">Fungsi</label>
                    <textarea name="fungsi" rows="4" 
                              class="w-full p-5 border border-slate-200 dark:border-slate-600 rounded-2xl 
                                     focus:ring-4 focus:ring-blue-500/30 focus:border-blue-500 
                                     dark:bg-slate-700/80 dark:text-white resize-vertical transition-all duration-300"></textarea>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3">Tujuan</label>
                    <textarea name="tujuan" rows="4" 
                              class="w-full p-5 border border-slate-200 dark:border-slate-600 rounded-2xl 
                                     focus:ring-4 focus:ring-blue-500/30 focus:border-blue-500 
                                     dark:bg-slate-700/80 dark:text-white resize-vertical transition-all duration-300"></textarea>
                </div>
            </div>
        </div>

        {{-- VISI & MISI --}}
        <div class="grid lg:grid-cols-2 gap-6">
            <div class="bg-gradient-to-t from-emerald-50/70 via-blue-50/50 to-purple-50/50 
                         dark:from-slate-800/50 dark:to-slate-700/50 rounded-3xl p-8 
                         border border-emerald-200/40 dark:border-slate-600/50">
                <label class="block text-lg font-bold text-slate-800 dark:text-slate-200 mb-6 flex items-center gap-3">
                    <svg class="w-8 h-8 text-emerald-600 bg-emerald-100 rounded-2xl p-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Visi
                </label>
                <textarea name="visi" rows="4" 
                          class="w-full p-5 border border-slate-200 dark:border-slate-600 rounded-2xl 
                                 focus:ring-4 focus:ring-emerald-500/40 focus:border-emerald-500 
                                 dark:bg-slate-700/80 dark:text-white resize-vertical transition-all duration-300"></textarea>
            </div>

            <div class="bg-gradient-to-t from-purple-50/70 via-indigo-50/50 to-blue-50/50 
                         dark:from-slate-800/50 dark:to-slate-700/50 rounded-3xl p-8 
                         border border-purple-200/40 dark:border-slate-600/50">
                <label class="block text-lg font-bold text-slate-800 dark:text-slate-200 mb-6 flex items-center gap-3">
                    <svg class="w-8 h-8 text-purple-600 bg-purple-100 rounded-2xl p-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Misi
                </label>
                <textarea name="misi" rows="4" 
                          class="w-full p-5 border border-slate-200 dark:border-slate-600 rounded-2xl 
                                 focus:ring-4 focus:ring-purple-500/40 focus:border-purple-500 
                                 dark:bg-slate-700/80 dark:text-white resize-vertical transition-all duration-300"></textarea>
            </div>
        </div>

        {{-- Sejarah --}}
        <div class="bg-gradient-to-r from-amber-50/60 to-slate-50/60 dark:from-slate-800/50 dark:to-slate-700/50 
                     rounded-3xl p-8 border border-amber-200/50 dark:border-slate-600/50">
            <label class="block text-lg font-bold text-slate-800 dark:text-slate-200 mb-6 flex items-center gap-3">
                <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Sejarah Organisasi
            </label>
            <textarea name="sejarah" rows="6" 
                      class="w-full p-5 border border-slate-200 dark:border-slate-600 rounded-2xl 
                             focus:ring-4 focus:ring-amber-500/30 focus:border-amber-500 
                             dark:bg-slate-700/80 dark:text-white resize-vertical transition-all duration-300"></textarea>
        </div>
    </div>
</form>

            
            <div class="flex gap-3 p-8 pt-0 border-t border-slate-200 dark:border-slate-700">
                <button type="submit" form="createForm" class="flex-1 bg-emerald-600 text-white font-bold py-4 px-6 rounded-xl hover:bg-emerald-700 transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-1 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan
                </button>
                <button type="button" onclick="closeCreateModal()" class="px-6 py-4 bg-slate-200 dark:bg-slate-700 text-slate-800 dark:text-slate-200 font-bold rounded-xl hover:bg-slate-300 dark:hover:bg-slate-600 transition-all duration-300">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

{{-- EDIT MODAL --}}
{{-- EDIT MODAL LENGKAP --}}
<div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 z-50 hidden overflow-y-auto">
    <div class="relative top-20 mx-auto p-6 w-11/12 md:w-3/4 lg:w-1/2 max-h-[90vh] overflow-y-auto">
        <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-2xl">
            <div class="p-8 border-b border-slate-200 dark:border-slate-700 flex justify-between items-center">
                <h3 class="text-2xl font-bold text-slate-900 dark:text-white">Edit Profil Organisasi</h3>
                <button onclick="closeEditModal()" class="p-2 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-xl transition-colors">
                    <svg class="w-6 h-6 text-slate-500 hover:text-slate-900 dark:hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <form id="editForm" enctype="multipart/form-data" class="p-8 space-y-8">
                <input type="hidden" name="id" id="editId">
                
                {{-- BASIC INFO --}}
                <div class="bg-gradient-to-r from-emerald-50/50 to-emerald-100/50 dark:from-slate-800/50 dark:to-slate-700/50 rounded-3xl p-8 border border-emerald-200/50 dark:border-slate-600/50">
                    <h3 class="text-xl font-bold text-slate-800 dark:text-slate-200 mb-6 flex items-center gap-3">
                        <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        Informasi Dasar
                    </h3>
                    <div class="grid lg:grid-cols-2 gap-8">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3">Nama Organisasi *</label>
                            <input type="text" name="name" id="editName" required 
                                   class="w-full p-5 border border-slate-200 dark:border-slate-600 rounded-2xl 
                                   focus:ring-4 focus:ring-emerald-500/30 focus:border-emerald-500 
                                   dark:bg-slate-700/80 dark:text-white transition-all duration-300
                                   bg-gradient-to-r from-white/80 to-slate-50/80">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3">Singkatan *</label>
                            <input type="text" name="singkatan" id="editSingkatan" required 
                                   class="w-full p-5 border border-slate-200 dark:border-slate-600 rounded-2xl 
                                   focus:ring-4 focus:ring-emerald-500/30 focus:border-emerald-500 
                                   dark:bg-slate-700/80 dark:text-white transition-all duration-300
                                   bg-gradient-to-r from-white/80 to-slate-50/80">
                        </div>
                        <div class="lg:col-span-2 grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3">Email</label>
                                <input type="email" name="email" id="editEmail" 
                                       class="w-full p-5 border border-slate-200 dark:border-slate-600 rounded-2xl 
                                       focus:ring-4 focus:ring-emerald-500/30 focus:border-emerald-500 
                                       dark:bg-slate-700/80 dark:text-white transition-all duration-300">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3">Logo</label>
                                <div class="space-y-2">
                                    <input type="file" name="logo" id="editLogo" accept="image/*" 
                                           class="w-full p-5 border-2 border-dashed border-slate-200 dark:border-slate-600 
                                           rounded-2xl dark:bg-slate-700/50 dark:text-white file:mr-4 file:py-3 
                                           file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold 
                                           file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 
                                           focus:ring-4 focus:ring-emerald-500/30 focus:border-emerald-500 cursor-pointer">
                                    <img id="editLogoPreview" class="w-20 h-20 object-cover rounded-xl border-2 border-slate-200 mx-auto hidden">
                                    <div id="currentLogo" class="p-3 bg-emerald-50 dark:bg-slate-700/50 rounded-xl text-sm text-emerald-800 dark:text-emerald-200 hidden text-center">
                                        <svg class="w-5 h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                                        </svg>
                                        Logo saat ini tersimpan
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- AD/ART --}}
                <div class="bg-gradient-to-r from-blue-50/60 to-indigo-50/60 dark:from-slate-800/50 dark:to-slate-700/50 
                             rounded-3xl p-8 border border-blue-200/50 dark:border-slate-600/50">
                    <h3 class="text-xl font-bold text-slate-800 dark:text-slate-200 mb-6 flex items-center gap-3">
                        <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        AD/ART Organisasi
                    </h3>
                    <div class="space-y-3">
                        <input type="file" name="AD_ART" id="editADART" accept=".pdf,.doc,.docx" 
                               class="w-full p-5 border-2 border-dashed border-blue-200 
                               dark:border-slate-600 rounded-2xl dark:bg-slate-700/50 
                               dark:text-white file:mr-4 file:py-3 file:px-4 file:rounded-xl 
                               file:border-0 file:text-sm file:font-semibold file:bg-blue-50 
                               file:text-blue-700 hover:file:bg-blue-100 focus:ring-4 
                               focus:ring-blue-500/30 focus:border-blue-500 cursor-pointer">
                        <div id="currentADART" class="p-4 bg-blue-50 dark:bg-slate-700/50 rounded-xl text-sm text-blue-800 dark:text-blue-200 hidden">
                            <svg class="w-5 h-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V8a2 2 0 00-2-2h-5L9 3H4zm11 1.414l-3.293 3.293a1 1 0 01-1.414 0L8 8.414V14a1 1 0 001 1h6a1 1 0 001-1V6.414z" clip-rule="evenodd"/>
                            </svg>
                            AD/ART saat ini tersimpan
                        </div>
                    </div>
                </div>

                {{-- AUDIO FILES --}}
                <div class="grid lg:grid-cols-2 gap-8">
                    {{-- Lagu Mars --}}
                    <div class="bg-gradient-to-br from-amber-50/70 to-orange-50/70 dark:from-amber-900/20 dark:to-orange-900/20 
                                 rounded-3xl p-8 border-2 border-amber-200/50 dark:border-amber-400/30">
                        <label class="block text-lg font-bold text-slate-800 dark:text-slate-200 mb-6 flex items-center gap-3">
                            <svg class="w-8 h-8 text-amber-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                            Lagu Mars
                        </label>
                        <div class="relative">
                            <input type="file" name="lagu" id="editLaguUpload" accept="audio/*,video/*" 
                                   class="upload-input peer w-full h-28 p-6 border-2 border-dashed border-amber-200 
                                   dark:border-amber-400 rounded-3xl focus:ring-4 focus:ring-amber-500/40 
                                   focus:border-amber-500 dark:bg-slate-800/60 cursor-pointer transition-all 
                                   duration-300 hover:border-amber-300 hover:bg-amber-50/60 file:hidden">
                            <div class="upload-area absolute inset-0 flex flex-col items-center justify-center rounded-3xl 
                                 bg-gradient-to-br from-amber-50/90 to-orange-50/90 dark:from-amber-900/30 
                                 dark:to-orange-900/30 border-2 border-dashed border-amber-200 
                                 dark:border-amber-400/60 pointer-events-none peer-focus:border-amber-400 
                                 peer-hover:border-amber-300 transition-all duration-400">
                                <svg class="w-14 h-14 text-amber-500 mb-4 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 4 0 1115.9 6L16 6a5 4 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                </svg>
                                <p class="text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">Drop file atau klik</p>
                                <p class="text-xs text-slate-500 dark:text-slate-400">MP3, WAV, MP4</p>
                            </div>
                            <div id="editCurrentLaguPreview" class="current-preview hidden absolute inset-0 
                                 bg-gradient-to-r from-amber-500/15 to-orange-500/15 rounded-3xl 
                                 border-2 border-amber-300 pointer-events-none">
                                <div class="flex flex-col items-center justify-center h-full p-6 text-center">
                                    <svg class="w-14 h-14 text-amber-500 mb-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 9V5l-3 3 3 3v-4z"/>
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 102 0v-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <div id="editLaguPreviewName" class="font-semibold text-sm text-amber-800 dark:text-amber-200 
                                         truncate max-w-[220px]"></div>
                                </div>
                            </div>
                        </div>
                        <div id="editLaguError" class="mt-4 min-h-[20px]"></div>
                    </div>

                    {{-- Instrumen --}}
                    <div class="bg-gradient-to-br from-purple-50/70 to-indigo-50/70 dark:from-purple-900/20 dark:to-indigo-900/20 
                                 rounded-3xl p-8 border-2 border-purple-200/50 dark:border-purple-400/30">
                        <label class="block text-lg font-bold text-slate-800 dark:text-slate-200 mb-6 flex items-center gap-3">
                            <svg class="w-8 h-8 text-purple-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                            </svg>
                            Instrumen
                        </label>
                        <div class="relative">
                            <input type="file" name="instrumen" id="editInstrumenUpload" accept="audio/*,video/*"
                                   class="upload-input peer w-full h-28 p-6 border-2 border-dashed border-purple-200 
                                   dark:border-purple-400 rounded-3xl focus:ring-4 focus:ring-purple-500/40 
                                   focus:border-purple-500 dark:bg-slate-800/60 cursor-pointer transition-all 
                                   duration-300 hover:border-purple-300 hover:bg-purple-50/60 file:hidden">
                            <div class="upload-area absolute inset-0 flex flex-col items-center justify-center rounded-3xl 
                                 bg-gradient-to-br from-purple-50/90 to-indigo-50/90 dark:from-purple-900/30 
                                 dark:to-indigo-900/30 border-2 border-dashed border-purple-200 
                                 dark:border-purple-400/60 pointer-events-none peer-focus:border-purple-400 
                                 peer-hover:border-purple-300 transition-all duration-400">
                                <svg class="w-14 h-14 text-purple-500 mb-4 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 4 0 1115.9 6L16 6a5 4 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                </svg>
                                <p class="text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">Drop file atau klik</p>
                                <p class="text-xs text-slate-500 dark:text-slate-400">MP3, MP4, WAV, OGG</p>
                            </div>
                            <div id="editCurrentInstrumenPreview" class="current-preview hidden absolute inset-0 
                                 bg-gradient-to-r from-purple-500/15 to-indigo-500/15 rounded-3xl 
                                 border-2 border-purple-300 pointer-events-none">
                                <div class="flex flex-col items-center justify-center h-full p-6 text-center">
                                    <svg class="w-14 h-14 text-purple-500 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                                    </svg>
                                    <div id="editInstrumenPreviewName" class="font-semibold text-sm text-purple-800 
                                         dark:text-purple-200 truncate max-w-[220px]"></div>
                                </div>
                            </div>
                        </div>
                        <div id="editInstrumenError" class="mt-4 min-h-[20px]"></div>
                    </div>
                </div>

                {{-- DESKRIPSI --}}
                <div class="space-y-6">
                    <div class="bg-gradient-to-r from-blue-50/60 to-indigo-50/60 dark:from-slate-800/50 dark:to-slate-700/50 
                                 rounded-3xl p-8 border border-blue-200/50 dark:border-slate-600/50">
                        <h3 class="text-xl font-bold text-slate-800 dark:text-slate-200 mb-6 flex items-center gap-3">
                            <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Deskripsi Lengkap
                        </h3>
                        <div class="grid lg:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3">Alamat</label>
                                <textarea name="alamat" id="editAlamat" rows="3" 
                                          class="w-full p-5 border border-slate-200 dark:border-slate-600 rounded-2xl 
                                          focus:ring-4 focus:ring-blue-500/30 focus:border-blue-500 
                                          dark:bg-slate-700/80 dark:text-white resize-vertical transition-all duration-300"></textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3">Motto</label>
                                <textarea name="motto" id="editMotto" rows="2" 
                                          class="w-full p-5 border border-slate-200 dark:border-slate-600 rounded-2xl 
                                          focus:ring-4 focus:ring-blue-500/30 focus:border-blue-500 
                                          dark:bg-slate-700/80 dark:text-white resize-vertical transition-all duration-300"></textarea>
                            </div>
                        </div>
                        <div class="grid md:grid-cols-2 gap-6 pt-2">
                            <div>
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3">Fungsi</label>
                                <textarea name="fungsi" id="editFungsi" rows="4" 
                                          class="w-full p-5 border border-slate-200 dark:border-slate-600 rounded-2xl 
                                          focus:ring-4 focus:ring-blue-500/30 focus:border-blue-500 
                                          dark:bg-slate-700/80 dark:text-white resize-vertical transition-all duration-300"></textarea>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3">Tujuan</label>
                                <textarea name="tujuan" id="editTujuan" rows="4" 
                                          class="w-full p-5 border border-slate-200 dark:border-slate-600 rounded-2xl 
                                          focus:ring-4 focus:ring-blue-500/30 focus:border-blue-500 
                                          dark:bg-slate-700/80 dark:text-white resize-vertical transition-all duration-300"></textarea>
                            </div>
                        </div>
                    </div>

                    {{-- VISI & MISI --}}
                    <div class="grid lg:grid-cols-2 gap-6">
                        <div class="bg-gradient-to-t from-emerald-50/70 via-blue-50/50 to-purple-50/50 
                                     dark:from-slate-800/50 dark:to-slate-700/50 rounded-3xl p-8 
                                     border border-emerald-200/40 dark:border-slate-600/50">
                            <label class="block text-lg font-bold text-slate-800 dark:text-slate-200 mb-6 flex items-center gap-3">
                                <svg class="w-8 h-8 text-emerald-600 bg-emerald-100 rounded-2xl p-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Visi
                            </label>
                            <textarea name="visi" id="editVisi" rows="4" 
                                      class="w-full p-5 border border-slate-200 dark:border-slate-600 rounded-2xl 
                                      focus:ring-4 focus:ring-emerald-500/40 focus:border-emerald-500 
                                      dark:bg-slate-700/80 dark:text-white resize-vertical transition-all duration-300"></textarea>
                        </div>

                        <div class="bg-gradient-to-t from-purple-50/70 via-indigo-50/50 to-blue-50/50 
                                     dark:from-slate-800/50 dark:to-slate-700/50 rounded-3xl p-8 
                                     border border-purple-200/40 dark:border-slate-600/50">
                            <label class="block text-lg font-bold text-slate-800 dark:text-slate-200 mb-6 flex items-center gap-3">
                                <svg class="w-8 h-8 text-purple-600 bg-purple-100 rounded-2xl p-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Misi
                            </label>
                            <textarea name="misi" id="editMisi" rows="4" 
                                      class="w-full p-5 border border-slate-200 dark:border-slate-600 rounded-2xl 
                                      focus:ring-4 focus:ring-purple-500/40 focus:border-purple-500 
                                      dark:bg-slate-700/80 dark:text-white resize-vertical transition-all duration-300"></textarea>
                        </div>
                    </div>

                    {{-- Sejarah --}}
                    <div class="bg-gradient-to-r from-amber-50/60 to-slate-50/60 dark:from-slate-800/50 dark:to-slate-700/50 
                                 rounded-3xl p-8 border border-amber-200/50 dark:border-slate-600/50">
                        <label class="block text-lg font-bold text-slate-800 dark:text-slate-200 mb-6 flex items-center gap-3">
                            <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Sejarah Organisasi
                        </label>
                        <textarea name="sejarah" id="editSejarah" rows="6" 
                                  class="w-full p-5 border border-slate-200 dark:border-slate-600 rounded-2xl 
                                   focus:ring-4 focus:ring-amber-500/30 focus:border-amber-500 
                                   dark:bg-slate-700/80 dark:text-white resize-vertical transition-all duration-300"></textarea>
                    </div>
                </div>

                <div class="flex gap-3 p-8 pt-0 border-t border-slate-200 dark:border-slate-700">
                    <button type="submit" form="editForm" class="flex-1 bg-blue-600 text-white font-bold py-4 px-6 rounded-xl hover:bg-blue-700 transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-1 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Update Profil
                    </button>
                    <button type="button" onclick="closeEditModal()" class="px-6 py-4 bg-slate-200 dark:bg-slate-700 text-slate-800 dark:text-slate-200 font-bold rounded-xl hover:bg-slate-300 dark:hover:bg-slate-600 transition-all duration-300">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


{{-- DELETE MODAL --}}
{{-- DELETE MODAL PERBAIKAN --}}
<div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 z-50 hidden flex items-center justify-center p-6">
    <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-2xl max-w-md w-full mx-4">
        <div class="p-8 text-center">
            {{-- Icon Warning --}}
            <div class="mx-auto flex items-center justify-center h-24 w-24 rounded-3xl bg-gradient-to-br from-red-100/80 to-red-50/80 dark:from-red-900/30 dark:to-red-800/20 mb-8 border-4 border-red-100 dark:border-red-900/50 shadow-lg">
                <svg class="w-12 h-12 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
            </div>
            
            {{-- Title --}}
            <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-3">Hapus Organisasi?</h3>
            
            {{-- Subtitle --}}
            <p class="text-slate-600 dark:text-slate-400 text-lg mb-2 font-medium"> 
                "<span id="deleteOrgName" class="font-bold text-slate-900 dark:text-white bg-gradient-to-r from-slate-900 to-slate-700 bg-clip-text text-transparent dark:from-slate-200 dark:to-slate-100"></span>"
            </p>
            
            {{-- Description --}}
            <p class="text-slate-600 dark:text-slate-400 mb-8 leading-relaxed">
                Tindakan ini akan menghapus seluruh data organisasi secara permanen dan <strong class="text-red-600 dark:text-red-400">tidak dapat dikembalikan</strong>.
            </p>
            
            {{-- Hidden Input --}}
            <input type="hidden" id="deleteId" name="id">
            
            {{-- Action Buttons --}}
            <div class="flex gap-3 pt-4">
                <button id="confirmDeleteBtn" type="button"
                        class="flex-1 bg-gradient-to-r from-red-600 to-red-700 text-white font-bold py-4 px-8 rounded-2xl 
                        hover:from-red-700 hover:to-red-800 focus:ring-4 focus:ring-red-500/30 focus:outline-none 
                        shadow-xl hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-2
                        dark:from-red-600 dark:to-red-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Ya, Hapus!
                </button>
                <button onclick="closeDeleteModal()" 
                        class="px-8 py-4 bg-gradient-to-r from-slate-200 to-slate-300 dark:from-slate-700 dark:to-slate-600 
                        text-slate-800 dark:text-slate-200 font-bold rounded-2xl hover:from-slate-300 hover:to-slate-400 
                        dark:hover:from-slate-600 dark:hover:to-slate-500 focus:ring-4 focus:ring-slate-500/30 
                        shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <svg class="w-5 h-5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>
