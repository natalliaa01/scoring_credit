<x-app-layout>
    <x-slot name="header">
        {{-- Tidak perlu header di sini karena sudah dihapus global di app.blade.php --}}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-2xl font-bold mb-6 text-bpr-blue-dark">{{ __('Ajukan Aplikasi Kredit Baru') }}</h3>

                <form method="POST" action="{{ route('aplikasi-kredit.store') }}" x-data="{ jenisPemohon: 'umkm' }">
                    @csrf

                    <div class="mb-4">
                        <x-input-label for="tanggal_pengajuan" :value="__('Tanggal Pengajuan')" />
                        <x-text-input id="tanggal_pengajuan" class="block mt-1 w-full" type="date" name="tanggal_pengajuan" :value="old('tanggal_pengajuan', date('Y-m-d'))" required autofocus />
                        <x-input-error :messages="$errors->get('tanggal_pengajuan')" class="mt-2" />
                    </div>

                    <div class="mb-6">
                        <x-input-label :value="__('Jenis Pemohon')" />
                        <div class="mt-2 space-y-2">
                            <label for="jenis_pemohon_umkm" class="inline-flex items-center">
                                <input id="jenis_pemohon_umkm" type="radio" class="rounded border-gray-300 text-bpr-blue-dark shadow-sm focus:ring-bpr-blue-dark" name="jenis_pemohon" value="umkm" x-model="jenisPemohon" checked>
                                <span class="ms-2 text-sm text-gray-600">{{ __('UMKM / Pengusaha') }}</span>
                            </label>
                            <label for="jenis_pemohon_pegawai" class="inline-flex items-center ms-4">
                                <input id="jenis_pemohon_pegawai" type="radio" class="rounded border-gray-300 text-bpr-blue-dark shadow-sm focus:ring-bpr-blue-dark" name="jenis_pemohon" value="pegawai" x-model="jenisPemohon">
                                <span class="ms-2 text-sm text-gray-600">{{ __('Pegawai') }}</span>
                            </label>
                        </div>
                        <x-input-error :messages="$errors->get('jenis_pemohon')" class="mt-2" />
                    </div>

                    <div x-show="jenisPemohon === 'umkm'" class="bg-bpr-gray-light p-6 rounded-lg shadow-inner mb-6">
                        <h4 class="text-xl font-bold mb-4 text-bpr-blue-medium">{{ __('Data UMKM / Pengusaha') }}</h4>

                        <div class="mb-4">
                            <x-input-label for="nama_umkm" :value="__('Nama UMKM / Pengusaha')" />
                            <x-text-input id="nama_umkm" class="block mt-1 w-full" type="text" name="nama_umkm" :value="old('nama_umkm')" />
                            <x-input-error :messages="$errors->get('nama_umkm')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="omzet_usaha" :value="__('Omzet Usaha (Per Bulan)')" />
                            <x-text-input id="omzet_usaha" class="block mt-1 w-full" type="number" name="omzet_usaha" :value="old('omzet_usaha')" min="0" />
                            <x-input-error :messages="$errors->get('omzet_usaha')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="lama_usaha_tahun" :value="__('Lama Usaha (Tahun)')" />
                            <x-text-input id="lama_usaha_tahun" class="block mt-1 w-full" type="number" name="lama_usaha_tahun" :value="old('lama_usaha_tahun')" min="0" />
                            <x-input-error :messages="$errors->get('lama_usaha_tahun')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="sektor_ekonomi_id" :value="__('Sektor Ekonomi')" />
                            <select id="sektor_ekonomi_id" name="sektor_ekonomi_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-bpr-text-dark">
                                <option value="">Pilih Sektor Ekonomi</option>
                                @foreach($kategoriSektorEkonomi as $sektor)
                                    <option value="{{ $sektor->id }}" {{ old('sektor_ekonomi_id') == $sektor->id ? 'selected' : '' }}>
                                        {{ $sektor->nama_sektor }} (Risiko: {{ $sektor->tingkat_risiko }})
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('sektor_ekonomi_id')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="lokasi_usaha" :value="__('Lokasi Usaha')" />
                            <x-text-input id="lokasi_usaha" class="block mt-1 w-full" type="text" name="lokasi_usaha" :value="old('lokasi_usaha')" />
                            <x-input-error :messages="$errors->get('lokasi_usaha')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="riwayat_pinjaman_umkm" :value="__('Riwayat Pinjaman UMKM')" />
                            <select id="riwayat_pinjaman_umkm" name="riwayat_pinjaman_umkm" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-bpr-text-dark">
                                <option value="">Pilih Riwayat</option>
                                <option value="Tidak Pernah" {{ old('riwayat_pinjaman_umkm') == 'Tidak Pernah' ? 'selected' : '' }}>Tidak Pernah</option>
                                <option value="Pernah Menunggak" {{ old('riwayat_pinjaman_umkm') == 'Pernah Menunggak' ? 'selected' : '' }}>Pernah Menunggak</option>
                                <option value="Pernah Macet" {{ old('riwayat_pinjaman_umkm') == 'Pernah Macet' ? 'selected' : '' }}>Pernah Macet</option>
                            </select>
                            <x-input-error :messages="$errors->get('riwayat_pinjaman_umkm')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="jenis_penggunaan_kredit" :value="__('Jenis Penggunaan Kredit')" />
                            <select id="jenis_penggunaan_kredit" name="jenis_penggunaan_kredit" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-bpr-text-dark">
                                <option value="">Pilih Penggunaan</option>
                                <option value="Modal Kerja" {{ old('jenis_penggunaan_kredit') == 'Modal Kerja' ? 'selected' : '' }}>Modal Kerja</option>
                                <option value="Investasi" {{ old('jenis_penggunaan_kredit') == 'Investasi' ? 'selected' : '' }}>Investasi</option>
                            </select>
                            <x-input-error :messages="$errors->get('jenis_penggunaan_kredit')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="jenis_jaminan" :value="__('Jenis Jaminan')" />
                            <select id="jenis_jaminan" name="jenis_jaminan" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-bpr-text-dark">
                                <option value="">Pilih Jaminan</option>
                                <option value="Tanah/Bangunan" {{ old('jenis_jaminan') == 'Tanah/Bangunan' ? 'selected' : '' }}>Tanah/Bangunan</option>
                                <option value="Barang Bergerak" {{ old('jenis_jaminan') == 'Barang Bergerak' ? 'selected' : '' }}>Barang Bergerak</option>
                                <option value="Lainnya" {{ old('jenis_jaminan') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            <x-input-error :messages="$errors->get('jenis_jaminan')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="sumber_dana_pengembalian" :value="__('Sumber Dana Pengembalian')" />
                            <select id="sumber_dana_pengembalian" name="sumber_dana_pengembalian" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-bpr-text-dark">
                                <option value="">Pilih Sumber Dana</option>
                                <option value="Dari Usaha Sendiri" {{ old('sumber_dana_pengembalian') == 'Dari Usaha Sendiri' ? 'selected' : '' }}>Dari Usaha Sendiri</option>
                                <option value="Hibah/Pinjaman Lain" {{ old('sumber_dana_pengembalian') == 'Hibah/Pinjaman Lain' ? 'selected' : '' }}>Hibah/Pinjaman Lain</option>
                            </select>
                            <x-input-error :messages="$errors->get('sumber_dana_pengembalian')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="plafond_pengajuan" :value="__('Plafond Pengajuan')" />
                            <x-text-input id="plafond_pengajuan" class="block mt-1 w-full" type="number" name="plafond_pengajuan" :value="old('plafond_pengajuan')" min="0" />
                            <x-input-error :messages="$errors->get('plafond_pengajuan')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="jangka_waktu_kredit_bulan" :value="__('Jangka Waktu Kredit (Bulan)')" />
                            <x-text-input id="jangka_waktu_kredit_bulan" class="block mt-1 w-full" type="number" name="jangka_waktu_kredit_bulan" :value="old('jangka_waktu_kredit_bulan')" min="1" />
                            <x-input-error :messages="$errors->get('jangka_waktu_kredit_bulan')" class="mt-2" />
                        </div>
                    </div>

                    <div x-show="jenisPemohon === 'pegawai'" class="bg-bpr-gray-light p-6 rounded-lg shadow-inner mb-6">
                        <h4 class="text-xl font-bold mb-4 text-bpr-blue-medium">{{ __('Data Pegawai') }}</h4>

                        <div class="mb-4">
                            <x-input-label for="nama_pegawai" :value="__('Nama Pegawai')" />
                            <x-text-input id="nama_pegawai" class="block mt-1 w-full" type="text" name="nama_pegawai" :value="old('nama_pegawai')" />
                            <x-input-error :messages="$errors->get('nama_pegawai')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="usia" :value="__('Usia (Tahun)')" />
                            <x-text-input id="usia" class="block mt-1 w-full" type="number" name="usia" :value="old('usia')" min="18" max="65" />
                            <x-input-error :messages="$errors->get('usia')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="masa_kerja_tahun" :value="__('Masa Kerja (Tahun)')" />
                            <x-text-input id="masa_kerja_tahun" class="block mt-1 w-full" type="number" name="masa_kerja_tahun" :value="old('masa_kerja_tahun')" min="0" />
                            <x-input-error :messages="$errors->get('masa_kerja_tahun')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="golongan_jabatan_id" :value="__('Golongan / Jabatan')" />
                            <select id="golongan_jabatan_id" name="golongan_jabatan_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-bpr-text-dark">
                                <option value="">Pilih Golongan / Jabatan</option>
                                @foreach($kategoriGolonganJabatan as $golongan)
                                    <option value="{{ $golongan->id }}" {{ old('golongan_jabatan_id') == $golongan->id ? 'selected' : '' }}>
                                        {{ $golongan->nama_golongan_jabatan }} (Penghasilan: {{ $golongan->kategori_penghasilan }})
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('golongan_jabatan_id')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="status_kepegawaian" :value="__('Status Kepegawaian')" />
                            <select id="status_kepegawaian" name="status_kepegawaian" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-bpr-text-dark">
                                <option value="">Pilih Status</option>
                                <option value="Tetap" {{ old('status_kepegawaian') == 'Tetap' ? 'selected' : '' }}>Tetap</option>
                                <option value="Kontrak" {{ old('status_kepegawaian') == 'Kontrak' ? 'selected' : '' }}>Kontrak</option>
                            </select>
                            <x-input-error :messages="$errors->get('status_kepegawaian')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="gaji_bulanan" :value="__('Gaji Bulanan')" />
                            <x-text-input id="gaji_bulanan" class="block mt-1 w-full" type="number" name="gaji_bulanan" :value="old('gaji_bulanan')" min="0" />
                            <x-input-error :messages="$errors->get('gaji_bulanan')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="jumlah_tanggungan" :value="__('Jumlah Tanggungan')" />
                            <x-text-input id="jumlah_tanggungan" class="block mt-1 w-full" type="number" name="jumlah_tanggungan" :value="old('jumlah_tanggungan')" min="0" />
                            <x-input-error :messages="$errors->get('jumlah_tanggungan')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="riwayat_kredit_sebelumnya_pegawai" :value="__('Riwayat Kredit Sebelumnya (Pegawai)')" />
                            <select id="riwayat_kredit_sebelumnya_pegawai" name="riwayat_kredit_sebelumnya_pegawai" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-bpr-text-dark">
                                <option value="">Pilih Riwayat</option>
                                <option value="Tidak Pernah" {{ old('riwayat_kredit_sebelumnya_pegawai') == 'Tidak Pernah' ? 'selected' : '' }}>Tidak Pernah</option>
                                <option value="Pernah Macet" {{ old('riwayat_kredit_sebelumnya_pegawai') == 'Pernah Macet' ? 'selected' : '' }}>Pernah Macet</option>
                                <option value="Lain-lain" {{ old('riwayat_kredit_sebelumnya_pegawai') == 'Lain-lain' ? 'selected' : '' }}>Lain-lain</option>
                            </select>
                            <x-input-error :messages="$errors->get('riwayat_kredit_sebelumnya_pegawai')" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="ms-4">
                            {{ __('Ajukan Aplikasi') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>