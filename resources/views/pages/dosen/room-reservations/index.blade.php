@extends('layouts.app')

@section('title', 'My Room Reservations')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-4">My Room Reservations</h1>

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
                    <th class="px-4 py-2">Start Time</th>
                    <th class="px-4 py-2">End Time</th>
                    <th class="px-4 py-2">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservations as $reservation)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $reservation->reservable->name }}</td>
                        <td class="px-4 py-2">{{ $reservation->start_time->format('Y-m-d H:i') }}</td>
                        <td class="px-4 py-2">{{ $reservation->end_time->format('Y-m-d H:i') }}</td>
                        <td class="px-4 py-2">{{ ucfirst($reservation->status) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
