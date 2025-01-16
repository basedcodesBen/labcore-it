@extends('layouts.app')

@section('title', 'Inventory Reservations')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-4">Inventory Reservations</h1>

        @if(session('success'))
            <div class="bg-green-200 text-green-800 p-4 rounded-md mb-4">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="bg-red-200 text-red-800 p-4 rounded-md mb-4">
                {{ session('error') }}
            </div>
        @endif

        <table class="min-w-full bg-white border border-gray-200 rounded-md shadow-md">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left">Inventory Item</th>
                    <th class="px-4 py-2 text-left">Start Time</th>
                    <th class="px-4 py-2 text-left">End Time</th>
                    <th class="px-4 py-2 text-left">Status</th>
                    <th class="px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservations as $reservation)
                    <tr>
                        <td class="px-4 py-2">{{ $reservation->reservable->name }}</td>
                        <td class="px-4 py-2">{{ $reservation->start_time->format('Y-m-d H:i') }}</td>
                        <td class="px-4 py-2">{{ $reservation->end_time->format('Y-m-d H:i') }}</td>
                        <td class="px-4 py-2">{{ ucfirst($reservation->status) }}</td>
                        <td class="px-4 py-2">
                            @if($reservation->status === 'pending')
                                <form action="{{ route('staff.inventory-reservations.approve', $reservation->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md">Approve</button>
                                </form>
                                <form action="{{ route('staff.inventory-reservations.reject', $reservation->id) }}" method="POST" class="inline-block ml-2">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md">Reject</button>
                                </form>
                            @else
                                <span class="text-gray-500">No actions available</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
