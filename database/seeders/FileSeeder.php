<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\File;

class FileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        File::factory(10)->create();

        File::create([
            'name' => 'File 0',
            'status' => 0,
            'path' => '/path/to/file1.txt',
            'group_id' => 0,
        ]);
        
        File::create([
            'name' => 'File 1',
            'status' => 1,
            'path' => '/path/to/file1.txt',
            'group_id' => 1,
        ]);

        File::create([
            'name' => 'File 2',
            'status' => 2,
            'path' => '/path/to/file2.txt',
            'group_id' => 2,
        ]);
    }
}
