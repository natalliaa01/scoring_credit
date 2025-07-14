// tailwind.config.js
/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                'bpr-blue-dark': '#1D2A8E', // Contoh biru tua dari logo
                'bpr-blue-medium': '#2A3B9B', // Contoh biru sedang dari logo
                'bpr-red-accent': '#E31E24', // Contoh merah dari logo
                // Anda bisa tambahkan gradasi abu-abu jika perlu:
                'bpr-gray-light': '#F8F8F8',
                'bpr-gray-medium': '#E0E0E0',
                'bpr-text-dark': '#333333', // Warna teks umum
            },
            fontFamily: {
                // Di sini Anda bisa mendefinisikan font kustom
                // Contoh: 'sans': ['Inter', 'sans-serif'],
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};