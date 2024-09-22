<?php

namespace App\Policies;

use App\Models\Expert;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ExpertPolicy
{
    public function before(User $user, string $ability): bool|null
    {
        if ($user->isAdmin()) {
            return true;
        }

        return null;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->isCompany();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Expert $expert): bool
    {
        return $user->isCompany() && $expert->company_id == $user->userable_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isCompany();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Expert $expert): bool
    {
        return $user->isCompany() && $expert->company_id == $user->userable_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Expert $expert): bool
    {
        return $user->isCompany() && $expert->company_id == $user->userable_id;
    }
}
