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
        $transfers = Transfer::where('created_by', Auth::id())->latest()->get();
        return view('backend.transfer.index', compact('transfers'));
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


                $validatedData['created_by'] = $authUser;
                $invoice = Transfer::create($validatedData);

                // transfer Update account balance
                $user = User::find($authUser);
                $user->balance = $user->balance - $request->amount;
                $user->transfer = $user->transfer + $request->amount;
                $user->save();


                // reciver Update account balance
                $user = User::find($request->recive_id);
                $user->balance = $user->balance + $request->amount;
                $user->recive = $user->recive + $request->amount;
                $user->save();


                logActivity(
                    (Auth::user()->name . ' created a transfer.'),
                    $invoice->id,
                    'created',
                    'transfer'
                );
            });

            return back()->with('success', 'Transfer successfully');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
