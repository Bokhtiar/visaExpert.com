<?php

namespace App\Policies;

use App\Models\User;

class ActivityLogPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function access(User $user): bool
    {
        return $user->hasPermission('admin.activity-logs');
    }
}
