@extends('layouts.app')

@section('title', 'Reservations')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Reservations</h2>
    <div class="space-y-4">
        <!-- Add Reservation Form Here -->
        <form action="{{ route('reservations.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="room" class="block">Room</label>
                <select name="room" id="room" class="w-full p-2 border border-gray-300 rounded" required>
                    <option value="">Select a Room</option>
                    <!-- Add room options here -->
                </select>
            </div>
            <div class="mb-4">
                <label for="inventory" class="block">Inventory Item</label>
                <select name="inventory" id="inventory" class="w-full p-2 border border-gray-300 rounded" required>
                    <option value="">Select an Inventory Item</option>
                    <!-- Add inventory options here -->
                </select>
            </div>
            <button type="submit" class="w-full py-2 bg-blue-600 text-white rounded">Make Reservation</button>
        </form>
    </div>
@endsection
