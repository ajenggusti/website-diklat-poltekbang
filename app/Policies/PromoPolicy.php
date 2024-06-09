<?php

namespace App\Policies;

use App\Models\Promos;
use App\Models\User;

class PromoPolicy
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
    public function view(User $user, Promos $promo): bool
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
    public function update(User $user, Promos $promo): bool
    {
        return in_array($user->level->level, $this->allowedRoles);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Promos $promo): bool
    {
        return in_array($user->level->level, $this->allowedRoles);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Promos $promo): bool
    {
        return in_array($user->level->level, $this->allowedRoles);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Promos $promo): bool
    {
        return in_array($user->level->level, $this->allowedRoles);
    }
}
