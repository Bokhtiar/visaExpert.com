<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PaymentStatus;
use App\Enums\VisaStatus;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\VisaType;
use App\Models\Document;
use App\Models\Passport;
use App\Models\VisaForm;
use App\Services\VisaFormService;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index(): View
    {
        $this->authorize('index', CustomerController::class);

        // return view('backend.customer.index')
        //     ->withCustomers(
        //         Customer::with('forms')->get()
        //     );
        // parent_customer_id
        $customers = Customer::latest()->get();
        return view('backend.customer.index', compact('customers'));

    }

    /*offline customer create*/
    public function offline_customer_create(Request $request)
    {
        $user = $request->user();
        $visaType = VisaType::all();

        return view('backend.customer.offline-create', compact('user', 'visaType'));
    }

    /** add more customer */
    public function add_more($id, VisaFormService $visaFormService)
    {
        $parent_customer = Customer::find($id);
        $customerVisaType = VisaForm::where('customer_id', $id)->first();


        DB::beginTransaction();
        $customerCount = Customer::count();
        try {

            $customer = Customer::create([
                //'unique_id' => str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT),
                'unique_id' => Customer::latest()->value('id') + 1,
                'name' => $parent_customer->name,
                'phone' => $parent_customer->phone,
                'parent_customer_id' => $id,
            ]);

            $visaForm = $customer->forms()->create([
                'customer_id' => $customer->id,
                'visa_type_id' => $customerVisaType->visa_type_id,
                'visa_status' => VisaStatus::PENDING->toString(),
                'payment_status' => PaymentStatus::DUE->toString(),
                'created_by' => Auth::user()->name ?? 'Customer Himself',
            ]);

            DB::commit();

            // logActivity(
            //     (Auth::user()->name ?? 'Customer Himself') . ' created a visa application form.',
            //     $visaForm->id,
            //     'created',
            //     'visa_forms'
            // );

            $successMessage = "Dear customer, Congratulation your customer ID: {$customer->unique_id}. Please save it for future.";
            session()->flash('success', $successMessage);
            // dd($customer);
            //return response()->json(['message' => $successMessage]);
            return redirect()->back();
        } catch (Exception $e) {

            DB::rollback();
            Log::error("Error creating visa application form: {$e->getMessage()}");

            // dd($e->getMessage());

            return response()->json(['message' => 'Something went wrong!']);
        }
    }


    public function show(Customer $customer): View
    {

        //dd($customer);
        $this->authorize('view', CustomerController::class);
        $visaStatuses = VisaStatus::collection();

       

        $customer = Customer::with('forms.visaType')
            ->with('forms.invoice')
            ->with('forms.documents')
            ->findOrFail($customer->id);


      


        $parent_customers = Customer::where('parent_customer_id', $customer->parent_customer_id)->get();


        //dd($prent_customers);
        // $customer = Customer::with('forms.visaType')
        // ->with('forms.invoice')
        // ->with('forms.documents')

        // ->findOrFail($customer->id);


        $passport = Passport::where('customer_id', $customer->id)->get();
        return view('backend.customer.show', compact('customer', 'passport', 'visaStatuses', 'parent_customers'));
    }

    public function update(Customer $customer, Request $request): RedirectResponse
    {
        // dd($request->all());

        try {
            $this->authorize('update', CustomerController::class);
            $customer->update([
                'name' => $request->name,
                'phone' => $request->phone,

            ]);


            if ($request->addMore) {
                foreach ($request->addMore as $key => $value) {

                    Passport::create([
                        'customer_id' => $customer->id,
                        'passport' => $value['name']
                    ]);
                }
            }

            // foreach ($request->addmore_update as $key => $value) {

            //     $passportUpdate = Passport::find($value['id']);

            //     $passportUpdate->update([
            //         'customer_id' => $customer->id,
            //         'passport' => $value['name'],
            //     ]);
            // }
            if
            ($request->addmore_update) {
                foreach ($request->addmore_update as $key => $value) {
                    $passportUpdate = Passport::find($value['id']);

                    if ($passportUpdate) {
                        try {
                            $passportUpdate->update([
                                'customer_id' => $customer->id,
                                'passport' => $value['name'],
                            ]);
                            // Log success or any other debug information
                        } catch (\Exception $e) {
                            // Log the exception message or any other debug information
                            // Log::error($e->getMessage());
                            dd($e->getMessage());
                        }
                    } else {
                        // Log or handle the case where the Passport record is not found
                        // Log::error("Passport record not found for ID: {$value['id']}");
                        dd("Passport record not found for ID: {$value['id']}");
                    }
                }
            }




            logActivity(
                (Auth::user()->name . ' updated a customer information.'),
                $customer->id,
                'updated',
                'customers'
            );

            return redirect()->back()->with('success', 'Customer updated successfully.');
        } catch (AuthorizationException $e) {
            //dd($e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy(Customer $customer): RedirectResponse
    {
        try {
            $this->authorize('update', CustomerController::class);

            $customer->delete();

            logActivity(
                (Auth::user()->name . ' deleted a customer.'),
                $customer->id,
                'deleted',
                'customers'
            );

            return back()->with('success', 'Customer Deleted Successfully!');
        } catch (AuthorizationException $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function updateVisaStatus(Request $request, Customer $customer): RedirectResponse
    {
   
        try {


            $this->authorize('update', CustomerController::class);
            $validatedData = $request->validate([
                'visa_status' => 'required|string',


            ]);

            $form = $customer->forms->first();

            //  dd($form);

            // $pdf = $request->file('web_file_app_id');
            // if ($pdf) {
            //     $image_name = Str::random(20);
            //     $ext = strtolower($pdf->getClientOriginalExtension());
            //     $image_full_name = $image_name . '.' . $ext;
            //     //  $upload_path='public/pdf/';
            //     $upload_path = "uploads/visa-forms/documents/";
            //     $pdf_url = $image_full_name;
            //     $success = $pdf->move($upload_path, $image_full_name);
            // } else {
            //     $pdf_url = $form->web_file_app_id;
            // }

            if ($request->hasFile('web_file_app_id')) {
                $files = $request->file('web_file_app_id');
                $destinationPath = public_path('uploads/visa-forms/documents/');

                if ($files->isValid()) {
                    $extension = $files->getClientOriginalExtension();
                    $originalName = pathinfo($files->getClientOriginalName(), PATHINFO_FILENAME);
                    $pdf_url = $originalName . '-' . uniqid() . '.' . $extension;
                    $files->move($destinationPath, $pdf_url);
                }
            } else {
                $pdf_url = $form->web_file_app_id;
            }



            // $image = $request->file('image');
            // if ($image) {
            //     $image_name = Str::random(20);
            //     $ext = strtolower($image->getClientOriginalExtension());
            //     $image_full_name = $image_name . '.' . $ext;
            //     $upload_path = 'public/images/';
            //     $image_url = $upload_path . $image_full_name;
            //     $success = $image->move($upload_path, $image_full_name);
            // } else {
            //     $image_url = $form->image;
            // }

            if ($request->hasFile('image')) {
                $files = $request->file('image');
                $destinationPath = public_path('uploads/visa-forms/documents/');

                if ($files->isValid()) {
                    $extension = $files->getClientOriginalExtension();
                    $originalName = pathinfo($files->getClientOriginalName(), PATHINFO_FILENAME);
                    $image_url = $originalName . '-' . uniqid() . '.' . $extension;
                    $files->move($destinationPath, $image_url);
                }
            } else {
                $image_url = $form->image;
            }


            if ($form) {
                $form->update([
                    'visa_status' => $validatedData['visa_status'],
                    'note' => $request->note,
                    'type_remarks1' => $request->type_remarks1,
                    'application_id' => $request->application_id,
                    'web_file_app_id' => $pdf_url,
                    'type_remarks2' => $request->type_remarks2,
                    'image' => $image_url,
                ]);

                logActivity(
                    (Auth::user()->name . " updated a customer's visa status."),
                    $form->id,
                    'updated',
                    'visa_forms'
                );

                return redirect()->route('admin.customers.show', $customer->id)
                    ->with('success', 'Visa status updated successfully');
            }

            return redirect()->route('admin.customers.show', $customer->id)
                ->with('error', 'No associated form found');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function updateDocumentStatus(Request $request, $customerId, $formId, $documentId): JsonResponse|RedirectResponse
    {
        try {
            $this->authorize('update', CustomerController::class);
            $document = Document::find($documentId);

            if (!$document) {
                return response()->json(['error' => 'Document not found'], 404);
            }

            $document->update([
                'status' => $request->status,
            ]);

            logActivity(
                (Auth::user()->name . " updated a customer's document status."),
                $document->id,
                'updated',
                'documents'
            );

            return response()->json([
                'document_id' => $documentId,
                'status' => $document->status,
                'message' => 'Document status updated!',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ]);
        }
    }

    // print
    public function print($docs)
    {
        // $file = public_path('uploads/visa-forms/documents/' . $docs);
        // $headers = array(
        //     'Content-Type' => 'application/pdf',
        // );
        // return Response::download($file, $docs, $headers);
        view('backend.customer.print', compact('docs'));
        return redirect()->back();
    }


    public function search_active($id)
    {
        $customer = Customer::find($id);
        if ($customer->search_active == 1) {
            $customer->search_active = 0;
            $customer->save();
            return redirect()->back();
        }else{
            $customer->search_active = 1;
            $customer->save();
            return redirect()->back();
        }
    }



    public function documentuploadadmin($id)
    {
        $customer_service_type = VisaForm::where('customer_id', $id)->first();
      
        $customer_visa = VisaType::find($customer_service_type->visa_type_id);
        
        $documents = $customer_visa->required_documents;
       
        $customer_form_id = $customer_service_type->id;
       
        $customer_id = $id;
        return view('backend.customer.file-upload', compact('documents', 'customer_form_id', 'customer_id'));
    }


    public function singleDocumentStore(Request $request){
        try {
          
            if ($request->hasFile('doc')) {
                $file = $request->file('doc');
                $destinationPath = public_path('uploads/visa-forms/documents/');
                $titles = $request->input('title');


                if ($file->isValid()) {
                    $extension = $file->getClientOriginalExtension();
                    $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $fileName = $originalName . '-' . uniqid() . '.' . $extension;
                    $file->move($destinationPath, $fileName);

                    Document::create([
                        'form_id' => $request->customer_form_id,
                        'title' => $request->title,
                        'documents' => $fileName,
                        'document_type' => $extension,
                        'status' => "In review..."
                    ]); 
                }
            }
            return redirect()->back()->with('success', 'Document update successfully');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            throw $th;
            
        }
    }

    public function singleDocumentUpdate(Request $request, $id)
    {
        try {
            if ($request->hasFile('doc')) {
                $file = $request->file('doc');
                $destinationPath = public_path('uploads/visa-forms/documents/');
                $titles = $request->input('title');


                if ($file->isValid()) {
                    $extension = $file->getClientOriginalExtension();
                    $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $fileName = $originalName . '-' . uniqid() . '.' . $extension;
                    $file->move($destinationPath, $fileName);

                    $documents = Document::find($id);
                    $documents->update([
                        'form_id' => $request->customer_form_id,
                        'title' => $request->title,
                        'documents' => $fileName,
                        'document_type' => $extension,
                        'status' => "In review..."
                    ]);
                }
            }else{
                return redirect()->back();
            }
            return redirect()->back()->with('success', 'Document update successfully');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            throw $th;
        }
    }
}
