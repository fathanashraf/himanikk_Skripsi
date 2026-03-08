<footer class="bg-gradient-to-r from-slate-900 via-slate-900 to-emerald-900/50 text-white py-12 mt-16 border-t-4 border-emerald-500/30">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12 items-center">
            <!-- Logo & Brand Center -->
            <div class="flex flex-col items-center md:items-start text-center md:text-left">
                <div class="mb-4 p-3 bg-white/10 backdrop-blur-sm rounded-2xl border border-white/20">
                    <img src="{{ asset('assets/logohima-.png') }}" 
                         alt="HIMANIKKA - Himpunan Mahasiswa Teknik Informatika" 
                         class="h-16 w-auto mx-auto drop-shadow-2xl">
                </div>
                <div class="space-y-1">
                    <h3 class="text-2xl md:text-3xl font-black bg-gradient-to-r from-emerald-400 via-blue-400 to-emerald-500 bg-clip-text text-transparent drop-shadow-lg">
                        HIMANIKKA
                    </h3>
                    <p class="text-sm md:text-base text-emerald-200/80 font-medium tracking-wide">
                        Himpunan Mahasiswa Teknik Informatika
                    </p>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="grid grid-cols-2 gap-6 md:gap-8 text-sm">
                <div>
                    <h4 class="font-bold text-emerald-300 mb-3 tracking-wide">📚 Akademik</h4>
                    <ul class="space-y-1">
                        <li><a href="{{ route('user.dashboard.index') }}" class="hover:text-emerald-300 transition-colors text-gray-300 hover:underline">Dashboard</a></li>
                        <li><a href="{{ route('user.kegiatan.index') }}" class="hover:text-emerald-300 transition-colors text-gray-300 hover:underline">Kegiatan</a></li>
                        <li><a href="{{ route('user.acara.index') }}" class="hover:text-emerald-300 transition-colors text-gray-300 hover:underline">Acara</a></li>
                    </ul>
                </div>
               
            </div>

            <!-- Contact & Social -->
            <div class="text-center md:text-right space-y-4">
                <div>
                    <h4 class="font-bold text-emerald-300 mb-3 text-base tracking-wide">📞 Kontak</h4>
                    <div class="space-y-1 text-xs md:text-sm text-gray-300">
                        <p>WhatsApp: <a href="https://wa.me/6281234567890" class="hover:text-emerald-300 font-semibold">0812-3456-7890</a></p>
                        <p>Email: <a href="mailto:himanikka@ti.unri.ac.id" class="hover:text-emerald-300 font-semibold">himanikka@ti.unri.ac.id</a></p>
                    </div>
                </div>
                <div class="flex justify-center md:justify-end gap-3 pt-2">
                    <a href="#" class="w-10 h-10 bg-white/10 hover:bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center transition-all duration-200 hover:scale-110 border border-white/20">
                        <svg fill="currentColor" class="w-5 h-5 text-emerald-300" viewBox="0 0 24 24">
                            <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                        </svg>
                    </a>
                    <a href="#" class="w-10 h-10 bg-white/10 hover:bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center transition-all duration-200 hover:scale-110 border border-white/20">
                        <svg fill="currentColor" class="w-5 h-5 text-emerald-300" viewBox="0 0 24 24">
                            <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                        </svg>
                    </a>
                    <a href="#" class="w-10 h-10 bg-white/10 hover:bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center transition-all duration-200 hover:scale-110 border border-white/20">
                        <svg fill="currentColor" class="w-5 h-5 text-emerald-300" viewBox="0 0 24 24">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Copyright Bar -->
        <div class="border-t border-white/10 pt-8 mt-12">
            <div class="text-center">
                <p class="text-xs md:text-sm text-gray-400 font-medium tracking-wide">
                    © {{ date('Y') }} HIMANIKKA - Himpunan Mahasiswa Teknik Informatika Universitas Riau. 
                    All rights reserved.
                </p>
            </div>
        </div>
    </div>
</footer>
