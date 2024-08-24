<?php

namespace App\Policies;

use App\Models\User;
use App\Permissions;

class CustomerInvoicePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function createInvoice(User $user): bool
    {
        return $user->hasPermission(Permissions::CREATE_CUSTOMER_INVOICE);
    }

    public function editInvoice(User $user): bool
    {
        return $user->hasPermission(Permissions::EDIT_CUSTOMER_INVOICE);
    }

    public function deleteInvoice(User $user): bool
    {
        return $user->hasPermission(Permissions::DELETE_CUSTOMER_INVOICE);
    }

    public function downloadInvoice(User $user): bool
    {
        return $user->hasPermission(Permissions::DOWNLOAD_CUSTOMER_INVOICE);
    }
}
