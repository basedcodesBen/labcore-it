<?php

namespace App\Http\Controllers;

use App\Models\InventoryItem;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DosenInventoryReservationController extends Controller
{
    // Show the form for creating a new inventory reservation
    public function create()
    {
        // Get only available inventory items
        $inventoryItems = InventoryItem::where('available', true)->get();

        return view('pages.dosen.inventory-reservations.create', compact('inventoryItems'));
    }

    // Store a newly created inventory reservation in the database
    public function store(Request $request)
    {
        $request->validate([
            'inventory_item_id' => 'required|exists:inventory_items,id', // Ensure valid inventory item
            'start_time' => 'required|date|after_or_equal:today', // Ensure valid start time
            'end_time' => 'required|date|after:start_time', // Ensure end time is after start time
        ]);

        // Create a new reservation for the inventory item
        $reservation = new Reservation();
        $reservation->user_id = Auth::id(); // Set the current logged-in Dosen as the user
        $reservation->start_time = $request->start_time;
        $reservation->end_time = $request->end_time;
        
        // Get the selected inventory item and associate it with the reservation
        $inventoryItem = InventoryItem::find($request->inventory_item_id);
        $reservation->reservable_type = InventoryItem::class;
        $reservation->reservable_id = $inventoryItem->id;

        // Save the reservation
        $reservation->status = 'pending'; // By default, set status to 'pending'
        $reservation->save();

        return redirect()->route('dosen.inventory-reservations.create')->with('success', 'Reservation request submitted successfully.');
    }
}
