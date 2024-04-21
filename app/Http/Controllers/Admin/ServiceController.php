<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function index(): View
    {
        $this->authorize('viewAny', Service::class);

        return view('backend.service.index', [
            'services' => Service::all(),
        ]);
    }

    public function create(): View
    {
        $this->authorize('create', Service::class);

        return view('backend.service.form');
    }

    public function edit(Service $service): View
    {
        $this->authorize('update', Service::class);

        return view('backend.service.form', compact('service'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->authorize('create', Service::class);
        $validated = $request->validate([
            'title' => 'required|string|unique:services',
            'agent_amount' => 'nullable|string|max:255',
            'customer_amount' => 'nullable|string|max:255',
        ]);

        $service = Service::create($validated);

        logActivity(
            (Auth::user()->name.' added a service type.'),
            $service->id,
            'created',
            'services'
        );

        return redirect()->route('admin.services.index')->with('success', 'Services Created Successfully!');
    }

    public function update(Request $request, Service $service): RedirectResponse
    {
        $this->authorize('update', Service::class);
        $validated = $request->validate([
            'title' => 'required|string|unique:services,title,'.$service->id,
            'agent_amount' => 'nullable|string|max:255',
            'customer_amount' => 'nullable|string|max:255',
        ]);

        $service->update($validated);

        logActivity(
            (Auth::user()->name.' updated a service.'),
            $service->id,
            'updated',
            'services'
        );

        return redirect()->route('admin.services.index')->with('success', 'Services Updated successfully.');
    }

    public function destroy(Service $service): RedirectResponse
    {
        try {
            $this->authorize('delete', Service::class);
            $service->delete();

            logActivity(
                (Auth::user()->name.' deleted a service.'),
                $service->id,
                'deleted',
                'services'
            );

            return redirect()->back()->with('success', 'Services Deleted successfully.');
        } catch (Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}
