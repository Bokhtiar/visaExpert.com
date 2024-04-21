<?php

namespace App\Policies;

use App\Models\Service;
use App\Models\User;
use App\Permissions;

class ServicePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermission(Permissions::VIEW_SERVICE);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user): bool
    {
        return $user->hasPermission(Permissions::VIEW_SERVICE);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermission(Permissions::CREATE_SERVICE);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Service $service): bool
    {
        return $user->hasPermission(Permissions::EDIT_SERVICE);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Service $service): bool
    {
        return $user->hasPermission(Permissions::DELETE_SERVICE);
    }
}
