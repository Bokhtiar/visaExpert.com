<?php

namespace App\Services;

use App\Enums\DocumentStatus;
use App\Enums\PaymentStatus;
use App\Enums\VisaStatus;
use App\Models\Customer;
use App\Models\VisaForm;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisaFormService
{
    public function getSubmittedForms($customerId): Collection|array
    {
        return VisaForm::with('customer')
            ->where('customer_id', $customerId)
            ->orderByDesc('created_at')
            ->get();
    }

    public function createVisaForm(Customer $customer, Request $request): Model
    {
        $visaForm = $customer->forms()->create([
            'customer_id' => $customer->id,
            'visa_type_id' => $request->visa_type_id,
            'visa_status' => VisaStatus::PENDING->toString(),
            'payment_status' => PaymentStatus::DUE->toString(),
            'created_by' => Auth::user()->name ?? 'Customer Himself',
        ]);

        if ($request->hasFile('documents')) {
            $files = $request->file('documents');
            $destinationPath = public_path('uploads/visa-forms/documents/');
            $titles = $request->input('title');

            foreach ($files as $key => $file) {
                if ($file->isValid()) {
                    $extension = $file->getClientOriginalExtension();
                    $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $fileName = $originalName.'-'.uniqid().'.'.$extension;
                    $file->move($destinationPath, $fileName);

                    $title = $titles[$key] ?? '';

                    $visaForm->documents()->create([
                        'form_id' => $visaForm->id,
                        'title' => $title,
                        'documents' => $fileName,
                        'document_type' => $extension,
                        'status' => DocumentStatus::REVIEW->toString(),
                    ]);
                }
            }
        }

        return $visaForm;
    }

    public function getDocumentsForForm($id)
    {
        $form = VisaForm::findOrFail($id);

        return $form->documents;
    }
}
