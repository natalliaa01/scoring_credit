<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ajukan Aplikasi Kredit Baru') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 min-h-screen flex items-center justify-center">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 w-full">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8 transform transition-all duration-300 hover:shadow-2xl">
                <div class="text-center mb-8">
                    <h3 class="text-3xl font-bold text-indigo-700 mb-2">Formulir Pengajuan Kredit</h3>
                    <p class="text-gray-600">Isi data pemohon dengan lengkap dan akurat.</p>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                {{-- Pastikan x-data ada di sini dan Alpine.js dimuat dengan benar --}}
                <form method="POST" action="{{ route('aplikasi-kredit.store') }}" x-data="{ jenisPemohon: 'umkm', isSubmitting: false }" @submit.prevent="isSubmitting = true; $el.submit()">
                    @csrf

                    <!-- Jenis Pemohon -->
                    <div class="mb-6">
                        <x-input-label for="jenis_pemohon" :value="__('Jenis Pemohon')" class="text-lg font-medium text-gray-700" />
                        <div class="mt-2 flex space-x-4">
                            <label for="jenis_pemohon_umkm" class="inline-flex items-center cursor-pointer">
                                <input id="jenis_pemohon_umkm" type="radio" name="jenis_pemohon" value="umkm" x-model="jenisPemohon" class="form-radio text-indigo-600 focus:ring-indigo-500 rounded-full">
                                <span class="ml-2 text-gray-800">UMKM / Pengusaha</span>
                            </label>
                            <label for="jenis_pemohon_pegawai" class="inline-flex items-center cursor-pointer">
                                <input id="jenis_pemohon_pegawai" type="radio" name="jenis_pemohon" value="pegawai" x-model="jenisPemohon" class="form-radio text-indigo-600 focus:ring-indigo-500 rounded-full">
                                <span class="ml-2 text-gray-800">Pegawai</span>
                            </label>
                        </div>
                        <x-input-error class="mt-2" :messages="$errors->get('jenis_pemohon')" />
                    </div>

                    <!-- Bagian Data Umum Pemohon -->
                    <div class="bg-indigo-50 p-6 rounded-lg shadow-inner mb-8">
                        <h4 class="text-xl font-semibold text-indigo-800 mb-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2 text-indigo-600">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                            Data Umum Pemohon
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="nama_lengkap_pemohon" :value="__('Nama Lengkap Pemohon')" />
                                <x-text-input id="nama_lengkap_pemohon" class="block mt-1 w-full" type="text" name="nama_lengkap_pemohon" :value="old('nama_lengkap_pemohon')" required autofocus autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('nama_lengkap_pemohon')" />
                            </div>
                            <div>
                                <x-input-label for="no_ktp" :value="__('Nomor KTP')" />
                                <x-text-input id="no_ktp" class="block mt-1 w-full" type="text" name="no_ktp" :value="old('no_ktp')" required autocomplete="off" />
                                <x-input-error class="mt-2" :messages="$errors->get('no_ktp')" />
                            </div>
                            <div>
                                <x-input-label for="tanggal_pengajuan" :value="__('Tanggal Pengajuan')" />
                                <x-text-input id="tanggal_pengajuan" class="block mt-1 w-full" type="date" name="tanggal_pengajuan" :value="old('tanggal_pengajuan', date('Y-m-d'))" required />
                                <x-input-error class="mt-2" :messages="$errors->get('tanggal_pengajuan')" />
                            </div>
                            <div>
                                <x-input-label for="jenis_kelamin" :value="__('Jenis Kelamin')" />
                                <select id="jenis_kelamin" name="jenis_kelamin" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('jenis_kelamin')" />
                            </div>
                            <div>
                                <x-input-label for="tanggal_lahir" :value="__('Tanggal Lahir')" />
                                <x-text-input id="tanggal_lahir" class="block mt-1 w-full" type="date" name="tanggal_lahir" :value="old('tanggal_lahir')" />
                                <x-input-error class="mt-2" :messages="$errors->get('tanggal_lahir')" />
                            </div>
                            <div>
                                <x-input-label for="tempat_lahir" :value="__('Tempat Lahir')" />
                                <x-text-input id="tempat_lahir" class="block mt-1 w-full" type="text" name="tempat_lahir" :value="old('tempat_lahir')" />
                                <x-input-error class="mt-2" :messages="$errors->get('tempat_lahir')" />
                            </div>
                            <div>
                                <x-input-label for="alamat_ktp" :value="__('Alamat KTP')" />
                                <x-text-input id="alamat_ktp" class="block mt-1 w-full" type="text" name="alamat_ktp" :value="old('alamat_ktp')" />
                                <x-input-error class="mt-2" :messages="$errors->get('alamat_ktp')" />
                            </div>
                            <div>
                                <x-input-label for="alamat_tinggal" :value="__('Alamat Tinggal')" />
                                <x-text-input id="alamat_tinggal" class="block mt-1 w-full" type="text" name="alamat_tinggal" :value="old('alamat_tinggal')" />
                                <x-input-error class="mt-2" :messages="$errors->get('alamat_tinggal')" />
                            </div>
                            <div>
                                <x-input-label for="status_tempat_tinggal" :value="__('Status Tempat Tinggal')" />
                                <select id="status_tempat_tinggal" name="status_tempat_tinggal" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                                    <option value="">Pilih Status</option>
                                    <option value="Milik Sendiri" {{ old('status_tempat_tinggal') == 'Milik Sendiri' ? 'selected' : '' }}>Milik Sendiri</option>
                                    <option value="Sewa" {{ old('status_tempat_tinggal') == 'Sewa' ? 'selected' : '' }}>Sewa</option>
                                    <option value="Kos" {{ old('status_tempat_tinggal') == 'Kos' ? 'selected' : '' }}>Kos</option>
                                    <option value="Dinas" {{ old('status_tempat_tinggal') == 'Dinas' ? 'selected' : '' }}>Dinas</option>
                                    <option value="Lainnya" {{ old('status_tempat_tinggal') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('status_tempat_tinggal')" />
                            </div>
                            <div>
                                <x-input-label for="status_perkawinan" :value="__('Status Perkawinan')" />
                                <select id="status_perkawinan" name="status_perkawinan" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                                    <option value="">Pilih Status</option>
                                    <option value="Belum Kawin" {{ old('status_perkawinan') == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                                    <option value="Kawin" {{ old('status_perkawinan') == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                                    <option value="Janda" {{ old('status_perkawinan') == 'Janda' ? 'selected' : '' }}>Janda</option>
                                    <option value="Duda" {{ old('status_perkawinan') == 'Duda' ? 'selected' : '' }}>Duda</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('status_perkawinan')" />
                            </div>
                            <div>
                                <x-input-label for="no_handphone" :value="__('Nomor Handphone')" />
                                <x-text-input id="no_handphone" class="block mt-1 w-full" type="text" name="no_handphone" :value="old('no_handphone')" />
                                <x-input-error class="mt-2" :messages="$errors->get('no_handphone')" />
                            </div>
                            <div>
                                <x-input-label for="no_telepon_rumah" :value="__('Nomor Telepon Rumah')" />
                                <x-text-input id="no_telepon_rumah" class="block mt-1 w-full" type="text" name="no_telepon_rumah" :value="old('no_telepon_rumah')" />
                                <x-input-error class="mt-2" :messages="$errors->get('no_telepon_rumah')" />
                            </div>
                            <div>
                                <x-input-label for="no_npwp" :value="__('Nomor NPWP')" />
                                <x-text-input id="no_npwp" class="block mt-1 w-full" type="text" name="no_npwp" :value="old('no_npwp')" />
                                <x-input-error class="mt-2" :messages="$errors->get('no_npwp')" />
                            </div>
                            <div>
                                <x-input-label for="email_pemohon" :value="__('Email Pemohon')" />
                                <x-text-input id="email_pemohon" class="block mt-1 w-full" type="email" name="email_pemohon" :value="old('email_pemohon')" />
                                <x-input-error class="mt-2" :messages="$errors->get('email_pemohon')" />
                            </div>
                            <div>
                                <x-input-label for="tujuan_penggunaan_kredit" :value="__('Tujuan Penggunaan Kredit')" />
                                <select id="tujuan_penggunaan_kredit" name="tujuan_penggunaan_kredit" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                                    <option value="">Pilih Tujuan</option>
                                    <option value="Modal Usaha" {{ old('tujuan_penggunaan_kredit') == 'Modal Usaha' ? 'selected' : '' }}>Modal Usaha</option>
                                    <option value="Investasi" {{ old('tujuan_penggunaan_kredit') == 'Investasi' ? 'selected' : '' }}>Investasi</option>
                                    <option value="Konsumsi" {{ old('tujuan_penggunaan_kredit') == 'Konsumsi' ? 'selected' : '' }}>Konsumsi</option>
                                    <option value="Lainnya" {{ old('tujuan_penggunaan_kredit') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('tujuan_penggunaan_kredit')" />
                            </div>
                            <div>
                                <x-input-label for="jenis_jaminan_detail" :value="__('Jenis Jaminan Detail')" />
                                <x-text-input id="jenis_jaminan_detail" class="block mt-1 w-full" type="text" name="jenis_jaminan_detail" :value="old('jenis_jaminan_detail')" />
                                <x-input-error class="mt-2" :messages="$errors->get('jenis_jaminan_detail')" />
                            </div>
                            <div>
                                <x-input-label for="nilai_jaminan" :value="__('Nilai Jaminan')" />
                                <x-text-input id="nilai_jaminan" class="block mt-1 w-full" type="number" step="0.01" name="nilai_jaminan" :value="old('nilai_jaminan')" />
                                <x-input-error class="mt-2" :messages="$errors->get('nilai_jaminan')" />
                            </div>
                            <div>
                                <x-input-label for="status_kepemilikan_jaminan" :value="__('Status Kepemilikan Jaminan')" />
                                <select id="status_kepemilikan_jaminan" name="status_kepemilikan_jaminan" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full">
                                    <option value="">Pilih Status</option>
                                    <option value="Milik Sendiri" {{ old('status_kepemilikan_jaminan') == 'Milik Sendiri' ? 'selected' : '' }}>Milik Sendiri</option>
                                    <option value="Saudara" {{ old('status_kepemilikan_jaminan') == 'Saudara' ? 'selected' : '' }}>Saudara</option>
                                    <option value="Orang Tua" {{ old('status_kepemilikan_jaminan') == 'Orang Tua' ? 'selected' : '' }}>Orang Tua</option>
                                    <option value="Lainnya" {{ old('status_kepemilikan_jaminan') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('status_kepemilikan_jaminan')" />
                            </div>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                {{ __('Ajukan Aplikasi') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
