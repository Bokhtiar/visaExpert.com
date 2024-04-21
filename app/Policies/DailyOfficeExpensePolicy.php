<?php

namespace App\Policies;

use App\Models\DailyOfficeExpense;
use App\Models\User;
use App\Permissions;

class DailyOfficeExpensePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermission(Permissions::VIEW_DAILY_OFFICE_EXPENSE);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, DailyOfficeExpense $dailyOfficeExpense): bool
    {
        return $user->hasPermission(Permissions::VIEW_DAILY_OFFICE_EXPENSE);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermission(Permissions::CREATE_DAILY_OFFICE_EXPENSE);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        return $user->hasPermission(Permissions::EDIT_DAILY_OFFICE_EXPENSE);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, DailyOfficeExpense $dailyOfficeExpense): bool
    {
        return $user->hasPermission(Permissions::DELETE_DAILY_OFFICE_EXPENSE);
    }
}
