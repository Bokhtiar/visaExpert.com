<?php

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

function logActivity($content, $itemId, $actionType, $tableName): void
{
    if (Auth::check()) {
        ActivityLog::create([
            'user_id' => Auth::id(),
            'content' => $content,
            'item_id' => $itemId,
            'action_type' => $actionType,
            'table_name' => $tableName,
        ]);
    }
}
