<?php
namespace App\Policies;
use App\Models\Pembayaran;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PembayaranPolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->level->level, ['DPUK', 'Super Admin', 'Keuangan']);
    }

    public function view(User $user, Pembayaran $pembayaran): bool
    {
        return in_array($user->level->level, ['DPUK', 'Super Admin', 'Keuangan']) &&
            $user->id_pendaftaran === $pembayaran->id_pendaftaran;
    }

    public function create(User $user): bool
    {
        return in_array($user->level->level, ['DPUK', 'Super Admin', 'Keuangan']);
    }

    public function update(User $user, Pembayaran $pembayaran): bool
    {
        return in_array($user->level->level, ['DPUK', 'Super Admin', 'Keuangan']) &&
            $user->id_pendaftaran === $pembayaran->id_pendaftaran;
    }

    public function delete(User $user, Pembayaran $pembayaran): bool
    {
        return in_array($user->level->level, ['DPUK', 'Super Admin', 'Keuangan']) &&
            $user->id_pendaftaran === $pembayaran->id_pendaftaran;
    }

    public function restore(User $user, Pembayaran $pembayaran): bool
    {
        return in_array($user->level->level, ['DPUK', 'Super Admin', 'Keuangan']) &&
            $user->id_pendaftaran === $pembayaran->id_pendaftaran;
    }

    public function forceDelete(User $user, Pembayaran $pembayaran): bool
    {
        return in_array($user->level->level, ['DPUK', 'Super Admin', 'Keuangan']) &&
            $user->id_pendaftaran === $pembayaran->id_pendaftaran;
    }
}
