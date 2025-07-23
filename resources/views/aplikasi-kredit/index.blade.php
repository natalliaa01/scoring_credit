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

                    <div class="flex justify-between items-center mb-4">
                        @can('create aplikasi kredit')
                            <a href="{{ route('aplikasi-kredit.create') }}" class="inline-flex items-center px-4 py-2 bg-bpr-blue-dark border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-bpr-blue-medium focus:bg-bpr-blue-medium active:bg-bpr-blue-dark focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Ajukan Aplikasi Baru') }}
                            </a>
                        @endcan

                        {{-- Search Bar --}}
                        <form action="{{ route('aplikasi-kredit.index') }}" method="GET" class="flex items-center space-x-2">
                            <x-text-input type="text" name="search" placeholder="Cari aplikasi..." value="{{ request('search') }}" class="w-full sm:w-auto"/>
                            <x-primary-button class="bg-bpr-blue-dark hover:bg-bpr-blue-medium">
                                {{ __('Cari') }}
                            </x-primary-button>
                            @if(request('search'))
                                <a href="{{ route('aplikasi-kredit.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-bpr-text-dark uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                                    {{ __('Reset') }}
                                </a>
                            @endif
                        </form>
                    </div>

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
                                    @can('view scoring dan rekomendasi')
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
                                            {{ $aplikasi->nama_lengkap_pemohon }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $aplikasi->status_aplikasi }}
                                        </td>
                                        @can('view scoring dan rekomendasi')
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $aplikasi->skor_kredit ?? 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $aplikasi->rekomendasi_sistem ?? 'N/A' }}
                                        </td>
                                        @endcan
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('aplikasi-kredit.show', $aplikasi->id) }}" class="text-bpr-blue-medium hover:text-bpr-blue-dark">Detail</a>
                                            {{-- Tombol Edit (hanya untuk Kepala Bagian/Admin) --}}
                                            @can('update', $aplikasi)
                                                <a href="{{ route('aplikasi-kredit.edit', $aplikasi->id) }}" class="ml-2 text-indigo-600 hover:text-indigo-900">Edit</a>
                                            @endcan
                                            {{-- Tombol Delete (hanya untuk Admin dan Kepala Bagian) --}}
                                            @can('delete', $aplikasi)
                                                <form action="{{ route('aplikasi-kredit.destroy', $aplikasi->id) }}" method="POST" class="inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="ml-2 text-red-600 hover:text-red-900" onclick="return confirm('Apakah Anda yakin ingin menghapus aplikasi ini?')">Hapus</button>
                                                </form>
                                            @endcan
                                            {{-- Tombol untuk forward, approve, reject --}}
                                            @can('forwardToDireksi', $aplikasi)
                                                {{-- Tambahkan catatan kepala bagian di sini jika diperlukan --}}
                                                <form action="{{ route('aplikasi-kredit.forward-to-direksi', $aplikasi->id) }}" method="POST" class="inline-block ml-2">
                                                    @csrf
                                                    <button type="submit" class="text-green-600 hover:text-green-900">Teruskan ke Direksi</button>
                                                </form>
                                            @endcan

                                            @can('approve', $aplikasi)
                                                <form action="{{ route('aplikasi-kredit.approve', $aplikasi->id) }}" method="POST" class="inline-block ml-2">
                                                    @csrf
                                                    <button type="submit" class="text-blue-600 hover:text-blue-900">Setujui</button>
                                                </form>
                                            @endcan

                                            @can('reject', $aplikasi)
                                                <form action="{{ route('aplikasi-kredit.reject', $aplikasi->id) }}" method="POST" class="inline-block ml-2">
                                                    @csrf
                                                    <button type="submit" class="text-red-600 hover:text-red-900">Tolak</button>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="{{ Auth::user()->can('view scoring dan rekomendasi') ? '8' : '6' }}" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
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
