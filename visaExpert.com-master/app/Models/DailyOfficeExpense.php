<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyOfficeExpense extends Model
{
    use HasFactory;

    protected $table = 'daily_office_expenses';

    protected $fillable = [
        'description', 'amount', 'created_by'
    ];
}
