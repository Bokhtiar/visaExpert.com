<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisaType extends Model
{
    use HasFactory;

    protected $table = 'visa_types';

    protected $fillable = [
        'title', 'required_documents','is_admin', 'is_user'
    ];

    public function getRequiredDocumentsAttributeForFronted(): string
    {
        return implode(', ', json_decode($this->attributes['required_documents']));
    }

        // protected $casts = [
        //     'required_documents' => 'json',
        // ];
}
