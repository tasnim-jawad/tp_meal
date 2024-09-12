<?php

namespace Database\Seeders\Admin;

use App\Models\Admin\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::truncate();
        Setting::create([
            'address' => '123 Main St, Anytown, USA',
            'contact_name' => 'John Doe',
            'contact_number' => '1234567890',
            'meal_booking_last_time' => '12:00:00',
            'meal_booking_alert_time' => '11:00:00',
            'meal_booking_alert_text_for_all' => 'Reminder: Meal booking closes in one hour.',
            'meal_booking_minimum_amount' => 10,
            'shut_down_app' => 'active',
            'shut_down_reason' => null,
            'notice' => 'Please adhere to the meal booking schedule.',
            'slug' => 'title-2',
            'creator' => 2,
            'status' => 'active',
        ]);
    }
}
