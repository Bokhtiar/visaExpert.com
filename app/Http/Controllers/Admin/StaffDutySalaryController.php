<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StaffDutySalaryRequest;
use App\Models\StaffDutySalary;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffDutySalaryController extends Controller
{
    public function index(): View
    {
        $this->authorize('viewAny', StaffDutySalary::class);

        return view('backend.staff-duty-salary.index', [
            'staffDutySalaries' => StaffDutySalary::query()->paginate(10),
        ]);
    }

    public function store(StaffDutySalaryRequest $request): RedirectResponse
    {
        $this->authorize('create', StaffDutySalary::class);
        $staffDuty = StaffDutySalary::create([
            'name' => $request->name,
            'duty_finger_in' => $request->duty_finger_in,
        ]);

        logActivity(
            (Auth::user()->name.' added an office duty.'),
            $staffDuty->id,
            'created',
            'staff_duty_salaries'
        );

        return redirect()->back()->with('success', 'A duty time added.');
    }

    public function edit(StaffDutySalary $staffDutySalary): View
    {
        $this->authorize('edit', StaffDutySalary::class);
        $staffDutySalaries = StaffDutySalary::query()->paginate(10);

        return view('backend.staff-duty-salary.index', compact('staffDutySalary', 'staffDutySalaries'));
    }

    public function update(Request $request, StaffDutySalary $staffDutySalary): RedirectResponse
    {
        $this->authorize('edit', StaffDutySalary::class);
        $staffDutySalary->update([
            'name' => $request->name,
            'duty_finger_in' => $request->duty_finger_in,
            'duty_finger_out' => $request->duty_finger_out,
        ]);

        logActivity(
            (Auth::user()->name.' updated the office duty.'),
            $staffDutySalary->id,
            'updated',
            'staff_duty_salaries'
        );

        return redirect()->route('admin.staff-duty-salaries.index')->with('success', 'A duty time updated.');

    }
}
