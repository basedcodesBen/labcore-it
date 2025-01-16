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
    public function index(){
        $user = auth()->User();
        return view('attendance.index',compact('user'));
    }
    public function store(Request $request)
    {   
        $request->validate([
            'user' => 'required|exists:users,id', // Ensure user exists
            'attendance_type' => 'required|in:lecturer,staff', // Type of attendance (lecturer or staff)
            'clock_in' => 'required|date_format:H:i', // Valid clock-in time
        ]);
        $date = Carbon::today('Asia/Jakarta');
        // Store clock-in time
        $attendance = Attendance::create([
            'user_id' => $request->user,
            'attendance_type' => $request->type,
            'date' => $date->format('Y-m-d'), // Store today's date
            'clock_in' => $request->clock_in,
        ]);

        return redirect()->route('staff.dashboard')->with('message','Attendance marked successfully');
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
