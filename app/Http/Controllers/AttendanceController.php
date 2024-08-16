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

            // Update or create the attendance record
            $attendance = Attendance::updateOrCreate(
                ['user_id' => $user->id, 'date' => $date],
                ['punch_in' => $time]
            );

            return redirect()->back()->with('success', 'Attendance successfully done.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong.');
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

                // Calculate total working hours
                $attendance->total_hour = $attendance->punch_in->diffInHours($attendance->punch_out, false);

                // Calculate late hours
                $lateHour = max(0, $attendance->punch_in->diffInMinutes(now()->setTime(9, 30), false) / 60);
                $attendance->late_hour = $lateHour;

                // Calculate early out hours
                $earlyOutHour = max(0, now()->setTime(17, 30)->diffInMinutes($attendance->punch_out, false) / 60);
                $attendance->early_out_hour = $earlyOutHour;

                // Calculate fines
                $attendance->fine = ($lateHour > 0 ? $lateHour * 50 : 0) + ($earlyOutHour > 0 ? $earlyOutHour * 50 : 0);

                // Determine status
                $attendance->status = $lateHour > 0 ? 'late' : ($earlyOutHour > 0 ? 'early_out' : 'normal');

                $attendance->save();

                return redirect()->back()->with('success', 'Punch out successfully done.');
            } else {
                return redirect()->back()->with('success', 'Attendance record not found.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('success', 'Something went wrong.');
        }
    }


    public function getAttendanceList()
    {
        $attendances = Attendance::where('user_id', auth()->user()->id)->get();
        return response()->json($attendances);
    }

}
