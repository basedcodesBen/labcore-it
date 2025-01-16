@extends('layouts.app')

@section('title', 'Room Reservations')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-4">Reserve a Room</h1>

    @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded-md mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('dosen.room-reservations.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="room_id" class="block text-lg font-medium text-gray-700">Select Room</label>
            <select name="room_id" id="room_id" class="w-full px-4 py-2 border rounded-md" required>
                <option value="">Choose a room</option>
                @foreach($rooms as $room)
                    <option value="{{ $room->id }}">
                        {{ $room->name }} (Capacity: {{ $room->capacity }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="start_time" class="block text-lg font-medium text-gray-700">Start Time</label>
            <input type="datetime-local" name="start_time" id="start_time" class="w-full px-4 py-2 border rounded-md" required>
        </div>

        <div class="mb-4">
            <label for="end_time" class="block text-lg font-medium text-gray-700">End Time</label>
            <input type="datetime-local" name="end_time" id="end_time" class="w-full px-4 py-2 border rounded-md" required>
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Reserve</button>
    </form>
</div>
@endsection
