<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DailyOfficeExpense;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DailyOfficeExpenseController extends Controller
{
    public function index(): View
    {
        $this->authorize('viewAny', DailyOfficeExpense::class);

        return view('backend.daily-office-expense.index', [
            'expenses' => DailyOfficeExpense::query()->paginate(10),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $this->authorize('create', DailyOfficeExpense::class);
        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|string|max:255',
        ]);

        $expense = DailyOfficeExpense::create($validated);

        logActivity(
            (Auth::user()->name.' added an office expense.'),
            $expense->id,
            'created',
            'daily_office_expenses'
        );

        return redirect()->back()->with('success', 'An Office expense added.');
    }

    public function edit(DailyOfficeExpense $dailyOfficeExpense): View
    {
        $this->authorize('edit', DailyOfficeExpense::class);
        $expenses = DailyOfficeExpense::query()->paginate(10);

        return view('backend.daily-office-expense.index', compact('dailyOfficeExpense', 'expenses'));
    }

    public function update(Request $request, DailyOfficeExpense $dailyOfficeExpense): RedirectResponse
    {
        $this->authorize('edit', DailyOfficeExpense::class);
        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|string|max:255',
        ]);

        $dailyOfficeExpense->update($validated);

        logActivity(
            (Auth::user()->name.' updated an office expense.'),
            $dailyOfficeExpense->id,
            'updated',
            'daily_office_expenses'
        );

        return redirect()->route('admin.daily-office-expenses.index')->with('success', 'An office expense updated.');
    }

    public function destroy(DailyOfficeExpense $dailyOfficeExpense): RedirectResponse
    {
        try {
            $this->authorize('delete', DailyOfficeExpense::class);
            $dailyOfficeExpense->delete();

            logActivity(
                (Auth::user()->name.' deleted an office expense.'),
                $dailyOfficeExpense->id,
                'deleted',
                'daily_office_expenses'
            );

            return redirect()->back()->with('success', 'An office expense deleted.');

        } catch (Exception $e) {

            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }
}
