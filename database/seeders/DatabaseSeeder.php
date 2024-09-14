<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\Admin\Account\DailyBajarsTableSeeder;
use Database\Seeders\Admin\BatchesTableSeeder;
use Database\Seeders\Admin\DepartmentsTableSeeder;
use Database\Seeders\Admin\HolidaysTableSeeder;
use Database\Seeders\Admin\SettingsTableSeeder;
use Database\Seeders\User\UserRolesTableSeeder;
use Database\Seeders\User\UsersTableSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            UsersTableSeeder::class,
            UserRolesTableSeeder::class,
            BatchesTableSeeder::class,
            DepartmentsTableSeeder::class,
            SettingsTableSeeder::class,
            HolidaysTableSeeder::class,
            DailyBajarsTableSeeder::class,
        ]);
    }
}
