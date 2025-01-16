<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomReservationController extends Controller
{
    public function index()
    {
        // Get all pending reservations for rooms
        $reservations = Reservation::with('reservable') // eager load the reservable (Room or Inventory)
            ->where('status', 'pending')
            ->get();

        return view('pages.staff.room-reservations.index', compact('reservations'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'start_time' => 'required|date|after:now',
            'end_time' => 'required|date|after:start_time',
        ]);

        // Find the room being reserved
        $room = Room::findOrFail($request->room_id);

        // Check if the room is available
        if ($room->available) {
            // Create the reservation
            $reservation = Reservation::create([
                'reservable_type' => Room::class,
                'reservable_id' => $room->id,
                'user_id' => Auth::id(),
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'status' => 'pending', // Default status when created
            ]);

            // After creating the reservation, mark the room as unavailable
            $room->available = false;
            $room->save();

            return redirect()->route('staff.room-reservations.index')->with('success', 'Reservation created successfully!');
        }

        return back()->with('error', 'The room is not available for reservation.');
    }

    public function approve(Reservation $reservation)
    {
        // Only staff can approve the reservation
        if (Auth::user()->role != 'staff') {
            return redirect()->route('staff.room-reservations.index')->with('error', 'You are not authorized to approve this reservation.');
        }

        // Check if reservation exists and is pending
        if ($reservation && $reservation->status === 'pending') {
            // Mark reservation as approved
            $reservation->status = 'approved';
            $reservation->save();

            // Mark the room as unavailable
            $reservation->reservable->update(['available' => false]);

            return redirect()->route('staff.room-reservations.index')->with('success', 'Reservation approved successfully.');
        }

        return redirect()->route('staff.room-reservations.index')->with('error', 'The room is no longer available.');
    }

    public function reject(Reservation $reservation)
    {
        // Only staff can reject the reservation
        if (Auth::user()->role != 'staff') {
            return redirect()->route('staff.room-reservations.index')->with('error', 'You are not authorized to reject this reservation.');
        }

        // Update the reservation status to rejected
        $reservation->status = 'rejected';
        $reservation->save();

        return redirect()->route('staff.room-reservations.index')->with('success', 'Reservation rejected successfully!');
    }
}
