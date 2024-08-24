<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivityLog extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'activity_logs';

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id', 'content', 'item_id', 'action_type', 'table_name',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getFormattedCreatedAtAttribute(): string
    {
        $createdAt = $this->getAttribute('created_at');
        $formattedTime = $createdAt->format('h:i A');

        if ($createdAt->isToday()) {
            return "$formattedTime Today";
        } else {
            return $createdAt->format('l \a\t h:i A');
        }
    }

    public function getCreatedAtForHumansAttribute(): string
    {
        return $this->getAttribute('created_at')->diffForHumans();
    }
}
