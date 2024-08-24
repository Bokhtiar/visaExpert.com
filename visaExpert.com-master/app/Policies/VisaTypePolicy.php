<?php

namespace App\Policies;

use App\Models\User;
use App\Permissions;

class VisaTypePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function index(User $user): bool
    {
        return $user->hasPermission(Permissions::VIEW_VISA_TYPE);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user): bool
    {
        return $user->hasPermission(Permissions::VIEW_VISA_TYPE);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermission(Permissions::CREATE_VISA_TYPE);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        return $user->hasPermission(Permissions::EDIT_VISA_TYPE);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): bool
    {
        return $user->hasPermission(Permissions::DELETE_VISA_TYPE);
    }
}
