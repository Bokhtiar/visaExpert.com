<?php

namespace App\Policies;

use App\Models\User;
use App\Permissions;

class DashboardPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function access(User $user): bool
    {
        return $user->hasPermission(Permissions::ACCESS_ADMIN_DASHBOARD);
    }
}
