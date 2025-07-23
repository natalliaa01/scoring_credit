<?php

namespace App\Policies;

use App\Models\AplikasiKredit;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AplikasiKreditPolicy
{
    /**
     * Determine whether the user can view any models.
     * (Untuk method index di controller)
     */
    public function viewAny(User $user): bool
    {
        // Semua peran yang Anda definisikan dapat melihat daftar aplikasi.
        // Logika filtering data berdasarkan peran ada di controller index()
        return $user->hasAnyRole(['admin', 'direksi', 'kepala_bagian', 'teller']);
    }

    /**
     * Determine whether the user can view the model.
     * (Untuk method show di controller)
     */
    public function view(User $user, AplikasiKredit $aplikasiKredit): bool
    {
        // Admin, Direksi, Kepala Bagian Kredit bisa melihat semua.
        // Teller hanya bisa melihat aplikasi yang diajukan oleh dirinya sendiri.
        return $user->hasAnyRole(['admin', 'direksi', 'kepala_bagian']) ||
               ($user->hasRole('teller') && $user->id === $aplikasiKredit->user_id_pengaju);
    }

    /**
     * Determine whether the user can create models.
     * (Untuk method create dan store di controller)
     */
    public function create(User $user): bool
    {
        // Admin dan Teller bisa membuat aplikasi baru.
        return $user->hasAnyRole(['admin', 'teller']); // <-- PASTIKAN INI ADA DAN BENAR
    }

    /**
     * Determine whether the user can update the model.
     * (Untuk method edit dan update di controller)
     */
    public function update(User $user, AplikasiKredit $aplikasiKredit): bool
    {
        // Admin dan Kepala Bagian Kredit bisa mengedit aplikasi.
        // Teller TIDAK BISA mengedit aplikasi setelah diajukan.
        return $user->hasAnyRole(['admin', 'kepala_bagian']);
    }

    /**
     * Determine whether the user can delete the model.
     * (Untuk method destroy di controller)
     */
    public function delete(User $user, AplikasiKredit $aplikasiKredit): bool
    {
        // Admin dan Kepala Bagian Kredit bisa menghapus aplikasi.
        return $user->hasAnyRole(['admin', 'kepala_bagian']);
    }

    /**
     * Determine whether the user can view scoring results and recommendations.
     * (Untuk menampilkan kolom skor di index dan detail)
     */
    public function viewScoring(User $user): bool
    {
        // Admin, Direksi, Kepala Bagian Kredit bisa melihat hasil scoring.
        return $user->hasAnyRole(['admin', 'direksi', 'kepala_bagian']);
    }

    /**
     * Determine whether the user can forward an application to Direksi.
     */
    public function forwardToDireksi(User $user, AplikasiKredit $aplikasiKredit): bool
    {
        // Kepala Bagian Kredit dan Admin bisa meneruskan, jika statusnya 'Diajukan'
        return ($user->hasAnyRole(['admin', 'kepala_bagian'])) && $aplikasiKredit->status_aplikasi === 'Diajukan';
    }

    /**
     * Determine whether the user can approve an application.
     */
    public function approve(User $user, AplikasiKredit $aplikasiKredit): bool
    {
        // Direksi dan Admin bisa menyetujui, jika statusnya 'Menunggu Persetujuan Direksi'
        return ($user->hasAnyRole(['admin', 'direksi'])) && $aplikasiKredit->status_aplikasi === 'Menunggu Persetujuan Direksi';
    }

    /**
     * Determine whether the user can reject an application.
     */
    public function reject(User $user, AplikasiKredit $aplikasiKredit): bool
    {
        // Direksi dan Admin bisa menolak, jika statusnya 'Menunggu Persetujuan Direksi'
        return ($user->hasAnyRole(['admin', 'direksi'])) && $aplikasiKredit->status_aplikasi === 'Menunggu Persetujuan Direksi';
    }
}
