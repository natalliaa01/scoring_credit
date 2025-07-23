<!-- resources/views/aplikasi-kredit/show.blade.php -->

<x-app-layout>
    {{-- Header slot dihapus di app.blade.php, jadi tidak perlu di sini --}}

    <div class="py-12 bg-bpr-gray-light">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-2xl font-bold mb-6 text-bpr-blue-dark">{{ __('Detail Aplikasi Kredit') }} #{{ $aplikasiKredit->id }}</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    {{-- Informasi Umum Aplikasi --}}
                    <div class="p-4 bg-bpr-gray-light rounded-lg border border-bpr-gray-medium">
                        <h4 class="text-xl font-semibold text-bpr-blue-medium mb-3">{{ __('Informasi Umum') }}</h4>
                        <p class="text-sm text-bpr-text-dark mb-2"><strong>Tanggal Pengajuan:</strong> {{ $aplikasiKredit->tanggal_pengajuan->format('d M Y') }}</p>
                        <p class="text-sm text-bpr-text-dark mb-2"><strong>Pengaju:</strong> {{ $aplikasiKredit->pengaju->name }}</p>
                        <p class="text-sm text-bpr-text-dark"><strong>Status:</strong> <span class="font-semibold">{{ $aplikasiKredit->status_aplikasi }}</span></p>
                        @if($aplikasiKredit->direksiPenyetuju)
                            <p class="text-sm text-bpr-text-dark mt-2"><strong>Disetujui/Ditolak Oleh:</strong> {{ $aplikasiKredit->direksiPenyetuju->name }}</p>
                            <p class="text-sm text-bpr-text-dark"><strong>Tanggal Keputusan:</strong> {{ $aplikasiKredit->tanggal_persetujuan_direksi->format('d M Y H:i') }}</p>
                            @if($aplikasiKredit->catatan_direksi)
                                <p class="text-sm text-bpr-text-dark mt-2"><strong>Catatan Direksi:</strong> {{ $aplikasiKredit->catatan_direksi }}</p>
                            @endif
                        @endif
                        @if($aplikasiKredit->catatan_kepala_bagian)
                            <p class="text-sm text-bpr-text-dark mt-2"><strong>Catatan Kepala Bagian:</strong> {{ $aplikasiKredit->catatan_kepala_bagian }}</p>
                        @endif
                    </div>

                    {{-- Informasi Pemohon (UMKM atau Pegawai) --}}
                    @if($aplikasiKredit->dataUmkm)
                        <div class="p-4 bg-bpr-gray-light rounded-lg border border-bpr-gray-medium">
                            <h4 class="text-xl font-semibold text-bpr-blue-medium mb-3">{{ __('Data Pemohon UMKM / Pengusaha') }}</h4>
                            <p class="text-sm text-bpr-text-dark mb-2"><strong>Nama UMKM:</strong> {{ $aplikasiKredit->dataUmkm->nama_umkm }}</p>
                            <p class="text-sm text-bpr-text-dark mb-2"><strong>Omzet Usaha:</strong> Rp {{ number_format($aplikasiKredit->dataUmkm->omzet_usaha, 0, ',', '.') }}</p>
                            <p class="text-sm text-bpr-text-dark mb-2"><strong>Lama Usaha:</strong> {{ $aplikasiKredit->dataUmkm->lama_usaha_tahun }} Tahun</p>
                            <p class="text-sm text-bpr-text-dark mb-2"><strong>Sektor Ekonomi:</strong> {{ $aplikasiKredit->dataUmkm->sektorEkonomi->nama_sektor ?? '-' }} (Risiko: {{ $aplikasiKredit->dataUmkm->sektorEkonomi->tingkat_risiko ?? '-' }})</p>
                            <p class="text-sm text-bpr-text-dark mb-2"><strong>Lokasi Usaha:</strong> {{ $aplikasiKredit->dataUmkm->lokasi_usaha }}</p>
                            <p class="text-sm text-bpr-text-dark mb-2"><strong>Riwayat Pinjaman:</strong> {{ $aplikasiKredit->dataUmkm->riwayat_pinjaman }}</p>
                            <p class="text-sm text-bpr-text-dark mb-2"><strong>Penggunaan Kredit:</strong> {{ $aplikasiKredit->dataUmkm->jenis_penggunaan_kredit }}</p>
                            <p class="text-sm text-bpr-text-dark mb-2"><strong>Jenis Jaminan:</strong> {{ $aplikasiKredit->dataUmkm->jenis_jaminan }}</p>
                            <p class="text-sm text-bpr-text-dark mb-2"><strong>Sumber Dana Pengembalian:</strong> {{ $aplikasiKredit->dataUmkm->sumber_dana_pengembalian }}</p>
                            <p class="text-sm text-bpr-text-dark mb-2"><strong>Plafond Pengajuan:</strong> Rp {{ number_format($aplikasiKredit->dataUmkm->plafond_pengajuan, 0, ',', '.') }}</p>
                            <p class="text-sm text-bpr-text-dark"><strong>Jangka Waktu:</strong> {{ $aplikasiKredit->dataUmkm->jangka_waktu_kredit_bulan }} Bulan</p>
                        </div>
                    @elseif($aplikasiKredit->dataPegawai)
                        <div class="p-4 bg-bpr-gray-light rounded-lg border border-bpr-gray-medium">
                            <h4 class="text-xl font-semibold text-bpr-blue-medium mb-3">{{ __('Data Pemohon Pegawai') }}</h4>
                            <p class="text-sm text-bpr-text-dark mb-2"><strong>Nama Pegawai:</strong> {{ $aplikasiKredit->dataPegawai->nama_pegawai }}</p>
                            <p class="text-sm text-bpr-text-dark mb-2"><strong>Usia:</strong> {{ $aplikasiKredit->dataPegawai->usia }} Tahun</p>
                            <p class="text-sm text-bpr-text-dark mb-2"><strong>Masa Kerja:</strong> {{ $aplikasiKredit->dataPegawai->masa_kerja_tahun }} Tahun</p>
                            <p class="text-sm text-bpr-text-dark mb-2"><strong>Golongan/Jabatan:</strong> {{ $aplikasiKredit->dataPegawai->golonganJabatan->nama_golongan_jabatan ?? '-' }} (Penghasilan: {{ $aplikasiKredit->dataPegawai->golonganJabatan->kategori_penghasilan ?? '-' }})</p>
                            <p class="text-sm text-bpr-text-dark mb-2"><strong>Status Kepegawaian:</strong> {{ $aplikasiKredit->dataPegawai->status_kepegawaian }}</p>
                            <p class="text-sm text-bpr-text-dark mb-2"><strong>Gaji Bulanan:</strong> Rp {{ number_format($aplikasiKredit->dataPegawai->gaji_bulanan, 0, ',', '.') }}</p>
                            <p class="text-sm text-bpr-text-dark mb-2"><strong>Jumlah Tanggungan:</strong> {{ $aplikasiKredit->dataPegawai->jumlah_tanggungan }}</p>
                            <p class="text-sm text-bpr-text-dark"><strong>Riwayat Kredit Sebelumnya:</strong> {{ $aplikasiKredit->dataPegawai->riwayat_kredit_sebelumnya }}</p>
                        </div>
                    @else
                        <div class="p-4 bg-red-100 text-red-700 rounded-lg border border-red-400">
                            <p>Data pemohon tidak ditemukan.</p>
                        </div>
                    @endif
                </div>

                {{-- Bagian Hasil Scoring dan Aksi (Hanya untuk Admin, Direksi, Kepala Bagian) --}}
                @can('viewScoring', $aplikasiKredit)
                <div class="mt-8 p-4 bg-bpr-gray-light rounded-lg border border-bpr-gray-medium">
                    <h4 class="text-xl font-semibold text-bpr-blue-medium mb-3">{{ __('Hasil Scoring & Keputusan') }}</h4>
                    <p class="text-sm text-bpr-text-dark mb-2"><strong>Skor Kredit:</strong> <span class="font-bold text-bpr-gold-accent text-lg">{{ $aplikasiKredit->skor_kredit ?? 'Belum Diproses' }}</span></p>
                    <p class="text-sm text-bpr-text-dark mb-4"><strong>Rekomendasi Sistem:</strong> <span class="font-bold text-bpr-gold-accent text-lg">{{ $aplikasiKredit->rekomendasi_sistem ?? 'Belum Diproses' }}</span></p>

                    {{-- Tombol Aksi Berdasarkan Status dan Role --}}
                    <div class="mt-4 flex flex-wrap gap-4">
                        @if ($aplikasiKredit->status_aplikasi === 'Diajukan' && Auth::user()->role === 'kepala_bagian')
                            <form action="{{ route('aplikasi-kredit.forward-to-direksi', $aplikasiKredit) }}" method="POST">
                                @csrf
                                <x-primary-button class="bg-bpr-blue-dark hover:bg-bpr-blue-medium">
                                    {{ __('Teruskan ke Direksi') }}
                                </x-primary-button>
                                {{-- Input untuk catatan kepala bagian --}}
                                <x-text-input type="text" name="catatan_kabag" placeholder="Catatan Kepala Bagian (opsional)" class="mt-2" />
                            </form>
                        @endif

                        @if ($aplikasiKredit->status_aplikasi === 'Menunggu Persetujuan Direksi' && in_array(Auth::user()->role, ['direksi', 'admin']))
                            <form action="{{ route('aplikasi-kredit.approve', $aplikasiKredit) }}" method="POST">
                                @csrf
                                <x-primary-button class="bg-green-600 hover:bg-green-700">
                                    {{ __('Setujui Kredit') }}
                                </x-primary-button>
                                {{-- Input untuk catatan direksi --}}
                                <x-text-input type="text" name="catatan_direksi" placeholder="Catatan Direksi (opsional)" class="mt-2" />
                            </form>

                            <form action="{{ route('aplikasi-kredit.reject', $aplikasiKredit) }}" method="POST">
                                @csrf
                                <x-danger-button class="bg-red-600 hover:bg-red-700">
                                    {{ __('Tolak Kredit') }}
                                </x-danger-button>
                                {{-- Input untuk catatan direksi --}}
                                <x-text-input type="text" name="catatan_direksi" placeholder="Catatan Direksi (opsional)" class="mt-2" />
                            </form>
                        @endif

                        {{-- Tombol Edit (hanya untuk Kepala Bagian/Admin) --}}
                        @can('update', $aplikasiKredit)
                            <a href="{{ route('aplikasi-kredit.edit', $aplikasiKredit) }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-bpr-text-dark uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                                {{ __('Edit Aplikasi') }}
                            </a>
                        @endcan

                        {{-- Tombol Delete (hanya untuk Admin) --}}
                        @can('delete', $aplikasiKredit)
                            <form action="{{ route('aplikasi-kredit.destroy', $aplikasiKredit) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus aplikasi ini?');">
                                @csrf
                                @method('DELETE')
                                <x-danger-button>
                                    {{ __('Hapus Aplikasi') }}
                                </x-danger-button>
                            </form>
                        @endcan
                    </div>
                </div>
                @endcan

                <div class="mt-8 text-center">
                    <a href="{{ route('aplikasi-kredit.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-bpr-text-dark uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                        {{ __('Kembali ke Daftar Kredit') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
