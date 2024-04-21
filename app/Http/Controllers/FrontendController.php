<?php

namespace App\Http\Controllers;

use App\Http\Requests\Frontend\SearchCustomerFormRequest;
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

    public function searchCustomerForm(SearchCustomerFormRequest $request): View
    {
        $keyword = $request->input('user_id');


        $forms = VisaForm::with(['customer', 'documents', 'invoice', 'visaType'])
            ->whereHas('customer', function ($customer) use ($keyword) {
                $customer->where('unique_id', $keyword);
            })
            ->get();

        return view('frontend.search-result', compact('forms', 'keyword'));
    }
}
