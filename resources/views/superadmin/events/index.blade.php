@extends('admin.layouts.app')

@section('title', 'Kelola Event HIMANIKKA')

@section('content')
<div x-data="EventManager()" x-init="init()" class="min-h-screen space-y-8 p-6">
    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
        <div>
            <h1 class="text-4xl font-bold bg-gradient-to-r from-slate-900 to-slate-700 bg-clip-text text-transparent dark:from-white dark:to-slate-200">
                <i class="fas fa-calendar-alt mr-3"></i>
                Kelola Event
            </h1>
            <p class="text-slate-600 dark:text-slate-400 mt-2 text-lg">Semua Event organisasi HIMANIKKA</p>
        </div>
        
        <button @click="openModal('create')" 
                class="px-8 py-3 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white font-bold rounded-2xl shadow-xl hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 inline-flex items-center">
            <i class="fas fa-plus mr-2"></i>Tambah Event
        </button>
    </div>

    {{-- STATS CARDS --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white/70 dark:bg-slate-800/70 backdrop-blur-xl p-6 rounded-3xl border border-slate-200/50 shadow-xl hover:shadow-2xl transition-all duration-300">
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
        <div class="bg-white/70 dark:bg-slate-800/70 backdrop-blur-xl p-6 rounded-3xl border border-slate-200/50 shadow-xl hover:shadow-2xl transition-all duration-300">
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
        <div class="bg-white/70 dark:bg-slate-800/70 backdrop-blur-xl p-6 rounded-3xl border border-slate-200/50 shadow-xl hover:shadow-2xl transition-all duration-300">
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
        <div class="bg-white/70 dark:bg-slate-800/70 backdrop-blur-xl p-6 rounded-3xl border border-slate-200/50 shadow-xl hover:shadow-2xl transition-all duration-300">
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

    {{-- SEARCH & FILTER --}}
    <div class="bg-white/70 dark:bg-slate-800/70 backdrop-blur-xl rounded-3xl border border-slate-200/50 shadow-2xl p-6">
        <div class="flex flex-col lg:flex-row gap-4 items-center">
            <div class="relative flex-1 max-w-md">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i class="fas fa-search text-slate-400"></i>
                </div>
                <input 
                    type="text" 
                    x-model="searchQuery"
                    @keyup.debounce.300ms="filterEvents()"
                    placeholder="Cari Event..." 
                    class="w-full pl-12 pr-4 py-4 border border-slate-200/50 rounded-2xl bg-white/50 dark:bg-slate-700/50 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-300 text-lg"
                >
            </div>
            <select 
                x-model="statusFilter" 
                @change="filterEvents()"
                class="px-6 py-4 border border-slate-200/50 rounded-2xl bg-white/50 dark:bg-slate-700/50 text-lg font-medium focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-300"
            >
                <option value="">Semua Status</option>
                <option value="0">Draft</option>
                <option value="1">Dipublikasikan</option>
                <option value="2">Arsip</option>
            </select>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="bg-white/70 dark:bg-slate-800/70 backdrop-blur-xl rounded-3xl border border-slate-200/50 shadow-2xl overflow-hidden">
        <div class="p-6 border-b border-slate-200/50">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-slate-500 to-slate-600 rounded-xl flex items-center justify-center text-white font-bold text-lg">
                    <i class="fas fa-list"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white" x-text="`${filteredEvents.length} Event${filteredEvents.length !== 1 ? 's' : ''}`"></h3>
                    <p class="text-sm text-slate-500">Kelola Event organisasi HIMANIKKA</p>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50/50 dark:bg-slate-900/50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Gambar</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Nama Event</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Link</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Dibuat</th>
                        <th class="px-6 py-4 text-right text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200/50 dark:divide-slate-700/50">
                    <template x-for="(event, index) in filteredEvents" :key="event.id">
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-900/50 transition-colors group">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div x-show="event?.image_url" class="w-16 h-16 rounded-2xl overflow-hidden shadow-lg group-hover:shadow-xl transition-all bg-gradient-to-br from-slate-100 to-slate-200">
                                    <img :src="event.image_url" :alt="event?.name || 'Event'" class="w-full h-full object-cover" loading="lazy">
                                </div>
                                <div x-show="!event?.image_url" class="w-16 h-16 bg-gradient-to-br from-gray-400 to-gray-500 rounded-2xl flex items-center justify-center text-white font-bold text-lg">
                                    <i class="fas fa-image"></i>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-bold text-slate-900 dark:text-white group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors max-w-xs" x-text="event?.name || 'Nama tidak tersedia'"></div>
                                <div class="text-sm text-slate-600 dark:text-slate-400 mt-1 line-clamp-2" x-show="event?.description" x-text="event.description"></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span :class="getStatusClass(event?.status)" class="px-3 py-1 rounded-full text-xs font-bold whitespace-nowrap" x-text="getStatusLabel(event?.status)"></span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a x-show="event?.link" :href="event.link" target="_blank" rel="noopener noreferrer" 
                                   class="text-emerald-600 hover:text-emerald-700 font-medium text-sm flex items-center gap-1 transition-colors">
                                    <i class="fas fa-external-link-alt"></i> Buka Link
                                </a>
                                <span x-show="!event?.link" class="text-slate-400 text-sm">-</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 dark:text-slate-400">
                                <div x-text="formatDate(event?.created_at)"></div>
                                <div class="text-xs opacity-75" x-text="formatTime(event?.created_at)"></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center gap-2 justify-end">
                                    <button @click="openModal('edit', event)" 
                                            class="p-2 text-emerald-600 hover:text-emerald-800 hover:bg-emerald-50 dark:hover:bg-emerald-900/50 rounded-xl transition-all" 
                                            title="Edit Event" aria-label="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button @click="toggleStatus(event)" 
                                            :class="event?.status == 1 ? 'text-yellow-600 hover:text-yellow-800 hover:bg-yellow-50 dark:hover:bg-yellow-900/50' : 'text-emerald-600 hover:text-emerald-800 hover:bg-emerald-50 dark:hover:bg-emerald-900/50'"
                                            class="p-2 rounded-xl transition-all" 
                                            :title="event?.status == 1 ? 'Set Draft' : 'Publikasikan'">
                                        <i :class="event?.status == 1 ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                                    </button>
                                    <button @click="confirmDelete(event)" 
                                            class="p-2 text-red-500 hover:text-red-700 hover:bg-red-50 dark:hover:bg-red-900/50 rounded-xl transition-all" 
                                            title="Hapus Event" aria-label="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </template>
                    <tr x-show="filteredEvents.length === 0">
                        <td colspan="6" class="px-6 py-20 text-center text-slate-500 dark:text-slate-400">
                            <div class="w-24 h-24 bg-gradient-to-br from-slate-100 to-slate-200 rounded-3xl flex items-center justify-center mx-auto mb-6 dark:from-slate-800 dark:to-slate-700">
                                <i class="fas fa-calendar-times text-3xl text-slate-400"></i>
                            </div>
                            <h3 class="text-2xl font-bold mb-2 text-slate-900 dark:text-white">Belum ada Event</h3>
                            <p class="mb-6 max-w-md mx-auto">Mulai tambahkan Event pertama Anda untuk HIMANIKKA.</p>
                            <button @click="openModal('create')" 
                                    class="px-8 py-3 bg-emerald-500 hover:bg-emerald-600 text-white font-bold rounded-2xl shadow-xl hover:shadow-2xl transition-all inline-flex items-center mx-auto">
                                <i class="fas fa-plus mr-2"></i>Tambah Event Pertama
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- MODAL CRUD --}}
    <div x-show="isModalOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="fixed inset-0 bg-black/60 backdrop-blur-md z-[9999] flex items-center justify-center p-6" 
         x-cloak
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
                <form @submit.prevent="submitForm" class="space-y-6" novalidate>
                    {{-- Image Upload --}}
                    <div>
                        <label class="block text-xl font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                            <i class="fas fa-image text-emerald-500"></i>Gambar Event
                        </label>
                        <div x-data="{ dragOver: false }"
                             @dragover="dragOver = true" 
                             @dragleave="dragOver = false"
                             @drop.prevent="dragOver = false; handleImageUpload($event)"
                             @click="$refs.imageInput?.click()"
                             :class="dragOver ? 'border-emerald-400 bg-emerald-50/80 ring-4 ring-emerald-200/50 border-4 border-dashed' : 'border-slate-200/50 bg-slate-50/50 dark:bg-slate-900/30 hover:border-slate-300/50 border-4 border-dashed'"
                             class="rounded-2xl p-8 text-center transition-all duration-300 cursor-pointer group">
                            <input type="file" 
                                   @change="handleImageUpload($event)" 
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
                                    <i class="fas fa-info-circle"></i>
                                    PNG, JPG, GIF • Maksimal 2MB
                                </p>
                            </div>
                        </div>
                        {{-- Image Preview --}}
                        <div x-show="previewImage" 
                             class="mt-6 p-4 bg-gradient-to-r from-emerald-50 to-emerald-100 dark:from-emerald-500/10 dark:to-emerald-600/10 rounded-2xl border-2 border-emerald-200 dark:border-emerald-500/30 shadow-lg">
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-sm font-semibold text-emerald-800 dark:text-emerald-300 flex items-center gap-1">
                                    <i class="fas fa-eye"></i>Preview
                                </span>
                                <button @click="clearImage()" 
                                        class="p-1.5 text-red-500 hover:text-red-700 hover:bg-red-100 dark:hover:bg-red-900/50 rounded-lg transition-all"
                                        type="button" aria-label="Hapus preview">
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
                                Nama Event <span class="text-red-500">*</span>
                            </label>
                                                       <input id="name"
                                   type="text" 
                                   x-model="formData.name"
                                   required
                                   :class="formErrors.name ? 'border-red-300 focus:ring-red-500 focus:border-red-500 ring-2 ring-red-200/50' : 'border-slate-200 focus:ring-emerald-500 focus:border-emerald-500'"
                                   class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:outline-none transition-all duration-200"
                                   placeholder="Workshop Laravel HIMANIKKA 2026">
                            <p x-show="formErrors.name" class="mt-1 text-sm text-red-600" x-text="formErrors.name"></p>
                        </div>
                        <div>
                            <label class="block text-lg font-bold text-slate-900 dark:text-white mb-3" for="status">
                                Status <span class="text-red-500">*</span>
                            </label>
                            <select id="status"
                                    x-model="formData.status" 
                                    required
                                    class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">
                                <option value="0">Draft</option>
                                <option value="1">Dipublikasikan</option>
                                <option value="2">Arsip</option>
                            </select>
                        </div>
                        <div class="lg:col-span-2">
                            <label class="block text-lg font-bold text-slate-900 dark:text-white mb-3" for="description">
                                Deskripsi Event <span class="text-red-500">*</span>
                            </label>
                            <textarea id="description"
                                      x-model="formData.description" 
                                      rows="4" 
                                      required
                                      :class="formErrors.description ? 'border-red-300 focus:ring-red-500 focus:border-red-500 ring-2 ring-red-200/50' : 'border-slate-200 focus:ring-emerald-500 focus:border-emerald-500'"
                                      class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:outline-none transition-all resize-vertical"
                                      placeholder="Jelaskan secara singkat tentang Event ini..."></textarea>
                            <p x-show="formErrors.description" class="mt-1 text-sm text-red-600" x-text="formErrors.description"></p>
                        </div>
                        <div class="lg:col-span-2">
                            <label class="block text-lg font-bold text-slate-900 dark:text-white mb-3" for="link">
                                Link Eksternal
                            </label>
                            <input id="link"
                                   type="url" 
                                   x-model="formData.link"
                                   :class="formErrors.link ? 'border-red-300 focus:ring-red-500 focus:border-red-500 ring-2 ring-red-200/50' : 'border-slate-200 focus:ring-emerald-500 focus:border-emerald-500'"
                                   class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:outline-none transition-all"
                                   placeholder="https://himanikka.com/Event/workshop-laravel">
                            <p x-show="formErrors.link" class="mt-1 text-sm text-red-600" x-text="formErrors.link"></p>
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
                                :disabled="isSubmitting || !formData.name?.trim() || !formData.description?.trim()"
                                class="flex-1 px-8 py-3 bg-gradient-to-r from-emerald-500 to-emerald-600 
                                     disabled:from-slate-400 disabled:to-slate-500
                                     hover:from-emerald-600 hover:to-emerald-700 
                                     disabled:hover:from-slate-400 disabled:hover:to-slate-500
                                     text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all flex items-center justify-center gap-2 h-12">
                            <i x-show="!isSubmitting" :class="modalType === 'create' ? 'fas fa-plus' : 'fas fa-save'"></i>
                            <i x-show="isSubmitting" class="fas fa-spinner fa-spin"></i>
                            <span x-text="isSubmitting ? 'Menyimpan...' : (modalType === 'create' ? 'Tambah Event' : 'Update Event')"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function EventManager() {
    return {
        events: [], // Fixed: lowercase and consistent naming
        searchQuery: '',
        statusFilter: '',
        stats: { published: 0, draft: 0, archived: 0, total: 0 },
        isModalOpen: false,
        modalType: '',
        modalData: {},
        formData: {
            name: '',
            description: '',
            status: '1',
            link: '',
            image: null
        },
        previewImage: null,
        isSubmitting: false,
        formErrors: {},

        get safeEvents() {
            return Array.isArray(this.events) ? this.events.filter(item => item && item.id) : [];
        },

        get filteredEvents() { // Fixed: consistent naming
            return this.safeEvents.filter(event => {
                const matchesSearch = !this.searchQuery || 
                    event.name?.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                    event.description?.toLowerCase().includes(this.searchQuery.toLowerCase());
                const matchesStatus = !this.statusFilter || event.status == this.statusFilter;
                return matchesSearch && matchesStatus;
            });
        },

        init() {
            let phpData = @json($events ?? []); // Fixed: lowercase variable name
            this.events = Array.isArray(phpData) ? phpData.filter(item => item && item.id) : [];
            this.calculateStats();
        },

        calculateStats() {
            const safeList = this.safeEvents;
            this.stats.published = safeList.filter(k => k?.status == 1).length;
            this.stats.draft = safeList.filter(k => k?.status == 0).length;
            this.stats.archived = safeList.filter(k => k?.status == 2).length;
            this.stats.total = safeList.length;
        },

        filterEvents() { // Fixed: consistent method name
            this.calculateStats();
        },

        openModal(type, data = null) {
            this.modalType = type;
            this.modalData = data || {};
            this.formData = {
                name: data?.name || '',
                description: data?.description || '',
                status: data?.status?.toString() || '1',
                link: data?.link || '',
                image: null
            };
            this.previewImage = data?.image_url || null;
            this.formErrors = {};
            this.isModalOpen = true;
            
            this.$nextTick(() => {
                const nameInput = document.getElementById('name');
                nameInput?.focus();
            });
        },

        closeModal() {
            this.isModalOpen = false;
            this.resetForm();
        },

        resetForm() {
            this.formData = { name: '', description: '', status: '1', link: '', image: null };
            this.previewImage = null;
            this.formErrors = {};
            this.isSubmitting = false;
        },

        clearImage() {
            this.previewImage = null;
            this.formData.image = null;
        },

        handleImageUpload(event) {
            const file = event.target.files?.[0] || event.dataTransfer?.files?.[0];
            if (!file || !file.type.startsWith('image/') || file.size > 2 * 1024 * 1024) {
                this.showToast('Gambar tidak valid (max 2MB)!', 'error');
                return;
            }
            
            const reader = new FileReader();
            reader.onload = (e) => {
                this.previewImage = e.target.result;
                this.formData.image = file;
            };
            reader.readAsDataURL(file);
        },

        get modalTitle() {
            return this.modalType === 'create' ? 'Tambah Event Baru' : 'Edit Event';
        },

        get modalSubtitle() {
            return this.modalType === 'create' 
                ? 'Buat Event baru untuk HIMANIKKA' 
                : `Mengedit: ${this.modalData.name || 'Loading...'}`
        },

        getStatusClass(status) {
            const s = parseInt(status);
            const classes = {
                0: 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-200 border border-yellow-200/50',
                1: 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-200 border border-emerald-200/50',
                2: 'bg-gray-100 text-gray-800 dark:bg-gray-800/50 dark:text-gray-200 border border-gray-200/50'
            };
            return classes[s] || 'bg-gray-100 text-gray-800';
        },

        getStatusLabel(status) {
            const s = parseInt(status);
            const labels = { 0: 'Draft', 1: 'Dipublikasikan', 2: 'Arsip' };
            return labels[s] || 'Unknown';
        },

        formatDate(dateString) {
            if (!dateString) return '—';
            try {
                return new Date(dateString).toLocaleDateString('id-ID', { 
                    day: 'numeric', 
                    month: 'short', 
                    year: 'numeric' 
                });
            } catch {
                return '—';
            }
        },

        formatTime(dateString) {
            if (!dateString) return '—';
            try {
                return new Date(dateString).toLocaleTimeString('id-ID', { 
                    hour: '2-digit', 
                    minute: '2-digit' 
                });
            } catch {
                return '—';
            }
        },

        async submitForm() {
            const errors = {};
            if (!this.formData.name?.trim()) errors.name = 'Nama Event wajib diisi';
            if (!this.formData.description?.trim()) errors.description = 'Deskripsi wajib diisi';
            
            if (Object.keys(errors).length) {
                this.formErrors = errors;
                this.showToast('Mohon lengkapi field yang wajib diisi!', 'error');
                return;
            }

            this.isSubmitting = true;
            this.formErrors = {};

            const formDataToSend = new FormData();
            formDataToSend.append('name', this.formData.name.trim());
            formDataToSend.append('description', this.formData.description.trim());
            formDataToSend.append('status', this.formData.status);
            if (this.formData.link?.trim()) formDataToSend.append('link', this.formData.link.trim());
            if (this.formData.image) formDataToSend.append('image', this.formData.image);

            try {
                const url = this.modalType === 'create' 
                    ? '{{ route("admin.events.store") }}'
                    : `{{ url("admin/events") }}/${this.modalData.id}`;
                
                const method = this.modalType === 'create' ? 'POST' : 'PUT';
                if (method === 'PUT') formDataToSend.append('_method', 'PUT');

                const response = await fetch(url, {
                    method: 'POST',
                    body: formDataToSend,
                    headers: { 
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content 
                    }
                });

                const data = await response.json();

                if (data.success) {
                    this.showToast(data.message || (this.modalType === 'create' ? 'Event berhasil ditambahkan!' : 'Event berhasil diupdate!'));
                    this.closeModal();
                    await this.refreshData();
                } else {
                    this.showToast(data.message || 'Terjadi kesalahan!', 'error');
                    if (data.errors) {
                        this.formErrors = data.errors;
                    }
                }
            } catch (error) {
                console.error('Submit error:', error);
                this.showToast('Terjadi kesalahan koneksi. Silakan coba lagi.', 'error');
            } finally {
                this.isSubmitting = false;
            }
        },

        async toggleStatus(event) {
            const newStatus = event.status == 1 ? 0 : 1;
            const statusText = newStatus == 1 ? 'Dipublikasikan' : 'Draft';

            if (!confirm(`Yakin ingin mengubah status menjadi ${statusText}?`)) return;

            try {
                const response = await fetch(`/admin/events/${event.id}/status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ status: newStatus })
                });

                const data = await response.json();
                if (data.success) {
                    event.status = newStatus;
                    this.calculateStats();
                    this.showToast(data.message || `Status berhasil diubah ke ${statusText}!`);
                } else {
                    this.showToast(data.message || 'Gagal mengubah status!', 'error');
                }
            } catch (error) {
                console.error('Toggle status error:', error);
                this.showToast('Terjadi kesalahan!', 'error');
            }
        },

        async confirmDelete(event) {
            if (!confirm(`Yakin ingin menghapus Event "${event.name}"?`)) return;
            if (!confirm('Data akan hilang permanen. Lanjutkan?')) return;

            try {
                const response = await fetch(`/admin/events/${event.id}`, {
                    method: 'DELETE',
                    headers: { 
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content 
                    }
                });

                const data = await response.json();
                if (data.success) {
                    this.events = this.events.filter(k => k.id !== event.id);
                    this.calculateStats();
                    this.showToast(data.message || 'Event berhasil dihapus!');
                } else {
                    this.showToast(data.message || 'Gagal menghapus Event!', 'error');
                }
            } catch (error) {
                console.error('Delete error:', error);
                this.showToast('Terjadi kesalahan!', 'error');
            }
        },

        async refreshData() {
            try {
                const response = await fetch('{{ route("admin.events.data") ?? url("admin/events/data") }}');
                if (!response.ok) throw new Error('Failed to fetch');
                
                const data = await response.json();
                this.events = data.events || data.data || [];
                this.calculateStats();
            } catch (error) {
                console.error('Refresh error:', error);
                this.showToast('Gagal memuat data terbaru', 'error');
            }
        },

        showToast(message, type = 'success') {
            const bgClass = type === 'error' 
                ? 'bg-red-500 hover:bg-red-600 shadow-red-400/50 border-red-300/50' 
                : 'bg-emerald-500 hover:bg-emerald-600 shadow-emerald-400/50 border-emerald-300/50';
            
            const toast = document.createElement('div');
            toast.className = `fixed top-20 right-4 ${bgClass} text-white px-6 py-4 rounded-2xl shadow-2xl z-[10000] max-w-sm transform translate-x-full transition-all duration-300 border backdrop-blur-sm`;
            toast.innerHTML = `
                <div class="flex items-center gap-3">
                    <i class="fas ${type === 'error' ? 'fa-exclamation-triangle' : 'fa-check-circle'} text-lg"></i>
                    <span class="font-medium">${message}</span>
                </div>
            `;
            
            document.body.appendChild(toast);
            requestAnimationFrame(() => toast.classList.remove('translate-x-full'));
            
            setTimeout(() => {
                toast.classList.add('translate-x-full');
                setTimeout(() => toast.remove(), 300);
            }, 4000);
        }
    }
}
</script>

<style>
[x-cloak] { display: none !important; }
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.max-w-xs { max-width: 16rem; }
@media (max-width: 640px) {
    .max-w-xs { max-width: 12rem; }
}
</style>
@endsection
