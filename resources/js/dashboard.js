// 📊 DASHBOARD - KOSONG
document.addEventListener('alpine:init', () => {
    Alpine.data('dashboard', () => ({
        // 🗂️ STATE - KOSONG
        stats: {},
        chartData: [],
        filters: {
            date: 'today',
            status: 'all'
        },
        
        // 🔘 METHODS - KOSONG
        loadStats() {},
        refreshChart() {},
        applyFilter() {},
        exportData() {}
    }))
})
