<?php

namespace App\Policies;

use App\Models\KatDiklat;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class kelKatDiklatPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $this->isDPUKOrSuperAdmin($user);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, KatDiklat $katDiklat): bool
    {
        return $this->isDPUKOrSuperAdmin($user);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $this->isDPUKOrSuperAdmin($user);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, KatDiklat $katDiklat): bool
    {
        return $this->isDPUKOrSuperAdmin($user);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, KatDiklat $katDiklat): bool
    {
        return $this->isDPUKOrSuperAdmin($user);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, KatDiklat $katDiklat): bool
    {
        return $this->isDPUKOrSuperAdmin($user);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, KatDiklat $katDiklat): bool
    {
        return $this->isDPUKOrSuperAdmin($user);
    }

    /**
     * Helper method to check if the user is DPUK or Super Admin.
     */
    private function isDPUKOrSuperAdmin(User $user): bool
    {
        return $user->level->level === 'DPUK' || $user->level->level === 'Super Admin';
    }
}
