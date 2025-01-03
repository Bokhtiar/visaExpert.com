<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';

    protected $fillable = [
        'unique_id', 'name', 'phone', 'parent_customer_id', 'customer_search_status'
    ];

    public function forms(): HasMany
    {
        return $this->hasMany(VisaForm::class, 'customer_id', 'id');
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class, 'customer_id', 'id');
    }

    public static function countChaild($id)
    {
        $childCustomers = Customer::where('parent_customer_id', $id)->pluck('id'); // Get the list of child customer IDs
        $count = $childCustomers->count(); // Count the number of child customers

        return ['count' => $count, 'ids' => $childCustomers];
    }


    public function customer()
    {
        return $this->BelongsTo(Customer::class, 'parent_customer_id', 'id');
    }

    
    public static function webFileAppId($id)
    {
        return VisaForm::where('customer_id', $id)->first('web_file_app_id');
    }

}
