<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisaForm;
use App\Models\VisaType;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PgSql\Lob;

class VisaTypeController extends Controller
{
    public function index(): View
    {
        $this->authorize('index', VisaType::class);
       $visaTypes = VisaType::query()->paginate(10);
       // $visaTypes = VisaType::all();
        
        //dd($visaTypes);

        return view('backend.visa-type.index', compact('visaTypes'));

    }

    public function create(): View
    {
        $this->authorize('create', VisaType::class);
        return view('backend.visa-type.form');
    }

    public function store(Request $request): RedirectResponse
    {
        
        $this->authorize('create', VisaType::class);
        $requiredDocuments = explode(', ', $request->input('required_documents'));
        $visaType = VisaType::create([
            'title' => $request->title,
            'required_documents' => json_encode(array_map('trim', $requiredDocuments)),
            'is_admin' => $request->is_admin,
            'is_user' => $request->is_user
        ]);

        logActivity(
            (Auth::user()->name.' created a visa type.'),
            $visaType->id,
            'created',
            'visa_types'
        );

        return redirect()->back()->with('success', 'Created successfully.');
    }

    public function edit(VisaType $visaType): View
    {
        $this->authorize('update', VisaType::class);

        return view('backend.visa-type.form', compact('visaType'));
    }

    public function update(Request $request, VisaType $visaType): RedirectResponse
    {
        $this->authorize('update', VisaType::class);
        $requiredDocuments = explode(', ', $request->input('required_documents'));

        $visaType->update([
            'title' => $request->get('title'),
            'required_documents' => json_encode($requiredDocuments),
            'is_admin' => $request->is_admin,
            'is_user' => $request->is_user
        ]);

        logActivity(
            (Auth::user()->name.' updated a visa type.'),
            $visaType->id,
            'updated',
            'visa_types'
        );

        return redirect()->route('admin.visa-types.index')->with('success', 'Updated successfully.');
    }

    public function destroy(VisaType $visaType): RedirectResponse
    {
        try {
            $this->authorize('delete', VisaType::class);
            $visaType->delete();

            logActivity(
                (Auth::user()->name.' deleted a visa type.'),
                $visaType->id,
                'deleted',
                'visa_types'
            );

            return redirect()->back()->with('success', 'Deleted successfully.');
        } catch (Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function is_admin($id): RedirectResponse
    {
        try {
            $visaTypeStatus = VisaType::findOrFail($id);
            $visaTypeStatus->is_admin = $visaTypeStatus->is_admin == 1 ? 0 : 1;
            $visaTypeStatus->save();
            return redirect()->back()->with('success', 'Process updated successfully.');
        } catch (Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }



    public function is_user($id): RedirectResponse
    {
        try {
            $visaTypeStatus = VisaType::findOrFail($id);
            $visaTypeStatus->is_user = $visaTypeStatus->is_user == 1 ? 0 : 1;
            $visaTypeStatus->save();
            return redirect()->back()->with('success', 'Process updated successfully.');
        } catch (Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }


    // public function updateVisaStatus(Request $request, $id)
    // {
       
    //     $customer = VisaForm::where('customer_id', $id)->first();
    //     $customer->visa_status = $request->input('visa_status');
    //     $customer->save();

    //     // Return the updated status
    //     // return response()->json(['new_status' => displayVisaStatusBadge($customer->visa_status)]);
    //     return response()->json(['new_status' => $customer]);

    // }

    public function updateVisaStatus(Request $request, $customerId)
    {
        // Validate and update the status
        $request->validate([
            'visa_status' => 'required|string',
        ]);

        $customer = VisaForm::where('customer_id', $customerId)->first();
        $customer->visa_status = $request->visa_status;
        $customer->save();

        // Generate the status badge HTML
        $statusBadge = displayVisaStatusBadge($customer->visa_status);

        return response()->json([
            'statusBadge' => $statusBadge,
        ]);
    }


    
}
