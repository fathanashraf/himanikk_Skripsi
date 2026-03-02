@extends (
    (auth()->user()?->role === 'admin') 
        ? 'admin.layouts.app'
        : 'layouts.app'
)

@section('title', 'Pengaturan Sistem - Himanikka')

@section('content')
<div class="container mx-auto px-6 py-8" x-data="settingsPage()">
    {{-- Header --}}
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                Pengaturan Sistem
            </h1>
            <p class="text-gray-600 dark:text-gray-300 mt-2">
                Kelola pengaturan sistem {{ settings("organization_name", "Himanikka") }}
            </p>
        </div>
        <div class="flex items-center space-x-3">
            <span class="px-4 py-2 bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-200 text-sm font-medium rounded-xl">
    {{ \App\Models\User::count() }} Pengguna
</span>
            <button @click="exportSettings()" 
                    class="px-6 py-2.5 bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-medium rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-0.5">
                <i class="fas fa-download mr-2"></i>Export JSON
            </button>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-xl border border-gray-200 dark:border-gray-700">
            <div class="flex items-center">
                <div class="p-3 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl text-white shadow-lg">
                    <i class="fas fa-cogs text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Settings</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{!! settings('organization_name') ? count(json_decode(settings('all_settings'), true) ?? []) : 0 !!}</p>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-xl border border-gray-200 dark:border-gray-700">
            <div class="flex items-center">
                <div class="p-3 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-xl text-white shadow-lg">
                    <i class="fas fa-users text-xl"></i>
                </div>
                <div class="ml-4">
    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Pengguna</p>
    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ \App\Models\User::count() }}</p>
</div>

            </div>
        </div>
    </div>

    {{-- Main Settings Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
        {{-- Card Pengaturan Umum --}}
        <div class="group bg-white dark:bg-gray-800 shadow-lg rounded-2xl border border-gray-200 dark:border-gray-700 p-8 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 overflow-hidden" data-aos="fade-up">
            <div class="flex items-center mb-6">
                <div class="p-4 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-xl group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <div class="ml-5">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-1">Pengaturan Umum</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Nama organisasi, logo, favicon & info dasar</p>
                    <div class="w-24 h-1 bg-gradient-to-r from-blue-500 to-transparent rounded-full mt-2 group-hover:animate-pulse"></div>
                </div>
            </div>
            <div class="flex gap-3">
                <a href="#" 
                   class="flex-1 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-semibold py-4 px-6 rounded-xl text-center transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:-translate-y-1 group-hover:bg-blue-700">
                    <i class="fas fa-edit mr-2"></i>Atur Sekarang
                </a>
                <button @click="quickEdit('organization_name')" 
                        class="p-4 bg-blue-100 dark:bg-blue-900/50 hover:bg-blue-200 dark:hover:bg-blue-800 rounded-xl text-blue-700 dark:text-blue-300 hover:text-blue-800 transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-1">
                    <i class="fas fa-magic text-xl"></i>
                </button>
            </div>
        </div>

        {{-- Card Pengguna & Role --}}
        <div class="group bg-white dark:bg-gray-800 shadow-lg rounded-2xl border border-gray-200 dark:border-gray-700 p-8 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 overflow-hidden" data-aos="fade-up" data-aos-delay="100">
            <div class="flex items-center mb-6">
                <div class="p-4 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl shadow-xl group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <div class="ml-5">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-1">Pengguna & Role</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Kelola akun, peran akses & permission</p>
                    <div class="w-24 h-1 bg-gradient-to-r from-emerald-500 to-transparent rounded-full mt-2 group-hover:animate-pulse"></div>
                </div>
            </div>
            <div class="flex gap-3">
                <a href="#" 
                   class="flex-1 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white font-semibold py-4 px-6 rounded-xl text-center transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:-translate-y-1 group-hover:bg-emerald-600">
                    <i class="fas fa-users-cog mr-2"></i>Kelola Pengguna
                </a>
                <button @click="showUsersModal = true" 
                        class="p-4 bg-emerald-100 dark:bg-emerald-900/50 hover:bg-emerald-200 dark:hover:bg-emerald-800 rounded-xl text-emerald-700 dark:text-emerald-300 hover:text-emerald-800 transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-1">
                    <i class="fas fa-eye text-xl"></i>
                </button>
            </div>
        </div>

        {{-- Card Notifikasi --}}
        <div class="group bg-white dark:bg-gray-800 shadow-lg rounded-2xl border border-gray-200 dark:border-gray-700 p-8 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 overflow-hidden" data-aos="fade-up" data-aos-delay="200">
            <div class="flex items-center mb-6">
                <div class="p-4 bg-gradient-to-br from-purple-500 to-pink-600 rounded-2xl shadow-xl group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                    </svg>
                </div>
                <div class="ml-5">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-1">Notifikasi</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Email, SMS, push notification & log</p>
                    <div class="w-24 h-1 bg-gradient-to-r from-purple-500 to-transparent rounded-full mt-2 group-hover:animate-pulse"></div>
                </div>
            </div>
            <div class="flex gap-3">
                <a href="#" 
                   class="flex-1 bg-gradient-to-r from-purple-500 to-pink-600 hover:from-purple-600 hover:to-pink-700 text-white font-semibold py-4 px-6 rounded-xl text-center transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:-translate-y-1 group-hover:bg-purple-600">
                    <i class="fas fa-bell mr-2"></i>Konfigurasi
                </a>
                <button @click="testNotification()" 
                        class="p-4 bg-purple-100 dark:bg-purple-900/50 hover:bg-purple-200 dark:hover:bg-purple-800 rounded-xl text-purple-700 dark:text-purple-300 hover:text-purple-800 transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-1">
                    <i class="fas fa-paper-plane text-xl"></i>
                </button>
            </div>
        </div>

        {{-- Card Backup & Keamanan --}}
        <div class="group bg-gradient-to-br from-orange-500/5 to-red-500/5 dark:from-orange-500/10 dark:to-red-500/10 shadow-2xl rounded-2xl border-2 border-orange-200/50 dark:border-orange-800/50 p-8 hover:shadow-3xl hover:-translate-y-3 transition-all duration-500 overflow-hidden lg:col-span-2 xl:col-span-1" data-aos="fade-up" data-aos-delay="300">
            <div class="flex items-center mb-6">
                <div class="p-4 bg-gradient-to-br from-orange-500 via-red-500 to-orange-600 rounded-2xl shadow-2xl group-hover:scale-110 transition-all duration-300 ring-4 ring-orange-200/30 dark:ring-orange-900/30">
                    <svg class="w-7 h-7 text-white drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-5">
                    <h3 class="text-2xl font-bold bg-gradient-to-r from-orange-600 via-red-600 to-orange-700 bg-clip-text text-transparent mb-1">Backup & Keamanan</h3>
                    <p class="text-gray-700 dark:text-gray-300 text-sm font-medium">Database backup, audit log & sistem keamanan</p>
                    <div class="w-32 h-1 bg-gradient-to-r from-orange-500 via-red-500 to-orange-600 rounded-full mt-2 group-hover:animate-pulse shadow-lg"></div>
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <button @click="createBackup()" 
                        class="group/btn bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-semibold py-4 px-6 rounded-xl text-center transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:-translate-y-1 hover:scale-[1.02] border border-orange-300/50">
                    <i class="fas fa-database mr-2"></i>Buat Backup
                </button>
                <button @click="securityCheck()" 
                        class="group/btn bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-semibold py-4 px-6 rounded-xl text-center transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:-translate-y-1 hover:scale-[1.02] border border-red-300/50">
                    <i class="fas fa-shield-alt mr-2"></i>Keamanan
                </button>
            </div>
            <div class="mt-4 p-3 bg-orange-50/50 dark:bg-orange-900/20 rounded-xl border border-orange-200/50 dark:border-orange-800/30">
                <p class="text-xs text-orange-800 dark:text-orange-200 flex items-center">
                    <i class="fas fa-info-circle mr-1"></i>
                    Terakhir backup: {{ \Carbon\Carbon::parse(settings('last_backup', now()->subDays(30)))->format('d M Y H:i') }}
                </p>
            </div>
        </div>
    </div>

    {{-- Quick Edit Modal --}}
    <div x-show="showQuickEdit" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform scale-95"
         x-transition:enter-end="opacity-100 transform scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 transform scale-100"
         x-transition:leave-end="opacity-0 transform scale-95"
         class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex min-h-screen items-end justify-center px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="showQuickEdit" x-transition:enter="transition ease-out duration-300" 
                 x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" 
                 x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" 
                 x-transition:leave-end="opacity-0" 
                 class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" @click="showQuickEdit = false"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div x-show="showQuickEdit" x-transition:enter="transition ease-out duration-300" 
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                 x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                 class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white dark:bg-gray-800 px-8 pt-6 pb-8">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 dark:bg-blue-900/50 sm:mx-0 sm:h-10 sm:w-10">
                            <i class="fas fa-edit text-xl text-blue-600 dark:text-blue-400"></i>
                        </div>
                        <div class="mt-3 sm:ml-4 sm:mt-0 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-bold text-gray-900 dark:text-white" id="modal-title">
                                Edit Cepat: <span x-text="quickEditKey.toUpperCase()"></span>
                            </h3>
                            <div class="mt-4">
                                <input x-model="quickEditValue" type="text" 
                                       class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm" 
                                       placeholder="Masukkan nilai baru">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 dark:bg-gray-900/50 px-8 py-6 sm:px-8 sm:flex sm:flex-row-reverse rounded-b-2xl border-t border-gray-200 dark:border-gray-700">
                    <button @click="saveQuickEdit()"
                            :disabled="!quickEditValue || saving"
                            class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-sm px-8 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-base font-semibold text-white hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200 transform hover:-translate-y-0.5 hover:scale-[1.02]">
                        <span x-show="!saving">Simpan Perubahan</span>
                        <span x-show="saving" class="flex items-center">
                            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Menyimpan...
                        </span>
                    </button>
                    <button @click="showQuickEdit = false" 
                            class="mt-3 w-full inline-flex justify-center rounded-xl border border-gray-300 dark:border-gray-600 shadow-sm px-8 py-3 bg-white dark:bg-gray-700 text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-all duration-200">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function settingsPage() {
        return {
            showQuickEdit: false,
            quickEditKey: '',
            quickEditValue: '',
            saving: false,
            showUsersModal: false,
            
            async quickEdit(key) {
                this.quickEditKey = key
                this.quickEditValue = window.settings?.[key] || ''
                this.showQuickEdit = true
            },
            
            async saveQuickEdit() {
                this.saving = true
                try {
                    const response = await fetch(`#`.replace(':key', this.quickEditKey), {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({ value: this.quickEditValue })
                    })
                    
                    if (response.ok) {
                        this.showToast('Pengaturan berhasil diperbarui!', 'success')
                        this.showQuickEdit = false
                        setTimeout(() => location.reload(), 1000)
                    }
                } catch (error) {
                    this.showToast('Gagal menyimpan pengaturan', 'error')
                } finally {
                    this.saving = false
                }
            },
            
            async exportSettings() {
                const response = await fetch('#')
                const data = await response.json()
                const blob = new Blob([JSON.stringify(data, null, 2)], { type: 'application/json' })
                const url = URL.createObjectURL(blob)
                const a = document.createElement('a')
                a.href = url
                a.download = `himanikka-settings-${new Date().toISOString().split('T')[0]}.json`
                a.click()
                URL.revokeObjectURL(url)
            },
            
            createBackup() {
                this.showConfirm('Buat Backup Database', 'Apakah Anda yakin ingin membuat backup lengkap?', () => {
                    // Backup logic
                })
            },
            
            securityCheck() {
                this.showConfirm('Scan Keamanan', 'Jalankan scan keamanan sistem lengkap?', () => {
                    // Security check logic
                })
            },
            
            testNotification() {
                // Test notification logic
            },
            
            showToast(message, type = 'info') {
                const toast = document.createElement('div')
                toast.className = `fixed top-20 right-6 z-[9999] p-6 rounded-2xl shadow-2xl text-white text-lg font-semibold transform translate-x-full transition-all duration-500 ${
                    type === 'success' ? 'bg-gradient-to-r from-emerald-500 to-teal-600' : 
                    type === 'error' ? 'bg-gradient-to-r from-red-500 to-pink-600' : 
                    'bg-gradient-to-r from-blue-500 to-indigo-600'
                }`
                toast.innerHTML = `
                    <div class="flex items-center">
                        <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-triangle' : 'info-circle'} mr-3 text-xl"></i>
                        ${message}
                    </div>
                `
                
                document.body.appendChild(toast)
                setTimeout(() => toast.classList.remove('translate-x-full'), 100)
                setTimeout(() => toast.remove(), 4000)
            },
            
            showConfirm(title, message, callback) {
                if (confirm(`${title}\n\n${message}`)) {
                    callback()
                }
            }
        }
    }
</script>
@endpush
@endsection
