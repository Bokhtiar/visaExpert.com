<?php

namespace App\Services;

use App\Models\ActivityLog;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class NotificationService
{
    public function getAllNotifications(): LengthAwarePaginator
    {
        return ActivityLog::with('user')
            ->latest()->paginate(5);
    }
}
