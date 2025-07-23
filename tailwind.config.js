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
                'bpr-blue-dark': '#1D2A8E', // Biru tua dari logo
                'bpr-blue-medium': '#2A3B9B', // Biru sedang dari logo
                'bpr-gold-accent': '#C0A04C', // Aksen Emas/Bronze yang lebih elegan
                'bpr-gray-light': '#F8F8F8', // Abu-abu sangat terang untuk background section
                'bpr-gray-medium': '#E0E0E0', // Abu-abu untuk border/divider
                'bpr-text-dark': '#333333', // Warna teks umum
                'bpr-text-light': '#6B7280', // Warna teks sekunder/deskripsi
                'bpr-background-light': '#e3f2fd', // Warna latar belakang baru yang diminta
            },
            fontFamily: {
                'sans': ['Poppins', 'sans-serif'], // Menggunakan Poppins sebagai font utama
                'heading': ['Poppins', 'sans-serif'], // Menggunakan Poppins juga untuk judul
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
