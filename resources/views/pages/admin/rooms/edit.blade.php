@extends('layouts.app')

@section('title', 'Edit Room')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-4">Edit Room</h1>

    <form action="{{ route('admin.rooms.update', $room->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Room Name</label>
            <input type="text" id="name" name="name" value="{{ $room->name }}" required class="form-input mt-1 block w-full p-2.5 rounded-lg border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div class="mb-4">
            <label for="capacity" class="block text-sm font-medium text-gray-700">Capacity</label>
            <input type="number" id="capacity" name="capacity" value="{{ $room->capacity }}" required class="form-input mt-1 block w-full p-2.5 rounded-lg border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea id="description" name="description" class="form-input mt-1 block w-full p-2.5 rounded-lg border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ $room->description }}</textarea>
        </div>

        <div class="mb-6 flex justify-end">
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                <i class="fa fa-save mr-2"></i> Update Room
            </button>
        </div>
        <div class="mb-4">
            <label for="available" class="inline-flex items-center">
                <input type="checkbox" id="available" name="available" value="1" class="form-checkbox h-5 w-5 text-blue-600" {{ old('available', $room->available ?? 1) ? 'checked' : '' }}>
                <span class="ml-2 text-sm text-gray-700">Available for Reservation</span>
            </label>
        </div>
        
    </form>
</div>
@endsection
