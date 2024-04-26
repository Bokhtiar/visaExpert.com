<?php

namespace App\Http\Controllers;

use App\Http\Requests\Frontend\SearchCustomerFormRequest;
use App\Models\Customer;
use App\Models\VisaForm;
use App\Models\VisaType;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();
        $visaType = VisaType::all();

        return view('frontend.visa-application', compact('user', 'visaType'));
    }

    public function getRequiredDocuments($visaType): JsonResponse
    {
        $requiredDocuments = VisaType::findOrFail($visaType)->getRequiredDocumentsAttributeForFronted();

        return response()->json(['documents' => $requiredDocuments]);
    }

    public function searchCustomerForm(SearchCustomerFormRequest $request)
    {
        $customer_uniqu_id = $request->all();
        $customer = Customer::where('unique_id', $customer_uniqu_id['user_id'])->first();
        
        if ($customer->search_active == 1) {
        $keyword = $request->input('user_id');


        $forms = VisaForm::with(['customer', 'documents', 'invoice', 'visaType'])
            ->whereHas('customer', function ($customer) use ($keyword) {
                $customer->where('unique_id', $keyword);
            })
            ->get();

        return view('frontend.search-result', compact('forms', 'keyword'));
        }else{

             session()->flash('success', "Your are disable, please contact to admin");
             return back();
        }
    }
}
