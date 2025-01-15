<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Admin User
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@mail.com',
            'password' => Hash::make('password'), // Always hash passwords!
            'role' => 'admin', // You should add a role column in the users table for this
        ]);

        // Staff User
        User::create([
            'name' => 'Staff User',
            'email' => 'staff@mail.com',
            'password' => Hash::make('password'),
            'role' => 'staff',
        ]);

        // Dosen User
        User::create([
            'name' => 'Dosen User',
            'email' => 'dosen@mail.com',
            'password' => Hash::make('password'),
            'role' => 'dosen',
        ]);
    }
}
