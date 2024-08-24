<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PaymentStatus;
use App\Enums\VisaStatus;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Service;
use App\Models\VisaForm;
use App\Services\VisaFormService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class VisaFormController extends Controller
{
    //    public function index(Request $request, VisaFormService $service): View
    //    {
    //        $searchTerm = $request->input('search');
    //
    //        $forms = $service->viewForms($request);
    //
    //        return view('backend.visa-forms.index', compact('forms', 'searchTerm'));
    //    }

    public function index(Request $request, VisaFormService $service): View
    {
        $forms = $service->viewForms($request);
        $searchTerm = $request->input('search');

        return view('backend.visa-forms.index', compact('forms', 'searchTerm'));
    }

    public function edit(VisaForm $visaForm): View
    {
        $selectedServices = $visaForm->service()->pluck('id')->toArray();
        $services = Service::all();
        $visaStatus = VisaStatus::collection();
        $paymentStatus = PaymentStatus::collection();

        return view('backend.visa-forms.form', compact('visaForm', 'services', 'selectedServices', 'visaStatus', 'paymentStatus'));

    }

    public function update(Request $request, VisaForm $visaForm): RedirectResponse
    {
        $visaForm->update([
            'visa_status' => $request->get('visa_status'),
            'payment_status' => $request->get('payment_status'),
        ]);

        $visaForm->invoice()->update([
            'amount' => $request->get('visa_fee'),
            'status' => $request->get('payment_status'),
        ]);

        logActivity(
            (Auth::user()->name.' updated a visa application form.'),
            $visaForm->id,
            'updated',
            'visa_forms'
        );

        return redirect()->back()->with('success', 'Form Updated successfully.');
    }

    public function destroy(VisaForm $visaForm): RedirectResponse
    {
        $documents = $visaForm->documents;

        $filenamesToDelete = $documents->pluck('documents')->toArray();

        $destinationPath = public_path('uploads/visa-forms/documents/');

        foreach ($filenamesToDelete as $filename) {
            $filePath = $destinationPath.$filename;
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }

        $visaForm->delete();

        logActivity(
            (Auth::user()->name.' deleted a visa application form.'),
            $visaForm->id,
            'deleted',
            'visa_forms'
        );

        return redirect()->back()->with('success', 'Deleted successfully.');
    }

    public function showDocuments(VisaFormService $service, $id): View
    {
        $documents = $service->getDocumentsForForm($id);

        return view('backend.visa-forms.documents')->with(compact('documents'));
    }

    public function generateInvoice(VisaForm $form): View
    {
        //        $contact = Contact::find(1);

        //        return view('invoice.details', compact('form', 'contact'));

        return view('invoice.details', compact('form'));
    }

    public function downloadInvoice(VisaForm $form): Response
    {
        $contact = Contact::find(1);
        $pdf = Pdf::loadView('invoice.pdf', compact('form', 'contact'))
            ->setOption([
                'defaultFont' => 'sans-serif',
                'defaultMediaType' => 'print',
            ]);

        logActivity(
            (Auth::user()->name.' downloaded a visa application form invoice.'),
            $form->id,
            'download',
            'invoices'
        );

        return $pdf->download('invoice.pdf');
    }
}
