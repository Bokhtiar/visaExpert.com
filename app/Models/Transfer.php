<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;
    protected $fillable = [
        'recive_id', 'remark', 'amount', 'description', 'created_by', 'status'
    ];
}
