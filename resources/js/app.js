import Alpine from 'alpinejs'


// 🌓 DARK MODE STORE - FIXED & ENHANCED
Alpine.store('darkMode', {
    on: false,
    
    init() {
        const saved = localStorage.getItem('theme')
        const systemDark = window.matchMedia('(prefers-color-scheme: dark)').matches
        this.on = saved === 'dark' || (!saved && systemDark)
        this.updateTheme()
        
        // Listen system changes
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
            if (!localStorage.getItem('theme')) {
                this.on = e.matches
                this.updateTheme()
            }
        })
    },
    
    toggle() {
        this.on = !this.on
        this.updateTheme()
    },
    
    updateTheme() {
        const html = document.documentElement
        if (this.on) {
            html.classList.add('dark')
            localStorage.setItem('theme', 'dark')
            document.body.style.setProperty('--scrollbar-thumb', 'rgba(148, 163, 184, 0.9)')
        } else {
            html.classList.remove('dark')
            localStorage.setItem('theme', 'light')
            document.body.style.setProperty('--scrollbar-thumb', 'rgba(148, 163, 184, 0.6)')
        }
    }
})

// 📊 CHARTS STORE - BARU TERPISAH
Alpine.store('charts', {
    charts: {},
    
    init() {
        this.renderAllCharts()
    },
    
    renderUsersChart() {
        const container = document.getElementById('usersChart')
        if (!container) return
        
        container.innerHTML = `
            <svg viewBox="0 0 400 200" class="w-full h-full">
                <polyline points="50,160 120,130 190,90 260,110 330,60" 
                          fill="none" stroke="#10b981" stroke-width="3" 
                          stroke-linecap="round" stroke-linejoin="round"/>
                <circle cx="50" cy="160" r="5" fill="#10b981"/>
                <circle cx="120" cy="130" r="5" fill="#10b981"/>
                <circle cx="190" cy="90" r="5" fill="#10b981"/>
                <circle cx="260" cy="110" r="5" fill="#10b981"/>
                <circle cx="330" cy="60" r="5" fill="#10b981"/>
            </svg>
        `
    },
    
    renderMonthlyChart() {
        const container = document.getElementById('monthlyChart')
        if (!container) return
        
        // DATA DUMMY - AKAN DIGANTI DI BLADE
        const stats = { users: 25, events: 8, acaras: 12 }
        const monthYear = 'Feb 2026'
        
        const data = [
            { label: 'Anggota', value: stats.users, color: '#10b981' },
            { label: 'Kegiatan', value: stats.events, color: '#3b82f6' },
            { label: 'Acara', value: stats.acaras, color: '#8b5cf6' }
        ]
        
        container.innerHTML = `
            <div class="flex flex-col h-full">
                <div class="flex justify-between items-center mb-6 pb-4 border-b">
                    <h4 class="text-xl font-bold">${monthYear}</h4>
                    <div class="text-3xl font-black text-emerald-600">45</div>
                </div>
                
                <svg viewBox="0 0 600 250" class="w-full h-64">
                    <polyline points="60,190 210,160 360,120 510,140" 
                              fill="none" stroke="#10b981" stroke-width="4" stroke-linecap="round"/>
                    <circle cx="60" cy="190" r="8" fill="#10b981" stroke="white" stroke-width="3"/>
                    <circle cx="210" cy="160" r="8" fill="#10b981" stroke="white" stroke-width="3"/>
                    <circle cx="360" cy="120" r="8" fill="#10b981" stroke="white" stroke-width="3"/>
                    <circle cx="510" cy="140" r="8" fill="#10b981" stroke="white" stroke-width="3"/>
                </svg>
                
                <div class="flex gap-6 mt-6 pt-4 border-t">
                    <div class="flex items-center gap-2"><div class="w-3 h-3 rounded-full" style="background: #10b981"></div><span>Anggota: <strong>25</strong></span></div>
                    <div class="flex items-center gap-2"><div class="w-3 h-3 rounded-full" style="background: #3b82f6"></div><span>Kegiatan: <strong>8</strong></span></div>
                    <div class="flex items-center gap-2"><div class="w-3 h-3 rounded-full" style="background: #8b5cf6"></div><span>Acara: <strong>12</strong></span></div>
                </div>
            </div>
        `
    },
    
    renderAllCharts() {
        this.renderUsersChart()
        this.renderMonthlyChart()
    }
})


// 🌐 GLOBAL MODAL STORE - PRODUCTION READY
Alpine.store('modal', {
    isOpen: false,
    content: '',
    loading: false,
    
    open(content = '') {
        this.content = content
        this.isOpen = true
        this.loading = false
        document.body.classList.add('overflow-hidden')
    },
    
    close() {
        this.isOpen = false
        this.content = ''
        this.loading = false
        document.body.classList.remove('overflow-hidden')
    },
    
    async submit(url, formData) {
        this.loading = true
        
        try {
            const response = await fetch(url, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': window.Laravel?.csrfToken || document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            
            const data = await response.json()
            
            if (data.success) {
                this.close()
                window.location.reload()
            } else {
                alert(data.message || 'Gagal menyimpan!')
            }
        } catch (error) {
            console.error('Modal submit error:', error)
            alert('Terjadi kesalahan!')
        } finally {
            this.loading = false
        }
    }
})

// 🔍 FILTER & SEARCH STORE - OPTIMIZED
Alpine.store('filter', {
    search: '',
    jabatan: '',
    departemen: '',
    
    init() {
        this.search = ''
        this.jabatan = ''
        this.departemen = ''
    },
    
    clear() {
        this.search = ''
        this.jabatan = ''
        this.departemen = ''
    },
    
    matches(card) {
        if (!card) return false
        const nama = (card.dataset.nama || '').toLowerCase()
        const matchesSearch = !this.search || nama.includes(this.search.toLowerCase())
        const matchesJabatan = !this.jabatan || card.dataset.jabatan === this.jabatan
        const matchesDepartemen = !this.departemen || card.dataset.departemen === this.departemen
        return matchesSearch && matchesJabatan && matchesDepartemen
    }
})

// 📱 RESPONSIVE STORE
Alpine.store('responsive', {
    mobileOpen: false,
    isMobile() {
        return window.innerWidth < 1024
    },
    
    toggleMobileMenu() {
        this.mobileOpen = !this.mobileOpen
    }
})

// ⏰ CLOCK & TIME STORE
Alpine.store('clock', {
    time: new Date().toLocaleTimeString('id-ID', { 
        hour12: false, 
        hour: '2-digit', 
        minute: '2-digit', 
        second: '2-digit' 
    }),
    date: new Date().toLocaleDateString('id-ID', { 
        weekday: 'short', 
        day: 'numeric', 
        month: 'short', 
        year: 'numeric' 
    }),
    
    init() {
        setInterval(() => {
            this.time = new Date().toLocaleTimeString('id-ID', { 
                hour12: false, 
                hour: '2-digit', 
                minute: '2-digit', 
                second: '2-digit' 
            })
            this.date = new Date().toLocaleDateString('id-ID', { 
                weekday: 'short', 
                day: 'numeric', 
                month: 'short', 
                year: 'numeric' 
            })
        }, 1000)
    }
})

// 🎨 UI UTILS STORE
Alpine.store('ui', {
    confirmDelete(message = 'Yakin ingin menghapus?') {
        return confirm(message)
    },
    
    copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            // Visual feedback bisa ditambah
            console.log('Copied:', text)
        })
    },
    
    scrollToTop() {
        window.scrollTo({ top: 0, behavior: 'smooth' })
    }
})

// 🚀 COMPLETE INITIALIZATION
document.addEventListener('DOMContentLoaded', () => {
    window.Alpine = Alpine
    Alpine.start()
    
    // Global window objects
    window.Laravel = window.Laravel || {
        csrfToken: document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
    }
    
    // Fix scrollbar untuk dark mode
    const style = document.createElement('style')
    style.textContent = `
        :root {
            --scrollbar-thumb: rgba(148, 163, 184, 0.6);
        }
        .scrollbar-thin::-webkit-scrollbar-thumb {
            background: var(--scrollbar-thumb);
        }
    `
    document.head.appendChild(style)
})

// 🔧 ADVANCED ALPHINE MAGICS
document.addEventListener('alpine:init', () => {
    // Auto-focus pertama input di modal
    Alpine.directive('autofocus', (el) => {
        el.focus({ preventScroll: true })
    })
    
    // Debounce magic untuk search
    Alpine.magic('debounce', () => (callback, wait = 300) => {
        let timeout
        return function(...args) {
            clearTimeout(timeout)
            timeout = setTimeout(() => callback.apply(this, args), wait)
        }
    })
    
    // Smooth scroll magic
    Alpine.magic('scrolltop', () => () => {
        window.scrollTo({ top: 0, behavior: 'smooth' })
    })
    
    // Animate on scroll (ganti x-intersect)
    Alpine.directive('animate-scroll', (el) => {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fadeInUp')
                }
            })
        })
        observer.observe(el)
    })
    
    // Loading state untuk buttons
    Alpine.directive('loading', (el, { expression }, { Alpine }) => {
        const btn = Alpine.$data(el).loading ?? false
        if (btn) {
            el.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Loading...'
            el.disabled = true
        }
    })
})
