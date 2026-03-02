@extends (
    (auth()->user()?->role === 'superadmin') 
        ? 'admin.layouts.app'
        : 'superadmin.layouts.app'
)

@section('title', 'Kelola Acara HIMANIKKA')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div x-data="acaraManager({{ $acara->toJson() }})" 
     x-init="init()" 
     class="min-h-screen space-y-8 p-6 bg-gradient-to-br from-slate-50 to-emerald-50 dark:from-slate-900 dark:to-slate-800">
    
    <!-- {{-- DEBUG INFO --}}
    <div class="bg-yellow-100 p-4 rounded-xl mb-6 text-sm" x-cloak>
        <strong>Debug:</strong> 
        <span x-text="`Acara: ${acaraList?.length || 0}`"></span> | 
        <span x-text="`Modal: ${isModalOpen ? 'OPEN' : 'CLOSED'}`"></span>
    </div> -->

    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
        <div>
            <h1 class="text-4xl font-bold bg-gradient-to-r from-slate-900 to-slate-700 bg-clip-text text-transparent dark:from-white dark:to-slate-200">
                <i class="fas fa-calendar-alt mr-3"></i>Kelola acara
            </h1>
            <p class="text-slate-600 dark:text-slate-400 mt-2 text-lg">Semua acara HIMANIKKA</p>
        </div>
        <button @click="openModal('create')" 
                class="px-8 py-3 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white font-bold rounded-2xl shadow-xl hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 inline-flex items-center">
            <i class="fas fa-plus mr-2"></i>Tambah acara
        </button>
    </div>

    {{-- STATS --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl p-6 rounded-3xl border shadow-xl">
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
        <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl p-6 rounded-3xl border shadow-xl">
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
        <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl p-6 rounded-3xl border shadow-xl">
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
        <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl p-6 rounded-3xl border shadow-xl">
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
    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl rounded-3xl border shadow-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50/50 dark:bg-slate-900/50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Gambar</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Nama acara</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Link</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Dibuat</th>
                        <th class="px-6 py-4 text-right text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200/50">
                    <tr x-show="acaraList.length === 0" class="text-center py-20 text-slate-500">
                        <td colspan="6">
                            <div class="w-24 h-24 bg-gradient-to-br from-slate-100 to-slate-200 rounded-3xl flex items-center justify-center mx-auto mb-6">
                                <i class="fas fa-calendar-times text-3xl text-slate-400"></i>
                            </div>
                            <h3 class="text-2xl font-bold mb-2 text-slate-900 dark:text-white">Belum ada acara</h3>
                            <p class="mb-6 max-w-md mx-auto">Mulai tambahkan acara pertama Anda untuk HIMANIKKA.</p>
                            <button @click="openModal('create')" 
                                    class="px-8 py-3 bg-emerald-500 hover:bg-emerald-600 text-white font-bold rounded-2xl shadow-xl hover:shadow-2xl transition-all inline-flex items-center mx-auto">
                                <i class="fas fa-plus mr-2"></i>Tambah acara Pertama
                            </button>
                        </td>
                    </tr>
                    
                    <template x-for="acara in acaraList" :key="acara.id">
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-900/50 transition-all group">
                            <td class="px-6 py-4">
                                <div x-show="acara.image" class="w-16 h-16 rounded-2xl overflow-hidden shadow-lg group-hover:shadow-xl transition-all">
                                    <img :src="`/storage/${acara.image}`" :alt="acara.name" class="w-full h-full object-cover" loading="lazy">
                                </div>
                                <div x-show="!acara.image" class="w-16 h-16 bg-gradient-to-br from-gray-400 to-gray-500 rounded-2xl flex items-center justify-center text-white font-bold text-lg">
                                    <i class="fas fa-image"></i>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-bold text-slate-900 dark:text-white group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors" x-text="acara.name"></div>
                                <div class="text-sm text-slate-600 dark:text-slate-400 mt-1 line-clamp-2" x-text="acara.description"></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span :class="getStatusClass(acara.status)" class="px-3 py-1 rounded-full text-xs font-bold whitespace-nowrap" x-text="getStatusLabel(acara.status)"></span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a x-show="acara.link" :href="acara.link" target="_blank" rel="noopener noreferrer" 
                                   class="text-emerald-600 hover:text-emerald-700 font-medium text-sm flex items-center gap-1 transition-colors">
                                    <i class="fas fa-external-link-alt"></i> Buka Link
                                </a>
                                <span x-show="!acara.link" class="text-slate-400 text-sm">-</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 dark:text-slate-400">
                                <div x-text="formatDate(acara.created_at)"></div>
                                <div class="text-xs opacity-75" x-text="formatTime(acara.created_at)"></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center gap-2 justify-end">
                                    <button @click="openModal('edit', acara)" 
                                            class="p-2 text-emerald-600 hover:text-emerald-800 hover:bg-emerald-50 dark:hover:bg-emerald-900/50 rounded-xl transition-all" 
                                            title="Edit acara">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button @click="toggleStatus(acara)" 
                                            :class="acara.status == 1 ? 'text-yellow-600 hover:text-yellow-800 hover:bg-yellow-50 dark:hover:bg-yellow-900/50' : 'text-emerald-600 hover:text-emerald-800 hover:bg-emerald-50 dark:hover:bg-emerald-900/50'"
                                            class="p-2 rounded-xl transition-all" 
                                            :title="acara.status == 1 ? 'Set Draft' : 'Publikasikan'">
                                        <i :class="acara.status == 1 ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                                    </button>
                                    <button @click="confirmDelete(acara)" 
                                            class="p-2 text-red-500 hover:text-red-700 hover:bg-red-50 dark:hover:bg-red-900/50 rounded-xl transition-all" 
                                            title="Hapus acara">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </div>

    {{-- MODAL --}}
    <div x-show="isModalOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="fixed inset-0 bg-black/60 backdrop-blur-md z-[9999] flex items-center justify-center p-6" 
         @keyup.escape="closeModal()"
         @click.away="closeModal()">
        
        <div class="bg-white/95 dark:bg-slate-900/95 backdrop-blur-2xl rounded-3xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-hidden border-4 border-white/20 max-md:m-4 animate-in zoom-in-95 duration-300" @click.stop>
            {{-- Modal Header --}}
            <div class="p-8 border-b border-white/20 flex items-center justify-between sticky top-0 bg-white/90 dark:bg-slate-900/90 backdrop-blur-sm z-10">
                <div class="flex items-center gap-4">
                    <div :class="modalType === 'create' ? 'bg-emerald-500/20 text-emerald-500 border-emerald-500/50' : 'bg-blue-500/20 text-blue-500 border-blue-500/50'"
                         class="p-3 rounded-2xl border-2 flex items-center justify-center">
                        <i :class="modalType === 'create' ? 'fas fa-plus-circle text-2xl' : 'fas fa-edit text-2xl'"></i>
                    </div>
                    <div>
                        <h2 class="text-3xl font-bold text-slate-900 dark:text-white" x-text="modalTitle"></h2>
                        <p class="text-slate-600 dark:text-slate-400" x-text="modalSubtitle"></p>
                    </div>
                </div>
                <button @click="closeModal()" 
                        class="p-3 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-2xl transition-all shadow-lg hover:shadow-xl flex items-center justify-center"
                        aria-label="Tutup modal">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            {{-- Modal Body --}}
            <div class="p-8 max-h-[70vh] overflow-y-auto">
                <form @submit.prevent="submitForm()" class="space-y-6" novalidate>
                    {{-- Image Upload --}}
                    <div>
                        <label class="block text-xl font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                            <i class="fas fa-image text-emerald-500"></i>Gambar acara
                        </label>
                        <div x-data="{ dragOver: false }"
                             @dragover="dragOver = true" 
                             @dragleave="dragOver = false"
                             @drop.prevent="dragOver = false; $parent.handleImageUpload($event)"
                             @click="$refs.imageInput?.click()"
                             :class="dragOver ? 'border-emerald-400 bg-emerald-50/80 ring-4 ring-emerald-200/50 border-4 border-dashed' : 'border-slate-200/50 bg-slate-50/50 dark:bg-slate-900/30 hover:border-slate-300/50 border-4 border-dashed'"
                             class="rounded-2xl p-8 text-center transition-all duration-300 cursor-pointer group">
                            <input type="file" 
                                   @change="$parent.handleImageUpload($event)" 
                                   accept="image/*" 
                                   class="hidden" 
                                   x-ref="imageInput">
                            <div class="space-y-3">
                                <div :class="dragOver ? 'bg-emerald-500 scale-110 shadow-2xl' : 'bg-gradient-to-br from-emerald-400 to-emerald-500 group-hover:shadow-xl shadow-xl'" 
                                     class="w-20 h-20 mx-auto rounded-2xl flex items-center justify-center text-white text-2xl transition-all duration-300 mb-4">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </div>
                                <p class="text-lg font-semibold text-slate-900 dark:text-white" x-text="dragOver ? 'Lepas untuk upload' : 'Klik atau drag gambar ke sini'"></p>
                                <p class="text-slate-500 text-sm flex items-center justify-center gap-1">
                                    <i class="fas fa-info-circle"></i> PNG, JPG, GIF • Maksimal 2MB
                                </p>
                            </div>
                        </div>
                        {{-- Image Preview --}}
                        <div x-show="previewImage" 
                             class="mt-6 p-4 bg-gradient-to-r from-emerald-50 to-emerald-100 rounded-2xl border-2 border-emerald-200 shadow-lg">
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-sm font-semibold text-emerald-800 flex items-center gap-1">
                                    <i class="fas fa-eye"></i>Preview
                                </span>
                                <button @click="$parent.clearImage()" 
                                        class="p-1.5 text-red-500 hover:text-red-700 hover:bg-red-100 rounded-lg transition-all"
                                        type="button">
                                    <i class="fas fa-times text-sm"></i>
                                </button>
                            </div>
                            <img :src="previewImage" class="w-full max-h-64 object-cover rounded-xl shadow-md mx-auto" :alt="formData.name || 'Preview'">
                        </div>
                    </div>

                    {{-- Form Fields --}}
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-lg font-bold text-slate-900 dark:text-white mb-3" for="name">
                                Nama acara <span class="text-red-500">*</span>
                            </label>
                            <input id="name"
                                   type="text" 
                                   x-model="formData.name"
                                   required
                                   class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200"
                                   placeholder="Workshop Laravel HIMANIKKA 2026">
                        </div>
                        <div>
                            <label class="block text-lg font-bold text-slate-900 dark:text-white mb-3" for="status">
                                Status <span class="text-red-500">*</span>
                            </label>
                            <select id="status"
                                    x-model="formData.status" 
                                    required
                                    class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">
                                <option value="0">Draft</option>
                                <option value="1">Dipublikasikan</option>
                                <option value="2">Arsip</option>
                            </select>
                        </div>
                        <div class="lg:col-span-2">
                            <label class="block text-lg font-bold text-slate-900 dark:text-white mb-3" for="description">
                                Deskripsi acara <span class="text-red-500">*</span>
                            </label>
                            <textarea id="description"
                                      x-model="formData.description" 
                                      rows="4" 
                                      required
                                      class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all resize-vertical"
                                      placeholder="Jelaskan secara singkat tentang acara ini..."></textarea>
                        </div>
                        <div class="lg:col-span-2">
                            <label class="block text-lg font-bold text-slate-900 dark:text-white mb-3" for="link">
                                Link Eksternal
                            </label>
                            <input id="link"
                                   type="url" 
                                   x-model="formData.link"
                                   class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all"
                                   placeholder="https://himanikka.com/acara/workshop-laravel">
                        </div>
                    </div>

                                      {{-- Form Actions --}}
                    <div class="flex flex-col sm:flex-row gap-4 pt-6">
                        <button type="button" 
                                @click="closeModal()" 
                                class="flex-1 px-8 py-3 bg-slate-200 hover:bg-slate-300 dark:bg-slate-700 dark:hover:bg-slate-600 text-slate-800 dark:text-slate-200 font-bold rounded-xl transition-all shadow-lg hover:shadow-xl flex items-center justify-center h-12">
                            <i class="fas fa-times mr-2"></i>Batal
                        </button>
                        <button type="submit" 
                                :disabled="!formData.name?.trim() || !formData.description?.trim()"
                                class="flex-1 px-8 py-3 bg-gradient-to-r from-emerald-500 to-emerald-600 
                                       disabled:from-slate-400 disabled:to-slate-500
                                       hover:from-emerald-600 hover:to-emerald-700 
                                       disabled:hover:from-slate-400 disabled:hover:to-slate-500
                                       text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all flex items-center justify-center gap-2 h-12">
                            <i x-show="!isSubmitting" :class="modalType === 'create' ? 'fas fa-plus' : 'fas fa-save'"></i>
                            <i x-show="isSubmitting" class="fas fa-spinner fa-spin"></i>
                            <span x-text="isSubmitting ? 'Menyimpan...' : (modalType === 'create' ? 'Tambah Acara' : 'Update Acara')"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function acaraManager(initialData) {
    console.log('🚀 Alpine Data:', initialData); 
    
    return {
        acaraList: initialData || [],
        isModalOpen: false,
        modalType: '',
        formData: {id: null, name:'', description:'', status:1, link:'', image:null},
        previewImage: '',
        isSubmitting: false,
        stats: { published: 0, draft: 0, archived: 0, total: 0 },

        init() {
            console.log('✅ Alpine INIT - Data count:', this.acaraList.length);
            this.updateStats();
        },

        get modalTitle() {
            return this.modalType === 'create' ? 'Tambah Acara Baru' : 'Edit Acara';
        },

        get modalSubtitle() {
            return this.modalType === 'create' ? 'Buat acara baru untuk HIMANIKKA' : 'Update informasi acara';
        },

        updateStats() {
            this.stats = {
                published: this.acaraList.filter(a => a.status == 1).length,
                draft: this.acaraList.filter(a => a.status == 0).length,
                archived: this.acaraList.filter(a => a.status == 2).length,
                total: this.acaraList.length
            };
        },

        getStatusLabel(status) {
            const labels = {0: 'Draft', 1: 'Dipublikasikan', 2: 'Arsip'};
            return labels[status] || 'Unknown';
        },

        getStatusClass(status) {
            const classes = {
                0: 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/50 dark:text-yellow-200',
                1: 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/50 dark:text-emerald-200',
                2: 'bg-gray-100 text-gray-800 dark:bg-gray-800/50 dark:text-gray-200'
            };
            return classes[status] || 'bg-gray-100 text-gray-800';
        },

        formatDate(dateStr) {
            if (!dateStr) return '-';
            return new Date(dateStr).toLocaleDateString('id-ID', {
                year: 'numeric', month: 'short', day: 'numeric'
            });
        },

        formatTime(dateStr) {
            if (!dateStr) return '-';
            return new Date(dateStr).toLocaleTimeString('id-ID', {hour: '2-digit', minute: '2-digit'});
        },

        // ✅ MODAL FUNCTIONS
        openModal(type, acara = null) {
            console.log('🔔 Modal:', type, acara?.name);
            this.modalType = type;
            this.isModalOpen = true;
            this.formErrors = {};
            
            if (type === 'create') {
                this.formData = {id: null, name:'', description:'', status:1, link:'', image:null};
                this.previewImage = '';
            } else if (acara) {
                this.formData = {...acara, image: null};
                this.previewImage = acara.image_url || acara.image ? `/storage/${acara.image}` : '';
            }
        },

        closeModal() {
            this.isModalOpen = false;
            this.resetForm();
        },

        resetForm() {
            this.formData = {id: null, name:'', description:'', status:1, link:'', image:null};
            this.previewImage = '';
            this.isSubmitting = false;
        },

        handleImageUpload(event) {
            const file = event.target.files?.[0] || event.dataTransfer?.files?.[0];
            if (!file) return;

            if (file.size > 2 * 1024 * 1024) {
                alert('File maksimal 2MB');
                return;
            }

            const reader = new FileReader();
            reader.onload = (e) => {
                this.previewImage = e.target.result;
                this.formData.image = file;
            };
            reader.readAsDataURL(file);
        },

        clearImage() {
            this.previewImage = '';
            this.formData.image = null;
            if (this.$refs?.imageInput) this.$refs.imageInput.value = '';
        },

        async submitForm() {
            if (!this.formData.name?.trim() || !this.formData.description?.trim()) {
                alert('Nama dan deskripsi wajib diisi');
                return;
            }

            this.isSubmitting = true;
            console.log('📤 Submit:', this.formData);

            // Simulate API call
            setTimeout(() => {
                console.log('✅ Form submitted!');
                this.closeModal();
                this.isSubmitting = false;
            }, 1500);
        },

        // ✅ ACTION BUTTONS
        async toggleStatus(acara) {
            if (!confirm(`Yakin ${acara.status == 1 ? 'set draft' : 'publikasikan'} "${acara.name}"?`)) return;

            const index = this.acaraList.findIndex(a => a.id == acara.id);
            if (index !== -1) {
                this.acaraList[index].status = acara.status == 1 ? 0 : 1;
                this.updateStats();
            }
        },

        async confirmDelete(acara) {
            if (!confirm(`Yakin hapus "${acara.name}"?`)) return;
            
            const index = this.acaraList.findIndex(a => a.id == acara.id);
            if (index !== -1) {
                this.acaraList.splice(index, 1);
                this.updateStats();
            }
        }
    };
}
</script>

@endsection
