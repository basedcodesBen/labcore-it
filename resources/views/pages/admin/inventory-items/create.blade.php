@extends('layouts.app')

@section('title', 'Create Inventory Item')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-4">Create New Inventory Item</h1>

    <form action="{{ route('admin.inventory-items.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Item Name</label>
            <input type="text" id="name" name="name" required class="form-input mt-1 block w-full p-2.5 rounded-lg border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div class="mb-4">
            <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
            <input type="text" id="category" name="category" required class="form-input mt-1 block w-full p-2.5 rounded-lg border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea id="description" name="description" class="form-input mt-1 block w-full p-2.5 rounded-lg border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
        </div>

        <div class="mb-4">
            <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
            <input type="number" id="quantity" name="quantity" required class="form-input mt-1 block w-full p-2.5 rounded-lg border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div class="mb-6 flex justify-end">
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                <i class="fa fa-save mr-2"></i> Create Item
            </button>
        </div>
        <div class="mb-4">
            <label for="available" class="inline-flex items-center">
                <input type="checkbox" id="available" name="available" value="1" class="form-checkbox h-5 w-5 text-blue-600" {{ old('available', $inventoryItem->available ?? 1) ? 'checked' : '' }}>
                <span class="ml-2 text-sm text-gray-700">Available for Reservation</span>
            </label>
        </div>        
    </form>
</div>
@endsection
