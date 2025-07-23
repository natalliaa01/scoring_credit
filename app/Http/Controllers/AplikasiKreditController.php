<?php

namespace App\Http\Controllers;

use App\Models\AplikasiKredit;
use App\Models\DataPemohonUmkm;
use App\Models\DataPemohonPegawai;
use App\Models\KategoriSektorEkonomi;
use App\Models\KategoriGolonganJabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
// Hapus baris ini: use Illuminate\Routing\Controller; // BARIS INI HARUS DIHAPUS
// Hapus baris ini: use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // BARIS INI JUGA HARUS DIHAPUS

// Pastikan ini mengacu pada App\Http\Controllers\Controller
// Ini adalah base controller Laravel yang sudah memiliki AuthorizesRequests trait.
class AplikasiKreditController extends Controller // Pastikan ini extends App\Http\Controllers\Controller
{
    // Hapus baris ini: use AuthorizesRequests; // BARIS INI JUGA HARUS DIHAPUS

    public function __construct()
    {
        // Ini akan secara otomatis memanggil metode di AplikasiKreditPolicy
        // seperti viewAny, view, create, update, delete berdasarkan mapping resource route
        // Parameter kedua 'aplikasi_kredit' adalah nama parameter route wildcard.
        $this->authorizeResource(AplikasiKredit::class, 'aplikasi_kredit');
    }

    public function index()
    {
        // Policy::viewAny() sudah memastikan user punya hak untuk melihat daftar.
        // Sekarang kita filter data berdasarkan peran.
        $user = Auth::user();
        $aplikasiKreditQuery = AplikasiKredit::query();

        // Menggunakan kolom 'role' langsung dari model User yang sudah diisi melalui seeder
        if ($user->role === 'teller') {
            $aplikasiKreditQuery->where('user_id_pengaju', $user->id);
        }
        // Untuk admin, direksi, dan kepala_bagian, tidak perlu filter tambahan,
        // karena mereka melihat semua (default query()).

        $aplikasiKredit = $aplikasiKreditQuery->with(['pengaju', 'dataUmkm.sektorEkonomi', 'dataPegawai.golonganJabatan'])
                                              ->latest()
                                              ->get();

        return view('aplikasi-kredit.index', compact('aplikasiKredit'));
    }

    public function create()
    {
        $kategoriSektorEkonomi = KategoriSektorEkonomi::all();
        $kategoriGolonganJabatan = KategoriGolonganJabatan::all();

        return view('aplikasi-kredit.create', compact('kategoriSektorEkonomi', 'kategoriGolonganJabatan'));
    }

    public function store(Request $request)
    {
        $rules = [
            'tanggal_pengajuan' => 'required|date',
            'jenis_pemohon' => 'required|in:umkm,pegawai',
            'nama_lengkap_pemohon' => 'required|string|max:255',
            'no_ktp' => ['required', 'string', 'max:255', Rule::unique('aplikasi_kredit', 'no_ktp')],
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'nullable|date',
            'tempat_lahir' => 'nullable|string|max:255',
            'alamat_ktp' => 'nullable|string|max:255',
            'alamat_tinggal' => 'nullable|string|max:255',
            'status_tempat_tinggal' => 'nullable|in:Milik Sendiri,Sewa,Kos,Dinas,Lainnya',
            'status_perkawinan' => 'nullable|in:Belum Kawin,Kawin,Janda,Duda',
            'no_handphone' => 'nullable|string|max:255',
            'no_telepon_rumah' => 'nullable|string|max:255',
            'no_npwp' => 'nullable|string|max:255',
            'email_pemohon' => 'nullable|string|email|max:255',
            'tujuan_penggunaan_kredit' => 'nullable|in:Modal Usaha,Investasi,Konsumsi,Lainnya',
            'jenis_jaminan_detail' => 'nullable|string|max:255',
            'nilai_jaminan' => 'nullable|numeric|min:0',
            'status_kepemilikan_jaminan' => 'nullable|in:Milik Sendiri,Saudara,Orang Tua,Lainnya',

            // Validasi khusus UMKM
            'omzet_usaha' => 'nullable|numeric|min:0',
            'lama_usaha_tahun' => 'nullable|integer|min:0',
            'sektor_ekonomi_id' => 'nullable|exists:kategori_sektor_ekonomi,id',
            'lokasi_usaha' => 'nullable|string|max:255',
            'riwayat_pinjaman_umkm' => 'nullable|in:Pernah Menunggak,Pernah Macet,Tidak Pernah',
            'jenis_penggunaan_kredit' => 'nullable|in:Modal Kerja,Investasi',
            'jenis_jaminan' => 'nullable|in:Tanah/Bangunan,Barang Bergerak,Lainnya',
            'sumber_dana_pengembalian' => 'nullable|in:Dari Usaha Sendiri,Hibah/Pinjaman Lain',
            'plafond_pengajuan' => 'nullable|numeric|min:0',
            'jangka_waktu_kredit_bulan' => 'nullable|integer|min:1',
            'tahun_berdiri_usaha' => 'nullable|string|max:4',
            'pendapatan_lain_umkm' => 'nullable|numeric|min:0',
            'pengeluaran_rutin_umkm' => 'nullable|numeric|min:0',
            'nama_kontak_darurat_umkm' => 'nullable|string|max:255',
            'hubungan_kontak_darurat_umkm' => 'nullable|in:Orang Tua,Saudara,Adik,Kakak,Teman,Lainnya',
            'no_telepon_kontak_darurat_umkm' => 'nullable|string|max:255',

            // Validasi khusus Pegawai
            'usia' => 'nullable|integer|min:18|max:65',
            'masa_kerja_tahun' => 'nullable|integer|min:0',
            'golongan_jabatan_id' => 'nullable|exists:kategori_golongan_jabatan,id',
            'status_kepegawaian' => 'nullable|in:Tetap,Kontrak',
            'gaji_bulanan' => 'nullable|numeric|min:0',
            'jumlah_tanggungan' => 'nullable|integer|min:0',
            'riwayat_kredit_sebelumnya_pegawai' => 'nullable|in:Pernah Macet,Tidak Pernah,Lain-lain',
            'nama_perusahaan_kantor' => 'nullable|string|max:255',
            'jenis_pekerjaan_detail' => 'nullable|string|max:255',
            'pendapatan_lain' => 'nullable|numeric|min:0',
            'pengeluaran_rutin_pegawai' => 'nullable|numeric|min:0',
            'nama_kontak_darurat_pegawai' => 'nullable|string|max:255',
            'hubungan_kontak_darurat_pegawai' => 'nullable|in:Orang Tua,Saudara,Adik,Kakak,Teman,Lainnya',
            'no_telepon_kontak_darurat_pegawai' => 'nullable|string|max:255',
        ];

        $validatedData = $request->validate($rules);

        // Buat Aplikasi Kredit baru
        $aplikasi = AplikasiKredit::create([
            'user_id_pengaju' => Auth::id(),
            'tanggal_pengajuan' => $validatedData['tanggal_pengajuan'],
            'status_aplikasi' => 'Diajukan',
            'skor_kredit' => null, // Inisialisasi
            'rekomendasi_sistem' => 'Belum Ada', // Inisialisasi
            'no_ktp' => $validatedData['no_ktp'],
            'jenis_kelamin' => $validatedData['jenis_kelamin'] ?? null,
            'tanggal_lahir' => $validatedData['tanggal_lahir'] ?? null,
            'tempat_lahir' => $validatedData['tempat_lahir'] ?? null,
            'alamat_ktp' => $validatedData['alamat_ktp'] ?? null,
            'alamat_tinggal' => $validatedData['alamat_tinggal'] ?? null,
            'status_tempat_tinggal' => $validatedData['status_tempat_tinggal'] ?? null,
            'status_perkawinan' => $validatedData['status_perkawinan'] ?? null,
            'no_handphone' => $validatedData['no_handphone'] ?? null,
            'no_telepon_rumah' => 'nullable|string|max:255',
            'no_npwp' => 'nullable|string|max:255',
            'email_pemohon' => 'nullable|string|email|max:255',
            'tujuan_penggunaan_kredit' => 'nullable|in:Modal Usaha,Investasi,Konsumsi,Lainnya',
            'jenis_jaminan_detail' => 'nullable|string|max:255',
            'nilai_jaminan' => 'nullable|numeric|min:0',
            'status_kepemilikan_jaminan' => 'nullable|in:Milik Sendiri,Saudara,Orang Tua,Lainnya',
            'nama_lengkap_pemohon' => ($request->jenis_pemohon === 'umkm') ? ($validatedData['nama_umkm'] ?? null) : ($validatedData['nama_pegawai'] ?? null),
        ]);


        // Simpan data pemohon sesuai jenisnya
        if ($request->jenis_pemohon === 'umkm') {
            DataPemohonUmkm::create([
                'aplikasi_id' => $aplikasi->id,
                'nama_umkm' => $validatedData['nama_umkm'],
                'omzet_usaha' => $validatedData['omzet_usaha'],
                'lama_usaha_tahun' => $validatedData['lama_usaha_tahun'],
                'sektor_ekonomi_id' => $validatedData['sektor_ekonomi_id'],
                'lokasi_usaha' => $validatedData['lokasi_usaha'],
                'riwayat_pinjaman' => $validatedData['riwayat_pinjaman_umkm'],
                'jenis_penggunaan_kredit' => $validatedData['jenis_penggunaan_kredit'],
                'jenis_jaminan' => $validatedData['jenis_jaminan'],
                'sumber_dana_pengembalian' => 'nullable|in:Dari Usaha Sendiri,Hibah/Pinjaman Lain',
                'plafond_pengajuan' => $validatedData['plafond_pengajuan'],
                'jangka_waktu_kredit_bulan' => $validatedData['jangka_waktu_kredit_bulan'],
                'tahun_berdiri_usaha' => $validatedData['tahun_berdiri_usaha'] ?? null,
                'pendapatan_lain' => $validatedData['pendapatan_lain_umkm'] ?? null,
                'pengeluaran_rutin' => $validatedData['pengeluaran_rutin_umkm'] ?? null,
                'nama_kontak_darurat' => $validatedData['nama_kontak_darurat_umkm'] ?? null,
                'hubungan_kontak_darurat' => $validatedData['hubungan_kontak_darurat_umkm'] ?? null,
                'no_telepon_kontak_darurat' => $validatedData['no_telepon_kontak_darurat_umkm'] ?? null,
            ]);
        } elseif ($request->jenis_pemohon === 'pegawai') {
            DataPemohonPegawai::create([
                'aplikasi_id' => $aplikasi->id,
                'nama_pegawai' => $validatedData['nama_pegawai'],
                'usia' => $validatedData['usia'],
                'masa_kerja_tahun' => $validatedData['masa_kerja_tahun'],
                'golongan_jabatan_id' => $validatedData['golongan_jabatan_id'],
                'status_kepegawaian' => 'nullable|in:Tetap,Kontrak',
                'gaji_bulanan' => $validatedData['gaji_bulanan'],
                'jumlah_tanggungan' => $validatedData['jumlah_tanggungan'],
                'riwayat_kredit_sebelumnya' => $validatedData['riwayat_kredit_sebelumnya_pegawai'],
                'nama_perusahaan_kantor' => 'nullable|string|max:255',
                'jenis_pekerjaan_detail' => 'nullable|string|max:255',
                'pendapatan_lain' => 'nullable|numeric|min:0',
                'pengeluaran_rutin' => 'nullable|numeric|min:0',
                'nama_kontak_darurat' => 'nullable|string|max:255',
                'hubungan_kontak_darurat' => 'nullable|in:Orang Tua,Saudara,Adik,Kakak,Teman,Lainnya',
                'no_telepon_kontak_darurat' => 'nullable|string|max:255',
            ]);
        }

        return redirect()->route('aplikasi-kredit.index')->with('success', 'Aplikasi kredit berhasil diajukan.');
    }

    public function show(AplikasiKredit $aplikasiKredit)
    {
        $this->authorize('view', $aplikasiKredit);
        $aplikasiKredit->load(['pengaju', 'direksiPenyetuju', 'dataUmkm.sektorEkonomi', 'dataPegawai.golonganJabatan']);
        return view('aplikasi-kredit.show', compact('aplikasiKredit'));
    }

    public function edit(AplikasiKredit $aplikasiKredit)
    {
        $this->authorize('update', $aplikasiKredit);
        $kategoriSektorEkonomi = KategoriSektorEkonomi::all();
        $kategoriGolonganJabatan = KategoriGolonganJabatan::all();
        return view('aplikasi-kredit.edit', compact('aplikasiKredit', 'kategoriSektorEkonomi', 'kategoriGolonganJabatan'));
    }

    public function update(Request $request, AplikasiKredit $aplikasiKredit)
    {
        $this->authorize('update', $aplikasiKredit);

        $rules = [
            'tanggal_pengajuan' => 'required|date',
            'jenis_pemohon' => ['required', Rule::in('umkm', 'pegawai')], // tidak bisa diubah setelah dibuat
            'no_ktp' => ['required', 'string', 'max:255', Rule::unique('aplikasi_kredit', 'no_ktp')->ignore($aplikasiKredit->id)],
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'nullable|date',
            'tempat_lahir' => 'nullable|string|max:255',
            'alamat_ktp' => 'nullable|string|max:255',
            'alamat_tinggal' => 'nullable|string|max:255',
            'status_tempat_tinggal' => 'nullable|in:Milik Sendiri,Sewa,Kos,Dinas,Lainnya',
            'status_perkawinan' => 'nullable|in:Belum Kawin,Kawin,Janda,Duda',
            'no_handphone' => 'nullable|string|max:255',
            'no_telepon_rumah' => 'nullable|string|max:255',
            'no_npwp' => 'nullable|string|max:255',
            'email_pemohon' => 'nullable|string|email|max:255',
            'tujuan_penggunaan_kredit' => 'nullable|in:Modal Usaha,Investasi,Konsumsi,Lainnya',
            'jenis_jaminan_detail' => 'nullable|string|max:255',
            'nilai_jaminan' => 'nullable|numeric|min:0',
            'status_kepemilikan_jaminan' => 'nullable|in:Milik Sendiri,Saudara,Orang Tua,Lainnya',

            // Validasi khusus UMKM
            'omzet_usaha' => 'nullable|numeric|min:0',
            'lama_usaha_tahun' => 'nullable|integer|min:0',
            'sektor_ekonomi_id' => 'nullable|exists:kategori_sektor_ekonomi,id',
            'lokasi_usaha' => 'nullable|string|max:255',
            'riwayat_pinjaman_umkm' => 'nullable|in:Pernah Menunggak,Pernah Macet,Tidak Pernah',
            'jenis_penggunaan_kredit' => 'nullable|in:Modal Kerja,Investasi',
            'jenis_jaminan' => 'nullable|in:Tanah/Bangunan,Barang Bergerak,Lainnya',
            'sumber_dana_pengembalian' => 'nullable|in:Dari Usaha Sendiri,Hibah/Pinjaman Lain',
            'plafond_pengajuan' => 'nullable|numeric|min:0',
            'jangka_waktu_kredit_bulan' => 'nullable|integer|min:1',
            'tahun_berdiri_usaha' => 'nullable|string|max:4',
            'pendapatan_lain_umkm' => 'nullable|numeric|min:0',
            'pengeluaran_rutin_umkm' => 'nullable|numeric|min:0',
            'nama_kontak_darurat_umkm' => 'nullable|string|max:255',
            'hubungan_kontak_darurat_umkm' => 'nullable|in:Orang Tua,Saudara,Adik,Kakak,Teman,Lainnya',
            'no_telepon_kontak_darurat_umkm' => 'nullable|string|max:255',

            // Validasi khusus Pegawai
            'usia' => 'nullable|integer|min:18|max:65',
            'masa_kerja_tahun' => 'nullable|integer|min:0',
            'golongan_jabatan_id' => 'nullable|exists:kategori_golongan_jabatan,id',
            'status_kepegawaian' => 'nullable|in:Tetap,Kontrak',
            'gaji_bulanan' => 'nullable|numeric|min:0',
            'jumlah_tanggungan' => 'nullable|integer|min:0',
            'riwayat_kredit_sebelumnya_pegawai' => 'nullable|in:Pernah Macet,Tidak Pernah,Lain-lain',
            'nama_perusahaan_kantor' => 'nullable|string|max:255',
            'jenis_pekerjaan_detail' => 'nullable|string|max:255',
            'pendapatan_lain' => 'nullable|numeric|min:0',
            'pengeluaran_rutin_pegawai' => 'nullable|numeric|min:0',
            'nama_kontak_darurat_pegawai' => 'nullable|string|max:255',
            'hubungan_kontak_darurat_pegawai' => 'nullable|in:Orang Tua,Saudara,Adik,Kakak,Teman,Lainnya',
            'no_telepon_kontak_darurat_pegawai' => 'nullable|string|max:255',
        ];

        // Validasi berdasarkan jenis pemohon
        if ($aplikasiKredit->dataUmkm) { // Jika ini aplikasi UMKM
            $rules = array_merge($rules, [
                // Validasi khusus UMKM
                'omzet_usaha' => 'required|numeric|min:0',
                'lama_usaha_tahun' => 'required|integer|min:0',
                'sektor_ekonomi_id' => 'required|exists:kategori_sektor_ekonomi,id',
                'lokasi_usaha' => 'required|string|max:255',
                'riwayat_pinjaman_umkm' => 'required|in:Pernah Menunggak,Pernah Macet,Tidak Pernah',
                'jenis_penggunaan_kredit' => 'required|in:Modal Kerja,Investasi',
                'jenis_jaminan' => 'required|in:Tanah/Bangunan,Barang Bergerak,Lainnya',
                'sumber_dana_pengembalian' => 'required|in:Dari Usaha Sendiri,Hibah/Pinjaman Lain',
                'plafond_pengajuan' => 'required|numeric|min:0',
                'jangka_waktu_kredit_bulan' => 'required|integer|min:1',
                'tahun_berdiri_usaha' => 'nullable|string|max:4',
                'pendapatan_lain_umkm' => 'nullable|numeric|min:0',
                'pengeluaran_rutin_umkm' => 'nullable|numeric|min:0',
                'nama_kontak_darurat_umkm' => 'nullable|string|max:255',
                'hubungan_kontak_darurat_umkm' => 'nullable|in:Orang Tua,Saudara,Adik,Kakak,Teman,Lainnya',
                'no_telepon_kontak_darurat_umkm' => 'nullable|string|max:255',
            ]);
        } elseif ($aplikasiKredit->dataPegawai) { // Jika ini aplikasi Pegawai
            $rules = array_merge($rules, [
                // Validasi khusus Pegawai
                'usia' => 'required|integer|min:18|max:65',
                'masa_kerja_tahun' => 'required|integer|min:0',
                'golongan_jabatan_id' => 'required|exists:kategori_golongan_jabatan,id',
                'status_kepegawaian' => 'required|in:Tetap,Kontrak',
                'gaji_bulanan' => 'required|numeric|min:0',
                'jumlah_tanggungan' => 'required|integer|min:0',
                'riwayat_kredit_sebelumnya_pegawai' => 'required|in:Pernah Macet,Tidak Pernah,Lain-lain',
            ]);
        }

        $validatedData = $request->validate($rules);

        // Update data di tabel aplikasi_kredit
        $aplikasiKredit->update([
            'tanggal_pengajuan' => $validatedData['tanggal_pengajuan'],
            'no_ktp' => $validatedData['no_ktp'],
            'jenis_kelamin' => $validatedData['jenis_kelamin'] ?? null,
            'tanggal_lahir' => $validatedData['tanggal_lahir'] ?? null,
            'tempat_lahir' => $validatedData['tempat_lahir'] ?? null,
            'alamat_ktp' => $validatedData['alamat_ktp'] ?? null,
            'alamat_tinggal' => $validatedData['alamat_tinggal'] ?? null,
            'status_tempat_tinggal' => $validatedData['status_tempat_tinggal'] ?? null,
            'status_perkawinan' => $validatedData['status_perkawinan'] ?? null,
            'no_handphone' => $validatedData['no_handphone'] ?? null,
            'no_telepon_rumah' => $validatedData['no_telepon_rumah'] ?? null,
            'no_npwp' => 'nullable|string|max:255',
            'email_pemohon' => 'nullable|string|email|max:255',
            'tujuan_penggunaan_kredit' => 'nullable|in:Modal Usaha,Investasi,Konsumsi,Lainnya',
            'jenis_jaminan_detail' => 'nullable|string|max:255',
            'nilai_jaminan' => 'nullable|numeric|min:0',
            'status_kepemilikan_jaminan' => 'nullable|in:Milik Sendiri,Saudara,Orang Tua,Lainnya',
            // 'nama_lengkap_pemohon' akan diupdate dari nama_umkm atau nama_pegawai
            'nama_lengkap_pemohon' => ($aplikasiKredit->dataUmkm) ? ($validatedData['nama_umkm'] ?? null) : ($validatedData['nama_pegawai'] ?? null),
        ]);


        // Update data di tabel pemohon (UMKM atau Pegawai)
        if ($aplikasiKredit->dataUmkm) {
            $aplikasiKredit->dataUmkm->update([
                'omzet_usaha' => $validatedData['omzet_usaha'],
                'lama_usaha_tahun' => $validatedData['lama_usaha_tahun'],
                'sektor_ekonomi_id' => $validatedData['sektor_ekonomi_id'],
                'lokasi_usaha' => $validatedData['lokasi_usaha'],
                'riwayat_pinjaman' => $validatedData['riwayat_pinjaman_umkm'],
                'jenis_penggunaan_kredit' => $validatedData['jenis_penggunaan_kredit'],
                'jenis_jaminan' => $validatedData['jenis_jaminan'],
                'sumber_dana_pengembalian' => $validatedData['sumber_dana_pengembalian'],
                'plafond_pengajuan' => $validatedData['plafond_pengajuan'],
                'jangka_waktu_kredit_bulan' => $validatedData['jangka_waktu_kredit_bulan'],
                'tahun_berdiri_usaha' => $validatedData['tahun_berdiri_usaha'] ?? null,
                'pendapatan_lain' => $validatedData['pendapatan_lain_umkm'] ?? null,
                'pengeluaran_rutin' => $validatedData['pengeluaran_rutin_umkm'] ?? null,
                'nama_kontak_darurat' => $validatedData['nama_kontak_darurat_umkm'] ?? null,
                'hubungan_kontak_darurat' => $validatedData['hubungan_kontak_darurat_umkm'] ?? null,
                'no_telepon_kontak_darurat' => $validatedData['no_telepon_kontak_darurat_umkm'] ?? null,
            ]);
        } elseif ($aplikasiKredit->dataPegawai) {
            $aplikasiKredit->dataPegawai->update([
                'usia' => $validatedData['usia'],
                'masa_kerja_tahun' => $validatedData['masa_kerja_tahun'],
                'golongan_jabatan_id' => $validatedData['golongan_jabatan_id'],
                'status_kepegawaian' => $validatedData['status_kepegawaian'],
                'gaji_bulanan' => $validatedData['gaji_bulanan'],
                'jumlah_tanggungan' => $validatedData['jumlah_tanggungan'],
                'riwayat_kredit_sebelumnya' => $validatedData['riwayat_kredit_sebelumnya_pegawai'],
                'nama_perusahaan_kantor' => $validatedData['nama_perusahaan_kantor'] ?? null,
                'jenis_pekerjaan_detail' => $validatedData['jenis_pekerjaan_detail'] ?? null,
                'pendapatan_lain' => $validatedData['pendapatan_lain_pegawai'] ?? null,
                'pengeluaran_rutin' => $validatedData['pengeluaran_rutin_pegawai'] ?? null,
                'nama_kontak_darurat' => $validatedData['nama_kontak_darurat_pegawai'] ?? null,
                'hubungan_kontak_darurat' => $validatedData['hubungan_kontak_darurat_pegawai'] ?? null,
                'no_telepon_kontak_darurat' => $validatedData['no_telepon_kontak_darurat_pegawai'] ?? null,
            ]);
        }

        return redirect()->route('aplikasi-kredit.index')->with('success', 'Aplikasi kredit berhasil diperbarui.');
    }

    public function destroy(AplikasiKredit $aplikasiKredit)
    {
        $this->authorize('delete', $aplikasiKredit);
        $aplikasiKredit->delete();
        return redirect()->route('aplikasi-kredit.index')->with('success', 'Aplikasi kredit berhasil dihapus.');
    }

    public function forwardToDireksi(AplikasiKredit $aplikasiKredit)
    {
        $this->authorize('forwardToDireksi', $aplikasiKredit);
        $aplikasiKredit->update(['status_aplikasi' => 'Menunggu Persetujuan Direksi']);
        return back()->with('success', 'Aplikasi berhasil diteruskan ke Direksi.');
    }

    public function approve(AplikasiKredit $aplikasiKredit, Request $request)
    {
        $this->authorize('approve', $aplikasiKredit);
        $aplikasiKredit->update([
            'status_aplikasi' => 'Disetujui Direksi',
            'direksi_id_persetujuan' => Auth::id(),
            'tanggal_persetujuan_direksi' => now(),
            'catatan_direksi' => $request->catatan_direksi, // Tambahkan input catatan
        ]);
        return back()->with('success', 'Aplikasi berhasil disetujui.');
    }

    public function reject(AplikasiKredit $aplikasiKredit, Request $request)
    {
        $this->authorize('reject', $aplikasiKredit);
        $aplikasiKredit->update([
            'status_aplikasi' => 'Ditolak Direksi',
            'direksi_id_persetujuan' => Auth::id(),
            'tanggal_persetujuan_direksi' => now(),
            'catatan_direksi' => $request->catatan_direksi, // Tambahkan input catatan
        ]);
        return back()->with('success', 'Aplikasi berhasil ditolak.');
    }
}