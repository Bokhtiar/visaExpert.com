<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffDutySalary extends Model
{
    use HasFactory;

    protected $table = 'staff_duty_salaries';

    protected $guarded = ['id'];
}
