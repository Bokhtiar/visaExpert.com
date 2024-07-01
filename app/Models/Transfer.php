<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;
    protected $fillable = [
        'recive_id', 'remark', 'amount', 'description', 'created_by', 'status', 'expense_id', 'customer_id', 'type', 'current_amount', 'invoice_id'
    ];

    public function reciver(){
        return $this->belongsTo(User::class, 'recive_id', 'id');
    }

    public function transfer()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function expense()
    {
        return $this->belongsTo(DailyOfficeExpense::class, 'created_by', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
