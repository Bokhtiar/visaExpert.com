<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class VisaForm extends Model
{
    use HasFactory;

    protected $table = 'visa_forms';

    protected $guarded = ['id'];
    
    
    // protected $fillable = [
    //     'type_remarks1','application_id', 'web_file_app_id', 'type_remarks2', 'image',
    // ]; new added but there are not fillbale exist, thats why i hide this line
    

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'service_visa_form');
    }

    public function visaType(): BelongsTo
    {
        return $this->belongsTo(VisaType::class);
    }

    public function invoice(): HasOne
    {
        return $this->hasOne(Invoice::class, 'form_id', 'id');
    }

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class, 'form_id', 'id');
    }
}
