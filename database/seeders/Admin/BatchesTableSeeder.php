<?php

namespace Database\Seeders\Admin;

use App\Models\Admin\Batch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BatchesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Batch::truncate();
        Batch::create([
            'department_id' => 4,
            'title' => 'Spoken 1',
            'description' => 'Description 1',
            'slug' => 'title-1',
            'creator' => 1,
            'status' => 'active',
        ]);

        Batch::create([
            'department_id' => 4,
            'title' => 'Spoken 2',
            'description' => 'Description 2',
            'slug' => 'title-2',
            'creator' => 2,
            'status' => 'inactive',
        ]);

        Batch::create([
            'department_id' => 4,
            'title' => 'Spoken 3',
            'description' => 'Description 3',
            'slug' => 'title-3',
            'creator' => 1,
            'status' => 'active',
        ]);

        Batch::create([
            'department_id' => 4,
            'title' => 'Spoken 4',
            'description' => 'Description 4',
            'slug' => 'title-4',
            'creator' => 3,
            'status' => 'inactive',
        ]);

        Batch::create([
            'department_id' => 4,
            'title' => 'Spoken 5',
            'description' => 'Description 5',
            'slug' => 'title-5',
            'creator' => 2,
            'status' => 'active',
        ]);

        Batch::create([
            'department_id' => 3,
            'title' => 'IELTS 6',
            'description' => 'Description 6',
            'slug' => 'title-6',
            'creator' => 1,
            'status' => 'inactive',
        ]);

        Batch::create([
            'department_id' => 3,
            'title' => 'IELTS 7',
            'description' => 'Description 7',
            'slug' => 'title-7',
            'creator' => 4,
            'status' => 'active',
        ]);

        Batch::create([
            'department_id' => 3,
            'title' => 'IELTS 8',
            'description' => 'Description 8',
            'slug' => 'title-8',
            'creator' => 2,
            'status' => 'active',
        ]);

        Batch::create([
            'department_id' => 3,
            'title' => 'IELTS 9',
            'description' => 'Description 9',
            'slug' => 'title-9',
            'creator' => 3,
            'status' => 'inactive',
        ]);

        Batch::create([
            'department_id' => 3,
            'title' => 'IELTS 10',
            'description' => 'Description 10',
            'slug' => 'title-10',
            'creator' => 1,
            'status' => 'active',
        ]);
    }
}
