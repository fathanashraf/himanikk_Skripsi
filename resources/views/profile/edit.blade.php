@extends (
    (auth()->user()?->role === 'admin') 
        ? 'admin.layouts.app'
        : 'layouts.app'
)

@section('title', 'Edit Profile ')


@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    {{-- Header --}}
    <div class="text-center mb-16">
        <div class="inline-flex items-center gap-4 bg-gradient-to-r from-blue-500 to-indigo-600 
                    px-8 py-6 rounded-3xl shadow-2xl mb-8 backdrop-blur-sm">
            <div class="w-16 h-16 bg-white/30 rounded-3xl flex items-center justify-center backdrop-blur-sm">
                <i class="fas fa-user-edit text-3xl text-white"></i>
            </div>
            <div>
                <h1 class="text-4xl lg:text-5xl font-black bg-gradient-to-r from-slate-900 to-slate-700 
                           dark:from-white dark:to-slate-200 bg-clip-text text-transparent">
                    Edit Profile
                </h1>
                <p class="text-slate-600 dark:text-slate-400 mt-2">Lengkapi informasi profil Anda</p>
            </div>
        </div>
    </div>

    {{-- Form Card --}}
    <div class="bg-white/90 dark:bg-slate-800/95 backdrop-blur-3xl shadow-2xl rounded-3xl 
                border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" 
              x-data="{ submitting: false }" @submit="submitting = true"
              class="p-10">
            @csrf @method('PUT')

            {{-- Personal Information --}}
            <div class="mb-12">
                <h3 class="text-3xl font-bold text-slate-900 dark:text-white mb-8 flex items-center gap-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center shadow-xl">
                        <i class="fas fa-user text-white"></i>
                    </div>
                    Informasi Pribadi
                </h3>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    {{-- Name --}}
                    <div>
                        <label class="block text-xl font-bold text-slate-700 dark:text-slate-200 mb-4 flex items-center gap-3">
                            <i class="fas fa-user text-blue-500 w-5"></i>
                            Nama Lengkap
                        </label>
                        <input type="text" 
                               name="name"
                               value="{{ old('name', auth()->user()->name ?? '') }}"
                               class="w-full px-6 py-5 rounded-2xl border-2 border-slate-200/50 dark:border-slate-700/50 
                                      bg-white/50 dark:bg-slate-900/50 backdrop-blur-sm text-lg focus:border-blue-500 
                                      focus:ring-4 focus:ring-blue-500/20 transition-all shadow-sm 
                                      @error('name') border-red-500 ring-red-500/20 @enderror"
                               placeholder="Masukkan nama lengkap Anda">
                        @error('name')
                            <p class="mt-3 p-3 bg-red-50 dark:bg-red-900/20 border border-red-200/50 rounded-xl">
                                <i class="fas fa-exclamation-circle text-red-500 mr-2"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- NIM --}}
                    @if(auth()->user()->nim)
                    <div>
                        <label class="block text-xl font-bold text-slate-700 dark:text-slate-200 mb-4 flex items-center gap-3">
                            <i class="fas fa-id-card text-emerald-500 w-5"></i>
                            NIM Mahasiswa
                        </label>
                        <input type="text" 
                               name="nim"
                               value="{{ old('nim', auth()->user()->nim ?? '') }}"
                               class="w-full px-6 py-5 rounded-2xl border-2 border-slate-200/50 dark:border-slate-700/50 
                                      bg-white/50 dark:bg-slate-900/50 backdrop-blur-sm text-lg focus:border-emerald-500 
                                      focus:ring-4 focus:ring-emerald-500/20 transition-all shadow-sm 
                                      @error('nim') border-red-500 ring-red-500/20 @enderror"
                               maxlength="20"
                               placeholder="Contoh: 2101234567">
                        @error('nim')
                            <p class="mt-3 p-3 bg-red-50 dark:bg-red-900/20 border border-red-200/50 rounded-xl">
                                <i class="fas fa-exclamation-circle text-red-500 mr-2"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    @endif

                    {{-- NIDN --}}
                    <div>
                        <label class="block text-xl font-bold text-slate-700 dark:text-slate-200 mb-4 flex items-center gap-3">
                            <i class="fas fa-graduation-cap text-purple-500 w-5"></i>
                            NIDN (Dosen)
                        </label>
                        <input type="text" 
                               name="nidn"
                               value="{{ old('nidn', auth()->user()->nidn ?? '') }}"
                               class="w-full px-6 py-5 rounded-2xl border-2 border-slate-200/50 dark:border-slate-700/50 
                                      bg-white/50 dark:bg-slate-900/50 backdrop-blur-sm text-lg focus:border-purple-500 
                                      focus:ring-4 focus:ring-purple-500/20 transition-all shadow-sm 
                                      @error('nidn') border-red-500 ring-red-500/20 @enderror"
                               placeholder="Contoh: 1234567890"
                               maxlength="15">
                        @error('nidn')
                            <p class="mt-3 p-3 bg-red-50 dark:bg-red-900/20 border border-red-200/50 rounded-xl">
                                <i class="fas fa-exclamation-circle text-red-500 mr-2"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="block text-xl font-bold text-slate-700 dark:text-slate-200 mb-4 flex items-center gap-3">
                            <i class="fas fa-envelope text-indigo-500 w-5"></i>
                            Email
                        </label>
                        <input type="email" 
                               name="email"
                               value="{{ old('email', auth()->user()->email ?? '') }}"
                               class="w-full px-6 py-5 rounded-2xl border-2 border-slate-200/50 dark:border-slate-700/50 
                                      bg-white/50 dark:bg-slate-900/50 backdrop-blur-sm text-lg focus:border-indigo-500 
                                      focus:ring-4 focus:ring-indigo-500/20 transition-all shadow-sm 
                                      @error('email') border-red-500 ring-red-500/20 @enderror"
                               placeholder="example@email.com">
                        @error('email')
                            <p class="mt-3 p-3 bg-red-50 dark:bg-red-900/20 border border-red-200/50 rounded-xl">
                                <i class="fas fa-exclamation-circle text-red-500 mr-2"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <!-- status -->
                    <div>
                        <label class="block text-xl font-bold text-slate-700 dark:text-slate-200 mb-4 flex items-center gap-3">
                            <i class="fas fa-user-check text-green-500 w-5"></i>
                            Status
                        </label>
                        <select name="status" 
                                class="w-full px-6 py-5 rounded-2xl border-2 border-slate-200/50 dark:border-slate-700/50 
                                       bg-white/50 dark:bg-slate-900/50 backdrop-blur-sm text-lg focus:border-green-500 
                                       focus:ring-4 focus:ring-green-500/20 transition-all shadow-sm 
                                       @error('status') border-red-500 ring-red-500/20 @enderror">
                            <option value="">Pilih Status</option>
                            <option value="dosen" {{ old('status', auth()->user()->status ?? '') == 'dosen' ? 'selected' : '' }}>Dosen</option>
                            <option value="mahasiswa" {{ old('status', auth()->user()->status ?? '') == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                            <option value="demisioner" {{ old('status', auth()->user()->status ?? '') == 'demisioner' ? 'selected' : '' }}>Demisioner</option>
                            <option value="pengunjung" {{ old('status', auth()->user()->status ?? '') == 'pengunjung' ? 'selected' : '' }}>Pengunjung</option>
                        </select>
                        @error('status')
                            <p class="mt-3 p-3 bg-red-50 dark:bg-red-900/20 border border-red-200/50 rounded-xl">
                                <i class="fas fa-exclamation-circle text-red-500 mr-2"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Contact & Demographic --}}
            <div class="border-t border-slate-200/50 dark:border-slate-700/50 pt-12 mb-12">
                <h3 class="text-3xl font-bold text-slate-900 dark:text-white mb-8 flex items-center gap-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl flex items-center justify-center shadow-xl">
                        <i class="fas fa-address-book text-white"></i>
                    </div>
                    Kontak & Demografi
                </h3>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    {{-- Phone --}}
                    <div>
                        <label class="block text-xl font-bold text-slate-700 dark:text-slate-200 mb-4 flex items-center gap-3">
                            <i class="fas fa-phone text-green-500 w-5"></i>
                            Nomor Telepon
                        </label>
                        <input type="text" 
                               name="phone"
                               value="{{ old('phone', auth()->user()->phone ?? '') }}"
                               class="w-full px-6 py-5 rounded-2xl border-2 border-slate-200/50 dark:border-slate-700/50 
                                      bg-white/50 dark:bg-slate-900/50 backdrop-blur-sm text-lg focus:border-green-500 
                                      focus:ring-4 focus:ring-green-500/20 transition-all shadow-sm 
                                      @error('phone') border-red-500 ring-red-500/20 @enderror"
                               placeholder="+6281234567890">
                        @error('phone')
                            <p class="mt-3 p-3 bg-red-50 dark:bg-red-900/20 border border-red-200/50 rounded-xl">
                                <i class="fas fa-exclamation-circle text-red-500 mr-2"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Address --}}
                    <div class="lg:col-span-2">
                        <label class="block text-xl font-bold text-slate-700 dark:text-slate-200 mb-4 flex items-center gap-3">
                            <i class="fas fa-map-marker-alt text-orange-500 w-5"></i>
                            Alamat
                        </label>
                        <textarea name="address" 
                                  rows="4"
                                  class="w-full px-6 py-5 rounded-2xl border-2 border-slate-200/50 dark:border-slate-700/50 
                                         bg-white/50 dark:bg-slate-900/50 backdrop-blur-sm text-lg focus:border-orange-500 
                                         focus:ring-4 focus:ring-orange-500/20 transition-all shadow-sm resize-vertical 
                                         @error('address') border-red-500 ring-red-500/20 @enderror"
                                  placeholder="Masukkan alamat lengkap Anda">{{ old('address', auth()->user()->address ?? '') }}</textarea>
                        @error('address')
                            <p class="mt-3 p-3 bg-red-50 dark:bg-red-900/20 border border-red-200/50 rounded-xl">
                                <i class="fas fa-exclamation-circle text-red-500 mr-2"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Gender --}}
                    <div>
                        <label class="block text-xl font-bold text-slate-700 dark:text-slate-200 mb-4 flex items-center gap-3">
                            <i class="fas fa-venus-mars text-pink-500 w-5"></i>
                            Jenis Kelamin
                        </label>
                        <select name="gender" 
                                class="w-full px-6 py-5 rounded-2xl border-2 border-slate-200/50 dark:border-slate-700/50 
                                       bg-white/50 dark:bg-slate-900/50 backdrop-blur-sm text-lg focus:border-pink-500 
                                       focus:ring-4 focus:ring-pink-500/20 transition-all shadow-sm 
                                       @error('gender') border-red-500 ring-red-500/20 @enderror">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="male" {{ old('gender', auth()->user()->gender ?? '') == 'male' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="female" {{ old('gender', auth()->user()->gender ?? '') == 'female' ? 'selected' : '' }}>Perempuan</option>
                            <option value="other" {{ old('gender', auth()->user()->gender ?? '') == 'other' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('gender')
                            <p class="mt-3 p-3 bg-red-50 dark:bg-red-900/20 border border-red-200/50 rounded-xl">
                                <i class="fas fa-exclamation-circle text-red-500 mr-2"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Birth Date --}}
                    <div>
                        <label class="block text-xl font-bold text-slate-700 dark:text-slate-200 mb-4 flex items-center gap-3">
                            <i class="fas fa-birthday-cake text-yellow-500 w-5"></i>
                            Tanggal Lahir
                        </label>
                        <input type="date" 
                               name="birth_date"
                               value="{{ old('birth_date', auth()->user()->birth_date ? \Carbon\Carbon::parse(auth()->user()->birth_date)->format('Y-m-d') : '') }}
                               "
                               class="w-full px-6 py-5 rounded-2xl border-2 border-slate-200/50 dark:border-slate-700/50 
                                      bg-white/50 dark:bg-slate-900/50 backdrop-blur-sm text-lg focus:border-yellow-500 
                                      focus:ring-4 focus:ring-yellow-500/20 transition-all shadow-sm 
                                      @error('birth_date') border-red-500 ring-red-500/20 @enderror"
                               max="{{ now()->format('Y-m-d') }}">
                        @error('birth_date')
                            <p class="mt-3 p-3 bg-red-50 dark:bg-red-900/20 border border-red-200/50 rounded-xl">
                                <i class="fas fa-exclamation-circle text-red-500 mr-2"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Avatar Section --}}
            <div class="border-t border-slate-200/50 dark:border-slate-700/50 pt-12">
                <h3 class="text-3xl font-bold text-slate-900 dark:text-white mb-10 flex items-center gap-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-600 rounded-2xl flex items-center justify-center shadow-xl">
                        <i class="fas fa-image text-white"></i>
                    </div>
                    Foto Profil
                </h3>
                
                <div class="max-w-md mx-auto text-center">
                    {{-- Current Avatar --}}
                    <div class="relative inline-block mb-8">
                        <div class="w-32 h-32 mx-auto rounded-full bg-gradient-to-br from-purple-500 to-pink-600 
                                    flex items-center justify-center shadow-2xl border-8 border-white dark:border-slate-800">
                            @if(auth()->user()->avatar && auth()->user()->avatar !== 'default-avatar.png')
                                <img src="{{ auth()->user()->avatar_url }}" 
                                     alt="{{ auth()->user()->name }}" 
                                     class="w-full h-full rounded-full object-cover shadow-2xl">
                            @elseif(auth()->user()->is_google_user)
                                <img src="{{ auth()->user()->avatar_url }}" 
                                     alt="{{ auth()->user()->name }}" 
                                     class="w-full h-full rounded-full object-cover shadow-2xl">
                            @else
                                <span class="text-3xl font-bold text-white tracking-wider drop-shadow-2xl">
                                    {{ strtoupper(substr(auth()->user()->name ?? 'User', 0, 2)) }}
                                </span>
                            @endif
                        </div>
                    </div>

                    {{-- Avatar Upload --}}
                    <div class="p-8 bg-gradient-to-r from-slate-50/70 to-slate-100/50 dark:from-slate-700/40 dark:to-slate-800/20 
                               rounded-3xl border-2 border-slate-200/30 shadow-xl backdrop-blur-sm">
                        <input type="file" 
                               name="avatar"
                               accept="image/jpeg,image/png,image/gif,image/webp"
                               class="hidden" 
                               id="avatar-upload">
                        
                        <label for="avatar-upload" 
                               class="block mx-auto w-fit group cursor-pointer bg-gradient-to-r from-purple-500 to-pink-600 
                                      hover:from-purple-600 hover:to-pink-700 text-white font-bold py-6 px-12 
                                      rounded-3xl shadow-2xl hover:shadow-3xl hover:-translate-y-2 transition-all 
                                      duration-300 flex items-center gap-3 border-2 border-transparent 
                                      hover:border-white/50">
                            <i class="fas fa-camera text-2xl group-hover:rotate-12 transition-transform"></i>
                            <span>Ganti Foto Profil</span>
                        </label>
                        
                        <div class="mt-6 text-sm text-slate-500 dark:text-slate-400 space-y-1">
                            <div><i class="fas fa-info-circle mr-2"></i>Format: JPG, PNG, GIF, WebP</div>
                            <div><i class="fas fa-weight-hanging mr-2"></i>Maksimal 5MB</div>
                        </div>
                    </div>
                    
                    @error('avatar')
                        <div class="mt-6 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200/50 rounded-2xl">
                            <p class="text-sm text-red-600 dark:text-red-400 flex items-center justify-center gap-2">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </p>
                        </div>
                    @enderror
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="flex flex-col sm:flex-row gap-4 pt-16 border-t border-slate-200/50 dark:border-slate-700/50 mt-12">
                <button type="submit"
                        :disabled="submitting"
                        class="flex-1 bg-gradient-to-r from-emerald-500 via-emerald-600 to-teal-600 
                               hover:from-emerald-600 hover:to-teal-700 text-white font-bold py-6 px-10 
                               rounded-3xl shadow-2xl hover:shadow-3xl hover:-translate-y-2 transition-all 
                               duration-300 flex items-center justify-center gap-4 text-lg
                               disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none">
                    <i x-show="!submitting" class="fas fa-save text-xl"></i>
                    <i x-show="submitting" class="fas fa-spinner fa-spin text-xl"></i>
                    <span x-text="submitting ? 'Menyimpan perubahan...' : 'Simpan Semua Perubahan'" 
                          class="font-black tracking-wide"></span>
                </button>
                
                <a href="{{ route('profile.index') }}" 
                   class="flex-1 text-center bg-white/70 dark:bg-slate-700/70 hover:bg-white 
                          dark:hover:bg-slate-600 border-2 border-slate-300/50 dark:border-slate-600/50 
                          text-slate-700 dark:text-slate-300 font-bold py-6 px-10 rounded-3xl shadow-xl 
                          hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 flex 
                          items-center justify-center gap-3 backdrop-blur-sm text-lg">
                    <i class="fas fa-arrow-left text-xl"></i>
                    <span class="font-black tracking-wide">Kembali ke Profile</span>
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
