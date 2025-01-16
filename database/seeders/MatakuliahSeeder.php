<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\matakuliah;

class MatakuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        matakuliah::create(
            [
                'id_matkul' => $this->generateIdMatkul(),
                'nama' => 'Matematika Diskrit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        );
        matakuliah::create([
                'id_matkul' => $this->generateIdMatkul(),
                'nama' => 'Struktur Data',
                'created_at' => now(),
                'updated_at' => now(),
        ]);
        matakuliah::create(
            [
                'id_matkul' => $this->generateIdMatkul(),
                'nama' => 'Basis Data',
                'created_at' => now(),
                'updated_at' => now(),
            ]);    
    }

    /**
     * Generate a unique ID for id_matkul in the format IN-234.
     *
     * @return string
     */
    private function generateIdMatkul()
    {
        return 'IN-' . rand(100, 999);
    }
}
