@extends('user.layouts.app')

@section('title', 'Tentang Kami - HIMANIKKA')

@section('content')
<!-- Hero Section - Clean & Minimal -->
<section class="min-h-screen flex items-center justify-center bg-gradient-to-br from-slate-50 to-emerald-50 dark:from-slate-950 dark:to-slate-900">
    <div class="container mx-auto px-6 lg:px-8 max-w-6xl text-center relative z-10">
        <!-- Badge -->
        <div class="inline-flex items-center gap-3 px-6 py-3 bg-emerald-600/90 backdrop-blur-xl text-white font-semibold 
                    text-lg rounded-2xl shadow-lg border border-emerald-500/50 mb-8 hover:shadow-emerald-500/25 transition-all">
            <i class="fas fa-graduation-cap text-xl"></i>
            <span>{{ $profil->name ?? 'HIMANIKKA' }}</span>
        </div>

        <!-- Main Title & Logo -->
        <div class="max-w-4xl mx-auto mb-16 lg:mb-24">
            <h1 class="text-5xl lg:text-7xl font-bold bg-gradient-to-r from-slate-900 via-emerald-700 to-teal-700 
                       bg-clip-text text-transparent mb-8 leading-tight">
                {{ $profil->singkatan ?? 'HIMANIKKA' }}
            </h1>
            
            @if($profil->logo)
            <div class="mx-auto max-w-xs">
                <img src="{{ $profil->logo }}" 
                     alt="{{ $profil->name }}" 
                     class="w-32 h-32 lg:w-40 lg:h-40 object-contain rounded-2xl shadow-xl border-4 border-white/50 mx-auto">
            </div>
            @endif
        </div>

        <!-- Key Info Cards -->
        <div class="grid md:grid-cols-3 gap-6 max-w-2xl mx-auto">
            <div class="bg-white/90 dark:bg-slate-800/90 backdrop-blur-xl p-6 rounded-2xl shadow-xl border border-slate-200/50">
                <div class="text-3xl font-bold text-emerald-600 mb-2">{{ $profil->singkatan ?? 'HIMANIKKA' }}</div>
                <div class="text-sm text-slate-600 font-medium uppercase tracking-wide">Singkatan</div>
            </div>
            <div class="bg-gradient-to-br from-emerald-500 to-teal-600 text-white p-6 rounded-2xl shadow-xl">
                <div class="text-2xl font-bold mb-2">{{ $profil->motto ?? 'Mars HIMANIKKA' }}</div>
                <div class="text-sm font-medium opacity-90">Motto</div>
            </div>
            <div class="bg-white/90 dark:bg-slate-800/90 backdrop-blur-xl p-6 rounded-2xl shadow-xl border border-slate-200/50">
                <div class="text-2xl font-bold text-slate-900 dark:text-white mb-1">{{ $profil->tahun_didirikan ?? '2020' }}</div>
                <div class="text-sm text-slate-600 font-medium uppercase tracking-wide">Didirikan</div>
            </div>
        </div>
    </div>
</section>

<!-- Content Grid -->
<div class="container mx-auto px-6 lg:px-8 max-w-6xl -mt-20 lg:-mt-32">
    <div class="grid lg:grid-cols-3 gap-8 lg:gap-12 mb-24">
        
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Contact Info -->
            <div class="bg-white/95 dark:bg-slate-800/95 backdrop-blur-xl rounded-3xl p-8 lg:p-12 shadow-xl border border-slate-200/60">
                <h2 class="text-3xl font-bold text-slate-900 dark:text-white mb-8 flex items-center gap-3">
                    <i class="fas fa-info-circle text-emerald-600 text-2xl"></i>
                    Informasi Kontak
                </h2>
                
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="group p-6 bg-gradient-to-r from-slate-50 to-emerald-50 rounded-2xl border-l-4 border-emerald-400 
                                hover:shadow-lg transition-all">
                        <div class="flex items-center gap-4 mb-3">
                            <div class="w-12 h-12 bg-emerald-600 text-white rounded-xl flex items-center justify-center shadow-lg">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <h4 class="font-semibold text-lg">Alamat</h4>
                        </div>
                        <p class="text-slate-700 ml-1">{{ $profil->alamat ?? 'Universitas Islam Negeri Sultan Syarif Kasim Riau' }}</p>
                    </div>

                    <div class="group p-6 bg-gradient-to-r from-slate-50 to-blue-50 rounded-2xl border-l-4 border-blue-400 
                                hover:shadow-lg transition-all md:col-span-2">
                        <div class="flex items-center gap-4 mb-3">
                            <div class="w-12 h-12 bg-blue-600 text-white rounded-xl flex items-center justify-center shadow-lg">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <h4 class="font-semibold text-lg">Email Resmi</h4>
                        </div>
                        <p class="text-slate-700 font-mono ml-1">{{ $profil->email ?? 'himanikka@uin-suska.ac.id' }}</p>
                    </div>
                </div>
            </div>

            <!-- Sejarah -->
            <div class="bg-gradient-to-br from-slate-50/80 to-emerald-50/50 backdrop-blur-xl rounded-3xl p-8 lg:p-12 
                        shadow-xl border border-white/60">
                <h2 class="text-3xl font-bold text-slate-900 dark:text-white mb-6 flex items-center gap-3">
                    <i class="fas fa-book-open text-orange-500 text-2xl"></i>
                    Sejarah Singkat
                </h2>
                <p class="text-lg text-slate-700 leading-relaxed whitespace-pre-wrap">
                    {!! nl2br(e($profil->sejarah ?? 'HIMANIKKA didirikan pada tahun 2020 sebagai wadah mahasiswa UIN Suska Riau yang peduli dengan pendidikan pranikah dan keluarga Islami. Organisasi ini terus berkembang menjadi himpunan terdepan dalam edukasi nikah khitbah.')) !!}
                </p>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:sticky lg:top-24 space-y-8">
            <!-- Visi Misi Fungsi Tujuan -->
            <div class="bg-white/95 dark:bg-slate-800/95 backdrop-blur-xl rounded-3xl p-8 shadow-xl border border-slate-200/60">
                <h3 class="text-2xl font-bold bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent 
                           mb-8 flex items-center gap-2">
                    <i class="fas fa-bullseye text-xl"></i> Visi & Misi
                </h3>

                <div class="space-y-6">
                    <!-- Visi -->
                    <div>
                        <h4 class="text-xl font-semibold text-slate-900 dark:text-white mb-3 flex items-center gap-2">
                            <i class="fas fa-eye text-emerald-600"></i> Visi
                        </h4>
                        <div class="p-4 bg-emerald-50/50 rounded-xl border border-emerald-200/50">
                            <p class="text-slate-700">{{ $profil->visi ?? 'Menjadi himpunan mahasiswa terdepan dalam pengembangan karakter nikah khitbah Islami.' }}</p>
                        </div>
                    </div>

                    <!-- Fungsi & Tujuan -->
                    <div class="space-y-4">
                        <div>
                            <h5 class="text-lg font-semibold text-slate-900 mb-2 flex items-center gap-2">
                                <i class="fas fa-cogs text-emerald-600 text-sm"></i> Fungsi
                            </h5>
                            <div class="p-4 bg-slate-50/50 rounded-xl border border-slate-200/30 text-sm">
                                {{ $profil->fungsi ?? 'Meningkatkan kualitas sumber daya manusia mahasiswa dalam bidang nikah khitbah dan keluarga Islami.' }}
                            </div>
                        </div>

                        <div>
                            <h5 class="text-lg font-semibold text-slate-900 mb-2 flex items-center gap-2">
                                <i class="fas fa-compass text-orange-600 text-sm"></i> Tujuan
                            </h5>
                            <div class="p-4 bg-orange-50/30 rounded-xl border border-orange-200/30 text-sm">
                                {{ $profil->tujuan ?? 'Menciptakan generasi mahasiswa yang berkualitas dan siap menikah sesuai syariat Islam.' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Misi -->
            @if($profil->misi)
            <div class="bg-white/95 dark:bg-slate-800/95 backdrop-blur-xl rounded-3xl p-6 shadow-xl border border-slate-200/60">
                <h4 class="text-xl font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2 text-center">
                    <i class="fas fa-list-check text-blue-600"></i> Misi
                </h4>
                <div class="space-y-2">
                    @foreach(explode("\n", $profil->misi) as $item)
                        @if(trim($item))
                        <div class="flex items-start gap-3 p-3 bg-blue-50/50 rounded-xl border-l-4 border-blue-200 text-sm">
                            <div class="w-2 h-2 bg-blue-500 rounded-full mt-3 flex-shrink-0"></div>
                            <span class="text-slate-700">{{ trim($item) }}</span>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Documents Section -->
    @if($profil->AD_ART || $profil->instrumen || $profil->lagu)
    <section class="mb-24">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold bg-gradient-to-r from-slate-900 to-emerald-700 bg-clip-text text-transparent mb-4">
                Dokumen Resmi
            </h2>
            <p class="text-lg text-slate-600 max-w-xl mx-auto">Unduh dokumen resmi organisasi HIMANIKKA</p>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
            <!-- AD/ART -->
            @if($profils->AD_ART)
            <a href="{{ asset('storage/' . $profil->AD_ART) }}" target="_blank" 
               class="group bg-white/90 dark:bg-slate-800/90 backdrop-blur-xl rounded-3xl p-8 shadow-xl 
                      border border-slate-200/50 hover:shadow-2xl hover:-translate-y-2 hover:border-purple-400 transition-all h-full">
                <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-indigo-500 rounded-2xl flex items-center 
                            justify-center mb-6 mx-auto shadow-lg group-hover:scale-110 transition-all">
                    <i class="fas fa-music text-xl text-white"></i>
                </div>
                <h4 class="text-2xl font-bold text-slate-900 dark:text-white text-center mb-3">Mars Mahasiswa</h4>
                <p class="text-slate-600 text-center mb-8 leading-relaxed">Dengarkan Mars Mahasiswa</p>
                <div class="flex items-center justify-center gap-2 text-emerald-600 font-semibold text-lg group-hover:translate-x-1 transition-all">
                    <i class="fas fa-external-link-alt"></i>
                    Putar Mars
                </div>
            </a>
            @endif

            <!-- Instrumen -->
            @if($profil->instrumen)
            <a href="{{ asset('storage/' . $profil->instrumen) }}" target="_blank" 
               class="group bg-white/90 dark:bg-slate-800/90 backdrop-blur-xl rounded-3xl p-8 shadow-xl 
                      border border-slate-200/50 hover:shadow-2xl hover:-translate-y-2 hover:border-purple-400 transition-all h-full">
                <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-indigo-500 rounded-2xl flex items-center 
                            justify-center mb-6 mx-auto shadow-lg group-hover:scale-110 transition-all">
                    <i class="fas fa-music text-xl text-white"></i>
                </div>
                <h4 class="text-2xl font-bold text-slate-900 dark:text-white text-center mb-3">Mars Mahasiswa</h4>
                <p class="text-slate-600 text-center mb-8 leading-relaxed">Dengarkan Mars Mahasiswa</p>
                <div class="flex items-center justify-center gap-2 text-emerald-600 font-semibold text-lg group-hover:translate-x-1 transition-all">
                    <i class="fas fa-external-link-alt"></i>
                    Putar Mars
                </div>
            </a>
            @endif

            <!-- Lagu (Audio/Video) -->
            @if($profil->lagu)
            <a href="{{ asset('storage/' . $profil->lagu) }}" target="_blank" 
               class="group bg-white/90 dark:bg-slate-800/90 backdrop-blur-xl rounded-3xl p-8 shadow-xl 
                      border border-slate-200/50 hover:shadow-2xl hover:-translate-y-2 hover:border-green-400 transition-all h-full md:col-span-2 lg:col-span-1">
                <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-500 rounded-2xl flex items-center 
                            justify-center mb-6 mx-auto shadow-lg group-hover:scale-110 transition-all">
                    <i class="fas fa-play-circle text-xl text-white"></i>
                </div>
                <h4 class="text-2xl font-bold text-slate-900 dark:text-white text-center mb-3">Hymne HIMANIKKA</h4>
                <p class="text-slate-600 text-center mb-8 leading-relaxed">Dengarkan lagu Hymne HIMANIKKA</p>
                <div class="flex items-center justify-center gap-2 text-emerald-600 font-semibold text-lg group-hover:translate-x-1 transition-all">
                    <i class="fas fa-external-link-alt"></i>
                    Putar Hymne
                </div>
            </a>
            @endif
        </div>
    </section>
    @endif
</div>
@endsection
