<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'invoices';

    protected $guarded = ['id'];

    public function items(): HasMany
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function road()
    {
        return $this->belongsTo(Road::class);
    }

    public function form(): BelongsTo
    {
        return $this->belongsTo(VisaForm::class);
    }

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($invoice) {
            $invoice->invoice_number = 'NTT-'.str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
        });
    }
}
