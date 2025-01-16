@extends('layouts.app')

@section('title', 'Make Inventory Reservation')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-4">Make an Inventory Reservation</h1>

        @if(session('success'))
            <div class="bg-green-200 text-green-800 p-4 rounded-md mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('dosen.inventory-reservations.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="inventory_item_id" class="block text-lg font-semibold">Select Inventory Item</label>
                <select name="inventory_item_id" id="inventory_item_id" class="block w-full p-2 border border-gray-300 rounded-md">
                    <option value="">-- Select an Item --</option>
                    @foreach($inventoryItems as $item)
                        <option value="{{ $item->id }}" {{ old('inventory_item_id') == $item->id ? 'selected' : '' }}>
                            {{ $item->name }} ({{ $item->category }})
                        </option>
                    @endforeach
                </select>
                @error('inventory_item_id')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="start_time" class="block text-lg font-semibold">Start Time</label>
                <input type="datetime-local" name="start_time" id="start_time" class="block w-full p-2 border border-gray-300 rounded-md" value="{{ old('start_time') }}">
                @error('start_time')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="end_time" class="block text-lg font-semibold">End Time</label>
                <input type="datetime-local" name="end_time" id="end_time" class="block w-full p-2 border border-gray-300 rounded-md" value="{{ old('end_time') }}">
                @error('end_time')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Submit Reservation</button>
        </form>
    </div>
@endsection
