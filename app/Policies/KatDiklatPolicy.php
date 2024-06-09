<?php

namespace App\Policies;

use App\Models\KatDiklat;
use App\Models\User;

class KatDiklatPolicy
{
    /**
     * Allowed roles for accessing models.
     */
    protected $allowedRoles = ['DPUK', 'Super Admin'];

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return in_array($user->level->level, $this->allowedRoles);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, KatDiklat $katDiklat): bool
    {
        return in_array($user->level->level, $this->allowedRoles);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return in_array($user->level->level, $this->allowedRoles);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, KatDiklat $katDiklat): bool
    {
        return in_array($user->level->level, $this->allowedRoles);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, KatDiklat $katDiklat): bool
    {
        return in_array($user->level->level, $this->allowedRoles);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, KatDiklat $katDiklat): bool
    {
        return in_array($user->level->level, $this->allowedRoles);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, KatDiklat $katDiklat): bool
    {
        return in_array($user->level->level, $this->allowedRoles);
    }
}
