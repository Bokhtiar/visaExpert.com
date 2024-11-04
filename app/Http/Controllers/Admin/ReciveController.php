<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transfer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReciveController extends Controller
{
    public function index()
    {
        $transfers = Transfer::where('recive_id', Auth::id())->latest()->get();
        return view('backend.transfer.recive', compact('transfers'));
    }

    public function approved($id)
    {
        DB::beginTransaction();

        try {
            $user = User::find(Auth::id());
            $transfer = Transfer::find($id);

            if (!$user) {
                return redirect()->back()->with('error', 'Authenticated user not found');
            }

            if (!$transfer) {
                return redirect()->back()->with('error', 'Transfer not found');
            }

            // Receive money
            $user->balance += $transfer->amount;
            $user->recive += $transfer->amount;
            $user->save();

            // Update transfer status
            $transfer->status = 'Approved';
            $transfer->save();


            //balance log table transfer
            $userBalance = User::find(Auth::id());
            Transfer::create([
                'type' => 'transfer_recieve',
                'amount' => $transfer->amount,
                'current_amount' => $userBalance->balance,
                'created_by' => $transfer->created_by,
                'recive_id' => $transfer->recive_id,
            ]);

            // Log activity
            logActivity(
                Auth::user()->name . ' approved a transfer.',
                $id,
                'approved',
                'transfer'
            );

            DB::commit();

            return redirect()->back()->with('success', 'Balance received successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }

       
    }

    public function rejected($id)
    {
        DB::beginTransaction();

        try {
            $transfer = Transfer::find($id);
            $user = User::find($transfer->created_by);

            $user->balance += $transfer->amount;
            $user->transfer -= $transfer->amount;
            $user->save();


            $userBalance = User::find(Auth::id());
            Transfer::create([
                'type' => 'transfer_rejected',
                'amount' => $transfer->amount,
                'current_amount' => $userBalance->balance,
                'created_by' => $transfer->created_by,
                'recive_id' => $transfer->recive_id,
            ]);



            // Log activity
            logActivity(
                Auth::user()->name . ' approved a transfer.',
                $id,
                'approved',
                'transfer'
            );

            DB::commit();
 
            return redirect()->back()->with('success', 'Balance Rejected successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }


    // public function statement()
    // {


    //     $transfers = Transfer::latest()->get();
    //     return view('backend.transfer.statement', compact('transfers'));
    // } 


    public function statement(Request $request)
    {
        // Get the current month and year if no filter is provided
        $selectedMonth = $request->input('month', Carbon::now()->month);
        $selectedYear = $request->input('year', Carbon::now()->year);

        // Query transfers based on the provided or default month and year
        $transfers = Transfer::whereYear('created_at', $selectedYear)
            ->whereMonth('created_at', $selectedMonth)
            ->latest()
            ->get();
        
        return view('backend.transfer.statement', compact('transfers', 'selectedMonth', 'selectedYear'));
    }



}
