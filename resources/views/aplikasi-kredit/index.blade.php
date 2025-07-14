<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-bpr-text-dark leading-tight">
            {{ __('Daftar Aplikasi Kredit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-bpr-text-dark">
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @can('create', App\Models\AplikasiKredit::class)
                        <div class="flex justify-end mb-4">
                            <a href="{{ route('aplikasi-kredit.create') }}" class="inline-flex items-center px-4 py-2 bg-bpr-blue-dark border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-bpr-blue-medium focus:bg-bpr-blue-medium active:bg-bpr-blue-dark focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Ajukan Aplikasi Baru') }}
                            </a>
                        </div>
                    @endcan

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ID Aplikasi
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tanggal Pengajuan
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Pengaju
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nama Pemohon
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    @can('viewScoring', App\Models\AplikasiKredit::class) {{-- Hanya tampilkan jika user punya akses viewScoring --}}
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Skor Kredit
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Rekomendasi Sistem
                                    </th>
                                    @endcan
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Aksi</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($aplikasiKredit as $aplikasi)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $aplikasi->id }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $aplikasi->tanggal_pengajuan->format('d M Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $aplikasi->pengaju->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $aplikasi->dataUmkm->nama_umkm ?? ($aplikasi->dataPegawai->nama_pegawai ?? '-') }}
                                            {{-- Menampilkan nama UMKM atau Pegawai --}}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $aplikasi->status_aplikasi }}
                                        </td>
                                        @can('viewScoring', App\Models\AplikasiKredit::class)
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $aplikasi->skor_kredit ?? 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $aplikasi->rekomendasi_sistem ?? 'N/A' }}
                                        </td>
                                        @endcan
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('aplikasi-kredit.show', $aplikasi->id) }}" class="text-bpr-blue-medium hover:text-bpr-blue-dark">Detail</a>
                                            @can('update', $aplikasi)
                                                <a href="{{ route('aplikasi-kredit.edit', $aplikasi->id) }}" class="ml-2 text-indigo-600 hover:text-indigo-900">Edit</a>
                                            @endcan
                                            {{-- Tombol Delete hanya untuk Admin --}}
                                            @can('delete', $aplikasi)
                                                <form action="{{ route('aplikasi-kredit.destroy', $aplikasi->id) }}" method="POST" class="inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="ml-2 text-red-600 hover:text-red-900" onclick="return confirm('Apakah Anda yakin ingin menghapus aplikasi ini?')">Hapus</button>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="{{ Auth::user()->can('viewScoring', App\Models\AplikasiKredit::class) ? '8' : '6' }}" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                            Belum ada aplikasi kredit yang diajukan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>