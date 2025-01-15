<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InventoryItem;
use Illuminate\Http\Request;

class InventoryItemController extends Controller
{
    public function index()
    {
        $inventoryItems = InventoryItem::all();
        return view('pages.admin.inventory-items.index', compact('inventoryItems'));
    }

    public function create()
    {
        return view('pages.admin.inventory-items.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:1',
            'available' => 'nullable|boolean', // Handle availability
        ]);

        InventoryItem::create($request->all());

        return redirect()->route('admin.inventory-items.index')->with('success', 'Inventory item created successfully.');
    }

    public function edit(InventoryItem $inventoryItem)
    {
        return view('pages.admin.inventory-items.edit', compact('inventoryItem'));
    }

    public function update(Request $request, InventoryItem $inventoryItem)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:1',
            'available' => 'nullable|boolean', // Handle availability
        ]);

        $inventoryItem->update($request->all());

        return redirect()->route('admin.inventory-items.index')->with('success', 'Inventory item updated successfully.');
    }

    public function destroy(InventoryItem $inventoryItem)
    {
        $inventoryItem->delete();
        return redirect()->route('admin.inventory-items.index')->with('success', 'Inventory item deleted successfully.');
    }
}
