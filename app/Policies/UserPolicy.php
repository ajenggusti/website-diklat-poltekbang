<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return True;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        return $user->level->level === 'Super Admin' || $user->level->level==="DPUK" || $user->id === $model->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        return $user->level->level === 'Super Admin' || $user->level->level==="DPUK";
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return $user->level->level === 'Super Admin' || $user->level->level==="DPUK";
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return $user->level->level === 'Super Admin' || $user->level->level==="DPUK";
    }

    public function superAdminOnlyAction(User $user): bool
    {
        return $user->level->level === 'Super Admin';
    }

    public function dpukSuperAdminKeuangan(User $user): bool
    {
        return $user->level->level === 'Super Admin' ||  $user->level->level === 'DPUK' ||  $user->level->level === 'Keuangan';
    }
    public function dpukAction(User $user)
    {
        return $user->level->level === 'DPUK' || $user->level->level==="Super Admin";
    }
}