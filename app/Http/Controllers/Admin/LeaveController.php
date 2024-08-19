<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Leave;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    public function index()
    {
      
        $month = Carbon::now()->month;
        $year = Carbon::now()->year;
        
        $leaves = Leave::whereMonth('leave_date', $month)
            ->whereYear('leave_date', $year)
            ->orderBy('leave_date', 'asc')
            ->get();

        return view('backend.leave.index', compact('leaves','month', 'year'));
    }

    public function create()
    {
        return view('backend.leave.form');
    }

    public function store(Request $request)
    {


    
        $request->validate([
            'leave_date' => 'required|date',
            'leave_type' => 'required|string',
            'reason' => 'nullable|string',
        ]);

        $userId = Auth::id();
        $leaveDate = $request->input('leave_date');

        // Check if a leave already exists for the same user on the same date
        $existingLeave = Leave::where('user_id', $userId)
        ->where('leave_date', $leaveDate)
        ->first();

        if ($existingLeave) {
            return redirect()->route('admin.leave.index')
            ->with('error', 'You have already applied for leave on this date.');
        }


        
        // Include the authenticated user's ID in the request data
        $data = $request->all();
        $data['user_id'] = Auth::id();

        // Create the leave record with the user ID
        Leave::create($data);
        return redirect()->route('admin.leave.index')->with('success', 'Leave applied successfully.');
    }

    public function edit(Leave $leave)
    {
        $edit = $leave;
        return view('backend.leave.form', compact('edit'));
    }

    public function update(Request $request, Leave $leave)
    {
        $request->validate([
           
            'leave_date' => 'required|date',
            'leave_type' => 'required|string',
            'reason' => 'nullable|string',
        ]);

        $userId = Auth::id();
        $leaveDate = $request->input('leave_date');

        // Check if a leave already exists for the same user on the same date
        if ($leaveDate !== $leave->leave_date) {
            $existingLeave = Leave::where('user_id', $userId)
            ->where('leave_date', $leaveDate)
            ->first();

            if ($existingLeave) {
                return redirect()->route('admin.leave.index')
                ->with('error', 'You have already applied for leave on this date.');
            }
        }
        



        // Include the authenticated user's ID in the request data
        $data = $request->all();
        $data['user_id'] = $userId;

        // Update the leave record with the user ID
        $leave->update($data);

        return redirect()->route('admin.leave.index')->with('success', 'Leave updated successfully.');
    }

    public function destroy(Leave $leave)
    {
        $leave->delete();

        return redirect()->route('admin.leave.index')->with('success', 'Leave deleted successfully.');
    }

    public function leave_filter(Request $request)
    {
        // Get the selected month and year, default to current month and year
        $month = $request->input('month', date('m'));
        $year = $request->input('year', date('Y'));
        

        // Define the start and end dates for the selected month and year
        $firstDayOfMonth = Carbon::createFromDate($year, $month, 1)->startOfMonth()->format('Y-m-d');
        $lastDayOfMonth = Carbon::createFromDate($year, $month, 1)->endOfMonth()->format('Y-m-d');

        // Fetch leaves for the selected user within the date range
        $leaves = Leave::whereBetween('leave_date', [$firstDayOfMonth, $lastDayOfMonth])
            ->orderBy('leave_date', 'asc')
            ->get();

        return view('backend.leave.index', compact('leaves', 'month', 'year'));
    }

}
