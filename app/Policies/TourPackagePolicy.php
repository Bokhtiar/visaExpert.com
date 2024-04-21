<?php

namespace App\Policies;

use App\Models\TourPackage;
use App\Models\User;
use App\Permissions;

class TourPackagePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermission(Permissions::VIEW_TOUR_PACKAGE);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, TourPackage $tourPackage): bool
    {
        return $user->hasPermission(Permissions::VIEW_TOUR_PACKAGE);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermission(Permissions::CREATE_TOUR_PACKAGE);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        return $user->hasPermission(Permissions::EDIT_TOUR_PACKAGE);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): bool
    {
        return $user->hasPermission(Permissions::DELETE_TOUR_PACKAGE);
    }
}
