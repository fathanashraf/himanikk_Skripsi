{{-- CREATE MODAL --}}
<div id="createStrukturModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 z-50 hidden overflow-y-auto">
    <div class="relative top-20 mx-auto p-6 w-11/12 md:w-3/4 lg:w-1/2 max-h-[90vh] overflow-y-auto">
        <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-2xl">
            <div class="p-8 border-b border-slate-200 dark:border-slate-700 flex justify-between items-center">
                <h3 class="text-2xl font-bold text-slate-900 dark:text-white">Tambah Pengurus HIMANIKKA</h3>
                <button type="button" onclick="closeCreateModal()" class="p-3 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-xl transition-all duration-200">
                    <svg class="w-6 h-6 text-slate-500 hover:text-slate-900 dark:hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            
            <form id="createStrukturForm" enctype="multipart/form-data" class="p-8 space-y-6">
                {{-- Error Container --}}
                <div id="createErrors" class="space-y-2 hidden"></div>

                {{-- User Selection --}}
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3 required">Pilih Pengurus *</label>
                    <select name="user_id" id="createUserId" required class="w-full p-4 pl-12 pr-10 border border-slate-200 dark:border-slate-600 rounded-xl 
                            focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:bg-slate-700 dark:text-white transition-all duration-200 appearance-none">
                        <option value="">-- Pilih Pengguna --</option>
                        @foreach($users ?? [] as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                        @endforeach
                    </select>
                    <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">Pilih pengguna dari database yang akan dijadikan pengurus</p>
                </div>

                {{-- Jabatan --}}
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3 required">Jabatan *</label>
                    <div class="relative">
                        <select name="jabatan" id="createJabatan" required 
                                class="w-full p-4 pl-12 pr-10 border border-slate-200 dark:border-slate-600 rounded-xl 
                                       focus:ring-2 focus:ring-emerald-500 focus:border-transparent 
                                       dark:bg-slate-700 dark:text-white transition-all duration-200 appearance-none">
                            <option value="">Pilih Jabatan...</option>
                            <option value="kahim">Ketua Umum HIMANIKKA (KAHIM)</option>
                            <option value="wakahim">Wakil Ketua Umum (WAKAHIM)</option>
                            <option value="sekretaris">Sekretaris</option>
                            <option value="bendahara">Bendahara</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Posisi, Departemen (Grid Layout) --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3">Posisi</label>
                        <div class="relative">
                            <select name="posisi" id="createPosisi" class="w-full p-4 pl-12 pr-10 border border-slate-200 dark:border-slate-600 rounded-xl 
                                    focus:ring-2 focus:ring-purple-500 focus:border-transparent dark:bg-slate-700 dark:text-white transition-all duration-200 appearance-none">
                                <option value="">-- Tidak ada posisi tambahan --</option>
                                <option value="koordinator">Koordinator</option>
                                <option value="anggota">Anggota</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3">Departemen</label>
                        <div class="relative">
                            <select name="departemen" id="createDepartemen" class="w-full p-4 pl-12 pr-10 border border-slate-200 dark:border-slate-600 rounded-xl 
                                    focus:ring-2 focus:ring-amber-500 focus:border-transparent dark:bg-slate-700 dark:text-white transition-all duration-200 appearance-none">
                                <option value="">-- Tidak ada departemen --</option>
                                <option value="kwu">KWU</option>
                            <option value="minatbakat">Minat Bakat</option>
                            <option value="pemberdaya_wanita">Pemberdaya Wanita</option>
                            <option value="humas">Humas</option>
                            <option value="kaderisasi">Kaderisasi</option>
                            <option value="kominfo">Kominfo</option>
                            <option value="keagamaan">Keagamaan</option>
                            <option value="sosial">Sosial</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Avatar --}}
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3">Foto Profil</label>
                    <input type="file" name="avatar" id="createAvatar" accept="image/*" 
                           class="w-full p-4 border-2 border-dashed border-slate-200 dark:border-slate-600 rounded-xl 
                                  dark:bg-slate-700/50 dark:text-white transition-all duration-200 cursor-pointer hover:border-emerald-400
                                  file:mr-4 file:py-3 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold 
                                  file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                    <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">Maksimal 2MB. Format JPG, PNG, atau WebP</p>
                </div>

                {{-- Buttons --}}
                <div class="flex flex-col sm:flex-row gap-3 pt-4">
                    <button type="button" onclick="closeCreateModal()" 
                            class="flex-1 px-8 py-4 text-sm font-semibold text-slate-700 dark:text-slate-300 
                                   bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 
                                   rounded-xl transition-all duration-200">
                        Batal
                    </button>
                    <button type="submit" id="createSubmitBtn"
                            class="flex-1 px-8 py-4 text-sm font-semibold text-white bg-gradient-to-r from-emerald-500 to-emerald-600 
                                   hover:from-emerald-600 hover:to-emerald-700 focus:ring-4 focus:ring-emerald-200 
                                   rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                        Simpan Pengurus
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- EDIT MODAL --}}
<div id="editStrukturModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 z-50 hidden overflow-y-auto">
    <div class="relative top-20 mx-auto p-6 w-11/12 md:w-3/4 lg:w-1/2 max-h-[90vh] overflow-y-auto">
        <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-2xl">
            <div class="p-8 border-b border-slate-200 dark:border-slate-700 flex justify-between items-center">
                <h3 class="text-2xl font-bold text-slate-900 dark:text-white">Edit Pengurus</h3>
                <button type="button" onclick="closeEditModal()" class="p-3 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-xl transition-all duration-200">
                    <svg class="w-6 h-6 text-slate-500 hover:text-slate-900 dark:hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            
            <form id="editStrukturForm" enctype="multipart/form-data" class="p-8 space-y-6">
                <input type="hidden" name="id" id="editStrukturId">
                {{-- Error Container --}}
                <div id="editErrors" class="space-y-2 hidden"></div>

                {{-- User Selection --}}
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3 required">Pengurus *</label>
                    <select name="user_id" id="editUserId" required class="w-full p-4 pl-12 pr-10 border border-slate-200 dark:border-slate-600 rounded-xl 
                            focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:bg-slate-700 dark:text-white transition-all duration-200 appearance-none">
                        <option value="">-- Pilih Pengguna --</option>
                        @foreach($users ?? [] as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                        @endforeach
                    </select>
                </div>

                {{-- Jabatan, Posisi, Departemen (Grid Layout) --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3 required">Jabatan *</label>
                        <select name="jabatan" id="editJabatan" required class="w-full p-4 pl-12 pr-10 border border-slate-200 dark:border-slate-600 rounded-xl 
                                focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:bg-slate-700 dark:text-white transition-all duration-200 appearance-none">
                            <option value="kahim">KAHIM</option>
                            <option value="wakahim">WAKAHIM</option>
                            <option value="sekretaris">Sekretaris</option>
                            <option value="bendahara">Bendahara</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3">Posisi</label>
                        <select name="posisi" id="editPosisi" class="w-full p-4 pl-12 pr-10 border border-slate-200 dark:border-slate-600 rounded-xl 
                                focus:ring-2 focus:ring-purple-500 focus:border-transparent dark:bg-slate-700 dark:text-white transition-all duration-200 appearance-none">
                            <option value="">-- Pilih --</option>
                            <option value="koordinator">Koordinator</option>
                            <option value="anggota">Anggota</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3">Departemen</label>
                        <select name="departemen" id="editDepartemen" class="w-full p-4 pl-12 pr-10 border border-slate-200 dark:border-slate-600 rounded-xl 
                                focus:ring-2 focus:ring-amber-500 focus:border-transparent dark:bg-slate-700 dark:text-white transition-all duration-200 appearance-none">
                            <option value="">-- Pilih --</option>
                            <option value="kwu">KWU</option>
                            <option value="minatbakat">Minat Bakat</option>
                            <option value="pemberdaya_wanita">Pemberdaya Wanita</option>
                            <option value="humas">Humas</option>
                            <option value="kaderisasi">Kaderisasi</option>
                            <option value="kominfo">Kominfo</option>
                            <option value="keagamaan">Keagamaan</option>
                            <option value="sosial">Sosial</option>
                        </select>
                    </div>
                </div>

                {{-- Avatar --}}
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3">Foto Profil</label>
                    <input type="file" name="avatar" id="editAvatar" accept="image/*" class="w-full p-4 border-2 border-dashed border-slate-200 dark:border-slate-600 rounded-xl">
                    <div id="currentAvatarPreview" class="mt-3 p-3 bg-slate-50 dark:bg-slate-700/50 rounded-xl hidden border">
                        <p class="text-xs text-slate-500 mb-2">Foto saat ini:</p>
                        <img id="avatarPreviewImg" class="w-20 h-20 object-cover rounded-xl mx-auto shadow-lg" alt="Avatar saat ini">
                    </div>
                </div>

                {{-- Buttons --}}
                <div class="flex flex-col sm:flex-row gap-3 pt-4">
                    <button type="button" onclick="closeEditModal()" class="flex-1 px-8 py-4 text-sm font-semibold text-slate-700 dark:text-slate-300 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 rounded-xl transition-all duration-200">
                        Batal
                    </button>
                    <button type="submit" id="editSubmitBtn" class="flex-1 px-8 py-4 text-sm font-semibold text-white bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                        Update Pengurus
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- DELETE MODAL --}}
<div id="deleteStrukturModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-2xl max-w-md w-full mx-4">
        <div class="p-8 text-center">
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-100 dark:bg-red-900/20 mb-6">
                <svg class="h-8 w-8 text-red-600 dark:text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Hapus Pengurus?</h3>
            <p class="text-sm text-slate-600 dark:text-slate-400 mb-6" id="deletePengurusName">Apakah Anda yakin ingin menghapus pengurus ini?</p>
            <input type="hidden" id="deleteStrukturId">
            <div class="flex gap-3">
                <button type="button" onclick="closeDeleteModal()" class="flex-1 px-6 py-3 text-sm font-semibold text-slate-700 dark:text-slate-300 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 rounded-xl transition-all duration-200">
                    Batal
                </button>
                <button type="button" id="confirmDeleteBtn" class="flex-1 px-6 py-3 text-sm font-semibold text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:ring-red-200 rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl">
                    Hapus Pengurus
                </button>
            </div>
        </div>
    </div>
</div>

<script>
(function() {
    'use strict';

    // === UTILITY FUNCTIONS ===
    function showNotification(message, type = 'success') {
        document.querySelectorAll('.notification').forEach(n => n.remove());
        
        const notification = document.createElement('div');
        notification.className = `notification fixed top-4 right-4 z-[1000] p-4 rounded-xl shadow-2xl text-white transform translate-x-full transition-all duration-300 max-w-sm ${
            type === 'success' ? 'bg-emerald-500' : 
            type === 'error' ? 'bg-red-500' : 
            type === 'warning' ? 'bg-amber-500' : 'bg-slate-500'
        }`;
        notification.innerHTML = `
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        ${type === 'success' ? 
                            '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>' :
                            type === 'error' ? 
                                '<path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>' :
                                '<path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>'
                        }
                    </svg>
                    <span>${message}</span>
                </div>
                <button onclick="this.closest('.notification').remove()" class="text-white hover:opacity-75">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        `;
        
        document.body.appendChild(notification);
        setTimeout(() => notification.classList.remove('translate-x-full'), 100);
        setTimeout(() => {
            notification.classList.add('translate-x-full');
            setTimeout(() => notification.remove(), 300);
        }, 5000);
    }

    function setLoading(button, loading = true) {
        const originalHTML = button.innerHTML;
        button.disabled = loading;
        
        if (loading) {
            button.innerHTML = `
                <svg class="w-5 h-5 animate-spin mr-2" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/>
                </svg>
                Memproses...
            `;
            button.classList.add('opacity-75', 'cursor-not-allowed');
        } else {
            button.innerHTML = originalHTML;
            button.classList.remove('opacity-75', 'cursor-not-allowed');
            button.disabled = false;
        }
    }

    function showErrors(containerId, errors) {
        const container = document.getElementById(containerId);
        if (!container) return;

        container.innerHTML = '';
        Object.keys(errors).forEach(field => {
            if (Array.isArray(errors[field])) {
                errors[field].forEach(error => {
                    const errorDiv = document.createElement('div');
                    errorDiv.className = 'p-3 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl text-red-800 dark:text-red-300 text-sm';
                    errorDiv.innerHTML = `
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            <span>${error}</span>
                        </div>
                    `;
                    container.appendChild(errorDiv);
                });
            }
        });
        container.classList.remove('hidden');
    }

    function hideErrors(containerId) {
        const container = document.getElementById(containerId);
        if (container) {
            container.classList.add('hidden');
            container.innerHTML = '';
        }
    }

    function refreshData() {
        if (window.Alpine && window.strukturApp) {
            window.strukturApp.refreshData?.();
        } else if (window.Livewire?.find) {
            window.Livewire.find(window.livewireComponentId)?.reload();
        } else {
            setTimeout(() => location.reload(), 1000);
        }
    }

    // === MODAL FUNCTIONS ===
    window.openCreateModal = function() {
        document.getElementById('createStrukturModal')?.classList.remove('hidden');
        hideErrors('createErrors');
        document.getElementById('createStrukturForm').reset();
    };

    window.closeCreateModal = function() {
        const modal = document.getElementById('createStrukturModal');
        const form = document.getElementById('createStrukturForm');
        modal?.classList.add('hidden');
        form?.reset();
        hideErrors('createErrors');
    };

   window.closeEditModal = function() {
    const modal = document.getElementById('editStrukturModal');
    if (modal) {
        modal.classList.add('hidden');
        document.body.style.overflow = '';
    }
    hideErrors('editErrors');
};

// 🎯 FIXED: Comprehensive error checking + null safety
window.openEditModal = function(id, strukturData = {}) {
    console.log('🔍 openEditModal called:', { id, strukturData });
    
    // Validate inputs
    if (!id) {
        console.error('❌ ID required');
        showNotification?.('ID struktur diperlukan', 'error');
        return;
    }
    
    const modal = document.getElementById('editStrukturModal');
    const editStrukturId = document.getElementById('editStrukturId');
    
    if (!modal || !editStrukturId) {
        console.error('❌ Modal or ID field missing');
        showNotification?.('Modal tidak ditemukan', 'error');
        return;
    }
    
    // 🎯 SAFE FIELD POPULATION
    try {
        // ID field
        editStrukturId.value = id;
        
        // Text inputs - null-safe
        const fields = {
            'editUserId': strukturData.user_id || '',
            'editJabatan': strukturData.jabatan || '',
            'editPosisi': strukturData.posisi || '',
            'editDepartemen': strukturData.departemen || ''
        };
        
        Object.entries(fields).forEach(([fieldId, value]) => {
            const field = document.getElementById(fieldId);
            if (field) {
                field.value = value;
                console.log(`✅ ${fieldId}:`, value);
            } else {
                console.warn(`⚠️ Field not found: ${fieldId}`);
            }
        });
        
        // 🎯 SELECT DROPDOWN FIX
        if (strukturData.user_id) {
            setTimeout(() => selectDropdownOption('editUserId', strukturData.user_id), 50);
        }
        
        // Avatar preview
        handleAvatarPreview(strukturData.avatar);
        
        // Reset errors & show modal
        hideErrors('editErrors');
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        
        console.log('🎉 Struktur modal opened!');
        
    } catch (error) {
        console.error('❌ openEditModal error:', error);
        showNotification?.('Gagal membuka modal', 'error');
    }
};

// 🎯 NEW: Robust row data extraction
window.openEditModalFromRow = function(button) {
    console.log('🔍 openEditModalFromRow clicked');
    
    if (!button || typeof button.closest !== 'function') {
        console.error('❌ Invalid button');
        return;
    }
    
    const row = button.closest('tr');
    if (!row) {
        console.error('❌ Row not found');
        return;
    }
    
    const id = row.dataset.strukturId;
    const rawData = row.dataset.strukturData || '{}';
    
    if (!id) {
        console.error('❌ strukturId missing in row');
        showNotification?.('Data ID tidak ditemukan', 'error');
        return;
    }
    
    let strukturData;
    try {
        strukturData = typeof rawData === 'string' ? JSON.parse(rawData) : rawData;
        console.log('📊 Parsed data:', strukturData);
    } catch (e) {
        console.error('❌ JSON parse error:', e, rawData);
        showNotification?.('Data struktur rusak', 'error');
        return;
    }
    
    openEditModal(id, strukturData);
};

// 🎯 HELPER FUNCTIONS
function selectDropdownOption(selectId, value) {
    const select = document.getElementById(selectId);
    if (!select) return;
    
    Array.from(select.options).forEach(option => {
        if (option.value == value) {  // Loose comparison for ID
            option.selected = true;
            select.value = value;
            console.log(`✅ Selected ${selectId}:`, option.textContent);
        }
    });
    
    // Trigger change events
    select.dispatchEvent(new Event('change', { bubbles: true }));
    select.dispatchEvent(new Event('input', { bubbles: true }));
}

function handleAvatarPreview(avatarPath) {
    const preview = document.getElementById('currentAvatarPreview');
    const img = document.getElementById('avatarPreviewImg');
    
    if (avatarPath && preview && img) {
        img.src = `/storage/${avatarPath}`;
        preview.classList.remove('hidden');
        console.log('✅ Avatar preview:', avatarPath);
    } else if (preview) {
        preview.classList.add('hidden');
    }
}

function hideErrors(prefix = '') {
    document.querySelectorAll(`[id*="${prefix}"]`).forEach(el => {
        if (el.classList.contains('error')) el.classList.remove('error');
        if (el.tagName === 'DIV' || el.tagName === 'SPAN') el.innerHTML = '';
    });
}

function showNotification(message, type = 'success') {
    // Fallback jika toast tidak ada
    if (typeof showToast === 'function') {
        showToast(message, type);
    } else {
        alert(message);
    }
}


    window.openDeleteModal = function(id, name) {
        document.getElementById('deleteStrukturId').value = id;
        document.getElementById('deletePengurusName').textContent = `Apakah Anda yakin ingin menghapus pengurus "${name}"?`;
        document.getElementById('deleteStrukturModal')?.classList.remove('hidden');
    };

    window.closeDeleteModal = function() {
        document.getElementById('deleteStrukturModal')?.classList.add('hidden');
    };

    // === FORM SUBMISSIONS ===
    document.addEventListener('DOMContentLoaded', function() {
        // Create form
        const createForm = document.getElementById('createStrukturForm');
        if (createForm) {
            createForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                const submitBtn = document.getElementById('createSubmitBtn');
                const formData = new FormData(e.target);
                
                setLoading(submitBtn, true);
                hideErrors('createErrors');

                try {
                    const response = await fetch('{{ route("admin.struktur.store") }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'),
                            'Accept': 'application/json'
                        }
                    });

                    const result = await response.json();

                    if (response.ok) {
                        showNotification(result.message || 'Berhasil ditambahkan!', 'success');
                        closeCreateModal();
                        refreshData();
                    } else {
                        if (result.errors) {
                            showErrors('createErrors', result.errors);
                        } else {
                            throw new Error(result.message || 'Terjadi kesalahan');
                        }
                    }
                } catch (error) {
                    console.error('Create error:', error);
                    showNotification(error.message || 'Terjadi kesalahan!', 'error');
                } finally {
                    setLoading(submitBtn, false);
                }
            });
        }

        // Edit form
        const editForm = document.getElementById('editStrukturForm');
if (editForm) {
    editForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        
        // 🎯 FIX 1: Get ID correctly
        const id = document.getElementById('editStrukturId')?.value;
        const submitBtn = document.getElementById('editSubmitBtn') || e.target.querySelector('button[type="submit"]');
        const formData = new FormData(e.target);
        
        console.log('📤 Submitting struktur ID:', id);
        
        if (!id) {
            showNotification('ID struktur tidak valid', 'error');
            return;
        }
        
        // 🎯 FIX 2: Append _method BEFORE other processing
        formData.append('_method', 'PUT');
        
        // Loading state
        setLoading(submitBtn, true);
        hideErrors('editErrors');
        
        try {
            // 🎯 FIX 3: Correct URL + fetch options
            const response = await fetch(`/admin/struktur/${id}`, {  // ✅ Use ID, not 'struktur'
                method: 'POST',
                body: formData,
                // 🎯 DON'T set Content-Type - browser handles multipart/form-data automatically
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'),
                    'Accept': 'application/json'
                },
                credentials: 'same-origin'  // Include cookies
            });
            
            const result = await response.json();
            console.log('📥 Response:', result);
            
            if (response.ok) {
                showNotification(result.message || '✅ Berhasil diupdate!', 'success');
                closeEditModal();
                refreshData?.();  // Optional
            } else {
                // 🎯 FIX 4: Better error handling
                if (result.errors) {
                    showErrors('editErrors', result.errors);
                } else if (result.message) {
                    showNotification(result.message, 'error');
                } else {
                    throw new Error('Terjadi kesalahan server');
                }
            }
        } catch (error) {
            console.error('❌ Edit error:', error);
            showNotification(error.message || 'Gagal mengupdate struktur', 'error');
        } finally {
            setLoading(submitBtn, false);
        }
    });
}

        // Delete handler
        const deleteBtn = document.getElementById('confirmDeleteBtn');
        if (deleteBtn) {
            deleteBtn.addEventListener('click', async () => {
                const id = document.getElementById('deleteStrukturId').value;
                const submitBtn = document.getElementById('confirmDeleteBtn');
                
                if (!id) {
                    showNotification('ID tidak valid', 'error');
                    return;
                }

                setLoading(submitBtn, true);

                try {
                    const response = await fetch(`/admin/struktur/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'),
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        }
                    });

                    const result = await response.json();

                    if (response.ok) {
                        showNotification(result.message || 'Pengurus berhasil dihapus!', 'success');
                        closeDeleteModal();
                        refreshData();
                    } else {
                        throw new Error(result.message || 'Gagal menghapus pengurus');
                    }
                } catch (error) {
                    console.error('Delete error:', error);
                    showNotification(error.message || 'Terjadi kesalahan!', 'error');
                } finally {
                    setLoading(submitBtn, false);
                }
            });
        }

        // Close modals on outside click
        document.querySelectorAll('#createStrukturModal, #editStrukturModal, #deleteStrukturModal').forEach(modal => {
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    window.closeCreateModal?.();
                    window.closeEditModal?.();
                    window.closeDeleteModal?.();
                }
            });
        });
    });

})();
</script>

