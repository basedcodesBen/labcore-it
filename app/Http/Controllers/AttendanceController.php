<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    /**
     * Store attendance for a user.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id', // Ensure user exists
            'type' => 'required|in:lecturer,staff', // Type of attendance (lecturer or staff)
            'clock_in' => 'required|date_format:H:i', // Valid clock-in time
        ]);

        // Store clock-in time
        $attendance = Attendance::create([
            'user_id' => $request->user_id,
            'type' => $request->type,
            'date' => Carbon::today(), // Store today's date
            'clock_in' => $request->clock_in,
        ]);

        return response()->json([
            'message' => 'Attendance marked successfully',
            'attendance' => $attendance
        ]);
    }

    /**
     * Store clock-out time for a user.
     */
    public function clockOut(Request $request, $attendanceId)
    {
        $request->validate([
            'clock_out' => 'required|date_format:H:i', // Valid clock-out time
        ]);

        $attendance = Attendance::findOrFail($attendanceId);
        
        if ($attendance->clock_out !== null) {
            return response()->json(['message' => 'User has already clocked out.'], 400);
        }

        // Update clock-out time
        $attendance->update([
            'clock_out' => $request->clock_out
        ]);

        return response()->json([
            'message' => 'Clock-out time recorded successfully',
            'attendance' => $attendance
        ]);
    }

    /**
     * View attendance records for a user (Lecturer/Staff).
     */
    public function show($userId)
    {
        $user = User::findOrFail($userId);

        $attendances = $user->attendances()->whereDate('date', Carbon::today())->get();

        return response()->json([
            'user' => $user,
            'attendances' => $attendances
        ]);
    }
}
