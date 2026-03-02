{{-- CREATE MODAL --}}
<div id="createKeuanganModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 z-50 hidden overflow-y-auto">
    <div class="relative top-20 mx-auto p-6 w-11/12 md:w-3/4 lg:w-1/2 max-h-[90vh] overflow-y-auto">
        <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-2xl">
            <div class="p-8 border-b border-slate-200 dark:border-slate-700 flex justify-between items-center">
                <h3 class="text-2xl font-bold text-slate-900 dark:text-white">Tambah Transaksi Keuangan</h3>
                <button type="button" onclick="closeCreateModal()" class="p-3 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-xl">
                    <svg class="w-6 h-6 text-slate-500 hover:text-slate-900 dark:hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            
            <form id="createKeuanganForm" class="p-8 space-y-6">
                @csrf
                <div id="createErrors" class="space-y-2 hidden"></div>

                {{-- 1. Nama (string) --}}
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3 required">Nama Transaksi *</label>
                    <input type="text" name="name" required maxlength="255"
                           class="w-full p-4 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-emerald-500 dark:bg-slate-700 dark:text-white">
                </div>

                {{-- 2. Nominal (string) --}}
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3 required">Nominal (Rp) *</label>
                    <input type="text" name="nominal" required 
                           class="w-full p-4 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-emerald-500 dark:bg-slate-700 dark:text-white text-right font-mono"
                           placeholder="500000" oninput="formatNumber(this)">
                    <small class="text-xs text-slate-500 mt-1">Hanya angka (contoh: 500000)</small>
                </div>

                {{-- 3. Tanggal (date) --}}
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3 required">Tanggal *</label>
                    <input type="date" name="tanggal" required value="{{ date('Y-m-d') }}"
                           class="w-full p-4 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-emerald-500 dark:bg-slate-700 dark:text-white">
                </div>

                {{-- 4. Type (enum: pendapatan, bantuan, lainnya) ✅ FIXED --}}
                <div class="relative">
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3 required">Tipe Transaksi *</label>
                    <select name="type" required class="w-full p-4 pl-12 pr-10 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-emerald-500 dark:bg-slate-700 dark:text-white">
                        <option value="">-- Pilih Tipe --</option>
                        <option value="pendapatan">Pendapatan</option>
                        <option value="bantuan">Bantuan</option>
                        <option value="lainnya" selected>Lainnya</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none top-14">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                </div>

                {{-- 5. Jenis (enum: pendapatan, pengeluaran) --}}
                <div class="relative">
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3 required">Jenis Transaksi *</label>
                    <select name="jenis" required class="w-full p-4 pl-12 pr-10 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-emerald-500 dark:bg-slate-700 dark:text-white">
                        <option value="">-- Pilih Jenis --</option>
                        <option value="pendapatan" selected>Pendapatan</option>
                        <option value="pengeluaran">Pengeluaran</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none top-14">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                </div>

                {{-- 6. Foreign Keys - Grid Layout (OPTIONAL & NULLABLE) ✅ FIXED --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3">Kegiatan</label>
                        <select name="kegiatan_id" class="w-full p-4 border border-slate-200 dark:border-slate-600 rounded-xl dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-emerald-500">
                            <option value="">-- Pilih Kegiatan --</option>
                            @foreach(\App\Models\Kegiatan::select('id', 'name')->orderBy('name')->limit(50)->get() as $kegiatan)
                                <option value="{{ $kegiatan->id }}" {{ old('kegiatan_id') == $kegiatan->id ? 'selected' : '' }}>
                                    {{ $kegiatan->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3">Event</label>
                        <select name="event_id" class="w-full p-4 border border-slate-200 dark:border-slate-600 rounded-xl dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-emerald-500">
                            <option value="">-- Pilih Event --</option>
                            @foreach(\App\Models\Event::select('id', 'name')->orderBy('name')->limit(50)->get() as $event)
                                <option value="{{ $event->id }}" {{ old('event_id') == $event->id ? 'selected' : '' }}>
                                    {{ $event->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3">Acara</label>
                        <select name="acara_id" class="w-full p-4 border border-slate-200 dark:border-slate-600 rounded-xl dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-emerald-500">
                            <option value="">-- Pilih Acara --</option>
                            @foreach(\App\Models\Acara::select('id', 'name')->orderBy('name')->limit(50)->get() as $acara)
                                <option value="{{ $acara->id }}" {{ old('acara_id') == $acara->id ? 'selected' : '' }}>
                                    {{ $acara->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3">Pendaftaran</label>
                        <select name="pendaftaran_id" class="w-full p-4 border border-slate-200 dark:border-slate-600 rounded-xl dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-emerald-500">
                            <option value="">-- Pilih Pendaftaran --</option>
                            @foreach(\App\Models\Pendaftaran::select('id', 'name')->orderBy('name')->limit(50)->get() as $pendaftaran)
                                <option value="{{ $pendaftaran->id }}" {{ old('pendaftaran_id') == $pendaftaran->id ? 'selected' : '' }}>
                                    {{ $pendaftaran->name ?? 'Pendaftaran #' . $pendaftaran->id }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- 7. User ID (nullable) --}}
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3">User</label>
                    <select name="user_id" class="w-full p-4 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-emerald-500 dark:bg-slate-700 dark:text-white">
                        <option value="">-- Pilih User (Opsional) --</option>
                        @foreach(\App\Models\User::select('id', 'name', 'email')->orderBy('name')->limit(50)->get() as $user)
                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} ({{ $user->email }})
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- 8. Total (string) --}}
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3 required">Total (Rp) *</label>
                    <input type="text" name="total" required 
                           class="w-full p-4 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-emerald-500 dark:bg-slate-700 dark:text-white text-right font-mono"
                           placeholder="500000" oninput="formatNumber(this)">
                    <small class="text-xs text-slate-500 mt-1">Hanya angka (contoh: 500000)</small>
                </div>

                {{-- 9. Keterangan (nullable text) --}}
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3">Keterangan</label>
                    <textarea name="keterangan" rows="3" maxlength="65535"
                              class="w-full p-4 border border-slate-200 dark:border-slate-600 rounded-xl dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-emerald-500"></textarea>
                </div>

                <div class="flex flex-col sm:flex-row gap-3 pt-4">
                    <button type="button" onclick="closeCreateModal()" class="flex-1 px-8 py-4 text-slate-700 dark:text-slate-300 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 rounded-xl">
                        Batal
                    </button>
                    <button type="submit" id="createSubmitBtn" class="flex-1 px-8 py-4 text-white bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 rounded-xl shadow-lg">
                        Simpan Transaksi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- EDIT MODAL --}}
<div id="editKeuanganModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 z-50 hidden overflow-y-auto">
    <div class="relative top-20 mx-auto p-6 w-11/12 md:w-3/4 lg:w-1/2 max-h-[90vh] overflow-y-auto">
        <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-2xl">
            <div class="p-8 border-b border-slate-200 dark:border-slate-700 flex justify-between items-center">
                <h3 class="text-2xl font-bold text-slate-900 dark:text-white">Edit Transaksi Keuangan</h3>
                <button type="button" onclick="closeEditModal()" class="p-3 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-xl">
                    <svg class="w-6 h-6 text-slate-500 hover:text-slate-900 dark:hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            
            <form id="editKeuanganForm" class="p-8 space-y-6">
                <input type="hidden" name="id" id="editKeuanganId">
                @csrf
                <div id="editErrors" class="space-y-2 hidden"></div>

                {{-- 1. Nama --}}
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3 required">Nama Transaksi *</label>
                    <input type="text" name="name" id="editName" required maxlength="255"
                           class="w-full p-4 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-emerald-500 dark:bg-slate-700 dark:text-white">
                </div>

                {{-- 2. Nominal --}}
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3 required">Nominal (Rp) *</label>
                    <input type="text" name="nominal" id="editNominal" required 
                           class="w-full p-4 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-emerald-500 dark:bg-slate-700 dark:text-white text-right font-mono"
                           placeholder="500000" oninput="formatNumber(this)">
                </div>

                {{-- 3. Tanggal --}}
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3 required">Tanggal *</label>
                    <input type="date" name="tanggal" id="editTanggal" required
                           class="w-full p-4 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-emerald-500 dark:bg-slate-700 dark:text-white">
                </div>

                {{-- 4. Type (FIXED enum: pendapatan, bantuan, lainnya) --}}
                <div class="relative">
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3 required">Tipe Transaksi *</label>
                    <select name="type" id="editType" required class="w-full p-4 pl-12 pr-10 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-emerald-500 dark:bg-slate-700 dark:text-white">
                        <option value="">-- Pilih Tipe --</option>
                        <option value="pendapatan">Pendapatan</option>
                        <option value="bantuan">Bantuan</option>
                        <option value="lainnya">Lainnya</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none top-14">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                </div>

                {{-- 5. Jenis --}}
                <div class="relative">
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3 required">Jenis Transaksi *</label>
                    <select name="jenis" id="editJenis" required class="w-full p-4 pl-12 pr-10 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-emerald-500 dark:bg-slate-700 dark:text-white">
                        <option value="">-- Pilih Jenis --</option>
                        <option value="pendapatan">Pendapatan</option>
                        <option value="pengeluaran">Pengeluaran</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none top-14">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                </div>

                {{-- 6. Foreign Keys - Grid Layout (OPTIONAL) --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3">Kegiatan</label>
                        <select name="kegiatan_id" id="editKegiatanId" class="w-full p-4 border border-slate-200 dark:border-slate-600 rounded-xl dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-emerald-500">
                            <option value="">-- Pilih Kegiatan --</option>
                            @foreach(\App\Models\Kegiatan::select('id', 'name')->orderBy('name')->limit(50)->get() as $kegiatan)
                                <option value="{{ $kegiatan->id }}">{{ $kegiatan->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3">Event</label>
                        <select name="event_id" id="editEventId" class="w-full p-4 border border-slate-200 dark:border-slate-600 rounded-xl dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-emerald-500">
                            <option value="">-- Pilih Event --</option>
                            @foreach(\App\Models\Event::select('id', 'name')->orderBy('name')->limit(50)->get() as $event)
                                <option value="{{ $event->id }}">{{ $event->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3">Acara</label>
                        <select name="acara_id" id="editAcaraId" class="w-full p-4 border border-slate-200 dark:border-slate-600 rounded-xl dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-emerald-500">
                            <option value="">-- Pilih Acara --</option>
                            @foreach(\App\Models\Acara::select('id', 'name')->orderBy('name')->limit(50)->get() as $acara)
                                <option value="{{ $acara->id }}">{{ $acara->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3">Pendaftaran</label>
                        <select name="pendaftaran_id" id="editPendaftaranId" class="w-full p-4 border border-slate-200 dark:border-slate-600 rounded-xl dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-emerald-500">
                            <option value="">-- Pilih Pendaftaran --</option>
                            @foreach(\App\Models\Pendaftaran::select('id', 'name')->orderBy('name')->limit(50)->get() as $pendaftaran)
                                <option value="{{ $pendaftaran->id }}">{{ $pendaftaran->name ?? 'Pendaftaran #' . $pendaftaran->id }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- 7. User ID (optional) --}}
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3">User</label>
                    <select name="user_id" id="editUserId" class="w-full p-4 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-emerald-500 dark:bg-slate-700 dark:text-white">
                        <option value="">-- Pilih User (Opsional) --</option>
                        @foreach(\App\Models\User::select('id', 'name', 'email')->orderBy('name')->limit(50)->get() as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                        @endforeach
                    </select>
                </div>

                {{-- 8. Total --}}
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3 required">Total (Rp) *</label>
                    <input type="text" name="total" id="editTotal" required 
                           class="w-full p-4 border border-slate-200 dark:border-slate-600 rounded-xl focus:ring-2 focus:ring-emerald-500 dark:bg-slate-700 dark:text-white text-right font-mono"
                           placeholder="500000" oninput="formatNumber(this)">
                </div>

                {{-- 9. Keterangan --}}
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-3">Keterangan</label>
                    <textarea name="keterangan" id="editKeterangan" rows="3" maxlength="65535"
                              class="w-full p-4 border border-slate-200 dark:border-slate-600 rounded-xl dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-emerald-500"></textarea>
                </div>

                <div class="flex flex-col sm:flex-row gap-3 pt-4">
                    <button type="button" onclick="closeEditModal()" class="flex-1 px-8 py-4 text-slate-700 dark:text-slate-300 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 rounded-xl">
                        Batal
                    </button>
                    <button type="submit" id="editSubmitBtn" class="flex-1 px-8 py-4 text-white bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 rounded-xl shadow-lg">
                        Update Transaksi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- DELETE MODAL --}}
<div id="deleteKeuanganModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-2xl max-w-md w-full mx-4">
        <div class="p-8 text-center">
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-100 dark:bg-red-900/20 mb-6">
                <svg class="h-8 w-8 text-red-600 dark:text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Hapus Transaksi?</h3>
            <p class="text-sm text-slate-600 dark:text-slate-400 mb-6" id="deleteKeuanganName">Apakah Anda yakin ingin menghapus transaksi ini?</p>
            <input type="hidden" id="deleteKeuanganId">
            <div class="flex gap-3">
                <button type="button" onclick="closeDeleteModal()" class="flex-1 px-6 py-3 text-sm font-semibold text-slate-700 dark:text-slate-300 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 rounded-xl">
                    Batal
                </button>
                <button type="button" id="confirmDeleteBtn" class="flex-1 px-6 py-3 text-sm font-semibold text-white bg-red-500 hover:bg-red-600 rounded-xl shadow-lg">
                    Hapus Transaksi
                </button>
            </div>
        </div>
    </div>
</div>

<script>
(function() {
    'use strict';

    // === UTILITY FUNCTIONS ===
    window.formatNumber = function(input) {
        let value = input.value.replace(/[^\d]/g, ''); // Hanya angka
        input.value = value;
    };

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
                            <span><strong>${field.replace('_', ' ').toUpperCase()}:</strong> ${error}</span>
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
        if (window.Alpine && window.KeuanganApp) {
            window.KeuanganApp.refreshData?.();
        } else if (window.Livewire?.find) {
            window.Livewire.find(window.livewireComponentId)?.reload();
        } else {
            setTimeout(() => location.reload(), 1000);
        }
    }

    // === MODAL FUNCTIONS ===
    window.openCreateModal = function() {
        document.getElementById('createKeuanganModal')?.classList.remove('hidden');
        hideErrors('createErrors');
        document.getElementById('createKeuanganForm').reset();
        document.querySelector('input[name="tanggal"]').value = '{{ date('Y-m-d') }}';
    };

    window.closeCreateModal = function() {
        const modal = document.getElementById('createKeuanganModal');
        const form = document.getElementById('createKeuanganForm');
        modal?.classList.add('hidden');
        form?.reset();
        hideErrors('createErrors');
    };

    window.closeEditModal = function() {
        document.getElementById('editKeuanganModal')?.classList.add('hidden');
        hideErrors('editErrors');
    };

    // ✅ FIXED: openEditModal sesuai schema database TERBARU
    window.openEditModal = function(id, keuanganData) {
        const modal = document.getElementById('editKeuanganModal');
        document.getElementById('editKeuanganId').value = id;
        document.getElementById('editName').value = keuanganData.name || '';
        document.getElementById('editNominal').value = keuanganData.nominal || '';
        document.getElementById('editTanggal').value = keuanganData.tanggal || '';
        document.getElementById('editType').value = keuanganData.type || 'lainnya';  // ✅ enum: pendapatan, bantuan, lainnya
        document.getElementById('editJenis').value = keuanganData.jenis || 'pendapatan'; // ✅ enum: pendapatan, pengeluaran
        document.getElementById('editUserId').value = keuanganData.user_id || '';
        document.getElementById('editKegiatanId').value = keuanganData.kegiatan_id || '';
        document.getElementById('editEventId').value = keuanganData.event_id || '';
        document.getElementById('editAcaraId').value = keuanganData.acara_id || '';
        document.getElementById('editPendaftaranId').value = keuanganData.pendaftaran_id || '';
        document.getElementById('editTotal').value = keuanganData.total || '';
        document.getElementById('editKeterangan').value = keuanganData.keterangan || '';
        
        hideErrors('editErrors');
        modal?.classList.remove('hidden');
    };

    window.openEditModalFromRow = function(button) {
        const row = button.closest('tr');
        const id = row.dataset.keuanganId;
        let keuanganData;
        
        try {
            keuanganData = JSON.parse(row.dataset.keuanganData || '{}');
        } catch (e) {
            console.error('Error parsing keuangan data:', e);
            showNotification('Data transaksi tidak valid', 'error');
            return;
        }
        
        window.openEditModal(id, keuanganData);
    };

    window.openDeleteModal = function(id, name) {
        document.getElementById('deleteKeuanganId').value = id;
        document.getElementById('deleteKeuanganName').textContent = `Apakah Anda yakin ingin menghapus transaksi "${name}"?`;
        document.getElementById('deleteKeuanganModal')?.classList.remove('hidden');
    };

    window.closeDeleteModal = function() {
        document.getElementById('deleteKeuanganModal')?.classList.add('hidden');
    };

    // === FORM SUBMISSIONS ===
    document.addEventListener('DOMContentLoaded', function() {
        // Create form
        const createForm = document.getElementById('createKeuanganForm');
        if (createForm) {
            createForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                const submitBtn = document.getElementById('createSubmitBtn');
                const formData = new FormData(e.target);
                
                setLoading(submitBtn, true);
                hideErrors('createErrors');

                try {
                    const response = await fetch('{{ route("admin.keuangan.store") }}', {
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
        const editForm = document.getElementById('editKeuanganForm');
        if (editForm) {
            editForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                const id = document.getElementById('editKeuanganId').value;
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
                    const response = await fetch(`{{ route('admin.keuangan.update', ':id') }}`.replace(':id', id), {
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
                const id = document.getElementById('deleteKeuanganId').value;
                const submitBtn = document.getElementById('confirmDeleteBtn');
                
                if (!id) {
                    showNotification('ID tidak valid', 'error');
                    return;
                }

                setLoading(submitBtn, true);

                try {
                    const response = await fetch(`{{ route('admin.keuangan.destroy', ':id') }}`.replace(':id', id), {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'),
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        }
                    });

                    const result = await response.json();

                    if (response.ok) {
                        showNotification(result.message || 'Transaksi berhasil dihapus!', 'success');
                        closeDeleteModal();
                        refreshData();
                    } else {
                        throw new Error(result.message || 'Gagal menghapus transaksi');
                    }
                } catch (error) {
                    console.error('Delete error:', error);
                    showNotification(error.message || 'Terjadi kesalahan!', 'error');
                } finally {
                    setLoading(submitBtn, false);
                }
            });
        }

        // Close modals on outside click & Escape key
        document.querySelectorAll('#createKeuanganModal, #editKeuanganModal, #deleteKeuanganModal').forEach(modal => {
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    window.closeCreateModal?.();
                    window.closeEditModal?.();
                    window.closeDeleteModal?.();
                }
            });
        });

        // Escape key handler
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeCreateModal();
                closeEditModal();
                closeDeleteModal();
            }
        });
    });

})();
</script>
