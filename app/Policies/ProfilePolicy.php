<?php

namespace App\Policies;

use App\Models\User;
use App\Permissions;

class ProfilePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function updateProfile(User $user): bool
    {
        return $user->hasPermission(Permissions::UPDATE_PROFILE);
    }

    public function updatePassword(User $user): bool
    {
        return $user->hasPermission(Permissions::UPDATE_PASSWORD);
    }
}
