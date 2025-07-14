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
use Illuminate\Routing\Controller; // PASTIKAN INI YANG BENAR!

class AplikasiKreditController extends Controller
{
    public function index()
    {
        // Menggunakan Policy untuk memfilter aplikasi yang bisa dilihat
        if (Auth::user()->role === 'teller') {
            $aplikasiKredit = AplikasiKredit::with(['pengaju', 'dataUmkm', 'dataPegawai'])
                                ->where('user_id_pengaju', Auth::id())
                                ->latest()
                                ->get();
        } else {
            $aplikasiKredit = AplikasiKredit::with(['pengaju', 'dataUmkm', 'dataPegawai'])
                                ->latest()
                                ->get();
        }

        return view('aplikasi-kredit.index', compact('aplikasiKredit'));
    }

    public function create()
    {
        // Pastikan user punya hak create
        $this->authorize('create', AplikasiKredit::class);

        // Ambil data dari tabel kategori untuk dropdown di form
        $kategoriSektorEkonomi = KategoriSektorEkonomi::all();
        $kategoriGolonganJabatan = KategoriGolonganJabatan::all();

        return view('aplikasi-kredit.create', compact('kategoriSektorEkonomi', 'kategoriGolonganJabatan'));
    }

    public function store(Request $request)
    {
        // Pastikan user punya hak create
        $this->authorize('create', AplikasiKredit::class);

        // --- VALIDASI DATA (SANGAT PENTING!) ---
        $rules = [
            'tanggal_pengajuan' => 'required|date',
            'jenis_pemohon' => 'required|in:umkm,pegawai',
        ];

        if ($request->jenis_pemohon === 'umkm') {
            $rules = array_merge($rules, [
                'nama_umkm' => 'required|string|max:255',
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
            ]);
        }

        if ($request->jenis_pemohon === 'pegawai') {
            $rules = array_merge($rules, [
                'nama_pegawai' => 'required|string|max:255',
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

        // Buat Aplikasi Kredit baru
        $aplikasi = AplikasiKredit::create([
            'user_id_pengaju' => Auth::id(),
            'tanggal_pengajuan' => $validatedData['tanggal_pengajuan'],
            'status_aplikasi' => 'Diajukan',
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
                'sumber_dana_pengembalian' => $validatedData['sumber_dana_pengembalian'],
                'plafond_pengajuan' => $validatedData['plafond_pengajuan'],
                'jangka_waktu_kredit_bulan' => $validatedData['jangka_waktu_kredit_bulan'],
            ]);
        } elseif ($request->jenis_pemohon === 'pegawai') {
            DataPemohonPegawai::create([
                'aplikasi_id' => $aplikasi->id,
                'nama_pegawai' => $validatedData['nama_pegawai'],
                'usia' => $validatedData['usia'],
                'masa_kerja_tahun' => $validatedData['masa_kerja_tahun'],
                'golongan_jabatan_id' => $validatedData['golongan_jabatan_id'],
                'status_kepegawaian' => $validatedData['status_kepegawaian'],
                'gaji_bulanan' => $validatedData['gaji_bulanan'],
                'jumlah_tanggungan' => $validatedData['jumlah_tanggungan'],
                'riwayat_kredit_sebelumnya' => $validatedData['riwayat_kredit_sebelumnya_pegawai'],
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

    // Metode-metode lain (edit, update, destroy, forwardToDireksi, approve, reject) bisa ditambahkan di sini
}