<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 4 rooms with sample data
        Room::create([
            'name' => 'ADV1',
            'description' => 'A spacious room with modern facilities for lectures and meetings.',
            'capacity' => 30,
        ]);

        Room::create([
            'name' => 'ADV2',
            'description' => 'A medium-sized room suitable for group studies and workshops.',
            'capacity' => 30,
        ]);

        Room::create([
            'name' => 'ADV3',
            'description' => 'A small room with a round table, ideal for discussions and interviews.',
            'capacity' => 30,
        ]);

        Room::create([
            'name' => 'ADV4',
            'description' => 'A large conference room with projectors and seating arrangements for large meetings.',
            'capacity' => 50,
        ]);
    }
}
