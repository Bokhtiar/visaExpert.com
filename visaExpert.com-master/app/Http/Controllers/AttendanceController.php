<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Holiday;
use App\Models\Leave;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index()
    {
        // Get the current user
        $user = auth()->user();

        // Get today's date
        $date = Carbon::now()->format('Y-m-d');
        $user = Auth::user()->is_admin;

        if ($user == 1) {
            // Fetch the attendance records for the current user for date
            $attendances = Attendance::whereDate('date', $date)
                ->orderBy('date', 'asc')
                ->get();
        }else{
            // Fetch the attendance records for the current user for date
            $attendances = Attendance::where('user_id', $user->id)
                ->whereDate('date', $date)
                ->orderBy('date', 'asc')
                ->get();
        }
        $users = User::all(); 
        

        // Pass data to the view
        return view('backend.attendance.show', compact('attendances', 'users', 'date'));
    }

    public function day_filter(Request $request)
    {
        // Get the current user
        $user = auth()->user();

        // Get today's date
        $date = $request->day;
        $user = Auth::user()->is_admin;

        if ($user == 1) {
            // Fetch the attendance records for the current user for date
            $attendances = Attendance::whereDate('date', $date)
                ->orderBy('date', 'asc')
                ->get();
        } else {
            // Fetch the attendance records for the current user for date
            $attendances = Attendance::where('user_id', $user->id)
                ->whereDate('date', $date)
                ->orderBy('date', 'asc')
                ->get();
        }
        $users = User::all();


        // Pass data to the view
        return view('backend.attendance.show', compact('attendances', 'users', 'date'));
    }

    public function punchIn(Request $request)
    {
        try {
            $user = auth()->user();
            $date = now()->format('Y-m-d');
            $time = now()->format('H:i:s');

            // // Define the cutoff time for punch-in (5:30 PM)
            $punchInCutoff = now()->setTime(17, 30); // 5:30 PM

            // Check if the current time is after 5:30 PM
            if (now()->greaterThan($punchInCutoff)) {
                return redirect()->back()->with('error', 'Punch-in is not allowed after 5:30 PM.');
            }

            // Define the threshold time for being late (9:30 AM)
            $lateThreshold = now()->setTime(9, 30);

            // Determine the status based on punch-in time
            $status = now()->greaterThan($lateThreshold) ? 'late' : 'normal';

            // Step 1: Calculate late hours (only if punch-in time is after 9:30 AM)
            $lateHours = 0;
            $lateMinutes = 0;
            $lateSeconds = 0;

            if (now()->greaterThan($lateThreshold)) {
                $current = \Carbon\Carbon::parse($time);  // Current punch-in time
                $lateMinutes = max(0, $current->diffInMinutes($lateThreshold, true));
                $lateSeconds = max(0, $current->diffInSeconds($lateThreshold, true) % 60);

                // Convert to hours, minutes, and seconds
                $lateHours = floor($lateMinutes / 60);
                $lateMinutes = $lateMinutes % 60;
                $lateSeconds = round($lateSeconds / 60); // Convert remaining seconds to minutes for rounding
            }

            // Update or create the attendance record with status
            $attendance = Attendance::updateOrCreate(
                ['user_id' => $user->id, 'date' => $date],
                [
                    'punch_in' => $time,
                    'status' => $status,
                    'late_hour' => sprintf('%02d:%02d:%02d', $lateHours, $lateMinutes, $lateSeconds)
                ]
            );

            return redirect()->back()->with('success', 'Punch-in successfully done.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }




    public function punchOut(Request $request)
    {
        try {
            $user = auth()->user();
            $date = now()->format('Y-m-d');
            $time = now()->format('H:i:s');

            // Find the attendance record for the current user and date
            $attendance = Attendance::where('user_id', $user->id)->where('date', $date)->first();

            if ($attendance) {
                $attendance->punch_out = $time;

                // Define the threshold times
                $lateThreshold = now()->setTime(9, 30);   // 9:30 AM
                $earlyOutThreshold = now()->setTime(17, 30);  // 5:30 PM

                // Initialize variables
                $earlyOutHours = 0;
                $earlyOutMinutes = 0;
                $earlyOutSeconds = 0;

                // // Step 1: Calculate late hours (after 9:30 AM) with seconds precision
                // $lateMinutes = max(0, $attendance->punch_in->diffInMinutes($lateThreshold, true));
                // $lateSeconds = max(0, $attendance->punch_in->diffInSeconds($lateThreshold, true) % 60);

                // // Convert to hours, minutes, and seconds
                // $lateHours = floor($lateMinutes / 60);
                // $lateMinutes = $lateMinutes % 60;
                // $lateSeconds = round($lateSeconds / 60); // Convert remaining seconds to minutes for rounding

                // $attendance->late_hour = sprintf('%02d:%02d:%02d', $lateHours, $lateMinutes, $lateSeconds);

                // Check if punch-out time is before 5:30 PM
                if ($attendance->punch_out <= $earlyOutThreshold) {
                    // Calculate early out time only if punch-out is before 5:30 PM
                    $earlyOutMinutes = abs($earlyOutThreshold->diffInMinutes($attendance->punch_out, false));
                    $earlyOutSeconds = abs($earlyOutThreshold->diffInSeconds($attendance->punch_out, false) % 60);

                    // Convert to hours, minutes, and seconds
                    $earlyOutHours = floor($earlyOutMinutes / 60);  // Calculate full hours
                    $earlyOutMinutes = $earlyOutMinutes % 60;       // Remaining minutes after full hours
                }

                // Format early out time with hours, minutes, and seconds
                $attendance->early_out_hour = sprintf('%02d:%02d:%02d', $earlyOutHours, $earlyOutMinutes, $earlyOutSeconds);

                // Retrieve the existing late_hour from attendance record
                $lateHourParts = explode(':', $attendance->late_hour);
                $lateHours = (int)$lateHourParts[0];
                $lateMinutes = (int)$lateHourParts[1];
                $lateSeconds = (int)$lateHourParts[2];

                // Optional: Calculate the fine based on late hours and early out hours
                $lateFine = ($lateHours * 50) + ($lateMinutes / 60 * 50);
                $earlyOutFine = $earlyOutHours ?  $earlyOutHours * 50 + ($earlyOutMinutes / 60 * 50): 0;
                $attendance->fine = $lateFine + $earlyOutFine;

                // Calculate total time worked (from punch_in to punch_out)
                $totalSeconds = $attendance->punch_in->diffInSeconds($attendance->punch_out);
                // Convert total seconds to hours, minutes, and seconds
                $totalHours = floor($totalSeconds / 3600); // 3600 seconds in an hour
                $totalMinutes = floor(($totalSeconds % 3600) / 60); // Remaining minutes after extracting hours
                $totalSeconds = $totalSeconds % 60; // Remaining seconds after extracting hours and minutes

                // Format total hours, minutes, and seconds
                $totalHour = sprintf('%02d:%02d:%02d', $totalHours, $totalMinutes, $totalSeconds);

                $attendance->total_hour = $totalHour;

                // Determine status based on late or early out
                if ($lateHours > 0 || $lateMinutes > 0 || $lateSeconds > 0) {
                    $attendance->status = 'late';
                } elseif ($earlyOutHours > 0 || $earlyOutMinutes > 0 || $earlyOutSeconds > 0) {
                    $attendance->status = 'early_out';
                } else {
                    $attendance->status = 'normal';
                }

                $attendance->save();

                return redirect()->back()->with('success', 'Punch out successfully done.');
            } else {
                return redirect()->back()->with('error', 'Attendance record not found.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }


    /** fine cancel */
    public function fineCancel(Request $request, $id)
    {
        $attendance = Attendance::find($id);
        $attendance->fine = $request->fine;
        $attendance->save();
        return redirect()->back()->with('success', 'Attendance fine update.');
    }



    public function filter(Request $request)
    {
        $month = $request->input('month', date('m'));
        $year = $request->input('year', date('Y'));
        $userId = $request->input('user_id');

        $firstDayOfMonth = Carbon::createFromDate($year, $month, 1)->startOfMonth()->format('Y-m-d');
        $lastDayOfMonth = Carbon::createFromDate($year, $month, 1)->endOfMonth()->format('Y-m-d');

        // Fetch holidays, attendances, and leaves for the selected user and date range
        $missHolidays = Holiday::whereMonth('date', $month)
            ->whereYear('date', $year)
            ->orderBy('date', 'asc')
            ->pluck('date')
            ->map(fn($date) => Carbon::parse($date)->format('Y-m-d')) // Ensure date format
            ->toArray();

        $missAttendances = Attendance::where('user_id', $userId)
            ->whereDate('date', '>=', $firstDayOfMonth)
            ->whereDate('date', '<=', $lastDayOfMonth)
            ->pluck('date')
            ->map(fn($date) => Carbon::parse($date)->format('Y-m-d')) // Ensure date format
            ->toArray();

        $missLeaves = Leave::where('user_id', $userId)
            ->whereBetween('date', [$firstDayOfMonth, $lastDayOfMonth])
            ->pluck('date')
            ->map(fn($date) => Carbon::parse($date)->format('Y-m-d')) // Ensure date format
            ->toArray();

        // Determine all dates in the month
        $allDatesInMonth = [];
        $currentDate = Carbon::create($year, $month, 1);
        while ($currentDate->month === (int)$month) {
            $allDatesInMonth[] = $currentDate->format('Y-m-d');
            $currentDate->addDay();
        }
        // Calculate missed dates
        $missedDates = array_diff($allDatesInMonth, array_merge($missAttendances, $missLeaves, $missHolidays));
        // Fetch all users and find the current user
        $users = User::all();
        $findUser = User::find($userId);
        $missedDatesCount = count($missedDates);

        // Get the current date
        $today  = Carbon::create($lastDayOfMonth)->endOfMonth();
        // Get the last day of the current month
        $lastDayOfMonth = $today->copy()->endOfMonth();
        // Get the total number of days in the month
        $monthTotalDay = $lastDayOfMonth->day;
        $deductionPerDay = $findUser->salary /  $monthTotalDay - count($missHolidays); // Fixed deduction per day
        /** end of miss day (no activity) and calculation */
        

        /** attendance conbine marge data */
        // Fetch holidays for the selected month and year
        $holidays = Holiday::whereMonth('date', $month)
            ->whereYear('date', $year)
            ->orderBy('date', 'asc')
            ->get();

        // Fetch attendances for the selected user within the date range
        $attendances = Attendance::where('user_id', $userId)
            ->whereDate('date', '>=', $firstDayOfMonth)
            ->whereDate('date', '<=', $lastDayOfMonth)
            ->orderBy('date', 'asc')
            ->get();

        // Fetch leaves for the selected user within the date range
        $leaves = Leave::where('user_id', $userId)
            ->whereDate('date', '>=', $firstDayOfMonth)
            ->whereDate('date', '<=', $lastDayOfMonth)
            ->where('status', 'approved')
            ->orderBy('date', 'asc')
            ->get();

        // Combine all records and sort by date
        $combinedRecords = $holidays->concat($attendances)->concat($leaves)
            ->unique('date')
            ->sortBy('date');

        // Calculate total fine amount for the user within the selected month
        $totalFine = $attendances->sum('fine');

        return view('backend.attendance.filter', compact('combinedRecords', 'users', 'findUser', 'month', 'year', 'totalFine', 'deductionPerDay', 'missedDatesCount', 'missedDates'));
    }

    /** finecalcelfilter */
    public function fineCancelFilter(Request $request, $id, $month, $user, $year)
    {
        // Update the fine for the attendance record
        $attendance = Attendance::find($id);
        $attendance->fine = $request->fine;
        $attendance->save();


        $month = $month;
        $year = $year;
        $userId = $user;

        $firstDayOfMonth = Carbon::createFromDate($year, $month, 1)->startOfMonth()->format('Y-m-d');
        $lastDayOfMonth = Carbon::createFromDate($year, $month, 1)->endOfMonth()->format('Y-m-d');

        // Fetch holidays, attendances, and leaves for the selected user and date range
        $missHolidays = Holiday::whereMonth('date', $month)
            ->whereYear('date', $year)
            ->orderBy('date', 'asc')
            ->pluck('date')
            ->map(fn($date) => Carbon::parse($date)->format('Y-m-d')) // Ensure date format
            ->toArray();

        $missAttendances = Attendance::where('user_id', $userId)
        ->whereDate('date', '>=', $firstDayOfMonth)
            ->whereDate('date', '<=', $lastDayOfMonth)
            ->pluck('date')
            ->map(fn($date) => Carbon::parse($date)->format('Y-m-d')) // Ensure date format
            ->toArray();

        $missLeaves = Leave::where('user_id', $userId)
            ->whereBetween('date', [$firstDayOfMonth, $lastDayOfMonth])
            ->pluck('date')
            ->map(fn($date) => Carbon::parse($date)->format('Y-m-d')) // Ensure date format
            ->toArray();

        // Determine all dates in the month
        $allDatesInMonth = [];
        $currentDate = Carbon::create($year, $month, 1);
        while ($currentDate->month === (int)$month) {
            $allDatesInMonth[] = $currentDate->format('Y-m-d');
            $currentDate->addDay();
        }
        // Calculate missed dates
        $missedDates = array_diff($allDatesInMonth, array_merge($missAttendances, $missLeaves, $missHolidays));
        // Fetch all users and find the current user
        $users = User::all();
        $findUser = User::find($userId);
        $missedDatesCount = count($missedDates);

        // Get the current date
        $today  = Carbon::create($lastDayOfMonth)->endOfMonth();
        // Get the last day of the current month
        $lastDayOfMonth = $today->copy()->endOfMonth();
        // Get the total number of days in the month
        $monthTotalDay = $lastDayOfMonth->day;
        $deductionPerDay = $findUser->salary /  $monthTotalDay - count($missHolidays); // Fixed deduction per day
        /** end of miss day (no activity) and calculation */


        /** attendance conbine marge data */
        // Fetch holidays for the selected month and year
        $holidays = Holiday::whereMonth('date', $month)
            ->whereYear('date', $year)
            ->orderBy('date', 'asc')
            ->get();

        // Fetch attendances for the selected user within the date range
        $attendances = Attendance::where('user_id', $userId)
            ->whereDate('date', '>=', $firstDayOfMonth)
            ->whereDate('date', '<=', $lastDayOfMonth)
            ->orderBy('date', 'asc')
            ->get();

        // Fetch leaves for the selected user within the date range
        $leaves = Leave::where('user_id', $userId)
            ->whereDate('date', '>=', $firstDayOfMonth)
            ->whereDate('date', '<=', $lastDayOfMonth)
            ->where('status', 'approved')
            ->orderBy('date', 'asc')
            ->get();

        // Combine all records and sort by date
        $combinedRecords = $holidays->concat($attendances)->concat($leaves)
        ->unique('date')
        ->sortBy('date');

        // Calculate total fine amount for the user within the selected month
        $totalFine = $attendances->sum('fine');

        return view('backend.attendance.filter', compact('combinedRecords', 'users', 'findUser', 'month', 'year', 'totalFine', 'deductionPerDay', 'missedDatesCount', 'missedDates'));


        // Return the filtered view
        // return view('backend.attendance.filter', compact('attendances', 'users', 'findUser', 'month', 'year'));
    }


}
