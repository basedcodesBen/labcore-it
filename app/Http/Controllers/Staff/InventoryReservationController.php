<?php

namespace App\Http\Controllers\Staff;

use App\Models\Reservation;
use App\Http\Controllers\Controller;
use App\Models\InventoryItem;

class InventoryReservationController extends Controller
{
    // Display pending reservations for inventory
    public function index()
    {
        $reservations = Reservation::with('reservable') // Eager load the inventory item
            ->where('status', 'pending') // Show only pending reservations
            ->get();

        return view('pages.staff.inventory-reservations.index', compact('reservations'));
    }

    // Approve the reservation
    public function approve($reservationId)
    {
        $reservation = Reservation::find($reservationId);

        // Check if reservation exists and is pending
        if ($reservation && $reservation->status === 'pending') {
            // Mark reservation as approved
            $reservation->status = 'approved';
            $reservation->save();

            // Mark the inventory item as unavailable
            $reservation->reservable->update(['available' => false]);

            return redirect()->route('staff.inventory-reservations.index')->with('success', 'Reservation approved successfully.');
        }

        return redirect()->route('staff.inventory-reservations.index')->with('error', 'Invalid reservation or already approved.');
    }

    // Reject the reservation
    public function reject($reservationId)
    {
        $reservation = Reservation::find($reservationId);

        // Check if reservation exists and is pending
        if ($reservation && $reservation->status === 'pending') {
            // Mark reservation as rejected
            $reservation->status = 'rejected';
            $reservation->save();

            return redirect()->route('staff.inventory-reservations.index')->with('success', 'Reservation rejected successfully.');
        }

        return redirect()->route('staff.inventory-reservations.index')->with('error', 'Invalid reservation or already processed.');
    }
}
