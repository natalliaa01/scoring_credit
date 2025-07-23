<!-- resources/views/dashboard.blade.php -->

<x-app-layout>
    {{-- Header slot dihapus di app.blade.php, jadi tidak perlu di sini --}}

    <div class="py-12 bg-bpr-gray-light"> {{-- Background abu-abu terang untuk section utama --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-bpr-text-dark">
                    <h3 class="text-3xl font-extrabold mb-6 text-bpr-blue-dark text-center">Selamat Datang, {{ Auth::user()->name }}</h3>

                    {{-- Bagian Informasi Cepat (Cards) --}}
                    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        {{-- Card Informasi: Total Kredit Diajukan --}}
                        <div class="bg-white p-6 rounded-lg shadow-md flex flex-col justify-between border border-bpr-gray-medium">
                            <div>
                                <h4 class="text-xl font-semibold text-bpr-blue-medium mb-2">Total Kredit Diajukan</h4>
                                <p class="text-5xl font-extrabold text-bpr-gold-accent">0</p> {{-- Akan diganti dengan data dinamis nanti --}}
                            </div>
                            <p class="text-sm text-bpr-text-light mt-4">Update terakhir: Hari ini</p>
                        </div>

                        {{-- Card Informasi: Kredit Menunggu Persetujuan (Hanya untuk Kabag/Direksi/Admin) --}}
                        @if(in_array(Auth::user()->role, ['direksi', 'kepala_bagian', 'admin']))
                        <div class="bg-white p-6 rounded-lg shadow-md flex flex-col justify-between border border-bpr-gray-medium">
                            <div>
                                <h4 class="text-xl font-semibold text-bpr-blue-medium mb-2">Kredit Menunggu Persetujuan</h4>
                                <p class="text-5xl font-extrabold text-bpr-gold-accent">0</p>
                            </div>
                            <p class="text-sm text-bpr-text-light mt-4">Untuk Direksi/Kepala Bagian</p>
                        </div>
                        @endif

                        {{-- Card Informasi: Kredit Disetujui Bulan Ini --}}
                        <div class="bg-white p-6 rounded-lg shadow-md flex flex-col justify-between border border-bpr-gray-medium">
                            <div>
                                <h4 class="text-xl font-semibold text-bpr-blue-medium mb-2">Kredit Disetujui Bulan Ini</h4>
                                <p class="text-5xl font-extrabold text-bpr-gold-accent">0</p>
                            </div>
                            <p class="text-sm text-bpr-text-light mt-4">Data bulan berjalan</p>
                        </div>

                        {{-- Card Informasi: Kredit Ditolak Bulan Ini (Dipindahkan ke sini) --}}
                        <div class="bg-white p-6 rounded-lg shadow-md flex flex-col justify-between border border-bpr-gray-medium">
                            <div>
                                <h4 class="text-xl font-semibold text-bpr-blue-medium mb-2">Kredit Ditolak Bulan Ini</h4>
                                <p class="text-4xl font-extrabold text-bpr-gold-accent">0</p>
                            </div>
                            <p class="text-sm text-bpr-text-light mt-4">Data bulan berjalan</p>
                        </div>

                        {{-- Card Informasi: Kredit Aktif (Ongoing) --}}
                        <div class="bg-white p-6 rounded-lg shadow-md flex flex-col justify-between border border-bpr-gray-medium">
                            <div>
                                <h4 class="text-xl font-semibold text-bpr-blue-medium mb-2">Kredit Aktif (Sedang Berjalan)</h4>
                                <p class="text-5xl font-extrabold text-bpr-gold-accent">0</p> {{-- Dummy value, akan diganti data dinamis --}}
                            </div>
                            <p class="text-sm text-bpr-text-light mt-4">Total pinjaman yang sedang berjalan</p>
                        </div>

                        {{-- Card Informasi: Kredit Lunas --}}
                        <div class="bg-white p-6 rounded-lg shadow-md flex flex-col justify-between border border-bpr-gray-medium">
                            <div>
                                <h4 class="text-xl font-semibold text-bpr-blue-medium mb-2">Kredit Lunas</h4>
                                <p class="text-5xl font-extrabold text-bpr-gold-accent">0</p> {{-- Dummy value, akan diganti data dinamis --}}
                            </div>
                            <p class="text-sm text-bpr-text-light mt-4">Total pinjaman yang telah selesai</p>
                        </div>
                    </div>

                    {{-- Bagian Aksi Utama (Tombol) - Diperbarui agar lebih elegan dan sederhana --}}
                    <div class="mt-12 p-8 bg-white rounded-lg shadow-lg text-center border border-bpr-gray-medium">
                        <p class="text-2xl font-bold mb-6 text-bpr-blue-dark">Siap untuk memulai?</p>
                        <div class="flex flex-col sm:flex-row justify-center items-center gap-6">
                            <a href="{{ route('aplikasi-kredit.create') }}" class="w-full sm:w-auto px-8 py-4 bg-bpr-blue-dark border border-transparent rounded-lg font-bold text-lg text-white uppercase tracking-wider hover:bg-bpr-blue-medium focus:bg-bpr-blue-medium active:bg-bpr-blue-dark focus:outline-none focus:ring-2 focus:ring-bpr-blue-dark focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                                {{ __('Ajukan Kredit Baru') }}
                            </a>
                            <a href="{{ route('aplikasi-kredit.index') }}" class="w-full sm:w-auto px-8 py-4 bg-white text-bpr-blue-dark border border-bpr-blue-dark rounded-lg font-bold text-lg uppercase tracking-wider hover:bg-bpr-gray-light focus:bg-bpr-gray-light active:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-bpr-blue-dark focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                                {{ __('Lihat Semua Kredit') }}
                            </a>
                        </div>
                    </div>

                    {{-- Bagian Quick Links / Panduan Cepat --}}
                    <div class="mt-12 p-6 bg-white rounded-lg shadow-md border border-bpr-gray-medium">
                        <h4 class="text-2xl font-bold mb-4 text-bpr-blue-dark">{{ __('Panduan Cepat') }}</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-bpr-text-dark">
                            <ul class="list-disc list-inside space-y-2">
                                <li>Pastikan semua data pemohon lengkap dan akurat.</li>
                                <li>Gunakan tombol "Ajukan Kredit Baru" untuk memulai proses.</li>
                                <li>Periksa status kredit secara berkala di "Lihat Semua Kredit".</li>
                            </ul>
                            <ul class="list-disc list-inside space-y-2">
                                <li>Hubungi Kepala Bagian Kredit jika ada pertanyaan atau kendala.</li>
                                <li>Pastikan koneksi internet stabil saat mengajukan kredit.</li>
                                <li>Data Anda aman dan terenkripsi di sistem kami.</li>
                            </ul>
                        </div>
                    </div>

                    {{-- Bagian Berita / Pengumuman (Contoh Scrollable) --}}
                    <div class="mt-12 p-6 bg-white rounded-lg shadow-md border border-bpr-gray-medium">
                        <h4 class="text-2xl font-bold mb-4 text-bpr-blue-dark">{{ __('Berita & Pengumuman Terbaru') }}</h4>
                        <div class="max-h-64 overflow-y-auto space-y-4 pr-4"> {{-- max-h-64 dan overflow-y-auto untuk scroll --}}
                            <div class="border-b border-bpr-gray-medium pb-3">
                                <p class="font-semibold text-bpr-blue-medium">Pembaruan Kebijakan Kredit UMKM (14 Juli 2025)</p>
                                <p class="text-sm text-bpr-text-light">Telah dilakukan pembaruan pada kebijakan penilaian kredit untuk sektor UMKM. Mohon pelajari dokumen terbaru.</p>
                            </div>
                            <div class="border-b border-bpr-gray-medium pb-3">
                                <p class="font-semibold text-bpr-blue-medium">Pelatihan Sistem Baru untuk Teller (20 Juli 2025)</p>
                                <p class="text-sm text-bpr-text-light">Akan diadakan pelatihan penggunaan fitur baru pada sistem ini. Detail akan dikirimkan via email.</p>
                            </div>
                            <div class="border-b border-bpr-gray-medium pb-3">
                                <p class="font-semibold text-bpr-blue-medium">Libur Nasional Idul Adha (17 Juni 2025)</p>
                                <p class="text-sm text-bpr-text-light">Kantor akan tutup pada tanggal 17 Juni 2025 dalam rangka libur nasional Idul Adha.</p>
                            </div>
                            <div class="border-b border-bpr-gray-medium pb-3">
                                <p class="font-semibold text-bpr-blue-medium">Peningkatan Keamanan Sistem (1 Juli 2025)</p>
                                <p class="text-sm text-bpr-text-light">Telah dilakukan peningkatan keamanan pada sistem untuk menjaga kerahasiaan data nasabah.</p>
                            </div>
                            <div class="border-b border-bpr-gray-medium pb-3">
                                <p class="font-semibold text-bpr-blue-medium">Evaluasi Kinerja Triwulan II (10 Juli 2025)</p>
                                <p class="text-sm text-bpr-text-light">Hasil evaluasi kinerja triwulan II akan diumumkan minggu depan.</p>
                            </div>
                            <div class="border-b border-bpr-gray-medium pb-3">
                                <p class="font-semibold text-bpr-blue-medium">Sosialisasi Produk Baru (25 Juli 2025)</p>
                                <p class="text-sm text-bpr-text-light">Akan ada sosialisasi produk kredit baru untuk UMKM. Harap hadir.</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
