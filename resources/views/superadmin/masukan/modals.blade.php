{{-- CREATE MODAL --}}
<div id="createmasukkanModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 z-50 hidden overflow-y-auto">
    <div class="relative top-20 mx-auto p-6 w-11/12 md:w-3/4 lg:w-1/2 max-h-[90vh] overflow-y-auto">
        <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-2xl">
            <div class="p-8 border-b border-slate-200 dark:border-slate-700 flex justify-between items-center relative">
                <h3 class="text-2xl font-bold text-slate-900 dark:text-white">Tambah masukkan HIMANIKKA</h3>
                <button type="button" onclick="closeCreateModal()" class="p-3 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-xl transition-all duration-200">
                    <svg class="w-6 h-6 text-slate-500 hover:text-slate-900 dark:hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            
            <form id="createmasukkanForm" enctype="multipart/form-data" class="p-8 space-y-6">
                {{-- Error Container --}}
                <div id="createErrors" class="space-y-2 hidden"></div>

                <!-- nama masukkan -->
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3 required">Nama masukkan *</label>
                    <input type="text" name="nama" required class="w-full p-4 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:bg-slate-700 dark:text-white transition-all duration-200">
                </div>

                <!-- tipe masukkan -->
                <div class="relative">
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3 required">Tipe masukkan *</label>
                    <select name="tipe" required class="w-full p-4 pl-12 pr-10 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:bg-slate-700 dark:text-white transition-all duration-200 appearance-none">
                        <option value="">-- Pilih Tipe --</option>
                        <option value="proposal">Proposal</option>
                        <option value="lpj">LPJ</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none top-14">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                </div>

                <!-- upload File masukkan docx, pdf -->
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3 required">File masukkan (PDF atau DOCX) *</label>
                    <input type="file" name="file" id="createFile" accept=".pdf,.doc,.docx" required 
                           class="w-full p-4 border-2 border-dashed border-slate-200 dark:border-slate-600 rounded-xl 
                                  dark:bg-slate-700/50 dark:text-white transition-all duration-200 cursor-pointer hover:border-emerald-400
                                  file:mr-4 file:py-3 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold 
                                  file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                    <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">Maksimal 10MB. Format PDF, DOC, atau DOCX</p>
                </div>

                <!-- status masukkan -->
                <div class="relative">
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3 required">Status masukkan *</label>
                    <select name="status" required class="w-full p-4 pl-12 pr-10 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:bg-slate-700 dark:text-white transition-all duration-200 appearance-none">
                        <option value="">-- Pilih Status --</option>
                        <option value="pending">Pending</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none top-14">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
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
                        Simpan masukkan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- EDIT MODAL --}}
<div id="editmasukkanModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 z-50 hidden overflow-y-auto">
    <div class="relative top-20 mx-auto p-6 w-11/12 md:w-3/4 lg:w-1/2 max-h-[90vh] overflow-y-auto">
        <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-2xl">
            <div class="p-8 border-b border-slate-200 dark:border-slate-700 flex justify-between items-center relative">
                <h3 class="text-2xl font-bold text-slate-900 dark:text-white">Edit masukkan</h3>
                <button type="button" onclick="closeEditModal()" class="p-3 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-xl transition-all duration-200">
                    <svg class="w-6 h-6 text-slate-500 hover:text-slate-900 dark:hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            
            <form id="editmasukkanForm" enctype="multipart/form-data" class="p-8 space-y-6">
                <input type="hidden" name="id" id="editmasukkanId">
                {{-- Error Container --}}
                <div id="editErrors" class="space-y-2 hidden"></div>

                {{-- Nama masukkan --}}
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3 required">Nama masukkan *</label>
                    <input type="text" name="name" id="editName" required class="w-full p-4 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:bg-slate-700 dark:text-white transition-all duration-200">
                </div>

                {{-- Tipe masukkan --}}
                <div class="relative">
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3 required">Tipe masukkan *</label>
                    <select name="type" id="editType" required class="w-full p-4 pl-12 pr-10 border border-slate-200 dark:border-slate-600 rounded-xl 
                               focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:bg-slate-700 dark:text-white transition-all duration-200 appearance-none">
                        <option value="">-- Pilih Tipe --</option>
                        <option value="proposal">Proposal</option>
                        <option value="lpj">LPJ</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none top-14">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                </div>

                {{-- Status masukkan --}}
                <div class="relative">
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3 required">Status masukkan *</label>
                    <select name="status" id="editStatus" required class="w-full p-4 pl-12 pr-10 border border-slate-200 dark:border-slate-600 rounded-xl 
                               focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:bg-slate-700 dark:text-white transition-all duration-200 appearance-none">
                        <option value="">-- Pilih Status --</option>
                        <option value="pending">Pending</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none top-14">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                </div>

                {{-- File masukkan --}}
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3">File masukkan (PDF atau DOCX)</label>
                    <input type="file" name="file" id="editFile" accept=".pdf,.doc,.docx" 
                           class="w-full p-4 border-2 border-dashed border-slate-200 dark:border-slate-600 rounded-xl 
                                  dark:bg-slate-700/50 dark:text-white transition-all duration-200 cursor-pointer hover:border-emerald-400
                                  file:mr-4 file:py-3 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold 
                                  file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                    <div id="currentFileInfo" class="mt-3 p-3 bg-slate-50 dark:bg-slate-700/50 rounded-xl hidden border">
                        <p class="text-xs text-slate-500 mb-2">File saat ini:</p>
                        <span id="currentFileName" class="text-sm font-medium text-slate-700 dark:text-slate-300"></span>
                    </div>
                </div>

                {{-- Buttons --}}
                <div class="flex flex-col sm:flex-row gap-3 pt-4">
                    <button type="button" onclick="closeEditModal()" class="flex-1 px-8 py-4 text-sm font-semibold text-slate-700 dark:text-slate-300 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 rounded-xl transition-all duration-200">
                        Batal
                    </button>
                    <button type="submit" id="editSubmitBtn" class="flex-1 px-8 py-4 text-sm font-semibold text-white bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                        Update masukkan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- DELETE MODAL --}}
<div id="deletemasukkanModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-2xl max-w-md w-full mx-4">
        <div class="p-8 text-center">
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-100 dark:bg-red-900/20 mb-6">
                <svg class="h-8 w-8 text-red-600 dark:text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Hapus masukkan?</h3>
            <p class="text-sm text-slate-600 dark:text-slate-400 mb-6" id="deletemasukkanName">Apakah Anda yakin ingin menghapus masukkan ini?</p>
            <input type="hidden" id="deletemasukkanId">
            <div class="flex gap-3">
                <button type="button" onclick="closeDeleteModal()" class="flex-1 px-6 py-3 text-sm font-semibold text-slate-700 dark:text-slate-300 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 rounded-xl transition-all duration-200">
                    Batal
                </button>
                <button type="button" id="confirmDeleteBtn" class="flex-1 px-6 py-3 text-sm font-semibold text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:ring-red-200 rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl">
                    Hapus masukkan
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
        if (window.Alpine && window.masukkanApp) {
            window.masukkanApp.refreshData?.();
        } else if (window.Livewire?.find) {
            window.Livewire.find(window.livewireComponentId)?.reload();
        } else {
            setTimeout(() => location.reload(), 1000);
        }
    }

    // === MODAL FUNCTIONS ===
    window.openCreateModal = function() {
        document.getElementById('createmasukkanModal')?.classList.remove('hidden');
        hideErrors('createErrors');
        document.getElementById('createmasukkanForm').reset();
    };

    window.closeCreateModal = function() {
        const modal = document.getElementById('createmasukkanModal');
        const form = document.getElementById('createmasukkanForm');
        modal?.classList.add('hidden');
        form?.reset();
        hideErrors('createErrors');
    };

    window.closeEditModal = function() {
        document.getElementById('editmasukkanModal')?.classList.add('hidden');
        hideErrors('editErrors');
    };

    window.openEditModal = function(id, masukkanData) {
        const modal = document.getElementById('editmasukkanModal');
        document.getElementById('editmasukkanId').value = id;
        document.getElementById('editName').value = masukkanData.name || '';
        document.getElementById('editType').value = masukkanData.type || '';
        document.getElementById('editStatus').value = masukkanData.status || '';
        
        // Show current file info
        const fileInfo = document.getElementById('currentFileInfo');
        const fileNameEl = document.getElementById('currentFileName');
        if (masukkanData.file_name) {
            fileNameEl.textContent = masukkanData.file_name;
            fileInfo?.classList.remove('hidden');
        } else {
            fileInfo?.classList.add('hidden');
        }
        
        hideErrors('editErrors');
        modal?.classList.remove('hidden');
    };

    // Untuk table row edit button
    window.openEditModalFromRow = function(button) {
        const row = button.closest('tr');
        const id = row.dataset.masukkanId;
        let masukkanData;
        
        try {
            masukkanData = JSON.parse(row.dataset.masukkanData || '{}');
        } catch (e) {
            console.error('Error parsing masukkan data:', e);
            showNotification('Data masukkan tidak valid', 'error');
            return;
        }
        
        openEditModal(id, masukkanData);
    };

    window.openDeleteModal = function(id, name) {
        document.getElementById('deletemasukkanId').value = id;
        document.getElementById('deletemasukkanName').textContent = `Apakah Anda yakin ingin menghapus masukkan "${name}"?`;
        document.getElementById('deletemasukkanModal')?.classList.remove('hidden');
    };

    window.closeDeleteModal = function() {
        document.getElementById('deletemasukkanModal')?.classList.add('hidden');
    };

    // === FORM SUBMISSIONS ===
    document.addEventListener('DOMContentLoaded', function() {
        // Create form
        const createForm = document.getElementById('createmasukkanForm');
        if (createForm) {
            createForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                const submitBtn = document.getElementById('createSubmitBtn');
                const formData = new FormData(e.target);
                
                setLoading(submitBtn, true);
                hideErrors('createErrors');

                try {
                    const response = await fetch('{{ route("admin.masukan.store") }}', {
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
        const editForm = document.getElementById('editmasukkanForm');
        if (editForm) {
            editForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                const id = document.getElementById('editmasukkanId').value;
                const submitBtn = document.getElementById('editSubmitBtn');
                const formData = new FormData(e.target);
                
                if (!id) {
                    showNotification('ID tidak valid', 'error');
                    return;
                }

                formData.append('_method', 'PUT');

                setLoading(submitBtn, true);
                hideErrors('editErrors');

                try {
                    const response = await fetch(`{{ route('admin.masukan.update', ':id') }}`.replace(':id', id), {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'),
                            'Accept': 'application/json'
                        }
                    });

                    const result = await response.json();

                    if (response.ok) {
                        showNotification(result.message || 'Berhasil diupdate!', 'success');
                        closeEditModal();
                        refreshData();
                    } else {
                        if (result.errors) {
                            showErrors('editErrors', result.errors);
                        } else {
                            throw new Error(result.message || 'Terjadi kesalahan');
                        }
                    }
                } catch (error) {
                    console.error('Edit error:', error);
                    showNotification(error.message || 'Terjadi kesalahan!', 'error');
                } finally {
                    setLoading(submitBtn, false);
                }
            });
        }

        // Delete handler
        const deleteBtn = document.getElementById('confirmDeleteBtn');
        if (deleteBtn) {
            deleteBtn.addEventListener('click', async () => {
                const id = document.getElementById('deletemasukkanId').value;
                const submitBtn = document.getElementById('confirmDeleteBtn');
                
                if (!id) {
                    showNotification('ID tidak valid', 'error');
                    return;
                }

                setLoading(submitBtn, true);

                try {
                    const response = await fetch(`{{ route('admin.masukan.destroy', ':id') }}`.replace(':id', id), {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'),
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        }
                    });

                    const result = await response.json();

                    if (response.ok) {
                        showNotification(result.message || 'masukkan berhasil dihapus!', 'success');
                        closeDeleteModal();
                        refreshData();
                    } else {
                        throw new Error(result.message || 'Gagal menghapus masukkan');
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
        document.querySelectorAll('#createmasukkanModal, #editmasukkanModal, #deletemasukkanModal').forEach(modal => {
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
