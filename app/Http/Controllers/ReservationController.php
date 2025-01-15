<?php

// app/Http/Controllers/ReservationController.php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\InventoryItem;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ReservationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Admin, Dosen and Staff can reserve rooms and inventory
    public function createReservation(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'inventory_item_id' => 'nullable|exists:inventory_items,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        $reservation = new Reservation();
        $reservation->user_id = auth()->id();
        $reservation->room_id = $request->room_id;
        $reservation->inventory_item_id = $request->inventory_item_id;
        $reservation->start_time = $request->start_time;
        $reservation->end_time = $request->end_time;
        $reservation->save();

        return redirect()->back()->with('success', 'Reservation created successfully!');
    }
}

