<?php

namespace App\Http\Requests\Customer;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CustomerStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'visa_type_id' => 'required|exists:visa_types,id',
            'name' => 'required|string|max:255',
            'phone' => 'required|numeric|regex:/^(?:\+?88)?01[3-9]\d{8}$/|min:11',
            'documents.*' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
            'title.*' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'visa_type_id.required' => 'Please select a visa type',
            'name.required' => 'Name is required',
            'name.string' => 'Enter a valid name',
            'name.max' => 'The name is too large',
            'phone.required' => 'Contact number is required',
            'phone.numeric' => 'Contact number must be valid',
            'phone.regex' => 'Invalid phone number',
            'documents.file' => 'Invalid file',
            'documents.mimes' => 'Supported file format: pdf,doc,docs,jpg,jpeg,png',
            'documents.max' => 'Max file size: 2MB',
            'title.string' => 'Invalid title',
        ];
    }
}
