@extends('layouts.app')

@section('title', 'Room Reservations')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-4">Pending Room Reservations</h1>

    @if(session('success'))
        <div class="mb-4 text-green-600">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="mb-4 text-red-600">
            {{ session('error') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-4 py-2">Room</th>
                    <th class="px-4 py-2">Reserved By</th>
                    <th class="px-4 py-2">Start Time</th>
                    <th class="px-4 py-2">End Time</th>
                    <th class="px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservations as $reservation)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $reservation->reservable->name }}</td>
                        <td class="px-4 py-2">{{ $reservation->user->name }}</td>
                        <td class="px-4 py-2">{{ $reservation->start_time->format('Y-m-d H:i') }}</td>
                        <td class="px-4 py-2">{{ $reservation->end_time->format('Y-m-d H:i') }}</td>
                        <td class="px-4 py-2 flex space-x-2">
                            <form action="{{ route('staff.room-reservations.approve', $reservation->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                                    Approve
                                </button>
                            </form>
                            <form action="{{ route('staff.room-reservations.reject', $reservation->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                                    Reject
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
