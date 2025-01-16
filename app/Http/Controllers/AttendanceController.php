<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\User;
use App\Models\Room;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    /**
     * Store attendance for a user.
     */
    public function index(){
        $user = auth()->User();
        $rooms = Room::all();
        return view('attendance.index',compact('user','rooms'));
    }
    public function store(Request $request)
    {   
        $request->validate([
            'user' => 'required|exists:users,id', // Ensure user exists
            'attendance_type' => 'required|in:dosen,staff', // Type of attendance (lecturer or staff)
            'clock_in' => 'required|date_format:H:i', // Valid clock-in time
            'room' => 'required|exists:rooms,id',
            
        ]);
        $date = Carbon::today('Asia/Jakarta');

        $attendance_record = Attendance::where('user_id',$request->user)
            ->where('date',$date->format('Y-m-d'))
            ->first();
        
        if($attendance_record){
            $affectedRows = Attendance::where('user_id', $request->user)
                          ->where('date', $date->format('Y-m-d'))
                          ->update(['clock_out' => $request->clock_in]);

            return redirect()->route($request->attendance_type.'.dashboard')->with('message','Attendance already marked updated clock out time');
        }
        $attendance = Attendance::create([
            'user_id' => $request->user,
            'attendance_type' => $request->attendance_type,
            'date' => $date->format('Y-m-d'), // Store today's date
            'clock_in' => $request->clock_in,
            'room' => $request->room,
        ]);
        

        return redirect()->route($request->attendance_type.'.dashboard')->with('message','Attendance marked successfully');
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
