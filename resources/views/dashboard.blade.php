<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-bpr-text-dark">
                    {{-- Ini adalah area untuk konten dashboard Anda. Tidak ada {{ $slot }} di sini. --}}
                    <h3 class="text-2xl font-bold mb-4 text-bpr-blue-dark">Selamat Datang, {{ Auth::user()->name }}!</h3>
                    <p class="text-lg text-gray-700">Anda berhasil login sebagai {{ Auth::user()->role === 'admin' ? 'Administrator' : (Auth::user()->role === 'direksi' ? 'Direksi' : (Auth::user()->role === 'kepala_bagian' ? 'Kepala Bagian Kredit' : 'Teller')) }} BPR MSA.</p>

                    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        {{-- Contoh Card Informasi (bisa disesuaikan nanti) --}}
                        <div class="bg-bpr-gray-light p-6 rounded-lg shadow-md">
                            <h4 class="text-xl font-semibold text-bpr-blue-medium mb-2">Total Aplikasi Diajukan</h4>
                            <p class="text-3xl font-bold text-bpr-red-accent">0</p> {{-- Akan diganti dengan data dinamis nanti --}}
                            <p class="text-sm text-gray-500 mt-2">Update terakhir: Hari ini</p>
                        </div>
                        <div class="bg-bpr-gray-light p-6 rounded-lg shadow-md">
                            <h4 class="text-xl font-semibold text-bpr-blue-medium mb-2">Aplikasi Menunggu Persetujuan</h4>
                            <p class="text-3xl font-bold text-bpr-red-accent">0</p>
                            <p class="text-sm text-gray-500 mt-2">Untuk Direksi/Kepala Bagian</p>
                        </div>
                        <div class="bg-bpr-gray-light p-6 rounded-lg shadow-md">
                            <h4 class="text-xl font-semibold text-bpr-blue-medium mb-2">Aplikasi Disetujui Bulan Ini</h4>
                            <p class="text-3xl font-bold text-bpr-red-accent">0</p>
                            <p class="text-sm text-gray-500 mt-2">Data bulan berjalan</p>
                        </div>
                    </div>

                    <div class="mt-10 p-4 bg-bpr-blue-medium text-white rounded-lg shadow-md text-center">
                        <p class="text-lg">Untuk memulai, Anda bisa <a href="{{ route('aplikasi-kredit.create') }}" class="font-bold underline hover:text-bpr-red-accent">mengajukan aplikasi kredit baru</a> atau <a href="{{ route('aplikasi-kredit.index') }}" class="font-bold underline hover:text-bpr-red-accent">melihat daftar aplikasi kredit</a>.</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>