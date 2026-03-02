/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  darkMode: ['class'], 
  theme: {
    extend: {
      fontFamily: {
        'inter': ['Inter', 'sans-serif'],
      },
      colors: {
        primary: {
          50: '#eff6ff',
          500: '#3b82f6',
          900: '#1e3a8a',
        },
        // Custom dark mode colors
      }
    },
  },
  plugins: [
    require('daisyui')
  ],
  daisyui: {
    themes: false, // ✅ No theme conflicts
    base: true,
    utils: true,
    logs: false,
  },
}
