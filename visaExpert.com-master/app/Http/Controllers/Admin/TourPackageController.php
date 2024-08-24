<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TourPackage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TourPackageController extends Controller
{
    public function index(): View
    {
        $this->authorize('viewAny', TourPackage::class);

        return view('backend.tour-package.index', [
            'packages' => TourPackage::query()->paginate(10),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $this->authorize('create', TourPackage::class);
        $validated = $request->validate([
            'name' => 'required|string',
            'place_name' => 'required|string|max:255',
            'journey_date' => 'required|date',
        ]);

        $tourPackage = TourPackage::create($validated);

        logActivity(
            (Auth::user()->name.' created a tour package.'),
            $tourPackage->id,
            'created',
            'tour_packages'
        );

        return redirect()->back()->with('success', 'Tour Package created successfully.');
    }

    public function edit(TourPackage $tourPackage): View
    {
        $this->authorize('update', $tourPackage);
        $packages = TourPackage::query()->paginate(10);

        return view('backend.tour-package.index', compact('tourPackage', 'packages'));
    }

    public function update(Request $request, TourPackage $tourPackage): RedirectResponse
    {
        $this->authorize('update', TourPackage::class);
        $validated = $request->validate([
            'name' => 'required|string',
            'place_name' => 'required|string|max:255',
            'journey_date' => 'required|date',
        ]);

        $tourPackage->update($validated);

        logActivity(
            (Auth::user()->name.' updated a tour package.'),
            $tourPackage->id,
            'updated',
            'tour_packages'
        );

        return redirect()->route('admin.tour-packages.index')->with('success', 'Tour Package updated successfully.');
    }

    public function destroy(TourPackage $tourPackage): RedirectResponse
    {
        try {
            $this->authorize('delete', TourPackage::class);
            $tourPackage->delete();

            logActivity(
                (Auth::user()->name.' deleted a tour package.'),
                $tourPackage->id,
                'deleted',
                'tour_packages'
            );

            return redirect()->back()->with('success', 'Tour Package deleted successfully.');

        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }
}
