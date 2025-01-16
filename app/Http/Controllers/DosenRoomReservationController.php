<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DosenRoomReservationController extends Controller
{
    // Show available rooms for reservation
    public function index()
    {
        $rooms = Room::where('available', true)->get(); // Fetch only available rooms

        return view('pages.dosen.room-reservations.index', compact('rooms'));
    }

    // Store a new reservation
    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'start_time' => 'required|date|after_or_equal:now',
            'end_time' => 'required|date|after:start_time',
        ]);

        // Create a reservation
        Reservation::create([
            'user_id' => Auth::id(),
            'reservable_type' => \App\Models\Room::class,
            'reservable_id' => $request->room_id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'status' => 'pending',
        ]);

        return redirect()->route('dosen.room-reservations.index')->with('success', 'Reservation made successfully.');
    }
}
