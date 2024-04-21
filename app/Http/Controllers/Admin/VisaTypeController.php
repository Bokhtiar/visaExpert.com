<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisaType;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
