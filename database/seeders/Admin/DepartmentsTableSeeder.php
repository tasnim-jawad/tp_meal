<?php

namespace Database\Seeders\Admin;

use App\Models\Admin\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::truncate();
        Department::create([
            'title' => 'English',
            'description' => 'English Department',
            'slug' => 'english-department',
            'creator' => 1,
            'status' => 'active',
        ]);

        Department::create([
            'title' => 'IT',
            'description' => 'IT Department',
            'slug' => 'it-department',
            'creator' => 2,
            'status' => 'active',
        ]);

        Department::create([
            'title' => 'IELTS',
            'description' => 'IELTS Department',
            'slug' => 'ielts-department',
            'creator' => 3,
            'status' => 'active',
        ]);

        Department::create([
            'title' => 'Spoken',
            'description' => 'Spoken English Department',
            'slug' => 'spoken-english-department',
            'creator' => 4,
            'status' => 'active',
        ]);
    }
}
