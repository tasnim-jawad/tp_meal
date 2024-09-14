<?php

namespace Database\Seeders\Admin\Account;

use App\Models\Admin\Account\DailyBajar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DailyBajarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DailyBajar::truncate();
        DailyBajar::create([
            'group_id' => 'dfs31213',
            'title' => 'Rice',
            'qty' => 5,
            'unit' => 'kg',
            'price' => 50.0,
            'total' => 250.0,
            'date' => '2024-09-14',
            'comment' => 'Bought from local market',
        ]);

        DailyBajar::create([
            'group_id' => 'dfs31213',
            'title' => 'Chicken',
            'qty' => 2,
            'unit' => 'kg',
            'price' => 150.0,
            'total' => 300.0,
            'date' => '2024-09-14',
            'comment' => 'Fresh chicken from the market',
        ]);

        DailyBajar::create([
            'group_id' => 'dfs31213',
            'group_id' => 'dfs31213',
            'title' => 'Milk',
            'qty' => 3,
            'unit' => 'liter',
            'price' => 60.0,
            'total' => 180.0,
            'date' => '2024-09-14',
            'comment' => 'Dairy farm milk',
        ]);

        DailyBajar::create([
            'group_id' => 'dfs31213',
            'title' => 'Eggs',
            'qty' => 12,
            'unit' => 'piece',
            'price' => 10.0,
            'total' => 120.0,
            'date' => '2024-09-14',
            'comment' => 'Organic eggs',
        ]);

        DailyBajar::create([
            'group_id' => 'dfs31213',
            'title' => 'Flour',
            'qty' => 3,
            'unit' => 'kg',
            'price' => 40.0,
            'total' => 120.0,
            'date' => '2024-09-14',
            'comment' => 'Wheat flour for bread',
        ]);
    }
}
