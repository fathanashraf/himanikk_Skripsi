// 🪟 MODAL COMPONENT - KOSONG
document.addEventListener('alpine:init', () => {
    Alpine.data('modal', () => ({
        // 🗂️ STATE - KOSONG
        isOpen: false,
        title: '',
        content: '',
        
        // 🔘 METHODS - KOSONG
        open(title, content) {},
        close() {},
        confirm() {}
    }))
})
