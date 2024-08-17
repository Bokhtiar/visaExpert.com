<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function punchIn(Request $request)
    {
        try {
            $user = auth()->user();
            $date = now()->format('Y-m-d');
            $time = now()->format('H:i:s');

            // Define the threshold time for being late (9:30 AM)
            $lateThreshold = now()->setTime(9, 30);

            // Determine the status based on punch-in time
            $status = now()->greaterThan($lateThreshold) ? 'late' : 'normal';



            // Step 1: Calculate late hours (after 9:30 AM) with seconds precision
            $current = \Carbon\Carbon::parse($time);  // Current punch-in time
            $lateMinutes = max(0, $current->diffInMinutes($lateThreshold, true));
            $lateSeconds = max(0, $current->diffInSeconds($lateThreshold, true) % 60);

            // Convert to hours, minutes, and seconds
            $lateHours = floor($lateMinutes / 60);
            $lateMinutes = $lateMinutes % 60;
            $lateSeconds = round($lateSeconds / 60); // Convert remaining seconds to minutes for rounding

            

            // Update or create the attendance record with status
            $attendance = Attendance::updateOrCreate(
                ['user_id' => $user->id, 'date' => $date],
                [
                    'punch_in' => $time,
                    'status' => $status,
                    'late_hour' => sprintf('%02d:%02d:%02d', $lateHours, $lateMinutes, $lateSeconds)
                ]
            );

            return redirect()->back()->with('success', 'Punch successfully done.');
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

                // Step 1: Calculate late hours (after 9:30 AM) with seconds precision
                $lateMinutes = max(0, $attendance->punch_in->diffInMinutes($lateThreshold, true));
                $lateSeconds = max(0, $attendance->punch_in->diffInSeconds($lateThreshold, true) % 60);

                // Convert to hours, minutes, and seconds
                $lateHours = floor($lateMinutes / 60);
                $lateMinutes = $lateMinutes % 60;
                $lateSeconds = round($lateSeconds / 60); // Convert remaining seconds to minutes for rounding

                $attendance->late_hour = sprintf('%02d:%02d:%02d', $lateHours, $lateMinutes, $lateSeconds);

                // Check if punch-out time is before 5:30 PM
                if ($attendance->punch_out < $earlyOutThreshold) {
                    // Calculate early out time only if punch-out is before 5:30 PM
                    $earlyOutMinutes = abs($earlyOutThreshold->diffInMinutes($attendance->punch_out, false));
                    $earlyOutSeconds = abs($earlyOutThreshold->diffInSeconds($attendance->punch_out, false) % 60);

                    // Convert to hours, minutes, and seconds
                    $earlyOutHours = floor($earlyOutMinutes / 60);  // Calculate full hours
                    $earlyOutMinutes = $earlyOutMinutes % 60;       // Remaining minutes after full hours
                }

                // Format early out time with hours, minutes, and seconds
                $attendance->early_out_hour = sprintf('%02d:%02d:%02d', $earlyOutHours, $earlyOutMinutes, $earlyOutSeconds);

                // Optional: Calculate the fine based on rounded hours
                $lateFine = $lateHours * 50 + ($lateMinutes / 60 * 50);
                $earlyOutFine = $earlyOutHours * 50 + ($earlyOutMinutes / 60 * 50);
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





    public function getAttendanceList()
    {
        $attendances = Attendance::where('user_id', auth()->user()->id)->get();
        return response()->json($attendances);
    }

}
