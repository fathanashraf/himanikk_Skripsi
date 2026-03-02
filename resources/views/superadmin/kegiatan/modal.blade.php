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
<div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 z-50 hidden overflow-y-auto">
    <div class="relative top-20 mx-auto p-6 w-11/12 md:w-3/4 lg:w-1/2 max-h-[90vh] overflow-y-auto">
        <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-2xl">
            <!-- HEADER -->
            <div class="p-8 border-b border-slate-200 dark:border-slate-700 flex justify-between items-center">
                <h3 class="text-2xl font-bold text-slate-900 dark:text-white">Edit Profil Organisasi</h3>
                <button onclick="closeEditModal()" id="closeEditModal" 
                        class="p-2 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-xl transition-colors">
                    <svg class="w-6 h-6 text-slate-500 hover:text-slate-900 dark:hover:text-white" 
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- FORM -->
            <form id="editForm" enctype="multipart/form-data" class="p-8 space-y-8 max-w-2xl mx-auto">
                <!-- HIDDEN FIELD -->
                <input type="hidden" name="id" id="editId">

                <!-- HEADER SECTION -->
                <div class="text-center pb-8 border-b border-slate-200/50 dark:border-slate-700/50">
                    <div class="w-20 h-20 bg-gradient-to-br from-emerald-100 to-emerald-200 
                                dark:from-emerald-900/50 rounded-3xl flex items-center justify-center 
                                mx-auto mb-6 shadow-xl">
                        <svg class="w-12 h-12 text-emerald-600" fill="none" stroke="currentColor" 
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-black bg-gradient-to-r from-slate-900 to-slate-700 
                               bg-clip-text text-transparent dark:from-slate-100 dark:to-slate-400">
                        Edit Profil Organisasi
                    </h2>
                    <p class="text-slate-600 dark:text-slate-400 mt-2">Perbarui informasi organisasi Anda</p>
                </div>

                <!-- BASIC INFO SECTION -->
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3 
                                     flex items-center gap-2">
                            <svg class="w-5 h-5 text-emerald-500 flex-shrink-0" fill="none" 
                                 stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Nama Organisasi <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" name="name" id="editName" required 
                               class="w-full p-5 border-2 border-slate-200/60 dark:border-slate-600/60 
                                      rounded-2xl focus:ring-4 focus:ring-emerald-500/20 focus:border-emerald-500 
                                      dark:bg-slate-800/50 dark:text-white dark:placeholder-slate-400 
                                      transition-all duration-300 shadow-sm hover:shadow-md"
                               placeholder="Masukkan nama organisasi lengkap">
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3 
                                         flex items-center gap-2">
                                <svg class="w-5 h-5 text-blue-500 flex-shrink-0" fill="none" 
                                     stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M3 8l7.27 4.84A2 2 0 0110.73 11H20"/>
                                </svg>
                                Email Kontak
                            </label>
                            <input type="email" name="email" id="editEmail" 
                                   class="w-full p-5 border-2 border-slate-200/60 dark:border-slate-600/60 
                                          rounded-2xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 
                                          dark:bg-slate-800/50 dark:text-white dark:placeholder-slate-400 
                                          transition-all duration-300 shadow-sm hover:shadow-md"
                                   placeholder="contoh@organisasi.ac.id">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3 
                                         flex items-center gap-2">
                                <svg class="w-5 h-5 text-amber-500 flex-shrink-0" fill="none" 
                                     stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Logo Organisasi
                            </label>
                            <div class="space-y-3">
                                <input type="file" name="logo" id="editLogo" 
                                       accept="image/*,image/jpeg,image/png,image/webp" 
                                       class="w-full p-5 border-2 border-dashed border-slate-200/60 
                                              dark:border-slate-600/60 rounded-2xl dark:bg-slate-800/30 
                                              dark:text-white file:mr-4 file:py-3 file:px-4 file:rounded-xl 
                                              file:border-0 file:text-sm file:font-semibold 
                                              file:bg-gradient-to-r file:from-emerald-50 file:to-emerald-100 
                                              file:text-emerald-700 hover:file:from-emerald-100 
                                              hover:file:to-emerald-200 transition-all duration-300 
                                              cursor-pointer hover:border-emerald-300/50">
                                <div id="currentLogoPreview" 
                                     class="p-4 bg-gradient-to-r from-slate-50 to-slate-100 
                                            dark:from-slate-800/50 dark:to-slate-900/50 rounded-2xl 
                                            border-2 border-dashed border-slate-200/50 
                                            dark:border-slate-700/50 text-center hidden shadow-sm">
                                    <img id="logoPreviewImg" 
                                         class="w-20 h-20 object-contain rounded-xl mx-auto shadow-lg mb-2" 
                                         alt="Logo saat ini">
                                    <p class="text-xs text-slate-500 dark:text-slate-400">
                                        Logo saat ini akan ditampilkan di sini
                                    </p>
                                </div>
                                <p id="logoHelper" class="text-xs text-slate-500 dark:text-slate-400 italic">
                                    Kosongkan untuk mempertahankan logo lama • Format: JPG, PNG, WebP (Max 2MB)
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- MEDIA SECTION -->
                <div class="space-y-6">
                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- LAGU MARS -->
                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3 
                                             flex items-center gap-2">
                                    <svg class="w-5 h-5 text-amber-500 flex-shrink-0" fill="none" 
                                         stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                    </svg>
                                    🎵 Lagu Mars Organisasi (MP3)
                                </label>
                                <div class="space-y-4">
                                    <!-- Upload Area -->
                                    <div class="upload-zone audio-zone border-2 border-dashed border-amber-200/60 
                                               dark:border-amber-600/60 rounded-3xl p-6 hover:border-amber-300/80 
                                               dark:hover:border-amber-400/80 transition-all duration-300 
                                               hover:shadow-xl bg-gradient-to-br from-amber-50/50 to-amber-25 
                                               dark:from-amber-900/20 dark:to-amber-800/10 cursor-pointer 
                                               group hover:scale-[1.02]">
                                        <input type="file" name="lagu_file" id="editLaguFile" 
                                               accept="audio/mpeg,audio/mp3" 
                                               class="absolute inset-0 w-full h-full opacity-0 cursor-pointer group-hover:scale-[1.02]">
                                        <div class="text-center pointer-events-none">
                                            <div class="w-16 h-16 bg-gradient-to-br from-amber-100 to-amber-200 
                                                       dark:from-amber-900/50 mx-auto mb-4 rounded-2xl flex 
                                                       items-center justify-center shadow-lg 
                                                       group-hover:rotate-12 transition-transform duration-500">
                                                <svg class="w-8 h-8 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M10 9V5l-3 3 3 3v-4z"/>
                                                    <path fill-rule="evenodd" 
                                                          d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 102 0v-4z" 
                                                          clip-rule="evenodd"/>
                                                </svg>
                                            </div>
                                            <p class="font-semibold text-amber-800 dark:text-amber-200 mb-1">Upload MP3</p>
                                            <p class="text-sm text-amber-600 dark:text-amber-300">
                                                Drag & drop atau klik untuk pilih file
                                            </p>
                                            <p class="text-xs text-amber-500 dark:text-amber-400 mt-2 font-mono 
                                                   bg-amber-100/50 dark:bg-amber-900/30 px-2 py-1 rounded-lg inline-block">
                                                audio/mpeg, .mp3
                                            </p>
                                        </div>
                                    </div>
                                    <!-- Preview Area -->
                                    <div id="currentLaguPreview" 
                                         class="p-6 bg-gradient-to-r from-amber-50/80 to-amber-100/80 
                                                dark:from-amber-900/20 rounded-3xl border-2 border-dashed 
                                                border-amber-200/50 shadow-lg hidden">
                                        <div class="flex items-center gap-4">
                                            <div class="w-16 h-16 bg-gradient-to-br from-amber-100 to-amber-200 
                                                       dark:from-amber-900/50 rounded-2xl flex items-center 
                                                       justify-center flex-shrink-0 shadow-xl">
                                                <svg class="w-8 h-8 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M10 9V5l-3 3 3 3v-4z"/>
                                                    <path fill-rule="evenodd" 
                                                          d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 102 0v-4z" 
                                                          clip-rule="evenodd"/>
                                                </svg>
                                            </div>
                                            <div class="min-w-0 flex-1">
                                                <div id="laguPreviewName" 
                                                     class="font-bold text-lg text-amber-900 dark:text-amber-100 truncate mb-1"></div>
                                                <div class="flex items-center gap-2 text-sm text-amber-700 dark:text-amber-300">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <!-- CONTINUATION FROM PREVIOUS CODE -->

                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                              d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                                    </svg>
                                                    <span id="laguPreviewSize" class="font-mono text-xs"></span>
                                                </div>
                                                <audio id="laguPreviewPlayer" controls 
                                                       class="w-full mt-3 rounded-xl shadow-md"></audio>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 italic text-center">
                                        ✅ Tanpa batas ukuran • Hanya MP3 • Auto-play preview
                                    </p>
                                </div>
                            </div>

                            <!-- VIDEO PROFILE -->
                            <div>
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3 
                                             flex items-center gap-2">
                                    <svg class="w-5 h-5 text-purple-500 flex-shrink-0" fill="none" 
                                         stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                    </svg>
                                    🎬 Video Profile (MP4)
                                </label>
                                <div class="space-y-4">
                                    <!-- Upload Area -->
                                    <div class="upload-zone video-zone border-2 border-dashed border-purple-200/60 
                                               dark:border-purple-600/60 rounded-3xl p-6 hover:border-purple-300/80 
                                               dark:hover:border-purple-400/80 transition-all duration-300 
                                               hover:shadow-xl bg-gradient-to-br from-purple-50/50 to-purple-25 
                                               dark:from-purple-900/20 dark:to-purple-800/10 cursor-pointer 
                                               group hover:scale-[1.02]">
                                        <input type="file" name="video_file" id="editVideoFile" 
                                               accept="video/mp4,video/mpeg" 
                                               class="absolute inset-0 w-full h-full opacity-0 cursor-pointer group-hover:scale-[1.02]">
                                        <div class="text-center pointer-events-none">
                                            <div class="w-16 h-16 bg-gradient-to-br from-purple-100 to-purple-200 
                                                       dark:from-purple-900/50 mx-auto mb-4 rounded-2xl flex 
                                                       items-center justify-center shadow-lg 
                                                       group-hover:rotate-12 transition-transform duration-500">
                                                <svg class="w-8 h-8 text-purple-600" fill="none" 
                                                     stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                          d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                                </svg>
                                            </div>
                                            <p class="font-semibold text-purple-800 dark:text-purple-200 mb-1">Upload MP4</p>
                                            <p class="text-sm text-purple-600 dark:text-purple-300">
                                                Drag & drop atau klik untuk pilih video
                                            </p>
                                            <p class="text-xs text-purple-500 dark:text-purple-400 mt-2 font-mono 
                                                   bg-purple-100/50 dark:bg-purple-900/30 px-2 py-1 rounded-lg inline-block">
                                                video/mp4, .mp4
                                            </p>
                                        </div>
                                    </div>
                                    <!-- Preview Area -->
                                    <div id="currentVideoPreview" 
                                         class="p-6 bg-gradient-to-r from-purple-50/80 to-purple-100/80 
                                                dark:from-purple-900/20 rounded-3xl border-2 border-dashed 
                                                border-purple-200/50 shadow-lg hidden">
                                        <div class="flex items-center gap-4">
                                            <div class="w-16 h-16 bg-gradient-to-br from-purple-100 to-purple-200 
                                                       dark:from-purple-900/50 rounded-2xl flex items-center 
                                                       justify-center flex-shrink-0 shadow-xl">
                                                <svg class="w-8 h-8 text-purple-600" fill="none" 
                                                     stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                          d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                                </svg>
                                            </div>
                                            <div class="min-w-0 flex-1">
                                                <div id="videoPreviewName" 
                                                     class="font-bold text-lg text-purple-900 dark:text-purple-100 truncate mb-1"></div>
                                                <div class="flex items-center gap-2 text-sm text-purple-700 dark:text-purple-300">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                              d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                                    </svg>
                                                    <span id="videoPreviewSize" class="font-mono text-xs"></span>
                                                </div>
                                                <video id="videoPreviewPlayer" controls 
                                                       class="w-full mt-3 rounded-xl shadow-md max-h-48" poster=""></video>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 italic text-center">
                                        ✅ Tanpa batas ukuran • Hanya MP4 • Auto-play preview • Responsive player
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CONTENT SECTIONS -->
                <div class="space-y-6">
                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- MOTTO & FUNGSI -->
                        <div>
                            <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3 
                                         flex items-center gap-2">
                                <svg class="w-5 h-5 text-indigo-500 flex-shrink-0" fill="none" 
                                     stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                                Motto Organisasi
                            </label>
                            <textarea name="motto" id="editMotto" rows="2" 
                                      class="w-full p-5 border-2 border-slate-200/60 dark:border-slate-600/60 
                                             rounded-2xl focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 
                                             dark:bg-slate-800/50 dark:text-white dark:placeholder-slate-400 
                                             transition-all duration-300 shadow-sm hover:shadow-md resize-vertical 
                                             min-h-[80px]"
                                      placeholder="Masukkan motto organisasi (singkat & bermakna)"></textarea>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-2">
                                Maksimal 100 karakter - tampil di profil singkat
                            </p>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3 
                                         flex items-center gap-2">
                                <svg class="w-5 h-5 text-sky-500 flex-shrink-0" fill="none" 
                                     stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                                Fungsi Utama
                            </label>
                            <textarea name="fungsi" id="editFungsi" rows="4" 
                                      class="w-full p-5 border-2 border-slate-200/60 dark:border-slate-600/60 
                                             rounded-2xl focus:ring-4 focus:ring-sky-500/20 focus:border-sky-500 
                                             dark:bg-slate-800/50 dark:text-white dark:placeholder-slate-400 
                                             transition-all duration-300 shadow-sm hover:shadow-md resize-vertical 
                                             min-h-[120px]"
                                      placeholder="Jelaskan fungsi dan tugas utama organisasi..."></textarea>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-2">
                                Tampil di deskripsi singkat organisasi
                            </p>
                        </div>
                    </div>

                    <!-- TUJUAN ORGANISASI -->
                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3 
                                     flex items-center gap-2">
                            <svg class="w-5 h-5 text-emerald-500 flex-shrink-0" fill="none" 
                                 stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Tujuan Organisasi
                        </label>
                        <textarea name="tujuan" id="editTujuan" rows="6" 
                                  class="w-full p-5 border-2 border-slate-200/60 dark:border-slate-600/60 
                                         rounded-2xl focus:ring-4 focus:ring-emerald-500/20 focus:border-emerald-500 
                                         dark:bg-slate-800/50 dark:text-white dark:placeholder-slate-400 
                                         transition-all duration-300 shadow-sm hover:shadow-md resize-vertical 
                                         min-h-[160px]"
                                  placeholder="Jelaskan visi dan tujuan jangka panjang organisasi Anda..."></textarea>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-2">
                            Tujuan strategis organisasi - tampil di halaman detail
                        </p>
                    </div>

                    <!-- VISI & MISI -->
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3 
                                         flex items-center gap-2">
                                <svg class="w-5 h-5 text-violet-500 flex-shrink-0" fill="none" 
                                     stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Visi Organisasi
                            </label>
                            <textarea name="visi" id="editVisi" rows="4" 
                                      class="w-full p-5 border-2 border-slate-200/60 dark:border-slate-600/60 
                                             rounded-2xl focus:ring-4 focus:ring-violet-500/20 focus:border-violet-500 
                                             dark:bg-slate-800/50 dark:text-white dark:placeholder-slate-400 
                                             transition-all duration-300 shadow-sm hover:shadow-md resize-vertical 
                                             min-h-[120px]"
                                      placeholder="Visi jangka panjang yang ingin dicapai organisasi..."></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3 
                                         flex items-center gap-2">
                                <svg class="w-5 h-5 text-rose-500 flex-shrink-0" fill="none" 
                                     stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                </svg>
                                Misi Organisasi
                            </label>
                            <textarea name="misi" id="editMisi" rows="4" 
                                      class="w-full p-5 border-2 border-slate-200/60 dark:border-slate-600/60 
                                             rounded-2xl focus:ring-4 focus:ring-rose-500/20 focus:border-rose-500 
                                             dark:bg-slate-800/50 dark:text-white dark:placeholder-slate-400 
                                             transition-all duration-300 shadow-sm hover:shadow-md resize-vertical 
                                             min-h-[120px]"
                                      placeholder="Langkah-langkah strategis untuk mencapai visi..."></textarea>
                        </div>
                    </div>

                    <!-- SEJARAH -->
                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3 
                                     flex items-center gap-2">
                            <svg class="w-5 h-5 text-slate-500 flex-shrink-0" fill="none" 
                                 stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Sejarah Singkat
                        </label>
                        <textarea name="sejarah" id="editSejarah" rows="6" 
                                  class="w-full p-5 border-2 border-slate-200/60 dark:border-slate-600/60 
                                         rounded-2xl focus:ring-4 focus:ring-slate-500/20 focus:border-slate-500 
                                         dark:bg-slate-800/50 dark:text-white dark:placeholder-slate-400 
                                         transition-all duration-300 shadow-sm hover:shadow-md resize-vertical 
                                         min-h-[160px]"
                                  placeholder="Ceritakan sejarah berdirinya organisasi dan milestone penting..."></textarea>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-2">
                            Sejarah organisasi - maksimal 1000 karakter
                        </p>
                    </div>
                </div>

                <!-- ACTION BUTTONS -->
                <div class="flex gap-3 p-8 pt-0 border-t border-slate-200 dark:border-slate-700">
                    <button type="submit" form="editForm" 
                            class="flex-1 bg-emerald-600 text-white font-bold py-4 px-6 rounded-xl 
                                   hover:bg-emerald-700 transition-all duration-300 shadow-lg 
                                   hover:shadow-xl hover:-translate-y-1 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M5 13l4 4L19 7"/>
                        </svg>
                        Update Profil
                    </button>
                    <button type="button" onclick="closeEditModal()" id="cancelEditBtn" 
                            class="px-6 py-4 bg-slate-200 dark:bg-slate-700 text-slate-800 
                                   dark:text-slate-200 font-bold rounded-xl hover:bg-slate-300 
                                   dark:hover:bg-slate-600 transition-all duration-300">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- DELETE MODAL --}}
{{-- DELETE MODAL (Alpine.js Compatible) --}}
<div 
    x-show="deleteModal.open" 
    x-data 
    id="deleteModal"
    class="fixed inset-0 bg-gray-600 bg-opacity-50 z-[9999] flex items-center justify-center p-6"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    @keyup.escape="closeDeleteModal()"
    @click.away="closeDeleteModal()"
    x-cloak
    style="display: none"
>
    <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-2xl max-w-md w-full mx-4 max-h-[90vh] overflow-y-auto border-4 border-white/20" @click.stop>
        <!-- Header -->
        <div class="p-8 text-center border-b border-slate-200/50 dark:border-slate-700/50">
            <div class="w-20 h-20 bg-red-100 dark:bg-red-900/30 rounded-3xl flex items-center justify-center mx-auto mb-6 backdrop-blur-sm">
                <svg class="w-12 h-12 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-4">Hapus Kegiatan?</h3>
            <p class="text-slate-600 dark:text-slate-400 mb-8 max-w-sm mx-auto leading-relaxed" 
               x-text="deleteModal.data?.name ? `Apakah Anda yakin ingin menghapus kegiatan "${deleteModal.data.name}"?` : 'Apakah Anda yakin ingin menghapus kegiatan ini?'"
            ></p>
        </div>
        
        <!-- Action Buttons -->
        <div class="p-8 pt-0 flex gap-3">
            <button 
                @click="confirmDelete()" 
                class="flex-1 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-bold py-4 px-6 rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-2"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
                Hapus Kegiatan
            </button>
            <button 
                @click="closeDeleteModal()" 
                class="px-6 py-4 bg-slate-200/80 dark:bg-slate-700/80 hover:bg-slate-300 dark:hover:bg-slate-600 text-slate-800 dark:text-slate-200 font-bold rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300 backdrop-blur-sm"
            >
                Batal
            </button>
        </div>
    </div>
</div>

