<?php

namespace App\Policies;

use App\Models\Testimoni;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TestimoniPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->level->level === 'DPUK' || $user->level->level === 'Super Admin';
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Testimoni $testimoni): bool
    {
        return $user->level->level === 'DPUK' ||
            $user->level->level === 'Super Admin' ||
            $user->id === $testimoni->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Testimoni $testimoni = null): bool
    {
        return $user->level->level === 'DPUK' ||
            $user->level->level === 'Super Admin' ||
            ($testimoni !== null && $user->id === $testimoni->user_id);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Testimoni $testimoni): bool
    {
        return $user->level->level === 'DPUK' ||
            $user->level->level === 'Super Admin' ||
            $user->id === $testimoni->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Testimoni $testimoni): bool
    {
        return $user->level->level === 'DPUK' ||
            $user->level->level === 'Super Admin' ||
            $user->id === $testimoni->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Testimoni $testimoni): bool
    {
        return $user->level->level === 'DPUK' ||
            $user->level->level === 'Super Admin' ||
            $user->id === $testimoni->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Testimoni $testimoni): bool
    {
        return $user->level->level === 'DPUK' ||
            $user->level->level === 'Super Admin' ||
            $user->id === $testimoni->user_id;
    }
}
