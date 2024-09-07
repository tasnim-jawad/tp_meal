<?php

namespace Database\Seeders\User;

use App\Models\User\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserRole::truncate();
        UserRole::insert([
            [
                'serial' => 1,
                'title' => 'super_admin',
                'creator' => null,
                'status' => 1
            ],
            [
                'serial' => 2,
                'title' => 'admin',
                'creator' => null,
                'status' => 1
            ],
            [
                'serial' => 3,
                'title' => 'student',
                'creator' => null,
                'status' => 1
            ],
            [
                'serial' => 4,
                'title' => 'employee',
                'creator' => null,
                'status' => 1
            ],
        ]);
    }
}
