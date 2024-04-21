<?php

namespace App\Http\Controllers;

use App\Enums\DocumentStatus;
use App\Http\Requests\Customer\CustomerStoreRequest;
use App\Models\Customer;
use App\Models\Document;
use App\Models\Invoice;
use App\Services\VisaFormService;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    // online 
    // public function storeForm(CustomerStoreRequest $request, VisaFormService $visaFormService): JsonResponse|RedirectResponse
    // {
    public function storeForm(CustomerStoreRequest $request, VisaFormService $visaFormService)
    {
       
        DB::beginTransaction();
        $customerCount = Customer::count();
        try {
            $customer = Customer::create([
                //'unique_id' => str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT),
                'unique_id' => $customerCount == 0 ? 1 : $customerCount + 1,
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'parent_customer_id' => Customer::latest()->value('id') + 1,
            ]);

            $visaForm = $visaFormService->createVisaForm($customer, $request);

            DB::commit();

            logActivity(
                (Auth::user()->name ?? 'Customer Himself').' created a visa application form.',
                $visaForm->id,
                'created',
                'visa_forms'
            );

            $successMessage = "Dear customer, Congratulation your customer ID: {$customer->unique_id}. Please save it for future.";
            session()->flash('success', $successMessage);

            return response()->json(['message' => $successMessage]);
        } catch (Exception $e) {

            DB::rollback();
            Log::error("Error creating visa application form: {$e->getMessage()}");

            return response()->json(['message' => 'Something went wrong!']);
        }
    }
    
    // offline
    public function storeFormOffline(CustomerStoreRequest $request, VisaFormService $visaFormService)
    {
        

        DB::beginTransaction();

        try {
            $customer = Customer::create([
                'unique_id' => str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT),
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'parent_customer_id' => Customer::latest()->value('id') + 1,
            ]);

            $visaForm = $visaFormService->createVisaForm($customer, $request);

            DB::commit();

            logActivity(
                (Auth::user()->name ?? 'Customer Himself').' created a visa application form.',
                $visaForm->id,
                'created',
                'visa_forms'
            );

            $successMessage = "Dear customer, here is your user ID: {$customer->unique_id}. Please save it for future.";
            session()->flash('success', $successMessage);

            return response()->json(['message' => $successMessage]);
            // return redirect()->back()->with('message', $successMessage);
        } catch (Exception $e) {

            DB::rollback();
            Log::error("Error creating visa application form: {$e->getMessage()}");

            return response()->json(['message' => 'Something went wrong!']);
        }
    }

    public function resubmitForm(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'resubmitted_document' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
        ]);

        DB::beginTransaction();

        try {
            $documentId = $request->input('document_id');
            $document = Document::findOrFail($documentId);

            $oldFilePath = public_path('uploads/visa-forms/documents/'.$document->documents);

            if (File::exists($oldFilePath)) {
                File::delete($oldFilePath);
            }

            $resubmittedDocument = $request->file('resubmitted_document');
            $extension = $resubmittedDocument->getClientOriginalExtension();
            $newFileName = 'new_file_'.uniqid().'.'.$extension;
            $newFilePath = $resubmittedDocument->move(public_path('uploads/visa-forms/documents'), $newFileName);

            $document->update([
                'documents' => $newFileName,
                'status' => DocumentStatus::REVIEW->toString(),
            ]);

            DB::commit();

            logActivity(
                (Auth::user()->name ?? 'Customer Himself').' resubmitted a file.',
                $document->id,
                'updated',
                'documents'
            );

            return redirect()->back()->with('success', 'Document resubmitted successfully. Please wait for the review.');
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->back()->with('error', 'Some went wrong!');
        }
    }

    public function invoiceDetails($encodedInvoice): View
    {
        $invoiceId = base64_decode($encodedInvoice);

        $invoice = Invoice::findOrFail($invoiceId);

        $invoice->load('customer');

        return view('frontend.invoice-details', compact('invoice'));
    }
}
