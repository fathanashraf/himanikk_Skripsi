{{-- CREATE MODAL --}}
<div id="createPendaftaranModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 z-50 hidden overflow-y-auto">
    <div class="relative top-20 mx-auto p-6 w-11/12 md:w-3/4 lg:w-1/2 max-h-[90vh] overflow-y-auto">
        <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-2xl">
            <div class="p-8 border-b border-slate-200 dark:border-slate-700 flex justify-between items-center">
                <h3 class="text-2xl font-bold text-slate-900 dark:text-white">Tambah Pendaftaran HIMANIKKA</h3>
                <button type="button" onclick="closeCreatePendaftaranModal()" class="p-3 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-xl transition-all duration-200">
                    <svg class="w-6 h-6 text-slate-500 hover:text-slate-900 dark:hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            
            <form id="createPendaftaranForm" action="{{ route('admin.pendaftaran.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
                @csrf
                <div id="createErrors" class="space-y-2 hidden"></div>

                {{-- Basic Info --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3 required">Nama Lengkap *</label>
                        <input type="text" name="name" maxlength="255" required 
                               class="w-full p-4 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:bg-slate-700 dark:text-white transition-all duration-200"
                               placeholder="Masukkan nama lengkap">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3 required">Email *</label>
                        <input type="email" name="email" maxlength="255" required 
                               class="w-full p-4 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:bg-slate-700 dark:text-white transition-all duration-200"
                               placeholder="example@email.com">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3 required">Nomor HP *</label>
                        <input type="tel" name="phone" maxlength="20" required 
                               class="w-full p-4 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:bg-slate-700 dark:text-white transition-all duration-200"
                               placeholder="08xxxxxxxxxx">
                    </div>
                </div>

                {{-- User Selection (Optional) --}}
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3">User (Opsional)</label>
                    <div class="relative">
                        <select name="user_id" class="w-full p-4 pl-12 pr-10 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:bg-slate-700 dark:text-white transition-all duration-200 appearance-none">
                            <option value="">-- Pilih User (Opsional) --</option>
                            @forelse($users ?? [] as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                            @empty
                                <option disabled>Tidak ada user tersedia</option>
                            @endforelse
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </div>
                    </div>
                    <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Kosongkan jika pendaftaran manual</p>
                </div>

                {{-- Referensi Selection (TUNGGAL) --}}
                <div>
    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-6 required">Pilih Referensi *</label>
    
    {{-- Acara --}}
    @if(isset($acaras) && $acaras->count() > 0)
    <div class="mb-6 p-5 bg-gradient-to-r from-orange-50 to-orange-100 dark:from-orange-900/20 dark:to-orange-800/20 border-2 border-orange-200 dark:border-orange-700 rounded-3xl hover:shadow-lg transition-all duration-200 cursor-pointer reference-section" data-target="acara_id">
        <label class="flex items-center justify-between w-full">
            <div class="flex items-center">
                <input type="radio" name="reference_type" value="acara" id="ref_acara" class="w-5 h-5 text-orange-600 bg-orange-100 border-orange-300 focus:ring-orange-500 mr-3 rounded-full">
                <svg class="w-6 h-6 mr-3 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                </svg>
                <span class="text-lg font-bold text-orange-800 dark:text-orange-200">Acara</span>
                <span class="ml-2 text-sm bg-orange-200 dark:bg-orange-800/50 px-3 py-1 rounded-full font-medium text-orange-700 dark:text-orange-200">({{ $acaras->count() }})</span>
            </div>
        </label>
        <div class="mt-4 pt-4 border-t border-orange-200 dark:border-orange-700">
            <select name="acara_id" class="reference-field w-full p-4 border border-orange-200 dark:border-orange-600 rounded-2xl focus:ring-2 focus:ring-orange-500 focus:border-transparent dark:bg-slate-700 dark:text-white transition-all duration-200 appearance-none hidden" required>
                <option value="">-- Pilih Acara --</option>
                @foreach($acaras as $acara)
                    <option value="{{ $acara->id }}">{{ $acara->name ?? $acara->title }}</option>
                @endforeach
            </select>
        </div>
    </div>
    @endif

    {{-- Kegiatan --}}
    @if(isset($kegiatans) && $kegiatans->count() > 0)
    <div class="mb-6 p-5 bg-gradient-to-r from-purple-50 to-purple-100 dark:from-purple-900/20 dark:to-purple-800/20 border-2 border-purple-200 dark:border-purple-700 rounded-3xl hover:shadow-lg transition-all duration-200 cursor-pointer reference-section" data-target="kegiatan_id">
        <label class="flex items-center justify-between w-full">
            <div class="flex items-center">
                <input type="radio" name="reference_type" value="kegiatan" id="ref_kegiatan" class="w-5 h-5 text-purple-600 bg-purple-100 border-purple-300 focus:ring-purple-500 mr-3 rounded-full">
                <svg class="w-6 h-6 mr-3 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="text-lg font-bold text-purple-800 dark:text-purple-200">Kegiatan</span>
                <span class="ml-2 text-sm bg-purple-200 dark:bg-purple-800/50 px-3 py-1 rounded-full font-medium text-purple-700 dark:text-purple-200">({{ $kegiatans->count() }})</span>
            </div>
        </label>
        <div class="mt-4 pt-4 border-t border-purple-200 dark:border-purple-700">
            <select name="kegiatan_id" class="reference-field w-full p-4 border border-purple-200 dark:border-purple-600 rounded-2xl focus:ring-2 focus:ring-purple-500 focus:border-transparent dark:bg-slate-700 dark:text-white transition-all duration-200 appearance-none hidden" required>
                <option value="">-- Pilih Kegiatan --</option>
                @foreach($kegiatans as $kegiatan)
                    <option value="{{ $kegiatan->id }}">{{ $kegiatan->name ?? $kegiatan->title }}</option>
                @endforeach
            </select>
        </div>
    </div>
    @endif

    {{-- Event --}}
    @if(isset($events) && $events->count() > 0)
    <div class="mb-6 p-5 bg-gradient-to-r from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/20 border-2 border-blue-200 dark:border-blue-700 rounded-3xl hover:shadow-lg transition-all duration-200 cursor-pointer reference-section" data-target="event_id">
        <label class="flex items-center justify-between w-full">
            <div class="flex items-center">
                <input type="radio" name="reference_type" value="event" id="ref_event" class="w-5 h-5 text-blue-600 bg-blue-100 border-blue-300 focus:ring-blue-500 mr-3 rounded-full">
                <svg class="w-6 h-6 mr-3 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                </svg>
                <span class="text-lg font-bold text-blue-800 dark:text-blue-200">Event</span>
                <span class="ml-2 text-sm bg-blue-200 dark:bg-blue-800/50 px-3 py-1 rounded-full font-medium text-blue-700 dark:text-blue-200">({{ $events->count() }})</span>
            </div>
        </label>
        <div class="mt-4 pt-4 border-t border-blue-200 dark:border-blue-700">
            <select name="event_id" class="reference-field w-full p-4 border border-blue-200 dark:border-blue-600 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-slate-700 dark:text-white transition-all duration-200 appearance-none hidden" required>
                <option value="">-- Pilih Event --</option>
                @foreach($events as $event)
                    <option value="{{ $event->id }}">{{ $event->name ?? $event->title }}</option>
                @endforeach
            </select>
        </div>
    </div>
    @endif

    @if(!isset($acaras) && !isset($kegiatans) && !isset($events))
    <div class="text-center py-12 bg-gradient-to-br from-slate-50 to-slate-100 dark:from-slate-800 dark:to-slate-900 rounded-3xl border-2 border-dashed border-slate-300 dark:border-slate-600">
        <svg class="w-20 h-20 text-slate-400 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2 2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
        </svg>
        <h3 class="text-xl font-bold text-slate-700 dark:text-slate-200 mb-2">Belum ada referensi</h3>
        <p class="text-slate-500 dark:text-slate-400 text-lg mb-4">Buat acara, kegiatan, atau event terlebih dahulu</p>
        <p class="text-sm text-slate-400">Pendaftaran akan tersedia setelah ada referensi</p>
    </div>
    @endif
</div>

                {{-- Link & Status --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3">Link WhatsApp</label>
                        <input type="url" name="link" maxlength="500"
                               class="w-full p-4 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:bg-slate-700 dark:text-white transition-all duration-200"
                               placeholder="https://wa.me/628xxxxxxxxxx">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3 required">Status *</label>
                        <select name="status" required class="w-full p-4 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:bg-slate-700 dark:text-white transition-all duration-200 appearance-none">
                            <option value="proses" selected>⏳ Proses</option>
                            <option value="diterima">✅ Diterima</option>
                            <option value="ditolak">❌ Ditolak</option>
                        </select>
                    </div>
                </div>

                {{-- File Uploads --}}
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3">Bukti Pembayaran</label>
                        <input type="file" name="bukti" accept="image/jpeg,image/jpg,image/png,application/pdf" 
                               class="w-full p-4 border-2 border-dashed border-slate-200 dark:border-slate-600 rounded-xl dark:bg-slate-700/50 dark:text-white transition-all duration-200 cursor-pointer hover:border-emerald-400 file:mr-4 file:py-3 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                        <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">Max 5MB. PDF, JPG, PNG</p>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3">Foto Profil</label>
                        <input type="file" name="image" accept="image/jpeg,image/jpg,image/png" 
                               class="w-full p-4 border-2 border-dashed border-slate-200 dark:border-slate-600 rounded-xl dark:bg-slate-700/50 dark:text-white transition-all duration-200 cursor-pointer hover:border-emerald-400 file:mr-4 file:py-3 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                        <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">Max 5MB. JPG, PNG</p>
                    </div>
                </div>

                {{-- Keterangan --}}
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3">Keterangan (Opsional)</label>
                    <textarea name="keterangan" maxlength="500" rows="3" 
                              class="w-full p-4 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:bg-slate-700 dark:text-white transition-all duration-200 resize-vertical"
                              placeholder="Catatan tambahan..."></textarea>
                    <div class="text-right mt-1">
                        <span id="createKeteranganCount" class="text-xs text-slate-500 dark:text-slate-400">0/500</span>
                    </div>
                </div>

                {{-- Buttons --}}
                <div class="flex flex-col sm:flex-row gap-3 pt-4">
                    <button type="button" onclick="closeCreatePendaftaranModal()" 
                            class="flex-1 px-8 py-4 text-sm font-semibold text-slate-700 dark:text-slate-300 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 rounded-xl transition-all duration-200">
                        Batal
                    </button>
                    <button type="submit" id="createSubmitBtn"
                            class="flex-1 px-8 py-4 text-sm font-semibold text-white bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-0.5 flex items-center justify-center gap-2">
                        <span class="createBtnText">Simpan Pendaftaran</span>
                        <svg class="w-5 h-5 createBtnLoading hidden animate-spin" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- EDIT MODAL --}}
<div id="editPendaftaranModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 z-50 hidden overflow-y-auto">
    <div class="relative top-20 mx-auto p-6 w-11/12 md:w-3/4 lg:w-1/2 max-h-[90vh] overflow-y-auto">
        <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-2xl">
            <div class="p-8 border-b border-slate-200 dark:border-slate-700 flex justify-between items-center">
                <h3 class="text-2xl font-bold text-slate-900 dark:text-white">
                    <span id="editModalTitle">Edit Pendaftaran</span>
                </h3>
                <button type="button" onclick="closeEditPendaftaranModal()" class="p-3 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-xl transition-all duration-200">
                    <svg class="w-6 h-6 text-slate-500 hover:text-slate-900 dark:hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            
            <form id="editPendaftaranForm" enctype="multipart/form-data" class="p-8 space-y-6">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="id" id="editPendaftaranId">
                <div id="editErrors" class="space-y-2 hidden"></div>

                {{-- Basic Info --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3 required">Nama Lengkap *</label>
                        <input type="text" name="name" id="editName" required 
                               class="w-full p-4 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:bg-slate-700 dark:text-white transition-all duration-200">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3 required">Email *</label>
                        <input type="email" name="email" id="editEmail" required 
                               class="w-full p-4 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:bg-slate-700 dark:text-white transition-all duration-200">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3 required">Nomor HP *</label>
                        <input type="tel" name="phone" id="editPhone" required 
                               class="w-full p-4 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:bg-slate-700 dark:text-white transition-all duration-200">
                    </div>
                </div>

                {{-- User Selection (Optional) --}}
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3">User (Opsional)</label>
                    <div class="relative">
                        <select name="user_id" id="editUserId" class="w-full p-4 pl-12 pr-10 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:bg-slate-700 dark:text-white transition-all duration-200 appearance-none">
                            <option value="">-- Pilih User (Opsional) --</option>
                            @forelse($users ?? [] as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                            @empty
                                <option disabled>Tidak ada user tersedia</option>
                            @endforelse
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- 🔥 NEW Reference Radio System (SAMA seperti CREATE) --}}
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-6 required">Pilih Referensi *</label>
                    
                    {{-- Acara --}}
                    @if(isset($acaras) && $acaras->count() > 0)
                    <div class="mb-6 p-5 bg-gradient-to-r from-orange-50 to-orange-100 dark:from-orange-900/20 dark:to-orange-800/20 border-2 border-orange-200 dark:border-orange-700 rounded-3xl hover:shadow-lg transition-all duration-200 cursor-pointer reference-section" data-target="acara_id">
                        <label class="flex items-center justify-between w-full">
                            <div class="flex items-center">
                                <input type="radio" name="reference_type" value="acara" id="edit_ref_acara" class="w-5 h-5 text-orange-600 bg-orange-100 border-orange-300 focus:ring-orange-500 mr-3 rounded-full">
                                <svg class="w-6 h-6 mr-3 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-lg font-bold text-orange-800 dark:text-orange-200">Acara</span>
                                <span class="ml-2 text-sm bg-orange-200 dark:bg-orange-800/50 px-3 py-1 rounded-full font-medium text-orange-700 dark:text-orange-200">({{ $acaras->count() }})</span>
                            </div>
                        </label>
                        <div class="mt-4 pt-4 border-t border-orange-200 dark:border-orange-700">
                            <select name="acara_id" class="reference-field w-full p-4 border border-orange-200 dark:border-orange-600 rounded-2xl focus:ring-2 focus:ring-orange-500 focus:border-transparent dark:bg-slate-700 dark:text-white transition-all duration-200 appearance-none hidden" required>
                                <option value="">-- Pilih Acara --</option>
                                @foreach($acaras as $acara)
                                    <option value="{{ $acara->id }}">{{ $acara->name ?? $acara->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endif

                    {{-- Kegiatan --}}
                    @if(isset($kegiatans) && $kegiatans->count() > 0)
                    <div class="mb-6 p-5 bg-gradient-to-r from-purple-50 to-purple-100 dark:from-purple-900/20 dark:to-purple-800/20 border-2 border-purple-200 dark:border-purple-700 rounded-3xl hover:shadow-lg transition-all duration-200 cursor-pointer reference-section" data-target="kegiatan_id">
                        <label class="flex items-center justify-between w-full">
                            <div class="flex items-center">
                                <input type="radio" name="reference_type" value="kegiatan" id="edit_ref_kegiatan" class="w-5 h-5 text-purple-600 bg-purple-100 border-purple-300 focus:ring-purple-500 mr-3 rounded-full">
                                <svg class="w-6 h-6 mr-3 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span class="text-lg font-bold text-purple-800 dark:text-purple-200">Kegiatan</span>
                                <span class="ml-2 text-sm bg-purple-200 dark:bg-purple-800/50 px-3 py-1 rounded-full font-medium text-purple-700 dark:text-purple-200">({{ $kegiatans->count() }})</span>
                            </div>
                        </label>
                        <div class="mt-4 pt-4 border-t border-purple-200 dark:border-purple-700">
                            <select name="kegiatan_id" class="reference-field w-full p-4 border border-purple-200 dark:border-purple-600 rounded-2xl focus:ring-2 focus:ring-purple-500 focus:border-transparent dark:bg-slate-700 dark:text-white transition-all duration-200 appearance-none hidden" required>
                                <option value="">-- Pilih Kegiatan --</option>
                                @foreach($kegiatans as $kegiatan)
                                    <option value="{{ $kegiatan->id }}">{{ $kegiatan->name ?? $kegiatan->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endif

                    {{-- Event --}}
                    @if(isset($events) && $events->count() > 0)
                    <div class="mb-6 p-5 bg-gradient-to-r from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/20 border-2 border-blue-200 dark:border-blue-700 rounded-3xl hover:shadow-lg transition-all duration-200 cursor-pointer reference-section" data-target="event_id">
                        <label class="flex items-center justify-between w-full">
                            <div class="flex items-center">
                                <input type="radio" name="reference_type" value="event" id="edit_ref_event" class="w-5 h-5 text-blue-600 bg-blue-100 border-blue-300 focus:ring-blue-500 mr-3 rounded-full">
                                <svg class="w-6 h-6 mr-3 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-lg font-bold text-blue-800 dark:text-blue-200">Event</span>
                                <span class="ml-2 text-sm bg-blue-200 dark:bg-blue-800/50 px-3 py-1 rounded-full font-medium text-blue-700 dark:text-blue-200">({{ $events->count() }})</span>
                            </div>
                        </label>
                        <div class="mt-4 pt-4 border-t border-blue-200 dark:border-blue-700">
                            <select name="event_id" class="reference-field w-full p-4 border border-blue-200 dark:border-blue-600 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-slate-700 dark:text-white transition-all duration-200 appearance-none hidden" required>
                                <option value="">-- Pilih Event --</option>
                                @foreach($events as $event)
                                    <option value="{{ $event->id }}">{{ $event->name ?? $event->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endif

                    @if(!isset($acaras) && !isset($kegiatans) && !isset($events))
                    <div class="text-center py-12 bg-gradient-to-br from-slate-50 to-slate-100 dark:from-slate-800 dark:to-slate-900 rounded-3xl border-2 border-dashed border-slate-300 dark:border-slate-600">
                        <svg class="w-20 h-20 text-slate-400 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2 2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                        </svg>
                        <h3 class="text-xl font-bold text-slate-700 dark:text-slate-200 mb-2">Belum ada referensi</h3>
                        <p class="text-slate-500 dark:text-slate-400 text-lg mb-4">Buat acara, kegiatan, atau event terlebih dahulu</p>
                    </div>
                    @endif
                </div>

                {{-- Link & Status --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3">Link WhatsApp</label>
                        <input type="url" name="link" id="editLink" 
                               class="w-full p-4 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:bg-slate-700 dark:text-white transition-all duration-200">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3 required">Status *</label>
                        <select name="status" id="editStatus" required class="w-full p-4 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:bg-slate-700 dark:text-white transition-all duration-200 appearance-none">
                            <option value="proses">⏳ Proses</option>
                            <option value="diterima">✅ Diterima</option>
                            <option value="ditolak">❌ Ditolak</option>
                        </select>
                    </div>
                </div>

                {{-- Current Files Info --}}
                <div id="editCurrentFilesInfo" class="space-y-3 p-6 bg-gradient-to-r from-slate-50 to-slate-100 dark:from-slate-800/50 dark:to-slate-700/50 border border-slate-200 dark:border-slate-600 rounded-3xl hidden">
                    <h4 class="text-lg font-bold text-slate-800 dark:text-slate-100 flex items-center gap-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        File Saat Ini
                    </h4>
                    
                    <div id="currentImageInfo" class="flex items-center gap-4 p-4 bg-white/80 dark:bg-slate-700/70 backdrop-blur-sm border border-slate-200 dark:border-slate-600 rounded-2xl hidden">
                        <img id="currentImagePreview" class="w-16 h-16 rounded-2xl object-cover shadow-lg ring-2 ring-slate-200 dark:ring-slate-600" alt="Foto saat ini">
                        <div class="min-w-0 flex-1">
                            <p class="font-semibold text-slate-900 dark:text-white truncate" id="currentImageName">nama_file.jpg</p>
                            <a id="currentImageLink" href="#" target="_blank" class="text-sm text-emerald-600 hover:text-emerald-700 font-medium inline-flex items-center gap-1 group">
                                Lihat <svg class="w-3 h-3 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    
                    <div id="currentBuktiInfo" class="flex items-center gap-4 p-4 bg-white/80 dark:bg-slate-700/70 backdrop-blur-sm border border-slate-200 dark:border-slate-600 rounded-2xl hidden">
                        <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl flex items-center justify-center shadow-lg ring-2 ring-slate-200 dark:ring-slate-600">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-12a3.375 3.375 0 00-3.375 3.375v2.625c0 1.89.772 3.617 2.025 4.864a14.24 14.24 0 00.668 1.308 12 12 0 001.733.914c.346.091.702.091 1.048 0a12 12 0 001.733-.914 14.24 14.24 0 00.668-1.308c1.253-1.247 2.025-2.974 2.025-4.864z"/>
                            </svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="font-semibold text-slate-900 dark:text-white truncate" id="currentBuktiName">bukti_pembayaran.pdf</p>
                            <a id="currentBuktiLink" href="#" target="_blank" class="text-sm text-emerald-600 hover:text-emerald-700 font-medium inline-flex items-center gap-1 group">
                                Lihat <svg class="w-3 h-3 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- File Uploads (Replace) --}}
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3">Ganti Bukti Pembayaran</label>
                        <input type="file" name="bukti" accept="image/jpeg,image/jpg,image/png,application/pdf" 
                               class="w-full p-4 border-2 border-dashed border-slate-200 dark:border-slate-600 rounded-xl dark:bg-slate-700/50 dark:text-white transition-all duration-200 cursor-pointer hover:border-emerald-400 file:mr-4 file:py-3 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                        <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">Max 5MB. PDF, JPG, PNG (kosongkan jika tidak ingin ganti)</p>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3">Ganti Foto Profil</label>
                        <input type="file" name="image" accept="image/jpeg,image/jpg,image/png" 
                               class="w-full p-4 border-2 border-dashed border-slate-200 dark:border-slate-600 rounded-xl dark:bg-slate-700/50 dark:text-white transition-all duration-200 cursor-pointer hover:border-emerald-400 file:mr-4 file:py-3 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                        <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">Max 5MB. JPG, PNG (kosongkan jika tidak ingin ganti)</p>
                    </div>
                </div>

                {{-- Keterangan --}}
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3">Keterangan</label>
                    <textarea name="keterangan" id="editKeterangan" rows="3" maxlength="500"
                              class="w-full p-4 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:bg-slate-700 dark:text-white transition-all duration-200 resize-vertical"
                              placeholder="Catatan tambahan..."></textarea>
                    <div class="text-right mt-1">
                        <span id="editKeteranganCount" class="text-xs text-slate-500 dark:text-slate-400">0/500</span>
                    </div>
                </div>

                {{-- Buttons --}}
                <div class="flex flex-col sm:flex-row gap-3 pt-4">
                    <button type="button" onclick="closeEditPendaftaranModal()" 
                            class="flex-1 px-8 py-4 text-sm font-semibold text-slate-700 dark:text-slate-300 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 rounded-xl transition-all duration-200">
                        Batal
                    </button>
                    <button type="submit" id="editSubmitBtn"
                            class="flex-1 px-8 py-4 text-sm font-semibold text-white bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-0.5 flex items-center justify-center gap-2">
                        <span class="editBtnText">Update Pendaftaran</span>
                        <svg class="w-5 h-5 editBtnLoading hidden animate-spin" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- DELETE MODAL (Tetap sama - sudah OK) --}}
<div id="deletePendaftaranModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-2xl max-w-md w-full mx-4">
        <div class="p-8 text-center">
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-100 dark:bg-red-900/20 mb-6">
                <svg class="h-8 w-8 text-red-600 dark:text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Hapus Pendaftaran?</h3>
            <p class="text-sm text-slate-600 dark:text-slate-400 mb-6" id="deletePendaftaranName">Apakah Anda yakin ingin menghapus pendaftaran ini?</p>
            <input type="hidden" id="deletePendaftaranId">
            <div class="flex gap-3">
                <button type="button" onclick="closeDeletePendaftaranModal()" class="flex-1 px-6 py-3 text-sm font-semibold text-slate-700 dark:text-slate-300 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 rounded-xl transition-all duration-200">
                    Batal
                </button>
                <button type="button" id="confirmDeleteBtn" class="flex-1 px-6 py-3 text-sm font-semibold text-white bg-red-500 hover:bg-red-600 rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl">
                    Hapus Pendaftaran
                </button>
            </div>
        </div>
    </div>
</div>


@push('scripts')
<script>
let currentEditData = null;

document.addEventListener('DOMContentLoaded', function() {
    // 🔥 Reference radio button system (BARU)
    initReferenceRadioSystem();
    
    // Character counter
    initCharacterCounters();
    
    // Form submissions
    document.getElementById('createPendaftaranForm')?.addEventListener('submit', handleCreateSubmit);
    document.getElementById('editPendaftaranForm')?.addEventListener('submit', handleEditSubmit);
    document.getElementById('confirmDeleteBtn')?.addEventListener('click', handleDeleteSubmit);
    
    // Close modals on backdrop click
    document.querySelectorAll('[id$="Modal"]').forEach(modal => {
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                const modalName = this.id.replace('Modal', '');
                window[`close${modalName.charAt(0).toUpperCase() + modalName.slice(1)}Modal`]();
            }
        });
    });
    
    // Auto select first reference
    setTimeout(() => {
        const firstRadio = document.querySelector('input[name="reference_type"]');
        if (firstRadio && !document.querySelector('input[name="reference_type"]:checked')) {
            firstRadio.checked = true;
            firstRadio.dispatchEvent(new Event('change', { bubbles: true }));
        }
    }, 100);
});

// 🔥 1. NEW Reference Radio Button System
function initReferenceRadioSystem() {
    const referenceSections = document.querySelectorAll('.reference-section');
    
    referenceSections.forEach(section => {
        const radio = section.querySelector('input[type="radio"]');
        const select = section.querySelector('.reference-field');
        
        if (radio) {
            radio.addEventListener('change', function() {
                // Hide semua selects dan remove required
                document.querySelectorAll('.reference-field').forEach(field => {
                    field.classList.add('hidden');
                    field.removeAttribute('required');
                });
                
                // Visual feedback - remove semua rings
                referenceSections.forEach(s => {
                    s.classList.remove('ring-4', 'ring-orange-300', 'ring-purple-300', 'ring-blue-300', 
                                     'ring-orange-500/50', 'ring-purple-500/50', 'ring-blue-500/50');
                });
                
                // Show select yang dipilih + required
                if (select) {
                    select.classList.remove('hidden');
                    select.setAttribute('required', 'required');
                }
                
                // Add ring ke section aktif
                const value = this.value;
                section.classList.add('ring-4');
                if (value === 'acara') section.classList.add('ring-orange-300');
                else if (value === 'kegiatan') section.classList.add('ring-purple-300');
                else if (value === 'event') section.classList.add('ring-blue-300');
            });
        }
        
        // Click section untuk auto-select radio
        section.addEventListener('click', function(e) {
            const radio = this.querySelector('input[type="radio"]');
            if (radio && !radio.checked) {
                radio.click();
            }
        });
    });
}

// 🔥 2. Character counters (FIXED selectors)
function initCharacterCounters() {
    const textareas = [
        { id: 'keterangan', counter: 'createKeteranganCount' },
        { id: 'editKeterangan', counter: 'editKeteranganCount' }
    ];
    
    textareas.forEach(({ id, counter }) => {
        const textarea = document.getElementById(id);
        const counterEl = document.getElementById(counter);
        
        if (textarea && counterEl) {
            textarea.addEventListener('input', function() {
                const length = this.value.length;
                counterEl.textContent = `${length}/500`;
                
                // Color coding
                if (length > 450) {
                    counterEl.className = 'text-xs text-red-500 dark:text-red-400 font-medium';
                } else if (length > 400) {
                    counterEl.className = 'text-xs text-amber-500 dark:text-amber-400 font-medium';
                } else {
                    counterEl.className = 'text-xs text-slate-500 dark:text-slate-400';
                }
            });
        }
    });
}

// 🔥 3. Modal Controls (UPDATED)
function openCreatePendaftaranModal() {
    document.getElementById('createPendaftaranModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeCreatePendaftaranModal() {
    const modal = document.getElementById('createPendaftaranModal');
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
    
    // Reset form
    const form = document.getElementById('createPendaftaranForm');
    form.reset();
    
    // Clear errors
    document.getElementById('createErrors')?.classList.add('hidden');
    
    // Reset reference fields
    document.querySelectorAll('.reference-field').forEach(field => {
        field.classList.add('hidden');
        field.removeAttribute('required');
    });
    document.querySelectorAll('.reference-section').forEach(section => {
        section.classList.remove('ring-4', 'ring-orange-300', 'ring-purple-300', 'ring-blue-300');
    });
    
    // Reset counters
    document.getElementById('createKeteranganCount') && (document.getElementById('createKeteranganCount').textContent = '0/500');
}

function openEditPendaftaranModalFromRow(button) {
    const row = button.closest('tr');
    currentEditData = JSON.parse(row.dataset.pendaftaranData);
    
    // Update form action URL
    const form = document.getElementById('editPendaftaranForm');
    form.action = `{{ route('admin.pendaftaran.update', 0) }}/${currentEditData.id}`;
    
    // Fill form fields
    document.getElementById('editPendaftaranId').value = currentEditData.id;
    document.getElementById('editName').value = currentEditData.name || '';
    document.getElementById('editEmail').value = currentEditData.email || '';
    document.getElementById('editPhone').value = currentEditData.phone || '';
    document.getElementById('editLink').value = currentEditData.link || '';
    document.getElementById('editStatus').value = currentEditData.status || 'proses';
    document.getElementById('editKeterangan').value = currentEditData.keterangan || '';
    
    // User ID
    const userSelect = document.getElementById('editUserId');
    if (userSelect) userSelect.value = currentEditData.user_id || '';
    
    // Handle reference fields (check which one has value)
    setTimeout(() => handleEditReferenceFields(), 100);
    
    // Show current files
    showCurrentFiles();
    
    // Show modal
    document.getElementById('editPendaftaranModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function handleEditReferenceFields() {
    const { acara_id, kegiatan_id, event_id } = currentEditData;
    let targetField = null;
    
    if (acara_id) {
        targetField = 'acara_id';
    } else if (kegiatan_id) {
        targetField = 'kegiatan_id';
    } else if (event_id) {
        targetField = 'event_id';
    }
    
    if (targetField) {
        const radio = document.querySelector(`input[value="${targetField}"]`);
        const select = document.querySelector(`select[name="${targetField}"]`);
        
        if (radio) {
            radio.checked = true;
            radio.dispatchEvent(new Event('change', { bubbles: true }));
        }
        
        if (select) {
            select.value = currentEditData[targetField];
        }
    }
}

function showCurrentFiles() {
    const filesInfo = document.getElementById('editCurrentFilesInfo');
    if (!filesInfo || !currentEditData) return;
    
    filesInfo.classList.remove('hidden');
    
    // Image
    if (currentEditData.image) {
        const imgInfo = document.getElementById('currentImageInfo');
        if (imgInfo) {
            document.getElementById('currentImagePreview').src = `/storage/${currentEditData.image}`;
            document.getElementById('currentImageName').textContent = currentEditData.image.split('/').pop();
            document.getElementById('currentImageLink').href = `/storage/${currentEditData.image}`;
            imgInfo.classList.remove('hidden');
        }
    }
    
    // Bukti
    if (currentEditData.bukti) {
        const buktiInfo = document.getElementById('currentBuktiInfo');
        if (buktiInfo) {
            document.getElementById('currentBuktiName').textContent = currentEditData.bukti.split('/').pop();
            document.getElementById('currentBuktiLink').href = `/storage/${currentEditData.bukti}`;
            buktiInfo.classList.remove('hidden');
        }
    }
}

function closeEditPendaftaranModal() {
    document.getElementById('editPendaftaranModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
    document.getElementById('editErrors')?.classList.add('hidden');
    currentEditData = null;
}

function openDeletePendaftaranModal(id, name) {
    document.getElementById('deletePendaftaranId').value = id;
    document.getElementById('deletePendaftaranName').textContent = `Apakah Anda yakin ingin menghapus pendaftaran "${name}"?`;
    document.getElementById('deletePendaftaranModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeDeletePendaftaranModal() {
    document.getElementById('deletePendaftaranModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

// 🔥 4. AJAX Form Submissions (UPDATED)
async function handleCreateSubmit(e) {
    e.preventDefault();
    const form = e.target;
    const btn = document.getElementById('createSubmitBtn');
    const btnText = btn.querySelector('.createBtnText');
    const btnSpinner = btn.querySelector('.createBtnLoading');
    
    toggleButtonState(btn, btnText, btnSpinner, true);
    
    try {
        const formData = new FormData(form);
        const response = await fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });
        
        const data = await response.json();
        
        if (data.success || response.ok) {
            showToast('✅ Pendaftaran berhasil disimpan!', 'success');
            setTimeout(() => location.reload(), 1500);
        } else {
            showErrors('createErrors', data.errors || data.message || ['Terjadi kesalahan']);
        }
    } catch (error) {
        showErrors('createErrors', ['❌ Terjadi kesalahan jaringan']);
        console.error('Create error:', error);
    } finally {
        toggleButtonState(btn, btnText, btnSpinner, false);
    }
}

async function handleEditSubmit(e) {
    e.preventDefault();
    const form = e.target;
    const btn = document.getElementById('editSubmitBtn');
    
    btn.disabled = true;
    btn.innerHTML = '<span class="editBtnLoading">Menyimpan...</span>';
    
    try {
        const formData = new FormData(form);
        const response = await fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });
        
        const data = await response.json();
        
        if (data.success || response.ok) {
            showToast('✅ Pendaftaran berhasil diupdate!', 'success');
            setTimeout(() => location.reload(), 1500);
        } else {
            showErrors('editErrors', data.errors || data.message || ['Terjadi kesalahan']);
        }
    } catch (error) {
        showErrors('editErrors', ['❌ Terjadi kesalahan jaringan']);
        console.error('Edit error:', error);
    } finally {
        btn.disabled = false;
        btn.innerHTML = 'Update Pendaftaran';
    }
}

async function handleDeleteSubmit() {
    const id = document.getElementById('deletePendaftaranId').value;
    const btn = document.getElementById('confirmDeleteBtn');
    
    btn.disabled = true;
    btn.textContent = 'Menghapus...';
    
    try {
        const response = await fetch(`/admin/pendaftaran/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        });
        
        const data = await response.json();
        
        if (data.success || response.ok) {
            showToast('✅ Pendaftaran berhasil dihapus!', 'success');
            setTimeout(() => location.reload(), 1500);
        } else {
            showToast('❌ Gagal menghapus pendaftaran', 'error');
        }
    } catch (error) {
        showToast('❌ Terjadi kesalahan jaringan', 'error');
        console.error('Delete error:', error);
    } finally {
        btn.disabled = false;
        btn.textContent = 'Hapus Pendaftaran';
        closeDeletePendaftaranModal();
    }
}

function toggleButtonState(btn, textEl, spinnerEl, loading) {
    if (loading) {
        textEl?.classList.add('hidden');
        spinnerEl?.classList.remove('hidden');
        btn.disabled = true;
    } else {
        textEl?.classList.remove('hidden');
        spinnerEl?.classList.add('hidden');
        btn.disabled = false;
    }
}

function showErrors(containerId, errors) {
    const container = document.getElementById(containerId);
    if (!container) return;
    
    container.innerHTML = '';
    
    const errorMessages = Array.isArray(errors) ? errors : Object.values(errors || {}).flat() || [errors];
    errorMessages.forEach(error => {
        container.innerHTML += `
            <div class="p-3 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl text-red-800 dark:text-red-300 text-sm flex items-start gap-2 animate-in slide-in-from-top-2 duration-200">
                <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                <span>${error}</span>
            </div>
        `;
    });
    
    container.classList.remove('hidden');
    container.scrollIntoView({ behavior: 'smooth', block: 'center' });
}

function showToast(message, type = 'success') {
    const toast = document.createElement('div');
    const bgClass = type === 'success' ? 'bg-emerald-500' : 'bg-red-500';
    toast.className = `fixed top-20 right-4 z-[9999] p-4 rounded-xl shadow-2xl text-white text-sm font-medium max-w-sm transform translate-x-full transition-all duration-300 ${bgClass}`;
    toast.innerHTML = `
        <div class="flex items-center gap-3">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                ${type === 'success' 
                    ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>' 
                    : '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>'
                }
            </svg>
            <span>${message}</span>
        </div>
    `;
    
    document.body.appendChild(toast);
    setTimeout(() => toast.classList.remove('translate-x-full'), 100);
    
    setTimeout(() => {
        toast.classList.add('translate-x-full');
        setTimeout(() => toast.remove(), 300);
    }, 4000);
}
</script>
@endpush
