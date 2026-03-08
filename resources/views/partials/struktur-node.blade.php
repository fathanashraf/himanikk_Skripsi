{{-- BULLETPROOF VERSION --}}
<div class="struktur-node bg-gradient-to-br from-emerald-500 to-emerald-700 text-white p-8 rounded-2xl shadow-2xl max-w-sm mx-auto backdrop-blur-xl relative overflow-hidden group hover:shadow-emerald-500/25 transition-all duration-300">
    
    @if($person && isset($person->user) && $person->user)
        {{-- HAS PERSON --}}
        <div class="w-32 h-32 mx-auto mb-6 relative overflow-hidden rounded-2xl shadow-2xl ring-4 ring-white/50">
            @if(isset($person->avatar) && $person->avatar)
                <img src="{{ asset('storage/' . $person->avatar) }}" 
                     alt="{{ $person->user->name ?? 'Member' }}" 
                     class="w-full h-full object-cover hover:scale-105 transition-all duration-300">
            @else
                <img src="https://ui-avatars.com/api/?name={{ urlencode($person->user->name ?? 'Member') }}&size=256&background=10b981&color=fff" 
                     alt="{{ $person->user->name ?? 'Member' }}" 
                     class="w-full h-full object-cover">
            @endif
        </div>
        
        {{-- Jabatan --}}
        <h3 class="text-2xl lg:text-3xl font-black mb-4 text-center tracking-tight drop-shadow-lg uppercase">
            {{ ucwords(str_replace(['kahim', 'wakahim', 'sekretaris', 'bendahara'], 
                ['Ketua Himpunan', 'Wakil Ketua', 'Sekretaris', 'Bendahara'], 
                $person->jabatan ?? 'Posisi')) }}
        </h3>
        
        {{-- Nama --}}
        <p class="text-xl lg:text-2xl font-bold mb-2 text-center drop-shadow-md">
            {{ $person->user->name ?? 'Nama Member' }}
        </p>
        
        {{-- NIM --}}
        @if(isset($person->user->nim) && $person->user->nim)
            <p class="text-lg font-semibold mb-2 text-center text-emerald-100 drop-shadow-sm">
                {{ $person->user->nim }}
            </p>
        @endif
        
        {{-- Email --}}
        @if(isset($person->user->email) && $person->user->email)
            <p class="text-sm font-medium mb-6 text-center text-emerald-50 drop-shadow-sm truncate">
                {{ \Illuminate\Support\Str::limit($person->user->email, 30) }}
            </p>
        @endif
        
        {{-- Masa Jabatan --}}
        <div class="mx-auto bg-white/20 px-6 py-3 rounded-xl backdrop-blur-xl border-2 border-white/40 max-w-xs text-center">
            <span class="text-lg font-black tracking-widest text-emerald-50 drop-shadow-sm">2025-2026</span>
        </div>
        
    @else
        {{-- EMPTY STATE --}}
        <div class="flex flex-col items-center justify-center py-16">
            <div class="w-32 h-32 mx-auto mb-8 bg-gradient-to-br from-slate-500/40 to-slate-600/40 rounded-2xl flex items-center justify-center border-2 border-dashed border-white/30 backdrop-blur-xl">
                <i class="fas fa-crown text-5xl text-white/50"></i>
            </div>
            <h3 class="text-3xl font-black mb-4 tracking-tight text-white/80 uppercase">POSISI KOSONG</h3>
            <p class="text-xl font-bold text-white/60 mb-6">BELUM DIISI</p>
            <div class="bg-white/20 px-6 py-3 rounded-xl backdrop-blur-xl border-2 border-white/40">
                <span class="text-lg font-black tracking-widest text-white/70">2025-2026</span>
            </div>
        </div>
    @endif
    
    {{-- Button Overlay --}}
    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 bg-black/10 backdrop-blur-sm">
        <a href="#" class="bg-white/90 hover:bg-white px-8 py-3 rounded-xl shadow-2xl text-emerald-700 font-black text-lg tracking-wider transition-all duration-300 hover:scale-105 hover:shadow-emerald-500/50">
            Lihat Profil
        </a>
    </div>
</div>
