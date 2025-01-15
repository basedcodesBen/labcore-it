<?php

namespace Database\Seeders;

use App\Models\InventoryItem;
use Illuminate\Database\Seeder;

class InventoryItemSeeder extends Seeder
{
    public function run()
    {
        InventoryItem::create([
            'name' => 'Camera',
            'category' => 'Electronics',
            'description' => 'A professional DSLR camera for high-quality photography.',
            'quantity' => 10,
            'available' => true,
        ]);

        InventoryItem::create([
            'name' => 'Display Adapter',
            'category' => 'Electronics',
            'description' => 'An adapter for connecting various display devices.',
            'quantity' => 15,
            'available' => false, // Mark as unavailable
        ]);
    }
}
