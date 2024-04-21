<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Contracts\View\View;

class ActivityLogController extends Controller
{
    public function __invoke(): View
    {
        $this->authorize('access', ActivityLogController::class);

        return view('backend.activity-log', [
            'activityLogs' => ActivityLog::with('user')
                ->latest()->paginate(10),
        ]);
    }
}
