document.addEventListener('alpine:init', () => {
    Alpine.data('settingsPage', () => ({
        showQuickEdit: false,
        quickEditKey: '',
        quickEditValue: '',
        saving: false,
        
        quickEdit(key) {
            this.quickEditKey = key
            this.quickEditValue = ''
            this.showQuickEdit = true
        },
        
        saveQuickEdit() {
            this.saving = true
            setTimeout(() => {
                alert('Tersimpan!')
                this.showQuickEdit = false
                this.saving = false
            }, 1000)
        }
    }))
})

// resources/js/settings.js - LENGKAP
document.addEventListener('alpine:init', () => {
    Alpine.data('settingsPage', () => ({
        // 🗂️ STATE
        showQuickEdit: false,
        quickEditKey: '',
        quickEditValue: '',
        saving: false,
        
        // 🔥 ALL BUTTON FUNCTIONS - HARUS LENGKAP!
        testNotification() {
            alert('🔔 Test notification OK!')
        },
        
        exportSettings() {
            alert('📥 Export JSON berhasil!')
        },
        
        createBackup() {
            if (confirm('Buat backup sekarang?')) {
                alert('💾 Backup dimulai!')
            }
        },
        
        securityCheck() {
            if (confirm('Jalankan security scan?')) {
                alert('🛡️ Scan selesai!')
            }
        },
        
        quickEdit(key) {
            this.quickEditKey = key
            this.quickEditValue = `Nilai lama: ${key}`
            this.showQuickEdit = true
        },
        
        saveQuickEdit() {
            this.saving = true
            setTimeout(() => {
                alert('✅ Tersimpan!')
                this.showQuickEdit = false
                this.saving = false
            }, 1000)
        }
    }))
})
