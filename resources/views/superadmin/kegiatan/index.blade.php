@extends('admin.layouts.app')

@section('title', 'Kelola Kegiatan HIMANIKKA')

@section('content')
<div 
    x-data="kegiatanManager()" 
    x-init="init()" 
    class="min-h-screen space-y-8 p-6"
>
    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
        <div>
            <h1 class="text-4xl font-bold bg-gradient-to-r from-slate-900 to-slate-700 bg-clip-text text-transparent dark:from-white dark:to-slate-200">
                <i class="fas fa-calendar-alt mr-3"></i>
                Kelola Kegiatan
            </h1>
            <p class="text-slate-600 dark:text-slate-400 mt-2 text-lg">Semua kegiatan organisasi HIMANIKKA</p>
        </div>
        
        <button 
            @click="openCreateModal()" 
            class="px-8 py-3 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white font-bold rounded-2xl shadow-xl hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 inline-flex items-center"
        >
            <i class="fas fa-plus mr-2"></i>Tambah Kegiatan
        </button>
    </div>

    {{-- STATS CARDS --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white/70 dark:bg-slate-800/70 backdrop-blur-xl p-6 rounded-3xl border border-slate-200/50 shadow-xl">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 bg-gradient-to-br from-emerald-400 to-emerald-500 rounded-2xl flex items-center justify-center text-white font-bold text-xl">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div>
                    <p class="text-3xl font-bold text-slate-900 dark:text-white" x-text="stats.published"></p>
                    <p class="text-slate-600 dark:text-slate-400 font-semibold">Dipublikasikan</p>
                </div>
            </div>
        </div>
        <div class="bg-white/70 dark:bg-slate-800/70 backdrop-blur-xl p-6 rounded-3xl border border-slate-200/50 shadow-xl">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-2xl flex items-center justify-center text-white font-bold text-xl">
                    <i class="fas fa-edit"></i>
                </div>
                <div>
                    <p class="text-3xl font-bold text-slate-900 dark:text-white" x-text="stats.draft"></p>
                    <p class="text-slate-600 dark:text-slate-400 font-semibold">Draft</p>
                </div>
            </div>
        </div>
        <div class="bg-white/70 dark:bg-slate-800/70 backdrop-blur-xl p-6 rounded-3xl border border-slate-200/50 shadow-xl">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 bg-gradient-to-br from-gray-400 to-gray-500 rounded-2xl flex items-center justify-center text-white font-bold text-xl">
                    <i class="fas fa-archive"></i>
                </div>
                <div>
                    <p class="text-3xl font-bold text-slate-900 dark:text-white" x-text="stats.archived"></p>
                    <p class="text-slate-600 dark:text-slate-400 font-semibold">Arsip</p>
                </div>
            </div>
        </div>
        <div class="bg-white/70 dark:bg-slate-800/70 backdrop-blur-xl p-6 rounded-3xl border border-slate-200/50 shadow-xl">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 bg-gradient-to-br from-blue-400 to-blue-500 rounded-2xl flex items-center justify-center text-white font-bold text-xl">
                    📊
                </div>
                <div>
                    <p class="text-3xl font-bold text-slate-900 dark:text-white" x-text="stats.total"></p>
                    <p class="text-slate-600 dark:text-slate-400 font-semibold">Total</p>
                </div>
            </div>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="bg-white/70 dark:bg-slate-800/70 backdrop-blur-xl rounded-3xl border border-slate-200/50 shadow-2xl overflow-hidden">
        <div class="p-6 border-b border-slate-200/50">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-slate-500 to-slate-600 rounded-xl flex items-center justify-center text-white font-bold text-lg">
                        <i class="fas fa-list"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white" x-text="`${kegiatans.length} Kegiatan`"></h3>
                        <p class="text-sm text-slate-500">Kelola kegiatan organisasi HIMANIKKA</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50/50 dark:bg-slate-900/50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Gambar</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Nama Kegiatan</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Link</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Dibuat</th>
                        <th class="px-6 py-4 text-right text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200/50 dark:divide-slate-700/50">
                    <template x-for="kegiatan in kegiatans" :key="kegiatan.id">
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-900/50 transition-colors group">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div x-show="kegiatan.image_url" class="w-16 h-16 rounded-2xl overflow-hidden shadow-lg group-hover:shadow-xl transition-all bg-gradient-to-br from-slate-100 to-slate-200">
                                    <img :src="kegiatan.image_url" :alt="kegiatan.name" class="w-full h-full object-cover">
                                </div>
                                <div x-show="!kegiatan.image_url" class="w-16 h-16 bg-gradient-to-br from-gray-400 to-gray-500 rounded-2xl flex items-center justify-center text-white font-bold text-lg">
                                    <i class="fas fa-image"></i>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-bold text-slate-900 dark:text-white group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors" x-text="kegiatan.name"></div>
                                <div class="text-sm text-slate-600 dark:text-slate-400 mt-1 line-clamp-2" x-text="kegiatan.description"></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span :class="getStatusClass(kegiatan.status)" class="px-3 py-1 rounded-full text-xs font-bold" x-text="getStatusLabel(kegiatan.status)"></span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a x-show="kegiatan.link" :href="kegiatan.link" target="_blank" class="text-emerald-600 hover:text-emerald-700 font-medium text-sm flex items-center gap-1">
                                    <i class="fas fa-external-link-alt"></i> Buka Link
                                </a>
                                <span x-show="!kegiatan.link" class="text-slate-400 text-sm">-</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 dark:text-slate-400">
                                <div x-text="formatDate(kegiatan.created_at)"></div>
                                <span class="text-xs opacity-75" x-text="formatTime(kegiatan.created_at)"></span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center gap-2 justify-end">
                                    <button @click="openEditModal(kegiatan)" class="p-2 text-emerald-600 hover:text-emerald-800 hover:bg-emerald-100 rounded-xl transition-all" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button @click="toggleStatus(kegiatan)" 
                                        :class="kegiatan.status == 1 ? 'text-yellow-600 hover:text-yellow-800 hover:bg-yellow-100' : 'text-emerald-600 hover:text-emerald-800 hover:bg-emerald-100'"
                                        class="p-2 rounded-xl transition-all" 
                                        :title="kegiatan.status == 1 ? 'Draft' : 'Publikasikan'">
                                        <i :class="kegiatan.status == 1 ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                                    </button>
                                    <button @click="openDeleteModal(kegiatan)" class="p-2 text-red-500 hover:text-red-700 hover:bg-red-100 rounded-xl transition-all" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </template>
                    <tr x-show="kegiatans.length === 0">
                        <td colspan="6" class="px-6 py-20 text-center text-slate-500 dark:text-slate-400">
                            <div class="w-24 h-24 bg-gradient-to-br from-slate-100 to-slate-200 rounded-3xl flex items-center justify-center mx-auto mb-6 dark:from-slate-800 dark:to-slate-700">
                                <i class="fas fa-calendar-times text-3xl text-slate-400"></i>
                            </div>
                            <h3 class="text-2xl font-bold mb-2">Belum ada kegiatan</h3>
                            <p class="mb-6">Mulai tambahkan kegiatan pertama Anda.</p>
                            <button @click="openCreateModal()" class="px-6 py-3 bg-emerald-500 hover:bg-emerald-600 text-white font-bold rounded-2xl shadow-xl hover:shadow-2xl transition-all">
                                Tambah Kegiatan Pertama
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- CREATE MODAL --}}
    <div 
        x-show="createModal.open" 
        class="fixed inset-0 bg-black/60 backdrop-blur-md z-[9999] flex items-center justify-center p-6 overflow-y-auto"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @keyup.escape="closeCreateModal()"
        @click.away="closeCreateModal()"
        x-cloak
    >
        <div class="bg-white/95 dark:bg-slate-900/95 backdrop-blur-2xl rounded-3xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-hidden border-4 border-white/20 max-md:m-4" @click.stop>
            <!-- Modal Header -->
            <div class="p-8 border-b border-white/20 flex items-center justify-between sticky top-0 bg-white/80 dark:bg-slate-900/80 backdrop-blur-sm z-10">
                <div class="flex items-center gap-4">
                    <i class="fas fa-plus-circle text-emerald-500 text-3xl"></i>
                    <div>
                        <h2 class="text-3xl font-bold text-slate-900 dark:text-white">Tambah Kegiatan Baru</h2>
                        <p class="text-slate-600 dark:text-slate-400">Buat kegiatan baru untuk HIMANIKKA</p>
                    </div>
                </div>
                <button @click="closeCreateModal()" class="p-3 bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 rounded-2xl transition-all shadow-lg hover:shadow-xl">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-8 max-h-[70vh] overflow-y-auto">
                <form @submit.prevent="submitCreateForm" class="space-y-6">
                    <!-- Image Upload & Form Fields (sama seperti sebelumnya) -->
                    @include('admin.kegiatan.modal', ['formData' => 'createModal.formData'])
                    
                    <!-- Submit Button -->
                    <div class="flex gap-4 pt-4">
                        <button 
                            type="button" 
                            @click="closeCreateModal()" 
                            class="flex-1 px-6 py-3 bg-slate-200 hover:bg-slate-300 text-slate-800 font-bold rounded-xl transition-all"
                        >
                            Batal
                        </button>
                        <button 
                            type="submit" 
                            :disabled="createModal.isSubmitting"
                            class="flex-1 px-6 py-3 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all flex items-center justify-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed"
                            x-text="createModal.isSubmitting ? 'Menyimpan...' : 'Tambah Kegiatan'"
                        >
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- EDIT MODAL --}}
    <div 
        x-show="editModal.open" 
        class="fixed inset-0 bg-black/60 backdrop-blur-md z-[9999] flex items-center justify-center p-6 overflow-y-auto"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @keyup.escape="closeEditModal()"
        @click.away="closeEditModal()"
        x-cloak
    >
        <div class="bg-white/95 dark:bg-slate-900/95 backdrop-blur-2xl rounded-3xl max-w-4xl w-full max-h-[90vh] overflow-hidden border-4 border-white/20 max-md:m-4" @click.stop>
            <!-- Modal Header -->
            <div class="p-8 border-b border-white/20 flex items-center justify-between sticky top-0 bg-white/80 dark:bg-slate-900/80 backdrop-blur-sm z-10">
                <div class="flex items-center gap-4">
                    <i class="fas fa-edit text-blue-500 text-3xl"></i>
                    <div>
                        <h2 class="text-3xl font-bold text-slate-900 dark:text-white">Edit Kegiatan</h2>
                        <p class="text-slate-600 dark:text-slate-400" x-text="`Edit kegiatan: ${editModal.data.name || ''}`"></p>
                    </div>
                </div>
                <button @click="closeEditModal()" class="p-3 bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 rounded-2xl transition-all shadow-lg hover:shadow-xl">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-8 max-h-[70vh] overflow-y-auto">
                <form @submit.prevent="submitEditForm" class="space-y-6">
                    @include('admin.kegiatan.modal', ['formData' => 'editModal.formData'])
                    
                    <!-- Submit Button -->
                    <div class="flex gap-4 pt-4">
                        <button 
                            type="button" 
                            @click="closeEditModal()" 
                            class="flex-1 px-6 py-3 bg-slate-200 hover:bg-slate-300 text-slate-800 font-bold rounded-xl transition-all"
                        >
                            Batal
                        </button>
                        <button 
                            type="submit" 
                            :disabled="editModal.isSubmitting"
                            class="flex-1 px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all flex items-center justify-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed"
                            x-text="editModal.isSubmitting ? 'Menyimpan...' : 'Update Kegiatan'"
                        >
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- DELETE MODAL --}}
    <div 
        x-show="deleteModal.open" 
        class="fixed inset-0 bg-black/60 backdrop-blur-md z-[9999] flex items-center justify-center p-6"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @keyup.escape="closeDeleteModal()"
        @click.away="closeDeleteModal()"
        x-cloak
    >
        <div class="bg-white/95 dark:bg-slate-900/95 backdrop-blur-2xl rounded-3xl shadow-2xl w-full max-w-md border-4 border-white/20 max-md:m-4" @click.stop>
            <div class="p-8 text-center">
                <div class="w-20 h-20 mx-auto mb-6 bg-gradient-to-br from-red-400 to-red-500 rounded-3xl flex items-center justify-center text-white text-3xl shadow-2xl">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-4">Hapus Kegiatan?</h3>
                <p class="text-slate-600 dark:text-slate-400 mb-8 max-w-sm mx-auto" x-text="`Anda yakin ingin menghapus kegiatan "${deleteModal.data.name}"? Data tidak dapat dikembalikan.`"></p>
                <div class="flex gap-4 pt-4">
                    <button 
                        @click="closeDeleteModal()" 
                        class="flex-1 px-6 py-3 bg-slate-200 hover:bg-slate-300 text-slate-800 font-bold rounded-xl transition-all"
                    >
                        Batal
                    </button>
                    <button 
                        @click="confirmDelete()" 
                        class="flex-1 px-6 py-3 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all flex items-center justify-center gap-2"
                    >
                        <i class="fas fa-trash"></i>
                        Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function kegiatanManager() {
    return {
        kegiatans: @json($kegiatans ?? []),
        stats: {
            published: 0,
            draft: 0,
            archived: 0,
            total: 0
        },

        // Modal states
        createModal: {
            open: false,
            formData: {
                name: '',
                description: '',
                status: '1',
                link: '',
                image: null
            },
            previewImage: null,
            isSubmitting: false
        },

        editModal: {
            open: false,
            data: {},
            formData: {
                name: '',
                description: '',
                status: '1',
                link: '',
                image: null
            },
            previewImage: null,
            isSubmitting: false
        },

        deleteModal: {
            open: false,
            data: {}
        },

        init() {
            this.calculateStats();
        },

        calculateStats() {
            this.stats.published = this.kegiatans.filter(k => k.status == 1).length;
            this.stats.draft = this.kegiatans.filter(k => k.status == 0).length;
            this.stats.archived = this.kegiatans.filter(k => k.status == 2).length;
            this.stats.total = this.kegiatans.length;
        },

        // CREATE MODAL METHODS
        openCreateModal() {
            this.createModal.formData = {
                name: '',
                description: '',
                status: '1',
                link: '',
                image: null
            };
            this.createModal.previewImage = null;
            this.createModal.isSubmitting = false;
            this.createModal.open = true;
            
            this.$nextTick(() => {
                this.$refs?.createImageInput?.click();
            });
        },

        closeCreateModal() {
            this.createModal.open = false;
            this.resetCreateForm();
        },

        resetCreateForm() {
            this.createModal.formData = {
                name: '',
                description: '',
                status: '1',
                link: '',
                image: null
            };
            this.createModal.previewImage = null;
            this.createModal.isSubmitting = false;
        },

        // EDIT MODAL METHODS
        openEditModal(kegiatan) {
            this.editModal.data = kegiatan;
            this.editModal.formData = {
                name: kegiatan.name || '',
                description: kegiatan.description || '',
                status: kegiatan.status?.toString() || '1',
                link: kegiatan.link || '',
                image: null
            };
            this.editModal.previewImage = kegiatan.image_url || null;
            this.editModal.isSubmitting = false;
            this.editModal.open = true;
        },

        closeEditModal() {
            this.editModal.open = false;
            this.resetEditForm();
        },

        resetEditForm() {
            this.editModal.formData = {
                name: '',
                description: '',
                status: '1',
                link: '',
                image: null
            };
            this.editModal.previewImage = null;
            this.editModal.isSubmitting = false;
            this.editModal.data = {};
        },

        // DELETE MODAL METHODS
        openDeleteModal(kegiatan) {
            this.deleteModal.data = kegiatan;
            this.deleteModal.open = true;
        },

        closeDeleteModal() {
            this.deleteModal.open = false;
            this.deleteModal.data = {};
        },

        // Form handling methods (sama seperti sebelumnya, tapi dipisah)
        handleImageUpload(event, modalType) {
            const file = event.target.files?.[0] || event.dataTransfer.files?.[0];
            if (file && file.type.startsWith('image/') && file.size < 2 * 1024 * 1024) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    if (modalType === 'create') {
                        this.createModal.previewImage = e.target.result;
                        this.createModal.formData.image = file;
                    } else {
                        this.editModal.previewImage = e.target.result;
                        this.editModal.formData.image = file;
                    }
                };
                reader.readAsDataURL(file);
            } else {
                alert('File harus gambar dan ukuran maksimal 2MB!');
            }
        },

        // Utility methods (sama seperti sebelumnya)
        getStatusClass(status) {
            const classes = {
                0: 'bg-yellow-100 text-yellow-800',
                1: 'bg-emerald-100 text-emerald-800',
                2: 'bg-gray-100 text-gray-800'
            };
            return classes[status] || 'bg-gray-100 text-gray-800';
        },

        getStatusLabel(status) {
            const labels = { 0: 'Draft', 1: 'Dipublikasikan', 2: 'Arsip' };
            return labels[status] || 'Unknown';
        },

        formatDate(date) {
            return new Date(date).toLocaleDateString('id-ID', { 
                day: 'numeric', 
                month: 'short', 
                year: 'numeric' 
            });
        },

        formatTime(date) {
            return new Date(date).toLocaleTimeString('id-ID', { 
                hour: '2-digit', 
                minute: '2-digit' 
            });
        },

        // Submit methods
        async submitCreateForm() {
            await this.submitForm('create', this.createModal);
        },

        async submitEditForm() {
            await this.submitForm('edit', this.editModal);
        },

        async submitForm(type, modal) {
            if (!modal.formData.name.trim() || !modal.formData.description.trim()) {
                alert('Nama dan deskripsi wajib diisi!');
                return;
            }

            modal.isSubmitting = true;
            const formData = new FormData();
            formData.append('name', modal.formData.name);
            formData.append('description', modal.formData.description);
            formData.append('status', modal.formData.status);
            formData.append('link', modal.formData.link);
            if (modal.formData.image) {
                formData.append('image', modal.formData.image);
            }

            try {
                let response;
                if (type === 'create') {
                    response = await fetch('{{ route("admin.kegiatan.store") }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    });
                } else {
                    formData.append('_method', 'PUT');
                    response = await fetch(`{{ route("admin.kegiatan.update", ":id") }}`.replace(':id', this.editModal.data.id), {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    });
                }

                const data = await response.json();
                if (data.success) {
                    this.showToast(data.message || 'Kegiatan berhasil disimpan!');
                    if (type === 'create') {
                        this.closeCreateModal();
                    } else {
                        this.closeEditModal();
                    }
                    await this.refreshData();
                } else {
                    alert(data.message || 'Terjadi kesalahan!');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menyimpan data!');
            } finally {
                modal.isSubmitting = false;
            }
        },

        async toggleStatus(kegiatan) {
            if (!confirm(`Ubah status kegiatan "${kegiatan.name}"?`)) return;
            
            const newStatus = kegiatan.status == 1 ? 0 : 1;
            try {
                const response = await fetch(`/admin/kegiatans/${kegiatan.id}/status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ status: newStatus })
                });
                const data = await response.json();
                if (data.success) {
                    kegiatan.status = newStatus;
                    this.calculateStats();
                    this.showToast(data.message || 'Status berhasil diubah!');
                } else {
                    alert(data.message || 'Gagal mengubah status!');
                }
            } catch (error) {
                console.error(error);
                alert('Terjadi kesalahan!');
            }
        },

        async confirmDelete() {
            try {
                const response = await fetch(`/admin/kegiatans/${this.deleteModal.data.id}`, {
                    method: 'DELETE',
                    headers: { 
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content 
                    }
                });
                const data = await response.json();
                if (data.success) {
                    this.kegiatans = this.kegiatans.filter(k => k.id !== this.deleteModal.data.id);
                    this.calculateStats();
                    this.closeDeleteModal();
                    this.showToast('Kegiatan berhasil dihapus!');
                } else {
                    alert(data.message || 'Gagal menghapus kegiatan!');
                }
            } catch (error) {
                console.error(error);
                alert('Terjadi kesalahan!');
            }
        },

        async refreshData() {
            try {
                const response = await fetch('{{ route("admin.kegiatan.data") }}');
                const data = await response.json();
                this.kegiatans = data.kegiatans || [];
                this.calculateStats();
            } catch (error) {
                console.error('Error refreshing data:', error);
            }
        },

        showToast(message) {
            const toast = document.createElement('div');
            toast.className = 'fixed top-4 right-4 bg-emerald-500 text-white px-6 py-3 rounded-2xl shadow-2xl z-[10000] transform translate-x-full transition-all duration-300 font-medium';
            toast.textContent = message;
            document.body.appendChild(toast);
            
            setTimeout(() => toast.classList.remove('translate-x-full'), 100);
            setTimeout(() => {
                toast.classList.add('translate-x-full');
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }
    }
}
</script>

<style>
[x-cloak] { 
    display: none !important; 
}
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection
