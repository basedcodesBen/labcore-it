@extends('layouts.app')

@section('title', 'Inventory Items')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-4">Inventory Items</h1>

    @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded-md mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Create Inventory Item Button -->
    <a href="{{ route('admin.inventory-items.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 mb-4 inline-block">
        <i class="fa fa-plus mr-2"></i> Add New Item
    </a>

    <table class="min-w-full table-auto">
        <thead>
            <tr>
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Category</th>
                <th class="px-4 py-2">Quantity</th>
                <th class="px-4 py-2">Description</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($inventoryItems as $item)
                <tr>
                    <td class="border px-4 py-2">{{ $item->name }}</td>
                    <td class="border px-4 py-2">{{ $item->category }}</td>
                    <td class="border px-4 py-2">{{ $item->quantity }}</td>
                    <td class="border px-4 py-2">{{ $item->description }}</td>
                    <td class="border px-4 py-2 space-x-2">
                        <!-- Edit Button -->
                        <a href="{{ route('admin.inventory-items.edit', $item->id) }}" class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                            <i class="fa fa-edit mr-2"></i> Edit
                        </a>

                        <!-- Delete Button -->
                        <form action="{{ route('admin.inventory-items.destroy', $item->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                                <i class="fa fa-trash mr-2"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
