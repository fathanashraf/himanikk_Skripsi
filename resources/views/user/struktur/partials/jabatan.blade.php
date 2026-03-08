<div class="struktur-node bg-gradient-to-br from-emerald-500 to-emerald-700 text-white p-8 rounded-2xl shadow-2xl max-w-sm mx-auto border-4 border-emerald-400/50 backdrop-blur-xl relative overflow-hidden group hover:shadow-emerald-500/25">
    @if($jabatan && $jabatan->user)
        <div class="w-32 h-32 mx-auto mb-6 relative overflow-hidden rounded-2xl shadow-2xl ring-4 ring-white/50">
            @if($jabatan->avatar)
                <img src="{{ asset('storage/' . $jabatan->avatar) }}" 
                     alt="{{ $jabatan->user->name ?? $jabatan_nama }}" 
                     class="w-full h-full object-cover hover:scale-105 transition-all duration-300">
            @else
                <img src="https://ui-avatars.com/api/?name={{ urlencode($jabatan->user->name ?? $jabatan_nama) }}&size=256&background=10b981&color=fff" 
                     alt="{{ $jabatan->user->name ?? $jabatan_nama }}" 
                     class="w-full h-full object-cover">
            @endif
        </div>
        <h3 class="text-3xl font-black mb-4 text-center tracking-tight drop-shadow-lg">{{ $jabatan_nama }}</h3>
        <p class="text-2xl font-bold mb-2 text-center drop-shadow-md">{{ $jabatan->user->name }}</p>
        @if($jabatan->user->nim)
            <p class="text-lg font-semibold mb-2 text-center text-emerald-100 drop-shadow-sm">{{ $jabatan->user->nim }}</p>
        @endif
        @if($jabatan->user->email)
            <p class="text-sm font-medium mb-6 text-center text-emerald-50 drop-shadow-sm truncate">
                {{ \Illuminate\Support\Str::limit($jabatan->user->email, 25) }}
            </p>
        @endif
        <div class="mx-auto bg-white/20 px-6 py-3 rounded-xl backdrop-blur-xl border-2 border-white/40 max-w-xs text-center">
            <span class="text-lg font-black tracking-widest text-emerald-50 drop-shadow-sm">2025-2026</span>
        </div>
    @else
        <div class="flex flex-col items-center justify-center py-12">
            <div class="w-32 h-32 mx-auto mb-6 bg-gradient-to-br from-slate-500/40 to-slate-600/40 rounded-2xl flex items-center justify-center border-2 border-dashed border-white/30 backdrop-blur-xl">
                <i class="{{ $icon }} text-5xl text-white/50"></i>
            </div>
            <h3 class="text-3xl font-black mb-4 tracking-tight text-white/80">{{ $jabatan_nama }}</h3>
            <p class="text-xl font-bold text-white/60 mb-4">BELUM DIISI</p>
        </div>
    @endif
    
    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 backdrop-blur-sm">
        @if($jabatan)
            <a href="{{ route('user.struktur.show', $jabatan) }}" 
               class="bg-white/20 hover:bg-white/30 px-8 py-4 rounded-xl backdrop-blur-xl border-2 border-white/40 transition-all duration-200 hover:scale-105">
                <span class="text-lg font-black tracking-widest text-white">LIHAT PROFIL</span>
            </a>
        @else
            <div class="bg-white/20 px-8 py-4 rounded-xl backdrop-blur-xl border-2 border-white/40">
                <span class="text-lg font-black tracking-widest text-white/70">MENUNGGU</span>
            </div>
        @endif
    </div>
</div>
