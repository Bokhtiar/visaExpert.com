<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'fine',
        'punch_in',
        'punch_out',
        'total_hour',
        'late_hour',
        'early_out_hour',
        'month',
        'year',
        'date'
    ];

    protected $casts = [
        'punch_in' => 'datetime',
        'punch_out' => 'datetime',
        'date' => 'date'
    ];
}
