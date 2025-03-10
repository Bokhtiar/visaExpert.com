<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transfer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transfers = Transfer::latest()
            ->whereIn('type', ['transfer_rejected', 'transfer_recieve', 'balance_transfer_updated', 'balance_transfer'])
            ->where(function ($query) {
                $query->where('recive_id', Auth::id())
                    ->orWhere('created_by', Auth::id());
            })
            ->get();

        return view('backend.transfer.index', compact('transfers'));
    }

    public function statement_all_users()
    {
        $transfers = Transfer::latest()
            ->whereIn('type', ['transfer_rejected', 'transfer_recieve', 'balance_transfer_updated', 'balance_transfer'])
            ->get();

        return view('backend.transfer.all_statement_list', compact('transfers'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users =  User::where('is_deletable', 0)
            ->whereNotIn('id', [Auth::id()])
            ->get();
        return view('backend.transfer.form', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $authUser = Auth::id();
            $validatedData = $request->validate([
                'recive_id' => 'required|exists:users,id',
                'remark' => 'required|string',
                'amount' => 'required|numeric',
                'description' => 'required|string',
            ]);

            $user = User::find($authUser);
            if ($user->balance < $request->amount) {
                return back()->with('error', 'Your balance is less than the requested amount');
            }

            DB::transaction(function () use ($validatedData, $request, $authUser) {


               
               
                // transfer Update account balance
                $user = User::find($authUser);
                $user->balance = $user->balance - $request->amount;
                $user->transfer = $user->transfer + $request->amount;
                $user->save();

                $validatedData['created_by'] = $authUser;
                $validatedData['type'] = 'balance_transfer';
                $validatedData['current_amount'] = $user->balance - $request->amount;
                $invoice = Transfer::create($validatedData);


                // reciver Update account balance
                // $user = User::find($request->recive_id);
                // $user->balance = $user->balance + $request->amount;
                // $user->recive = $user->recive + $request->amount;
                // $user->save();


                logActivity(
                    (Auth::user()->name . ' created a transfer.'),
                    $invoice->id,
                    'created',
                    'transfer'
                );
            });

            return redirect()->route('admin.statement.index')->with('success', 'Transfer successfully');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $show = Transfer::find($id);
        $users =  User::where('is_deletable', 0)
            ->whereNotIn('id', [Auth::id()])
            ->get();
        return view('backend.transfer.show', compact('show', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $edit = Transfer::find($id);
        $users =  User::where('is_deletable', 0)
        ->whereNotIn('id', [Auth::id()])
            ->get();
        return view('backend.transfer.form', compact('edit', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $authUser = Auth::id();
            $validatedData = $request->validate([
                'recive_id' => 'required|exists:users,id',
                'remark' => 'required|string',
                'amount' => 'required|numeric',
                'description' => 'required|string',
            ]);
            

            // Retrieve the authenticated user
            $user = User::find($authUser);
            if (!$user) {
                return back()->with('error', 'Authenticated user not found.');
            }

            // Check if user has enough balance
            if ($user->balance < $request->amount) {
                return back()->with('error', 'Your balance is less than the requested amount');
            }

            DB::transaction(function () use ($validatedData, $request, $authUser, $id) {
                // Find the transfer to update
                $transfer = Transfer::find($id);
                if (!$transfer) {
                    throw new \Exception('Transfer record not found.');
                }

                // Retrieve the original transfer amount
                $originalAmount = $transfer->amount;

                // Update the transfer with validated data
                

                // Update user's balance
                $user = User::find($authUser);
                $user->balance += $originalAmount; // Revert the original transfer amount
                $user->balance -= $request->amount; // Deduct the new transfer amount
                $user->transfer = ($user->transfer - $originalAmount) + $request->amount; // Adjust the transfer amount
                $user->save();


                $user_balance = User::find($authUser);
                $validatedData['type'] = 'balance_transfer_updated';
                $validatedData['current_amount'] =  $user_balance->balance;
                $transfer->update($validatedData);

                // Log the activity
                logActivity(
                    (Auth::user()->name . ' updated transfer.'),
                    $id,
                    'updated',
                    'transfer'
                );
            });

            return redirect()->route('admin.transfer.index')->with('success', 'Transfer updated successfully');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::transaction(function () use ($id) {
                // Find the transfer record
                $transfer = Transfer::find($id);

                if (!$transfer) {
                    throw new \Exception('Transfer record not found.');
                }

                // Retrieve the authenticated user
                $user = User::find(Auth::id());

                if (!$user) {
                    throw new \Exception('Authenticated user not found.');
                }

                // Revert the original transfer amount to the user's balance
                $user->balance += $transfer->amount;
                $user->transfer -= $transfer->amount;
                $user->save();

                // Delete the transfer record
                $transfer->delete();

                // Log the activity
                logActivity(
                    (Auth::user()->name . ' deleted a transfer.'),
                    $id,
                    'deleted',
                    'transfer'
                );
            });

            return redirect()->route('admin.transfer.index')->with('success', 'Transfer deleted successfully');
        } catch (\Throwable $th) {
            // Log the error
            return back()->with('error', $th->getMessage());
        }

    }
}
