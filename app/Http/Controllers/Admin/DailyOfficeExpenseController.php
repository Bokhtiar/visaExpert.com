<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DailyOfficeExpense;
use App\Models\Transfer;
use App\Models\User;
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
            'expenses' => DailyOfficeExpense::query()
                ->orderBy('id', 'desc') // Assuming 'id' is the primary key
                ->paginate(10),
        ]);

    }

    public function store(Request $request): RedirectResponse
    {
        $authUser = Auth::id();
        $this->authorize('create', DailyOfficeExpense::class);
        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|string|max:255',
        ]);

        $validated['created_by'] = $authUser;
        $expense = DailyOfficeExpense::create($validated);


        // account balance
        $user = User::find($authUser);
        $user->balance = $user->balance - $request->amount;
        $user->expense = $user->expense + $request->amount;
        $user->save();

        $userBalance = User::find($authUser);
        Transfer::create([
            'type' => 'expense_create',
            'amount' => $request->amount,
            'current_amount' => $userBalance->balance,
            'created_by' => Auth::id(),
            'expense_id' => $expense->id,
        ]);

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
        //$this->authorize('edit', DailyOfficeExpense::class);
        $expenses = DailyOfficeExpense::query()->paginate(10);

        return view('backend.daily-office-expense.index', compact('dailyOfficeExpense', 'expenses'));
    }

    public function update(Request $request, DailyOfficeExpense $dailyOfficeExpense): RedirectResponse
    {
        $authUser = Auth::id();
        //$this->authorize('edit', DailyOfficeExpense::class);
        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'amount' => 'required|string|max:255',
        ]);
        $validated['created_by'] = $authUser;
        $dailyOfficeExpense->update($validated);

        $user = User::find($authUser);
        $user->balance = $user->balance - $request->amount;
        $existBalance =  $user->expense - $dailyOfficeExpense->amount; //this line add for before amount minus, other wish previse expense and new update expese update, thats why this line added
        $user->expense = $existBalance + $request->amount;
        $user->save();

        $userBalance = User::find($authUser);

        $expense_balance = Transfer::where('expense_id', $dailyOfficeExpense->id)->first();
        $expense_balance->update([
            'type' => 'expense_update',
            'amount' => $request->amount,
            'current_amount' => $userBalance->balance,
            'created_by' => Auth::id(),
            'expense_id' => $dailyOfficeExpense->id,
        ]);


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
            $authUser = Auth::id();
            $user = User::find($authUser);
            $user->balance = $user->balance + $dailyOfficeExpense->amount;
            $user->expense = $user->expense - $dailyOfficeExpense->amount;
            $user->save();

            $userBalance = User::find($authUser);

            $expense_balance = Transfer::where('expense_id', $dailyOfficeExpense->id)->first();
            $expense_balance->update([
                'type' => 'expense_update',
                'amount' => $dailyOfficeExpense->amount,
                'current_amount' => $userBalance->balance,
                'created_by' => Auth::id(),
                'expense_id' => $dailyOfficeExpense->id,
            ]);



           // $this->authorize('delete', DailyOfficeExpense::class);
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
